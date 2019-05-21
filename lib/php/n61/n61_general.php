<?php
	//Нарды 61
	
	//Необходимые модули
		//DBH (pdo.php)
	
	//Главный класс
	class n61_general
		{
		//Главный контент
		public static function get_general_content($ar_param)
			{
			//Главный блок Начало
			$result.="<div class='n61_general_div'>\n";
			
				//Блок игры Начало
				$result.="<div name='game_general'>\n";
				
					//Первый подблок игры Начало
					$result.="<div name='game_general_div_1'>\n";
					
						//Доска Начало
						$result.="<div name='game_board' id='id_game_board'>\n";
						
							//Проверяем наличие хэш-кода
							unset($tmp_ar_param_1);
							$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
							if ($hash_code=="")
								{
								//Устанавливаем параметры для нового игрока
								unset($tmp_ar_param_1);
								n61_game_1::set_param_new_player($tmp_ar_param_1);
								}
							else
								{
								//Проверяем наличие хэш-кода во временной таблице
								unset($tmp_ar_param_1);
								$tmp_ar_param_1['hash_code']=$hash_code;
								$tmp_test_1=n61_hash_code::test_hash_code($tmp_ar_param_1);
								if ($tmp_test_1=="0")
									{
									//Устанавливаем параметры для нового игрока
									unset($tmp_ar_param_1);
									n61_game_1::set_param_new_player($tmp_ar_param_1);
									}
								}
							
							//Грузим содержимое доски
							unset($tmp_ar_param_1);
							$result.=n61_general::get_board_content($tmp_ar_param_1);
							
						//Доска Конец
						$result.="</div>\n";
					
						//Правая контрольная панель Начало
						$result.="<div name='game_right_control'>\n";
							
							//Меню Начало
							$result.="<div name='game_menu'>\n";
								unset($tmp_ar_param_1);
								$result.=n61_menu_1::get_menu_1($tmp_ar_param_1);
							//Меню Конец
							$result.="</div>\n";
							
							//Кости Начало
							$result.="<div name='game_dice' id='id_game_dice'>\n";
								//Грузим кости
								unset($tmp_ar_param_1);
								$result.=n61_game_1::load_game_dice($tmp_ar_param_1);
							//Кости Конец
							$result.="</div>\n";
							
							//Управление игровым процессом Начало
							$result.="<div name='game_process' id='id_game_process'>\n";
								//Грузим содержимое
								unset($tmp_ar_param_1);
								$result.=n61_game_1::load_game_process($tmp_ar_param_1);
							//Управление игровым процессом Конец
							$result.="</div>\n";
							
						
						//Правая контрольная панель Конец
						$result.="</div>\n";
						
					//Первый подблок игры Конец
					$result.="</div>\n";
					
					//Второй подблок игры Начало
					$result.="<div name='game_general_div_2'>\n";
						$result.="<h1>Нарды \"Шесть один\" (6:1)</h1>\n";
						$result.="<h2>Здесь можно сыграть в Нарды \"Шесть один\" онлайн и без регистрации</h2>\n";
						$result.="<h3>Пожелания по улучшению программного продукта принимаются по адресу <a href='mailto:n61@spec-games.ru'>n61@spec-games.ru</a></h3>\n";
					$result.="</div>\n";
				
				//Блок игры Конец
				$result.="</div>\n";
			
			//Главный блок Конец			
			$result.="</div>\n";
			
			return $result;
			}
			
		//Содержимое доски
		public static function get_board_content($ar_param)
			{
			//Обнуляем игровые массивы
			unset($ar_chip);
			
			//Массив фишек
			unset($tmp_ar_param_1);
			$ar_chip=n61_game_2::get_chip_position($tmp_ar_param_1);
				
			//Полоска - разделитель
			$result.="<div name='div_delimiter'></div>\n";
			
			//Фон ячеек сброса
			$result.="<div name='div_bg_cell_null'></div>\n";
			
			//Кнопка сброса фишек
			// $id_but_reset_chip="id_but_reset_chip";
			// $result.="<div name='div_but_reset_chip'>\n";
				// $result.="<button id='{$id_but_reset_chip}'></button>\n";
				// Обработчик
				// unset($tmp_ar_param_1);
				// $tmp_ar_param_1['id_event']="7";
				// $tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_but_reset_chip}";
				// $result.=n61_event_general::get_event($tmp_ar_param_1);
			// $result.="</div>\n";
			
			//Блоки сброшенных фишек
				
				//Получаем кол-во фишек с нулевой позицией
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['ar_chip']=$ar_chip;
				$ar_sum_null_pos=n61_game_2::get_sum_null_pos($tmp_ar_param_1);
				
				//Белые
				$id_div_null_pos="id_div_null_pos_white";
				$result.="<div name='div_null_pos_white' id='{$id_div_null_pos}'>\n";
					for ($i=0;$i<$ar_sum_null_pos['white'];$i++)
						{
						$result.="<div name='div_null_pos_white_chip'></div>\n";
						}
				$result.="</div>\n";
					
					//Обработчик клика
					unset($tmp_ar_param_1);
					$tmp_ar_param_1['id_event']="7";
					$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_div_null_pos}";
					$result.=n61_event_general::get_event($tmp_ar_param_1);
				
				//Черные
				$id_div_null_pos="id_div_null_pos_black";
				$result.="<div name='div_null_pos_black' id='{$id_div_null_pos}'>\n";
					for ($i=0;$i<$ar_sum_null_pos['black'];$i++)
						{
						$result.="<div name='div_null_pos_black_chip'></div>\n";
						}
				$result.="</div>\n";
				
					//Обработчик клика
					unset($tmp_ar_param_1);
					$tmp_ar_param_1['id_event']="7";
					$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_div_null_pos}";
					$result.=n61_event_general::get_event($tmp_ar_param_1);
				
				
			//Позиции 1-12 Начало
			$result.="<div name='up_pos'>\n";
						
				for ($i=1;$i<=12;$i++)
					{
					unset($tmp_ar_param_1);
					$tmp_ar_param_1['num']=13-$i;
					$tmp_ar_param_1['ar_chip']=$ar_chip;
					$tmp_ar_param_1['position_cell']="up";
					$result.=n61_game_1::load_cell_with_chip($tmp_ar_param_1);
					}
							
			//Позиции 1-12 Конец
			$result.="</div>\n";
			
			//Верхние направляющие НАЧАЛО
			$result.="<div name='up_pos_guide'>\n";
				for ($i=0;$i<12;$i++)
					{
					//Направляющая
					$result.="<div name='guide'></div>\n";
					}
			//Верхние направляющие КОНЕЦ
			$result.="</div>\n";
						
						
			//Позиции 13-24 Начало
			$result.="<div name='down_pos'>\n";
						
				for ($i=1;$i<=12;$i++)
					{
					unset($tmp_ar_param_1);
					$tmp_ar_param_1['num']=12+$i;
					$tmp_ar_param_1['ar_chip']=$ar_chip;
					$tmp_ar_param_1['position_cell']="down";
					$result.=n61_game_1::load_cell_with_chip($tmp_ar_param_1);
					}
						
			//Позиции 13-24 Конец
			$result.="</div>\n";
			
			//Нижние направляющие НАЧАЛО
			$result.="<div name='down_pos_guide'>\n";
				for ($i=0;$i<12;$i++)
					{
					//Направляющая
					$result.="<div name='guide'></div>\n";
					}
			//Нижние направляющие КОНЕЦ
			$result.="</div>\n";
			
			return $result;
			}
			
		}

	
?>