<?php
if (!class_exists('PopupAllyProFluidTemplateBlank')) {
	class PopupAllyProFluidTemplateBlank extends PopupAllyProFluidTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'fluid_abdess';
			$this->template_name = 'Blank Canvas';

			$this->default_values = array($this->uid => self::$default_base_style_settings);
		}
	}
	PopupAllyProFluidTemplate::add_template(new PopupAllyProFluidTemplateBlank());
}