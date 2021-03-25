<?php
include 'config/template/head.php';
?>
        </header>
<!-----------Hero_image_du_produit-------------------------------------------------------------------------------------------------->
        <section id="hero-produit1" class="hero-produit d-flex flex-column justify-content-center align-items-center" aria-label="hero image de la fiche produit">
          <h2 class="text-center">Isla Paloma</h2>
          <a class="arrow my-0 mx-auto" href="#images-produit1"><img src="../paradise/asset/img/down-arrow.svg" alt="ancre vers les images mini de la fiche produit"></a>
        </section>
<!-----------Informations_sur_le_produit-------------------------------------------------------------------------------------------------->
          <div class="content-produit d-flex flex-column  flex-wrap m-auto" aria-label="div qui contient tout le contenu après le footer">
          <!-----------Images_du_produit-------------------------------------------------------------------------------------------------->
            <section class="images-produit d-flex flex-row justify-content-center flex-wrap my-5 mx-auto" id="images-produit1" aria-label="images miniatures du produit sous différents angles">
              <div class="card-deck">
                <article class="card">
                  <div>
                    <img class="card-img" src="../paradise/asset/img_produit/isla-paloma-img1.webp" alt="bateau sur une plage paradisiaque">
                  </div>
                </article>
                <article class="card">
                  <div>
                    <img class="card-img" src="../paradise/asset/img_produit/isla-paloma-img2.webp" alt="ponton bois avec vue sur la mer">
                  </div>
                </article>
                <article class="card">
                  <div>
                    <img class="card-img" src="../paradise/asset/img_produit/isla-paloma-img3.webp" alt="plage avec de la verdure">
                  </div>
                </article>
              </div>
            </section>
            <!-----------Citations_sur_le_voyage-------------------------------------------------------------------------------------------------->
            <aside>
              <blockquote class="my-5 mx-auto"> “Le bonheur n’est pas une destination à atteindre, mais une façon de voyager”</blockquote>
            </aside>
            <section class="bottom-content d-flex flex-wrap justify-content-between my-5 mx-auto">
              <!-----------Description_du_produit-------------------------------------------------------------------------------------------------->
              <div class="description">
                <h4>Description du produit</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac ipsum sit amet dolor volutpat fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec viverra ante in sodales rhoncus. Cras enim est, malesuada id lectus gravida, tempus posuere diam. </p>
              </div>
              <!-----------Quantité_du_produit-------------------------------------------------------------------------------------------------->
              <div class="add-panier">
                <p>Il reste 5 parcelles en stock</p>
                <input type="number" class="quantity-article" name="quantity" id="ExampleQuantity" placeholder="Entrez la quantité souhaité">
                <!-----------Prix_produit-------------------------------------------------------------------------------------------------->
                <p class="price my-4 mx-0">295 812€</p>
                <button class="btn-panier border border-light" aria-label="bouton qui permet d'ajouter un produit au panier">Ajouter au panier</button>
              </div>
            </section>
          </div>
<?php include 'config/template/footer.php'; ?>