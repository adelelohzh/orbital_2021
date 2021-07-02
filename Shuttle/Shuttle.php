<!DOCTYPE html>
<html>
    <title>myNUS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleShuttle.css">
    <style>
        <?php include '../Header/styleHeader.css'; ?>
    </style>

    <body class = "full grey">
    <?php include_once '../Header/Header.php'; ?>
    <div class = "shuttle">
    <?php
        $auth = base64_encode('NUSnextbus:13dL?zY,3feWR^"T');
        $context = stream_context_create(["http" => ["header" => "Authorization: Basic $auth"]]);
        $url = "https://nnextbus.nus.edu.sg/BusStops";
        $shuttledata = @file_get_contents($url, false, $context);
        $dshuttledata = json_decode($shuttledata, true);
        $stopsdata = $dshuttledata['BusStopsResult']['busstops'];
        $stops = array();
        foreach($stopsdata as $stop) {
            array_push($stops, $stop['name']);
        }
        //echo print_r($stops);
    ?>

        <form class = "select-form" action="includes/getStop.inc.php" method="POST"> 
            <select name="selectStop" placeholder="Select Bus Stop">
              <option value="" disabled selected>Select Bus Stop</option>
              <?php
              foreach($stops as $stop) {
                echo "<option value='$stop'>$stop</option>";
              }
              ?>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php if (isset($_GET['stop'])) { ?>
        <p class = "fontsset1 fontsize20">Bus Stop: <?php echo $_GET['stop'] ?></p>
        <table class="table fontsset1">
            <thead><tr><td>Buses:</td></tr></thead>
            <tbody>
            <?php
                $auth = base64_encode('NUSnextbus:13dL?zY,3feWR^"T');
                $context = stream_context_create(["http" => ["header" => "Authorization: Basic $auth"]]);
                $url = "https://nnextbus.nus.edu.sg/ShuttleService?busstopname={$_GET['stop']}";
                $stopdata = @file_get_contents($url, false, $context);
                $dstopdata = json_decode($stopdata, true);
                $shuttles = $dstopdata['ShuttleServiceResult']['shuttles'];
                foreach($shuttles as $shuttle) {
                    echo "<tr><td class='td1'>{$shuttle['name']}</td><td class='td2'>Next: {$shuttle['arrivalTime']}</td><td class='td3'>After: {$shuttle['nextArrivalTime']}</td></tr>";
                }
            ?>
            </tbody>
        </table>
        <?php } ?>
    </div>   
    </body>

</html>