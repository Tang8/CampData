<?php

error_reporting(0);


if (isset($argv[2]))
    {
        echo "Il ne faut pas de deuxieme argument après le premier !!! \n";
    }
else if (file_exists($argv[1])) {

    $text=fopen($argv[1],'r') or die("Fichier manquant");
    $contenu = file_get_contents($argv[1], 153);
    $contenuMod = str_replace('production-country', 'production_country', $contenu);
    $contenuMod2 = str_replace('production-countries', 'production_countries', $contenuMod);
    fclose($text);


    $text2=fopen($argv[1],'w+') or die("Fichier manquant");
    fwrite($text2,$contenuMod2);
    fclose($text2);
    
    $movies = simplexml_load_file($argv[1]);

    preg_match("/\S+.xml/", $argv[1], $matches);

    if (isset($matches[0][0])) {

        
        $connection = new MongoClient("mongodb://localhost:27017");
        if ($db = $connection->local) {
            
            $name = "Films";
            $name1 = "Sante";
            $name2 = "Documentaires";
            $name3 = "Jeunesse";
            $name4 = "Loisirs";
            $name5 = "Sports";

            echo "Status : Connected \n \n";
            $collection = $db->command(array(
                "create" => $name
            ));

            $collection1 = $db->command(array(
                "create" => $name1
            ));
            
            $collection2 = $db->command(array(
                "create" => $name2
            ));

            
            $collection3 = $db->command(array(
                "create" => $name3
            ));
            
            
            $collection4 = $db->command(array(
                "create" => $name4
            ));

            $collection5 = $db->command(array(
                "create" => $name5
            ));
            
            
            echo "Database selected \n";
            
            
            $count = 0;
            
            while ($movies->movie[$count]->title != NULL) {
                
                $coup = 0;
                $coup2 = 0;
                $coup3 = 0;
                
                while ($movies->movie[$count]->Language[$coup] != NULL) {
                    $language = $language . " " . $movies->movie[$count]->Language[$coup];
                    $coup = $coup + 1;
                }
                
                
                while ($movies->movie[$count]->casts->cast[$coup2] != NULL) {
                    $cast = $cast . " " . $movies->movie[$count]->casts->cast[$coup2];
                    $coup2 = $coup2 + 1;
                }
                
                while ($movies->movie[$count]->categories->category[$coup3] != NULL)
                    {
                        $category = $category . " " . $movies->movie[$count]->categories->category[$coup3];
                        $coup3 = $coup3 + 1;;
                    }

                $Title = "" . $movies->movie[$count]->Title;
                $OriginalTitle = "" . $movies->movie[$count]->OriginalTitle;
                $Plot = "" . $movies->movie[$count]->Plot;
                $PublicationDate = "" . $movies->movie[$count]->PublicationDate;
                $VOD = "" . $movies->movie[$count]->VODPlateforme;
                $Duration = "" . $movies->movie[$count]->Duration;
                $ID = "" . $movies->movie[$count]->ID;
                $Format = "" . $movies->movie[$count]->Format;
                $URl = "" . $movies->movie[$count]->URL;
                $URL2 = "" . $movies->movie[$count]->URLPhoto;
                $director = "" . $movies->movie[$count]->directors->director;
                $prod = " " . $movies->movie[$count]->production_countries->production_country;
                $cat = "" . $movies->movie[$count]->categories->category;

                $doc = array("Title" => $Title,
                    "OriginalTitle" => $OriginalTitle,
                    "Plot" => $Plot,
                    "PublicationDate" => $PublicationDate,
                    "Language" => $language,
                    "VODPlateforme" => $VOD,
                    "Duration" => $Duration,
                    "ID" => $ID,
                    "Format" => $Format,
                    "URL" => $URl,
                    "URLPhoto" => $URL2,
                    "director" => $director,
                    "casts" => $cast,
                    "production-country" => $prod,
                	"categories" => $cat);

                $ref = &$doc;

                if ($cat == "Films")
                    {
                        $test = $db->local->Films;
                        
                        if ($test->insert($ref)) {
                            echo "Row inserted successfully \n";
                        }
                        else {
                            echo "Row doesn't insert into database \n";
                        }
                        
                    }
                else if ($cat == "Loisirs")
                    {
                        $test = $db->local->Loisirs;
                        
                        if ($test->insert($ref)) {
                            echo "Row inserted successfully \n";
                        }
                        else {
                            echo "Row doesn't insert into database \n";
                        }
                    }
                else if ($cat == "Sports et jeux")
                    {
                        $test = $db->local->Sports;

                        if ($test->insert($ref)) {
                            echo "Row inserted successfully \n";
                        }
                        else {
                            echo "Row doesn't insert into database \n";
                        }
                    }
                else if ($cat == "Santé, bien-être")
                    {
                        $test = $db->local->Sante;

                        if ($test->insert($ref)) {
                            echo "Row inserted successfully \n";
                        }
                        else {
                            echo "Row doesn't insert into database \n";
                        }
                    }
                else if ($cat == "Jeunesse")
                    {
                        $test = $db->local->Jeunesse;

                        if ($test->insert($ref)) {
                            echo "Row inserted successfully \n";
                        }
                        else {
                            echo "Row doesn't insert into database \n";
                        }
                    }
                else if ($cat == "Documentaires")
                    {
                        $test = $db->local->Documentaires;

                        if ($test->insert($ref)) {
                            echo "Row inserted successfully \n";
                        }
                        else {
                            echo "Row doesn't insert into database \n";
                        }
                    }
                else {
                    $test = $db->local->Films;

                    if ($test->insert($ref)) {
                        echo "Row inserted successfully \n";
                    }
                    else {
                        echo "Row doesn't insert into database \n";
                    }
                }
                
                $language = '';
                $cast = '';
                $category = '';
                $count = $count + 1;
            }            
            echo "DONE \n";
        }
    else {
        
        echo "Not Connected";
        
        }
        
    }
    
    else {
        
        echo "Le fichier n'est pas au bon format !! \n";
        
    }

}
else {
    exit("Echec lors de l\'ouverture du fichier en question \n");
}

?>