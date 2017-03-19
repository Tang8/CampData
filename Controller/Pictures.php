 <?php

/**
 * Affichage des photos
 */

class Pictures {

    public function Pictures_Information() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');

            $cursor = $collection->find(array('categories' => 'Films'));
            $cursor->limit(28);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                    echo sprintf("<div class='full_image'>
                <a href='#'><img class='image' src='%s'></a>
                <div class='image_title'> %s%s</div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                echo sprintf('<div class="over_description">
				<a href="#"><img class="over_image" src="%s"></a>
                <div class="desc">', $doc['URLPhoto'], PHP_EOL);
                echo sprintf('<h2>%s</h2><p> %s%s</p>
                </div>
				</div>
				</div>', $doc['Title'], $doc['Plot'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                <a href='#'><img class='image' src='../photo_slide/Image-Not-Found.png'></a>
                <div class='image_title'> %s</div>", $doc['Title'], PHP_EOL);
                echo sprintf('<div class="over_description">
                <a href="#"><img class="over_image" src="../photo_slide/Image-Not-Found.png"></a>
                <div class="desc">', PHP_EOL);
                echo sprintf('<h2>%s</h2><p> %s%s</p>
                </div>
                </div>
                </div>', $doc['Title'], $doc['Plot'], PHP_EOL);
                }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }

    public function Categorie_film() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');

            $cursor = $collection->find(array('categories' => $_GET['Categorie']));
            $cursor->limit(14);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

              $url = $doc['URLPhoto'];
              $essais = get_headers($url, 1);

              if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
              <a href='#'><img class='image' src='%s'></a>
              <div class='image_title'> %s%s</div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
              echo sprintf('<div class="over_description">
      <a href="#"><img class="over_image" src="%s"></a>
              <div class="desc">', $doc['URLPhoto'], PHP_EOL);
              echo sprintf('<h2>%s</h2><p> %s%s</p>
              </div>
      </div>
      </div>', $doc['Title'], $doc['Plot'], PHP_EOL);
              }
              else {
                  echo sprintf("<div class='full_image'>
              <a href='#'><img class='image' src='../photo_slide/Image-Not-Found.png'></a>
              <div class='image_title'> %s</div>", $doc['Title'], PHP_EOL);
              echo sprintf('<div class="over_description">
              <a href="#"><img class="over_image" src="../photo_slide/Image-Not-Found.png"></a>
              <div class="desc">', PHP_EOL);
              echo sprintf('<h2>%s</h2><p> %s%s</p>
              </div>
              </div>
              </div>', $doc['Title'], $doc['Plot'], PHP_EOL);
              }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }

    public function film_pictures() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');

            $cursor = $collection->findOne(array('Title' => $_GET['Title']));

            // A completer
        }

    }

    public function all_serie() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');

            $cursor = $collection->find();

            foreach ($cursor as $doc) {

                preg_match("/ .+ - Saison .$/", $doc['Title'], $matches);

                if (!isset($matches[0][0])) {
                    echo sprintf("");
                }
                else {
                    echo sprintf("<a href='film.php?Title=%s&Photo=%s%s'>", $doc['Title'], $doc['URLPhoto'], PHP_EOL);
                    echo sprintf("<img src='%s' alt='Photo' width='120'></a>", $doc['URLPhoto'], PHP_EOL);
                }
            }
        }
    }

    public function film() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');

            $test = "100% CAPOEIRA";
            $test2 = $_GET[''];
            $cursor = $collection->findOne(array('Title' => $test));

            if (!empty($cursor)) {
                echo $cursor['_id'] . "\n";
                echo $cursor['Title'] . "\n";

                // A compléter !!

            }
            else {
                echo "Films not found :\ \n";
            }
        }
    }

    public function NVX_film() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');


            $cursor = $collection->find();
            $cursor->limit(6);
            $cursor->sort(array('PublicationDate' => -1));


            foreach ($cursor as $doc) {

                echo sprintf("<div class='full_image'>
                <img class='image' src='%s'>
                <div class='image_title'> %s%s</div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                echo sprintf('<div class="over_description">
                <img class="over_image" src="%s">
                <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                    //echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minute<br>
                    //<strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                    // echo sprintf('<strong>Plateforme :</strong> %s <br></p>', $doc['VODPlateforme'], PHP_EOL);     
                     echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                </div>
                </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
            }
        }
        else {
            echo "Disconnected :\ \n";
        }
    }

}
?>
