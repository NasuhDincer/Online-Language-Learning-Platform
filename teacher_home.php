<?php
include "configure.php";

// teaches is a table that has foreign key from teacher and foreign key from class 
// get classes that teacher teaches
session_start();

echo "Welcome " . $_SESSION["user_name"];
echo "<br><br><br>";

$teacher_id = $_SESSION["userid"];

$sql = "SELECT * FROM teaches WHERE teacher_id = '$teacher_id'";
$result = $conn->query($sql);

// get all classes of the teacher
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sql = "SELECT * FROM class WHERE class_id = '$row[class_id]'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                // hold the class_name in array
                $class_name[] = $row2['class_name'];
            }
        }
    }
}


$sql2 = "SELECT COUNT(*) FROM class NATURAL JOIN teaches NATURAL JOIN enroll WHERE teacher_id = '$teacher_id' GROUP BY class_id"; 
$result3 = $conn->query($sql2);


//sql 2 is count of student number in each class show in page
if ($result3->num_rows > 0) {
    while($row2 = $result3->fetch_assoc()) {
        // hold class count in array
        $class_count[] = $row2['COUNT(*)'];
    }
}

// get all activities of the classes that teacher teaches
$sql3 = "SELECT * FROM class NATURAL JOIN teaches NATURAL JOIN activity NATURAL JOIN with_in WHERE teacher_id = '$teacher_id'";
$result4 = $conn->query($sql3);

//print activity name 
if ($result4->num_rows > 0) {
    while($row3 = $result4->fetch_assoc()) {
        // hold activity name in array
        $activity_name[] = $row3['activity_name'];
    }
}

//print class name and student number in each class
for ($i = 0; $i < count($class_name); $i++) {
    echo $class_name[$i] . ": " . $class_count[$i] . "<br>";
}

//print activity name
for ($i = 0; $i < count($activity_name); $i++) {
    echo $activity_name[$i] . "<br>";
}



?>

