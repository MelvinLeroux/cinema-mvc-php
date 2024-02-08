    <main>
        <div class="container">
            <div class="movie-wrapper">
                <section class="poster">
                    <img src="https://image.tmdb.org/t/p/original/<?= $movie->getPosterUrl() ?>" alt="Le voyage de Chihiro">
                    <i class="fa-regular fa-circle-play"></i>
                </section>
                <section class="details">
                    <h1 class="movie-title"><?= $movie->getTitle() ?></h1>
                    <div class="movie-meta">
                        <div class="date"><?=$movie->getReleaseDate() ?></div>
                        <div class="rating"><i class="fa-solid fa-star"></i> <span><?= $movie->getRating() ?>
                            </span> / 10
                        </div>
                    </div>
                    <div class="movie-synopsis">
                        <?= $movie->getSynopsis() ?>
                    </div>
                    <div class="crew">
                        <div class="real">
                        <a href="<?= $router->generate('director', ["id" => $viewData['director']->getId()]) ?>">
                            <h2>
                                <i class="fa-solid fa-film"></i>
                                Réalisateur
                            </h2>
                            <?php if (null==($director->getPictureUrl())): ?>
                                <h3><?= $director->getName() ?></h3>
                            <?php else : ?>
                                <h3><?= $director->getName() ?></h3>
                                
                                <img src="https://image.tmdb.org/t/p/original/<?= $director->getPictureUrl() ?>" alt="<?= $director->getName() ?>">
                            <?php endif?>
                        </a>    
                        </div>
                        <?php if (null==$composer): ?>
                        <?php elseif (null==($composer->getPictureUrl())): ?>
                            <div class="composer">
                            <a href="<?= $router->generate('composer', ["id" => $viewData['composer']->getId()]) ?>">
                                <h2>
                                    <i class="fa-solid fa-music"></i> 
                                    Compositeur
                                </h2>
                                <h3><?= $composer->getName() ?></h3>
                            <?php else :?>
                                <div class="composer">
                                    <a href="<?= $router->generate('composer', ["id" => $viewData['composer']->getId()]) ?>">

                                    <h2>
                                        <i class="fa-solid fa-music"></i>
                                        Compositeur
                                    </h2>
                                    <h3><?= $composer->getName() ?></h3>
                                    <img src="https://image.tmdb.org/t/p/original/<?= $composer->getPictureUrl() ?>" alt="<?= $composer->getName()?>">
                                </div>
                            <?php endif?>
                    </div>
                    <div class="actors">
                        <h2><i class="fa-solid fa-clapperboard"></i> Acteurs</h2>
                        <ul>
                            <?php foreach ($viewData['actors'] as $actor) :?>                               
                               <?php if (null==($actor->getPictureUrl())) :?>
                                <li>
                                    <h3><?= $actor->getName()?></h3>
                                </li>
                                <?php else: ?>
                                    <li>
                                    <h3><?= $actor->getName()?></h3>
                                    <a href="<?= $router->generate('actor', ['id' => $actor->getId()]) ?>">
                                    <img src="https://image.tmdb.org/t/p/original/<?= $actor->getPictureUrl()?>" alt="Rumi Hiiragi">
                                <?php endif?>
                                </li>
                            <?php endforeach?>

                        </ul>
                    </div>
                </section>
            </div>
           
        </div>


    </main>

</body>
</html>