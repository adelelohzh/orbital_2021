<?php

if (isset($_POST['array'])) {

    include('database_connection.php');
    
    $array = $_POST['array'];
    $id = $array[0];
    $newName = $array[1];
    $newDeadline = $array[2];
    
    if (empty($id)) 
    {
        echo 'emptyerror';
    } 
    else
    {

        if ($newName != null && $newDeadline != null)
        {
            $res = $conn-> query(
                "UPDATE tasks 
                SET taskName= '$newName', taskDeadline = '$newDeadline'
                WHERE taskId = $id"
                );
        } 
        else if ($newDeadline != null || $newDeadline != '')
        {
            $res = $conn-> query(
                "UPDATE tasks 
                SET taskDeadline = '$newDeadline'
                WHERE taskId = $id"
                );
        }
        else if ($newName != null)
        {
            $res = $conn-> query(
                "UPDATE tasks 
                SET taskName= '$newName'
                WHERE taskId = $id"
                );
        } 
        else
        {
            $res = false;
            echo 'missing-value-';
        }
        
        if ($res) 
        {
            echo 'success';
        }
        else
        {
            echo 'error';
        }

        $conn = null;
        exit();
    }
} 
else
{
    echo 'ffferror';
}

?>