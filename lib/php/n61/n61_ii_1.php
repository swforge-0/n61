<?php
	//ИИ 1
	
	class n61_ii_1
		{	
		//Ход ИИ по алгоритмам
		public static function ii_move($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
				
			$ar_chip=$ar_param['ar_chip'];
			$ar_dice=$ar_param['ar_dice'];
			
			//Проверка на дубль костей
			if ($ar_dice[1]==$ar_dice[2])
				{
				//Добавляем еще 2 хода
				$ar_dice[3]=$ar_dice[1];
				$ar_dice[4]=$ar_dice[1];
				}
				
			//Определяем игроков
			$player_ii=$ar_param['player_ii'];
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['player_ii']=$player_ii;
			$player_user=n61_ii_2::get_opponent($tmp_ar_param_1);
			
			//Массив позиций кодирование
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['player_ii']=$player_ii;
			$ar_pos_code=n61_ii_2::code_ar_pos($tmp_ar_param_1);
			
			//Массив позиций декодирование
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['player_ii']=$player_ii;
			$ar_pos_decode=n61_ii_2::decode_ar_pos($tmp_ar_param_1);
			
			//Массив закрытых позиций
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['player_user']=$player_user;
			$tmp_ar_param_1['ar_pos_code']=$ar_pos_code;
			$tmp_ar_param_1['ar_chip']=$ar_chip;
			$ar_pos_close=n61_ii_2::gener_ar_pos_close($tmp_ar_param_1);
			
			//Максимальная позиция
			$all_max_pos=24;
				
			//Кодируем массив фишек соответственно кодированным позициям
			for ($i=1;$i<=count($ar_chip[$player_ii]);$i++)
				{
				$ar_chip[$player_ii][$i]['position']=$ar_pos_code[$ar_chip[$player_ii][$i]['position']];
				}
				
			//Ходим всеми костями поочереди
				//Ходы с головы
				$head_move=0;
				//Определяем максимальное кол-во возмжных ходов с головы
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="head_move_2_count";
				$head_move_2_count=n61_temp_data::get_data($tmp_ar_param_1);
				if ($head_move_2=="yes")
					{
					$max_head_move=1;
					}
				else
					{
					$max_head_move=2;
					}
				
				//Проверяем - если все фишки в доме - тогда алгоритм сброса, если нет - алгоритм обыкновенного хода
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['ar_chip']=$ar_chip;
				$tmp_ar_param_1['player_ii']=$player_ii;
				$tmp_test_1=n61_ii_2::test_all_chip_in_home($tmp_ar_param_1);
				
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['ar_dice']=$ar_dice;
				$tmp_ar_param_1['ar_chip']=$ar_chip;
				$tmp_ar_param_1['player_ii']=$player_ii;
				$tmp_ar_param_1['ar_pos_close']=$ar_pos_close;
				$tmp_ar_param_1['all_max_pos']=$all_max_pos;
				$tmp_ar_param_1['head_move']=$head_move;
				$tmp_ar_param_1['max_head_move']=$max_head_move;
				
				//Обычный ход
				if ($tmp_test_1=="move_normal")
					{
					$tmp_result_move=n61_ii_2::ii_move_normal($tmp_ar_param_1);
					}
					
				//Сброс фишек
				if ($tmp_test_1=="move_reset")
					{
					$tmp_result_move=n61_ii_2::ii_move_reset($tmp_ar_param_1);
					}
				
				$ar_dice=$tmp_result_move['ar_dice'];
				$ar_chip=$tmp_result_move['ar_chip'];
				$player_ii=$tmp_result_move['player_ii'];
				$ar_pos_close=$tmp_result_move['ar_pos_close'];
				$all_max_pos=$tmp_result_move['all_max_pos'];
				$head_move=$tmp_result_move['head_move'];
				$max_head_move=$tmp_result_move['max_head_move'];
					
			//Если ходили с головы 2 раза - отмечаем, что в этой игре уже был такой ход
			if ($head_move==2)
				{
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="head_move_2_count";
				$tmp_ar_param_1['param_value']="yes";
				n61_temp_data::set_data($tmp_ar_param_1);
				}
			
			//Декодируем массив фишек соответственно декодированным позициям
			for ($i=1;$i<=count($ar_chip[$player_ii]);$i++)
				{
				$ar_chip[$player_ii][$i]['position']=$ar_pos_decode[$ar_chip[$player_ii][$i]['position']];
				}
			
			$ar_result_move['ar_chip']=$ar_chip;
			
			
			return $ar_result_move;
			}
			
		}

	
?>