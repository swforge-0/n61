<?php
	//Игровой процесс 1
	
	class n61_game_execute_1
		{
		//Скинуть фишку
		public static function reset_chip($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
				
			//Получаем текущую выделнную фишку
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="selected_chip";
			$selected_chip=n61_temp_data::get_data($tmp_ar_param_1);
			
			//Проверяем выделение фишки
			if ($selected_chip!="")
				{
				//Определяем цвет необходимых фишек
				$tmp_ar_ex_1=explode("_", $selected_chip);
				if ($tmp_ar_ex_1[0]=="w")
					{
					$code_chip="white";
					}
				if ($tmp_ar_ex_1[0]=="b")
					{
					$code_chip="black";
					}
					
				//Получаем текущий массив фишек
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="ar_chip";
				$ar_chip_json=n61_temp_data::get_data($tmp_ar_param_1);
				
				$ar_chip=n61_other::json2array($ar_chip_json);
				
				//Устанавливаем позицию 0 для выделенной фишки
				for ($i=0;$i<count($ar_chip[$code_chip]);$i++)
					{
					if ($selected_chip==$ar_chip[$code_chip][$i+1]['code'])
						{
						$ar_chip[$code_chip][$i+1]['position']="0";
						}
					}
					
				//Записываем измененный массив
				$ar_chip_json=json_encode($ar_chip);
				
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="ar_chip";
				$tmp_ar_param_1['param_value']=$ar_chip_json;
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Удаляем выделенную фишку
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="selected_chip";
				$tmp_ar_param_1['param_value']="";
				n61_temp_data::set_data($tmp_ar_param_1);
				}
			
			}
			
		//Передать ход
		public static function transfer_move($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
			
			//Массив передачи
			$ar_player['white']="black";
			$ar_player['black']="white";
			
			//Получаем текущего ходячего
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="player_now_move";
			$player_now_move=n61_temp_data::get_data($tmp_ar_param_1);
			
			//Устанавливаем нового ходячего
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="player_now_move";
			$tmp_ar_param_1['param_value']=$ar_player[$player_now_move];
			n61_temp_data::set_data($tmp_ar_param_1);
			
			return $result;
			}
			
		//Бросить кости
		public static function roll_dice($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
				
			//Генерируем кости
			for ($i=1;$i<=2;$i++)
				{
				$rnd=rand(1,6);
				$ar_dice[$i]="{$rnd}";
				}
			
			$json_dice=json_encode($ar_dice);
			
			//Обновляем значение костей
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="dice_value";
			$tmp_ar_param_1['param_value']=$json_dice;
			n61_temp_data::set_data($tmp_ar_param_1);
			}
			
		//Новая игра
		public static function start_new_game($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
			
			//Устанавливаем признак новой игры
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="type_game";
			$tmp_ar_param_1['param_value']="new";
			n61_temp_data::set_data($tmp_ar_param_1);
			
			//Устанавливаем тип соперника
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="type_opponent";
			$tmp_ar_param_1['param_value']=$ar_param['type_opponent'];
			n61_temp_data::set_data($tmp_ar_param_1);
			}
			
		//Выделение, снятие выделения фишки
		public static function select_unselect_chip($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
			
			//Получаем текущую выделнную фишку
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="selected_chip";
			$selected_chip=n61_temp_data::get_data($tmp_ar_param_1);
			
			//Если кликнули по выделенной - Отменим выделение
			if ($selected_chip==$ar_param['code_chip'])
				{
				$new_selected_chip="";
				}
			else
				{
				$new_selected_chip=$ar_param['code_chip'];
				}
			
			//Устанавливаем выделенную фишку
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="selected_chip";
			$tmp_ar_param_1['param_value']=$new_selected_chip;
			n61_temp_data::set_data($tmp_ar_param_1);
			}
			
		//Перемещение фишки
		public static function chip_go_cell($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
			
			//Получаем текущую выделнную фишку
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="selected_chip";
			$selected_chip=n61_temp_data::get_data($tmp_ar_param_1);
			
			if ($selected_chip!="")
				{
				//Получаем текущий массив фишек
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="ar_chip";
				$ar_chip_json=n61_temp_data::get_data($tmp_ar_param_1);
				
				$ar_chip=n61_other::json2array($ar_chip_json);
				
				//Изменяем положение выделенной фишки
				foreach($ar_chip AS $key=>$value)
					{
					for ($j=0;$j<count($ar_chip[$key]);$j++)
						{
						if ($ar_chip[$key][$j+1]['code']==$selected_chip)
							{
							$ar_chip[$key][$j+1]['position']=$ar_param['code_cell'];
							}
						}
					}
					
				//Записываем измененный массив
				$ar_chip_json=json_encode($ar_chip);
				
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="ar_chip";
				$tmp_ar_param_1['param_value']=$ar_chip_json;
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Снимаем выделение
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="selected_chip";
				$tmp_ar_param_1['param_value']="";
				n61_temp_data::set_data($tmp_ar_param_1);
				}
			}
			
		}
	
	
	
?>