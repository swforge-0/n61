<?php
	//Устанавливаем кодировку
	header('Content-type: text/html; charset=utf-8'); 

	//Функция Инициализации библиотек
	function ini_lib($p_catalog, $p_type)
		{
		$result="";
		$lib_catalog=$p_catalog;
		$scan_dir=scandir($lib_catalog);
		for ($i=0;$i<count($scan_dir);$i++)
			{
			//Подгружает все файлы только первого уровеня вложенности (Считаю, что этого достаточно) Пример: /lib/php/{Каталог первого уровня вложенности}/Все php-файды будут подгружены
			if ($scan_dir[$i]!="." AND $scan_dir[$i]!="..")
				{
				//Сканируем каталог и грузим все php-файлы
				$lib_catalog_level_1=$lib_catalog.$scan_dir[$i]."/";
				$scan_dir_level_1=scandir($lib_catalog_level_1);
				for ($j=0;$j<count($scan_dir_level_1);$j++)
					{
					$tmp_ex=explode(".", $scan_dir_level_1[$j]);
					if ($tmp_ex[count($tmp_ex)-1]==$p_type)
						{
						//Грузим все необходимые файлы, определенным способом в зависимости от типа
						$file_name=$lib_catalog_level_1.$scan_dir_level_1[$j];
						if ($p_type=="php")
							{
							include($file_name);
							}
						if ($p_type=="js")
							{
							$result.="<script type='text/javascript' src='/{$file_name}'></script>\n";
							}
						if ($p_type=="css")
							{
							$result.="<link rel='stylesheet' type='text/css' href='/{$file_name}'>\n";
							}
						};
					};
				};
			};
		if ($result!="")
			{
			return $result;
			}
		}
?>