<?php
	//Классы вывода страниц

	//Общий класс работы со страницами
	class str
		{
		//Прогрузка страниц
	
			//Блок игры
			public static function games($p1)
				{
				
				$tmp_ar_param['name_site']='template_1';
				$tmp_ar_param['p1']=$p1;
				$result=module_site::get_module($tmp_ar_param);
				
				return $result;
				}
				
			
		}
	
?>