<?php


function addReview(PDO $pdo, int $review, string $comment, int $gameId, int $userId): bool {
    // Vérifier si un avis existe déjà
    $checkSql = "SELECT id FROM review WHERE game_id = :gameId AND user_id = :userId";
    $checkQuery = $pdo->prepare($checkSql);
    $checkQuery->bindValue(":gameId", $gameId, PDO::PARAM_INT);
    $checkQuery->bindValue(":userId", $userId, PDO::PARAM_INT);
    $checkQuery->execute();

    $existingReview = $checkQuery->fetch(PDO::FETCH_ASSOC);

    if ($existingReview) {
        // Mettre à jour l'avis existant
        $updateSql = "UPDATE review 
                      SET review = :review, comment = :comment, created_at = NOW() 
                      WHERE id = :id";
        $updateQuery = $pdo->prepare($updateSql);
        $updateQuery->bindValue(":review", $review, PDO::PARAM_INT);
        $updateQuery->bindValue(":comment", $comment, PDO::PARAM_STR);
        $updateQuery->bindValue(":id", $existingReview['id'], PDO::PARAM_INT);
        return $updateQuery->execute();
    } else {
        // Insérer un nouvel avis
        $insertSql = "INSERT INTO review (review, comment, created_at, game_id, user_id) 
                      VALUES (:review, :comment, NOW(), :gameId, :userId)";
        $insertQuery = $pdo->prepare($insertSql);
        $insertQuery->bindValue(":review", $review, PDO::PARAM_INT);
        $insertQuery->bindValue(":comment", $comment, PDO::PARAM_STR);
        $insertQuery->bindValue(":gameId", $gameId, PDO::PARAM_INT);
        $insertQuery->bindValue(":userId", $userId, PDO::PARAM_INT);
        return $insertQuery->execute();
    }
}


function getReviewsByGameId(PDO $pdo, int $gameId): array {
    $sql = "SELECT r.user_id, r.game_id, r.review, r.comment, r.created_at, u.username
            FROM review r
            LEFT JOIN user u ON u.id = r.user_id
            WHERE r.game_id = :gameId
            ORDER BY r.created_at DESC";

    $query = $pdo->prepare($sql);
    $query->bindValue(":gameId", $gameId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getReviewMoyenne(PDO $pdo, int $gameId): string {
    $sql = "SELECT AVG(r.review) as moyenne
            FROM review r
            WHERE r.game_id = :gameId";

    $query = $pdo->prepare($sql);
    $query->bindValue(":gameId", $gameId, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    // retourne la moyenne arrondie à 2 décimales, ou 0 si aucune review
     // Moyenne arrondie à l'entier le plus proche, ou 0 si pas de review
    $note = $result && $result['moyenne'] !== null ? (int) round((float)$result['moyenne']) : 0;


     // si pas de review, retourner "Aucune note"
    if (!$result || $result['moyenne'] === null) {
        return 'Aucune note';
    }

    switch ($note) {
        case 0: return 'Très mauvaise';
        case 1: return 'Mauvaise';
        case 2: return 'Moyenne';
        case 3: return 'Correcte';
        case 4: return 'Bonne';
        case 5: return 'Excellente';
        default: return 'Aucune note';
    }
}



function getReview($review){
    if ($review === 0){
        return '<h3>Trés mauvaise</h3>';
    }
    else if ($review === 1){
        return '<h3>Mauvaise</h3>';
    }
    else if ($review === 2){
        return '<h3>Moyenne</h3>';
    }
    else if ($review === 3){
        return '<h3>Correcte</h3>';
    }
    else if ($review === 4){
        return '<h3>Bonne</h3>';
    }
    else if ($review === 5){
        return '<h3>Excellente</h3>';
    }
}