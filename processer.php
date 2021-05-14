<?php
session_start();
$local = "localhost";
$uname = 'root';
$pwd = '';
$name = '';
$location = '';
$db_name = 'crud';
$update = false;
$id = 0;
$con = mysqli_connect( $local, $uname, $pwd );
mysqli_select_db($con, "crud");
$mysqli = new mysqli($local, $uname, $pwd, $db_name);


if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$run =  "INSERT INTO data (name,location) VALUES ('$name', '$location') " ;
	mysqli_query($con, $run);

	$_SESSION['message'] = 'Record has been saved' ;
	$_SESSION['msg_type'] = 'success' ;
	header('location:index.php');
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$run_delete = " DELETE FROM data where id=$id ";
	mysqli_query($con, $run_delete);

	$_SESSION['message'] = 'Record has been deleted' ;
	$_SESSION['msg_type'] = 'danger' ;
	header('location:index.php');
}

$mysqli = new mysqli($local, $uname, $pwd, $db_name);

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	//$run_edit = " SELECT * FROM data where id=$id ";
	//$edit_runner = mysqli_query($con, $run_edit);
	
$mysqli = new mysqli($local, $uname, $pwd, $db_name);

	$result = $mysqli->query( "SELECT * FROM data where id=$id" );
	if (count($result) == 1) {
		$row_edit = $result->fetch_array();
		$name = $row_edit['name'];
	$location = $row_edit['location'];
	}
}

$mysqli = new mysqli($local, $uname, $pwd, $db_name);

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$mysqli = new mysqli($local, $uname, $pwd, $db_name);

	$mysqli->query( "UPDATE data SET name='$name', location='$location' WHERE id=$id" );

	$_SESSION['message'] = 'Record has been edited' ;
	$_SESSION['msg_type'] = 'warning' ;
	header('location:index.php');
}