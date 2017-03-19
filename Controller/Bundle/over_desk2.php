<?php

require('Controller/Src/Pictures2.php');

echo '<div id="Nos_films">
<div id="film_image">';
if (!isset($_GET['Categorie'])) {
    $object = new Pictures2();
    $object->Pictures_Information();
    }
else {
    $object = new Pictures2();
    $object->Categorie_film();
}
echo '</div>';
?>