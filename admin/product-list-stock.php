<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php include_once 'classes/pagination.php';?>
<?php 
require 'classes/Catproduct.php';

    
    (!empty($_GET['stock'])) ? $stock = $_GET['stock'] : $stock = 0;
	try {
		$catproduct = new Catproduct();
		
		$result = $catproduct->productsousrefGetByStock($stock);
		//print_r($result);exit;
		$catproduct = null;
	} catch (Exception $e) {
		echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
		$catproduct = null;
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
				<form name="formulaire" class="form-horizontal" method="GET"  action="product-list-stock.php" >
				<div class="col-md-3">	
					<label>Indiquez le stock des sous réferences:</label>
				</div>
				<div class="col-md-2">		
					 <input type="number" step="1" name="stock" required value="<?php echo $stock?>">
				</div>	
				
				<div class="col-md-3">		
					<button class="btn btn-success col-sm-3" type="submit" >valider</button>
				</div>
				<br><br>
		</div>			
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">

				<table class="table table-hover table-bordered table-condensed table-striped" >
					<thead>
						<tr>
							
							<th class="col-md-4" style="">
								Sous Ref
							</th>
							<th class="col-md-3" style="">
								Nom Produit
							</th>
							<th class="col-md-1" style="">
								Stock
							</th>
							<th class="col-md-1" style="">
								size
							</th>
							<th class="col-md-1" style="">
								color
							</th>
							
							
						</tr>
					</thead>
					<tbody>
						<?php 
						if (!empty($result)) {
							$i=0;
							foreach ($result as $value) { 
							
							?>
							<tr>
								
								<td><?php echo $value['label'] ?></td>
								<td><?php echo $value['sousref']?></td>
								<td><?php echo $value['stock']?></td>
								<td><?php echo $value['size']?></td>
								<td><?php echo $value['color']?></td>
								
								<td>
									<a href="product-edit.php?id=<?php echo $value['id_product'] ?>&rubrique=&categorie="><img src="img/modif.png" width="30" alt="Modifier" ></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
								
									<a href="product-sousref-edit.php?id=<?php echo $value['id_product'] ?>&rubrique=&categorie="><img src="img/sr.png" width="30" alt="Modifier" ></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									
								</td>
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


