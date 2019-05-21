<?php
	//Классы для работы с настройками программы
	
	//Класс для работы с таблицей настроек (cfg_setting)
	class setting
		{
		//Получение значения настройки по Имени
		public static function get_setting($name)
			{
			$sql_text="SELECT value FROM cfg_setting WHERE name='{$name}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			return $sql_result->value;
			}
		}
	
?>