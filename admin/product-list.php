<?
	include_once '../inc/inc.config.php';
	include_once 'inc-auth-granted.php';
	include_once 'classes/utils.php';
	include_once 'classes/pagination.php';
	require 'classes/Catproduct.php';
	
	if (empty($_GET[ "actif" ])) {
	    $actif=1; 
	} else {
	    $actif=0;
	}

	if (!empty($_POST[ "rubrique" ])){
		$rub = $_POST[ "rubrique" ];
	} else {
		if (!empty($_GET[ "rubrique" ])){
			$rub = $_GET[ "rubrique" ];
		} else {
			$rub = null;
		}
	}

	if (!empty($_POST[ "categorie" ])){
		$categ = $_POST[ "categorie" ];
	} else {
		if (!empty($_GET[ "categorie" ])){
			$categ = $_GET[ "categorie" ];
		} else {
			$categ = null;
		}
	}
	//print_r($categ);
	
	try {
		$catproduct = new Catproduct();
		
		//echo "--- categ : " . $categ . "<br>";
		//echo "--- rub : " . $rub . "<br>";
		//echo "--- actif : " . $actif . "<br>";
		$total = $catproduct->productNumberGet( $categ, $rub, $actif, false );
		//$result = $contact->contactGet(null, $offset, $count);
		
		$epp = 15; // nombre d'entrées à afficher par page (entries per page)
		$nbPages = ceil($total/$epp); // calcul du nombre de pages $nbPages (on arrondit à l'entier supérieur avec la fonction ceil())
		 
		// Récupération du numéro de la page courante depuis l'URL avec la méthode GET
		// S'il s'agit d'un nombre on traite, sinon on garde la valeur par défaut : 1
		$current = 1;
		if (isset($_GET[ "p" ]) && is_numeric($_GET[ "p" ])) {
			$page = intval($_GET[ "p" ]);
			if ($page >= 1 && $page <= $nbPages) {
				// cas normal
				$current=$page;
			} else if ($page < 1) {
				// cas où le numéro de page est inférieure 1 : on affecte 1 à la page courante
				$current=1;
			} else {
				//cas où le numéro de page est supérieur au nombre total de pages : on affecte le numéro de la dernière page à la page courante
				$current = $nbPages;
			}
		}
		
		// $start est la valeur de départ du LIMIT dans notre requête SQL (dépend de la page courante)
		$start = ($current * $epp - $epp);
		
		// Récupération des données à afficher pour la page courante
		$result = $catproduct->productGet( null, $start, $epp, $categ, $rub, $actif, false );
		
		$catproduct->catproduitViewIterative(null);
		$catresult = $catproduct->tabView;
		
		$rubresult = $catproduct->getRubriques();
		//print_r($result);
		$catproduct =null;
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
			<div class="col-xs-12 col-sm-12 col-md-12">
				<?php echo paginate('product-list.php?rubrique='.$rub.'&categorie='.$categ , '&p=', $nbPages, $current); ?>
				<br><br>
			</div>
		</div>
		<div class="row">
				<form name="formulaire" class="form-horizontal" method="GET"  action="product-list.php" >
				<div class="col-md-2">	
					<label  >&nbsp;Filtrez par catégorie :</label>
				</div>
				<div class="col-md-2">		
					<select name="categorie" id="categorie">
					<option value="" selected>-- afficher tout --</option>
					<?
					foreach ($catresult as $value) { 
						$decalage = "";
						for ($i=0; $i<($value[ "level" ] * 5); $i++) {
							$decalage .= "&nbsp;";
						}
						?>
						<option value="<?php echo $value[ "id" ] ?>" <? if ( $categ ==  $value[ "id" ] ) { ?> selected <? } ?>>
							<?=$decalage?><?php echo $value[ "label" ] ?>
						</option>
						<?
					}
					?>
					</select>	
				</div>	
				<div class="col-md-2">	
					<label  >&nbsp;par rubrique :</label>
				</div>
				<div class="col-md-2">		
					<select name="rubrique" id="rubrique">
					<option value="" selected>-- afficher tout --</option>
					<?
					foreach ($rubresult as $value) { 
						?>
						<option value="<?php echo $value[ "id" ] ?>" <? if ( $rub ==  $value[ "id" ] ) { ?> selected <? } ?>>
							<?php echo $value[ "label" ] ?>
						</option>
						<?
					}
					?>
					</select>	
				</div>	
				<div class="col-md-3">		
					<button class="btn btn-success col-sm-3" type="submit" >Filtrer</button>
				</div>
				<br><br>
		</div>	
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">

				<table class="table table-hover table-bordered table-condensed table-striped" >
					<thead>
						<tr>
							
							<th class="col-md-1" style="">
								Ref
							</th>
							<th class="col-md-2" style="">
								Nom Produit
							</th>
							<th class="col-md-1" style="">
								Prix
							</th>
							<th class="col-md-1" style="">
								Stock
							</th>
							<th class="col-md-1" style="">
								Catégorie
							</th>
							<th class="col-md-1" style="">
								Rubriques
							</th>
							<th class="col-md-1" style="">
								Sousref
							</th>
							<th class="col-md-1" colspan=3 style="">
								Actions
							</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						if ( !empty( $result) )  {
							$i=0;
							$produit = new Catproduct();
							
							foreach ( $result as $value ) { 
								$i++;
								//print_pre( $value );
								
								// ---- Stock restant ----------- //
								$data_stock = $produit->getStockByProduit( $value[ "id" ], false );
								//print_pre( $data_stock );
								
								//Catégories
								//print_r($value[ "categories" ]);
								$categs = '';
								if (!empty($value[ "categories" ])) {
									foreach ($value[ "categories" ] as $value2) {
										$categs .= '- '. $value2[ "catlabel" ] .' <br> ';
									}
								} 
								$rubs = '';
								if (!empty($value[ "rubriques" ])) {
									foreach ($value[ "rubriques" ] as $value2) {
										$rubs .= '- '. $value2[ "rublabel" ] .' <br> ';
									}
								}
								$sousref = '';
								if (!empty($value[ "sousref" ])) {
									foreach ($value[ "sousref" ] as $value3) {
										$sousref .= '- '. $value3[ "color" ] .'-'. $value3[ "size" ] .'='. $value3[ "stock" ] .' <br> ';
									}
								}
							?>
							<tr class="<?php if ($i%2!=0) echo 'info'?>">
								<td><?php echo $value[ "reference" ]?></td>
								<td><?php echo $value[ "label" ] ?></td>
								<td><?php echo $value[ "prix" ]?></td>
								<td><?php echo $data_stock[ 0 ][ "stock" ]?></td>
								<td><?php echo $categs?></td>
								<td><?php echo $rubs?></td>
								<td><?php echo $sousref?></td>
								<td>
									<a href="product-edit.php?id=<?php echo $value[ "id" ] ?>&rubrique=<?php echo $rub ?>&categorie=<?php echo $categ ?>"><img src="img/modif.png" width="30" alt="Modifier" ></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="product-sousref-edit.php?id=<?php echo $value[ "id" ] ?>&rubrique=<?php echo $rub ?>&categorie=<?php echo $categ ?>"><img src="img/sr.png" width="30" alt="Modifier" ></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<?php if ($actif==0):?>
									<div style="display: none;" class="supp<?php echo $value[ "id" ]?> alert alert-warning alert-dismissible fade in" role="alert">
								      <button type="button" class="close"  aria-label="Close" onclick="$('.supp<?php echo $value[ "id" ]?>').css('display', 'none');"><span aria-hidden="true">×</span></button>
								      <strong>Voulez vous réactiver ce produit ?</strong>
								      <button type="button" class="btn btn-success" onclick="location.href='product-fp.php?reference=product&action=reactive&id=<?php echo $value[ "id" ] ?>'">Oui !</button>
								 	</div>
									<img src="img/check.png" width="20" alt="Supprimer" onclick="$('.supp<?php echo $value[ "id" ]?>').css('display', 'block');"> 
									
									<?php else:?>
									<div style="display: none;" class="supp<?php echo $value[ "id" ]?> alert alert-warning alert-dismissible fade in" role="alert">
								      <button type="button" class="close"  aria-label="Close" onclick="$('.supp<?php echo $value[ "id" ]?>').css('display', 'none');"><span aria-hidden="true">×</span></button>
								      <strong>Voulez vous vraiment supprimer ?</strong>
								      <button type="button" class="btn btn-danger" onclick="location.href='product-fp.php?reference=product&action=delete&id=<?php echo $value[ "id" ] ?>'">Oui !</button>
								 	</div>
									<img src="img/del.png" width="20" alt="Supprimer" onclick="$('.supp<?php echo $value[ "id" ]?>').css('display', 'block');"> 
									<?php endif;?>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>	
					</tbody>
				</table>

				<h3><?php echo $message?></h3>
			</div>
			<?php echo paginate('product-list.php?rubrique='.$rub.'&categorie='.$categ , '&p=', $nbPages, $current); ?>
		</div>
	</div>
</body>
</html>


