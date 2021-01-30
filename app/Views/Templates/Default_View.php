<?php namespace Assets; ?>
<!doctype html>
<html lang="de" >
<head >
	<title ></title >
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" http-equiv="Content-Type"
	      content="text/html; charset=UTF-8" >

	<!-- Load Stylesheets -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
	      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" >
	<link rel="stylesheet" href="<?= base_url().'/../assets/css/swgoh.css' ?>" >

	<!-- Load favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?= base_url().'/../assets/favicon/apple-icon-57x57.png' ?>" >
	<link rel="apple-touch-icon" sizes="60x60" href="<?= base_url().'/../assets/favicon/apple-icon-60x60.png' ?>" >
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url().'/../assets/favicon/apple-icon-72x72.png' ?>" >
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url().'/../assets/favicon/apple-icon-76x76.png' ?>" >
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url().'/../assets/favicon/apple-icon-114x114.png' ?>" >
	<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url().'/../assets/favicon/apple-icon-120x120.png' ?>" >
	<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url().'/../assets/favicon/apple-icon-144x144.png' ?>" >
	<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url().'/../assets/favicon/apple-icon-152x152.png' ?>" >
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url().'/../assets/favicon/apple-icon-180x180.png' ?>" >

	<link rel="icon" type="image/png" sizes="192x192"
	      href="<?= base_url().'/../assets/favicon/android-icon-192x192.png' ?>" >
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url().'/../assets/favicon/favicon-32x32.png' ?>" >
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url().'/../assets/favicon/favicon-96x96.png' ?>" >
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url().'/../assets/favicon/favicon-16x16.png' ?>" >

	<link rel="shortcut icon" type="image/png" sizes="16x16"
	      href="<?= base_url().'/../assets/favicon/favicon-16x16.png' ?>" >
	<link rel="shortcut icon" type="image/png" sizes="16x16" href="<?= base_url().'/../assets/favicon/favicon.ico' ?>" >

	<link rel="manifest" href="<?= base_url().'/../assets/favicon/manifest.json' ?>" >

	<meta name="msapplication-TileColor" content="#ffffff" >
	<meta name="msapplication-TileImage" content="<?= base_url().'/../assets/favicon/ms-icon-144x144.png' ?>" >
	<meta name="theme-color" content="#ffffff" >

	<!-- Load scripts -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	        crossorigin="anonymous" ></script >
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
	        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
	        crossorigin="anonymous" ></script >

	<title ><?php

		echo $page_title; ?></title >
	<?php //echo $before_head;?>
</head >
<body >


<?php echo view('/partials/Navbar'); ?>

