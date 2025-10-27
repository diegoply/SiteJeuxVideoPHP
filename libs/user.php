<?php

function addUser(PDO $pdo, string $username, string $email, string $password): bool 
{
    $query = $pdo->prepare("INSERT INTO `user` (`email`, `password`, `username`) VALUES (:email, :password , :username); ");


    $password = password_hash($password, PASSWORD_DEFAULT).

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

function verifyEmail(array $user): array
{
    $errors = [];

    if (isset($user["email"])) {
        if ($user["email"] === "") {
            $errors["email"] = "Le champ Email ne doit pas être vide.";
        }
    } else {
        $errors["email"] = "Il manque le champ Email.";
    }

    return $errors;
}
