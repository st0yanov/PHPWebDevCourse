<?php
/*
 * Тъй като ни се налага да се свързваме с MySQL сървъра и базата данни
 * на много места в приложението, затова създаваме 1 централен файл
 * който ще include-ваме във всеки файл, който има нужда да използва база данни.
 */

if(!defined('INC')) exit; /* Този ред извършва проверка дали има дефинирана
 * константа "INC" и ако няма спира изпълнението на кода. Това се прави с цел
 * файлът да не изпълнява логиката си ако се отваря на потребители,
 * които например се опитат да се свържат с http://localhost/NewsSystem/includes/mysqli.php.
 * 
 * Иначе казано логиката е следната - в index.php например дефинираме тази
 * константа "INC". След това include-ваме този файл и той ще се свърже с MySQL.
 * Но ако потребител влезе директно в този файл през браузъра няма как по
 * никакъв начин да е дефинирана константата "INC" и кода няма да се изпълни
 * надолу, защото има exit;
 */

//MySQL данни
$mysqli_host = 'localhost';		//Хост
$mysqli_user = 'root';			//Потребител
$mysqli_password = '';			//Парола
$mysqli_database = 'news';		//База от данни

$connection = mysqli_connect($mysqli_host, $mysqli_user, $mysqli_password, $mysqli_database); //Установяваме връзка по посочените данни
if(!$connection) { //Ако няма връзка
	echo 'MySQL грешка: '.  mysqli_connect_error(); //Показваме грешка
	exit; //И спираме изпълнението на кода
}

mysqli_set_charset($connection, 'utf8'); //Ще работим с UTF-8
?>