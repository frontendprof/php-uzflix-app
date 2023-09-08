<?php

 require_once("includes/config.php");
 require_once("includes/classes/PreviewProvider.php");
 require_once("includes/classes/CategoryContainers.php");

 require_once("includes/classes/Entity.php");
 require_once("includes/classes/EntityProvider.php");




 if(!isset($_SESSION['userLoggedIn'])){
    header("Location:register.php");
 }

 $userLoggedIn=$_SESSION['userLoggedIn'];

 ?>


<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/66c2c7830a.js" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    
    <title>Uz-flix</title>
</head>
<body>


   <div class="wrapper">