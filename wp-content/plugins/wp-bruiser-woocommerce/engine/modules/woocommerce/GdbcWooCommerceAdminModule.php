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

final class GdbcWooCommerceAdminModule  extends GdbcBaseAdminModule
{

	CONST WOOCOMMERCE_LOGIN_FORM          = 'IsLoginActivated';
	CONST WOOCOMMERCE_REGISTRATION_FORM   = 'IsRegisterActivated';
	CONST WOOCOMMERCE_LOST_PASSWORD_FORM  = 'IsLostPwdActivated';
	CONST WOOCOMMERCE_RESET_PASSWORD_FORM = 'IsResetPwdActivated';
	CONST WOOCOMMERCE_PRODUCT_REVIEW_FORM = 'IsProdRevActivated';

	protected function __construct()
	{
		parent::__construct();
	}

	public function getDefaultOptions()
	{
		static $arrDefaultSettingOptions = null;
		if(null !== $arrDefaultSettingOptions)
			return $arrDefaultSettingOptions;

		$arrDefaultSettingOptions = array(

			self::WOOCOMMERCE_LOGIN_FORM => array(
				'Id'          => 1,
				'Value'       => null,
				'LabelText'   => __('Protect Login Form', GoodByeCaptcha::PLUGIN_SLUG),
				'DisplayText' => __('Login', GoodByeCaptcha::PLUGIN_SLUG),
				'InputType'   => MchGdbcHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX,
			),

			self::WOOCOMMERCE_REGISTRATION_FORM => array(
				'Id'          => 2,
				'Value'       => null,
				'LabelText'   => __('Protect Registration Form', GoodByeCaptcha::PLUGIN_SLUG),
				'DisplayText' => __('Registration', GoodByeCaptcha::PLUGIN_SLUG),
				'InputType'   => MchGdbcHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX,
			),

			self::WOOCOMMERCE_LOST_PASSWORD_FORM => array(
				'Id'          => 3,
				'Value'       => null,
				'LabelText'   => __('Protect Lost Password Form', GoodByeCaptcha::PLUGIN_SLUG),
				'DisplayText' => __('Lost Password', GoodByeCaptcha::PLUGIN_SLUG),
				'InputType'   => MchGdbcHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX,
			),

			self::WOOCOMMERCE_RESET_PASSWORD_FORM => array(
				'Id'          => 4,
				'Value'       => null,
				'LabelText'   => __('Protect Reset Password Form', GoodByeCaptcha::PLUGIN_SLUG),
				'DisplayText' => __('Reset Password', GoodByeCaptcha::PLUGIN_SLUG),
				'InputType'   => MchGdbcHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX,
			),

			self::WOOCOMMERCE_PRODUCT_REVIEW_FORM => array(
				'Id'          => 5,
				'Value'       => null,
				'LabelText'   => __('Protect Product Review Form', GoodByeCaptcha::PLUGIN_SLUG),
				'DisplayText' => __('Product Review ', GoodByeCaptcha::PLUGIN_SLUG),
				'InputType'   => MchGdbcHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX,
			),

		);

		return $arrDefaultSettingOptions;

	}

	public  function validateModuleSettingsFields($arrSettingOptions)
	{
		$this->registerSuccessMessage(__('Your changes were successfully saved!', GoodByeCaptcha::PLUGIN_SLUG));
		return $arrSettingOptions;
	}

	public  function renderModuleSettingsSectionHeader(array $arrSectionInfo)
	{
		echo '<h3>' . __('WooCommerce General Settings', GoodByeCaptcha::PLUGIN_SLUG) . '</h3><hr />';
	}

	public function getFormattedBlockedContent(GdbcAttemptEntity $attemptEntity)
	{
		$attemptEntity->Notes = (array)maybe_unserialize($attemptEntity->Notes);
		$optionName = $this->getOptionNameByOptionId($attemptEntity->SectionId);

		$arrContent = array('table-head-rows' => '', 'table-body-rows' => '');

		if(null === $optionName)
			return $arrContent;

		$tableHeadRows = '';
		$tableBodyRows = '';

		$tableHeadRows .= '<tr>';
		$tableHeadRows .= '<th colspan="2">' . sprintf(__("Blocked %s Attempt", GoodByeCaptcha::PLUGIN_SLUG), $this->getOptionDisplayTextByOptionId($attemptEntity->SectionId)) . '</th>';
		$tableHeadRows .= '</tr>';

		$tableHeadRows .= '<tr>';
		$tableHeadRows .= '<th>' . __('Field', GoodByeCaptcha::PLUGIN_SLUG) . '</th>';
		$tableHeadRows .= '<th>' . __('Value', GoodByeCaptcha::PLUGIN_SLUG) . '</th>';
		$tableHeadRows .= '</tr>';

		if(isset($attemptEntity->Notes['comment_content']))
		{
			$commentContent = $attemptEntity->Notes['comment_content'];
			unset($attemptEntity->Notes['comment_content']);
			$attemptEntity->Notes['comment_content'] = 	$commentContent;
			unset($commentContent);
		}

		if(isset($attemptEntity->Notes['comment_parent']))
		{
			$parentCommentLink = (string)get_comment_link(absint($attemptEntity->Notes['comment_parent']));
			$parentCommentFiledValue = __('Comment Id ', GoodByeCaptcha::PLUGIN_SLUG);

			if(strpos($parentCommentLink, 'http') === 0) {
				$attemptEntity->Notes['comment_parent'] = '<a target = "blank" href = '. esc_attr($parentCommentLink) .'>' . $parentCommentFiledValue . absint($attemptEntity->Notes['comment_parent']) . '</a>';
			}
			else{
				$attemptEntity->Notes['comment_parent'] =  $parentCommentFiledValue . absint($attemptEntity->Notes['comment_parent']);
			}
		}

		if(isset($attemptEntity->Notes['comment_post_ID']))
		{
			$permaLink = get_permalink(absint($attemptEntity->Notes['comment_post_ID']));
			$title     = get_the_title(absint($attemptEntity->Notes['comment_post_ID']));

			if(!empty($title))
			{
				unset($attemptEntity->Notes['comment_post_ID']);
				$attemptEntity->Notes = array_merge(array('post' => '<a href="'.esc_attr($permaLink).'">'. esc_html($title) . '</a>'), $attemptEntity->Notes);
			}
		}

		if(isset($attemptEntity->Notes['user_id']))
		{
			if($wpUser = get_user_by('id', absint($attemptEntity->Notes['user_id']))){
				$attemptEntity->Notes['username'] = $wpUser->user_login;
			}

			unset($attemptEntity->Notes['user_id']);
		}

		foreach($attemptEntity->Notes as $key => $value)
		{
			$tableBodyRows .='<tr>';
			$tableBodyRows .= '<td>' . self::getBlockedContentDisplayableKey($key) . '</td>';
			$tableBodyRows .= '<td>' . wp_kses_stripslashes(wp_filter_kses(print_r($value, true)))  . '</td>';
			$tableBodyRows .='</tr>';
		}

		$arrContent['table-head-rows'] = $tableHeadRows;
		$arrContent['table-body-rows'] = $tableBodyRows;

		return $arrContent;

	}

	public static function getInstance()
	{
		static $adminInstance = null;
		return null !== $adminInstance ? $adminInstance : $adminInstance = new self();
	}

}