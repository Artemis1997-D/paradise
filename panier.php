<?php 
include 'config/template/head.php'; 
?>
        </header>
        <section class="content">
          <h2 class="text-center mt-5 mb-5">Mes commandes</h2>
            <!-----------Liste_articles_dans_le_panier-------------------------------------------------------------------------------------------------->
            <div class="panier">
              <div class="article">
                <img class="image-panier" src="asset\img_produit\isla-paloma-img1.jpg" alt="isla-paloma" >
                <p class="detail">Isla Paloma<br>Panama<br>295 812€</p>
                <a href="#">Supprimer</a>
              </div>
            <hr class="divider">
              <div class="article">
                <img class="image-panier" src="asset\img_produit\sand-point-road-beach.jpg" alt="bungalow" >
                <p class="detail">Isla Paloma<br>Panama<br>295 812€</p>
                <a href="#">Supprimer</a>
              </div>
            </div>
            <hr class="divider">
              <div class="total">
                <p>Total</p>
                <p>3 967 989€</p>
              </div>
        </section>
        <hr>
<?php include 'config/template/footer.php'; ?>

