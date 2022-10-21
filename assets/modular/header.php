<!-- Discover Costa Rica, Kasim O'Meally 2/26/2022 -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page;?></title>
        <link rel="icon" type="image/x-icon" href="assets/media/costa_rica_flag.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <?php
            
            $script = "<script src='assets/script/final.js'></script>\n";

            $mapScript = "<script src='assets/script/final.js'></script>\n
            <script src='https://polyfill.io/v3/polyfill.min.js?features=default'></script>\n";
            
            $provinces = array("Experience San José", "Experience Heredia", "Experience Cartago", "Experience Alajuela", "Experience Guanacaste", "Experience Limón", "Experience Puntarenas");

            if ($page == "Experience Costa Rica" || $page == "Experience Costa Rica - Share your thoughts!") {
                echo $script;
            }
            
            for ($i=0; $i < count($provinces); $i++) { 
                if ($provinces[$i] == $page) {
                    echo $mapScript;
                }
            }


        ?>
    </head>
    <body
        <?php 
            if ($page == "Experience Costa Rica") {
                echo "onload='showSlides(1);'\n";
            }

            for ($i=0; $i < count($provinces); $i++) { 
                if ($provinces[$i] == $page) {
                    echo "onload='initMap();'\n";
                }
            }

        ?> 
    >
        <header>
            <a href="index.php"><img src="assets/media/costa_rica_flag.png" alt="Costa Rica flag"/></a>
            Experience Costa Rica
            <br>
            <div class="pura-vida">¡Pura Vida!</div>
        </header>
        <!-- Dropdown menu -->
        <nav>
            <a class="transform" href="index.php">Home</a>
            <!-- Dropdown container -->
            <div class="dropdown">
                <button class="dropbtn">Provinces of Costa Rica</button>
                <!-- Container for dropdown content -->
                <div class="dropdown-content">
                    <a href="sanjose.php">San José</a>
                    <a href="heredia.php">Heredia</a>
                    <a href="cartago.php">Cartago</a>
                    <a href="alajuela.php">Alajuela</a>
                    <a href="guanacaste.php">Guanacaste</a>
                    <a href="limon.php">Limón</a>
                    <a href="puntarenas.php">Puntarenas</a>
                </div>
            </div>
            <a class="transform" href="comments.php">Share your thoughts!</a>
            <div class="dropdown">
                <button class="dropbtn">About</button>
                <div class="dropdown-content">
                    <a href="grading.php" target="_blank">Grading</a>
                    <a href="references.php" target="_blank">References</a>
                </div>
            </div>
        </nav>