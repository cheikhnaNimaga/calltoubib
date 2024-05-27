<?php
    $firstname="";
    $lastname="";
    $email="";
    $password="";
    $adresse="";
    $numero="";
    $naissance="";
    include ('database.php');
    session_start();

    if(isset($_GET["id"])){
        $stmt = $connexion->prepare("SELECT * FROM user WHERE id=? LIMIT 1"); 
        $stmt->execute(array($_GET['id'])); 
        $row = $stmt->fetch();
        $prenom= $row["Prénom"];
        $nom= $row["Nom"];
        $email= $row["email"];
        $nameuser= $row["Nom d'utilisatuer"];
        $mot_de_passe= $row["Mot de passe"];
        
        
    }else if(isset($_POST['prenom'])){
        try{
            $type=2;
            if(isset($_POST['validMedecin'])){
                $type=1;
            }
            $stmt = $connexion->prepare("INSERT INTO `user`
                                        (`firstname`, `lastname`, `email`, `password`, `adresse`, `numero`, `naissance`, `type`,`specialite`)
                                        VALUES (:prenom, :nom, :email, :password, :adresse, :numero, :naissance, :type, :specialite);");
            $stmt->execute(array("prenom"=>$_POST["prenom"],
                                    "nom"=>$_POST["nom"],
                                    "email"=>$_POST["email"],
                                    "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT),
                                    "adresse"=>$_POST["adresse"],
                                    "numero"=>$_POST["numero"],
                                    "naissance"=>$_POST["naissance"],
                                    "type"=>$type,
                                    "specialite"=>$_POST["specialite"]));
            }
            catch(PDOException $e){
                printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
                exit();
            }finally{
                echo "<p style='color:green'>Inscription réussie!</p>";
            }
    }  

    // function rechercherMedecins($debutNom) {
    //     try{
            
    //         if(isset($_POST['search'])){
    //             $stmt = $connexion->prepare("SELECT lastname FROM user WHERE lastname LIKE ?");
                                        
                
    //         }
            
    //     }
            
    //         catch(PDOException $e){
    //             printf("Erreur lors de l'inscription : %s\n", $e->getMessage());
    //             exit();
    //         }finally{
    //             echo "<p style='color:green'>Inscription réussie!</p>";
    //         }
    
         
    //     // Préparation de la requête SQL avec un paramètre de recherche 
    //     $stmt = $connexion->prepare("SELECT lastname FROM user WHERE lastname LIKE ?");
    //    $x = '%'.$search_term.'%';
    //    $stmt->bind_param("s", $x);

    //    // Execute statement
    //    $stmt->execute([$result,$debutNom]);

    //    $result = $stmt->get_result(); }
?>

