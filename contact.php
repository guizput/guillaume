<head>
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">

	<meta charset="utf-8">
</head>

<body>	
	
	

	<section id="about" class="home-section text-center">
	    	<div class="wow bounceInDown" data-wow-delay="0.4s">
						<div class="section-heading">
						<h2>Contact</h2>
						<i class="fa fa-2x fa-angle-down"></i>

						</div>
						</div>
			<div id="presentation">
					<div class="avatar"><img src="img/team/guillaume.jpg" alt="" class="img-responsive img-circle" /></div>
					<br/>
						<p>      	<?php

						if (
							isset($_POST['message']) && 
							isset($_POST['email']) && 
							isset($_POST['name'])
							) 
						{

							$message = $_POST['message'];
							$headers = $_POST['email']."\r\n"."\r\n".'Nom:'.' '.$_POST['name'];

							mail('guillaumeduran2@gmail.com', 'Contact via G | D', $message, $headers);
							echo 'Votre message a bien été envoyé! <br/> <br/> <a class="btn btn-info" id="retour" href="http://www.guillaumeduran.fr">Retourner sur le site.</a>';

						}
						else{
								echo 'Une erreur est survenue, veuillez remplir le <a class="btn btn-info" href="http://www.guillaumeduran.fr">formulaire</a> à nouveau';
							}


							?>
						</p>

			</div>
			
		</section>



</body>		