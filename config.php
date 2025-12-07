<?php
//kasutame kohalik arvuti
/*$serverinimi='localhost';
$kasutajanimi='oleksandraryshniak';
$parool='789poli76';
$andmebaasinimi='oleksandraryshniak';
$connect=new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaasinimi);
$connect->set_charset("utf8");*/

//zone.ee
$serverinimi = 'd141141.mysql.zonevs.eu';
$kasutajanimi = 'd141141_oleksandraryshniak';
$parool = '789poli76_105';
$andmebaasinimi = 'd141141_baasphp';
$connect = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaasinimi);
$connect->set_charset("utf8");