<?php 
  include 'config/template/head.php';
?>
        </header>
<!-----------Hero_image_Accueil-------------------------------------------------------------------------------------------------->
        <section class="hero" id="hero-home">
          <h2>Une collection unique d'îles paradisiaques</h>
          <h4>Découvrez nos offres d’îles paradisiaques qui n’attendent que leurs futurs propriétaires</h4>
          <a class="arrow" href="#produits"><img src="../paradise/asset/img/down-arrow.svg"></a>
        </section>
<!-----------Sélection_de_produits_avec_img_et_caractéristiques_en_card-------------------------------------------------------------------------------------------------->
        <section class="produits" id="produits">
          <h2>Nos meilleurs articles</h2>
          <div class="card-deck">
            <div class="card">
              <img class="card-img-top" src="../paradise/asset/img_produit/isla-panama.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Isla Paloma</h5>
                  <h6 class="card-title">Panama</h6>
                  <p class="card-text">290 m2</p>
                  <p class="card-text">295 812€</p>
                  <button type="button" class="btn btn-info"><a href="fiche_produit1.php">Voir</a></button>
                </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="../paradise/asset/img_produit/sand-point-road-beach.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Sand Point Road Beach</h5>
                  <h6 class="card-title">Caymant Island</h6>
                  <p class="card-text">3 700 m2</p>
                  <p class="card-text">4 287 228€</p>
                  <button type="button" class="btn btn-info"><a href="fiche_produit2.php">Voir</a></button>
                </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="../paradise/asset/img_produit/dream-thai-bungalow.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Dream Thaï Bungalow</h5>
                  <h6 class="card-title">Thaïlande</h6>
                  <p class="card-text">2 000 m2</p>
                  <p class="card-text">595 309€</p>
                  <button type="button" class="btn btn-info"><a href="fiche_produit3.php">Voir</a></button>
                </div>
            </div>
          </div>
        </section>
<!-----------Section_expliquant_pourquoi_il_faut_choisir_Paradise-------------------------------------------------------------------------------------------------->
        <section id="choisir-paradise">
          <h2>Pourquoi choisir Paradise ?</h2>
            <div id="choisir-paradise-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Suspendisse ac ipsum sit amet dolor volutpat fringilla. 
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                Donec viverra ante in sodales rhoncus. Cras enim est, malesuada id lectus gravida, tempus posuere diam. </p>
            </div>
        </section>
<?php include 'config/template/footer.php'; ?>

