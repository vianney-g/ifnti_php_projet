<?php

declare(strict_types=1);

// Fiche d'un livre de la bibliothèque de l'IFNTI.
// Les montants sont en FCFA, donc des entiers : le franc CFA n'a pas de centimes.

const PENALITE_PAR_JOUR = 100;
const LARGEUR_ETIQUETTE = 14;

$isbn = "978-2-00-000000-0"; // fictif. Une chaîne : un ISBN ne se calcule pas, et peut contenir un X
$titre = "Le Fils du fétiche";
$auteur = "David Ananou";
$anneeParution = 1955;
$nbExemplaires = 3;
$nbEmpruntes = 1;
$prixAchat = 4500;
$joursDeRetard = 3;

$titreAffiche = mb_strtoupper($titre);
$cadre = str_repeat("=", mb_strlen($titreAffiche));
$age = (int) date("Y") - $anneeParution;
$disponible = $nbEmpruntes < $nbExemplaires;
$penalite = $joursDeRetard * PENALITE_PAR_JOUR;

echo $cadre, "\n";
echo $titreAffiche, "\n";
echo $cadre, "\n";
echo mb_str_pad("Auteur", LARGEUR_ETIQUETTE), ": $auteur\n";
echo mb_str_pad("Parution", LARGEUR_ETIQUETTE), ": $anneeParution (il y a $age ans)\n";
echo mb_str_pad("ISBN", LARGEUR_ETIQUETTE), ": $isbn\n";
echo mb_str_pad("Exemplaires", LARGEUR_ETIQUETTE), ": $nbExemplaires, dont $nbEmpruntes "
    . ($nbEmpruntes > 1 ? "empruntés" : "emprunté") . "\n";
echo mb_str_pad("Disponible", LARGEUR_ETIQUETTE), ": " . ($disponible ? "oui" : "non") . "\n";
echo mb_str_pad("Prix d'achat", LARGEUR_ETIQUETTE), ": " . number_format($prixAchat, 0, ",", " ") . " FCFA\n";
echo mb_str_pad("Pénalité", LARGEUR_ETIQUETTE), ": " . number_format($penalite, 0, ",", " ")
    . " FCFA pour $joursDeRetard " . ($joursDeRetard > 1 ? "jours" : "jour") . " de retard\n";
echo $cadre, "\n";
