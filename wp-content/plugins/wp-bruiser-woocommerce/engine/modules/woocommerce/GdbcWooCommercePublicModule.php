<?php

/*
 * Copyright (C) 2014 Mihai Chelaru
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

final class GdbcWooCommercePublicModule extends GdbcBasePublicModule
{

	private $isLoginProtectionActivated         = false;
	private $isRegistrationProtectionActivated  = false;
	private $isLostPasswordProtectionActivated  = false;
	private $isResetPasswordProtectionActivated = false;
	private $isProductReviewProtectionActivated = false;


	private $checkRegistrationHookId = null;

	protected function __construct()
	{
		parent::__construct();


		if(!GoodByeCaptchaUtils::isWooCommerceActivated())
			return;


		if($this->isLoginProtectionActivated = (bool)$this->getOption(GdbcWooCommerceAdminModule::WOOCOMMERCE_LOGIN_FORM)){
			$this->activateLoginHooks();
		}

		if($this->isRegistrationProtectionActivated = (bool)$this->getOption(GdbcWooCommerceAdminModule::WOOCOMMERCE_REGISTRATION_FORM)){
			$this->activateRegistrationHooks();
		}

		if($this->isLostPasswordProtectionActivated = (bool)$this->getOption(GdbcWooCommerceAdminModule::WOOCOMMERCE_LOST_PASSWORD_FORM)){
			$this->activateLostPasswordHooks();
		}

		if($this->isResetPasswordProtectionActivated = (bool)$this->getOption(GdbcWooCommerceAdminModule::WOOCOMMERCE_RESET_PASSWORD_FORM)){
			$this->activateResetPasswordHooks();
		}

		if($this->isProductReviewProtectionActivated = (bool)$this->getOption(GdbcWooCommerceAdminModule::WOOCOMMERCE_RESET_PASSWORD_FORM)){
			$this->activateProductReviewHooks();
		}

//add_action( 'wp_enqueue_scripts', function(){
//	wp_dequeue_script( 'wc-checkout' );
//} );

	}



	public function activateLoginHooks()
	{
		if(!$this->isLoginProtectionActivated)
			return;

		add_action('woocommerce_login_form', array($this, 'renderTokenFieldIntoForm'), 999);
		add_filter('woocommerce_process_login_errors', array($this, 'validateLoginRequest'), 10, 3);
	}

	public function validateLoginRequest($wpError, $userName, $password)
	{
		$userName = is_email($userName) ? sanitize_email($userName) : sanitize_user($userName);

		$this->attemptEntity->Notes = array('username' => $userName);
		$this->attemptEntity->SectionId = $this->getOptionIdByOptionName(GdbcWooCommerceAdminModule::WOOCOMMERCE_LOGIN_FORM);

		if(GdbcRequestController::isValid($this->attemptEntity))
			return $wpError;

		return new WP_Error(GoodByeCaptcha::PLUGIN_SLUG, __('Your entry appears to be spam!', GoodByeCaptcha::PLUGIN_SLUG));
	}


	public function activateRegistrationHooks()
	{
		if(!$this->isRegistrationProtectionActivated)
			return;

		$this->addActionHook('woocommerce_register_form', array($this, 'renderTokenFieldIntoRegistrationForm'), 999);

		$this->checkRegistrationHookId = $this->addFilterHook('woocommerce_process_registration_errors', array($this, 'validateRegistrationRequest'), 10, 4);

		$this->addActionHook('woocommerce_before_checkout_process', array($this, 'removeRegistrationHookOnCheckout'));
		$this->addActionHook('woocommerce_checkout_process', array($this, 'removeRegistrationHookOnCheckout'));

	}

	public function renderTokenFieldIntoRegistrationForm()
	{
		if(GdbcModulesController::isModuleRegistered(GdbcModulesController::MODULE_WORDPRESS))
		{
			if( $wpModuleInstance = GdbcModulesController::getPublicModuleInstance(GdbcModulesController::MODULE_WORDPRESS) )
			{
				if(is_callable(array($wpModuleInstance, 'removeRegistrationHooks')))
				{
					$wpModuleInstance->removeRegistrationHooks();
				}
			}
		}

		$this->renderTokenFieldIntoForm();
	}

	public function removeRegistrationHookOnCheckout()
	{
		if( (! defined( 'WOOCOMMERCE_CHECKOUT' )) || (! WOOCOMMERCE_CHECKOUT) )
			return;

		$this->removeHookByIndex($this->checkRegistrationHookId);
	}

	public function validateRegistrationRequest($wpError, $userName, $password, $emailAddress)
	{
		$userName     = is_email($userName)     ? sanitize_email($userName)     : sanitize_user($userName);
		$emailAddress = is_email($emailAddress) ? sanitize_email($emailAddress) : null;

		$this->attemptEntity->Notes = array('username' => $userName, 'email' => $emailAddress);

		$this->attemptEntity->SectionId = $this->getOptionIdByOptionName(GdbcWooCommerceAdminModule::WOOCOMMERCE_REGISTRATION_FORM);

		if(GdbcRequestController::isValid($this->attemptEntity))
			return $wpError;

		return new WP_Error(GoodByeCaptcha::PLUGIN_SLUG, __('Your entry appears to be spam!', GoodByeCaptcha::PLUGIN_SLUG));
	}


	public function activateLostPasswordHooks()
	{
		if(!$this->isLostPasswordProtectionActivated)
			return;

		add_action('woocommerce_lostpassword_form',   array($this, 'renderTokenFieldIntoForm'), 999);
		add_filter('allow_password_reset', array($this, 'validateLostPasswordRequest'), 10, 2);

	}

	public function validateLostPasswordRequest($isResetPasswordAllowed, $userId)
	{
		$wpUser = new Wp_User((int)$userId);
		if(empty($wpUser->user_login)) {
			return false;
		}

		$this->attemptEntity->Notes = array('username' => $wpUser->user_login);
		$this->attemptEntity->SectionId = $this->getOptionIdByOptionName(GdbcWooCommerceAdminModule::WOOCOMMERCE_LOST_PASSWORD_FORM);

		return GdbcRequestController::isValid($this->attemptEntity);

	}

	public function activateResetPasswordHooks()
	{
		if(!$this->isResetPasswordProtectionActivated)
			return;

		add_action('woocommerce_resetpassword_form',   array($this, 'renderTokenFieldIntoForm'), 999);
		add_action('validate_password_reset', array($this, 'validateResetPasswordRequest'), 10, 2);

	}

	public function validateResetPasswordRequest($wpError, $wpUser)
	{

		$userName = is_a($wpUser, 'WP_User') ? $wpUser->user_login : null;
		$this->attemptEntity->Notes = array('username' => $userName);
		$this->attemptEntity->SectionId = $this->getOptionIdByOptionName(GdbcWooCommerceAdminModule::WOOCOMMERCE_RESET_PASSWORD_FORM);

		if(GdbcRequestController::isValid($this->attemptEntity))
			return;

		wp_redirect(home_url('/'));

		exit;
	}


	public function activateProductReviewHooks()
	{
		if(!GdbcWordPressPublicModule::isCommentsProtectionActivated())
		{
			$this->addActionHook('comment_form_top', array($this, 'renderTokenFieldIntoForm'));
		}

		$this->addFilterHook('preprocess_comment', array($this, 'validateProductReviewRequest'), 1);

	}

	public function validateProductReviewRequest($arrComment)
	{
		if(GdbcWordPressPublicModule::isCommentsProtectionActivated()) {
			GdbcWordPressPublicModule::getInstance()->removeHookByIndex(GdbcWordPressPublicModule::getInstance()->getCommentValidationHookIndex());
		}

		if(is_admin() && current_user_can( 'moderate_comments' ))
			return $arrComment;


		$arrComment['comment_post_ID'] = (!empty($arrComment['comment_post_ID']) && is_numeric($arrComment['comment_post_ID'])) ? (int)$arrComment['comment_post_ID'] : 0;

		if(empty($arrComment['comment_post_ID']) || empty($_POST['rating']) || absint($_POST['rating']) < 0 || absint($_POST['rating']) > 5 || 'product' !== strtolower(get_post_type($arrComment['comment_post_ID'])) )
		{
			return $arrComment; // not WooCommerce product review
		}

		$arrWordPressCommentsType = array('pingback' => 1, 'trackback' => 1);

		if( (!empty($arrComment['comment_type']) && isset($arrWordPressCommentsType[strtolower($arrComment['comment_type'])]) ) ) {
			wp_die( '<p>' . __( 'Link Notifications are disabled!', GoodByeCaptcha::PLUGIN_SLUG ) . '</p>', __( 'Comment Submission Failure' ), array( 'response' => 200 ) );
		}

		if ( ! isset( $arrComment['comment_agent'] ) ) {
			$arrComment['comment_agent'] = isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'], 0, 254 ) : '';
		}

		$this->getAttemptEntity()->SectionId = $this->getOptionIdByOptionName(GdbcWooCommerceAdminModule::WOOCOMMERCE_PRODUCT_REVIEW_FORM);
		$this->getAttemptEntity()->Notes = array_filter($arrComment);

		unset($this->attemptEntity->Notes['user_ID'], $this->attemptEntity->Notes['comment_author_IP'], $this->attemptEntity->Notes['comment_date'], $this->attemptEntity->Notes['comment_date_gmt']);
		unset($this->attemptEntity->Notes['comment_agent']);

		if( GdbcRequestController::isValid($this->getAttemptEntity()) )
			return $arrComment;

		$postPermaLink = get_permalink($arrComment['comment_post_ID']);

		empty($postPermaLink) ? wp_safe_redirect(home_url('/')) : wp_safe_redirect($postPermaLink);

		exit;

	}

	/**
	 * @return int
	 */
	protected function getModuleId()
	{
		return GdbcModulesController::getModuleIdByName(GdbcModulesController::MODULE_WOOCOMMERCE);
	}


	public static function getInstance()
	{
		static $publicInstance = null;
		return null !== $publicInstance ? $publicInstance : $publicInstance = new self();

	}

}

