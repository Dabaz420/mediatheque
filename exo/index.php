<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le php continue</title>
</head>
<body>

    <?php
        //EXO 5, 6, 7, 8 PART 2
        if(!isset($_REQUEST['civilite'], $_REQUEST['nom'], $_REQUEST['prenom'])){
    ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <select name="civilite">
                    <option value="Mr">Mr</option>
                    <option value="Mme">Mme</option>
                </select>
                <input type="text" name="nom" placeholder="Nom" required/>
                <input type="text" name="prenom" placeholder="Prenom" required/>
                <input type="file" name="fichier" accept="application/pdf"/>
                <input type="submit"/>
            </form>

    <?php
        }elseif(isset($_REQUEST['civilite'], $_REQUEST['nom'], $_REQUEST['prenom'])){
            $civilite = $_REQUEST['civilite'];
            $nom = $_REQUEST['nom'];
            $prenom = $_REQUEST['prenom'];
            $fichier = $_FILES['fichier'];
            echo("<p>$civilite</p>");
            echo("<p>$nom</p>");
            echo("<p>$prenom</p>");
            echo("<p>". $fichier['name'] . "</br>" . $fichier['type']."</p>");
        }
    
        //EXO 2
        // if(isset($_REQUEST['nom'] ,$_REQUEST['prenom'] ,$_REQUEST['age'])){
        //     $nom = $_REQUEST['nom'];
        //     $prenom = $_REQUEST['prenom'];
        //     $age = $_REQUEST['age'];
        //     echo("<p>$nom</p>");
        //     echo("<p>$prenom</p>");
        //     echo("<p>$age</p>");
        // }
    
        // EXO 1
        // elseif(isset($_REQUEST['nom'], $_REQUEST['prenom'])){
        //     $nom = $_REQUEST['nom'];
        //     $prenom = $_REQUEST['prenom'];
        //     echo("<p>$nom</p>");
        //     echo("<p>$prenom</p>");
        //     echo '<p>Tu à oublier de mettre un age !!!!</p>';
        // }
        
        //EXO 3
        // elseif(isset($_REQUEST['dateDebut'], $_REQUEST['dateFin'])){
        //     $dateDebut = $_REQUEST['dateDebut'];
        //     $dateFin = $_REQUEST['dateFin'];
        //     echo("<p>$dateDebut</p>");
        //     echo("<p>$dateFin</p>");
        // }
    
        //EXO 4
        // elseif(isset($_REQUEST['langage'], $_REQUEST['serveur'])){
        //     $langage = $_REQUEST['langage'];
        //     $serveur = $_REQUEST['serveur'];
        //     echo("<p>$langage</p>");
        //     echo("<p>$serveur</p>");
        // }
    
        //EXO 5
        // elseif(isset($_REQUEST['semaine'])){
        //     $semaine = $_REQUEST['semaine'];
        //     echo("<p>$semaine</p>");
        // }
    
        //EXO 6
        // elseif(isset($_REQUEST['batiment'], $_REQUEST['salle'])){
        //     $batiment = $_REQUEST['batiment'];
        //     $salle = $_REQUEST['salle'];
        //     echo("<p>$batiment</p>");
        //     echo("<p>$salle</p>");
        // }
    ?>
</body>
</html>
