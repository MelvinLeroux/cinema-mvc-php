<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetPrime +</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="css/fontawesome/css/solid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="search-result" style="background-image: var(--gradient), url('https://image.tmdb.org/t/p/original/<?=$movie->getBackgroundUrl()?>');">
    <header class="classic-header">
    <a href="<?= $router->generate('home') ?>">
            <p class="logo">Amaflix <span>+</span></p>
        </a>
        <form class="searchbar" action="<?= $router->generate('search') ?>">
            <label for="search">Rechercher un film</label>
            <div class="search-container">
                <input placeholder="Exemple : Le voyage de Chihiro" type="text" name="search" id="search">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </header>
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
                            <h2>
                                <i class="fa-solid fa-film"></i>
                                Réalisateur
                            </h2>
                            <?php if (null==($director->getPicture_url())): ?>
                                <h3><?= $director->getName() ?></h3>
                            <?php else : ?>
                                <h3><?= $director->getName() ?></h3>
                                <img src="https://image.tmdb.org/t/p/original/<?= $director->getPicture_url() ?>" alt="<?= $director->getName() ?>">
                            <?php endif?>
                        </div>
                        <?php if (null==$composer): ?>
                        <?php elseif (null==($composer->getPicture_url())): ?>
                            <div class="composer">
                                <h2>
                                    <i class="fa-solid fa-music"></i> 
                                    Compositeur
                                </h2>
                                <h3><?= $composer->getName() ?></h3>
                            <?php else :?>
                                <div class="composer">
                                    <h2>
                                        <i class="fa-solid fa-music"></i>
                                        Compositeur
                                    </h2>
                                    <h3><?= $composer->getName() ?></h3>
                                    <img src="https://image.tmdb.org/t/p/original/<?= $composer->getPicture_url() ?>" alt="<?= $composer->getName()?>">
                                </div>
                            <?php endif?>
                    </div>
                    <div class="actors">
                        <h2><i class="fa-solid fa-clapperboard"></i> Acteurs</h2>
                        <ul>
                            <?php foreach ($viewData['actors'] as $actor) :?>
                               <?php if (null==($actor->getPicture_url())) :?>
                                <li>
                                    <h3><?= $actor->getName()?></h3>
                                </li>
                                <?php else: ?>
                                    <li>
                                    <h3><?= $actor->getName()?></h3>
                                    <img src="https://image.tmdb.org/t/p/original/<?= $actor->getPicture_url()?>" alt="Rumi Hiiragi">
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