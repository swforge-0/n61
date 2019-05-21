<?php
	//Игровые моменты 1
	
	class n61_game_1
		{
		//Установка параметров нового игрока
		public static function set_param_new_player($ar_param)
			{
			//Устанавливаем новый хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::gener_hash_code($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			n61_hash_code::set_hash_code($tmp_ar_param_1);
			//Устанавливаем тип игры
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="type_game";
			$tmp_ar_param_1['param_value']="new";
			n61_temp_data::set_data($tmp_ar_param_1);
			//Пока по умолчанию ставим тип противника ИИ
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="type_opponent";
			$tmp_ar_param_1['param_value']="ii";
			n61_temp_data::set_data($tmp_ar_param_1);
			//Пока по умолчанию ставим black цвет ИИ
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="player_ii";
			$tmp_ar_param_1['param_value']="black";
			n61_temp_data::set_data($tmp_ar_param_1);
			}
			
		//Управление игровым процессом
		public static function load_game_process($ar_param)
			{
			//Кнопка Завершить ход
			$result.="<div name='but_transfer_move'>\n";
				$id_dom_elem="id_but_transfer_move";
				$result.="<input type='button' value='Завершить ход' id='{$id_dom_elem}'>\n";
				// Событие
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['id_event']="6";
				$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem}";
				$result.=n61_event_general::get_event($tmp_ar_param_1);
			$result.="</div>\n";
			
			return $result;
			}
			
		//Кости
		public static function load_game_dice($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
				
			//Получаем значение костей
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="dice_value";
			$json_dice_value=n61_temp_data::get_data($tmp_ar_param_1);
			
			$ar_dice_value=n61_other::json2array($json_dice_value);
			
			if ($ar_dice_value[1]=="")
				{
				$ar_dice_value[1]="0";
				}
				
			if ($ar_dice_value[2]=="")
				{
				$ar_dice_value[2]="0";
				}
				
			//Блок с костями
			$result.="<div name='dice'>\n";
				//Кость 1
				$result.="<div name='dice_1' class='n61_dice_num_{$ar_dice_value[1]}'>\n";
					// $result.=$ar_dice_value[1];
				$result.="</div>\n";
				
				//Кость 2
				$result.="<div name='dice_2' class='n61_dice_num_{$ar_dice_value[2]}'>\n";
					// $result.=$ar_dice_value[2];
				$result.="</div>\n";
				
			$result.="</div>\n";
			
			//Кнопка броска
			$result.="<div name='but_roll_dice'>\n";
				$id_dom_elem="id_but_roll_dice";
				$result.="<input type='button' value='Бросить кости' id='{$id_dom_elem}'>\n";
				//Событие
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['id_event']="5";
				$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem}";
				$result.=n61_event_general::get_event($tmp_ar_param_1);
			$result.="</div>\n";
			
			return $result;
			}
			
		//Выгрузка ячеек с фишками на доску
		public static function load_cell_with_chip($ar_param)
			{
			$id_dom_elem="n61_cell_".$ar_param['num'];
			$id_dom_elem_cap_cell="n61_cell_cap_".$ar_param['num'];
			$id_dom_elem_cutout_cell="n61_cell_cutout_".$ar_param['num'];
			$id_dom_elem_dop_cap_cell="n61_cell_dop_cap_".$ar_param['num'];
			
			$nal_dop_cap=0; //Наличие дополнительной кнопки для клика сверху стопки
			
			$result.="<div name='cell' id='{$id_dom_elem}'>\n";
			
									
				//Определяем фишки на данной ячейке
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['num']=$ar_param['num'];
				$tmp_ar_param_1['ar_chip']=$ar_param['ar_chip'];
				$ar_chip_game=n61_game_2::get_chip_cell($tmp_ar_param_1);
						
				//Надпись ячейки
				$result.="<div name='div_cap_cell_{$ar_param['position_cell']}' id='{$id_dom_elem_cap_cell}'>";
				
					//Блок выреза в ячейке
					$result.="<div name='div_cutout_cell_{$ar_param['position_cell']}' id='{$id_dom_elem_cutout_cell}'></div>\n";
					
				$result.="</div>\n";
						
				//Выгружаем фишки в ячейку
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['num']=$ar_param['num'];
				$tmp_ar_param_1['ar_chip_game']=$ar_chip_game;
				$old_result=$result;
				$result.=n61_game_2::load_chip_cell($tmp_ar_param_1);
				
				if ($old_result!=$result)
					{
					//В ячейке есть фишки - необходимо ставить дополнительный блок для клика сверху стопки
					$nal_dop_cap=1;
					}
				
				//Дополнительный блок после фишек для возможности клика сверху стопки
				if ($nal_dop_cap==1)
					{
					$result.="<div name='div_dop_cap_cell_{$ar_param['position_cell']}' id='{$id_dom_elem_dop_cap_cell}'></div>\n";
					}
				
				//Событие клика на ячейку
				// unset($tmp_ar_param_1);
				// $tmp_ar_param_1['id_event']="2";
				// $tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem}";
				// $tmp_ar_param_1['ar_param_event']['code_cell']="{$ar_param['num']}";
				// $result.=n61_event_general::get_event($tmp_ar_param_1);
				
				//Событие клика на надписи ячейки
				// unset($tmp_ar_param_1);
				// $tmp_ar_param_1['id_event']="2";
				// $tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem_cap_cell}";
				// $tmp_ar_param_1['ar_param_event']['code_cell']="{$ar_param['num']}";
				// $result.=n61_event_general::get_event($tmp_ar_param_1);
				
				//Событие клика на вырезе ячейки
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['id_event']="2";
				$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem_cutout_cell}";
				$tmp_ar_param_1['ar_param_event']['code_cell']="{$ar_param['num']}";
				$result.=n61_event_general::get_event($tmp_ar_param_1);
				
				//Событие клика на дополнительном блоке сверху стопки
				if ($nal_dop_cap==1)
					{
					unset($tmp_ar_param_1);
					$tmp_ar_param_1['id_event']="2";
					$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem_dop_cap_cell}";
					$tmp_ar_param_1['ar_param_event']['code_cell']="{$ar_param['num']}";
					$result.=n61_event_general::get_event($tmp_ar_param_1);
					}
						
			$result.="</div>\n";
				
			return $result;
			}
		}

	
?>