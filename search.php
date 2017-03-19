<!DOCTYPE html>
<html lang = "en">

  <head>
    <meta charset = "UTF-8">
      <title>Hadopi Stream</title>
      <link rel="stylesheet" type="text/css" href="view/index.css">
      <link rel="stylesheet" type="text/css" href="view/view_movie.css">
      <link rel="icon" type="image/png" href="photo_slide/dop.png">
      </head>
      
  <body>
    <div id="container">
    <?php require 'header.php';?>
    <br/>
    <main>
      <h1>Resultat de votre recherche :</h1> 
    </main>

      <div id="toto">
<?php require ('Controller/Bundle/search.php'); ?>
      </div>
    <div id="footer" class="plateform_title">
      <p id="p_footer">Code Camp Prep'ETNA 2021</p>
      </div> 
</div>
  </body>
  
</html>
