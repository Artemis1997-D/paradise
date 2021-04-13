<?php 
include 'config/template/head.php'; 
?>

<?php
//-------------------------------Affichage_des_catégories---------------------------------------------------------------------------------------
  $pdo = mysqli_connect("localhost", "root", "root", "paradise");
  $categories_produits = mysqli_query($pdo, "SELECT DISTINCT categorie FROM produits");
  $nav_cat .= '<nav class="nav d-flex justify-content-around">';
  // pour chaque catégorie créé à partir du profil admin, un lien est créé dans la page tt les produits
  while($cat = $categories_produits->fetch_assoc()) {
   $nav_cat .= "<a class='nav-link m-5' href='?categorie=" .$cat['categorie'] . "'>" . $cat['categorie'] . "</a>";
  }
   $nav_cat .= '</nav>';

//-------------------------------Affichage_des_produits----------------------------------------------------------------------------------------
// Reproduction de la maquette faite en front
  $tt_les_produits .=  '<section class="liste-produit d-flex flex-row justify-content-center flex-wrap">'; 
  if(isset($_GET['categorie'])) {
    $donnees = mysqli_query($pdo, "SELECT id_produit, photo_min1, nom_produit, localisation, superficie, prix FROM produits WHERE categorie='$_GET[categorie]' ");
    while ($produit = $donnees->fetch_assoc()) {
      $tt_les_produits .= '<article class="produit-page-produit m-5 p-5">';
      $tt_les_produits .= '<figure><img class="image-produit" alt="' . $produit["nom_produit"] . '" src="asset/img_produit/'. $produit["photo_min1"] . '"></figure>';
      $tt_les_produits .= '<h5>' . $produit["nom_produit"] . '</h5>';
      $tt_les_produits .= '<p>' .$produit["localisation"]. '</p>';
      $tt_les_produits .= '<p>' . $produit["superficie"] . ' m2</p>';
      $tt_les_produits .= '<p>' . $produit["prix"] . ' €</p>';
      $tt_les_produits .= '<button class="btn btn-info"><a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '  aria-label="lien qui mène vers le produit">Voir</a></button>';
      $tt_les_produits .= '</article>';
    } 
    } else {
      $donnees = mysqli_query($pdo, "SELECT id_produit, photo_min1, nom_produit, localisation, superficie, prix FROM produits");
      while ($produit = $donnees->fetch_assoc()) {
      $tt_les_produits .= '<article class="produit-page-produit m-5 p-5">';
      $tt_les_produits .= '<figure><img class="image-produit" alt="' . $produit["nom_produit"] . '" src="asset/img_produit/'. $produit["photo_min1"] . '"></figure>';
      $tt_les_produits .= '<h5>' . $produit["nom_produit"] . '</h5>';
      $tt_les_produits .= '<p>' .$produit["localisation"]. '</p>';
      $tt_les_produits .= '<p>' . $produit["superficie"] . ' m2</p>';
      $tt_les_produits .= '<p>' . $produit["prix"] . ' €</p>';
      $tt_les_produits .= '<button class="btn btn-info"><a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '  aria-label="lien qui mène vers le produit">Voir</a></button>';
      $tt_les_produits .= '</article>';
      }
      };

  $tt_les_produits .= '</section>';

  ?>
        </header>
        <main>
        <h2 class="text-center">Nos Produits</h2>
        <?php echo $nav_cat ?>
        <!-----------Liste_produits_card_deck_avec_caractéristiques------------------------------------------------------------------------->
        <?php echo $tt_les_produits ?>
        </main>
<?php include 'config/template/footer.php'; ?>