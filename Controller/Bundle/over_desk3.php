<?php
require('Controller/Src/Pictures2.php');

echo '<div id="Nos_films">
<div id="film_image">';
$object = new Pictures2();
$object->all_serie();
echo '</div>';
?>