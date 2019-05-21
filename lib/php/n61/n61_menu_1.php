<?php
	//Меню 1
	
	class n61_menu_1
		{
		public static function get_menu_1($ar_param)
			{
			$sql_text="SELECT * FROM n61_menu_1 ORDER BY sort";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			for ($i=0;$i<$sql_sql->rowCount();$i++)
				{
				$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
				
				//Дополнительные парметры события
				$json_dop_param_event=$sql_result->dop_param_event;
				$ar_dop_param_event=n61_other::json2array($json_dop_param_event);
				
				$result.="<div name='menu_1_point'>\n";
					$id_dom_elem="menu_1_point_{$sql_result->id}";
					$result.="<input type='button' id='{$id_dom_elem}' value='{$sql_result->name}'/>\n";
					//Событие
					unset($tmp_ar_param_1);
					$tmp_ar_param_1['id_event']=$sql_result->id_event;
					$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem}";
					$tmp_ar_param_1['ar_param_event']['ar_dop_param_event']=$ar_dop_param_event;
					$result.=n61_event_general::get_event($tmp_ar_param_1);
				$result.="</div>\n";
				}
				
			return $result;
			}
		}

	
?>