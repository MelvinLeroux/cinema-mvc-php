<body class="home">
    <header class="home-header">
        <h1 class="logo">AmaFlix <span>+</span></h1>
        <p class="subtitle">Tous tes films (ou presque) depuis chez toi !</p>
    </header>
    <main>
        <form class="home-search searchbar" action="<?= $router->generate('search') ?>">
            <label for="search">Rechercher un film</label>
            <div class="search-container">
                <input placeholder="Exemple : Le Seigneur des Anneaux" type="text" name="search" id="search">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </main>