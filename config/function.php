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
  } elseif ($_SESSION['user']['statut'] == 0 ) {
    $content .= "<div class='alert alert-success'>Connexion réussie ! Vous êtes connecté en tant que membre</div>";
  } else {
    $content .= "<div class='alert alert-danger'>Vous n'avez pas accès à cette page</div>";
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



if(isset($_POST['login']) && $_POST['login'] == "login") {
  
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
    $content .= "<div class='alert alert-danger'>Aucune image pour le hero-image</div>";
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
    
        $queryInsert = "REPLACE INTO `produits`(`id_produit`, `photo_hero`, `photo_min1`, `photo_min2`, `photo_min3`, `nom_produit`, `categorie`, `description`, `localisation`, `superficie`, `prix`, `stock`) VALUES (:id_produit, :photo_hero, :photo_min1, :photo_min2, :photo_min3, :nom_produit, :categorie, :description, :localisation, :superficie, :prix, :stock)";

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

// Fonction pour accéder à la base de données

function connect_bdd() {
  $pdo = mysqli_connect("localhost", "root", "", "paradise");
}

 //------------------------Affichage_des_produits--------------------
  

 if (isset($_SESSION['user']) ) {
// connexion à la base de données
  connect_bdd();

// requête sql pour avoir les infos des produits
 $resultat = mysqli_query($pdo, "SELECT id_produit, nom_produit, categorie, prix, stock  FROM produits");

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
     $liste_produits .= '<td class="text-center"><a href="?modify&id_produit=' . $id . '" ><img src="asset\img\edit-button.svg" width="25px" height="25px"></a></td>';
     $liste_produits .='<td class="text-center"><a href="?action=delete&id_produit=' . $id . '" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="asset\img\delete.svg" width="25px" height="25px"></a></td>';
   } 
     $liste_produits .='</tr></table><br>';
} 



//------------------------------------------Suppression_des_produits--------------------------

if(isset($_GET['action']) && $_GET['action'] == "delete" && $_SESSION['user']['statut'] == 1) {
  $pdo = mysqli_connect("localhost", "root", "root", "paradise");
  $resultat = mysqli_query($pdo, "SELECT *  FROM produits WHERE id_produit = $_GET[id_produit]");
  $produit_a_supprimer = $resultat->fetch_assoc();
  $resultat = mysqli_query($pdo, "DELETE FROM produits WHERE id_produit = $_GET[id_produit]");
  $content .= "<div class='alert alert-success'>Produit supprimé !</div>";
  };  


//-----------------------------------------Modification_des_produits----------------------







//-----------------------------------------------Panier--------------------------------------
function creationPanier(){
  if (!isset($_SESSION['panier'])){
     $_SESSION['panier'] = array();
     $_SESSION['panier']['nomProduit'] = array();
     $_SESSION['panier']['localisationProduit'] = array();
     $_SESSION['panier']['qteProduit'] = array();
     $_SESSION['panier']['prixProduit'] = array();
     $_SESSION['panier']['image'] = array();
     $_SESSION['panier']['stock'] = array();
     $_SESSION['panier']['verrou'] = false;
  }
  return true;
}

creationPanier();


function ajouterArticle($nomProduit,$localisationProduit,$qteProduit,$prixProduit,$image,$stock){

  //Si le panier existe
  if (creationPanier() && !isVerrouille())
  {
     //Si le produit existe déjà on ajoute seulement la quantité
     $positionProduit = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);

     if ($positionProduit !== false)
     {
        $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
     }
     else
     {
        //Sinon on ajoute le produit
        array_push( $_SESSION['panier']['nomProduit'],$nomProduit);
        array_push( $_SESSION['panier']['localisationProduit'],$localisationProduit);
        array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
        array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
        array_push( $_SESSION['panier']['image'],$image);
        array_push( $_SESSION['panier']['stock'],$stock);
     }
  }
  else
  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function supprimerArticle($nomProduit){
  //Si le panier existe
  if (creationPanier() && !isVerrouille())
  {
     //Nous allons passer par un panier temporaire
     $tmp=array();
     $tmp['nomProduit'] = array();
     $tmp['localisationProduit'] = array();
     $tmp['qteProduit'] = array();
     $tmp['prixProduit'] = array();
     $tmp['image'] = array();
     $tmp['stock'] = array();
     $tmp['verrou'] = $_SESSION['panier']['verrou'];

     for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
     {
        if ($_SESSION['panier']['nomProduit'][$i] !== $nomProduit)
        {
           array_push( $tmp['nomProduit'],$_SESSION['panier']['nomProduit'][$i]);
           array_push( $tmp['localisationProduit'],$_SESSION['panier']['localisationProduit'][$i]);
           array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
           array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
           array_push( $tmp['image'],$_SESSION['panier']['image'][$i]);
           array_push( $tmp['stock'],$_SESSION['panier']['stock'][$i]);
        }

     }
     //On remplace le panier en session par notre panier temporaire à jour
     $_SESSION['panier'] =  $tmp;
     //On efface notre panier temporaire
     unset($tmp);
  }
  else
  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQTeArticle($nomProduit,$qteProduit,$stock){
  //Si le panier existe
  if (creationPanier() && !isVerrouille())
  {
     //Si la quantité est positive on modifie sinon on supprime l'article
     if ($qteProduit > 0)
     {
        //Recherche du produit dans le panier
        $positionProduit = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);

        if ($positionProduit !== false)
        {   
          if ($qteProduit > $stock) {
            $_SESSION['panier']['qteProduit'][$positionProduit] = $stock;
            echo '<div class="alert alert-danger"> Désolé il n\'y a pas assez de stock, vous pouvez prendre '.$stock.' articles max pour ce produit</div>';
        } else
           $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
        }
        
     }
     
     else
     supprimerArticle($nomProduit);
  }
  else
  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function MontantGlobal(){
  $total=0;
  for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
  {
     $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
  }
  return $total;
}

function isVerrouille(){
  if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
  return true;
  else
  return false;
}

function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['nomProduit']);
   else
   return 0;

}

function supprimePanier(){
  unset($_SESSION['panier']);
}
 
