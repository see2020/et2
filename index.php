<?php
/**
 * Index.php
 */
// включим отображение всех ошибок
error_reporting (E_ALL);

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

// подключаем ядро сайта
include (ET2_PATH_ET2 . 'core' . DS . 'core.php');

// настройки будут тут
//$registry = new Registry;

// Загружаем router
$router = new Router();

// задаем путь до папки контроллеров.
//$router->setPath (ET2_PATH_ET2 . 'controllers');

// запускаем маршрутизатор
$router->start();


//// Соединяемся с БД
////$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
////$dbObject->exec('SET CHARACTER SET utf8');
//



////
////// Соединяемся с БД
////$db = new PDO('mysql:host=localhost;dbname=db_et2', 'denis', 'denis'); // '[user]', '[password]'
////$registry->set ('db', $db);
////
////// Создаём объект шаблонов
////$template = new Template($registry);
////$registry->set ('template', $template);
////
////// Загружаем router
////$router = new Router($registry);
////
////$registry->set ('router', $router);
////
//////установили путь до наших контроллеров
////$router->setPath (ET_PATH . 'controllers');
////
////$router->delegate();
//

