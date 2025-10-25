<?php
// Inclut le header
require_once 'templates/header.php';
require_once 'libs/game.php';

$games = getAllGames();



?>


    





<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container mx-auto flex px-5 py-8 md:flex-row flex-col items-center">
    <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Listez vos jeux favoris
        <br class="hidden lg:inline-block">sur All Games
      </h1>
      <p class="mb-8 leading-relaxed">All Games est la plateform ideal pour ajouter vos jeux favoris et découvrir de nouveaux jeux. Découvrez les derniers jeux</p>
      <div class="flex justify-center">
        <a href="jeux.php" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">Voir les jeux</a>
       
      </div>
    </div>
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
      <img class="object-cover object-center rounded" alt="hero" src="assets/images/logo.jpg">
    </div>
  </div>
</section>



<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col">
      <div class="h-1 bg-gray-800 rounded overflow-hidden">
        <div class="w-24 h-full bg-blue-500"></div>
      </div>
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
        <h1 class="sm:w-2/5 text-white font-medium title-font text-2xl mb-2 sm:mb-0">Les derniers Jeux</h1>
        
      </div>
    </div>
    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">

  <?php foreach($games as $index=>$game): ?>
    <?php require 'templates/_game_items.php'; ?>
  <?php endforeach; ?>


      
      
    </div>
  </div>
</section>








<?php
// Inclut le header
require_once 'templates/footer.php';
?>

</body>
</html>