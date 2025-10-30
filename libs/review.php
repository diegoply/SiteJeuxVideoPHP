<?php


function addToReview(PDO $pdo,int $review, string $comment,int $gameId,int $userId): array|bool{

    $sql = "INSERT INTO review (review, comment, created_at, game_id, user_id) VALUES (:review, :comment, NOW(), :gameId, :userId)";
    $query = $pdo->prepare($sql);
    $query->bindValue(":review", $review, PDO::PARAM_INT);
    $query->bindValue(":comment", $comment, PDO::PARAM_STR);
    $query->bindValue(":gameId", $gameId, PDO::PARAM_INT);
    $query->bindValue(":userId", $userId, PDO::PARAM_INT);

    return $query->execute();

}

function getReviewItemByGameIdAndUserId(PDO $pdo, int $gameId, int $userId):array|bool {

    $sql = "SELECT user_id, game_id, review, comment, created_at
    FROM review
    WHERE game_id = :gameId AND user_id = :userId";

    $query = $pdo->prepare($sql);

    $query->bindValue(":gameId", $gameId, PDO::PARAM_INT);
    $query->bindValue(":userId", $userId, PDO::PARAM_INT);

    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}