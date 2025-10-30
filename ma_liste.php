<?php
// Inclut le header
require_once 'templates/header.php';
require_once 'libs/wishlist.php';
require_once 'libs/session.php';
require_once 'libs/pdo.php';



if(!isLoggedIn()){
  header("location: login.php");
}

$user = getConnectedUser();
$games = getWishlistItemsByUserId($pdo,$user["id"]);

$error404 = FALSE;
$wishlistItems = TRUE;

if(isset($_GET['id'])){

$id = (int)$_GET['id'];
$game = getGame($pdo, $id);
  if(!$game){
    $error404 = TRUE;
  }else{
    
    
    //Suppression de la wishlist
    if(isset($_GET["removeFromWishlist"]) && isLoggedIn()){
      // $user = getConnectedUser();

      removeFromWishlist($pdo, $id, (int)$user["id"]);
    }

    
  }

}else{
  $error404 = TRUE;
}
?>



<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col">
      <div class="h-1 bg-gray-800 rounded overflow-hidden">
        <div class="w-24 h-full bg-blue-500"></div>
      </div>
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
        <h1 class="sm:w-2/5 text-white font-medium title-font text-2xl mb-2 sm:mb-0">Ma liste de souhaits</h1>
        
      </div>
    </div>
    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">

   <?php foreach($games as $index=>$game): ?>
    <?php require 'templates/_game_items_list.php'; ?>
  <?php endforeach; ?>


      
      
    </div>
  </div>
</section>



<?php
// Inclut le header
require_once 'templates/footer.php';
?>