<?php preg_match('#(?<=\/)[^\/]*(?=\.\w+$)#i', $_SERVER['REQUEST_URI'], $pagename); ?>
<div class="top">
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <div class="large-6 medium-6 small-12 cell">
          <a href="./"><img src="assets/img/logo-eden-blue.png" alt="logo Eden Blue" title="Eden Blue" data-animation="right"></a>
        </div>
        <div class="large-6 medium-6 small-12 cell">
          <div data-animation="left"><a href="tel:+33533880011">05 33 88 00 11</a> <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a></div>
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
            <a href="nos-realisations.php" <?php if(!empty($pagename) && $pagename[0] == 'nos-realisations') :?>class="active"<?php endif; ?>>Nos réalisations</a>
            <ul>
                <li><a href="nos-realisations-piscine-contemporaine.php">Piscine contemporaine</a></li>
                <li><a href="#">Piscine natuelle</a></li>
                <li><a href="#">Piscine à débordement</a></li>
                <li><a href="#">Piscine miroir</a></li>
                <li><a href="#">Piscine intérieure</a></li>
            </ul>
        </li>
        <li><a href="spa.php" <?php if(!empty($pagename) && $pagename[0] == 'spa') :?>class="active"<?php endif; ?>>Spas</a></li>
        <li><a href="" <?php if(!empty($pagename) && $pagename[0] == 'amenagements-exterieurs') :?>class="active"<?php endif; ?>>Aménagements extérieurs</a></li>
        <li><a href="" <?php if(!empty($pagename) && $pagename[0] == 'equipements-techniques-de-construction') :?>class="active"<?php endif; ?>>Équipements Techniques de construction</a></li>
        <li><a href="" <?php if(!empty($pagename) && $pagename[0] == 'actualite') :?>class="active"<?php endif; ?>>Actualité</a></li>
        <li><a href="" <?php if(!empty($pagename) && $pagename[0] == 'contact') :?>class="active"<?php endif; ?>>Contact</a></li>
      </ul>
    </nav>

    <?php if (!empty($pagename) && $pagename[0]=='spa') :?>

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
        
    <?php else :  ?>
    
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