<?php
include 'config/template/head.php';
?>
        </header>
<!-----------Hero_image_du_produit-------------------------------------------------------------------------------------------------->
        <section id="hero-produit1" class="hero-produit">
          <h2>Isla Paloma</h2>
          <a class="arrow" href="#images-produit1"><img src="../paradise/asset/img/down-arrow.svg"></a>
        </section>
<!-----------Informations_sur_le_produit-------------------------------------------------------------------------------------------------->
          <div class="content-produit">
          <!-----------Images_du_produit-------------------------------------------------------------------------------------------------->
            <section class="images-produit" id="images-produit1">
              <div class="card-deck">
                <div class="card">
                  <div>
                    <img class="card-img" src="../paradise/asset/img_produit/isla-paloma-img1.jpg">
                  </div>
                </div>
                <div class="card">
                  <div>
                    <img class="card-img" src="../paradise/asset/img_produit/isla-paloma-img2.jpg">
                  </div>
                </div>
                <div class="card">
                  <div>
                    <img class="card-img" src="../paradise/asset/img_produit/isla-paloma-img3.jpg">
                  </div>
                </div>
              </div>
            </section>
            <!-----------Citations_sur_le_voyage-------------------------------------------------------------------------------------------------->
            <section>
              <blockquote> “Le bonheur n’est pas une destination à atteindre, mais une façon de voyager”</blockquote>
            </section>
            <section class="bottom-content">
              <!-----------Description_du_produit-------------------------------------------------------------------------------------------------->
              <div class="description">
                <h4>Description du produit</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac ipsum sit amet dolor volutpat fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec viverra ante in sodales rhoncus. Cras enim est, malesuada id lectus gravida, tempus posuere diam. </p>
              </div>
              <!-----------Quantité_du_produit-------------------------------------------------------------------------------------------------->
              <div class="add-panier">
                <p>Il reste 5 parcelles en stock</p>
                <input type="number" class="quantity-article" name="" id="ExampleQuantity" placeholder="Entrez la quantité souhaité">
                <!-----------Prix_produit-------------------------------------------------------------------------------------------------->
                <p class="price">295 812€</p>
                <button class="btn-panier">Ajouter au panier</button>
              </div>
            </section>
          </div>
<?php include 'config/template/footer.php'; ?>