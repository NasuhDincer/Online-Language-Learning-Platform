<?php
//include'user.php';
session_start();
echo "STUDENT PAGE\n";
echo $_SESSION["userid"];

//******************REQUEST CLASS************************************** */
//connection
$host = "localhost";
$database = "db_project";
$user = "root";
$password = "";
$connection = new mysqli($host,$user,$password,$database) or die("hata1");


//initialize html elements
$uname = 'tarik';
$lang = 'eng';


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
echo "<table border='4' class='stats' cellspacing='0'>

            <tr>
            <td class='hed' colspan='8'>Search for : $uname , Language : $lang </td>
              </tr>
            <tr>
            <th>CLASS NAME</th>
            <th>USER NAME</th>
            </tr>";
 
while($res = $result -> fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $res['class_name'] . "</td>";
    echo "<td>" . $res['username'] . "</td>";


    echo "</tr>";
    //printf($res['class_name']) ;
    //printf($res['username']) ;
    //printf("\n");
}
echo "</table>";
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

echo "<table border='4' class='stats' cellspacing='0'>

            <tr>
            <td class='hed' colspan='8'>get all natives with given language : $lang </td>
              </tr>
            <tr>
            <th>USER NAME</th>
            </tr>";

while($resNatives = $resultNatives -> fetch_assoc()){
  //  printf($resNatives['language']) ;
  echo "<tr>";
  echo "<td>" . $resNatives['username'] . "</td>";
  echo "</tr>";
    //printf($resNatives['username']) ;
    //printf("\n");
}
echo "</table>";

//list chosen natives non-empty days
$natname = "ali";
$sqlNatives2 = "SELECT DISTINCT speaking_exercise_date FROM language_natives NATURAL JOIN speaking_exercise NATURAL JOIN speaking_request NATURAL JOIN user WHERE username = ? AND language_natives_id = id;"; 
$stmtNatives2 = $connection->prepare($sqlNatives2);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmtNatives2 -> bind_param("s",$natname);
$stmtNatives2 -> execute();
$resultNatives2 = $stmtNatives2 ->get_result();
echo "<table border='4' class='stats' cellspacing='0'>

            <tr>
            <td class='hed' colspan='8'>list chosen natives non-empty days: $natname </td>
              </tr>
            <tr>
            <th>NON EMPTY DATES</th>
            </tr>";

while($resNatives2 = $resultNatives2 -> fetch_assoc()){
  //  printf($resNatives['language']) ;
  echo "<tr>";
  echo "<td>" . $resNatives2['speaking_exercise_date'] . "</td>";
  echo "</tr>";
   // printf($resNatives2['speaking_exercise_date']) ;
    //printf("\n");
}
echo "</table>";

//list chosen natives non-empty days
$givenNativeName = "ali";
$sqlFindNativeId = "SELECT DISTINCT language_natives_id FROM language_natives NATURAL JOIN user WHERE username = ? AND language_natives_id = id;"; 
$stmtFindNativeId = $connection->prepare($sqlFindNativeId);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmtFindNativeId -> bind_param("s",$natname);
$stmtFindNativeId -> execute();
$resultFindNativeId = $stmtFindNativeId ->get_result();

while($resFindNativeId = $resultFindNativeId -> fetch_assoc()){
    $nativeId = $resFindNativeId['language_natives_id'];
    echo "native id :";
    printf($resFindNativeId['language_natives_id']) ;
    printf("\n");
}
$givenDate = "2022-12-05";
$sqladdReq = "INSERT INTO `speaking_request` (`language_natives_id`, `student_id`, `speaking_exercise_id`) VALUES (?, ?, ?);"; 
$stmtaddReq = $connection->prepare($sqladdReq);

if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}

$stmtaddReq -> bind_param("iii",$nativeId,$_SESSION["userid"],3);
$stmtaddReq -> execute();
