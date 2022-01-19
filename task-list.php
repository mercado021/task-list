<?php
include('database.php');
$query = "SELECT * FROM tareas";
$result = mysqli_query($conexion, $query);

if(!$result){
    die('La consulta ha fallado '. mysqli_error($conexion));
}
else{
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'name'=> $row['name'],
            'descripcion' => $row['description'],
            'id' => $row['id']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
?>