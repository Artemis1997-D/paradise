<?php 
  include 'config/template/head.php';
?>
        </header>
<!-----------Hero_image_Accueil-------------------------------------------------------------------------------------------------->
        <section class="hero d-flex flex-column justify-content-center text-center" id="hero-home" alt="photo en hauteur de la plage et de la mer cristalline" aria-label="hero image de la page d'accueil">
          <h2 class="text-center my-5 mx-0">Une collection unique d'îles paradisiaques</h2>
          <h4 class="mt-5 mx-auto">Découvrez nos offres d’îles paradisiaques qui n’attendent que leurs futurs propriétaires</h4>
          <a class="arrow my-0 mx-auto" href="#produits"><img src="asset/img/down-arrow.svg" alt="ancre qui mène aux meilleurs articles"></a>
        </section>
<!-----------Sélection_de_produits_avec_img_et_caractéristiques_en_card-------------------------------------------------------------------------------------------------->
        <section class="produits d-flex flex-wrap my-5 mx-auto" id="produits" aria-label="présentation des trois meilleurs produits du site">
          <h2 class="text-center">Nos meilleurs articles</h2>
          <div class="card-deck d-flex flex-wrap">
            <article class="card">
              <img class="card-img-top" src="asset/img_produit/isla-panama.webp" alt="maison à Isla Paloma">
                <div class="card-body">
                  <h5 class="card-title">Isla Paloma</h5>
                  <h6 class="card-title">Panama</h6>
                  <p class="card-text">290 m2</p>
                  <p class="card-text">295 812€</p>
                  <button type="button" class="btn btn-info"><a href="fiche_produit1.php">Voir</a></button>
                </div>
            </article>
            <article class="card">
              <img class="card-img-top" src="asset/img_produit/sand-point-road-beach.webp" alt="Sand Point Road Beach">
                <div class="card-body">
                  <h5 class="card-title">Sand Point Road Beach</h5>
                  <h6 class="card-title">Caymant Island</h6>
                  <p class="card-text">3 700 m2</p>
                  <p class="card-text">4 287 228€</p>
                  <button type="button" class="btn btn-info"><a href="fiche_produit2.php">Voir</a></button>
                </div>
            </article>
            <article class="card">
              <img class="card-img-top" src="asset/img_produit/dream-thai-bungalow.webp" alt="Bungalow au-dessus de la mer">
                <div class="card-body">
                  <h5 class="card-title">Dream Thaï Bungalow</h5>
                  <h6 class="card-title">Thaïlande</h6>
                  <p class="card-text">2 000 m2</p>
                  <p class="card-text">595 309€</p>
                  <button type="button" class="btn btn-info"><a href="fiche_produit3.php">Voir</a></button>
                </div>
            </article>
          </div>
        </section>
<!-----------Section_expliquant_pourquoi_il_faut_choisir_Paradise-------------------------------------------------------------------------------------------------->
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

