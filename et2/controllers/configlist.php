<?php
/**
 * Class Controller_Configlist
 * список всех параметров системы
 */

class Controller_Configlist Extends Controller_Base {

	// шаблон
	public $layouts = "main_layouts";

	// экшен
	function index() {
		$model = new Model_Configlist(); // создаем объект модели

		// передаем в представление массив со всеми настройками в переменную configlist
		$this->template->vars('configlist', $model->getConfiglist());
		// подключаем шаблон оформления
		$this->template->view('index');
	}

	public function tst(){
		$this->template->vars('configlist', ["test"=>"test"]);
		$this->template->view('index');
	}
	public function tst1(){
		$this->template->vars('configlist', ["test"=>"test"]);
		$this->template->view('tst1');
	}

}