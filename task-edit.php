<?php
 include('database.php');

 $id = $_POST['id'];
 $name = $_POST['name'];
 $description = $_POST['descriptcion'];

$query = "UPDATE tareas SET name = '$name', description = '$description' WHERE id ='$id' " ;

$result = mysqli_query($conexion, $query);
if(!$result){
    die("consulta fallada");
}
echo "Update Task Successfully";
 ?>