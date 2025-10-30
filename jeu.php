<?php
// Inclut le header
require_once 'templates/header.php';
require_once 'libs/game.php';
require_once 'libs/session.php';
require_once 'libs/pdo.php';
require_once 'libs/wishlist.php';
require_once 'libs/review.php';

$error404 = FALSE;
$wishlistItems = FALSE;

if(isset($_GET['id'])){

$id = (int)$_GET['id'];
$game = getGame($pdo, $id);
  if(!$game){
    $error404 = TRUE;
  }else{
    
    //Ajout a la wishlsit
    if(isset($_GET["addToWishlist"]) && isLoggedIn()){

      $user = getConnectedUser();

      addToWishlist($pdo, $id, (int)$user["id"]);
    }
    //Suppression de la wishlist
    if(isset($_GET["removeFromWishlist"]) && isLoggedIn()){
      $user = getConnectedUser();

      removeFromWishlist($pdo, $id, (int)$user["id"]);
    }

    if(isLoggedIn()){
      $user = getConnectedUser();
    $wishlistItems = getWishlistItemByGameIdAndUserId($pdo, $id, (int)$user["id"]);

    }
  }

}else{
  $error404 = TRUE;
}

if(isLoggedIn()){
    $user = getConnectedUser();
    $resAvis = getReviewItemByGameIdAndUserId($pdo, $game["id"], $user["id"]);
} else {
    $resAvis = false;
}


  // var_dump($resAvis);

?>

<?php  if($error404): ?>
          <div class="text-red-400 mb-4 text-center">
            jeu introuvable
          </div>
<?php  else: ?>



<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container pt-10 px-5 mx-auto flex flex-wrap">
    <h1 class="title-font font-medium text-3xl mb-2 text-white"><?php echo $game["name"] ?></h1>
    </div>
  <div class="container px-5 py-4 mx-auto flex flex-wrap">
    <div class="lg:w-2/3 sm:w-1/3 w-full rounded-lg overflow-hidden mt-6 mr-6 sm:mt-0">
    <img class="object-cover object-center w-full h-full" 
         src="<?php echo htmlspecialchars($game['image'], ENT_QUOTES); ?>" 
         alt="<?php echo htmlspecialchars($game['name'], ENT_QUOTES); ?>">
</div>

    <div class="flex flex-wrap -mx-4 mt-auto mb-auto lg:w-1/3 sm:w-2/3 content-start sm:pr-10">
      <div class="w-full  px-4 mb-25">
        <img class="rounded-lg object-cover object-center w-full h-full mb-5" src="https://dummyimage.com/450x200" alt="stats">
        <div class="leading-relaxed "><?php echo $game["description"] ?></div>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
        
        <p class="leading-relaxed">Evaluations</p>
        <h2 class="title-font font-medium text-sm text-white">Trés positive</h2>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
        
        <p class="leading-relaxed">Favoris</p>
        <h2 class="title-font font-medium text-sm text-white">35K</h2>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
        
        <p class="leading-relaxed">Sortie</p>
        <h2 class="title-font font-medium text-sm text-white"><?php echo $game["release_date"] ?></h2>
      </div>
      <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
        
        <p class="leading-relaxed">Editeur</p>
        <h2 class="title-font font-medium text-sm text-white"><?php echo $game["editor_name"] ?></h2>
      </div>
    </div>
    
  </div>


  <?php if(isLoggedIn()): ?>

    <?php if($wishlistItems): ?>

      <div class="container pt-10 px-5 mx-auto flex flex-wrap">
    <a href="jeu.php?id=<?=$id?>&removeFromWishlist" class="inline-flex text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded text-lg">déja dans votre liste</a>

  

  <?php else: ?>

    <div class="container pt-10 px-5 mx-auto flex flex-wrap">
    <a href="jeu.php?id=<?=$id?>&addToWishlist" class="inline-flex text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded text-lg">Ajouter à la liste</a>
  </div>

    
  </div>


  <?php endif; ?>

<?php else: ?>
   <p class="leading-relaxed">Veuillez vous <a href="login.php" class="text-white underline">connecter</a> pour ajouter se jeu à votre liste de souhait</p>
<?php endif; ?>
</section>

<?php endif; ?>


<?php if ($resAvis): ?>
<?php foreach($resAvis as $index=>$resAvi): ?>
    <?php require 'templates/_avis.php'; ?>
  <?php endforeach; ?>
<?php endif; ?>




<?php
// Inclut le header
require_once 'templates/footer.php';
?>
