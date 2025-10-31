<?php

function getAllGames(PDO $pdo, ?int $limit = null)
{
    $sql = "SELECT g.id, g.name, g.description, g.release_date, g.image FROM game g ORDER BY g.release_date DESC";
    
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

function getGamesByGenre(PDO $pdo, ?string $genre = null, ?int $limit = null): array {
    $sql = "
        SELECT g.id, g.name, g.description, g.release_date, g.image, e.name AS editor,
               GROUP_CONCAT(ge.name SEPARATOR ', ') AS genres
        FROM game g
        JOIN editor e ON g.editor_id = e.id
        JOIN game_genre gg ON g.id = gg.game_id
        JOIN genre ge ON gg.genre_id = ge.id
    ";

    // Si un genre est précisé
    if ($genre) {
        $sql .= " WHERE ge.name = :genre";
    }

    $sql .= " GROUP BY g.id ORDER BY g.release_date DESC";

    // Si une limite est précisée
    if ($limit) {
        $sql .= " LIMIT :limit";
    }

    $stmt = $pdo->prepare($sql);

    // Bind du genre si présent
    if ($genre) {
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    }

    // Bind de la limite si présente
    if ($limit) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAllGenres(PDO $pdo): array {
    $stmt = $pdo->query("SELECT name FROM genre ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}


function getGame(PDO $pdo, int $id):array|bool {

    $sql = "SELECT g.id, g.name, g.description, g.release_date, g.image, e.name AS editor_name
    FROM game g
    LEFT JOIN editor e ON e.id = g.editor_id 
    WHERE g.id = :id";

    $query = $pdo->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);

    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}