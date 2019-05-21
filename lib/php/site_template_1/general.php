<?php
	//Общие классы site_template_1
	
	class site_template_1
		{
		
		//Получение сайта
		public static function get_site($ar_param)
			{
			$result=site_template_1::get_template_page($ar_param);
			
			
			return $result;
			}
			
		//Получаем шаблон страницы
		public static function get_template_page($ar_param)
			{
			$ar_caption=site_template_1_caption_1::get_arr_caption_1($tmp_ar_param);
				
			//Главный блок
			$result="<div class='site_1_div_gl'>\n";
			
				//Верхняя панель - Начало
				// $result.="<div class='site_1_div_cap'>\n";
					
					//Надпись 1
					// $result.="<div class='site_1_div_cap_cap_1'>\n";
						// $result.=$ar_caption['cap']['Надпись 1'];
					// $result.="</div>\n";
					
				//Верхняя панель - Конец
				// $result.="</div>\n";
				
			
				//Главный центральный блок
				$result.="<div class='site_1_div_gl_center'>\n";
					
					//Центральный блок
					$result.="<div class='site_1_div_center'>\n";
						
						
						//Получаем контент по типу и коду вызова
						unset($tmp_ar_param);
						$tmp_ar_param['id_type']="1";
						$tmp_ar_param['code_call']=$ar_param['p1'];
						$result.=module_site_content_1::get_content_1($tmp_ar_param);
						
						
					
					$result.="</div>\n";
					
				//Конец центрального блока				
				$result.="</div>\n";
				
				//Главный подвал
				// $result.="<div class='site_1_div_gl_footer'>\n";
					
					//Надпись 1
					// $result.="<div class='site_1_div_gl_footer_cap_1'>\n";
						// $result.=$ar_caption['footer']['Надпись 1'];
					// $result.="</div>\n";
					
				// $result.="</div>\n";
			
			//Конец главного блока
			$result.="</div>\n";
			
			
			return $result;
			}
			
		}
	
	
?>