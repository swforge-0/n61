<?php
	//Игровые моменты 2
	
	class n61_game_2
		{
		//Получение кол-ва фишек с нулевой позицией для черных и белых
		public static function get_sum_null_pos($ar_param)
			{
			$ar_chip=$ar_param['ar_chip'];
			
			foreach($ar_chip AS $key=>$value)
				{
				$ar_result[$key]=0;
				for ($i=0;$i<count($ar_chip[$key]);$i++)
					{
					if ((int)$ar_chip[$key][$i+1]['position']==0)
						{
						$ar_result[$key]++;
						}
					}
				}
				
			return $ar_result;
			}
			
		//Формирование массива фишек для игры
		public static function get_chip_position($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
				
			//Получаем тип игры
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="type_game";
			$type_game=n61_temp_data::get_data($tmp_ar_param_1);
			
			//Новая игра
			if ($type_game=="new")
				{
				for ($i=1;$i<=15;$i++)
					{
					$ar_chip['white'][$i]['position']="1";
					$ar_chip['white'][$i]['code']="w_".$i;
					$ar_chip['black'][$i]['position']="13";
					$ar_chip['black'][$i]['code']="b_".$i;
					}
					
				$ar_chip_json=json_encode($ar_chip);
					
				//Обновляем тип игры
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="type_game";
				$tmp_ar_param_1['param_value']="nonew";
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Обновляем массив фишек
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="ar_chip";
				$tmp_ar_param_1['param_value']=$ar_chip_json;
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Обнуляем выделенную фишку
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="selected_chip";
				$tmp_ar_param_1['param_value']="";
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Обнуляем кости
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="dice_value";
				$tmp_ar_param_1['param_value']="";
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Обновляем ходячего
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="player_now_move";
				$tmp_ar_param_1['param_value']="white";
				n61_temp_data::set_data($tmp_ar_param_1);
				
				//Обновляем ходили ли 2 раза с головы
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="head_move_2_count";
				$tmp_ar_param_1['param_value']="";
				n61_temp_data::set_data($tmp_ar_param_1);
				
				}
				
			//Продолжение игры
			if ($type_game=="nonew")
				{
				//Получаем массив фишек
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['hash_code']=$hash_code;
				$tmp_ar_param_1['param_name']="ar_chip";
				$ar_chip_json=n61_temp_data::get_data($tmp_ar_param_1);
				
				$ar_chip=n61_other::json2array($ar_chip_json);
				}
					
			return $ar_chip;
			}
			
		//Определение фишек в ячейке
		public static function get_chip_cell($ar_param)
			{
			//Получаем хэш-код
			unset($tmp_ar_param_1);
			$hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
			
			//Получаем выделенную фишку
			unset($tmp_ar_param_1);
			$tmp_ar_param_1['hash_code']=$hash_code;
			$tmp_ar_param_1['param_name']="selected_chip";
			$selected_chip=n61_temp_data::get_data($tmp_ar_param_1);
				
			foreach($ar_param['ar_chip'] AS $key=>$value)
				{
				for ($j=0;$j<count($ar_param['ar_chip'][$key]);$j++)
					{
					if ($ar_param['ar_chip'][$key][$j+1]['position']==$ar_param['num'])
						{
						$sch_1=count($ar_chip_game[$ar_param['num']]);
						$ar_chip_game[$ar_param['num']][$sch_1]['code']=$ar_param['ar_chip'][$key][$j+1]['code'];
						$ar_chip_game[$ar_param['num']][$sch_1]['class_color']=$key;
						//Проверяем выделение фишки
						if ($ar_param['ar_chip'][$key][$j+1]['code']==$selected_chip)
							{
							$ar_chip_game[$ar_param['num']][$sch_1]['selected']="yes";
							}
						}
					}
				}
				
			return $ar_chip_game;
			}
			
		//Выгрузка фишек в ячейку
		public static function load_chip_cell($ar_param)
			{
			for ($j=0;$j<count($ar_param['ar_chip_game'][$ar_param['num']]);$j++)
				{
				//Фишка
				$code_chip=$ar_param['ar_chip_game'][$ar_param['num']][$j]['code'];
				$id_dom_elem="n61_chip_".$code_chip;
				
				//Дополнительные классы
					$tmp_dop_class="";
					//Выделенная фишка
						if ($ar_param['ar_chip_game'][$ar_param['num']][$j]['selected']=="yes")
							{
							$tmp_dop_class.=" n61_selected_chip";
							unset($tmp_ar_ex_1);
							$tmp_ar_ex_1=explode("_",$ar_param['ar_chip_game'][$ar_param['num']][$j]['code']);
							$tmp_dop_class.="_".$tmp_ar_ex_1[0];
							}
				
				$result.="<div name='cell_chip' class='n61_{$ar_param['ar_chip_game'][$ar_param['num']][$j]['class_color']}_chip{$tmp_dop_class}' id='{$id_dom_elem}'>\n";
					// $result.="{$ar_param['ar_chip_game'][$ar_param['num']][$j]['code']}";
				$result.="</div>\n";
				
				//Событие
				unset($tmp_ar_param_1);
				$tmp_ar_param_1['id_event']="1";
				$tmp_ar_param_1['ar_param_event']['event_obj_1']="{$id_dom_elem}";
				$tmp_ar_param_1['ar_param_event']['code_chip']="{$code_chip}";
				$result.=n61_event_general::get_event($tmp_ar_param_1);
				}
				
			return $result;
			}
		}

	
?>