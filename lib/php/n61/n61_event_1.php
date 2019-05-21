<?php
	//События 1
	
	class n61_event_1
		{	
		//Функция в разработке
		public static function function_develop($ar_param)
			{
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
				
					$result.="alert('Данная функция находится в разработке. Приносим извинения за неудобства.');\n";
				
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
			
		//Скинуть фишку
		public static function reset_chip($ar_param)
			{
			$ajax=n61_setting::get_setting("ajax_1");
			
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
					
					//Пробуем скинуть фишку
					$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','reset_chip',{});\n";
					
					//Обновляем доску
					$result.="$('#id_game_board').html(tmp_result);\n";
					
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
			
		//Передать ход
		public static function transfer_move($ar_param)
			{
			$ajax=n61_setting::get_setting("ajax_1");
			
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
					
					//Передаем ход
					$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','transfer_move',{});\n";
					
					//Проверяем ходит ли компьютер
					$result.="if (tmp_result=='1') {\n";
						//Ход компьютерного игрока
							//Бросаем кости
							$result.="$('#id_but_roll_dice').click();\n";
							//Совершаем ход компьютерным игроком
							$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','ii_move',{});\n";
							//Завершаем ход
							$result.="$('#id_but_transfer_move').click();\n";
					$result.="}else{\n";
						//Обновляем доску
						$result.="$('#id_game_board').html(tmp_result);\n";
					$result.="}\n";
					
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
			
		//Бросить кости
		public static function roll_dice($ar_param)
			{
			$ajax=n61_setting::get_setting("ajax_1");
			
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
					
					//Бросаем кости
					$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','roll_dice',{});\n";
					
					//Обновляем кости
					$result.="$('#id_game_dice').html(tmp_result);\n";
					
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
			
		//Выделение (Снятие выделения) фишки
		public static function select_unselect_chip($ar_param)
			{
			$ajax=n61_setting::get_setting("ajax_1");
				
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
					
					//Выделяем фишку
					$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','select_unselect_chip',{'code_chip':'{$ar_param['code_chip']}'});\n";
					
					//Обновляем доску
					$result.="$('#id_game_board').html(tmp_result);\n";
					
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
			
		//Клик по ячейке
		public static function click_cell($ar_param)
			{
			$ajax=n61_setting::get_setting("ajax_1");
				
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
					
					//Перемещаем выделенную фишку
					$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','chip_go_cell',{'code_cell':'{$ar_param['code_cell']}'});\n";
					
					//Обновляем доску
					$result.="$('#id_game_board').html(tmp_result);\n";
					
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
			
		//Новая игра
		public static function start_new_game($ar_param)
			{
			$ajax=n61_setting::get_setting("ajax_1");
				
			$result="<script>\n";
				$result.="$('#{$ar_param['event_obj_1']}').click(function(){\n";
					
					//Начинаем новую игру
					$result.="var tmp_result=n61_AjaxSelect('{$ajax}','POST','start_new_game',{'type_opponent':'{$ar_param['ar_dop_param_event']['type_opponent']}'});\n";
					
					//Перезагружаем страницу
					$result.="location.reload();\n";
					
				$result.="});\n";
			$result.="</script>\n";
			
			return $result;
			}
		}

	
?>