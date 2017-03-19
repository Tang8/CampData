<?php

require('Controller/Src/Pictures.php');

echo '<div id="Nos_films">
<h1 id="sous_titre">Nouveautés</h1>
<div id="film_image">';

$object = new Pictures();
$object->NVX_film();

echo '</div>';

?>