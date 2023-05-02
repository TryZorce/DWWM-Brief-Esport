<?php
        require('./php/game/ManagerGame.php');

    $managerGame = new ManagerGame();
    $allGames = $managerGame->getAllGame();
    if (isset($_GET['delete'])){
        $managerGame->delete(intval($_GET['delete']));
    }
    
    
    if (!empty($_POST['name']) && isset($_POST['station']) &&  isset($_POST['format'])) {
        $newGame = new Game();


        $newGame->setName($_POST['name']);
        $newGame->setStation($_POST['station']);
        $newGame->setFormat($_POST['format']);

        $managerGame->create($newGame);
        // echo($_POST['station']);
    }

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <link rel="stylesheet" href="./styles/style.css">
     <title>Game</title>
 </head>

 <body>
     <div class="mainContainer d-flex flex-column">

         <?php
            $currentDir = __DIR__;
            $root = dirname($currentDir, 2); // Remonter de deux niveaux à partir du répertoire actuel
            include('./assets/navbar.php');
            ?>
         <!-- Table  -->
         <div class="d-flex w-100 justify-content-evenly">
             <table class="table table-hover">
                 <thead>
                     <tr>
                         <th scope="col">Nom</th>
                         <th scope="col">Plateforme</th>
                         <th scope="col">Format</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php

                        foreach ($allGames as $game) {
                            $removeUrl= '?delete=' . $game->getId();
                        $removeLink = '<a href="' . $removeUrl . '">supprimer</a>';
                        

                            echo ('<tr>');
                            echo ('<td>' . $game->getName() . '</td>');
                            echo ('<td>' . $game->getStation() . '</td>');
                            echo ('<td>' . $game->getFormat() . '</td>');
                            echo ('<td>' . $game->getId() . '</td>');

                            echo ('<td class="cursor">' . $removeLink . '</td>');
    
                            echo ('<tr>');
                        }

                        ?>
                 </tbody>
             </table>
             <!-- Formulaire -->
             <!-- Nom -->
             <form action="./game.php" class="w-30" method="post">
                 <div class="mb-3">
                     <label for="name" class="form-label">Nom</label>
                     <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
                 </div>
                 <!-- Plateforme -->
                 <div class="mb-3">
                     <label for="station" class="form-label">Plateforme</label>
                     <select name="station" id="station" class="form-control" aria-describedby="station">
                         <option value="PC">PC</option>
                         <option value="Xbox">Xbox One</option>
                         <option value="Playstation">Playstation 4</option>
                     </select>
                 </div>
                 <!-- Format -->
                 <div class="mb-3">
                     <label for="format" class="form-label">Format</label>
                     <select name="format" id="format" class="form-control" aria-describedby="format">
                         <option value="MOBA">MOBA</option>
                         <option value="FPS">FPS</option>
                         <option value="Battle Royale">Battle Royale</option>
                         <option value="Jeu de cartes à collectionner">Jeu de cartes à collectionner</option>
                         <option value="Sport">Sport</option>
                         <option value="FPS tactique">FPS tactique</option>
                         <option value="Combat">Combat</option>
                     </select>
                 </div>
                 <input type="submit" class="btn btn-primary"></input>
             </form>

             <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 </body>

 </html>