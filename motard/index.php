<?php 

require ('./security.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion || PHP</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="card-container">
     
      <main class="main-content">
        <?php if($_SESSION['sexe'] == "Féminin"){ ?>
          Bienvenue Madame  <h1><a href="#"><?= $_SESSION['prenom'] .' '. $_SESSION['nom'] ?></a></h1>
        <?php }else{ ?>
                 Bienvenu Monsieur,  <h1><?= $_SESSION['prenom'] .' '. $_SESSION['nom'] . ' ' . $_SESSION['postnom'] ?></h1>
        <?php } ?>
       <br>
        <h3>Votre email : <?= $_SESSION['email'] ?></h3>
         <h3>Votre année de naissance : <?= $_SESSION['naissance'] ?></h3>

        
      </main>
     
</div>
<hr>
<section>
  <h1>Paiement</h1>
  <form action="" method="post">
    <label for="">Nom utilisateur</label>
    <input type="text" value="<?= $_SESSION['nom'] .' ' .$_SESSION['prenom'] ?>">
    <br><br>
    <label for="">Numéro d'immatriculation</label>
    <input type="text" placeholder="Entrez le matricule">
    <br><br>
    <label for="">Motant à payer</label>
    <input type="number" placeholder="Entrez le matricule">
    <br> <br>
    <label for="">Date du payement</label>
    <input type="date" >
    <br><br>
    <button type="submit">Enregistrer</button>
  </form>
</section>
<br>
  <div class="attribution">
 <a href="logout.php">Déconnexion</a>.
  </div>
</body>

</html>