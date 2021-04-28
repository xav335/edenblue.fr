<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
require_once 'admin/classes/News.php';
$news = new News();
$result = $news->newsGetOffset(0, 2);
//print_r($result);
?>
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue Construction piscine et spas Bordeaux piscine à debordement
	Gironde  piscine naturelle Dordogne couloir de nage Cezac
	piscine béton</title>
  </head>
<body>

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" data-role="introduction">
       <div class="large-12 medium-12 small-12 cell">
        <h1 data-animation="top">Constructeur de piscine</h1>
        <p data-animation="top">
          <strong>Eden Blue</strong>, constructeur de piscine en béton armé monobloc, en Aquitaine.<br>
          Nous intervenons dans toute la Gironde (Bassin d’Arcachon, Bordeaux, Libourne,  Blaye, Médoc…) et dans les départements limitrophes (Dordogne, Charente, Landes et Lot et Garonne)
        </p>
      </div>
    </section>

   

    <section class="grid-x grid-padding-x" data-role="partenaire-reconnu">
       <div class="large-12 medium-12 small-12 cell text-center">
        <h2 data-animation="top">Un partenaire reconnu</h2>
       </div>
      <div class="large-8 medium-8 small-12 cell text-center">
        <p data-animation="top">
          La société <strong>Eden Blue</strong> est un partenaire privilégié du groupe Leader Pool professionnel de la piscine
           en béton armé depuis plus de 18 ans et avec plus de 10000 réalisations au niveau national et Européen.<br>
          <strong>Eden Blue</strong> est une marque déposée depuis 2004 et utilise le procédé 
          <a href="https://www.leaderpool.fr/" target="_blank">Leader&nbsp;Pool</a> unique, breveté et
           agréé SOCOTEC pour la construction des piscines haut de gamme s’intégrant parfaitement à leur environnement.
        </p>
        <p data-animation="top">
            Notre équipe s’appuie sur 20 années d’expériences pour vous proposer le projet qui correspond à vos attentes. <br>
            Nous utilisons deux types de revêtements qui vous offre la possibilité de créer tous les effets et toutes les 
            ambiances que vous aurez imaginez.<br>
            Des piscines de caractère, contemporaine, miroir, à débordement, naturelles, traditionnelle ...
        </p>
            
             <?php if ( !empty( $resultinc ) ) :?>
             <ul data-animation="top">
                <?php foreach ( $resultinc as $value ) :  ?>
                <li><a href="nos-realisations-detail.php?id=<?php echo $value['id']?>"><b><?php echo $value['label']?></b></a></li>
                <?php endforeach;?>
             </ul>   
             <?php endif;?> 
            
        
        <p data-animation="top">    
            Eden Blue, professionnel de la piscine en béton armé monobloc, en Aquitaine. Nous intervenons dans toute la Gironde 
            (Bassin d'Arcachon, Bordeaux, Libourne,  Blaye, Médoc...) et dans les départements limitrophes (Dordogne, Charente, 
            Landes et Lot et Garonne<br><br>
        </p>   
        
     </div>
     <div class="large-4 medium-4 small-12 cell text-center">
        <div class="flex-video">
            <iframe src="https://www.youtube.com/embed/6sZ3WyH7DTk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <br/>
        <p>Construction d'une piscine en béton armé monobloc avec le procédé leaderpool</p>
     </div>
     
     <div class="large-12 medium-12 small-12 cell text-center">
            <h2>Notre engagement : </h2>
            
            <ul data-animation="top">
              <li>Etude personnalisée et réactivité.</li>
              <li>Accompagnement tout au long du processus, de la conception à la réception de votre projet.</li>
              <li>Charte/suivi qualité : contrôle qualité et procès verbaux à toutes les étapes de réalisation.</li>
              <li>Constructions dans les règles de l’art.</li>
              <li>SAV de qualité.</li>
            </ul>
      </div>
       
      <div class="large-12 medium-12 small-12 cell ">
        <div class="grid-x grid-padding-x " role="">
                <div class="large-3 medium-3 small-3 cell" >
                    &nbsp;
                </div>
                <div class="large-2 medium-2 small-2 cell" >
                    <img src="assets/img/techniques-de-construction/decenale.png" alt="techniques de construction Edenblue">
                </div>
                <div class="large-2 medium-2 small-2 cell" >
                    <img src="assets/img/techniques-de-construction/socotec.png"  alt="techniques de construction Edenblue">
                </div>
                <div class="large-2 medium-2 small-2 cell" >
                    <img src="assets/img/techniques-de-construction/madefrance.png"  alt="techniques de construction Edenblue">
                </div>
                <div class="large-3 medium-3 small-3 cell" >
                    &nbsp;
                </div>
           </div>    
       </div>
    </section>
           
    
  <?php if ( !empty( $result ) ) :    
        $i=0;?>  
    <section class="grid-x grid-padding-x" data-role="actualites">
        <div class="large-12 medium-12 small-12 cell">
            <h2 data-animation="top">Nouvelles fraiches</h2>
        <div>
          <?php foreach ( $result as $value ) :  
                $i++;?>
          <figure data-animation="right">
             <?php if ( !empty( $value['image1'] ) ) :    ?>
                <img src="photos/news<?php echo $value['image1']?>" alt="piscine intérieure">
             <?php else :?>
                 <img src="assets/img/piscine-interieure.jpg" alt="piscine intérieure">
             <?php endif;?>   
            <input type="checkbox" name="actu" id="actu-<?php echo $i ?>">
            <figcaption>
              <label for="actu-<?php echo $i ?>">+</label>
              <div>
                <b><?php echo nl2br($value['titre'])?></b><br>
                <?php echo nl2br($value['contenu'])?><br>
                <a href="<?php echo $value['accroche']?>" target="_blank">Lire la suite</a>
              </div>
            </figcaption>
          </figure>
          <?php endforeach;?>
          
        </div>
      </div>
       <div class="large-12 medium-12 small-12 cell"><a href="actualite.php" class="button">+ d’actualités</a></div>
    </section>
  <?php endif;?>  

  
  <section class="grid-x grid-padding-x" role="">
		<div class="large-4 medium-12 small-12 cell" text-center>&nbsp;</div>
		<div class="large-4 medium-12 small-12 cell" text-center>
			<a href="https://www.propiscines.fr/eden-blue-peujard" target="blank"><img src="assets/img/trophe.jpg" alt="trophe de la piscine or et spa 2020 edenblue.fr"></a>
		</div>
		<div class="large-4 medium-12 small-12 cell" text-center>&nbsp;</div>
	</section>
  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
