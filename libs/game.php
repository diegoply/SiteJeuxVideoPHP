<?php


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

function getAllGames(PDO $pdo, ?int $limit = null): array {
    $sql = "SELECT g.id, g.name, g.description, g.release_date, g.image 
            FROM game g ORDER BY g.release_date DESC";
    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    $stmt = $pdo->prepare($sql);
    if ($limit) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// GENRES
function getGamesByGenre(PDO $pdo, ?string $genre = null, ?int $limit = null): array {
    $sql = "
        SELECT g.id, g.name, g.description, g.release_date, g.image, e.name AS editor,
               GROUP_CONCAT(ge.name SEPARATOR ', ') AS genres
        FROM game g
        JOIN editor e ON g.editor_id = e.id
        JOIN game_genre gg ON g.id = gg.game_id
        JOIN genre ge ON gg.genre_id = ge.id
    ";

    if ($genre) {
        $sql .= " WHERE ge.name = :genre";
    }

    $sql .= " GROUP BY g.id ORDER BY g.release_date DESC";

    if ($limit) {
        $sql .= " LIMIT :limit";
    }

    $stmt = $pdo->prepare($sql);

    if ($genre) {
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    }
    if ($limit) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGamesByEditor(PDO $pdo, ?int $editorId = null, ?int $limit = null): array {
    $sql = "
        SELECT g.id, g.name, g.description, g.release_date, g.image, e.name AS editor,
               GROUP_CONCAT(ge.name SEPARATOR ', ') AS genres
        FROM game g
        JOIN editor e ON g.editor_id = e.id
        JOIN game_genre gg ON g.id = gg.game_id
        JOIN genre ge ON gg.genre_id = ge.id
    ";

    if ($editorId) {
        $sql .= " WHERE e.id = :editor_id";
    }

    $sql .= " GROUP BY g.id ORDER BY g.release_date DESC";

    if ($limit) {
        $sql .= " LIMIT :limit";
    }

    $stmt = $pdo->prepare($sql);

    if ($editorId) {
        $stmt->bindParam(':editor_id', $editorId, PDO::PARAM_INT);
    }
    if ($limit) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Filtre combiné genre + éditeur
function getGamesByGenreAndEditor(PDO $pdo, string $genre, int $editorId): array {
    $sql = "
        SELECT g.id, g.name, g.description, g.release_date, g.image, e.name AS editor,
               GROUP_CONCAT(ge.name SEPARATOR ', ') AS genres
        FROM game g
        JOIN editor e ON g.editor_id = e.id
        JOIN game_genre gg ON g.id = gg.game_id
        JOIN genre ge ON gg.genre_id = ge.id
        WHERE g.editor_id = :editor_id
        GROUP BY g.id
        HAVING FIND_IN_SET(:genre, genres)
        ORDER BY g.release_date DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':editor_id', $editorId, PDO::PARAM_INT);
    $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Liste des genres
function getAllGenres(PDO $pdo): array {
    $stmt = $pdo->query("SELECT name FROM genre ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Liste des éditeurs
function getAllEditors(PDO $pdo): array {
    $stmt = $pdo->query("SELECT id, name FROM editor ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
