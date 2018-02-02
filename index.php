<?php
  include "connectDB.php";

  function myDump($var)
  {
  	echo "<pre>";
  	var_dump($var);
  	echo "</pre>";

  }

  if(isset($_GET['teamId'])) {
    $getTeamId = $_GET['teamId'];
  }

  if(isset($_GET['heroId'])) {
      $getHeroId = $_GET['heroId'];
  }



 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="DC Heroes">

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>DC Heroes</title>
  </head>
  <body>

    <div class="header-container">
      <header>
      <a href="index.php"> <img id="dccLogo" src="images/DCC.png" alt=""></a>
        <h1> DC Heroes</h1>
      </header>
    </div>

    <div class="main-container">
      <div class="left-column">
        <h1 class="textHeaders">Teams</h1>
        <nav>
          <ul>
          <?php
                foreach ($team as $key => $value) {
              ?>
                <a id="chooseTeam" href="index.php?teamId=<?php echo $value['teamId']; ?>"><h2><?php echo $value['teamName']; ?></h2></a>

          <?php
                  }
               ?>
             </ul>
        </nav>


      </div>
      <div class="center-column">
        <?php

          $heroId = $_GET['teamId'];


          $getHero = "SELECT * FROM hero WHERE teamId = $heroId";

          $hero = array();


          $resource = mysqli_query($con,$getHero);

          while($row = mysqli_fetch_assoc($resource))
          {

          ?>

          <div class="select-hero">

          <img class="hero-image" src="<?php echo $row['heroImage']; ?>" alt="">
            <h3 class="textHeaders"><?php echo $row['heroName']; ?></h3>
            <p class="textHeaders"><?php echo $row['heroDescription']; ?> </p>

            <a href="index.php?teamId=<?php echo $row['teamId']; ?>&heroId=<?php echo $row['heroId']; ?>">
                <div class="moreInfo-button">
              <p>More Info</p>
            </div>
            </a>
          </div>

          <?php

          }

         ?>

      </div>

      <div class="right-column">

                  <?php

                    $heroId = $_GET['teamId'];
                    $getHero = "SELECT * FROM hero WHERE heroId = $_GET[heroId]";
                    $getheroes = "SELECT * FROM hero WHERE teamId = $heroId";

                    $hero = array();


                    $resource = mysqli_query($con,$getHero);

                    while($row = mysqli_fetch_assoc($resource))
                    {

                    ?>

         <img class="hero-profilepicture" src="<?php echo $row['heroImage']; ?>" alt="">

           <div id="banner-image">
             <img src="images/background.jpg" alt=""></img>
           </div>
       <div class="hero-information">
         <h1 class="textHeaders"><?php echo $row['heroName']; ?></h1>
           <p class="textHeaders"><?php echo $row['heroDescription']; ?></p>
           <h2 class="textHeaders">Hero Powers</h2>
            <p class="textHeaders"><?php echo $row['heroPower']; ?></p>
        <?php
        }
         ?>

         <h2 class="textHeaders">Rate your hero</h2>



         <?php
            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                //var_dump($_POST);
               // get info from form
               $heroId = $_POST['heroId'];
               $rating = $_POST['rating'];
               $review = $_POST['RatingReview'];
               $getHeroIdPost = $_POST['heroId'];
               $getTeamIdPost = $_POST['teamId'];

               $insertSQL = "insert into rating (heroId,rating,ratingDate,ratingReview) VALUES ($heroId, $rating, ".time().",  '$review')";
               $resource = mysqli_query($con,$insertSQL) or die($insertSQL);

               header("Location: index.php?teamId=" . $getTeamIdPost . "&heroId=" . $getHeroIdPost ."");
            }
          ?>


          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="frmRate">
            <textarea name="RatingReview" rows="8" cols="80" required></textarea>
            <fieldset>
              <div class="rate">
                <input type="radio" id="rating10" name="rating" value="10" required />
                <label class="lblRating" for="rating10" title="5 stars"></label>

                  <input type="radio" id="rating9" name="rating" value="9" />
                  <label class="lblRating half" for="rating9" title="4 1/2 stars"></label>

                  <input type="radio" id="rating8" name="rating" value="8" />
                  <label class="lblRating" for="rating8" title="4 stars"></label>

                  <input type="radio" id="rating7" name="rating" value="7"  />
                  <label class="lblRating half" for="rating7" title="3 1/2 stars"></label>

                  <input type="radio" id="rating6" name="rating" value="6" />
                  <label class="lblRating" for="rating6" title="3 stars"></label>

                  <input type="radio" id="rating5" name="rating" value="5" />
                  <label class="lblRating half" for="rating5" title="2 1/2 stars"></label>

                  <input type="radio" id="rating4" name="rating" value="4" />
                  <label class="lblRating" for="rating4" title="2 stars"></label>

                  <input type="radio" id="rating3" name="rating" value="3" />
                  <label class="lblRating half" for="rating3" title="1 1/2 stars"></label>

                  <input type="radio" id="rating2" name="rating" value="2" />
                  <label class="lblRating" for="rating2" title="1 star"></label>

                  <input type="radio" id="rating1" name="rating" value="1" />
                  <label class="lblRating half" for="rating1" title="1/2 star"></label>

                  <input type="radio" id="rating0" name="rating" value="0" />
                  <label class="lblRating" for="rating0" title="No star"></label>
              </div>
              <div class="divSubmit">
                <input type="submit" name="submitRating" value="Rate Hero"/>
                <input type="hidden" name="heroId" value="<?php echo $getHeroId; ?>"/>
                <input type="hidden" name="teamId" value="<?php echo $getTeamId; ?>"/>
              </div>
            </fieldset>


          </form>

          <p><?php echo $row['rating']; ?></p>

      </div>

      </div>
    </div>


  </body>
</html>
