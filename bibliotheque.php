<?php

declare(strict_types=1);

// Les règles de la bibliothèque de l'IFNTI, en fonctions.
// Aucune n'affiche rien : elles calculent et rendent, donc elles se testent (voir tests.php).

const PENALITE_PAR_JOUR = 100;
const EMPRUNTS_MAX = 3;

function accorder(int $nombre, string $singulier, ?string $pluriel = null): string
{
    $pluriel = $pluriel ?? $singulier . "s";
    $mot = $nombre > 1 ? $pluriel : $singulier;

    return "$nombre $mot";
}

function calculerPenalite(int $joursDeRetard, int $tarifParJour = PENALITE_PAR_JOUR): int
{
    return max(0, $joursDeRetard) * $tarifParJour;
}

function disponibles(array $livre): int
{
    return $livre["exemplaires"] - $livre["empruntes"];
}

function estDisponible(array $livre): bool
{
    return disponibles($livre) > 0;
}

function peutEmprunter(array $livre, int $enCours, bool $enRetard): bool
{
    return estDisponible($livre)
        && $enCours < EMPRUNTS_MAX
        && !$enRetard;
}

function emprunter(array $livre): array
{
    $livre["empruntes"]++;

    return $livre;
}

function rechercherParAuteur(array $livres, string $terme): array
{
    $terme = mb_strtolower($terme);
    $resultats = array_filter(
        $livres,
        fn(array $livre): bool => str_contains(mb_strtolower($livre["auteur"]), $terme),
    );

    return array_values($resultats);
}

function parAnnee(array $a, array $b): int
{
    return $a["annee"] <=> $b["annee"];
}

function valeurDuFonds(array $livres): int
{
    return array_sum(array_map(
        fn(array $livre): int => $livre["prix"] * $livre["exemplaires"],
        $livres,
    ));
}
