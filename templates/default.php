<!DOCTYPE html>
<html lang="DE" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <title><?= $data["title"] ?></title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body class="">
        <?php
            //var_dump($data);
        ?>
            <!-- Logo -->
            <div class="" style="width: 100%; background: white;">
                <img src="img/logobig.png" style="width: 30%;">
            </div>
            
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a href="index.php" class="navbar-brand">Energiezähler</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Startseite</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?a=input">Dateneingabe</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Auswertung
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?a=output_visu">Visualisierung</a></li>
                                    <li><a class="dropdown-item" href="?a=output_rawdata">Rohdaten</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?a=settings">Einstellungen</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="content">
                <div class="container-fluid">
                     <!-- Meldungen anzeigen -->
                    <?php
                        if($data["messages"]["error"] != null){
                            echo "<div class='alert alert-danger' role='alert'>".$data["messages"]["error"]."</div>";
                        }
                        if($data["messages"]["warning"] != null){
                            echo "<div class='alert alert-warning' role='alert'>".$data["messages"]["warning"]."</div>";
                        }
                        if($data["messages"]["success"] != null){
                            echo "<div class='alert alert-success' role='alert'>".$data["messages"]["success"]."</div>";
                        }
                        
                    ?>
                    <?= $content ?>
                </div>
            </div>
            <!-- Footer -->
            <div class="container-fluid bg-dark text-light footer">
                <hr>
                <div id="copyright">
                    © <?= date("Y")?>  jjk1
                </div>
            </div>
    </body>
</html>
