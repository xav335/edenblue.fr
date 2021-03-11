<?php //preg_match('#(?<=\/)[^\/]*(?=\.\w+$)#i', $_SERVER['REQUEST_URI'], $pagename); 
$pagename =  $_SERVER['REQUEST_URI'];

include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
require_once 'admin/classes/Catrealisation.php';

$catproduct2 = new Catrealisation();
$resultinc = $catproduct2->catrealisationGetParent();
//print_r($result);

?>
<div class="top">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <div class="large-6 medium-6 small-12 cell">
<!--           <a href="./"><img src="assets/img/logo-eden-blue.png" alt="logo Eden Blue" title="Eden Blue" data-animation="right"></a> -->
          <a href="./"><img src="assets/img/logo-eden-blue.png" alt="logo Eden Blue" title="Eden Blue" ></a>
        </div>
        <div class="large-6 medium-6 small-12 cell">
<!--           <div data-animation="left"><a href="tel:+33533880011">05 33 88 00 11</a> <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a></div> -->
           <div ><a href="tel:+33533880011">05 33 88 00 11</a> <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a></div>
        </div>
      </div>
    </div>
  </div>
  <header>
    <label for="menu">
      <span></span><span></span><span></span>
    </label>
    <input type="checkbox" name="menu" id="menu">
     <nav>
          <ul>
            <li>
                <a href="nos-realisations.php" <?php if (strpos($pagename,'nos-realisations')!==false) :?>class="active"<?php endif; ?>>Nos réalisations</a>
                <ul>
                 <?php if ( !empty( $resultinc ) ) :?>
                    <?php foreach ( $resultinc as $value ) :  ?>
                    <li><a href="nos-realisations-detail.php?id=<?php echo $value['id']?>"><?php echo $value['label']?></a></li>
                    <?php endforeach;?>
                 <?php endif;?> 
                </ul>
            </li>
            <li><a href="spa.php" <?php if (strpos($pagename,'spa')!==false) :?>class="active"<?php endif; ?>>Spas</a>
            <ul>
                <li><a href="spa-serie-club.php">Série Club</a></li>
                <li><a href="spa-serie-privilege.php">Série Privilèges</a></li>
                <li><a href="spa-serie-sensation.php">Série Sensations</a></li>
                <li><a href="spa-serie-sport.php">Série Sport</a></li>
            </ul>
            </li>
            <li><a href="amenagements-exterieurs.php" <?php if (strpos($pagename,'amenagements-exterieurs')!==false):?>class="active"<?php endif; ?>>Aménagements extérieurs</a>
            <ul>
                <li><a href="amenagements-exterieurs.php#paysage">Aménagements paysagès</a></li>
                <li><a href="amenagements-exterieurs.php#poolhouse">Pool House</a></li>
            </ul>
            </li>
             <li><a href="equipements.php" <?php if (strpos($pagename,'equipements')!==false):?>class="active"<?php endif; ?>>Equipements</a>
            <ul>
                <li><a href="equipements.php#">Traitement de l'eau</a></li>
                <li><a href="equipements.php#">Chauffage</a></li>
                <li><a href="equipements.php#">Nettoyage automatique</a></li>
                <li><a href="equipements.php#">Domotique</a></li>
                <li><a href="equipements.php#">Sécurité</a></li>
            </ul>
            </li>
            <li><a href="techniques-de-construction.php" <?php if (strpos($pagename,'techniques-de-construction')!==false):?>class="active"<?php endif; ?>>Techniques de construction</a>
            <ul>
                <li><a href="techniques-de-construction.php#procedes">Procédés</a></li>
                <li><a href="techniques-de-construction.php#revetements">Revètements</a></li>
                <li><a href="techniques-de-construction.php#abords">Abords</a></li>
            </ul>
            </li>
            <li><a href="livre-d-or.php" <?php if (strpos($pagename,'livre-d-or')!==false):?>class="active"<?php endif; ?>>Livre d'or</a></li>
            <li><a href="actualite.php" <?php if (strpos($pagename,'actualite')!==false):?>class="active"<?php endif; ?>>Actualité</a>
                <ul>
                <li><a href="actualite.php#tutos">Tutoriels - SAV</a></li>
            </ul>
            </li>
            <li><a href="contact.php" <?php if (strpos($pagename,'contact')!==false):?>class="active"<?php endif; ?>>Contact</a></li>
          </ul>
        </nav>
       
     <?php if (strpos($pagename,'spa')!==false ):  //Univer spa ?>
    
       
        <div class="slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <div style="background-image:url('assets/img/spa-1.jpg');" class="masked-element"></div>
                <img src="assets/img/spa-1.jpg" alt="">
                <p>Le Spa sans limite</p>
                </div>
                <div class="swiper-slide">
                <div style="background-image:url('assets/img/spa-2.jpg');" class="masked-element"></div>
                <img src="assets/img/spa-2.jpg" alt="">
                <p>Le Spa sans limite</p>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        
    <?php else :  //Univer piscine  ?>
        
    
        <div class="slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <div style="background-image:url('assets/img/slider-1.jpg');" class="masked-element"></div>
                <img src="assets/img/slider-1.jpg" alt="">
                <p>La piscine sans limite</p>
                </div>
                <div class="swiper-slide">
                <div style="background-image:url('assets/img/slider-2.jpg');" class="masked-element"></div>
                <img src="assets/img/slider-2.jpg" alt="">
                <p>La piscine sans limite</p>
                </div>
                <div class="swiper-slide">
                <div style="background-image:url('assets/img/slider-3.jpg');" class="masked-element"></div>
                <img src="assets/img/slider-3.jpg" alt="">
                <p>La piscine sans limite</p>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            </div>
            
    <?php endif; ?>
    
  </header>