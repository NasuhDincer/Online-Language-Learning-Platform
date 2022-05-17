<!DOCTYPE html>
<html lang="tr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>

<body>
    <table class="table">

        <?php
        session_start();
        $host = "localhost";
        $database = "db_project";
        $user = "root";
        $password = "";


        if (isset($_POST["submit2"])) {

            //connection
            $connection = new mysqli($host, $user, $password, $database) or die("hata1");


            //initialize html elements
            $lang = $_POST['lang'];

            //searc in db
            $stmt = $connection->prepare("SELECT DISTINCT username FROM language_natives NATURAL JOIN teaching_staff NATURAL JOIN user WHERE language = ? AND teaching_staff_id = id;");
            if ($connection->errno > 0) {
                die("<b>Sorgu Hatası:</b> " . $connection->error);
            }

            $stmt->bind_param("s", $lang);
            $stmt->execute();

            $result = $stmt->get_result();
            echo " <thead>
                <tr>
            <th scope='col'> NATIVE NAME </th>
            <th scope='col'> LANGUAGE</th>
            </tr>
            </thead>
            <tbody>";


            while ($res = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $res['username'] . "</td>";
                echo "<td>" . $lang . "</td>";
                //  $_SESSION["nativeButtonName"] =  $res['username'];
                //     echo "<td> <input type='submit' name = '" . $res['username'] . "' value='request' ' class='btn btn-success'></input> </td>";
                echo "</tr>";
            }
        }

        ?>

        <tbody>
    </table>
    <div class="div">
        <h>SELECT NATIVE</h>
    </div>

    <form action="student_select_native_schedule.php" method="post" onSubmit={submitHandler}>
        <select class="browser-default custom-select" name="nativeselect">
            {DUMMY_DATA.map((option) => (
            <?php
            $host = "localhost";
            $database = "db_project";
            $user = "root";
            $password = "";
            $connection = new mysqli($host, $user, $password, $database) or die("hata1");

            //initialize html elements
            $lang = $_POST['lang'];

            //searc in db
            $stmt = $connection->prepare("SELECT DISTINCT username FROM language_natives NATURAL JOIN teaching_staff NATURAL JOIN user WHERE language = ? AND teaching_staff_id = id;");
            if ($connection->errno > 0) {
                die("<b>Sorgu Hatası:</b> " . $connection->error);
            }

            $stmt->bind_param("s", $lang);
            $stmt->execute();

            $result = $stmt->get_result();




            while ($res = $result->fetch_assoc()) {
                echo "<option value={$res["username"]}>" . $res["username"] . "</option>";
            }

            ?>
            ))}
        </select>
        <input type="submit" value="Request" name="submitNative" class="btn btn-success"></input>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>