<?php

declare(strict_types=1);

// Catalogue de la bibliothèque de l'IFNTI.
//   php catalogue.php            toutes les fiches
//   php catalogue.php kourouma   seulement les livres de cet auteur

require __DIR__ . "/bibliotheque.php";

const LARGEUR_TITRE = 32;
const LARGEUR_AUTEUR = 20;

$livres = [
    ["titre" => "Le Fils du fétiche", "auteur" => "David Ananou", "annee" => 1955, "exemplaires" => 3, "empruntes" => 1, "prix" => 4500],
    ["titre" => "L'Enfant noir", "auteur" => "Camara Laye", "annee" => 1953, "exemplaires" => 5, "empruntes" => 5, "prix" => 3800],
    ["titre" => "Les Soleils des indépendances", "auteur" => "Ahmadou Kourouma", "annee" => 1968, "exemplaires" => 2, "empruntes" => 1, "prix" => 5200],
    ["titre" => "Allah n'est pas obligé", "auteur" => "Ahmadou Kourouma", "annee" => 2000, "exemplaires" => 4, "empruntes" => 0, "prix" => 6000],
    ["titre" => "Une si longue lettre", "auteur" => "Mariama Bâ", "annee" => 1979, "exemplaires" => 3, "empruntes" => 2, "prix" => 4000],
    ["titre" => "Le Pleurer-Rire", "auteur" => "Henri Lopes", "annee" => 1982, "exemplaires" => 1, "empruntes" => 0, "prix" => 4800],
];

$recherche = $argv[1] ?? "";

if ($recherche !== "") {
    $livres = rechercherParAuteur($livres, $recherche);
}

if ($livres === []) {
    echo "Aucun livre ne correspond à « $recherche ».\n";
    exit;
}

usort($livres, parAnnee(...));

echo mb_str_pad("Titre", LARGEUR_TITRE), mb_str_pad("Auteur", LARGEUR_AUTEUR), "Année  Disponibles\n";
echo str_repeat("-", LARGEUR_TITRE + LARGEUR_AUTEUR + 18), "\n";

foreach ($livres as $livre) {
    $etat = match (disponibles($livre)) {
        0 => "aucun",
        1 => "1 (le dernier)",
        default => (string) disponibles($livre),
    };

    echo mb_str_pad($livre["titre"], LARGEUR_TITRE),
        mb_str_pad($livre["auteur"], LARGEUR_AUTEUR),
        mb_str_pad((string) $livre["annee"], 7),
        $etat,
        "\n";
}

$exemplaires = array_sum(array_column($livres, "exemplaires"));
$empruntes = array_sum(array_column($livres, "empruntes"));

echo "\n";
echo accorder(count($livres), "titre"), ", ",
    accorder($exemplaires, "exemplaire"), ", dont ",
    accorder($empruntes, "sorti"), ".\n";
echo "Valeur du fonds : ", number_format(valeurDuFonds($livres), 0, ",", " "), " FCFA.\n";
