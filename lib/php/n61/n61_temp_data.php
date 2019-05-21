<?php
	//Таблицы временных данных
	
	//Класс 1
	class n61_temp_data
		{
		//Получение данных из временной таблицы
		public static function get_data($ar_param)
			{
			$sql_text="SELECT * FROM n61_temp_data WHERE hash_code='{$ar_param['hash_code']}' AND param_name='{$ar_param['param_name']}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			$sql_result=$sql_sql->fetch(PDO::FETCH_OBJ);
			
			$result=$sql_result->param_value;
			
			return $result;
			}
			
		//Запись данных во временную таблицу
		public static function set_data($ar_param)
			{
			//Проверяем наличие данного параметра
			$sql_text="SELECT * FROM n61_temp_data WHERE hash_code='{$ar_param['hash_code']}' AND param_name='{$ar_param['param_name']}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			
			if ($sql_sql->rowCount()>0)
				{
				//Обновляем запись
				$sql_text="UPDATE n61_temp_data SET param_value='{$ar_param['param_value']}' WHERE hash_code='{$ar_param['hash_code']}' AND param_name='{$ar_param['param_name']}'";
				$sql_sql=DBH::prepare($sql_text);
				$sql_sql->execute();
				}
			else
				{
				//Добавляем запись
				$sql_text="INSERT INTO n61_temp_data(hash_code,param_name,param_value) VALUES('{$ar_param['hash_code']}','{$ar_param['param_name']}','{$ar_param['param_value']}')";
				$sql_sql=DBH::prepare($sql_text);
				$sql_sql->execute();
				}
			}
		}
		
	//Хэш-код
	class n61_hash_code
		{	
		//Проверяем наличие хэш-кода в таблице
		public static function test_hash_code($ar_param)
			{
			$sql_text="SELECT * FROM n61_temp_data WHERE hash_code='{$ar_param['hash_code']}'";
			$sql_sql=DBH::prepare($sql_text);
			$sql_sql->execute();
			if ($sql_sql->rowCount()>0)
				{
				$result="1";
				}
			else
				{
				$result="0";
				}
				
			return $result;
			}
		
		//Установка текущего хэш-кода
		public static function set_hash_code($ar_param)
			{
			setcookie('n61_hash_code',$ar_param['hash_code'],time()+ 22896000,'/');
			//Сразу изменяем супрглобальный массив кук для мгновенного срабатывания
			$_COOKIE['n61_hash_code']=$ar_param['hash_code'];
			}
		
		//Получение текущего хэш-кода
		public static function get_hash_code($ar_param)
			{
			$result=$_COOKIE['n61_hash_code'];
			
			return $result;
			}
		
		//Генерация хэш-кода
		public static function gener_hash_code($ar_param)
			{
			$tmp_hash="";
			for ($i=0;$i<10;$i++)
				{
				$r_1=rand(1000,9999);
				$r_2=rand(10000,99999);
				$r_3=rand($r_1,$r_2);
				$tmp_hash.=$r_1.$r_2.$r_3;
				$tmp_hash=md5($tmp_hash);
				}
			
			$dt=date("dmYHis");
			
			$hash=$tmp_hash.$dt;
			
			$result=md5($hash);
			
			return $result;
			}
		}
	
?>