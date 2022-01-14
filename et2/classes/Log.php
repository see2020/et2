<?php
/*
 * Log
 * Класс ведения логов
 * $param = array(
 * 'f_name' = >'' - использовать файл лога отличный от по умолчанию
 * 'ses_clear' = >''
 * 'no_file' = >'' - не использовать файл лога, лог будет писаться в $this->logText, который можно получить с помощью $this->getLog()
 * 'f_clear' = >'' - чистить файл лога перед записью
 * )
 */
Class Log{

	private $param; // array()
	private $logText = ''; // string

	public function __construct($param = array()){
		$this->param = $param;
		if (empty($this->param['f_name'])) {
			$this->param['f_name'] = "./data/log/temp_log.log";
//			$this->param['f_name'] = __DIR__ . DIRECTORY_SEPARATOR . "lg.txt";
		}
		// если есть параметр session в массиве
//		if (empty($this->param['ses_clear'])) {
//			$this->param['ses_clear'] = true;
//		}
		// не сохраянть в файл
		// лог будет писаться в $this->logText, который можно получить с помощью getLog()
		if (empty($this->param['no_file'])) {
			$this->param['no_file'] = false;
		}
		// чистим файл лога если param['f_clear']=true
		if (!empty($this->param['f_clear']) && $this->param['f_clear']) {
			file_put_contents($this->param['f_name'], '');
		}
	}

	// меняем значение параметра, сущесвующий будут перезаписан новыми данными
	public function setParam($key = "", $val = ""){
		if (!empty($key)) {
			return false;
		}
		$this->param[$key] = $val;
		return true;
	}

	// массив в строку
//		private function _ArrayToString($arr){
//			if(!is_array($arr)){return "";}
//			if($this->param['ses_clear'] && $arr["session"]){
//				$arr["session"] = "[session_array]";
//			}
//			return(print_r($arr, true));
//		}

	// добавляем строку в файл
	private function _AddLine($f_string = ''){
		if ($this->param['no_file']) {
			$this->logText .= $f_string;
			return true;
		}
		$fp = fopen($this->param['f_name'], "a+");
		flock($fp, LOCK_EX);
		fputs($fp, $f_string);
		fflush($fp);
		flock($fp, LOCK_UN);
		fclose($fp);
		return true;
	}

	// получаем содержимое лога
	public function getLog(){
		echo $this->logText;
	}

	// пишем данные в файл
	public function lg($l_content = null){
		if (empty($l_content)) {
			return false;
		}
		$sv_content = "";
		if (is_array($l_content)) {
			foreach ($l_content as $key => $val) {
				if (is_object($val)) {
					$sv_content .= $key . ": " . print_r($val, true);
				} elseif (is_array($val)) {
//					if ($this->param['ses_clear'] && isset($val["session"])) {
//						$val["session"] = "[session array]";
//					}
//						$sv_content.= $key.": ".$this->_ArrayToString($val);
					$sv_content .= $key . ": " . print_r($val, true);
				} elseif (is_bool($val)) {
					if ($val) {
						$sv_content .= $key . ": TRUE";
					} else {
						$sv_content .= $key . ": FALSE";
					}
				} else {
					$sv_content .= $key . ": " . $val;
				}
				$sv_content .= "; ";
			}
		} else {
			$sv_content = $l_content;
		}

		$f_content = date("Y.m.d H:i:s");
		$f_content .= " --- ";
		// $f_content.= str_replace(array("\r", "\n", "\t"), " ", $sv_content);
		$f_content .= $sv_content;
		$f_content .= "\r\n";
		$this->_AddLine($f_content);
		return true;
	}

	// пишем данные в файл, как есть без обработки
	public function fl($f_content = ""){
		if (empty($f_content)) {
			return false;
		}
		$f_content .= "\r\n";
		$this->_AddLine($f_content);
		return true;
	}

	// ошибка json, после выполнения json_decode()/json_encode()
	public function jsonLastError()
	{
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
//					echo ' - Ошибок нет';
				$this->lg(array("err" => "JSON_ERROR_NONE", "msg" => "Ошибок нет"));
				break;
			case JSON_ERROR_DEPTH:
//					echo ' - Достигнута максимальная глубина стека';
				$this->lg(array("err" => "JSON_ERROR_DEPTH", "msg" => "Достигнута максимальная глубина стека"));
				break;
			case JSON_ERROR_STATE_MISMATCH:
//					echo ' - Некорректные разряды или несоответствие режимов';
				$this->lg(array("err" => "JSON_ERROR_STATE_MISMATCH", "msg" => "Некорректные разряды или несоответствие режимов"));
				break;
			case JSON_ERROR_CTRL_CHAR:
//					echo ' - Некорректный управляющий символ';
				$this->lg(array("err" => "JSON_ERROR_CTRL_CHAR", "msg" => "Некорректный управляющий символ"));
				break;
			case JSON_ERROR_SYNTAX:
//					echo ' - Синтаксическая ошибка, некорректный JSON';
				$this->lg(array("err" => "JSON_ERROR_SYNTAX", "msg" => "Синтаксическая ошибка, некорректный JSON"));
				break;
			case JSON_ERROR_UTF8:
//					echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
				$this->lg(array("err" => "JSON_ERROR_UTF8", "msg" => "Некорректные символы UTF-8, возможно неверно закодирован"));
				break;
			default:
//					echo ' - Неизвестная ошибка';
				$this->lg(array("err" => "none", "msg" => "Неизвестная ошибка"));
				break;
		}
	}
}


// if(!function_exists('lg_test_1234567')){include ("./test/lg.php");}
// lg(array("data" => $data,"" => "",));
// clearFile();
// fl("");
// jsonLastError();

//function lg_test_1234567($arr)
//{
//	return "Ok";
//}
//
//function ArrayToString($arr, $session_clear = true)
//{
//	if (!is_array($arr)) {
//		return "";
//	}
//	if ($session_clear && isset($arr["session"])) {
//		$arr["session"] = "[session_array]";
//	}
//	return (print_r($arr, true));
//}
//
//function AddLine($f_name = '', $f_string = '')
//{
//	$fp = fopen($f_name, "a+");
//	flock($fp, LOCK_EX);
//	fputs($fp, $f_string);
//	fflush($fp);
//	flock($fp, LOCK_UN);
//	fclose($fp);
//}
//
//function clearFile($f_name = "./test/lg.txt")
//{
//	file_put_contents($f_name, '');
////		$fh = fopen($f_name, 'w');
////		fclose($fh);
//}
//
//function lg($l_content = "", $f_name = "./test/lg.txt", $session_clear = true)
//{
//	$sv_content = "";
//	if (is_array($l_content)) {
//		foreach ($l_content as $key => $val) {
//			if (is_object($val)) {
//				$sv_content .= $key . ": " . print_r($val, true);
//			} elseif (is_array($val)) {
//				$sv_content .= $key . ": " . ArrayToString($val, $session_clear);
//			} elseif (is_bool($val)) {
//				if ($val) {
//					$sv_content .= $key . ": TRUE";
//				} else {
//					$sv_content .= $key . ": FALSE";
//				}
//			} else {
//				$sv_content .= $key . ": " . $val;
//			}
//			$sv_content .= "; ";
//		}
//	} else {
//		$sv_content = $l_content;
//	}
//
//	$f_content = date("Y.m.d H:i:s");
//	$f_content .= " --- ";
//	// $f_content.= str_replace(array("\r", "\n", "\t"), " ", $sv_content);
//	$f_content .= $sv_content;
//	$f_content .= "\r\n";
//	AddLine($f_name, $f_content);
//}
//
//function fl($l_content = "", $f_name = "./test/fl.txt")
//{
//	$l_content .= "\r\n";
//	AddLine($f_name, $l_content);
//}
//
//function jsonLastError()
//{
//	switch (json_last_error()) {
//		case JSON_ERROR_NONE:
//			echo ' - Ошибок нет';
//			break;
//		case JSON_ERROR_DEPTH:
//			echo ' - Достигнута максимальная глубина стека';
//			break;
//		case JSON_ERROR_STATE_MISMATCH:
//			echo ' - Некорректные разряды или несоответствие режимов';
//			break;
//		case JSON_ERROR_CTRL_CHAR:
//			echo ' - Некорректный управляющий символ';
//			break;
//		case JSON_ERROR_SYNTAX:
//			echo ' - Синтаксическая ошибка, некорректный JSON';
//			break;
//		case JSON_ERROR_UTF8:
//			echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
//			break;
//		default:
//			echo ' - Неизвестная ошибка';
//			break;
//	}
//}
//
////if(!class_exists('tst_log')){include ("./test/lg.php");$tsl = new tst_log(array('ses_clear'=>true,'f_clear'=>false,'no_file'=>false));}
////$tsl->lg(array("data" => $data,"" => "",));
////$tsl->fl("");
////$tsl->jsonLastError();
//// $param['f_name'] = "./test/lg.txt"
//// $param['ses_clear'] = true
//// $param['f_clear'] = false
///**/
//
//class tst_log
//{
//
//}
