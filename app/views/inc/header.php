<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
  <title><?php echo SITENAME; ?></title>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php';?>
  <div class="container">
    <time><?php echo date("d/m/Y") . "<br>";?></time>
    <?php if(isset($_SESSION['user_id'])) : ?>
      <p><b>ברוך הבא <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></b></p>
     
     <?php endif; ?>