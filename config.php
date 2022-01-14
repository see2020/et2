<?php
//define('DS', DIRECTORY_SEPARATOR); // разделитель
//define('ET2_PATH', realpath(dirname(__FILE__) . DS) . DS); // путь к корневой папке
////define('ET2_PATH', DS.'et2'.DS); // путь к корневой папке
//define('ET2_PATH_ET2', ET2_PATH.'et2'.DS); // папка с et2, все базовые модели и классы там
////define('ET2_PATH_CONFIG', ET2_PATH.'config1'.DS); // папка с yfcnh
////define('ET2_PATH_ET2_OTHER', ET2_PATH.'et2_other1'.DS); // папка для измененных моделей и контроллеров


define('DS', DIRECTORY_SEPARATOR); // разделитель
define('ET2_PATH', realpath(dirname(__FILE__) . DS) . DS); // путь к корневой папке
define('ET2_PATH_ET2', ET2_PATH.'et2'.DS); // папка с et2, все базовые модели и классы там
define('ET2_PATH_HTML', '/et2/et2'); // корневая для html


// для подключения к бд
//define('DB_USER', 'denis');
//define('DB_PASS', 'denis');
//define('DB_HOST', 'localhost');
//define('DB_NAME', 'db_et2');

//try {
//	$order = $this->eumodel->saveUslugaOrder($data);
//
//} catch (Exception $e) {
//	return array('success' => false, 'Error_Msg' => $e->getMessage());
//}