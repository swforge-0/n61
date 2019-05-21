<?php
	//Инициализация
	include("ini/ini.php");
		
	//Инициализируем php-библиотеки
	ini_lib("lib/php/", "php");
	
	//Елси открыли /
		if ($_GET['method']=="")
			{
			$url=setting::get_setting("Метод по умолчанию")."/".setting::get_setting("Параметр по умолчанию");
			header("Location: {$url}");
			}
	
	//Инициализируем структуру html-страницы
		$echo="";
		$echo.="<html>\n";
			$echo.="<head>\n";
			
					//Получаем мета значения
					unset($tmp_ar_title_meta);
					$tmp_ar_title_meta=general::get_meta_title();
					
					$echo.="<title>{$tmp_ar_title_meta['title']}</title>\n";
					$echo.="<meta name='keywords' content='{$tmp_ar_title_meta['keywords']}' />\n";
					$echo.="<meta name='description' content='{$tmp_ar_title_meta['description']}' />\n";
			
			
					//Запрет индексации
					// $echo.="<meta name='robots' content='noindex, nofollow' />\n";
					
					//Подтверждение прав для яндекса
					$echo.="<meta name='yandex-verification' content='e981d5da383deb38' />\n";
					
					
				//Инициализируем плагины (Вручную)
					//jquery
					$echo.="<script type='text/javascript' src='/plugins/jquery-2.1.1/jquery-2.1.1.min.js'></script>\n";
					//jquery-ui
					$echo.="<script type='text/javascript' src='/plugins/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js'></script>\n";
					$echo.="<link rel='stylesheet' type='text/css' href='/plugins/jquery-ui-1.10.4.custom/css/redmond/jquery-ui-1.10.4.custom.min.css' />\n";
					//lightgallery
					$echo.="<link href='/plugins/lightgallery/skins/default/style.css' type='text/css' media='screen' rel='stylesheet' />\n";
					$echo.="<script src='/plugins/lightgallery/lightgallery.js' type='text/javascript'></script>\n";
					$echo.="<script>lightgallery.init();</script>\n";
					
					
				//Инициализируем JS-библиотеки
					$echo.=ini_lib("lib/js/", "js");
					
				//Инициализируем CSS-библиотеки
					$echo.=ini_lib("lib/css/", "css");
					
				//Иконка
					$echo.="<link rel='shortcut icon' href='/favicon.ico' type='image/x-icon'>\n";
					$echo.="<link rel='icon' href='/favicon.ico' type='image/x-icon'>\n";
					
				
			$echo.="</head>\n";
			$echo.="<body>\n";
		echo $echo;
			
			
			//Грузим содержимое, в зависимости от параметров
			echo page::parse_get($_GET);
	
	//Закрываем структуру html-страницы
	
			//Яндекс метрика
					$echo='<!-- Yandex.Metrika counter -->
								<script type="text/javascript" >
									(function (d, w, c) {
										(w[c] = w[c] || []).push(function() {
											try {
												w.yaCounter49522660 = new Ya.Metrika2({
													id:49522660,
													clickmap:true,
													trackLinks:true,
													accurateTrackBounce:true
												});
											} catch(e) { }
										});

										var n = d.getElementsByTagName("script")[0],
											s = d.createElement("script"),
											f = function () { n.parentNode.insertBefore(s, n); };
										s.type = "text/javascript";
										s.async = true;
										s.src = "https://mc.yandex.ru/metrika/tag.js";

										if (w.opera == "[object Opera]") {
											d.addEventListener("DOMContentLoaded", f, false);
										} else { f(); }
									})(document, window, "yandex_metrika_callbacks2");
								</script>
								<noscript><div><img src="https://mc.yandex.ru/watch/49522660" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
							<!-- /Yandex.Metrika counter -->';
	
	
			$echo.="</body>\n";
		$echo.="</html>\n";
	
		echo $echo;
?>