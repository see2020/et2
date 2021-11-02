<?php
/**
 * Class Model_Configlist
 *
 */

Class Model_Configlist Extends Model_Base {

	/**
	 * Возвращает массив со всеми настройками
	 * @return array
	 */
	public function getConfiglist(){
		$config_arr = [];
		$config_arr['DS']					 = DS;
		$config_arr['ET2_PATH']				 = ET2_PATH;
		$config_arr['ET2_PATH_ET2']			 = ET2_PATH_ET2;
//		$config_arr['ET2_PATH_CONFIG']		 = ET2_PATH_CONFIG;
//		$config_arr['ET2_PATH_ET2_OTHER']	 = ET2_PATH_ET2_OTHER;

		return $config_arr;
	}
}