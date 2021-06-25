<?php

if (isset($_POST['taskname'])) {

    require('database_connection.php');

    $userId = $_SESSION['useruid'];

    
    $name = $_POST['taskname'];

    if (empty($name))
    {
        header("Location: ../ToDo_List/todolist.php?mess=error");
    } 
    else
    {

        $list_id = $_POST['currList'];

        $query = "INSERT INTO tasks (taskName, userId, listId) VALUES ('$name' , '$userId', '$list_id')" ;
        
        $run = mysqli_query($conn , $query) or die(mysqli_error($conn));

        if (!$run) 
        {
            echo "failed";
        }
        else
        {
            header("Location: ../ToDo_List/todolist.php");
            
        }
    }
}
?>

