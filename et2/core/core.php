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

// TODO наверное сюда стоит определить ведение логов