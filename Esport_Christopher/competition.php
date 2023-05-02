<?php
require('./php/competition/ManagerCompetition.php');



$managerCompetition = new ManagerCompetition();
$allCompetitions = $managerCompetition->getAllCompetition();
if (isset($_GET['delete'])){
    $managerCompetition->delete(intval($_GET['delete']));
}

if (!empty($_POST['name']) && isset($_POST['description']) && isset($_POST['city']) && isset($_POST['format']) && isset($_POST['cash_prize']) ) {
    $newCompetition = new Competition();
    $newCompetition->setName($_POST['name']);
    $newCompetition->setDescription($_POST['description']);
    $newCompetition->setCity($_POST['city']);
    $newCompetition->setFormat($_POST['format']);
    $newCompetition->setCashprize($_POST['cash_prize']);


    


    $managerCompetition->create($newCompetition);
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
    <title>Esport</title>
</head>

<body>
    <div class="mainContainer d-flex flex-column">

        <?php

        include($root . '/assets/navbar.php');

        ?>




        <div class="d-flex w-100 justify-content-evenly">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">City</th>
                        <th scope="col">Format</th>
                        <th scope="col">Cashprize</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($allCompetitions as $competition) {
                        $removeUrl= '?delete=' . $competition->getId();
                        $removeLink = '<a href="' . $removeUrl . '">supprimer</a>';
                        

                        echo ('<tr>');
                        echo ('<td>' . $competition->getName() . '</td>');
                        echo ('<td>' . $competition->getDescription() . '</td>');
                        echo ('<td>' . $competition->getCity() . '</td>');
                        echo ('<td>' . $competition->getFormat() . '</td>');
                        echo ('<td>' . $competition->getCashprize() . '</td>');
                        echo ('<td>' . $competition->getId() . '</td>');

                        echo ('<td class="cursor">' . $removeLink . '</td>');

                        echo ('<tr>');
                    }

                    ?>
                </tbody>
            </table>
            <form action="./competition.php" method="post" class="w-30">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="champ1">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="description" aria-describedby="champ2">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" class="form-control" id="city" aria-describedby="champ3">
                </div>
                <div class="mb-3">
                    <label for="format" class="form-label">Format</label>
                    <input type="text" name="format" class="form-control" id="format" aria-describedby="champ4">
                </div>
                <div class="mb-3">
                    <label for="cash_prize" class="form-label">Cashprize</label>
                    <input type="text" name="cash_prize" class="form-control" id="cash_prize" aria-describedby="champ5">
                </div>
                <input type="submit" value="Send" class="btn btn-primary">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>