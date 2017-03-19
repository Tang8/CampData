function function1()
{    
    madiv = document.getElementById("p1");
    madiv.innerHTML = "<div style='width : 500px;'><form><fieldset><legend style='text-align: center;'>Description : </legend><div style='width : 200px;float:left;'><img src='fury.jpg'  style='width:150px;height:250px;'></div><div style ='margin-left: 430px'><button onclick='function2()'>Fermer X</button></div><div style='margin-left:200px; width: 300px'><p>Titre : Fury</p><p>Titre Originale : Fury</p><p>Categorie : Action</p><p>Annee de sortie : 2014</p><p>Durée : 2h34</p><p>Description : Avril 1945. Les Alliés mènent leur ultime offensive en Europe. À bord d’un tank Sherman, le sergent Wardaddy et ses quatre hommes s’engagent dans une mission à très haut risque bien au-delà des lignes ennemies. Face à un adversaire dont le nombre et la puissance de feu les dépassent, Wardaddy et son équipage vont devoir tout tenter pour frapper l’Allemagne nazie en plein cœur…</p><p>Site internet : <a href='https://www.google.fr'>google.fr</a></p><p>Controle parentale : NON</p><p>Format : 16:9</p><p>URL du film : </p><button onclick='function2()'>Fermer X</button></div></fieldset></form></div>";
}

function function2()
{
    document.getElementById("p1").innerHTML = "";
}

