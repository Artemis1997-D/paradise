<?php 
include 'config/template/head.php'; 
?>
        </header>
        <section class="content">
          <h2 class="text-center mt-5 mb-5">Mes commandes</h2>
            <!-----------Liste_articles_dans_le_panier-------------------------------------------------------------------------------------------------->
            <article class="panier d-flex flex-column">
              <div class="article d-flex flex-row m-auto">
                <img class="image-panier mr-2" src="asset/img_produit/isla-paloma-img1.webp" alt="Isla-Paloma" >
                <p class="detail d-flex flex-row align-items-start">Isla Paloma<br>Panama<br>295 812€</p>
                <a href="#">Supprimer</a>
              </article>
            <hr class="divider">
              <article class="article d-flex flex-row m-auto">
                <img class="image-panier mr-2" src="asset/img_produit/sand-point-road-beach.webp" alt="Bungalow" >
                <p class="detail d-flex flex-row align-items-start">Isla Paloma<br>Panama<br>295 812€</p>
                <a href="#">Supprimer</a>
              </article>
            </div>
            <hr class="divider">
              <div class="total d-flex flex-row">
                <p>Total</p>
                <p>3 967 989€</p>
              </div>
        </section>
<?php include 'config/template/footer.php'; ?>

