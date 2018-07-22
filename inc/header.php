<!DOCTYPE html>
<html>
<?php 
	if($_SERVER['SCRIPT_NAME'] == '/secninjaz/index.php') {
		$title = 'FORM';
	}else if ($_SERVER['SCRIPT_NAME'] == '/secninjaz/lists.php') {
		$title = 'LISTS';
	}
?>
<head>
	<title>SECNINJAZ | <?php echo $title; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />	
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed">
	  	<a class="navbar-brand" href="index.php" style="margin-right:2rem">FORM</a>
	  	<a class="navbar-brand" href="lists.php">LISTS</a>
	</nav>
	
	<div class="alert alert-dismissible alert-danger text-center error_show" style="position:fixed;margin:auto 25%;display:none;width:50%;z-index:100">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong class="error_msg"></strong>
	</div>

	<div class="alert alert-dismissible alert-success text-center success_show" style="position:fixed;margin:auto 25%;display:none;width:50%;z-index:100">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong class="success_msg"></strong>
	</div>
	

