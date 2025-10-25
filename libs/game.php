<?php

function getAllGames()
{
   $games = [
  [
    "name" =>  "The Legend of Zelda: Breath of the Wild", "description" => "Un jeu d’action-aventure en monde ouvert sur Nintendo Switch."
  ],
  [
    "name" =>  "Assassin's Creed Valhalla", "description" => "Incarnez un Viking dans cette aventure épique signée Ubisoft."
  ],
  [
    "name" =>  "FIFA 23", "description" => "Simulation de football réaliste avec de nombreuses ligues."
  ],
  

];

    return $games;

};

function getGame(int $id){

    $games = getAllGames();
    return $games[$id];

}