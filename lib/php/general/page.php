<?php
	//Классы для работы со страницами (Возов необходимого метода-обработчика из класса str)
	
	//Класс вызова необходимого метода
	class page
		{
		//Метод парсинга GET-строки и перенаправления на метод-обработчик
		public static function parse_get($get)
			{
			if ($get["method"]!="")
				{
				$obj=new str;
					$result=$obj->$get["method"]("{$get['param1']}");
				unset($obj);
				}
			
			return $result;
			}
		}
	
?>