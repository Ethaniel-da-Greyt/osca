<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<style>
		body {
			margin: 0;
			padding: 0;
		}

		/* CR80 Size */
		.id-card {
			width: 85.60mm;
			height: 53.98mm;
			padding: 0;
			margin: 0;
			overflow: hidden;
			page-break-after: always;
			margin-bottom: 10px;
			/* ensures each card prints on a separate page */
		}

		.full-id {
			width: 85.60mm;
			height: 53.98mm;
			object-fit: cover;
			display: block;
		}

		@page {
			size: 88mm 60mm;
			margin: 0;
		}
	</style>
</head>

<body onload="window.print()">

	<?php
	// Example: load all generated IDs from folder
	$idFolder = WRITEPATH . 'Osca-ID/';

	// Convert image to base64 for inline display
	// $imgBase64 = base64_encode(file_get_contents($file));
	$imgSrc = base_url('template/osca-back-new.png');
	?>
	<div class="id-card">
		<img src="<?= $imgSrc ?>" class="full-id">
	</div>

</body>

</html>