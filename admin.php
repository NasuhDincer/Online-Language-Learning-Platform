<?php
include "configure.php";
session_start();
// session for id_created
$_SESSION["id_created"] = "";

echo '<br>User Details : <br>';

// create a view from user table whose attributes are id, name, email, password
$sql = "CREATE OR REPLACE VIEW user_view AS SELECT id, name, email FROM User";


$result = $conn->query($sql);

//show user_view table
$sql = "SELECT * FROM user_view";
$result = $conn->query($sql);

// print result
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
        // hold datas in array
        $id[] = $row["id"];
        $name[] = $row["name"];
        $email[] = $row["email"];
    }
} 
else {
    echo "0 results";
}

// get users id, name, email, password and insert into database
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
    $type = $_POST['type'];
	$sql = "INSERT INTO User (name, email, password) VALUES ('$name', '$email', '$password')";    
	$result = $conn->query($sql);
	if ($result) {
		echo "success";
        // get the id of the user that just created
        $sql = "SELECT id FROM User WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION["id_created"] = $row["id"];
            }
        }
        if($type == "teaching staff")
        {
            // go to admin_teaching_staff.php
            header("Location: admin_add_teaching_staff.php");
        }
        else if($type == "student"){
            header("Location: admin_add_student.php");

        }
        else{
            echo "error";
        }
	} else {
		echo "fail";
	}
}
// add css style for signup form
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
		<form action="admin.php" method="post">
            <div class="form-group">
                <label>Add User</label>
            </div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Name">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>
            <div class="form-group">
				<label for="type">Type</label>
				<input type="type" class="form-control" id="type" name="type" placeholder="student or teaching staff">
			</div>        
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		</form>
	</div>   

</body>
</html>



