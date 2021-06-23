<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
require_once 'admin/classes/Cattutos.php';
$stuff = new Cattutos();
$result = $stuff->stuffGetByParentId($online=1);
if (!empty($result)) {
    $i=0;
    foreach ($result as $value){
        $recherche[ "num_parent" ] = $value[ "id" ];
        $liste_image = $stuff->getImagesListe( $recherche);
        $result[$i]["lstimages"] =  $liste_image;
        $i++;
    }
   
}

?>
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue -  Tutos - SAV</title>
  </head>
<body class="not-home">

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" role="">
      <div class="large-12 medium-12 small-12 cell" text-center>
        <h1>Tutoriels - Assistance</h1>
      </div>
      <div class="large-12 medium-12 small-12 cell" text-center>
        <hr>
      </div>
       <?php if ( !empty( $result ) ) :    
        $i=0;?>  
             <?php foreach ( $result as $value ) :  
                $i++;?>
                <div class="large-12 medium-12 small-12 cell" id="procedes">
                     <h2 class="sous-titre2"> <?php echo nl2br($value['titre'])?></h2>
                </div>
                <div class="large-6 medium-6 small-12 cell" id="procedes">
                     
                     <?php if( !empty( $value['lstimages'] )) : ?>
                         <div class="slider2 swiper-container">
                         <div class="swiper-wrapper">
                        <?php foreach ( $value['lstimages'] as $val ) : ?>
                            <div class="swiper-slide">
                                  <a data-fancybox="tutos<?php echo $value['id']?>" href="photos/cattutos<?php echo $val["fichier"]?>">
                                <img src="photos/cattutos<?php echo $val["fichier"]?>" alt="tutos Edenblue"></a>
                            </div>
                         <?php endforeach;?>  
                         </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination "></div>
                        </div>  
                        
                        <br><br>     
                     <?php endif;?> 
                     
                  
                     
                     <?php if( !empty( $value['video'] )) :?>
                        <div class="flex-video">
                            <?php echo $value['video']?>
                        </div>  
                     <?php endif;?>
                     
                      
                          
              </div>
              <div class="large-6 medium-6 small-12 cell" id="procedes">
                  <p data-animation="top">
                     <?php echo nl2br($value['contenu'])?>
                  </p>
                   
                   <br><br>
                   
                   <?php if( !empty( $value['accroche'] )) :?>
                   <p class="text-center"> <a href="<?php echo $value['accroche']?>" target="_blank"><b>En savoir +</b></a>  </p>
                   <?php endif;?> 
                   
                   <br><br>  
                   
                    <?php if( !empty( $value['fichier_pdf'] )) :?>
                     <p class="text-center"><br><br>
                        <a href="photos/cattutos/pdf<?php echo $value['fichier_pdf']?>" target="_blank"><img src="assets/pdf/telecharger.jpg" alt=" Edenblue"></a>
                                &nbsp;&nbsp;
                        <a href="photos/cattutos/pdf<?php echo $value['fichier_pdf']?>" target="_blank">Télécharger</a>
                     </p>   
                    <?php endif;?> 
                  
              </div>
      
              <div class="large-12 medium-12 small-12 cell" text-center>
                <hr>
              </div>
        <?php endforeach;?>
      
   <?php endif;?>  
								
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
