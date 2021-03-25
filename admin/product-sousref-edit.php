<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php include_once 'classes/pagination.php';?>
<?php 
require 'classes/Catproduct.php';

	
	try {
		
		$catproduct = new Catproduct();
		
		if(!empty($_GET['id_sousref'])){
			$action = 'modif';
			$resultsouref = $catproduct->productsousrefGet($_GET['id'],$_GET['id_sousref']);
			$id_sousref = $resultsouref[0]['id'];
			$sousref = $resultsouref[0]['sousref'];
			$stock = $resultsouref[0]['stock'];
			$id_color = $resultsouref[0]['id_color'];
			$id_size = $resultsouref[0]['id_size'];
		} else {
			$action = 'add';
			$sousref = 	null;
			$stock = 	null;
			$id_color = null;
			$id_size = null;
			$id_sousref =null;
		}
		
		(!empty($_GET['rubrique'])) ? $rubrique = $_GET['rubrique'] : $rubrique = null;
		(!empty($_GET['categorie'])) ? $categorie = $_GET['categorie'] : $categorie = null;
	
		$result = $catproduct->productsousrefGet($_GET['id'],null);	
		
		
		$colorResult = $catproduct->getColors();
		$sizeResult = $catproduct->getSizes();
		//print_r($resultsouref);
		$catproduct =null;
	} catch (Exception $e) {
		echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
		$catproduct =null;
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
				<h3>Edition des Sous références du produit N°: <?php echo $_GET['id']?></h5>
				<a class="btn btn-success pull-right" href="/admin/product-list.php?rubrique=<?php echo $_GET['rubrique'] ?>&categorie=<?php echo $_GET['categorie'] ?>">Retour</a>
				<br><br>
			</div>
		</div>
		<div class="row bg-info">
				<br>
				<form name="formulaire" class="form-horizontal" method="POST"  action="product-fp.php" >
				<input type="hidden" name="reference" value="product-sousref">
				<input type="hidden" name="action" value="<?php echo $action ?>">
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
				<input type="hidden" name="id_souref" value="<?php echo $id_sousref?>">
				<input type="hidden" name="rubrique" id="rubrique" value="<?php echo $rubrique ?>">
				<input type="hidden" name="categorie" id="categorie" value="<?php echo $categorie ?>">
				
				<div class="col-md-3 ">	
					<label class="col-sm-6">Sous-ref:</label><input type="text" class="col-sm-6" name="sousref"  id="sousref" value="<?php echo $sousref?>">
				</div>
				<div class="col-md-2">	
					<b>Couleur</b>:	
					<select name="color" id="color">
					<?
					foreach ($colorResult as $value) { 
						?>
						<option value="<?php echo $value['id'] ?>"  <?php if ($value['id']==$id_color) echo 'selected' ;?>>
							<?php echo $value['label'] ?>
						</option>
						<?
					}
					?>
					</select>	
					<a href="product-color-edit.php?id_product=<?php echo $_GET['id'] ?>&rubrique=<?php echo $rubrique  ?>&categorie=<?php echo $categorie ?>"><img src="img/plus.png" width="15" alt="add" ></a>
				</div>	
				
				<div class="col-md-2">		
					<b>Taille</b>:	
					<select name="size" id="size">
					<?
					foreach ($sizeResult as $value) { 
						?>
						<option value="<?php echo $value['id'] ?>" <?php if ($value['id']==$id_size) echo 'selected' ;?>>
							<?php echo $value['label'] ?>
						</option>
						<?
					}
					?>
					</select>	
					<a href="product-size-edit.php?id_product=<?php echo $_GET['id'] ?>&rubrique=<?php echo $rubrique  ?>&categorie=<?php echo $categorie ?>"><img src="img/plus.png" width="15" alt="add" ></a>
				</div>	
				<div class="col-md-2">	
					<label class="col-sm-6">Stock:</label><input type="number" step="1" class="col-sm-6" name="stock" required id="stock" value="<?php echo $stock?>">
				</div>
				<div class="col-md-3">		
					<button class="btn btn-success col-sm-3" type="submit" ><?php echo $action?></button>
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
								Sous ref
							</th>
							<th class="col-md-2" style="">
								couleur
							</th>
							<th class="col-md-1" style="">
								Taille
							</th>
							
							<th class="col-md-1" style="">
								Stock
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
								<td><?php echo $value['sousref']?></td>
								<td><?php echo $value['color'] ?></td>
								<td><?php echo $value['size']?></td>
								<td><?php echo $value['stock']?></td>
								<td>
									<a href="product-sousref-edit.php?id=<?php echo $_GET['id'] ?>&id_sousref=<?php echo $value['id'] ?>&rubrique=<?php echo $_GET['rubrique']  ?>&categorie=<?php echo $_GET['categorie'] ?>"><img src="img/modif.png" width="30" alt="Modifier" ></a>
									<div style="display: none;" class="supp<?php echo $value['id']?> alert alert-warning alert-dismissible fade in" role="alert">
								      <button type="button" class="close"  aria-label="Close" onclick="$('.supp<?php echo $value['id']?>').css('display', 'none');"><span aria-hidden="true">×</span></button>
								      <strong>Voulez vous vraiment supprimer ?</strong>
								      <button type="button" class="btn btn-danger" onclick="location.href='product-fp.php?reference=product-sousref&action=delete&id=<?php echo $_GET['id'] ?>&id_sousref=<?php echo $value['id'] ?>&rubrique=<?php echo $rubrique  ?>&categorie=<?php echo $categorie ?>'">Oui !</button>
								 	</div>
								<img src="img/del.png" width="20" alt="Supprimer" onclick="$('.supp<?php echo $value['id']?>').css('display', 'block');"> </td>
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


