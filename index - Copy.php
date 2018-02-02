<?php
  include "connectDB.php";

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="DC Heroes">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>DC Heroes</title>
  </head>
  <body>

    <div class="header-container">
      <header>
        <img id="dccLogo" src="images/DCC.png" alt="">
        <h1> DC Heroes</h1>
      </header>
    </div>

    <div class="main-container">
      <div class="left-column">
        <h1>Teams</h1>
        <nav>
        <?php
                 foreach ($team as $key => $value) {
                   # code...
                   $teamId = $_GET['teamId'];
                   $sql2 = "select * from h ero where teamId =" . $teamId;
                   ?>
                   <?php
                     ?>
                   <a href="index.php?teamId=<?php echo $value['teamId']; ?>"><h2><?php echo $value['teamName'];  ?></h2></a>


                   <?php
                 }
                 ?>
        </nav>


      </div>
      <div class="center-column">
        <div class="select-hero">
        <?php  foreach ($hero as $key => $value) ?>
              {

          <img <?php echo $value['heroId']; echo $value['heroImage']; ?></img>
        }  ?>
        <?php echo $value['heroId']; ?>"><h2><?php echo $value['heroName']; ?></h2>
          <h3>hero info bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLA BLA BLA BLA BLA</h3>
          <div class="moreInfo-button">
            <p>More Info</p>
          </div>


        </div>

      </div>
      <div class="right-column">
        <img class="hero-profilepicture" src="images/hero.jpg" alt="">

          <div id="banner-image">
            <img src="images/ugunda.jpg" alt=""></img>
          </div>
      <div class="hero-information">
        <h1>HERO NAME</h1>
          <p>bleu die bleu die bleubleu die bleu die bleubleu die bleu die bleu</p>
      </div>

      </div>
    </div>


  </body>
</html>
