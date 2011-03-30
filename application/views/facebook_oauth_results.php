<!DOCTYPE html>  

<head>

	<title>CodeIgniter Facebook OAuth Results Example</title>
	<link rel="stylesheet" href="assets/css/fb_app.css" type="text/css" />

</head>

<body>
	
	<p>Token: <?= $data["token"]; ?></p>
	
	<p>Me: <strong><?= $data["me"]->name; ?></strong></p>
	
	<p>Friends: <?php print_r($data["friends"]); ?></p>

</body>

</html>