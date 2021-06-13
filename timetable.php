<?php
    session_start();
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleTimetable.css">
        <link rel="stylesheet" href="styleHeader.css">
        <style>
            <?php include 'styleHeader.css'; ?>
        </style>

    <body class = "full grey">
     
    <!-- Header -->
    <div class = "header">
        <?php if (!isset($_SESSION["useruid"])) { ?>
                <ul class = "header-left">
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
        <?php } else { ?>
                <ul class = "header-left">
                    <li class = "nostyle inlineblock leftfloat centered"><a href='#' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
                <ul class = "header-right">
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Home</a></li>
                    <li class = "nostyle inlineblock"><a href='../Timetable/Timetable.php' class = "nodeco blockdisplay">Timetable</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">To-Do List</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Shuttle Bus</a></li>
                    <li class = "nostyle inlineblock"><a href='../Login_Signup/includes/logout.inc.php' class = "nodeco blockdisplay">Logout</a></li>
                </ul>
        <?php } ?>       
    </div>
    <!-- End of header -->

    <!-- Timetable -->
    <table class="timetable fontsset1">

      <thead>
        <tr>
          <th></th>
          <th>0800</th>
          <th>0900</th>
          <th>1000</th>
          <th>1100</th>
          <th>1200</th>
          <th>1300</th>
          <th>1400</th>
          <th>1500</th>
          <th>1600</th>
          <th>1700</th>  
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Monday</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>    
        </tr>
        <tr>
          <td>Tuesday</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>    
        </tr>
        <tr>
          <td>Wednesday</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>    
        </tr>
        <tr>
          <td>Thursday</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>    
        </tr>
        <tr>
          <td>Friday</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>    
        </tr>                            
       </tbody>

    </table>

    </div> <!-- Container end -->
    </body>
</html>