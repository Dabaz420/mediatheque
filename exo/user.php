<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le php continue</title>
</head>
<body>
    <?php
        if(isset($_REQUEST['nom'] ,$_REQUEST['prenom'])){
            $nom = $_REQUEST['nom'];
            $prenom = $_REQUEST['prenom'];
            echo("<p>$nom</p>");
            echo("<p>$prenom</p>");
        }
        // elseif(isset($_REQUEST['nom'], $_REQUEST['prenom'])){
        //     $nom = $_REQUEST['nom'];
        //     $prenom = $_REQUEST['prenom'];
        //     echo("<p>$nom</p>");
        //     echo("<p>$prenom</p>");
        //     echo '<p>Tu à oublier de mettre un age !!!!</p>';
        // }
        // elseif(isset($_REQUEST['dateDebut'], $_REQUEST['dateFin'])){
        //     $dateDebut = $_REQUEST['dateDebut'];
        //     $dateFin = $_REQUEST['dateFin'];
        //     echo("<p>$dateDebut</p>");
        //     echo("<p>$dateFin</p>");
        // }
        // elseif(isset($_REQUEST['langage'], $_REQUEST['serveur'])){
        //     $langage = $_REQUEST['langage'];
        //     $serveur = $_REQUEST['serveur'];
        //     echo("<p>$langage</p>");
        //     echo("<p>$serveur</p>");
        // }
        // elseif(isset($_REQUEST['semaine'])){
        //     $semaine = $_REQUEST['semaine'];
        //     echo("<p>$semaine</p>");
        // }
        // elseif(isset($_REQUEST['batiment'], $_REQUEST['salle'])){
        //     $batiment = $_REQUEST['batiment'];
        //     $salle = $_REQUEST['salle'];
        //     echo("<p>$batiment</p>");
        //     echo("<p>$salle</p>");
        // }
        // else{
        //     echo '<p>Hé oh ! Fait un effort !!!</p>';
        // }
    ?>
</body>
</html>