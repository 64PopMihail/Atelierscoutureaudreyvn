<?php
require '../admin/config/config.php';
$title = "Page d'accueil";
require '../include/head.php';
require '../include/nav.php';
?>
    <div class="prez">
        <h1> Bienvenu(e) aux ateliers couture d'Audrey</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus commodi accusantium minus velit totam sint architecto, 
            deleniti libero animi quo incidunt hic laborum inventore iure quae dolor dolores, corrupti error!</p>
    </div>    
    <main>
        <div class="contenu">
            <section class="macard">
                <a href="<?= URL?>pages/blog.php">
                    <div class="macard-title">
                        <h2 class="card-title">Les derniers articles</span>
                    </div>
                </a>
                <div class="macard-body">
                    <div class="inner">
                        <div class="vignette">
                            <img src="../img/237-536x354.jpg" alt="img-article">
                            <div class="article-description">
                                <span class="titre-article">Lorem</span>
                                <span class="date-article">15/03/21</span>
                            </div>
                        </div>
                        <div class="vignette">
                            <img src="../img/866-536x354.jpg" alt="img-article">
                            <div class="article-description">
                                <span class="titre-article">Lorem</span>
                                <span class="date-article">15/03/21</span>
                            </div>
                        </div>
                        <div class="vignette">
                            <img src="../img/1060-536x354-blur_2.jpg" alt="img-article">
                            <div class="article-description">
                                <span class="titre-article">Lorem</span>
                                <span class="date-article">15/03/21</span>
                            </div>
                        </div>
                        <div class="vignette">
                            <img src="../img/1084-536x354-grayscale.jpg" alt="img-article">
                            <div class="article-description">
                                <span class="titre-article">Lorem</span>
                                <span class="date-article">15/03/21</span>
                            </div>
                        </div>
                        <div class="vignette">
                            <img src="../img/870-536x354-blur_2-grayscale.jpg" alt="img-article">
                            <div class="article-description">
                                <span class="titre-article">Lorem</span>
                                <span class="date-article">15/03/21</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="macard">
                <a href="<?= URL ?>pages/creations.php">
                    <div class="macard-title">
                        <h2 class="card-title">Les dernières créations</span>
                    </div>
                </a>
                <div class="macard-body">
                    <div class="sliderSlick">
                        <div class="sliderElement">
                            <img src="../img/pexels-mikhail-nilov-6945064.jpg" alt="img_article">
                        </div>
                        <div class="sliderElement">
                            <img src="../img/pexels-photo-4040646.jpeg" alt="img_article">
                        </div>
                        <div class="sliderElement">
                            <img src="../img/pexels-photo-6479573.jpeg" alt="img_article">
                        </div>
                    </div>
                  
                </div>
            </section>
            <section class="macard">
                <a href="<?= URL ?>pages/ateliers.php">
                    <div class="macard-title">
                        <h2 class="card-title">Les ateliers disponibles</h2>
                    </div>
                </a>
                <div class="macard-body">
                    <div class="inner" id= "inner_ateliers">
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                        <div class="miniVignette">
                            <span class="atelier">Atelier du 12/03/21</span>
                            <span class="date_atelier">12 places</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
<?php 
require '../include/footer.php';
require '../include/bottom.php';
?>    
 