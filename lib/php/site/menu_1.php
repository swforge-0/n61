<?php
	//Меню
	
	class module_site_menu_1
		{
		
		//Певрый способ получения меню по типам
		public static function get_menu_1($ar_param)
			{
			//Получаем массив меню
			$ar_menu=module_site_menu_1_help::get_menu_ar_1($ar_param);
			
			//Формируем HTML A UL меню
			$result.="<div class='{$ar_param['css_class_div']}'>\n";
				
				//Надпись перед меню - если таковая имеется конечно
				if ($ar_param['cap_before_menu']!="")
					{
					$result.="<div name='cap_before_menu'>\n";
						$result.=$ar_param['cap_before_menu'];
					$result.="</div>\n";
					}
				
				$result.="<ul>\n";
					for ($i=0;$i<count($ar_menu);$i++)
						{
						
						//Определяем - Выделен ли пункт меню
						if ($ar_param['p1']==$ar_menu[$i]['link'])
							{
							$li_class=$ar_param['css_li_selected'];
							}
						else
							{
							$li_class="";
							}
							
						$result.="<a href='{$ar_menu[$i]['link']}'><li class='{$li_class}'>{$ar_menu[$i]['caption']}</li></a>\n";
						}
				$result.="</ul>\n";
			$result.="</div>\n";
			
			return $result;
			}
			
		}
	
	
?>