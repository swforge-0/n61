<?php
	//JS Эффекты
	
	//Первый класс эффектов
	class module_site_js_effect_1
		{
		//Набор анимации 1 (Анимация логотипа, Права, Верх)
		public static function get_kit_1($ar_param)
			{
			$result.="<script>\n";
			
				$result.="$('#{$ar_param['id_elem_1']}').mouseover( function() {\n";
					$result.="$('#{$ar_param['id_elem_1']}').fadeOut(800);\n";
					$result.="$('#{$ar_param['id_elem_1']}').fadeIn(800);\n";
					$result.="$('#{$ar_param['id_elem_1']}').hide(600);\n";
					$result.="$('#{$ar_param['id_elem_1']}').delay(300);\n";
					$result.="$('#{$ar_param['id_elem_1']}').show(0);\n";
				$result.="});\n";

			$result.="</script>\n";
			
			return $result;
			}	
		}
	
	
?>