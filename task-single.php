<?php
    $id = $_POST['id'];
    include('database.php');
    $query = "SELECT * FROM tareas Where id= $id";
    $result = mysqli_query($conexion, $query);
    
    if(!$result){
        die('Query Failed');
    }
    
    //Crea una variable json para enviarle los datos al frontend
    //recuerda que json, es un arreglo que contiene claves y valores
    //Éste formato le gusta al frontend para hacer cosas con esos valores
    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[]= array(
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
        );
    }
    
     $jsonstring = json_encode($json[0]);
     echo $jsonstring;
?>