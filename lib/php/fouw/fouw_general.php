<?php
	//Кузница подводного мира (forge of underwater world)
	
	//Необходимые модули
		//DBH (pdo.php)
	
	//Главный класс
	class fouw_general
		{
		//Главный контент
		public static function get_general_content($ar_param)
			{
			//Главный блок НАЧАЛО
			$result.="<div class='fouw_general_div'>\n";
			
				$result.="Здесь будет распологаться игра<br>\n";
				$result.="<br>\n";
				$result.="<b>forge of underwater world</b>\n";
			
			//Главный блок КОНЕЦ
			$result.="</div>\n";
			
			return $result;
			}
			
			
		}

	
?>