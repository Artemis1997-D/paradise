<?php
/*---------------------------Formulaire Inscription---------------------*/

$resultat='';

if (isset($_POST['envoyer']) && $_POST['envoyer'] == "Envoyer les données") {

  extract($_POST);

  if(empty($pseudo)){
    $content .= "<div class='alert alert-danger'>Le champ pseudo est vide</div>";
  } elseif (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 25) {
    $content .= "<div class='alert alert-danger'>Votre pseudo doit être compris entre 3 et 25 caractères</div>";
  } elseif (preg_match('/[A-Z]/', $pseudo)) {
    $content .= "<div class='alert alert-danger'>Votre pseudo ne dois pas contenir de lettre majuscule</div>";
  } elseif (preg_match('/[%!?*]/', $pseudo)) {
    $content .= "<div class='alert alert-danger'>Votre pseudo ne dois pas comporter de caractères spéciaux</div>";
  } elseif (isset($pseudo)) {
    $req = $pdo->prepare('SELECT * FROM membre WHERE `pseudo` = :pseudo');
    $req->execute(array('pseudo'=> $pseudo));
    $resultat=$req->fetch();
// Vérification :
    if($resultat) {
      $content .= "<div class='alert alert-danger'>Pseudo déjà utilisé</div>";
    }

  }

  if(empty($prenom)){
    $content .= "<div class='alert alert-danger'>Le champ prenom est vide</div>";
  } 
  
  if(empty($nom)){
    $content .= "<div class='alert alert-danger'>Le champ nom est vide</div>";
  } 

  if (empty($mdp)) {
    $content .= "<div class='alert alert-danger'>Le champ Mot de passe est vide</div>";
  } elseif (!preg_match('/[a-z]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre une lettre minuscule</div>";
  } elseif (!preg_match('/[A-Z]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre une lettre majuscule</div>";
  } elseif (!preg_match('/[0-9]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre un chiffre</div>";
  } elseif (!preg_match('/[%!?*]/', $mdp)) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit comprendre un caractère spécial [%!?*]</div>";
  } elseif (iconv_strlen($mdp) < 8 || iconv_strlen($mdp) > 20) {
    $content .= "<div class='alert alert-danger'>Votre mot de passe doit être compris entre 8 et 20 caractères</div>";
  } elseif ($mdp != $repeatmdp) {
    $content .= "<div class='alert alert-danger'>Les mots de passe ne correspondent pas</div>";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $content .= "<div class='alert alert-danger'>Email incorrect</div>";
  }

  if(empty($adresse)){
    $content .= "<div class='alert alert-danger'>Le champ adresse est vide</div>";
  } 

  if (!preg_match('/[0-9]/', $telephone)) {
    $content .= "<div class='alert alert-danger'>Veuillez utiliser des chiffres pour le numéro de téléphone </div>";
  } elseif (iconv_strlen($telephone) != 10 ) {
    $content .= "<div class='alert alert-danger'>Le numéro de téléphone dois comprendre 10 chiffres </div>";
  }

  if (empty($content)) {
    $mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);

    $queryInsert = "INSERT INTO `membre`(`id`, `pseudo`, `prenom`, `nom`, `civilite`, `mdp`, `email`, `adresse`, `telephone`) VALUES (:id, :pseudo, :prenom, :nom, :civilite, :mdp, :email, :adresse, :telephone)";

    $reqPrep = $pdo->prepare($queryInsert);
    $reqPrep->execute(
        [
            'id' => null,
            'pseudo' => $pseudo,
            'prenom' => $prenom,
            'nom' => $nom,
            'civilite' => $civilite,
            'mdp' => $mdpCrypt,
            'email' => $email,
            'adresse' => $adresse,
            'telephone' => $telephone
            
        ]
    );
    $_SESSION['user']['pseudo'] = $pseudo;
    $_SESSION['user']['prenom'] = $prenom;
    $_SESSION['user']['nom'] = $nom;
    $_SESSION['user']['civilite'] = $civilite;
    $_SESSION['user']['mdp'] = $mdpCrypt;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['adresse'] = $adresse;
    $_SESSION['user']['telephone'] = $telephone;
    $_SESSION['user']['statut'] = 0;
    header('location:profil_membre.php?register=true');
    exit();
  }
}
if ((isset($_GET['register']) && $_GET['register'] == 'true') && ($_SESSION['user']['statut'] == 0)) {
  $content .= "<div class='alert alert-success'>Inscription validée !</div>";

}

if (isset($_GET['login']) && $_GET['login'] == 'true') {
  if($_SESSION['user']['statut'] == 1 ) {
    $content .= "<div class='alert alert-success'>Connexion réussie ! Vous êtes connecté en tant qu'administrateur</div>";
  } else {
    $content .= "<div class='alert alert-success'>Connexion réussie ! Vous êtes connecté en tant que membre</div>";
  }
}

if(isset($_GET['access']) && $_GET['access'] == 'forbidden') 
{
  $content .= "<div class='alert alert-danger'>Vous ne pouvez pas acceder à cette page, vous devez vous inscrire ou vous connecter !</div>";
}

if(isset($_GET['connect']) && $_GET['connect'] == 'forbidden') 
{
  $content .= "<div class='alert alert-danger'>Votre statut ne vous permet pas d'accéder à cette page</div>";
}


/*------------------------------------Formulaire de connexion et sessions --------------------*/



if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {
  
  extract($_POST);
    $mdpCrypt = password_hash($mdp, PASSWORD_DEFAULT);
    $pseudoAdmin = "admin";
    $mdpAdmin = "admin";
    
    if (($pseudoAdmin == $pseudo) && ($mdpAdmin == $mdp)){
      $_SESSION['user']['pseudo'] = $pseudo;
      $_SESSION['user']['mdp'] = $mdp;
      $_SESSION['user']['statut'] = 1;
      header('location:profil_admin.php?login=true');
      exit();

    } elseif ($pseudo !== "" && $mdp !== "") {
      $req = $pdo->prepare('SELECT * FROM membre WHERE `pseudo` = :pseudo');
      $req->execute(array(':pseudo'=> $pseudo ));
      $resultat=$req->fetch();
        if($resultat!=0) {
            if (password_verify($mdp, $resultat['mdp'])) {
              $_SESSION['user']['pseudo'] = $pseudo;
              $_SESSION['user']['mdp'] = $resultat['mdp'];
              $_SESSION['user']['prenom'] = $resultat['prenom'];
              $_SESSION['user']['nom'] = $resultat['nom'];
              $_SESSION['user']['civilite'] = $resultat['civilite'];
              $_SESSION['user']['email'] = $resultat['email'];
              $_SESSION['user']['adresse'] = $resultat['adresse'];
              $_SESSION['user']['telephone'] = $resultat['telephone'];
              $_SESSION['user']['statut'] = 0;
            header('Location: profil_membre.php?login=true');
            exit();
        
            } else {
              $content .= '<div style="background:tomato;padding:2%;">Mot de passe incorrect</div>';
            }

           
        }
        else
        {
          $content .= '<div style="background:tomato;padding:2%;">Utilisateur ou mot de passe incorrect</div>';
        }
    }
    else
    {
      $content .= '<div style="background:tomato;padding:2%;">Utilisateur ou mot de passe vide</div>';
    }

}

//------------Enregistrement_produit------------------------
if(isset($_POST['ajouter']) && $_POST['ajouter'] == "Ajouter un produit") {
    
  extract($_POST);

  if(empty($photo_hero)) {
    $content .= "<div class='alert alert-danger'>Aucun fichier choisi pour le hero-image</div>";
  }

  if(empty($photo_min1)) {
    $content .= "<div class='alert alert-danger'>Aucune image pour la 1ère miniature du produit</div>";
  }

  if(empty($photo_min2)) {
    $content .= "<div class='alert alert-danger'>Aucune image pour la 2ème miniature du produit</div>";
  }
  
  if(empty($photo_min3)) {
    $content .= "<div class='alert alert-danger'>Aucune image pour la 3ère miniature du produit</div>";
  }

  if(empty($nom_produit)) {
    $content .= "<div class='alert alert-danger'>Le champ nom du produit est vide</div>";
  }

  if(empty($categorie)) {
    $content .= "<div class='alert alert-danger'>Le champ catégorie du produit est vide</div>";
  }

  if(empty($description)) {
    $content .= "<div class='alert alert-danger'>Le champ description du produit est vide</div>";
  }

  if(empty($localisation)) {
    $content .= "<div class='alert alert-danger'>Le champ localisation du produit est vide</div>";
  }

  if(empty($superficie)) {
    $content .= "<div class='alert alert-danger'>Le champ superficie du produit est vide</div>";
  }

  if(empty($prix)) {
    $content .= "<div class='alert alert-danger'>Le champ prix du produit est vide</div>";
  }
 
  if(empty($stock)) {
    $content .= "<div class='alert alert-danger'>Le champ stock du produit est vide</div>";
  }

  if((empty($content)) || ($content == "<div class='alert alert-success'>Connexion réussie ! Vous êtes connecté en tant qu'administrateur</div>")) {

    $queryInsert = "INSERT INTO `produits`(`id_produit`, `photo_hero`, `photo_min1`, `photo_min2`, `photo_min3`, `nom_produit`, `categorie`, `description`, `localisation`, `superficie`, `prix`, `stock`) VALUES (:id_produit, :photo_hero, :photo_min1, :photo_min2, :photo_min3, :nom_produit, :categorie, :description, :localisation, :superficie, :prix, :stock)";

    $reqPrep = $pdo->prepare($queryInsert);
    $reqPrep->execute(
      [
        'id_produit'   => null,
        'photo_hero'   => $photo_hero,
        'photo_min1'   => $photo_min1,
        'photo_min2'   => $photo_min2,
        'photo_min3'   => $photo_min3,
        'nom_produit'  => $nom_produit,
        'categorie'    => $categorie,
        'description'  => $description,
        'localisation' => $localisation,
        'superficie'   => $superficie,
        'prix'         => $prix,
        'stock'        => $stock,
      ]
      );
      $_SESSION['user']['photo_hero']   = $photo_hero;
      $_SESSION['user']['photo_min1']   = $photo_min1;
      $_SESSION['user']['photo_min2']   = $photo_min2;
      $_SESSION['user']['photo_min3']   = $photo_min3;
      $_SESSION['user']['nom_produit']  = $nom_produit;
      $_SESSION['user']['categorie']    = $categorie;
      $_SESSION['user']['description']  = $description;
      $_SESSION['user']['localisation'] = $localisation;
      $_SESSION['user']['superficie']   = $superficie;
      $_SESSION['user']['prix']         = $prix;
      $_SESSION['user']['stock']        = $stock;
      $_SESSION['user']['statut']       = 1;
      header('location:profil_admin.php?register=true');
      exit();
  }
}

if((isset($_GET['register']) && $_GET['register'] == 'true') && ($_SESSION['user']['statut'] == 1) ) {
  $content .= "<div class='alert alert-success'>Produit enregistré !</div>";
 }


 //------------------------Affichage_des_produits--------------------
  

 if (isset($_SESSION['user']) ) {
// connexion à la base de données
 $pdo = mysqli_connect("localhost", "root", "root", "paradise");

// requête sql pour avoir les infos des produits
 $resultat = mysqli_query($pdo, "SELECT id_produit, nom_produit, categorie, localisation, prix, stock  FROM produits");

 $liste_produits .= 'Nombre de produit(s) dans la boutique : ' . $resultat->num_rows . '<br>';
 // début du tableau permettant d'avoir la liste des produits
 $liste_produits .= '<table class="text-center" border="1"><tr> ';
 while($colonne = $resultat->fetch_field()) {

   $liste_produits .= '<th>' . $colonne->name . '</th>';
 }
// ajout d'une colonne modification et suppression
 $liste_produits .= '<th>Modification</th>';
 $liste_produits .= '<th>Suppression</th>';
 $liste_produits .= '</tr>';

 while ($ligne = $resultat->fetch_assoc()) {


   $liste_produits .= '<tr>';
   
   foreach ($ligne as $indice => $information) {
       $liste_produits .= '<td class="text-center">' . $information . '</td>';
     }
     $id = $ligne['id_produit']; // Récupération de l'id du produit à modifier
     $liste_produits .= '<td class="text-center"><a href="?modify=' . $id . '" ><img src="asset\img\edit-button.svg" width="25px" height="25px"></a></td>';
     $liste_produits .='<td class="text-center"><a href="?action=suppression&id_produit=' . '" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="asset\img\delete.svg" width="25px" height="25px"></a></td>';
   } 
     $liste_produits .='</tr></table><br>';
} 



//-------------------------Suppresion_des_produits--------------------------




  







//--------------------------Modification_des_produits----------------------


if (isset($_GET['modify'])) {
  $produit = $_GET['modify'];
  $req = $pdo -> prepare ("SELECT * FROM produits WHERE `id_produit` = :id_produit ");
  $req->execute(array(':id_produit'=> $produit ));
  $resultat=$req->fetch();
  if ($resultat !=0 ) {
    $formulaire = '<form class="formulaire-ajout-article m-auto p-4" action="" method="post">
    <div class="form-group">
    <label for="photo_hero">Choisir limage en hero</label>
    <input id="photo_hero" type="file" name="photo_hero" value="' . $resultat[1] . '" accept="image/*" multiple>
</div>
<div class="form-group">
    <label for="photo_min1">Choisir la première image miniature pour le produit</label>
    <input id="photo_min1" type="file" name="photo_min1" value="' . $resultat[2] . '"  accept="image/*" multiple>
</div>
<div class="form-group">
    <label for="photo_min2">Choisir la deuxième image miniature pour le produit</label>
    <input id="photo_min2" type="file" name="photo_min2" value="' . $resultat[3] . '"  accept="image/*" multiple>
</div>
<div class="form-group">
    <label for="photo_min3">Choisir la troisième image miniature pour le produit</label>
    <input id="photo_min3" type="file" name="photo_min3" value="' . $resultat[4] . '" accept="image/*" multiple>
</div>
<div class="form-group">
    <label for="nom_produit">Nom du produit</label>
    <input type="text" class="name-article" name="nom_produit" value="' . $resultat[5] . '"  id="nom_produit" placeholder="Entrer le nom de larticle">
</div>
<div class="form-group">
    <label for="categorie">Catégorie du produit</label>
    <input type="text" class="categorie-article" name="categorie" value="' . $resultat[6] . '"  id="categorie" placeholder="Entrer la catégorie de larticle">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input type="textarea" class="description-article" name="description" value="' . $resultat[7] . '" id="description" placeholder="Présentez en quelques lignes le produit">
</div>
<div class="form-group">
    <label for="localisation">Localisation</label>
    <input type="text" class="localisation-article" name="localisation" value="' . $resultat[8] . '"  id="localisation" placeholder="Entrez la localisation du produit">
</div>
<div class="form-group">
    <label for="suoerficie">Superficie(m2)</label>
    <input type="number" class="superficie" name="superficie" value="' . $resultat[9] . '"  id="superficie" placeholder="Entrez la superficie du produit">
</div>
<div class="form-group">
    <label for="prix">Prix</label>
    <input type="number" class="prix" name="prix" value="' . $resultat[10] . '"  id="prix" placeholder="Entrez le prix du produit à lunité">
</div>
<div class="form-group">
    <label for="stock">Stock</label>
    <input type="number" class="stock" name="stock" value="' . $resultat[1] . '"  id="stock" placeholder="Entrez le stock">
</div>
<button type="submit" class="btn btn-primary" value="Modifier" name="modifier" aria-label="bouton qui permet de modifier un  produit">Modifier</button>
    </form>';
  
  }

  if (isset($_POST['modifier']) && $_POST['modifier'] == "Modifier") {
    extract($_POST);

    $queryInsert = "UPDATE `produits` SET `id_produit` = :id_produit, `photo_hero` = :photo_hero, `photo_min1` = :photo_min1, `photo_min2` = :photo_min2 , `photo_min3` = :photo_min3 , `nom_produit` = :nom_produit, `categorie` = :categorie, `description` = :description , `localisation` = :localisation, `superficie` = :superficie , `prix` = :prix, `stock` = :stock)";

    $reqPrep = $pdo->prepare($queryInsert);
    $reqPrep->execute(
      [
        'id_produit'   => null,
        'photo_hero'   => $photo_hero,
        'photo_min1'   => $photo_min1,
        'photo_min2'   => $photo_min2,
        'photo_min3'   => $photo_min3,
        'nom_produit'  => $nom_produit,
        'categorie'    => $categorie,
        'description'  => $description,
        'localisation' => $localisation,
        'superficie'   => $superficie,
        'prix'         => $prix,
        'stock'        => $stock,
      ]
      );
}
}














//--------------------------La_page_nos_produits--------------------------------------
