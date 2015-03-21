<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="/app/assets/vendor/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="/app/assets/vendor/bootstrap/dist/css/bootstrap-theme.min.css" type="text/css" />
	<link rel="stylesheet" href="/app/assets/vendor/dropzone/dist/min/dropzone.min.css" type="text/css" />
	<link rel="stylesheet" href="/app/assets/main.css" type="text/css" />
</head>
<body<?= " $bodyClass"; ?>>
<!-- container-fluid -->
<div class="container-fluid">

	<div class="row">
		<h1><?= $title; ?></h1>
	</div>	
	
	<div class="row">
	<?php if (!empty($messages)): ?>
		<div class="panel panel-default">
			<div class="panel panel-body">
			<?php foreach ($messages AS $message): ?>
				<p class="text-info"><?= $message; ?></p>
			<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($errors)): ?>
		<div class="panel panel-danger">
			<div class="panel panel-body">
			<?php foreach ($errors AS $error): ?>
				<p class="text-danger"><?= $error; ?></p>
			<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	</div>