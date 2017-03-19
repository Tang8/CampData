<?php
require('Controller/Src/Pictures2.php');

echo '<div id="Nos_films">
<div id="film_image">';

if (isset($_GET['query'])) {
    $object = new Pictures2();
    $object->search($_GET['query']);
}
else {
    echo "Aucun résultat :\ ";
}
echo '</div>';
?>