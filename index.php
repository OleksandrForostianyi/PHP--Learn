<!DOCTYPE HTML>
<html lang="ru">
<head>
	<meta charset = "UTF-8">
</head>
<body>
	<h1>Калькулятор</h1>
	<form action='' method='post'>
		<input type="text" name="num1" placeholder="0">
		
		<input type='radio' value='+' name="operator">+
		<input type='radio' value='-' name="operator">-
		<input type='radio' value='*' name="operator">*
		<input type='radio' value='/' name="operator">/

		<input type="text" name="num2" placeholder="0">
		<input type="submit" name="submit" value="Вычислить"> 
	</form>
</body>
</html>

<?php
	if(isset($_POST['submit']))
	{
		$a = $_POST['num1'];
		$b = $_POST['num2'];
		$operator = $_POST['operator'];
		$f = fopen("result.txt", "a"); 
		
		if(!$operator || (!$a && $a != '0') || (!$b && $b != '0')) 
			$error = 'Не все поля заполнены';

		else 
		{
			if(!is_numeric($a) || !is_numeric($b))
				$error = "Операнды должны быть числами";

			else 
			switch($operator)
			{
				case '+':
					$res = $a + $b;
					break;
				case '-':
					$res = $a - $b;
					break;
				case '*':
					$res = $a * $b;
					break;
				case '/':
					if( $b == '0')
						$error = "На ноль делить нельзя!";
					else
					   $res = $a / $b;
					break;    
			}
		}
		if(isset($error))
		{
			echo "<div class='error-text'>Ошибка: $error</div>";
		}	
		else 
		{
			echo "<div class='answer-text'>Ответ: $res</div>";
			$stroka = $a . "$operator" . $b . "=" . $res . PHP_EOL;
			fwrite($f, $stroka);
		}
		
		echo "<div class='history'>История: </div>";
		echo readfile("result.txt");
		
		fclose($f);
	}
?>