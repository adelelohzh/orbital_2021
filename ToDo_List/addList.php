<?php

if (isset($_POST['listName'])) {

    require('database_connection.php');

    $userUID = $_SESSION["useruid"];
    
    $name = $_POST['listName'];

    if (empty($name))
    {
        header("Location: ../ToDo_List/todolist.php?mess=error1");
    } 
    else
    {

        $query = "INSERT INTO taskList (userId, listName) VALUES ('$userUID', '$name')" ;
        
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
else
{
    header("Location: ../ToDo_List/todolist.php");
}
?>