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

<div id="categorie">
	<a href="film.php" id="cat_link"><p class="categorie_title">Tous</p></a>
	<a href="film.php?Categorie=Action" id="cat_link"><p class="categorie_title">Action</p></a>
	<a href="film.php?Categorie=Aventure" id="cat_link"><p class="categorie_title">Aventure</p></a>
	<a href="film.php?Categorie=Western" id="cat_link"><p class="categorie_title">Western</p></a>
	<a href="film.php?Categorie=Comique" id="cat_link"><p class="categorie_title">Comique</p></a>
	<div>

    </main>

      <div id="toto">
<?php require_once('Controller/Bundle/over_desk2.php');?>
      </div>
    <div id="footer" class="plateform_title">
      <p id="p_footer">Code Camp Prep'ETNA 2021</p>
      </div> 
</div>
  </body>
  
</html>
