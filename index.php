<?php
/**
 * Index.php
 */
// включим отображение всех ошибок
error_reporting (E_ALL); 

// подключаем конфиг
include ('config.php');

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

