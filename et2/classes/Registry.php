<?php
/**
* Class Registry
* Implements ArrayAccess - чтобы предоставить доступ к объекту, как к обычному массиву
* Устанавливаем некоторое значение
* $registry->set ('name', 'Aa123456');
* Получаем значение, используя get()
* echo $registry->get ('name');
* Получаем значение, используя доступ как к массиву
* echo $registry['name']
*/

class Registry Implements ArrayAccess {

	private $vars = array();

	public function __construct(){
//		if(is_dir(ET2_PATH_CONFIG)){
			// путь до настроек
//			$file = ET2_PATH_CONFIG . "config.php";
			$file = ET2_PATH . 'config' . DS . "config.php";
			if (file_exists($file)) {
				// подключаем файл с настройками
				include ($file);
				// добавляем настройки из файла
				$this->vars = $config;
			}
//		}

	}

	/**
	 * set() - установка параметра хранимого в памяти
	 * @param $key - ключ
	 * @param $var - значение
	 * @return bool
	 * @throws Exception
	 */
	public function set($key, $var) {
		if (isset($this->vars[$key])) {
			throw new Exception('Unable to set var `' . $key . '`. Already set.');
		}
		$this->vars[$key] = $var;
		return true;
	}
	/**
	 * get() - получение праметра
	 * @param $key - ключ
	 * @return mixed|null
	 */
	public function get($key) {
		if (isset($this->vars[$key]) == false) {
			return null;
		}
		return $this->vars[$key];
	}

	/**
	 * remove() - удаление значение параметра по ключу
	 * @param $key
	 */
	public function remove($key) {
		unset($this->vars[$key]);
	}

	public function offsetExists($offset) {
		return isset($this->vars[$offset]);
	}

	public function offsetGet($offset) {
		return $this->get($offset);
	}

	public function offsetSet($offset, $value) {
		$this->set($offset, $value);
	}

	public function offsetUnset($offset) {
		unset($this->vars[$offset]);
	}

}