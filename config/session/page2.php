<?php
session_start();
//on interdit l'accès à cette page aux utilisateurs non-connectés. càd qu'il n'y a pas eu de création de session user
if(!isset($_SESSION['user']))
{
  header('location:page1.php?access=forbidden');
  exit();
}

echo'<pre>';
print_r($_SESSION);
echo '</pre>';
//echo $_POST['pseudo'];

//affichage message erreur en cas d'accès à la page 1
if(isset($_GET['connect']) && $_GET['connect'] == 'forbidden') 
{
  echo '<div style="background:tomato;padding:2%;">Vous ne pouvez pas accéder à la page 1</div>';
}

if(isset($_GET['session']) && $_GET['session'] == 'destroy')
{
  session_destroy();//On détruit
  header('location:page1.php');
  exit();
}

?>

<h2>Page 2</h2>
<div style="background:chartreuse;padding:2%">Vous êtes connecté(e)</div>
<?php
if($_SESSION['user']['statut'] == 0)
{
  echo '<h2>Vous êtes simple membre</h2>';
}else{
  echo '<h2>Vous êtes simple administrateur</h2>';
  echo '<h3>Gestion des stocks</h3>';
  echo '<select><option>1</option></select>';
}

?>
<ul>
  <li>Pseudo : <?= $_SESSION['user']['pseudo']; ?></li>
  <li>Mot de passe : <?= $_SESSION['user']['mdp']; ?></li>
</ul>

<a href="?session=destroy">Déconnexion</a>