<?php
session_start();
$host = "localhost";
$database = "db_project";
$user = "root";
$password = "";


if(isset($_POST["submit1"]))
{

//connection
$connection = new mysqli($host,$user,$password,$database) or die("hata1");


//initialize html elements
$tname = $_POST['teachername'];

//searc in db
$stmt = $connection->prepare("SELECT * FROM class NATURAL JOIN teaches NATURAL JOIN teacher NATURAL JOIN user WHERE username = ? AND teacher_id = id;");
if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}
 
$stmt -> bind_param("s",$tname);
$stmt-> execute();
  
$result = $stmt->get_result();
echo "<table border='4' class='stats' cellspacing='0'>

            <tr>
            <td class='hed' colspan='8'>CLASSES FOR TEACHER : $tname</td>
              </tr>
            <tr>
            <th>CLASS NAME</th>
            <th>LANGUAGE</th>
            <th>CLASS LEVEL</th>
            <th>RATING</th>
            <th>DESCRIPTION</th>
            </tr>";


while($res = $result -> fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $res['class_name'] . "</td>";
    echo "<td>" . $res['class_language'] . "</td>";
    echo "<td>" . $res['class_level'] . "</td>";
    echo "<td>" . $res['class_rating'] . "</td>";
    echo "<td>" . $res['class_description'] . "</td>";


    echo "</tr>";
}
echo "</table>";

}
?>