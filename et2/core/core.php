<?php
/**
 * core.php
 * Загрузка классов "на лету"
 */

spl_autoload_register(function ($className) {
	$filename = strtolower($className) . '.php';
	// определяем класс и находим для него путь
	$expArr = explode('_', $className);
	if(empty($expArr[1]) || $expArr[1] == 'Base'){
		$folder = 'classes';
	}
	else{
		switch(strtolower($expArr[0])){
		case 'controller':
			$folder = 'controllers';
			break;

		case 'model':
			$folder = 'models';
			break;

		default:
			$folder = 'classes';
			break;
		}
	}

//	// надо сначала посмотреть может есть в дополнительной папке
//	// путь до измененных класов
//	$file = ET2_PATH_ET2_OTHER . $folder . DS . $filename;
//	// проверяем наличие файла
//	if (file_exists($file)) {
//		// подключаем файл с классом
//		include ($file);
//	}
//	else{
		// путь до базовых классов
		$file = ET2_PATH_ET2 . $folder . DS . $filename;
		// проверяем наличие файла
		if (file_exists($file)) {
			// подключаем файл с классом
			include ($file);
		}
		else{
			echo "Невозможно загрузить {$className}";
			// return false;
			// throw new Exception("Невозможно загрузить {$className}.");
		}
//	}

});


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


