<?php
	//Общие классы для работы с базой
	
	class general_base
		{
		//Получения данных из базы в виде массива. Метод 1
		public static function get_data_array_1($ar_param)
			{
			$sql_text="SELECT {$ar_param['fields']} FROM {$ar_param['from']} WHERE {$ar_param['where']} ORDER BY {$ar_param['order_by']}";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			
			for ($i=0;$i<$sql_sql->rowCount();$i++)
				{
				$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
				foreach ($sql_result AS $key=>$value)
					{
					$ar_result[$i][$key]=$value;
					}
				}
				
			return $ar_result;
			}
		
		}
	
	
?>