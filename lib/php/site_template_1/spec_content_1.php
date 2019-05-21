<?php
	//Классы подгрузки специального контента
	
	//Первый шаблон - первый специальный контент
	class site_template_1_spec_content_1
		{
		//Кузница подводного мира (forge of underwater world)
		public static function get_fouw($ar_param)
			{
			//Массив надписей
			$ar_cap=site_template_1_caption_1::get_arr_caption_1($ar_param);
			
			//Настройки модуля плавного появления
			$result.="<script>var revelator_sdvig_height=0;</script>\n";
			
			//fouw
			$result.=fouw_general::get_general_content($tmp_ar_param_1);
			
			return $result;
			}
			
		//Нарды 61
		public static function get_n61($ar_param)
			{
			//Массив надписей
			$ar_cap=site_template_1_caption_1::get_arr_caption_1($ar_param);
			
			//Настройки модуля плавного появления
			$result.="<script>var revelator_sdvig_height=0;</script>\n";
			
			//Нарды 61
			$result.=n61_general::get_general_content($tmp_ar_param_1);
			
			return $result;
			}
			
		}

	
?>