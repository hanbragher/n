<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<!--<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">

	<title>Բարի գալուստ</title>
</head>
<body>
<div class="container">
	<div id="fullscreen_bg" class="fullscreen_bg"/>

   <form class="form-signin" action="trylogin" method="POST">
		<h3 class="form-signin-heading">Բարի գալուստ</h3>
        <h class="form-signin-heading"><?php print_r($check);//echo ($check["message"]) ? $check["message"] : ""?></h>
		<input type="text" class="form-control" placeholder="էլ․ հասցե" required="" autofocus="" name="mail">
		<input type="password" class="form-control" placeholder="Գաղտնաբառ" required="" name="passwrd">
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Մուտք
		</button>
        <a href="<?php echo SITE;?>"><h class="form-signin-heading">Վերադարձ / </h></a>
		<a href="remember"><h class="form-signin-heading">Բա գաղնաբա՞ռը</h></a>
	</form>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>