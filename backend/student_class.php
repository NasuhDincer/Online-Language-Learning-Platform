<html>
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
    <div className={classes.div1}>
        <h1>Request Class from a Teacher</h1>
        <br />
        <form action="student_select_class.php" method="post" onSubmit={submitHandler}>
            <select name="teachername">
                {DUMMY_DATA.map((option) => (
                <?php
                $host = "localhost";
                $database = "db_project";
                $user = "root";
                $password = "";
                $connection = new mysqli($host, $user, $password, $database) or die("hata1");

                //sql part
                $sql = "SELECT DISTINCT username FROM teacher NATURAL JOIN user WHERE  teacher_id = id;";
                $stmt = $connection->prepare($sql);

                if ($connection->errno > 0) {
                    die("<b>Sorgu Hatası:</b> " . $connection->error);
                }

                //$stmt -> bind_param("i",$_SESSION["userid"]);
                $stmt->execute();
                $result = $stmt->get_result();


                while ($res = $result->fetch_assoc()) {
                    echo "<option value={$res["username"]}>" . $res["username"] . "</option>";
                }

                ?>

                ))}
            </select>
            <br />
            <input type="submit" value="Apply For Class" name="submit1" className={classes.btn}></input>
        </form>
    </div>

    <div className={classes.div2}>
        <h1>Request Online Meeting Request</h1>
        <br />
        <h>
            <b>Select Language</b>
        </h>
        <br />
        <form action="student_select_native.php" method="post" onSubmit={submitHandler}>
            <select name = "lang">
                {DUMMY_DATA.map((option) => (
                    <?php
                $host = "localhost";
                $database = "db_project";
                $user = "root";
                $password = "";
                $connection = new mysqli($host, $user, $password, $database) or die("hata1");

                //sql part
                $sql = "SELECT DISTINCT language FROM language_natives NATURAL JOIN teaching_staff WHERE  language_natives_id = teaching_staff_id;";
                $stmt = $connection->prepare($sql);

                if ($connection->errno > 0) {
                    die("<b>Sorgu Hatası:</b> " . $connection->error);
                }

                //$stmt -> bind_param("i",$_SESSION["userid"]);
                $stmt->execute();
                $result = $stmt->get_result();


                while ($res = $result->fetch_assoc()) {
                    echo "<option value={$res["language"]}>" . $res["language"] . "</option>";
                }

                ?>
                ))}
            </select>
            <br />
            <br />
            <h>
                <b>Provide Date and Time</b>
            </h>
            <br />
            <input></input>
            <br />
            <br />
            <h>
                <b>Comments</b>
            </h>
            <br />
            <textarea></textarea>
            <br />
            <input type="submit" value="Request" name="submit2" className={classes.btn}></input>>
        </form>
    </div>
</div>

</html>