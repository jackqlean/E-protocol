<?php

require_once("../config/init.php");

$sql_query = mysqli_query($link,"SELECT cod FROM proc ORDER BY cod DESC");

$lcod = mysqli_fetch_array($sql_query);

$cod = $lcod["cod"];

echo "Código: <h1>".$cod. "</h1>"; 

?>
