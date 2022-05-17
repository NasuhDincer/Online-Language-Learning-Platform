<?php
include "configure.php";


session_start();
$id_created = $_SESSION["id_created"];

// insert student with $id_created, language to teaching_staff table
if (isset($_POST['language'])) {
	$language = $_POST['language'];
	$type = $_POST['type'];
	$sql = "INSERT INTO teaching_staff (teaching_staff_id, language) VALUES ('$id_created', '$language')";
	$result = $conn->query($sql);
	if ($result) {
		echo "success";
		if($type == "teacher")
        {
            // go to admin_teaching_staff.php
			echo "<script type='text/javascript'>alert('Going teacher information page');</script>";
            header("Location: admin_add_teacher.php");
        }
        else if($type == "language native"){ 
			echo "<script type='text/javascript'>alert('Going language native information page');</script>";
            header("Location: admin_add_language_natives.php");
        }
        else{
            echo "error";
			//pop up message for error
			echo "<script type='text/javascript'>alert('Wrong type');</script>";

        }
	} else {
		echo "fail";
	}
}

?>

<html>
<head>
	<title>Signup</title>
</head>
<body>
	<div class="signup-form">
		<form action="admin_add_teaching_staff.php" method="post">
            <div class="form-group">
				<label for="type">Type</label>
				<input type="type" class="form-control" id="type" name="type" placeholder="teacher or language native">
			</div>   
			<div class="form-group">
				<label for="language">Language</label>
				<input type="language" class="form-control" id="language" name="language" placeholder="Language">
			</div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		</form>
	</div>
</body>
</html>
