<?php
include "configure.php";

// get session id_created
session_start();
$id_created = $_SESSION["id_created"];

// get users student_level, student_gpa, and student_join_date as today's date


//$student_join_date is today's date
$student_join_date = date("Y-m-d");


if (isset($_POST['student_level']) && isset($_POST['student_gpa']) && isset($_POST['student_join_date'])) {
	$student_level = $_POST['student_level'];
	$student_gpa = $_POST['student_gpa'];
	$student_join_date = date("Y-m-d");
	$sql = "INSERT INTO Student (student_id, student_level, student_gpa, student_join_date) VALUES ('$id_created', '$student_level', '$student_gpa', '$student_join_date')";
	$result = $conn->query($sql);
	if ($result) {
		echo "success";
		//give pop up message every time
		echo "<script type='text/javascript'>alert('Successfully added student!');</script>";
		// go to admin.php
		header("Location: admin.php");

	} else {
		echo "fail";
		//give pop up message
		echo "<script type='text/javascript'>alert('Failed to add student!');</script>";
	}


}

echo '<style>
.signup-form {
    width: 30%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    background: white;
    border-radius: 0px 0px 10px 10px;
}
</style>';
// add css style for signup button
echo '<style>
.btn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}
</style>';

//add css for form-group
echo '<style>
.form-group {
    margin-bottom: 10px;
}
</style>';

?>

<html>
<head>
	<title>Signup</title>
</head>
<body>
	<div class="signup-form">
		<form action="admin_add_student.php" method="post">
			<h2>Add Student</h2>
			<p class="hint-text">Add student to database</p>
			<div class="form-group">
				<label for="student_level">Student Level</label>
				<input type="text" class="form-control" id="student_level" name="student_level" placeholder="Student Level">
			</div>
			<div class="form-group">
				<label for="student_gpa">Student GPA</label>
				<input type="text" class="form-control" id="student_gpa" name="student_gpa" placeholder="Student GPA">
			</div>
			<div class="form-group">
				<label for="student_join_date">Student Join Date</label>
				<input type="text" class="form-control" id="student_join_date" name="student_join_date" placeholder="Student Join Date">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block">Add Student</button>
			</div>
		</form>
	</div>
</body>
</html>

	
