<h1 class="result-title">Résultats de la recherche : <span><?=$_GET['search']?></span></h1>
<section class="results">
    <?php foreach ($result as $result): ?>
        <?php if (!null==($result->getPosterUrl())): ?>
            <a 
                href="<?= $router->generate('movie', ['id' => $result->getId()]) ?>" 
                class="movie-result"
            >
                <img src="<?="https://image.tmdb.org/t/p/original". $result->getPosterUrl()?>"" alt="<?= $result->getTitle()?>">
                <h3><?= $result->getTitle()?></h3>
            </a>
        <?php else :?> 
            <a href="<?= $router->generate('movie', ['id' => $result->getId()]) ?>" class="movie-result">
                <h3><?= $result->getTitle()?></h3>
        <?php endif?>
   <?php endforeach?>
</section>