<?php
    include_once 'dbh.inc.php';
    session_start();
    
    $userID = $_SESSION["userid"];
    
    /*
    echo $userID;
    if (isset($_POST['submit'])) {
        if (!empty($_POST['selectClass'])) {
            $selected = explode(",", $_POST['selectClass']);
            echo print_r($selected);
            echo '<br>';
            echo is_array($selected) ? 'yes' : 'no';
            echo '<br>';
        }
    }
    */

    if (isset($_POST['submit'])) {
        if (!empty($_POST['selectClass'])) {
            $selected = explode(",", $_POST['selectClass']);
            $moduleCode = $selected[4];
            echo $moduleCode;
            $moduleName = $selected[5];
            echo $moduleName;
            $classNo = $selected[0];
            echo $classNo;
            $startTime = $selected[2];
            //echo $startTime;
            $endTime = $selected[3];
            //echo $endTime;
            switch($selected[1]) {
                case " Monday":
                    $dayOn = 1;
                    $startTime += 10000;
                    $endTime +=10000;
                    break;
                case " Tuesday":
                    $dayOn = 2;
                    $startTime += 20000;
                    $endTime +=20000;
                    break;
                case " Wednesday":
                    $dayOn = 3;
                    $startTime += 30000;
                    $endTime +=30000;
                    break;
                case " Thursday":
                    $dayOn = 4;
                    $startTime += 40000;
                    $endTime +=40000;
                    break;
                case " Friday":
                    $dayOn = 5;
                    $startTime += 50000;
                    $endTime +=50000;
                    break;
                default:
                    echo "switch statement not working";
            }
            echo $dayOn;
            echo $startTime;
            echo $endTime;
        } else {
            $userID = null;
            $moduleCode = null;
            $moduleName = null;
            $classNo = null;
            $dayOn = null;
            $startTime = null;
            $endTime = null;
        }
    }

    $sql = "INSERT INTO schedules (userID, moduleCode, moduleName, classNo, dayOn, startTime, endTime)
                    VALUES ('$userID', '$moduleCode', '$moduleName', '$classNo', '$dayOn', '$startTime', '$endTime');";
    mysqli_query($conn, $sql);

    header("location: ../Timetable.php");
?>