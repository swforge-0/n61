<?php
	//Вспомогательные классы меню
	
	class module_site_menu_1_help
		{
		
		//Получение массива меню по типу
		public static function get_menu_ar_1($ar_param)
			{
			$sql_text="SELECT * FROM module_site_menu_1 WHERE id_type='{$ar_param['type_menu']}' ORDER BY sort";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			
			if ($sql_sql->rowCount()>0)
				{
				for ($i=0;$i<$sql_sql->rowCount();$i++)
					{
					$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
					$sch=count($ar_result);
					$ar_result[$sch]['caption']=$sql_result->name_visual;
					$ar_result[$sch]['link']=$sql_result->name_code;
					}
				}
				
			return $ar_result;
			}
			
		}
	
?>