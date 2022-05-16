<?php
echo "STUDENT PAGE\n";

//******************REQUEST CLASS************************************** */
//connection
$host = "localhost";
$database = "db_project";
$user = "root";
$password = "";
$connection = new mysqli($host,$user,$password,$database) or die("hata1");


//initialize html elements
$uname = $_POST['username'];
$lang = $_POST['language'];


//printf("'%s'\n", $uname);
//printf("'%s'\n", $lang);


//sql part
$sql = "SELECT class_name, username FROM class NATURAL JOIN teaches NATURAL JOIN teacher NATURAL JOIN user WHERE class_language = ? AND username = ?;"; 
$stmt = $connection->prepare($sql);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmt -> bind_param("ss",$lang,$uname);
$stmt-> execute();
$result = $stmt->get_result();

while($res = $result -> fetch_assoc()){
    printf($res['class_name']) ;
    printf($res['username']) ;
    printf("\n");
}
/*********************************************************************************************** */

//get all natives with given language
$lang = "eng";
$sqlNatives = "SELECT DISTINCT username FROM language_natives NATURAL JOIN teaching_staff NATURAL JOIN user WHERE language = ? AND teaching_staff_id = id;"; 
$stmtNatives = $connection->prepare($sqlNatives);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmtNatives -> bind_param("s",$lang);
$stmtNatives-> execute();
$resultNatives = $stmtNatives->get_result();

while($resNatives = $resultNatives -> fetch_assoc()){
  //  printf($resNatives['language']) ;
    printf($resNatives['username']) ;
    printf("\n");
}

//list chosen natives non-empty days
$natname = "ali";
$sqlNatives2 = "SELECT DISTINCT speaking_exercise_date FROM language_natives NATURAL JOIN speaking_exercise NATURAL JOIN speaking_request NATURAL JOIN user WHERE username = ? AND language_native_id = id;"; 
$stmtNatives2 = $connection->prepare($sqlNatives2);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmtNatives2 -> bind_param("s",$natname);
$stmtNatives2 -> execute();
$resultNatives2 = $stmtNatives2 ->get_result();

while($resNatives2 = $resultNatives2 -> fetch_assoc()){
  //  printf($resNatives['language']) ;
    printf($resNatives['speaking_exercise_date']) ;
    printf("\n");
}

//list chosen natives non-empty days
$givenNativeName = "ali";
$givenDate = "";
$sqladdReq = "INSERT INTO `speaking_request` (`language_natives_id`, `student_id`, `speaking_exercise_id`) VALUES (?, ?, ?);"; 
$stmtaddReq = $connection->prepare($sqladdReq);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmtaddReq -> bind_param("ssd",$givenNativeName,$_SESSION["userid"],$givenDate);
$stmtaddReq -> execute();
