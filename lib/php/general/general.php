<?php
	//Общие классы
	
	class general
		{
		//Мета и титл
		public static function get_meta_title()
			{
			//Проверяем конкретные мета и титл, если нет, то грузим умолчания
			$sql_text="SELECT * FROM cfg_meta_title WHERE method='{$_GET['method']}' AND p1='{$_GET['param1']}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			if ($sql_sql->rowCount()>0)
				{
				//Конкретные
				$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
				$ar_result['title']=$sql_result->title;
				$ar_result['keywords']=$sql_result->keywords;
				$ar_result['description']=$sql_result->description;
				}
			else
				{
				//Умолчания
				$ar_result['title']=setting::get_setting("title");
				$ar_result['keywords']=setting::get_setting("keywords");
				$ar_result['description']=setting::get_setting("description");
				}
			
			return $ar_result;
			}
		
		
		//json декодер
		public static function json2array($json)
			{
			$json=str_replace("'","\"",$json);
			// $json=str_replace("\"","'",$json);
			
				$arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
					'\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
					'\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
					'\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
					'\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
					'\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
					'\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
					'\u042d','\u044d','\u042e','\u044e','\u042f','\u044f');
				
				$arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
					'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
					'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
					'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я');
				
				$str1=str_replace($arr_replace_utf,$arr_replace_cyr,$json);
				$str2=json_decode($str1, true);

			
			// $json=str_replace("\"","'",$json);
			// $json=str_replace("'","\"",$json);
			// $json=mb_convert_encoding($json, "UTF-8");
			// $json=mb_convert_encoding($json, "UTF-8");
			
			// $json_array=json_decode($json, true);
			
			// return $json_array;
			return $str2;
			}
		
		//Метод возвращает js для вывода alert сообщения c последующей перезагрузкой страницы
		public static function get_js_reload_page($alert)
			{
			$result.="<script>\n";
				$result.="alert('{$alert}');\n";
				$result.="location.reload();\n";
			$result.="</script>\n";
			
			return $result;
			}
		
		//Метод превода текста с кириллицы в транскрипт
		public static function go_to_translit($str) 
			{
			$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ', '-', '/');
			
			$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '', '_', '_');
			
			return str_replace($rus, $lat, $str);
			}
		
		//Метод возвращает максимальный значение необходимого поля из необходимой таблицы
		public static function get_max_value($table, $field)
			{
			$sql_text="SELECT max({$field}) AS maxval FROM {$table}";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			return $sql_result->maxval;
			}
			
		//Метод возвращает максимальный значение необходимого поля из необходимой таблицы с необходимым условием
		public static function get_max_value_where($table, $field, $where)
			{
			$sql_text="SELECT max({$field}) AS maxval FROM {$table}{$where}";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			return $sql_result->maxval;
			}
		
		}
		
	//Класс работы с диалоговыми окнами
	class dialog
		{
		//Метод генерирует js открытия диалога с определенными параметрами
		public static function get_js_open_dialog($id_div, $title, $autoopen, $width, $height, $position, $modal, $ar_content)
			{
			//$ar_content массив из двух элементов, первый определяет, текстовое значение или динамическое js (т.е. брать в кавычки или нет), а второй - само значение контента диалога
			$result="if ($('#{$id_div}').length == 0) {\n";
				$result.="$('body').append(\"<div id='{$id_div}' title='{$title}'></div>\");\n";
			$result.="}\n";
			$result.="$('#{$id_div}').dialog({\n";
				$result.="position:{$position},\n";
				$result.="autoOpen: {$autoopen},\n";
				$result.="width: '{$width}',\n";
				$result.="height: '{$height}',\n";
				$result.="modal:{$modal},\n";
				$result.="buttons:{\n";
					if ($ar_content[3]['button']=="yes")
						{
						for ($i=0;$i<count($ar_content[3]['button_ar']);$i++)
							{
							$result.=$ar_content[3]['button_ar'][$i];
							if ($i!=count($ar_content[3]['button_ar'])-1)
								{
								$result.=",";
								}
							}
						}
				$result.="}\n";
			$result.="});\n";
			$result.="$('#{$id_div}').dialog('open');\n";
			$result.="$('#{$id_div}').bind('dialogclose', function(event, ui){\n";
				$result.="{$ar_content[2]};\n";
				//Удаляем блок диалога
				$result.="$('#{$id_div}').remove();\n";
			$result.="});\n";
			if ($ar_content[0]=='text')
				{
				$result.="$('#{$id_div}').html(\"{$ar_content[1]}\");\n";
				}
			if ($ar_content[0]=='js')
				{
				$result.="$('#{$id_div}').html({$ar_content[1]});\n";
				}
				
			return $result;
			}
		
		}
	
	
?>