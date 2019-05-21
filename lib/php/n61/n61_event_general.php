<?php
	//События Главный
	
	class n61_event_general
		{
		//Получение события
		public static function get_event($ar_param)
			{
			//Получаем событие по коду
			$sql_text="SELECT * FROM n61_event WHERE id='{$ar_param['id_event']}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			$class_name=$sql_result->class_name;
			$fun_name=$sql_result->fun_name;
			
			//Дергаем код события
			$obj=new $class_name;
				$result=$obj->$fun_name($ar_param['ar_param_event']);
			unset($obj);
			
			return $result;
			}
		}

	
?>