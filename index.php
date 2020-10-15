<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://use.typekit.net/nng5qyc.css" />
	<title>Cherry'Use</title>
</head>

<body>
	<div class="espace"></div>
	<div class="logo">
		<img src="img/Logo.png" alt="" />
	</div>
	<div class="prez">
		<div class="prezG">
			<h3>L'application qui vous aide à mieux trier vos déchets</h3>
			<button>
				<h4>Découvrez l'application</h4>
			</button>
		</div>
		<div class="prezD">
			<img src="img/collecte.png" alt="" />
		</div>
	</div>

	<!-- 2eme Part -->
	<div class="mission">
		<div class="missiontitre">
			<h2>Notre Mission</h2>
		</div>
		<div class="missiontexte">
			<p>
				Afin de mieux recycler, nous avons créé Cherry’Use. Cherry’Use vous
				explique comment trier vos déchets, simplement en prenant une photo du
				produit. L’application vous proposera également une alternative plus
				écologique et sans plastique aux produits que vous consommez.
			</p>
		</div>
		<div class="missionbtn">
			<form action="https://www.facebook.com/cherryuse/">
				<button type="submit">
					<h4>Soutenir le projet</h4>
				</button>
			</form>
		</div>
	</div>

	<!-- Soutenir projet -->
	<div class="soutiencontact">
		<div class="soutientitre">
			<h2>Soutenir le projet</h2>
		</div>
		<form action="index.php" name="accueil" method="post">
			<div>
				<label for="name">nom :</label>
				<input type="text" id="name" name="nom" />
			</div>
			<div>
				<label for="mail">E-mail :</label>
				<input type="email" id="mail" name="mail" />
			</div>
			<div>
				<label for="msg">Message:</label>
				<textarea id="msg" name="message"></textarea>
			</div>
			<div class="button">
				<button type="submit" name="accueil">Envoyer</button>
			</div>
		</form>
	</div>
	<?php
	session_start();
	require_once 'utilisateur.php';
	require_once 'bdd.php';

	if (isset($_POST['accueil'])) {
		// j'ai reçu le formulaire

		if (empty($_POST['mail'])) {  // On check si le formulaire est rempli
			echo "Veuillez entrer votre mail.";
		} elseif (empty($_POST['nom'])) {
			echo "Veuillez entrer votre nom.";
		} elseif (empty($_POST['message'])) {
			echo "Veuillez entrer votre message.";
		} else {
			// Tout les champs sont bons

			$user = new Utilisateur();
			$user->setmail(strtoupper($_POST['mail'])); // récupération en majuscule pour gestion des doublons dans la base de données
			$user->setnom(strtoupper($_POST['nom']));
			$user->setmessage(strtoupper($_POST['message']));

			$bdd = new BDD();
			$upnom =  $user->getnom();
			$upmail = $user->getmail();


			if (!Doublon($bdd, $upnom, $upmail)) {
				$upmessage = $user->getmessage();
				Insertion($bdd, $upnom, $upmail, $upmessage);
			}
		};
	}
	function Doublon($bdd, $upnom, $upmail)
	{
		$sql = "SELECT EXISTS(SELECT mail, nom FROM cherry WHERE mail=:mail and nom=:nom)";

		$sql = $bdd->connexion->prepare($sql);
		$sql->execute(array(
			'mail' => $upmail,
			'nom' => $upnom
		));

		$return = $sql->fetchColumn();
		if ($return > 0) {
			echo "$upmail $upnom est déjà dans la liste de contact ! ";
			return true;
		} else {
			return false;
		}
	}
	function Insertion($bdd, $upnom, $upmail, $upmessage)
	{

		$sql = "INSERT INTO cherry(mail, nom, message) VALUES (:mail, :nom, :message)";

		$insertion = $bdd->connexion->prepare($sql);
		$insertion->execute(array(
			'mail' => $upmail,
			'nom' => $upnom,
			'message' => $upmessage
		));

		echo "Merci pour votre message"; // afficher le mail, le nom, et le message
	}

	?>
</body>

</html>