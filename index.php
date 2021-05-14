<!-- 1240243046 -->
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   
   	<!--Bootsrap 4 CDN-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				 
			</div>

			<?php

			require_once 'processer.php';
			$local = "localhost";
			$uname = 'root';
			$pwd = '';
			$db_name = 'crud';
$con = new mysqli( $local, $uname, $pwd, $db_name );
$run =  " SELECT * FROM data ";
$final = $con->query( $run );
$fetch_result = $final->fetch_assoc();
//print_r($fetch_result);

?>
<?php
	
	if(isset($_SESSION['message'])){?>
		<div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
			<?php  echo $_SESSION['message'];
			unset($_SESSION['message']);
			?>

		</div>
	<?php } ?>
<div class="row justify-content-center">
	<table>
			<thead>
				<tr>
					<th> Name </th>
					<th> Location </th>
					<th colspan="2"> Action </th>
				</tr>
			</thead>

			<?php  
			// $final = $con->query( $run );
			// $fetch_result = $final->fetch_assoc();
			while ( $fetch_result = $final->fetch_assoc() ) :?>
				<tr>
					<td> <?php echo $fetch_result['name']; ?> </td>
					<td> <?php echo $fetch_result['location']; ?> </td>
					<td> <a class="btn btn-info" href="index.php?edit=<?php echo $fetch_result['id']; ?>">Edit</a> </td>
					<td> <a class="btn btn-danger" href="processer.php?delete=<?php echo $fetch_result['id']; ?>">Delete</a> </td>
			<tr>
			<?php endwhile;  ?> 
	</table>

			<div class="row justify-content-center  ">
				<form action="processer.php" method="post">
						
					<input type="hidden" name="" value="<?php echo $id; ?>">
					<div class="form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="name" class="form-control" placeholder="username" value="<?php echo $name; ?>" >
						
					</div>
					<div class="form-group">
						<input  value="<?php echo $location; ?>" type="location" name="location" class="form-control" placeholder="location">
					</div>
					<div class="form-group">
						<?php
						if($update == true){
							?>
						<button type="submit" name="update" class="btn btn-info">Update</button>
					<?php }
					else{?>
<button type="submit" name="save" class="btn btn-primary">Save</button>
					<?php }?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>

