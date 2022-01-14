<?php
/**
 * Class Router
 * класс роутера
 * будет разбирать запрос, а потом загружать требуемый контроллер
 *
 */

Class Router {

	private $path;
	private $args = array();
	private $log = array();

	/**
	 * Router constructor.
	 * @throws Exception
	 */
	public function __construct() {

//		TODO надо-ли так делать, пока не понятно
//		if (is_dir(ET2_PATH_ET2_OTHER . 'controllers')) {
//			$this->setPath(ET2_PATH_ET2_OTHER . 'controllers');
//		}
//		else{
//			$this->setPath(ET2_PATH_ET2 . 'controllers');
//		}
		// задаем папку с контроллерами сразу здесь, а не в index.php
		// расположение контроллеров вроде как не предполагется изменять
		$this->setPath(ET2_PATH_ET2 . 'controllers');
		// будем вести логи
		$this->log = new Log();
	}
	/**
	 * setPath() - задаем путь до папки с контроллерами
	 * @param $path - путь до папки с конторллерами
	 * @throws Exception
	 */
	public function setPath($path) {
		$path = rtrim($path, '/\\');
		$path .= DS;
		// если путь не существует, сигнализируем об этом
		if (!is_dir($path)) {
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		$this->path = $path;
	}
	/**
	 * getController() - определение контроллера и экшена из урла
	 * @param $file
	 * @param $controller
	 * @param $action
	 * @param $args
	 */
	private function getController(&$file, &$controller, &$action, &$args) {
		$logText = __METHOD__.' Загрузка ';
		// TODO нужна проверка того, что прилетело в _GET. + Можно оставить только буквы, цифры и "/","_"
		$route = (empty($_GET['route'])) ? '' : $_GET['route'];
		unset($_GET['route']);
		if (empty($route)) {
			$route = 'index';
		}
		$logText .= $route;
		$this->log->lg($logText);
		// Получаем части урла
		$route = trim($route, '/\\');
		$parts = explode('/', $route);

		// Находим контроллер
		$cmd_path = $this->path;
		foreach ($parts as $part) {
			$fullpath = $cmd_path . $part;

			// Проверка существования папки
			if (is_dir($fullpath)) {
				$cmd_path .= $part . DS;
				array_shift($parts);
				continue;
			}

			// Находим файл
			if (is_file($fullpath . '.php')) {
				$controller = $part;
				array_shift($parts);
				break;
			}
		}

		// если урле не указан контролер, то испольлзуем поумолчанию index
		if (empty($controller)) {
			$controller = 'index';
		}

		// Получаем экшен
		$action = array_shift($parts);
		if (empty($action)) {
			$action = 'index';
		}

		// полный путь до имени фала контроллера
		$file = $cmd_path . $controller . '.php';
		$args = $parts;
	}

	/**
	 * start() - запуск маршрутизатора
	 */
	public function start() {
		// Анализируем путь
		$this->getController($file, $controller, $action, $args);

		$logText = __METHOD__.' Ошибка загрузки ';

		// Проверка существования файла, иначе 404
		if (!is_readable($file)) {
			// TODO здесь можно сделать более красивый вывод ошибки
			$logText .= ' is_readable ';
			$this->log->lg([$logText,$file, $controller, $action, $args]);
			die ('404 Not Found');
		}

		// Подключаем файл
		include ($file);

		// Создаём экземпляр контроллера
		$class = 'Controller_' . $controller;
		$controller = new $class();

		// Если экшен не существует - 404
		if (!is_callable(array($controller, $action))) {
			// TODO здесь можно сделать более красивый вывод ошибки
			$logText .= ' is_callable ';
			$this->log->lg([$logText,$file, $controller, $action, $args]);
			die ('404 Not Found');
		}

		// Выполняем экшен
		$controller->$action();
	}
}
