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
