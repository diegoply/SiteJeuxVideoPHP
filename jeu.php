<?php
// Inclut le header
require_once 'templates/header.php';
require_once 'libs/game.php';


$id = (int)$_GET['id'];


$game = getGame($id);

// var_dump($game);

?>

<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container pt-10 px-5 mx-auto flex flex-wrap">
    <h1 class="title-font font-medium text-3xl mb-2 text-white"><?php echo $game["name"] ?></h1>
    </div>
  <div class="container px-5 py-4 mx-auto flex flex-wrap">
    <div class="lg:w-2/3 sm:w-1/3 w-full rounded-lg overflow-hidden mt-6 mr-6 sm:mt-0">
      <img class="object-cover object-center w-full h-full" src="https://dummyimage.com/600x300" alt="stats">
    </div>
    <div class="flex flex-wrap -mx-4 mt-auto mb-auto lg:w-1/3 sm:w-2/3 content-start sm:pr-10">
      <div class="w-full  px-4 mb-25">
        <img class="rounded-lg object-cover object-center w-full h-full mb-5" src="https://dummyimage.com/450x200" alt="stats">
        <div class="leading-relaxed "><?php echo $game["description"] ?></div>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/3 w-1/2">
        <h2 class="title-font font-medium text-sm text-white">Trés positive</h2>
        <p class="leading-relaxed">Evaluations</p>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/3 w-1/2">
        <h2 class="title-font font-medium text-sm text-white">35K</h2>
        <p class="leading-relaxed">Favoris</p>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/3 w-1/2">
        <h2 class="title-font font-medium text-sm text-white">2011</h2>
        <p class="leading-relaxed">Sortie</p>
      </div>
    </div>
    
  </div>

  <div class="container pt-10 px-5 mx-auto flex flex-wrap">
    <a href="jeux.php" class="inline-flex text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded text-lg">Ajouter à la liste</a>
</div>
</section>




<?php
// Inclut le header
require_once 'templates/footer.php';
?>
