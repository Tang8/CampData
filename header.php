<?php

echo '

<div id="mySidenav" class="sidenav">
  <a href="https://www.hadopi.fr/" id="site">Hadopi site</a>
  <a href="https://fr.wikipedia.org/wiki/Haute_Autorit%C3%A9_pour_la_diffusion_des_%C5%93uvres_et_la_protection_des_droits_sur_internet" id="about">About</a>
	</div>

<div id="headerlogo">
     <a href="index.php"><img id="logo" src="photo_slide/ha.png" /></a>
<div>
<header id="header">
     <div id="menu_search">
     <div class="recherche_p" id="barsearch">
     	  <form id="searchthis" method="post" action="Controller/Bundle/powa.php">
     	  <input type="text" id="search" name="text" placeholder="Recherche film, série, catégorie.. ">
     	  <input type="submit" id="search-btn" value="Rechercher">
     	  </form>
     </div>
     <div id="menu_bar">
     <ul id="ul_bar">
      <div class="dropdown">
     	 <li id="li" class="li_film"><a href="film.php" id="title_menu"> Films </a></li>
	 <div class="dropdown-content">
	 <p><a id="title_dropdown" href="film.php?Categorie=Action">Action<a></p>
    	 <p><a id="title_dropdown" href="film.php?Categorie=Aventure">Aventure<a></p>
	 <p><a id="title_dropdown" href="film.php?Categorie=Western">Western<a></p>
	 <p><a id="title_dropdown" href="film.php?Categorie=Comique">Comique<a></p>
	       </div>
	       </div>
	       <div class="dropdown">
     	 <li id="li" class="li_serie"><a href="serie.php" id="title_menu"> Séries </a></li>
		</div>
	 <div class="dropdown">
     	 <li id="li"><a href="sante_bien-etre.php" id="title_menu"> Santé bien-etre </a></li>
	  </div>
	 <div class="dropdown">
     	 <li id="li"><a href="documentaire.php" id="title_menu"> Documentaires </a></li>
	 </div>
	 <div class="dropdown">
     	 <li id="li"><a href="jeunesse.php" id="title_menu"> Jeunesse </a></li>
	 </div>
	 <div class="dropdown">
     	 <li id="li"><a href="sports_jeux.php" id="title_menu"> Sports et jeux </a></li>
</div>
</div>
				     
				                    </div>
     </ul>
     </div>
     </div>
</header>
';

?>