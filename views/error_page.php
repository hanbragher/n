<!DOCTYPE html>
<html>
<head>
    <title>404 Error</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/errorstyle.css">

</head>
<body >

<div class="background">
    <div class="err">
        <h2 style="text-align: center;">
            Error 404. Oops The page you
            are looking for <b>Doesn't Exist</b></h2>
        <h2 style="text-align: center;">
            Վայ, ձեր որոնվող էջը <b>գոյություն չունի</b></h2>
    </div>
    <a href="<?php echo SITE;?>"><h class="form-signin-heading">Վերադարձ</h></a>
</div>
</body>
</html>

<?php
print_r($_SERVER);