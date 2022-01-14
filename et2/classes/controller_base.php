<?php
/**
 * Class Controller_Base
 * базовый абстрактый класс контроллера
 */

Abstract Class Controller_Base {

	protected $registry;
	protected $template;
	protected $config;
	protected $layouts; // шаблон
	
	public $vars = array();

	// в конструкторе подключаем шаблоны
	function __construct() {
		// все настройки системы
		$this->config = new Registry();

		// шаблоны
		$this->template = new Template($this->layouts, get_class($this));
		//$this->template->vars('qqqq', '1234'); // если опрделить здесь, будет общая переменная для всех представлений
		//$this->template->vars('ET2_PATH_HTML', ET2_PATH_HTML);

	}

	abstract function index();
	
}
