<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Carousel Bibliodrive</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<?php
			$directory = __DIR__ . '/covers';
			$webPath = './covers';
			$livres = [];
			$extensions = ['jpg', 'png'];
			foreach (scandir($directory) as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if (in_array(strtolower($extension), $extensions)) {
					$livres[] = (object)[
						"titre" => pathinfo($file, PATHINFO_FILENAME),
						"photo" => "$webPath/$file"
					];
				}
			}
			$livres = array_slice($livres, 0, 3);
		?>
		<div class="container mt-4">
			<h3 class="text-center">Dernières acquisitions :</h3>
		</div>
		<div id="demo" class="carousel slide carousel-fade carousel-dark" data-bs-ride="carousel">
			<div class="carousel-indicators">
				<?php for ($i = 0; $i < count($livres); $i++): ?>
					<button type="button"
							data-bs-target="#demo"
							data-bs-slide-to="<?= $i ?>"
							class="<?= $i === 0 ? 'active' : '' ?>">
					</button>
				<?php endfor; ?>
			</div>
			<div class="carousel-inner">
				<?php foreach ($livres as $id => $livre): ?>
					<div class="carousel-item <?= $id === 0 ? 'active' : '' ?>">
						<div class="d-flex justify-content-center">
							<img src="<?= $livre->photo ?>"
								alt="<?= $livre->titre ?>"
								class="d-block"
								style="width:50%; border-radius:10px;">
						</div>
					</div>
				<?php endforeach; ?>
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