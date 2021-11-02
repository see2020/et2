<?php
/**
 * Class Controller_Index
 *
 */
Class Controller_Index Extends Controller_Base {

	// шаблон, основной файл с оформлением views/layouts/main_layouts.php
	public $layouts = "main_layouts";

	// экшен
	function index() {

		// переменная для шаблона
		$this->template->vars('varForTemlate', 'переменная для шаблона');

		$this->template->view('index');
	}

}