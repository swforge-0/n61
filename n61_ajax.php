<?php
	//Нарды 61 Обработчик AJAX-запросов
	
	//Инициализация
	include("ini/ini.php");
		
	//Инициализируем php-библиотеки
	ini_lib("lib/php/", "php");
	
	//Скидывание фишек
	if ($_POST['mode']=="reset_chip")
		{
		$data=$_POST['data'];
		
		//Скидываем фишку
		n61_game_execute_1::reset_chip($data);
		
		//Получаем обновленную доску
		unset($tmp_ar_param_1);
		$result=n61_general::get_board_content($tmp_ar_param_1);
		
		echo $result;
		}
	
	//Ход компьютерного игрока
	if ($_POST['mode']=="ii_move")
		{
		$data=$_POST['data'];
		
		//Совершаем ход ИИ
		$result=n61_ii_general::ii_move($data);
		
		echo $result;
		}
	
	//Передать ход
	if ($_POST['mode']=="transfer_move")
		{
		$data=$_POST['data'];
		
		//Передаем ход
		n61_game_execute_1::transfer_move($data);
		
		//Проверяем ходит ли компьютер
		unset($tmp_ar_param_1);
		$result=n61_ii_general::test_ii_move($tmp_ar_param_1);
		
		if ($result!="1")
			{
			//Получаем обновленную доску
			unset($tmp_ar_param_1);
			$result=n61_general::get_board_content($tmp_ar_param_1);
			}
		
		echo $result;
		}
	
	//Бросить кости
	if ($_POST['mode']=="roll_dice")
		{
		$data=$_POST['data'];
		
		//Бросаем кости
		n61_game_execute_1::roll_dice($data);
		
		//Получаем содержимое блока костей
		unset($tmp_ar_param_1);
		$result=n61_game_1::load_game_dice($tmp_ar_param_1);
		
		echo $result;
		}
	
	//Новая игра
	if ($_POST['mode']=="start_new_game")
		{
		$data=$_POST['data'];
		
		//Начинаем новую игру
		n61_game_execute_1::start_new_game($data);
		
		echo $result;
		}
	
	//Выделение (Снятие выделения) фишки
	if ($_POST['mode']=="select_unselect_chip")
		{
		$data=$_POST['data'];
		
		//Выделяем фишку
		n61_game_execute_1::select_unselect_chip($data);
		
		//Получаем обновленную доску
		unset($tmp_ar_param_1);
		$result=n61_general::get_board_content($tmp_ar_param_1);
		
		echo $result;
		}
		
	//Перемещение выделенной фишки
	if ($_POST['mode']=="chip_go_cell")
		{
		$data=$_POST['data'];
		
		//Перемещаем фишку
		n61_game_execute_1::chip_go_cell($data);
		
		//Получаем обновленную доску
		unset($tmp_ar_param_1);
		$result=n61_general::get_board_content($tmp_ar_param_1);
		
		echo $result;
		}
	
?>