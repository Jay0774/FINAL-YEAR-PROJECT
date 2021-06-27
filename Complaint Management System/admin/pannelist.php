<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['submit']))
{
	$u = $_POST['uname'];
	$p = md5($_POST['password']);
	$c = $_POST['college'];
$sql=mysqli_query($bd, "INSERT INTO `pannelist`(`username`, `password`, `updationDate`, `college`) VALUES ('$u','$p','$currentTime','$c')");
$_SESSION['msg']="Pannelist Added Sucessfully !!";
}

if(isset($_GET['del']))
		  {
		          mysqli_query($bd, "delete from pannelist where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Pannelist deleted !!";
		  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Add Pannelist</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script type="text/javascript">
function valid()
{
if(document.addpannelist.uname.value=="")
{
alert("username Filed is Empty !!");
document.addpannelist.uname.focus();
return false;
}
else if(document.addpannelist.password.value=="")
{
alert("Password Filed is Empty !!");
document.addpannelist.password.focus();
return false;
}
else if(document.addpannelist.college.value=="")
{
alert("College Filed is Empty !!");
document.addpannelist.college.focus();
return false;
}
return true;
}
</script>
</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add Pannelist</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");

										?>
									</div>
<?php } ?>
									<br />

			<form class="form-horizontal row-fluid" name="addpannelist" method="post" onSubmit="return valid();">
									
<div class="control-group">
<label class="control-label" for="basicinput">Username/Email</label>
<div class="controls">
<input type="text" placeholder="Enter your username/email "  name="uname" class="span8 tip" required>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Password</label>
<div class="controls">
<input type="password" placeholder="Enter your Password"  name="password" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">College</label>
<div class="controls">
<select name="college" class="span8 tip" required>
	<option value="">Select College</option> 
	<?php $query=mysqli_query($bd, "select * from category");
	while($row=mysqli_fetch_array($query))
	{?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
	<?php } ?>
</select>
</div>
<br>
<div class="control-group">
	<div class="controls">
		<button type="submit" name="submit" class="btn">Submit</button>
	</div>
</div>
</form>
</div>
</div>
<div class="module">
							<div class="module-head">
								<h3>Manage pannelist</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Username</th>
											<th>Password</th>
											<th>Last Updated</th>
											<th>College</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($bd, "select * from pannelist");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['username']);?></td>
											<td><?php echo htmlentities($row['password']);?></td>
											<td><?php echo htmlentities($row['updationDate']);?></td>
											<td><?php 
											$i = $row['college'];
											$query1=mysqli_query($bd, "select categoryName from category where id=$i");
											$row1=mysqli_fetch_array($query1);
											echo htmlentities($row1['categoryName']);?></td>
											<td>
											<a href="pannelist.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
</body>
<?php } ?>