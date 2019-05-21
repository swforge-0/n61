<?php
	//Общие классы site
	
	
	class module_site
		{
		
		//Основной конструктор
		public static function get_module($ar_param)
			{
			//Вызываем необходимый конструктор сайтов в зависимости от входящего параметра
			$name_class="site_".$ar_param['name_site'];
				
			$obj=new $name_class;
				$result=$obj->get_site($ar_param);
			unset($obj);
				
			
			return $result;
			}
		
		}
	
	
?>