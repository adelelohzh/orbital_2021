<?php
    session_start();
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Shuttle_Bus/styleShuttle.css">
        <style>
             <?php include '../Header/styleHeader.css'; ?>
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

    <div class="shuttlebusbody">
        <h1 class="title">Shuttle Bus</h1>
        
        <div class="dropdown">
            <div class="bus-dropdown">
                <select name = "bus" id = "bus">
                    <option selected disabled>Select Bus</option>
                    <option value = "a1">A1</option>
                    <option value = "a2">A2</option>
                    <option value = "d1">D1</option>
                    <option value = "d2">D2</option>
                    <option value = "c">C</option>
                    <option value = "btc1">BTC1</option>
                    <option value = "btc2">BTC2</option>
                    <option value = "a1e">A1E</option>
                </select>
            </div> 

            <div class="busstop-dropdown">
                <select name = "busstop" id = "busstop">
                    <option selected disabled>Select Bus Stop</option>
                    <option value = "krmrt">KR MRT</option>
                    <option value = "oppkrtmrt">Opp KR MRT</option>
                    <option value = "pgpr">Prince George Park Residence</option>
                    <option value = "pgp">Prince George Park</option>
                    <option value = "s17">S17</option>
                    <option value = "lt27">LT27</option>
                    <option value = "unihall">University Hall</option>
                    <option value = "pgph15">PGP House 15</option>
                    <option value = "pgp7">PGP7</option>
                    <option value = "oppunihall">Opp University Hall</option>
                    <option value = "opptcoms">Opp TCOMS</option>
                    <option value = "tcoms">TCOMS</option>
                    <option value = "biz2">BIZ 2</option>
                    <option value = "opphssml">Opp Hon Sui Sen Memorial Library</option>
                    <option value = "com2">COM2</option>
                    <option value = "uhc">University Health Center</option>
                    <option value = "oppuch">Opp University Health Center</option>
                    <option value = "yih">Yusof Ishak House</option>
                    <option value = "oppyih">Opp Yusof Ishak House</option>
                    <option value = "oppnuss">Opp NUSS</option>
                    <option value = "it">Information Technology</option>
                    <option value = "as5">AS 5</option>
                    <option value = "museum">Musuem</option>
                    <option value = "utown">University Town</option>
                    <option value = "othb">Oei Tiong Ham Building</option>
                    <option value = "clb">Central Library</option>
                    <option value = "rh">Raffles Hall</option>
                    <option value = "lt13">LT13</option>
                    <option value = "ventus">Ventus</option>
                    <option value = "botanicgardenmrt">Botanic Garden MRT</option>
                    <option value = "krbusterminal">Kent Ridge Bus Terminal</option>
                    <option value = "collegegreen">College Green</option>
                    <option value = "ea">EA</option>
                    <option value = "japprisch">The Japanese Primary School</option>
                    <option value = "kentvalue">Kent Value</option>
                </select>
            </div> 
        </div>

        <div class="bustimings">
            <div class="box">
                <ul class = "timingbox">
                    <li><div class="busname">A1</div></li>
                    <li><div class="busname">A1E</div></li>
                    <li><div class="busname">C</div></li>
                </ul>
            </div>
        </div>
    </div>
    
    </body>
</html>