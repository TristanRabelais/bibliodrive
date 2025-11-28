<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	</head>

	<body>
		<?php
			$pdo = new PDO("mysql:host=localhost;dbname=bibliodrive;charset=utf8", "root", "");
			$req = $pdo->query("SELECT * FROM livre ORDER BY dateajout DESC LIMIT 3");
			$livres = $req->fetchAll(PDO::FETCH_ASSOC);
		?>
		  <div class="carousel-indicators">
			<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
			<button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
			<button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
		</div>

		<div id="Nouveautes" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php
					$active = "active";
					foreach ($livres as $livre) {
						echo '
						<div class="carousel-item '.$active.'">
							<img class="d-block w-100" style="height:450px; object-fit:cover;" src="covers/'.$livre['photo'].'" alt="'.$livre['titre'].'">
					

							<div class="carousel-caption d-none d-md-block bg-dark p-2" style="opacity:0.8;">
								<h5>'.$livre['titre'].'</h5>
							</div>
						</div>';
						$active = "";
					}
				?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
				<span class="carousel-control-next-icon"></span>
			</button>
		</div>
	</body>
</html>
