<?php 
    session_start();
    require ('./db_connect.php');


    // Section pour valider le formulaire d'inscription de users
    if (isset($_POST['connexion'])){
        //Verifier si users à remplis tous les champs du formulaire
        if(!empty($_POST['email']) && !empty($_POST['mdp'])){

            //Stocker les donnée entrée dans les variable
            $Email = htmlspecialchars($_POST['email']);
            $Mdp = htmlspecialchars($_POST['mdp']);

            //Verifier si le email existe
            $checkIfUser = $conn->prepare('SELECT * FROM users WHERE email = :email');
            $checkIfUser->execute(array('email' => $Email));
            

        if($checkIfUser->rowCount() > 0){ // la méthode rowcount nous permet de compter les nombre des donnée entré par User

            $Infos = $checkIfUser->fetch(); //recuperer toutes les infos users est stocker dans un tabelau

            //Section pour verifier si le mot de passe entrer par l'admin correspond à celui de la BD
            if(password_verify($Mdp, $Infos['password'])){

                //Section pour authentifier de user sur la plateforme avec les session
                $_SESSION['users'] = true;
                $_SESSION['id'] = $Infos['id'];
                $_SESSION['prenom'] = $Infos['fname'];
                $_SESSION['nom'] = $Infos['lname'];
                $_SESSION['postnom'] = $Infos['pname'];
                $_SESSION['email'] = $Infos['email'];
                $_SESSION['naissance'] = $Infos['birth'];
                $_SESSION['sexe'] = $Infos['sexe'];


               
                //Si les information entrée sont correct, on fait la redirection vers la page d'accueil
                header('Location: index.php');

            }
            else{
                $msgError = "Votre mot de passe ou email est incorrect";
            }

        }
        else{
            $msgError = "Votre mot de passe ou email est incorrect";
        }
       
        }
        else{
            $msgError = "Veillez complez tous les champs";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion || PHP</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <form action="" method="post">
        <div class="container1">
            <h2>Connexion</h2>
        </div>

        <?php if(isset($msgError)){ ?>
        <p style="color: red;"><?= $msgError ?></p>
        <?php } ?>
        <div class="container">
            <label ><b>Email</b></label>
            <input type="text" placeholder="Entrez votre email" name="email" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrez votre mot de passe" name="mdp" required>

            <button type="submit" name="connexion">Connexion</button>
            <label>
               Vous n'avez pas de compte ?  <a href="register.php">cliquez ici</a>
            </label>
        </div>

        
    </form>
</body>

</html>