<!DOCTYPE html>
<html lang = "en">

  <head>
    <meta charset = "UTF-8">
      <title>Hadopi Stream</title>
      <link rel="stylesheet" type="text/css" href="view/index.css">
      <link rel="stylesheet" type="text/css" href="view/view_movie.css">
      <link rel="stylesheet" type="text/css" href="../../view/slide.css">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="../../JS/display_slide.js"></script>
      <link rel="icon" type="image/png" href="photo_slide/dop.png">
      </head>

  <body>
    <?php require 'header.php';?>
    <br/>
    
    <main>
      <?php require 'Controller/slide.php'; ?>
      <?php require 'Controller/Bundle/over_desc.php'; ?>
    </main>

    <script src="display_slide.js"></script>

    <div id="footer" class="plateform_title">
      <p id="p_footer">Code Camp Prep'ETNA 2021</p>
      </div>

  </body>
  
</html>
