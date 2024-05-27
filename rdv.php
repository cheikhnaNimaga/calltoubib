<!DOCTYPE html> 
<html lang="fr">
<head>
         <meta charset="UTF-8">
          <title>Recherche de Médecins</title> 
</head> 
<body> <!-- Formulaire de recherche --> 
    <?php include 'index.php';?>
    <form method="get" action=""> 
    <input type="text" name="search" placeholder="Début du nom du médecin" value="
    <?php if (isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>"> 
    <button type="submit">Rechercher</button> 
    </form> 
    <?php 
        if (isset($_GET['search']) && !empty($_GET['search'])) { 
            $debutNom = $_GET['search']; $medecinsTrouves = rechercherMedecins($debutNom); 
            if (count($medecinsTrouves) > 0) { 
                echo "<ul>"; foreach ($medecinsTrouves as $medecin) 
            { echo "<li>" . htmlspecialchars($medecin['nom']) . "</li>"; } 
            echo "</ul>"; } else { echo "Aucun médecin trouvé."; } } 
    ?> 
</body> 
</html>