<?php

declare(strict_types=1);

// Catalogue de la bibliothèque de l'IFNTI.
//   php catalogue.php            toutes les fiches
//   php catalogue.php kourouma   seulement les livres de cet auteur

const LARGEUR_TITRE = 32;
const LARGEUR_AUTEUR = 20;

// Rangés par année de parution, à la main : trier un tableau de tableaux demande une
// fonction de comparaison, que nous ne savons pas encore écrire.
$livres = [
    ["titre" => "L'Enfant noir", "auteur" => "Camara Laye", "annee" => 1953, "exemplaires" => 5, "empruntes" => 5, "prix" => 3800],
    ["titre" => "Le Fils du fétiche", "auteur" => "David Ananou", "annee" => 1955, "exemplaires" => 3, "empruntes" => 1, "prix" => 4500],
    ["titre" => "Les Soleils des indépendances", "auteur" => "Ahmadou Kourouma", "annee" => 1968, "exemplaires" => 2, "empruntes" => 1, "prix" => 5200],
    ["titre" => "Une si longue lettre", "auteur" => "Mariama Bâ", "annee" => 1979, "exemplaires" => 3, "empruntes" => 2, "prix" => 4000],
    ["titre" => "Le Pleurer-Rire", "auteur" => "Henri Lopes", "annee" => 1982, "exemplaires" => 1, "empruntes" => 0, "prix" => 4800],
    ["titre" => "Allah n'est pas obligé", "auteur" => "Ahmadou Kourouma", "annee" => 2000, "exemplaires" => 4, "empruntes" => 0, "prix" => 6000],
];

$recherche = $argv[1] ?? "";

if ($recherche !== "") {
    $resultats = [];

    foreach ($livres as $livre) {
        if (str_contains(mb_strtolower($livre["auteur"]), mb_strtolower($recherche))) {
            $resultats[] = $livre;
        }
    }

    $livres = $resultats;
}

if ($livres === []) {
    echo "Aucun livre ne correspond à « $recherche ».\n";
    exit;
}

echo mb_str_pad("Titre", LARGEUR_TITRE), mb_str_pad("Auteur", LARGEUR_AUTEUR), "Année  Disponibles\n";
echo str_repeat("-", LARGEUR_TITRE + LARGEUR_AUTEUR + 18), "\n";

foreach ($livres as $livre) {
    $disponibles = $livre["exemplaires"] - $livre["empruntes"];
    $etat = match (true) {
        $disponibles === 0 => "aucun",
        $disponibles === 1 => "1 (le dernier)",
        default => "$disponibles",
    };

    echo mb_str_pad($livre["titre"], LARGEUR_TITRE),
        mb_str_pad($livre["auteur"], LARGEUR_AUTEUR),
        mb_str_pad((string) $livre["annee"], 7),
        $etat,
        "\n";
}

$exemplaires = array_sum(array_column($livres, "exemplaires"));
$empruntes = array_sum(array_column($livres, "empruntes"));
$valeur = 0;

foreach ($livres as $livre) {
    $valeur += $livre["prix"] * $livre["exemplaires"];
}

$titres = count($livres);

echo "\n";
// Trois fois la même ponctuation à la main : la semaine prochaine, une fonction.
echo $titres, $titres > 1 ? " titres, " : " titre, ",
    $exemplaires, $exemplaires > 1 ? " exemplaires, dont " : " exemplaire, dont ",
    $empruntes, $empruntes > 1 ? " sortis.\n" : " sorti.\n";
echo "Valeur du fonds : ", number_format($valeur, 0, ",", " "), " FCFA.\n";
