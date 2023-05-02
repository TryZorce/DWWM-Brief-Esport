<?php

require('./php/team/ManagerTeam.php');



$managerTeam = new ManagerTeam();
$allTeams = $managerTeam->getAllTeam();
if (isset($_GET['delete'])) {
    $managerTeam->delete(intval($_GET['delete']));
}

if (!empty($_POST['name']) && isset($_POST['description'])) {
    $newTeam = new Team();
    $newTeam->setName($_POST['name']);
    $newTeam->setDescription($_POST['description']);

    $managerTeam->create($newTeam);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Esport</title>
</head>

<body>
    <div class="background-container">
        <div class="overlay"></div>
    </div>
    <div class="mainContainer d-flex flex-column">

        <?php

        include($root . '/assets/navbar.php');

        ?>

        <div class="d-flex w-100 justify-content-evenly">
            <table class="table table-hover table-borderless text-white">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($allTeams as $team) {
                        $removeUrl = '?delete=' . $team->getId();
                        $removeLink = '<a href="' . $removeUrl . '">supprimer</a>';
                        echo ('<tr>');
                        echo ('<td>' . $team->getName() . '</td>');
                        echo ('<td>' . $team->getDescription() . '</td>');
                        echo ('<td class="cursor">' . $removeLink . '</td>');
                        echo ('<tr>');


                    }

                    ?>
                </tbody>
            </table>
            <form class="text-white" action="./team.php" method="post" class="w-30">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="champ1">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="description"
                        aria-describedby="champ2">
                </div>

                <input type="submit" value="Envoyer" class="btn btn-primary">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>