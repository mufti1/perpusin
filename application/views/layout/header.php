<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/vendor/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/src/css/style.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('/assets/vendor/js/jquery.min.js'); ?>"></script>
	<title>PERPUSIN | Admin</title>
</head>
<body>
	<nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand" href="#">Hai <?php echo $username; ?></a>
		<ul class="nav pull-right">
			<li><a class="nav-link" href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
		</ul>
	</nav>
	<div class="container">
		<div class="row">