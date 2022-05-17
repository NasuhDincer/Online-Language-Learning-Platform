<!DOCTYPE html>
<html lang="tr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div>
        <header className={classes.header}>
            <div className={classes.logo}>
                <ul>
                    <li>
                        <Link to="/StdHome">Home</Link>
                    </li>
                    <li>
                        <Link to="/StdClass">Class</Link>
                    </li>
                    <button className={classes.btn}>Logout</button>
                </ul>
            </div>
        </header>
      
        <?php
        session_start();
    
        //******************REQUEST CLASS************************************** */
        //connection
        $host = "localhost";
        $database = "db_project";
        $user = "root";
        $password = "";
        $connection = new mysqli($host, $user, $password, $database) or die("hata1");

        //sql part
        $sql = "SELECT * FROM class NATURAL JOIN student NATURAL JOIN enroll WHERE  student_id = ?;";
        $stmt = $connection->prepare($sql);

        if ($connection->errno > 0) {
            die("<b>Sorgu Hatası:</b> " . $connection->error);
        }

        $stmt->bind_param("i", $_SESSION["userid"]);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<table class='table'>

            <tr>
            <td class='hed' colspan='8'>MY COURSES </td>
              </tr>
            <tr>
            <th>CLASS NAME</th>
            <th>LANGUAGE</th>
            <th>CLASS LEVEL</th>
            <th>RATING</th>
            <th>DESCRIPTION</th>
            </tr>";

        while ($res = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $res['class_name'] . "</td>";
            echo "<td>" . $res['class_language'] . "</td>";
            echo "<td>" . $res['class_level'] . "</td>";
            echo "<td>" . $res['class_rating'] . "</td>";
            echo "<td>" . $res['class_description'] . "</td>";


            echo "</tr>";
            //printf($res['class_name']) ;
            //printf($res['username']) ;
            //printf("\n");
        }
        echo "</table>";

        $sql = "SELECT language_natives_id,speaking_exercise_date FROM student NATURAL JOIN speaking_exercise NATURAL JOIN speaking_activity_request NATURAL JOIN language_natives WHERE  student.student_id = ? AND student.student_id = speaking_activity_request.student_id AND language_natives.language_natives_id = speaking_activity_request.language_natives_id;";
        $stmt = $connection->prepare($sql);

        if ($connection->errno > 0) {
            die("<b>Sorgu Hatası:</b> " . $connection->error);
        }

        $stmt->bind_param("i", $_SESSION["userid"]);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<table class='table'>

            <tr>
            <td class='hed' colspan='8'>MY SPEAKING EXERCISES </td>
              </tr>
            <tr>
            <th>NATIVE NAME</th>
            <th>DATE</th>
       
            </tr>";

        while ($res = $result->fetch_assoc()) {
            echo "<tr>";
           // echo "<td>" . $res['language_natives_id'] . "</td>";
            $sql ="SELECT DISTINCT username FROM language_natives NATURAL JOIN user WHERE language_natives_id = id AND language_natives_id = ?";
            $stmt = $connection->prepare($sql);

            $stmt->bind_param("i", $res['language_natives_id']);
            $stmt->execute();
            $result2 = $stmt->get_result();
            while ($res2 = $result2->fetch_assoc()) {
                echo "<td>" . $res2['username'] . "</td>";
            }
            echo "<td>" . $res['speaking_exercise_date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        /*********************************************************************************************** */
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>