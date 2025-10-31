<?php
require_once 'templates/header.php';
require_once 'libs/game.php';
require_once 'libs/session.php';
require_once 'libs/pdo.php';

// Récupère tous les genres et éditeurs
$genres = getAllGenres($pdo);
$editors = getAllEditors($pdo);

// Récupère les filtres depuis l'URL
$selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : null;
$selectedEditor = isset($_GET['editor']) ? (int)$_GET['editor'] : null;

// Charge les jeux selon les filtres
if ($selectedGenre && $selectedEditor) {
    $games = getGamesByGenreAndEditor($pdo, $selectedGenre, $selectedEditor);
} elseif ($selectedGenre) {
    $games = getGamesByGenre($pdo, $selectedGenre);
} elseif ($selectedEditor) {
    $games = getGamesByEditor($pdo, $selectedEditor);
} else {
    $games = getAllGames($pdo);
}
?>

<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col">
      <div class="h-1 bg-gray-800 rounded overflow-hidden">
        <div class="w-24 h-full bg-blue-500"></div>
      </div>
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12 items-center justify-between">
        <h1 class="sm:w-2/5 text-white font-medium title-font text-2xl mb-2 sm:mb-0">Liste des Jeux</h1>

        <!-- Filtres genre + éditeur côte à côte -->
        <form method="GET" class="flex gap-4 flex-wrap">
            <select name="genre" onchange="this.form.submit()" class="bg-gray-800 text-white border border-gray-700 rounded px-4 py-2 w-48">
                <option value="">-- Tous les genres --</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre) ?>" <?= $genre == $selectedGenre ? 'selected' : '' ?>>
                        <?= htmlspecialchars($genre) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="editor" onchange="this.form.submit()" class="bg-gray-800 text-white border border-gray-700 rounded px-4 py-2 w-48">
                <option value="">-- Tous les éditeurs --</option>
                <?php foreach ($editors as $editor): ?>
                    <option value="<?= $editor['id'] ?>" <?= $editor['id'] == $selectedEditor ? 'selected' : '' ?>>
                        <?= htmlspecialchars($editor['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

      </div>
    </div>

    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
        <?php foreach($games as $game): ?>
            <?php require 'templates/_game_items.php'; ?>
        <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
require_once 'templates/footer.php';
?>
