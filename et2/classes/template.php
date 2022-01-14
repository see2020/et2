<?php
// класс для подключения шаблонов и передачи данных в отображение
Class Template {

	private $template;
	private $controller;
	private $layouts;
	private $vars = array();
	private $views_path;

	public function __construct($layouts, $controllerName) {
		$this->layouts = $layouts;
		$arr = explode('_', $controllerName);
		$this->controller = strtolower($arr[1]);
		// будем вести логи
		$this->log = new Log();
	}

	// установка переменных, для отображения
	public function vars($varname, $value) {
		if (isset($this->vars[$varname])) {
			trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
			return false;
		}
		$this->vars[$varname] = $value;
		return true;
	}
	
	// отображение
	public function view($name) {
		$views_path = ET2_PATH_ET2 . 'views' . DS;
		// если задан другой путь до представлений, то подставляем его
		if(!empty($this->views_path)){
			$views_path = $this->views_path;
		}

		$pathLayout = $views_path . 'layouts' . DS . $this->layouts . '.php';
		$contentPage = $views_path . $this->controller . DS . $name . '.php';
		// основной макет
		if (!file_exists($pathLayout)) {
			trigger_error ('Layout `' . $this->layouts . '` does not exist.', E_USER_NOTICE);
			return false;
		}
		// шаблон в макете
		if (!file_exists($contentPage)) {
			trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
			return false;
		}

		// переменная в шаблоне
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		include ($pathLayout);                
	}

	public function __destruct(){
		unset($this->views_path);
	}
	
}