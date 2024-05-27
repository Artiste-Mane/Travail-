<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('./db_connect.php');

// Section pour valider le formulaire d'inscription admin
if (isset($_POST['register'])){

    //Verifier si l'utilisateur à remplis tous les champs du formulaire
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['pname'])
        && !empty($_POST['birth']) && !empty($_POST['sexe']) && !empty($_POST['mdp'])){

        //Stocker les donnée entrée dans les variable
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $pname = htmlspecialchars($_POST['pname']);
        $sexe = htmlspecialchars($_POST['sexe']);
        $email = htmlspecialchars($_POST['email']);

        $birth = htmlspecialchars($_POST['birth']);
        $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
    
        // Section pour verifier si user existe déjà dans la plateforme
        $ifUserExists =  $conn->prepare('SELECT email FROM users WHERE email = ?');
        $ifUserExists->execute(array($email));
    
        //si il y a aucun user
        if($ifUserExists->rowCount() == 0){
    
            // Section pour inserer les donnée de users dans la base de donnée
            $insertAdmin = $conn->prepare('INSERT INTO users (fname , lname, pname, email, birth, sexe, password) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $insertAdmin->execute(array($fname,$lname, $pname,$email, $birth, $sexe, $mdp));


            header('Location: login.php');
        }   
        //si il y a un user avec cet email
        else{
            $msgError = "ce compte existe !";
        }
    }
    else{
        $msgError = "Veillez completez tous le champs";
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion || PHP</title>
</head>

<body>
    <form  method="post">
        <div >
            <h2>Inscription</h2>
        </div>
        <?php if(isset($msgError)){ ?>
        <p style="color: red;"><?= $msgError ?></p>
        <?php } ?>
        <div class="container">
            <label><b>Nom</b></label>
            <input type="text" placeholder="Entrez votre Nom" name="lname" required>
            <hr><br>

            <label><b>Prénom</b></label>
            <input type="text" placeholder="Entrez votre prenom" name="fname" required>
            <hr>
            <br>
            <label><b>Postnom</b></label>
            <input type="text" placeholder="Entrez votre Nom" name="pname" required>
            <hr>
            <br>
            <label><b>Email</b></label>
            <input type="text" placeholder="Entrez votre Nom" name="email" required>
            <hr><br>
            <h2>Choisissez votre sexe :</h2>

            <label>
            <input type="radio" name="sexe" value="Féminin">
            Féminin
        </label>
        <br>
        <label>
            <input type="radio" name="sexe" value="Masculin">
            Masculin
        </label>
            <hr>
            <br>
            <label><b>Date naissance</b></label>
            <input type="date" placeholder="Entrez votre date de naissance" name="birth" required>
            <hr>
            <br>
            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrez votre mot de passe" name="mdp" required>
            <br>
<br>
            <button type="submit" name="register">Inscription</button>
            <br>
            <label>
                Vous avez déjà un compte ? <a href="login.php">cliquez ici</a>
            </label>
        </div>


    </form>
</body>

</html>