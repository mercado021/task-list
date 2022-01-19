<?php
include('database.php');
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "DELETE FROM tareas WHERE id = $id";
    $result= mysqli_query($conexion, $query);
    if (!$result){
        echo "entré al delete.php id=".$id;
        die("\nQuery Faild");
    }
    echo "Task Deleted successfully";
}
?>