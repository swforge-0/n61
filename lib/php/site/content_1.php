<?php
	//Первый набор классов для работы с контентом
	
	class module_site_content_1
		{
		
		//Получение контента по типу и коду вызова
		public static function get_content_1($ar_param)
			{
			$sql_text="SELECT * FROM module_site_content_1 WHERE id_type='{$ar_param['id_type']}' AND code_call='{$ar_param['code_call']}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			$result="";
			
			//Просто HTML-код из базы
			if ($sql_result->type_content=="html")
				{
				$result=$sql_result->html_content;
				}
				
			//Специальный контент
			if ($sql_result->type_content=="spec")
				{
				$tmp_ar_param_1['Статичные параметры']==general::json2array($sql_result->spec_content_param);
				$tmp_ar_param_1['Динамичные параметры']=$ar_param['Динамичные параметры'];
				
				$obj=new $sql_result->spec_content_class;
					$tmp_name_fun=$sql_result->spec_content_method;
					$result=$obj->$tmp_name_fun($tmp_ar_param_1);
				unset($obj);
				}
				
			return $result;
			}
			
			
		}
	
	
?>