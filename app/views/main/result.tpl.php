<h1 class="result-title">Résultats de la recherche : <span><?=$_GET['search']?></span></h1>
<section class="results">
    <?php foreach ($result as $result): ?>
    <a href="" class="movie-result">
        <img src="<?="https://image.tmdb.org/t/p/original". $result->getPosterUrl()?>"" alt="<?= $result->getTitle()?>">
        <h3>
        <?= $result->getTitle()?>
        </h3>
    </a>
   <?php endforeach?>
</section>