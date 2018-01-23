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

    <form class="form-signin" action="reg" method="POST">
        <h3 class="form-signin-heading">Գրանցվել</h3>
        <h6 class="form-signin-heading"><?php stugelpass();?></h6>
        <input type="email" class="form-control" placeholder="էլ․ հասցե" required autofocus="" name="regmail">
        <input class="form-control" type="password" placeholder="Գաղտնաբառ" name="regpswrd" required pattern="[0-9A-Za-z]{2,}">
        <input class="form-control" type="password" placeholder="Գաղտնաբառ" name="regpswrd1" required pattern="[0-9A-Za-z]{2,}">
        <input type="checkbox" required>
        <h6><a class="form-signin-heading" href='agree'>Համաձայն եմ պայմանների հետ</a></h6>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Գրանցվել
        </button>
        <a href="<?php echo SITE;?>"<h class="form-signin-heading">Վերադարձ</h></a>
    </form>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>