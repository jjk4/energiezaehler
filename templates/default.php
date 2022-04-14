<?php require_once("header.php"); ?>
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
