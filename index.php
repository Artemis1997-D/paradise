<?php 
  include 'config/template/head.php';

// Début de la div nos meilleurs produits
$meilleurs_produits .= '<div class="card-deck d-flex flex-wrap">';

//Connection à la base de données
$pdo = mysqli_connect("localhost", "root", "", "paradise");
$donnees = mysqli_query($pdo, "SELECT id_produit, nom_produit, photo_min1, localisation, superficie, prix FROM produits ORDER BY id_produit DESC limit 3 ");

//Permet d'associer chaque ligne de la table produits à un endroit du template ci-dessous
while ($produit = $donnees->fetch_assoc()) {
  $meilleurs_produits .='<article class="card">';
  $meilleurs_produits .= '<figure><img class="card-img-top" alt="'. $produit["nom_produit"] .'" src="asset/img_produit/'. $produit["photo_min1"] .'"></figure>';
  $meilleurs_produits .= '<div class="card-body">';
  $meilleurs_produits .= '<h5 class="card-title">' . $produit['nom_produit']  . '</h5>';
  $meilleurs_produits .= '<h6 class="card-title">' .$produit['localisation'] . '</h6>';
  $meilleurs_produits .= '<p class="card-text">' . $produit['superficie'] . ' m2</p>';
  $meilleurs_produits .= '<p class="card-text">' . $produit['prix'] . ' €</p>';
  $meilleurs_produits .= '<button type="button" class="btn btn-info"><a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '"aria-label="lien qui mène vers le produit">Voir</a></button>';
  $meilleurs_produits .= '</div></article>';
}
$meilleurs_produits .= '</div>';
// Fin de la div nos meilleurs produits
?>
        </header>
<!-----------Hero_image_Accueil-------------------------------------------------------------------------------------------------------------------------------------->
        <section class="hero d-flex flex-column justify-content-center text-center" id="hero-home" alt="photo en hauteur de la plage et de la mer cristalline" aria-label="hero image de la page d'accueil">
          <h2 class="text-center my-5 mx-0">Une collection unique d'îles paradisiaques</h2>
          <h4 class="mt-5 mx-auto">Découvrez nos offres d’îles paradisiaques qui n’attendent que leurs futurs propriétaires</h4>
          <a class="arrow my-0 mx-auto" href="#produits"><img class="arrow" src="asset/img/down-arrow.svg" alt="ancre qui mène aux meilleurs articles"></a>
        </section>
<!-----------Sélection_de_produits_avec_img_et_caractéristiques_en_card--------------------------------------------------------------------------------------------->
        <section class="produits d-flex flex-wrap my-5 mx-auto" id="produits" aria-label="présentation des trois meilleurs produits du site">
          <h2 class="text-center">Nos meilleurs articles</h2>
          <!----Emplacement_de_la_variable_meilleurs_produits------------------------------------------------------------------------------------------------------->
          <?php echo $meilleurs_produits ?>
        </section>
<!-----------Section_expliquant_pourquoi_il_faut_choisir_Paradise--------------------------------------------------------------------------------------------------->
        <section class="d-flex flex-column p-5" id="choisir-paradise" aria-label="présentation des valeurs et de ce que propose Paradise">
          <h2 class="text-center">Pourquoi choisir Paradise ?</h2>
            <div class="m-auto" id="choisir-paradise-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Suspendisse ac ipsum sit amet dolor volutpat fringilla. 
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                Donec viverra ante in sodales rhoncus. Cras enim est, malesuada id lectus gravida, tempus posuere diam. </p>
            </div>
        </section>   
<?php include 'config/template/footer.php'; ?>

