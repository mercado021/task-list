<?php
include('database.php');

$search = $_POST['search'];

 if(!empty($search)){
     $query = "SELECT * from tareas WHERE name Like '$search%'";
     $result = mysqli_query($conexion, $query);
     if(!$result){
         die('Query Error' . mysqli_error($conexion));
     }
     
     //para JavaScript se necesita regresar un archivo json
     //por lo tanto la siguiente parte es para crear la variable con el formato json
     $jason = array();
     while($row = mysqli_fetch_array($result)) {
         $jason[] = array(
             'name'=> $row['name'],
             'description'=> $row['description'],
             'id'=> $row['id']
         );
    }
     $jsonstring = json_encode($jason);
     //el siguiente echo es la respuesta que se manda al frontend
     echo $jsonstring;
 }


?>