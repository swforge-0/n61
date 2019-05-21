<?php
	//ИИ 2
	
	class n61_ii_2
		{
		//Тестирование "Все ли фишки дома"
		public static function test_all_chip_in_home($ar_param)
			{		
			$ar_chip=$ar_param['ar_chip'][$ar_param['player_ii']];
			
			//Погнали по массиву
			$test_home="1";
			foreach ($ar_chip AS $key=>$value)
				{
				if ($value['position']<19 AND $value['position']!=0)
					{
					$test_home="0";
					}
				}
			
			if ($test_home=="1")
				{
				//Возращаем инфу о том что необходимо действовать по алгоритмам сброса
				$result="move_reset";
				}
			else
				{
				//Иначе назначаем действие по алгоримам хода
				$result="move_normal";
				}
			
			return $result;
			}
			
		//Алгоритм сброса фишек
		public static function ii_move_reset($ar_param)
			{
			$ar_dice=$ar_param['ar_dice'];
			$ar_chip=$ar_param['ar_chip'];
			$player_ii=$ar_param['player_ii'];
			$ar_pos_close=$ar_param['ar_pos_close'];
			$all_max_pos=$ar_param['all_max_pos'];
			$head_move=$ar_param['head_move'];
			$max_head_move=$ar_param['max_head_move'];
			
			//Массив соответствия позиций костям
			$ar_position[6]=19;
			$ar_position[5]=20;
			$ar_position[4]=21;
			$ar_position[3]=22;
			$ar_position[2]=23;
			$ar_position[1]=24;
			
			//Получаем хэш-код
			// unset($tmp_ar_param_1);
			// $hash_code=n61_hash_code::get_hash_code($tmp_ar_param_1);
			
			// unset($tmp_ar_param_1);
			// $tmp_ar_param_1['hash_code']=$hash_code;
			// $tmp_ar_param_1['param_name']="tmp_test_12345";
			// $tmp_ar_param_1['param_value']=print_r($ar_chip[$player_ii],true);
			// n61_temp_data::set_data($tmp_ar_param_1);
			
			for ($i=1;$i<=count($ar_dice);$i++)
				{
				$test_move=0; //Совершение хода
				
				//Для начала поищем есть ли фишка в выпавшей позиции
				if ($test_move==0)
					{
					$tmp_test_1="0";
					for ($j=1;$j<=count($ar_chip[$player_ii]);$j++)
						{
						if ($tmp_test_1=="0")
							{
							if ($ar_chip[$player_ii][$j]['position']==$ar_position[$ar_dice[$i]])
								{
								//Сбрасываем эту фишку
								$tmp_test_1="1";
								$ar_chip[$player_ii][$j]['position']="0";
								}
							}
						}
					}
					
				//Если ход свершился - отмечаем
				if ($tmp_test_1=="1")
					{
					$test_move=1;
					}
				
				//Если хода до сих пор не было - поищем первую доступную для хода фишку
				if ($test_move==0)
					{
					$tmp_test_1="0";
					for ($j=1;$j<=count($ar_chip[$player_ii]);$j++)
						{
						if ($tmp_test_1=="0")
							{
							if (($ar_position[$ar_dice[$i]]+$ar_chip[$player_ii][$j]['position'])<=24 AND $ar_chip[$player_ii][$j]['position']!=0)
								{
								//Ходим этой фишкой
								$tmp_test_1="1";
								$ar_chip[$player_ii][$j]['position']=$ar_position[$ar_dice[$i]]+$ar_chip[$player_ii][$j]['position'];
								}
							}
						}
					}
					
				//Если ход свершился - отмечаем
				if ($tmp_test_1=="1")
					{
					$test_move=1;
					}
					
				//Если хода до сих пор не было - скинем максимально возможную фишку
				if ($test_move==0)
					{
					$tmp_test_1="0";
					for ($j=1;$j<=count($ar_chip[$player_ii]);$j++)
						{
						if ($tmp_test_1=="0")
							{
							if (($ar_position[$ar_dice[$i]]+$ar_chip[$player_ii][$j]['position'])>24 AND $ar_chip[$player_ii][$j]['position']!=0)
								{
								//Ходим этой фишкой
								$tmp_test_1="1";
								$ar_chip[$player_ii][$j]['position']=$ar_position[$ar_dice[$i]]+$ar_chip[$player_ii][$j]['position'];
								}
							}
						}
					}
					
				}
				
			$tmp_ar_result['ar_dice']=$ar_dice;
			$tmp_ar_result['ar_chip']=$ar_chip;
			$tmp_ar_result['player_ii']=$player_ii;
			$tmp_ar_result['ar_pos_close']=$ar_pos_close;
			$tmp_ar_result['all_max_pos']=$all_max_pos;
			$tmp_ar_result['head_move']=$head_move;
			$tmp_ar_result['max_head_move']=$max_head_move;
			
			return $tmp_ar_result;
			}
			
		//Алгоритм обыкновенного хода
		public static function ii_move_normal($ar_param)
			{
			$ar_dice=$ar_param['ar_dice'];
			$ar_chip=$ar_param['ar_chip'];
			$player_ii=$ar_param['player_ii'];
			$ar_pos_close=$ar_param['ar_pos_close'];
			$all_max_pos=$ar_param['all_max_pos'];
			$head_move=$ar_param['head_move'];
			$max_head_move=$ar_param['max_head_move'];
				
				
			for ($i=1;$i<=count($ar_dice);$i++)
				{
				$test_move=0; //Совершение хода
					
				//Проверяем 1
				if ($ar_dice[$i]==1)
					{
					for ($j=1;$j<=count($ar_chip[$player_ii]);$j++)
						{
						if ($test_move==0)
							{
							if ($ar_chip[$player_ii][$j]['position']==1)
								{
								$ar_chip[$player_ii][$j]['position']=24;
								$test_move=1;
								}
							}
						}
					}
						
				//Проверяем 6
				if ($ar_dice[$i]==6)
					{
					for ($j=1;$j<=count($ar_chip[$player_ii]);$j++)
						{
						if ($test_move==0)
							{
							if ($ar_chip[$player_ii][$j]['position']==1)
								{
								$ar_chip[$player_ii][$j]['position']=19;
								$test_move=1;
								}
							}
						}
					}
						
				//Если хода не было будем ходить максимально близкой к дому
					if ($test_move==0)
						{
						//Сортируем массив по убыванию позиций
						unset($tmp_ar_param_1);
						$tmp_ar_param_1['player_ii']=$player_ii;
						$tmp_ar_param_1['ar_chip']=$ar_chip;
						$ar_chip=n61_ii_2::sort_ar_chip_max_min($tmp_ar_param_1);
							
						//Пробуем сходить максимально близкой к 24 фишкой
						for ($j=1;$j<=count($ar_chip[$player_ii]);$j++)
							{
							if ($test_move==0 AND (int)$ar_chip[$player_ii][$j]['position']!=0)
								{
								//Временный ход
								$tmp_move=(int)$ar_chip[$player_ii][$j]['position']+(int)$ar_dice[$i];
									
								//Проверяем на закрытые позиции
								$test_pos_close=0;
								for ($k=0;$k<count($ar_pos_close);$k++)
									{
									if ($tmp_move==$ar_pos_close[$k])
										{
										$test_pos_close=1;
										}
									}
									
								//Проверяем на максимальную позицию
								if ($tmp_move>$all_max_pos)
									{
									$test_pos_close=1;
									}
										
								if ($test_pos_close==0)
									{
									//Проверяем ходим ли с головы
									if ((int)$ar_chip[$player_ii][$j]['position']==1)
										{
										//Проверям возможность хода с головы
										if ($head_move<$max_head_move)
											{
											//Ходим
											$ar_chip[$player_ii][$j]['position']=$tmp_move;
											//Увеличиваем кол-во ходов с головы
											$head_move++;
											//Фиксируем ход
											$test_move=1;
											}
										}
									else
										{
										//Ходим
										$ar_chip[$player_ii][$j]['position']=$tmp_move;
										//Фиксируем ход
										$test_move=1;
										}
									}
								}
							}
						}
					
					
				}
				
			$tmp_ar_result['ar_dice']=$ar_dice;
			$tmp_ar_result['ar_chip']=$ar_chip;
			$tmp_ar_result['player_ii']=$player_ii;
			$tmp_ar_result['ar_pos_close']=$ar_pos_close;
			$tmp_ar_result['all_max_pos']=$all_max_pos;
			$tmp_ar_result['head_move']=$head_move;
			$tmp_ar_result['max_head_move']=$max_head_move;
			
			return $tmp_ar_result;
			}
			
		//Сортировка массива по убыванию позиции фишки
		public static function sort_ar_chip_max_min($ar_param)
			{
			$player_ii=$ar_param['player_ii'];
			$ar_chip=$ar_param['ar_chip'];
			for ($i=1;$i<=count($ar_chip[$player_ii])-1;$i++)
				{
				for ($j=$i+1;$j<=count($ar_chip[$player_ii]);$j++)
					{
					if ((int)$ar_chip[$player_ii][$i]['position']<(int)$ar_chip[$player_ii][$j]['position'])
						{
						$buf=$ar_chip[$player_ii][$i];
						$ar_chip[$player_ii][$i]=$ar_chip[$player_ii][$j];
						$ar_chip[$player_ii][$j]=$buf;
						}
					}
				}
			return $ar_chip;
			}
		
		//Определение оппонента
		public static function get_opponent($ar_param)
			{
			if ($ar_param['player_ii']=='white')
				{
				$result='black';
				}
				
			if ($ar_param['player_ii']=='black')
				{
				$result='white';
				}
				
			return $result;
			}
		
		//Массив закрытых позиций
		public static function gener_ar_pos_close($ar_param)
			{
			$ar_chip=$ar_param['ar_chip'];
			$ar_pos_code=$ar_param['ar_pos_code'];
			$player_user=$ar_param['player_user'];
			
			$ar_pos_close[0]=7;
			$ar_pos_close[1]=12;
			
			for ($i=1;$i<=count($ar_chip[$player_user]);$i++)
				{
				$test_nal=0;
				for ($j=0;$j<count($ar_pos_close);$j++)
					{
					if ($ar_pos_close[$j]==$ar_pos_code[$ar_chip[$player_user][$i]['position']])
						{
						$test_nal=1;
						}
					}
				if ($test_nal==0)
					{
					$ar_pos_close[count($ar_pos_close)]=$ar_pos_code[$ar_chip[$player_user][$i]['position']];
					}
				}
				
			return $ar_pos_close;
			}
		
		//Кодирование массива позиций
		public static function code_ar_pos($ar_param)
			{
			$player_ii=$ar_param['player_ii'];
			
			$ar_pos['black'][13]=1;
			$ar_pos['black'][14]=2;
			$ar_pos['black'][15]=3;
			$ar_pos['black'][16]=4;
			$ar_pos['black'][17]=5;
			$ar_pos['black'][18]=6;
			$ar_pos['black'][19]=7;
			$ar_pos['black'][20]=8;
			$ar_pos['black'][21]=9;
			$ar_pos['black'][22]=10;
			$ar_pos['black'][23]=11;
			$ar_pos['black'][24]=12;
			$ar_pos['black'][1]=13;
			$ar_pos['black'][2]=14;
			$ar_pos['black'][3]=15;
			$ar_pos['black'][4]=16;
			$ar_pos['black'][5]=17;
			$ar_pos['black'][6]=18;
			$ar_pos['black'][7]=19;
			$ar_pos['black'][8]=20;
			$ar_pos['black'][9]=21;
			$ar_pos['black'][10]=22;
			$ar_pos['black'][11]=23;
			$ar_pos['black'][12]=24;
			
			for ($i=1;$i<=24;$i++)
				{
				$ar_pos['white'][$i]=$i;
				}
				
			return $ar_pos[$player_ii];
			}
			
		//Декодирование массива позиций
		public static function decode_ar_pos($ar_param)
			{
			$player_ii=$ar_param['player_ii'];
			
			$ar_pos['black'][1]=13;
			$ar_pos['black'][2]=14;
			$ar_pos['black'][3]=15;
			$ar_pos['black'][4]=16;
			$ar_pos['black'][5]=17;
			$ar_pos['black'][6]=18;
			$ar_pos['black'][7]=19;
			$ar_pos['black'][8]=20;
			$ar_pos['black'][9]=21;
			$ar_pos['black'][10]=22;
			$ar_pos['black'][11]=23;
			$ar_pos['black'][12]=24;
			$ar_pos['black'][13]=1;
			$ar_pos['black'][14]=2;
			$ar_pos['black'][15]=3;
			$ar_pos['black'][16]=4;
			$ar_pos['black'][17]=5;
			$ar_pos['black'][18]=6;
			$ar_pos['black'][19]=7;
			$ar_pos['black'][20]=8;
			$ar_pos['black'][21]=9;
			$ar_pos['black'][22]=10;
			$ar_pos['black'][23]=11;
			$ar_pos['black'][24]=12;
			
			for ($i=1;$i<=24;$i++)
				{
				$ar_pos['white'][$i]=$i;
				}
				
			return $ar_pos[$player_ii];
			}
		}

	
?>