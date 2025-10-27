<?php

function getAllGames(PDO $pdo, ?int $limit = null)
{
    $sql = "SELECT g.id, g.name, g.description, g.release_date FROM game g ORDER BY g.release_date DESC";
    
    if ($limit) {
        $sql .= " LIMIT :limit"; // note l'espace avant LIMIT
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function getGame(int $id){

    $games = getAllGames();
    return $games[$id];

}