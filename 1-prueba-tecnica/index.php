<?php
require_once 'vendor/autoload.php';

$config = __DIR__ . "/app/config/settings.php";
$vars = parse_ini_file($config, false);

$APIMovies = new \App\APIMovie($vars['API_KEY'], $vars['API_URL']);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>MOVIES</title>
</head>

<body>
    <div class="header">
        <div class="header-right">
            <p>Listado películas OMDb</p>
        </div>
    </div>
    <div id="busqueda">
        <form>
            <div class="form-row align-items-center justify-content-center">
                <div class="col-sm-5 my-1">
                    <label class="sr-only" for="inlineFormInputName">Name</label>
                    <input type="text" class="form-control" id="sTerm" name="sTerm" placeholder="Especifique el término de búsqueda...">
                </div>

                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div id="listado">

        <?php
        if (isset($_GET['sTerm']) && $_GET['sTerm'] != "") {
            $movies = $APIMovies->search($_GET['sTerm']);

            if ($movies['Response'] == 'True') {
                echo '<div class="row justify-content-center">';
                echo '<table class="table table-striped col-10">';
                echo '<thead>';
                echo '<tr>';

                if ($vars['COL_IMAGEN'] == 1) echo '<th scope="col"></th>';
                if ($vars['COL_TITULO'] == 1) echo '<th scope="col">Título</th>';
                if ($vars['COL_ANO'] == 1) echo '<th scope="col">Año</th>';
                if ($vars['COL_TIPO'] == 1) echo '<th scope="col">Tipo</th>';
                if ($vars['COL_IMDBID'] == 1) echo '<th scope="col">IMDBID</th>';

                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';


                foreach ($movies['Search'] as $movie) {
                    echo '<tr>';
                    if ($vars['COL_IMAGEN'] == 1) echo '<td><img src="' . $movie['Poster'] . '" alt="' . $movie['imdbID'] . '" class="poster"></td>';
                    if ($vars['COL_TITULO'] == 1) echo '<td class="titulo">' . $movie['Title'] . '</td>';
                    if ($vars['COL_ANO'] == 1) echo '<td class="ano">' . $movie['Year'] . '</td>';
                    if ($vars['COL_TIPO'] == 1) echo '<td class="tipo">' . $movie['Type'] . '</td>';
                    if ($vars['COL_IMDBID'] == 1) echo '<td class="imdbid">' . $movie['imdbID'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="form-row align-items-center justify-content-center">';
                echo '<div class="alert alert-warning" role="alert">';
                echo 'LO SENTIMOS!!! No hemos encontrado ninguna película por el término "' . $_GET['sTerm'] . '"';
                echo '</div>';
                echo '</div>';
            }
        }

        ?>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">PRUEBA TÉCNICA_PROC. SELECCIÓN PHP DEVELOPER © 2020 Copyright:
            <a href="https://oscarbello.es/"> Oscar Bello</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


</body>

</html>