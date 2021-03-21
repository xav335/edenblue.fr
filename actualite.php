<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
require_once 'admin/classes/News.php';
$news = new News();
$result = $news->newsGet(null);
//print_r($result);
?>
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue -  Actualités - Evènements</title>
  </head>
<body class="not-home">

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" role="">
      <div class="large-12 medium-12 small-12 cell" text-center>
        <h1>Actualités - Evènements</h1>
      </div>
       <?php if ( !empty( $result ) ) :    
        $i=0;?>  
             <?php foreach ( $result as $value ) :  
                $i++;?>
                <div class="large-6 medium-6 small-12 cell" id="procedes">
                     <h2 class="sous-titre"> <?php echo nl2br($value['titre'])?></h2>
                    <p data-animation="top">
                            <?php echo nl2br($value['contenu'])?>
                         </p>
                             <a data-fancybox="spa1" href="photos/news<?php echo $value['image1']?>"><br>
                                <img src="photos/news<?php echo $value['image1']?>" alt="amenagements-exterieurs Edenblue">
                            </a>  
                   <br><br>
              </div>
             
      
            <?php if ($i%2==0) :?>
              <div class="large-12 medium-12 small-12 cell" text-center>
                <hr>
              </div>
             <?php endif;?> 
        <?php endforeach;?>
      
   <?php endif;?>  
								
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
