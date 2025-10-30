<?php
require_once 'templates/header.php';
require_once 'libs/game.php';
require_once 'libs/user.php';
require_once 'libs/session.php';
require_once 'libs/pdo.php';
require_once 'libs/review.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    header("Location: index.php");
    exit;
}

$user = getConnectedUser();
$game = getGame($pdo, $id);


// var_dump($game);
// var_dump($user);

$resForm = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resForm = addToReview(
        $pdo,
        (int)$_POST["note"],
        $_POST["message"],
        $game["id"],
        $user["id"]
    );

    if ($resForm) {
        header("Location: index.php");
        exit;
    }
}

// var_dump($resForm);
?>










<section class="text-gray-400 bg-gray-900 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Donnez votre avis</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Attribuez une note entre 0 et 5 et laissez un commentaire.</p>
    </div>

    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <form action="" method="post">
        <div class="flex flex-wrap -m-2">
          
          <!-- Système de notation -->
          <div class="p-2 w-full">
            <div class="relative">
              <label for="note" class="leading-7 text-sm text-gray-400">Note (0 à 5)</label>
              <select id="note" name="note" class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-blue-500 focus:bg-gray-900 focus:ring-2 focus:ring-blue-900 text-base outline-none text-gray-100 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <option value="0">0 - Très mauvais</option>
                <option value="1">1 - Mauvais</option>
                <option value="2">2 - Moyen</option>
                <option value="3">3 - Correct</option>
                <option value="4">4 - Bon</option>
                <option value="5">5 - Excellent</option>
              </select>
            </div>
          </div>

          <!-- Message / Avis -->
          <div class="p-2 w-full">
            <div class="relative">
              <label for="message" class="leading-7 text-sm text-gray-400">Votre avis</label>
              <textarea id="message" name="message" class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-blue-500 focus:bg-gray-900 focus:ring-2 focus:ring-blue-900 h-32 text-base outline-none text-gray-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" placeholder="Partagez votre expérience..."></textarea>
            </div>
          </div>

          <!-- Bouton d'envoi -->
          <div class="p-2 w-full">
            <button type="submit" class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">
              Envoyer
            </button>
          </div>

          <!-- Coordonnées / Réseaux -->
          <div class="p-2 w-full pt-8 mt-8 border-t border-gray-800 text-center">
            <a class="text-blue-400">contact@example.com</a>
            <p class="leading-normal my-5">49 Smith St.<br>Saint Cloud, MN 56301</p>
            <span class="inline-flex">
              <a class="text-gray-500"><svg fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg></a>
              <a class="ml-4 text-gray-500"><svg fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg></a>
              <a class="ml-4 text-gray-500"><svg fill="none" stroke="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path></svg></a>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>






<?php
// Inclut le header
require_once 'templates/footer.php';
?>