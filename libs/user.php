<?php

function addUser(PDO $pdo, string $username, string $email, string $password): bool 
{
    $query = $pdo->prepare("INSERT INTO `user` (`email`, `password`, `username`) VALUES (:email, :password , :username); ");


    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindValue(":email", $email);
    $query->bindValue(":password", $password);
    $query->bindValue(":username", $username);

    return $query->execute();
}


function verifyUser(array $user): array
{
    $errors = [];

    if (isset($user["username"])) {
        if ($user["username"] === "") {
            $errors["username"] = "Le champ Pseudo ne doit pas être vide.";
        }
    } else {
        $errors["username"] = "Il manque le champ Pseudo.";
    }

    return $errors;
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password): bool|array
{
    $query = $pdo->prepare("SELECT id, username, email, password FROM user WHERE email = :email");
    $query->bindValue(":email", $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // var_dump($user);
    // exit;


    if ($user && password_verify($password, $user["password"])) {
        return $user;
    }

    return false;
}


 