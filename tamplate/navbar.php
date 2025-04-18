<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tanaman Padi</title>
    <link rel="shortcut icon" href="assets/images/padi2.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="assets/css/animate.css" />

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/css/magnific-popup.css" />

    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="assets/css/jquery.timepicker.css" />

    <link rel="stylesheet" href="assets/css/flaticon.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                </div>
                <div class="col-md-6 d-flex justify-content-md-end">
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><i class="sr-only">Facebook</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/images/padi8.jpg" style="width: 10%" />Tanaman Padi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <?php
                    // Set default value for $activePage
                    $activePage = basename($_SERVER['PHP_SELF']);

                    // Define an array of menu items with their corresponding links
                    $menuItems = array(
                        'index.php' => 'Home',
                        'about.php' => 'Tentang',
                        'help.php' => 'Penggunaan',
                        'admin/login.php' => 'Login'
                    );

                    // Loop through each menu item and add the active class if the page matches
                    foreach ($menuItems as $link => $label) {
                        $activeClass = ($activePage == $link) ? 'active' : '';
                        echo "<li class='nav-item $activeClass'><a href='$link' class='nav-link'>$label</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>