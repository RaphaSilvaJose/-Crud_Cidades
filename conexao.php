<?php
define("DB_SERVER", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "crudsimples");

$conexao = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE) or die ('Não foi possivel conectar');;
