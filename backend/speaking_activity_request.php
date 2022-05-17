<?php
            session_start();
            $host = "localhost";
            $database = "db_project";
            $user = "root";
            $password = "";


            if (isset($_POST["submitReq"])) {

                //connection
                $connection = new mysqli($host, $user, $password, $database) or die("hata1");


                //initialize html elements
                $native = $_SESSION["nativeselectreq"];
                $date = $_POST['datepicker'];
                $studentid = $_SESSION["userid"];
               // echo $date;
               // echo $native;
               // echo "user id:";
               // echo $studentid;
               // $date2 = date_create($date);
                $my_date = date('Y-m-d', strtotime($date));
                //$formated_DATE = date_format($date2, 'Y-m-d');
               // echo $my_date. "<br>";

                //searc in db
                $stmt = $connection->prepare("SELECT DISTINCT * FROM language_natives NATURAL JOIN user  WHERE username = ? AND language_natives_id = id;");
                if ($connection->errno > 0) {
                    die("<b>Sorgu Hatası:</b> " . $connection->error);
                }

                $stmt->bind_param("s", $native);
                $stmt->execute();

                $result = $stmt->get_result();
           

                $nativeid = -1;
                while ($res = $result->fetch_assoc()) {
                 
                    $nativeid =$res['id'] ;
                  
                }
               // echo $nativeid;

                $stmt2 = $connection->prepare("INSERT INTO `speaking_activity_request` (`language_natives_id`, `student_id`, `speaking_exercise_id`, `speaking_exercise_date`) VALUES (?, ?, ?, ?);");
                $stmt2->bind_param("iiis", $nativeid,$studentid,rand(0,10000),$my_date);
                $stmt2->execute();
                header("Location:student_home.php");

            }
