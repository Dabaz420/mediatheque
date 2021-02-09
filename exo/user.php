<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le php continue</title>
</head>
<body>
    <?php
        //EXO 3 ET 4 PART 2
        if(isset($_REQUEST['nom'] ,$_REQUEST['prenom'])){
            $nom = $_REQUEST['nom'];
            $prenom = $_REQUEST['prenom'];
            echo("<p>$nom</p>");
            echo("<p>$prenom</p>");
        }
    ?>
</body>
</html>
