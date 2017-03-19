<?php

function search_image ($str) {

    $the_search = str_replace(' ', "%20", $str);



        $url = "https://www.bing.com/images/search?q=".$the_search."%20affiche%20&qs=n&form=QBIR&scope=images&pq=".$the_search."%20affiche\
%20&sc=0-0&sp=-1&sk=";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $body = curl_exec($ch);

        curl_close($ch);

        preg_match_all('/([^"|\']+.jpg)/i', $body, $image);

        echo $image[1][0];
                



}



//search_image ("BATMAN VS. ROBINBATMAN VS. ROBIN");
?>

