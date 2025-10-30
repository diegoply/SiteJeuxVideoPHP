



<div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="<?php echo htmlspecialchars($game['image'], ENT_QUOTES); ?>" 
         alt="<?php echo htmlspecialchars($game['name'], ENT_QUOTES); ?>">>
        </div>
        <h2 class="text-xl font-medium title-font text-white mt-5"><?php echo $game["name"] ?></h2>
        <p class="text-base leading-relaxed mt-2"><?php echo substr($game["description"], 0 ,100)  ?></p>
        <a href="jeu.php?id=<?=$game["id"]?>" class="text-blue-400 inline-flex items-center mt-3">En savoir plus
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>