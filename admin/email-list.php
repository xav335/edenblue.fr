<?
	include_once '../inc/inc.config.php';
	include_once 'inc-auth-granted.php';
	include_once 'classes/utils.php';
	include_once 'classes/pagination.php';
	require 'classes/Email.php';
	
	try {
		$email = new Email();
		
		$total = $email->numberOfGet();
		
		$epp = 10; // nombre d'entrées à afficher par page (entries per page)
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
		$result = $email->get( null, $start, $epp);
		
		
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
				<?php echo paginate('email-list.php', '?p=', $nbPages, $current); ?>
				<br><br>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">

				<table class="table table-hover table-bordered table-condensed table-striped" >
					<thead>
						<tr>
							
							<th class="col-md-1" style="">
								Date
							</th>
							<th class="col-md-1" style="">
								Nom Prenom
							</th>
							<th class="col-md-1" style="">
								CP Ville
							</th>
							<th class="col-md-1" style="">
								Tel
							</th>
							<th class="col-md-1" style="">
								Email
							</th>
							<th class="col-md-6" style="">
								Message
							</th>
							<th class="col-md-1" colspan=3 style="">
								Actions
							</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						if ( !empty( $result) )  :
							$i=0;
							
							foreach ( $result as $value ) : 
								$i++;
							?>
							<tr class="<?php if ($i%2!=0) echo 'info'?>">
								<td><?php echo $value[ "date" ]?></td>
								<td><?php echo $value[ "name" ] ?> <?php echo $value[ "firstname" ] ?></td>
								<td><?php echo $value[ "cp" ]?> <?php echo $value[ "town" ]?></td>
								<td><a href="<?php echo $value[ "phone" ]?>" ><?php echo $value[ "phone" ]?></a></td>
								<td><a href="mailto:<?php echo $value[ "email" ]?>"><?php echo $value[ "email" ]?></a></td>
								<td><?php echo nl2br($value[ "message" ])?></td>
								<td>
        							<div style='display: none;'
        								class='supp<?php echo $value[ "id" ] ?> alert alert-warning alert-dismissible fade in'
        								role='alert'>
        								<button type='button' class='close' aria-label='Close'
        									onclick="$('.supp<?php echo $value[ "id" ] ?>').css('display', 'none');">
        									<span aria-hidden='true'>×</span>
        								</button>
        								<strong>Voulez vous vraiment supprimer ?</strong>
        								<button type='button' class='btn btn-danger'
        									onclick="location.href='email-fp.php?action=delete&id=<?php echo $value[ "id" ] ?>'">Oui
        									!</button>
        							</div> <img src='img/del.png' width='20' alt='Supprimer'
        							onclick="$('.supp<?php echo $value[ "id" ] ?>').css('display', 'block');">
        						</td>
							</tr>
							<?php endforeach; ?>
						<?php endif; ?>	
					</tbody>
				</table>

				<h3><?php echo $message?></h3>
			</div>
			<?php echo paginate('email-list.php', '?p=', $nbPages, $current); ?>
		</div>
	</div>
</body>
</html>


