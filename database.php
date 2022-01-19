<?php

$conexion = mysqli_connect(
    'localhost',
    'root',
    'sys73xrv',
    'task-app'
);

if(!$conexion){
    echo "Database is not  connected";
}
?>