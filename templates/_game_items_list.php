



<div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="<?php echo htmlspecialchars($game['image'], ENT_QUOTES); ?>" 
         alt="<?php echo htmlspecialchars($game['name'], ENT_QUOTES); ?>">>
        </div>
        <h2 class="text-xl font-medium title-font text-white mt-5"><?php echo $game["name"] ?></h2>
        <p class="text-base leading-relaxed mt-2"><?php echo substr($game["description"], 0 ,50)  ?></p>
        <?php if(isLoggedIn()): ?>

    <?php if($wishlistItems): ?>

      <div class="container pt-10 px-5 mx-auto flex flex-wrap">
        <a href="jeu.php?id=<?= (int)$game['id'] ?>&removeFromWishlist"
        class="inline-flex text-white bg-blue-500 border-0 py-2 px-5 focus:outline-none hover:bg-blue-600 rounded text-lg">
        Supprimer de votre liste
        </a>
      </div>

      <?php endif; ?>

       <?php endif; ?>
    </div>