 <?php


/**
 * Affichage des photos
 */

function search_image($str) {

       $the_search = str_replace(' ', "+", $str);

        $url = "https://www.bing.com/images/search?q=".$the_search."%20affiche%20&qs=n&form=QBIR&scope=images&pq=".$the_search."%20affiche%20&sc=0-0&sp=-1&sk=";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $body = curl_exec($ch);

        curl_close($ch);

        preg_match_all('/<a [^>]*href=["|\']([^"|\']+.jpg)/i', $body, $image);

        return $image[1][0];
    
}

class Pictures2 {

    public function Pictures_Information() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'local.Films');
            $cursor = $collection->find();
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                    echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);

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
            $collection = new MongoCollection($db, 'local.Films');

            $cursor = $collection->find(array('categories' => $_GET['Categorie']));
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            $cursor2 = iterator_to_array($cursor);
            if (empty($cursor2)) {
                echo sprintf ("<div id='res'><h1>Result not found in this category :\</h1></div>");
            }
            else {
            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
              $essais = get_headers($url, 1);

              if (preg_match("#OK#i", $essais[0])) {
                echo sprintf("<div class='full_image'>
                <img class='image' src='%s'>
                <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                echo sprintf('<div class="over_description">
                <img class="over_image" src="%s">
                <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                echo sprintf('<strong>Avec :</strong> %s<br>
                <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                </div>
                </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
              }
              else {
                 echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                      echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                echo sprintf('<strong>Avec :</strong> %s<br>
                <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                </div>
                </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
              }
            }
            }
        }
        else {
            echo "Disconnected \n";
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
                  $url = $doc['URLPhoto'];
                  $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                }
            }
        }
    }

    public function search($string) {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'db_film');

            $test = $string;
            $regex = new MongoRegex("/" . $test . "/i");
            $cursor = $collection->find(array('Title' => $regex));

            $cursor2 = iterator_to_array($cursor);
            if (empty($cursor2)) {
                echo sprintf ("<div id='res'><h1>Result not found with this name :\</h1></div>");
            }
            else {
              foreach ($cursor as $doc) {

                  $url = $doc['URLPhoto'];
                  $essais = get_headers($url, 1);

                  if (preg_match("#OK#i", $essais[0])) {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='%s'>
                    <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                    echo sprintf('<div class="over_description">
                    <img class="over_image" src="%s">
                    <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                    echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                    <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                    echo sprintf('<strong>Avec :</strong> %s<br>
                    <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                    echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                    echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                    </div>
                    </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                  }
                  else {
                      echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                          echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                              echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                    <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                    echo sprintf('<strong>Avec :</strong> %s<br>
                    <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                    echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                    echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                    </div>
                    </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                  }
              }
            }
        }
        else {
              echo "Disconnected :\ \n";
          }
    }

    public function Sante() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'local.Sante');

            $cursor = $collection->find();
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }

    public function Doc() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'local.Documentaires');

            $cursor = $collection->find();
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }

    public function Jeunesse() {
        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'local.Jeunesse');

            $cursor = $collection->find();
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }

    public function Sport() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'local.Sports');

            $cursor = $collection->find();
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }

    public function Loisir() {

        if ($m = new MongoClient()) {

            $db = $m->selectDB('local');
            $collection = new MongoCollection($db, 'local.Loisirs');

            $cursor = $collection->find();
            $cursor->limit(30);
            $cursor->sort(array('PublicationDate' => -1));

            foreach ($cursor as $doc) {

                $url = $doc['URLPhoto'];
                $essais = get_headers($url, 1);

                if (preg_match("#OK#i", $essais[0])) {
                  echo sprintf("<div class='full_image'>
                  <img class='image' src='%s'>
                  <div class='image_title'><p> %s%s</p></div>", $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<div class="over_description">
                  <img class="over_image" src="%s">
                  <div class="full_desc"><h2 class="desc_title">%s%s</h2>', $doc['URLPhoto'], $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
                else {
                    echo sprintf("<div class='full_image'>
                    <img class='image' src='".search_image($doc['Title'])."'>
                 <div class='image_title'><p>%s</p></div>", $doc['Title'], PHP_EOL);
                        echo sprintf('<div class="over_description">
                    <img class="over_image" src="'.search_image($doc['Title']).'">
                    <div class="full_desc"><h2 class="desc_title">%s</h2>', $doc['Title'], PHP_EOL);
                  echo sprintf('<p class="info_film"> <strong>Durée :</strong> %s minutes<br>
                  <strong>Réalisateur :</strong> %s%s <br>', $doc['Duration'], $doc['director'], PHP_EOL);
                  echo sprintf('<strong>Avec :</strong> %s<br>
                  <strong>Genre :</strong> %s%s <br>', $doc['casts'], $doc['categories'], PHP_EOL);
                  echo sprintf('<strong>Plateforme :</strong><a href="https://%s"> %s </a> <br></p>', $doc['VODPlateforme'], $doc['VODPlateforme'], PHP_EOL);
                  echo sprintf('<p class="description">%s</p></div><a href="%s%s"><button class="over_button" style="vertical-align:middle"><span>Voir</span></button></a>
                  </div>
                  </div>', $doc['Plot'], $doc['URL'], PHP_EOL);
                }
            }
        }
        else {
            echo "Disconnected \n";
        }
    }
}
?>