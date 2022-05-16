<?php
$host = "localhost";
$database = "db_project";
$user = "root";
$password = "";

if(isset($_POST["submit"]))
{

//connection
$connection = new mysqli($host,$user,$password,$database) or die("hata1");


//initialize html elements
$uname = $_POST['username'];
$upass = $_POST['password'];

//searc in db
$stmt = $connection->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
if ($connection->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $connection->error);
}
 
$stmt -> bind_param("si",$uname,$upass);
$stmt-> execute();
  
$result = $stmt->get_result();
$count = 0;
$_SESSION["userid"] = -1;

while($res = $result -> fetch_assoc()){
    $_SESSION["userid"] = $res['id'];
    $count ++;
}

if( $_SESSION["userid"] == -1)
{
   echo "invalid username or password";
}
else{
    //redirect
    header("Location:student.php");
}
        
echo $_SESSION["userid"];
echo $count;

}
