<?php
	//ИИ Главный
	
	class n61_ii_general
		{	
		//Ход ИИ
		public static function ii_move($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);	
			
			//Получаем текущий массив фишек
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="ar_chip";
			$ar_chip_json=n61_temp_data::get_data($tmp_ar_param_1);
				
			$ar_chip=n61_other::json2array($ar_chip_json);
			
			//Получаем компьютерного игрока
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="player_ii";
			$player_ii=n61_temp_data::get_data($tmp_ar_param_1);
			
			//Получаем значение костей
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="dice_value";
			$ar_json_dice=n61_temp_data::get_data($tmp_ar_param_1);
			
			$ar_dice=n61_other::json2array($ar_json_dice);
			
			//Ход по алгоритмам
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['ar_chip']=$ar_chip;
			$tmp_ar_param_1['ar_dice']=$ar_dice;
			$tmp_ar_param_1['player_ii']=$player_ii;
			$ar_result_move=n61_ii_1::ii_move($tmp_ar_param_1);
			
			$ar_chip_json=json_encode($ar_result_move['ar_chip']);
			
			//Обнровляем массив фишек
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="ar_chip";
			$tmp_ar_param_1['param_value']=$ar_chip_json;
			n61_temp_data::set_data($tmp_ar_param_1);
			
			return $ar_result_move['double_move'];
			}
		
		//Проверяем ходит ли ИИ
		public static function test_ii_move($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
				
			//Проверяем тип оппонента
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="type_opponent";
			$type_opponent=n61_temp_data::get_data($tmp_ar_param_1);
			
			if ($type_opponent=="ii")
				{
				//Определяем кто ходит
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="player_ii";
				$player_ii=n61_temp_data::get_data($tmp_ar_param_1);
				
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="player_now_move";
				$player_now_move=n61_temp_data::get_data($tmp_ar_param_1);
				
				if ($player_now_move==$player_ii)
					{
					$result="1";	
					}
				else
					{
					$result="0";
					}
				
				}
				
			return $result;
			}
		}

	
?>