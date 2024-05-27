<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALLTOUBIB - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <?php include 'header.php';?>
  

    <?php
    include ('database.php');
    // session_start();

    require_once 'formuser.php';

?>

<form method="POST" action="index.php">
    <div class="search-bar">
        <input type="text" name='debutNom' placeholder="Rechercher un médecin, une spécialité..." required>
        <input type="text" name='lieu' placeholder="Lieu" >
        <button type="submit" name='search'>Rechercher</button>
    </div>
</form>


<?php
    function rechercherMedecins($debutNom) {
        try{
            if(isset($_POST['search'])){
                $dsn="mysql:dbname=calltoubib;host=localhost";
                $connexion=new PDO($dsn,"root","");
                $stmt = $connexion->prepare("SELECT * FROM user WHERE lastname LIKE :lastname");

                // Définir le paramètre
                $search_term = "%".$debutNom."%";
                $stmt->bindParam(':lastname', $search_term, PDO::PARAM_STR);

                // Exécuter la requête
                $stmt->execute();

                // Récupérer les résultats
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo '<div class="results">';
                foreach ($result as $row) {
                    echo '<div class="result-card">';
                    echo '<h3>'.$row['firstname'].' '.$row['lastname'].'</h3>';
                    echo '<p>Email: '.$row['email'].'</p>';
                    echo '<p>Adresse: '.$row['adresse'].'</p>';
                    echo '<p>Numéro: '.$row['numero'].'</p>';
                    echo '</div>';
                }
                echo '</div>';
            }
        } catch(PDOException $e){
            exit();
        }
    }

    if(isset($_POST['search'])){
        rechercherMedecins($_POST['debutNom']);
    }
?>

    


    <div id="content">

        <marquee direction="left" scrollamount="3">CALLTOUBIB est votre plateforme fiable pour prendre des rendez-vous médicaux, donner votre avis, et gérer votre agenda médical</marquee>


    </div>

     <img src="toubib.png" alt="logo du site" width="250px"> 


    <!-- pied de page -->
    <footer>
        <p>
            Copyright &copy; CALLTOUBIB - 2024 - All Right Reserved
        </p>
    </footer>


</body>
</html>