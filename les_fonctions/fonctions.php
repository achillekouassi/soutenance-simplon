<?php

// Recherche un utilisateur en fonction de son login
function rechercher_par_login($login){
    global $pdo;
    $requete=$pdo->prepare("select * from utilisateur where login =?");
    $requete->execute(array($login));
    return $requete->rowCount();
}

// Recherche un utilisateur en fonction de son email
function rechercher_par_email($email){
    global $pdo;
    $requete=$pdo->prepare("select * from utilisateur where email =?");
    $requete->execute(array($email));
    return $requete->rowCount();
}

// Recherche un utilisateur en fonction de son email et renvoie toutes les informations de l'utilisateur
function rechercher_user_par_email($email){
    global $pdo;

    $requete=$pdo->prepare("select * from utilisateur where email =?");

    $requete->execute(array($email));

    $user=$requete->fetch();

    // Si l'utilisateur est trouvé, renvoie ses informations
    if($user)
        return $user;
    // Sinon, renvoie null
    else
        return null;
}
