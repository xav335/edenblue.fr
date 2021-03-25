<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php include_once 'classes/pagination.php';?>
<?php 
require 'classes/Catproduct.php';

	
	try {
		
		$catproduct = new Catproduct();
		
		if(!empty($_GET['id_product'])){
			$sousref = 	null;
			$stock = 	null;
			$id_color = null;
			$id_size = null;
			$id_product = $_GET['id_product'];
			
		}else{
		    $id_product = null;
		}
		(!empty($_GET['rubrique'])) ? $rubrique = $_GET['rubrique'] : $rubrique = null;
		(!empty($_GET['categorie'])) ? $categorie = $_GET['categorie'] : $categorie = null;
		
		
	
		$result = $catproduct->getColors();
		
		
		//print_r($resultsouref);
		$catproduct =null;
	} catch (Exception $e) {
		echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
		exit();
	}	
	
	if (empty($result)) {
		$message = 'Aucun enregistrements';
	} else {
		$message = '';
	}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<?php include_once 'inc-meta.php';?>
</head>
<body>	
	<?php require_once 'inc-menu.php';?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<h3>Edition des couleur de produits</h5>
				<?php if(!empty($_GET['id_product'])){?>
				<a class="btn btn-success pull-right" href="/admin/product-sousref-edit.php?id=<?php echo $_GET['id_product'] ?>&rubrique=<?php echo $_GET['rubrique']  ?>&categorie=<?php echo $_GET['categorie'] ?>">Retour produit</a>
				<?php } ?>
				<br><br>
			</div>
		</div>
		<div class="row bg-info">
				<br>
				<form name="formulaire" class="form-horizontal" method="POST"  action="product-fp.php" >
				<input type="hidden" name="reference" value="product-color">
				<input type="hidden" name="action" value="add">
				<input type="hidden" name="id_product" value="<?php echo $id_product ?>">
				<input type="hidden" name="rubrique" id="rubrique" value="<?php echo $rubrique ?>">
				<input type="hidden" name="categorie" id="categorie" value="<?php echo $categorie ?>">
				
				<div class="col-md-5 ">	
					<label class="col-sm-6">Couleur produit:</label><input type="text" class="col-sm-6" name="label"  id="label" value="">
				</div>
				
				<div class="col-md-3">		
					<button class="btn btn-success col-sm-3" type="submit" >Ajouter</button>
				</div>
				</form>
				<br><br>
		</div>	
		<hr width="100%">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">

				<table class="table table-hover table-bordered table-condensed table-striped" >
					<thead>
						<tr>
							
							
							<th class="col-md-1" style="">
								id
							</th>
							<th class="col-md-2" style="">
								couleur
							</th>
							<th class="col-md-1" colspan="2" style="">
								Actions
							</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						if (!empty($result)) {
							$i=0;
							foreach ($result as $value) { 
							$i++;
								//Catégries
								//print_r($value['categories']);
							?>
							<tr class="<?php if ($i%2!=0) echo 'info'?>">
								<td><?php echo $value['id']?></td>
								<td><?php echo $value['label'] ?></td>
								<?php  if(false) {?>
								<td>
									<div style="display: none;" class="supp<?php echo $value['id']?> alert alert-warning alert-dismissible fade in" role="alert">
								      <button type="button" class="close"  aria-label="Close" onclick="$('.supp<?php echo $value['id']?>').css('display', 'none');"><span aria-hidden="true">×</span></button>
								      <strong>Voulez vous vraiment supprimer ?</strong>
								      <button type="button" class="btn btn-danger" onclick="location.href='product-fp.php?reference=product-color&action=delete&id_product=<?php echo $id_product ?>&id=<?php echo $value['id'] ?>'">Oui !</button>
								 	</div>
									<img src="img/del.png" width="20" alt="Supprimer" onclick="$('.supp<?php echo $value['id']?>').css('display', 'block');"> 
								</td>
								<?php } ?>
							</tr>
							<?php } ?>
						<?php } ?>	
					</tbody>
				</table>

				<h3><?php echo $message?></h3>
			</div>
		</div>
	</div>
</body>
</html>


