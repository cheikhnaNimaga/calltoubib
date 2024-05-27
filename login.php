<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CALLTOUBIB - Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    
    <?php include 'header.php';
    include 'database.php';
        if(isset($_POST["connexion"])){
            if(empty($_POST["email"]) || empty($_POST["password"])){
                echo "<p style='color:red'>Tous les champs sont obligatoires!</p>";
            }else{
                $stmt = $connexion->prepare("SELECT * FROM user WHERE email=:email"); 
                $stmt->execute(array("email"=>$_POST["email"])); 
                $row = $stmt->fetch();
                if(is_array($row) && password_verify($_POST['password'], $row["password"])){
                    $_SESSION["user"]= $row;
                    header("Location: index.php");
                }else{
                    echo "<p style='color:red'>Identifiants incorrect!</p>";
                }
            }
        }
    
    ?>


    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-success">Vous avez déjà un compte ? </h5>
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="mail" class="form-control" name="email">
                            </div>  
                            <div class="mb-3">
                                <label class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="float-end">
                                <button type="submit" class="btn btn-success" name='connexion'>Se connecter</button>
                                <a class="text-success" href="rdv.php"></a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>


</body>
</html>