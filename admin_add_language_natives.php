
<?php
include "configure.php";


session_start();
$id_created = $_SESSION["id_created"];

// today's date
$teacher_join_date = date("Y-m-d");

// insert into teachers table with id_created, teacher_review, teacher_join_date if is set
	$sql = "INSERT INTO language_natives (language_natives_id, native_join_date) VALUES ('$id_created', '$teacher_join_date')";
	$result = $conn->query($sql);
	if ($result) {
		echo "success";
		//give pop up message
		echo "<script type='text/javascript'>alert('Successfully added Language native!');</script>";
		// go to admin.php
		header("Location: admin.php");

	} else {
		echo "fail";
		//give pop up message
		echo "<script type='text/javascript'>alert('Failed to add Language native!');</script>";
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
		<form action="admin_add_language_natives.php" method="post">
			<h2>Add Language Native</h2>
			<p class="hint-text">Add language native to database</p>
			<div class="form-group">
				<label for="teacher_join_date">Language Native Date</label>
				<input type="text" class="form-control" id="teacher_join_date" name="teacher_join_date" placeholder="Language Native Join Date">
			</div>
			<div class="form-group">
				
				<button type="submit" class="btn btn-success btn-lg btn-block">Add Language Native</button>
			</div>
		</form>
	</div>
</body>
</html>
