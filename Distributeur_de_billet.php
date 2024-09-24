<?php
//Déclaration des variables
$Billets = [50, 20, 10, 5, 2, 1];
$Pieces = [50, 20, 10];
$check = false;
$somme_partie_entiere = 0;
$somme_partie_decimale = 0;
$monnaie = "billet(s)";
//Traitement de l'entrée console
while (!$check) {
    $somme = readline("Entrez la somme d'argent à retirer : ");
    if (is_numeric($somme)) {
        $somme_partie_entiere = floor($somme);
        $somme_partie_decimale = round($somme -  $somme_partie_entiere, 2);
        if (fmod($somme_partie_decimale * 100, 10) != 0) {
            printf("Veuillez entrer une somme valable\n");
            continue;
        }
        $check = true;
    } else {
        printf("Format non reconnu \n");
    }
}
printf("\n Recevez : \n");
//Traitement de la donnée pour la partie entière et affichage 
foreach ($Billets as $b) {
    $quantité = intdiv($somme_partie_entiere, $b);
    if ($somme_partie_entiere >= 1) {
        if ($quantité >= 1) {
            $somme_partie_entiere = $somme_partie_entiere - $quantité * $b; //Calcul du reste 
        }
        if ($b <= 2) {
            $monnaie = "pièce(s)";
        }
        printf("$quantité $monnaie de $b euros\n");
    }
}
//Traitement de la donnée pour la partie décimale et affichage
$somme_partie_decimale_traitée = $somme_partie_decimale * 100; //Pour faciliter le calcul en type int
foreach ($Pieces as $p) {
    if ($somme_partie_decimale_traitée < 10)
        return;
    $quantité = floor($somme_partie_decimale_traitée / $p); //Arrondir la quantité partie entière uniquement
    if ($somme_partie_decimale_traitée >= 10) {
        if ($quantité >= 1) {
            $somme_partie_decimale_traitée = $somme_partie_decimale_traitée - $quantité * $p;
            $somme_partie_decimale_traitée = round($somme_partie_decimale_traitée, 0); //Arrondir le nombre décimal au nombre sup'
        }
        printf("$quantité pièce(s) de $p centime(s) d'euros\n");
    }
}
