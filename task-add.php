<?php
include('database.php');
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $description = $_POST['descriptcion'];
    
    $query = "INSERT into tareas(name, description) VALUES ('$name','$description')";
    $result = mysqli_query($conexion, $query);
    
    if(!$result){
        die('la consulta ha fallado');
    }
    echo 'Tarea agregada satisfactoriamente';
}

?>