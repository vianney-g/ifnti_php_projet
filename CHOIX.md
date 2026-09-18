# Choix

## La fiche d'un livre

- **L'ISBN est une chaîne.** Il ne se calcule pas, il peut commencer par 0 (qu'un entier
  perdrait), et un ISBN-10 peut se terminer par X.
- **Le prix et la pénalité sont des entiers.** Le franc CFA n'a pas de centimes, et un `float` ne
  représente pas exactement toutes les valeurs : `0.1 + 0.2 === 0.3` est faux.
- **La disponibilité est calculée, jamais saisie.** Une variable écrite à la main finirait par
  contredire le nombre d'exemplaires le jour où l'on modifie l'un sans l'autre.
- **Les 100 FCFA par jour sont une constante.** Ce n'est pas une information du livre, c'est une
  règle de la bibliothèque, la même pour tous.
- **`mb_strtoupper`, `mb_strlen`, `mb_str_pad`.** Le titre et les étiquettes contiennent des
  accents ; les fonctions sans `mb_` comptent des octets, et « é » en occupe deux.

## Le catalogue

- **Les clés sont en français, au singulier** (`titre`, `auteur`, `annee`, `exemplaires`,
  `empruntes`, `prix`). Une règle vaut mieux qu'un choix par clé : on n'hésite plus en écrivant.
- **On stocke les exemplaires possédés et les exemplaires sortis, pas les disponibles.** Le
  troisième nombre se déduit des deux autres ; le garder à part, c'est se préparer à ce qu'il les
  contredise.
- **`array_values` après `array_filter`.** Le filtre garde les clés d'origine : sans lui, le
  résultat d'une recherche peut commencer à la clé 4, ce qui casse tout affichage numéroté.
- **Une recherche vide n'affiche pas un tableau vide** mais une phrase qui rappelle le terme
  cherché. Un tableau sans ligne ressemble à une panne.
- **La recherche ignore la casse, pas les accents.** `mb_strtolower` suffit pour `KOUROUMA`, mais
  chercher `ba` ne trouve pas `Bâ`. Limite acceptée pour l'instant : la réparer demande un outil
  que nous n'avons pas encore.
- **Le tri par titre suit l'ordre des octets**, donc `Éditions` passe après `Zèbre`. Même raison,
  même remise à plus tard.
