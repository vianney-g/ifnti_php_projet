<?php

declare(strict_types=1);

// Les tests de bibliotheque.php. Se lance par : php tests.php

require __DIR__ . "/bibliotheque.php";

function verifie(string $cas, mixed $attendu, mixed $obtenu): void
{
    if ($attendu === $obtenu) {
        echo "  ok    $cas\n";

        return;
    }

    $attenduTexte = var_export($attendu, true);
    $obtenuTexte = var_export($obtenu, true);

    echo "ÉCHEC   $cas\n";
    echo "        attendu : $attenduTexte\n";
    echo "        obtenu  : $obtenuTexte\n";
}

echo "accorder\n";
verifie("le pluriel ajoute un s", "3 titres", accorder(3, "titre"));
verifie("un seul reste au singulier", "1 titre", accorder(1, "titre"));
verifie("zéro reste au singulier", "0 titre", accorder(0, "titre"));
verifie("un pluriel irrégulier se donne", "2 journaux", accorder(2, "journal", "journaux"));

echo "calculerPenalite\n";
verifie("trois jours de retard coûtent 300", 300, calculerPenalite(3));
verifie("aucun retard ne coûte rien", 0, calculerPenalite(0));
verifie("un retour en avance ne rapporte rien", 0, calculerPenalite(-5));
verifie("le tarif se choisit", 150, calculerPenalite(3, 50));

$livre = ["titre" => "Le Fils du fétiche", "auteur" => "David Ananou", "exemplaires" => 3, "empruntes" => 1];
$dernier = ["titre" => "Le Pleurer-Rire", "auteur" => "Henri Lopes", "exemplaires" => 1, "empruntes" => 0];
$tousSortis = ["titre" => "L'Enfant noir", "auteur" => "Camara Laye", "exemplaires" => 5, "empruntes" => 5];

echo "peutEmprunter\n";
verifie("un adhérent sans emprunt peut emprunter", true, peutEmprunter($livre, 0, false));
verifie("le dernier exemplaire s'emprunte", true, peutEmprunter($dernier, 0, false));
verifie("aucun exemplaire, aucun emprunt", false, peutEmprunter($tousSortis, 0, false));
verifie("deux emprunts en cours, encore un permis", true, peutEmprunter($livre, 2, false));
verifie("trois emprunts en cours, c'est fini", false, peutEmprunter($livre, 3, false));
verifie("un retard en cours bloque tout", false, peutEmprunter($livre, 0, true));

echo "emprunter\n";
$apres = emprunter($livre);
verifie("un emprunt augmente les sorties", 2, $apres["empruntes"]);
verifie("le livre d'origine n'a pas bougé", 1, $livre["empruntes"]);

echo "rechercherParAuteur\n";
$livres = [$tousSortis, $dernier, $livre];
$resultats = rechercherParAuteur($livres, "ananou");
verifie("on trouve le livre d'Ananou", 1, count($resultats));
verifie("le premier résultat est en case 0", "Le Fils du fétiche", $resultats[0]["titre"] ?? null);
verifie("la casse ne compte pas", 1, count(rechercherParAuteur($livres, "ANANOU")));
verifie("un auteur absent ne donne rien", [], rechercherParAuteur($livres, "kourouma"));
