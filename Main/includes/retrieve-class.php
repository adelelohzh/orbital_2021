<?php 
    require('database_connection.php');
    $userid = $_SESSION["userid"];

    date_default_timezone_set('Singapore');

    $todayDay = date('l');
    $currentTime = date("H:i");
    $noClass = 0;


    switch($todayDay) {
        case "Monday":
            $dayOn = 1;
            break;
        case "Tuesday":
            $dayOn = 2;
            break;
        case "Wednesday":
            $dayOn = 3;
            break;
        case "Thursday":
            $dayOn = 4;
            break;
        case "Friday":
            $dayOn = 5;
            break;
        case "Saturday":
            $dayOn = 6;
            break;
        case "Sunday":
            $dayOn = 7;
            break;
        default:
            echo "switch statement not working";
    }

    $timetable = $conn -> query("SELECT * FROM schedules");
    $classes = $conn -> query("SELECT * FROM schedules WHERE userId = '$userid' AND dayOn = '$dayOn' ORDER BY startTime ASC");
?>

<?php if (mysqli_num_rows($classes) > 0) { ?>
            <?php while($row = $classes->fetch_assoc()) {    
                $start = substr( $row['startTime'], -4 );   
                $end = substr( $row['endTime'], -4 ); 
                if ($currentTime >= $start) { // class either started or over alr
                    if ($currentTime <= $end) {  //class on gg
                        $noClass = 0;?>  
                        <p class = "modname"><?php echo $row['moduleName']?></p>
                        <p class = "modcode"><?php echo $row['moduleCode']?></p>
                        <p class = "modtime"> NOW &nbsp; — &nbsp;From <?php echo $start?> to <?php echo $end?></p>
                    <?php 
                        break;
                    } else { // class over alr
                        $noClass = 1;
                    } 
                } else if ($currentTime <= $start) {  // havent start yet 
                    $noClass = 0;?>
                    <p class = "modname"><?php echo $row['moduleName']?></p>
                    <p class = "modcode"><?php echo $row['moduleCode']?></p>
                    <p class = "modtime"> At <?php echo $start?> to <?php echo $end?></p>
            <?php   break;
                } else { 
                    $noClass = 1;?> 
            <?php break;
                } 
            } 
        } else { ?> 
            <p> No Upcoming Classes Today </p>
    <?php } 
    
    if ($noClass == 1)
    { ?>
        <p> No Upcoming Classes Today </p>
    <?php } ?>

