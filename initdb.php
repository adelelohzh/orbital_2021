<form action="initdb.php" method="post">
    <input type="submit" name="initdb" value="Initialize Database" />
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['initdb'])) {
//echo "hi";
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";

// Create connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Create database
$sql = "CREATE DATABASE orbitaldatabase;";

if ($conn->query($sql) === TRUE) {
  echo "Database created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error . "<br>";
}

//mysqli_query($conn, $sql);
$conn->close();

$dbName = "orbitaldatabase";
// Create connection
$conn2 = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
// Check connection

if ($conn2->connect_error) {
  die("Connection failed: " . $conn2->connect_error);
}
// sql to create table
$createusers = "CREATE TABLE users (
    usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersName varchar(128) NOT NULL,
    usersEmail varchar(128) NOT NULL,
    usersUid varchar(128) NOT NULL,
    usersPwd varchar(128) NOT NULL
);";

$createschedules = "CREATE TABLE schedules (
    userID int(11) NOT NULL,
    moduleCode varchar(256) NOT NULL,
    moduleName text NOT NULL,
    classNo varchar(256) NOT NULL,
    dayOn int(11) NOT NULL,
    startTime int(11) NOT NULL,
    endTime int(11) NOT NULL
);";


if ($conn2->query($createusers) === TRUE) {
    echo "Table users created successfully <br>";
} else {
    echo "Error creating table: " . $conn2->error . "<br>";
}

if ($conn2->query($createschedules) === TRUE) {
    echo "Table schedules created successfully <br>";
} else {
    echo "Error creating table: " . $conn2->error . "<br>";
}
/*
mysqli_query($conn2, $createusers);
mysqli_query($conn2, $createschedules);
*/
}
?>