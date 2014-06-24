<?php
session_start();
define('INC', TRUE); /* По този начин дефинираме константа.
 * Константите са като променливи с тази разлика, че могат да съдържат САМО
 * int, float, string, bool. Ако искате да вземете стойността на дефинирана
 * константа просто изписвате името и (без долар за разлика от променливите).
 * Например: echo INC;
 * 
 * Вижте коментара в includes/mysqli.php, за да разберете защо дефинираме тази
 * константа.
 */

$title = 'Начало';
include './includes/header.php';
include './includes/menu.php';
?>
<div id="container">
	<h1 class="center-text">Начало:</h1>
	<hr>
	<?php
	include './includes/mysqli.php'; //Трябва ни връзка с БД (базата данни), за да изкараме списък с новините
	$query = mysqli_query($connection, 'SELECT id,title FROM `news` ORDER BY `id` DESC LIMIT 0,10');
	/*
	 * Заявката тук включва 2 нови неща - ORDER BY и LIMIT
	 * ORDER BY - подрежда резултатите по стойността на дадено поле - ако полето е INT
	 * ще ги подреди по покачване (ASC) или понижаване (DESC) на стойността.
	 * Ако избраното поле е текстово ще го подреди по азбучен ред, дължина и т.н.
	 * Синтаксиса на ORDER BY е: ORDER BY `поле` ASC/DESC
	 * В конкретния случай заявката ще върне последните новини (DESC)
	 * ------------------------------
	 * LIMIT - колко резултата да върне заявката
	 * Приема 2 числени аргумента. Първият е колко записа след първия да започне,
	 * а втория е колко записа да вземе.
	 * Синтаксиса на LIMIT е: LIMIT число, число
	 * В конкретния случай заявката ще започне от първия резултат и ще вземе
	 * общо 10 резултата.
	 */
	if (!$query) { //Проверяваме дали заявката е успешна
		echo 'MySQL грешка: ' . mysqli_error($connection); //Ако не е показваме грешка
	} else {
		if(mysqli_num_rows($query) > 0) { //Проверяваме дали има някакви върнати новини от заявката
			echo '<h3>Последни новини:</h3>';
			$i=1;
			while($row = mysqli_fetch_assoc($query)) { //Итерираме през всички резултати, като запазваме данните в променливата $row
				echo $i.'. <a href="./view.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a><br>'; //Показваме данните на потребителя
				$i++;
			}
		} else { //Ако няма - уведомяваме потребителя
			echo 'Все още няма добавени новини.';
		}
	}
	?>
</div>
<?php
include './includes/footer.php';
?>