<?php

if (isset($_POST['id'])) {

    include('database_connection.php');
    
    $id = $_POST['id'];
    
    if (empty($id)) 
    {
        echo 'error';
    } 
    else
    {
        $completed = $conn -> prepare("DELETE FROM tasks WHERE taskChecked = 1");
        $res = $completed-> execute();

        if ($res) 
        {
            echo 'success';
        }
        else
        {
            echo 'error1';
        }

        $conn = null;
        exit();
    }
} 
else
{
    echo 'error2';
}

?>