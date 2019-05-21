<?php
	//Настройки
	
	class n61_setting
		{
		//Получение настройки
		public static function get_setting($name)
			{
			$sql_text="SELECT * FROM n61_setting WHERE name='{$name}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			$result=$sql_result->value;
			
			return $result;
			}
		}

?>