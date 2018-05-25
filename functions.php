<?php
$link = mysqli_connect('localhost', 'root', '', 'parser');
if(mysqli_errno($link)) die('Ошибка подключения к БД!');
//получаем все записи

	
	$sql = 'SELECT id, title, price, image, color, diametr FROM diski ORDER BY '  . $sorting . ' ';
	$res = mysqli_query($link, $sql);
    if($res) {
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $rows;
    }else{
        echo 'Ой, что - то пошло не так!';
    }


?>