<!DOCTYPE html>
<html lang="tr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <form action="student_select_native_schedule.php" method="post" onSubmit={submitHandler}>
        <table class="table">



            <?php
            session_start();
            $host = "localhost";
            $database = "db_project";
            $user = "root";
            $password = "";


            if (isset($_POST["submitNative"])) {

                //connection
                $connection = new mysqli($host, $user, $password, $database) or die("hata1");


                //initialize html elements
                $native = $_POST['nativeselect'];
                $_SESSION["nativeselectreq"] = $native;


                //searc in db
                $stmt = $connection->prepare("SELECT DISTINCT speaking_exercise_date FROM language_natives NATURAL JOIN speaking_exercise NATURAL JOIN speaking_request NATURAL JOIN user WHERE username = ? AND language_natives_id = id;");
                if ($connection->errno > 0) {
                    die("<b>Sorgu Hatası:</b> " . $connection->error);
                }

                $stmt->bind_param("s", $native);
                $stmt->execute();

                $result = $stmt->get_result();
                echo " <thead>
                <tr>
            <th scope='col'> NON-EMPTY DAYS </th>
            <th scope='col'></th>
            </tr>
            </thead>
            <tbody>";


                while ($res = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $res['speaking_exercise_date'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
            <tbody>
        </table>
    </form>
    <form action="speaking_activity_request.php" method="post" onSubmit={submitHandler}>
    <input id="datepicker"  name="datepicker" width="276" />
    <input type="submit" value="Request" name="submitReq" class="btn btn-success"></input>
    </form>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>