<?php
include "db/dbconnection.class.php";
$dbconnect = new Dbconnection();
//$dbconnect is een instantie van de Dbconnection-class
//en bevat dus alles wat nodig is voor een werkende database-connectie
$sql = "SELECT * FROM sommen ORDER BY RAND() LIMIT 1";
//standaard:
$query = $dbconnect->prepare($sql);
//standaard:
$query->execute();
//standaard:
$recset = $query->fetchAll(2);
//slimmigheid: kijken wat de raw-output is
/*echo "<pre>";
print_r($recset);
echo "</pre>";*/
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procententool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!--Navigatiebar-->
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
    
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/index.html">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Procentenrekentool
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/Rekenmachine/index.html">Rekenmachine</a></li>
                                <li><a class="dropdown-item" href="/Game/index.html">Game</a></li>
                                <li><a class="dropdown-item" href="/Tafelsoefenen/index.html">Tafelsoefenen</a></li>
                                <li><a class="dropdown-item" href="/Tafels/index.html">Tafels tool</a></li>
                                <li><a class="dropdown-item" href="/Rekenopdracht/index.html">Omrekenen</a></li>
                                <li><a class="dropdown-item" href="/Sudoku/index.html">Sudoku</a></li>
                                <li><a class="dropdown-item" href="/procentenrekentool/index.php">Procentenrekentool</a></li>
                            </ul>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
        <!--Einde navigatie tab-->
    <div class="container">
      <div id="som">
        <div class="row">
          <div class="col-8">
          <h5>Inleiding</h5>
        <?php
          echo $recset[0]['inleiding'];
        ?>
        <h5>Vraag</h5>
        <!-- shortcut voor het opvragen van 1 variabele --> 
        <?= $recset[0]['vraag']; ?>
        <h5>Geef hier je antwoord</h5>
        <div class='row'>
          <div class='col-3'>
        <?php
        if($recset[0]['voor_achter'] == 0){
          ?>
            <div class='input-group mb-3'>
                  <span class='input-group-text'><?= $recset[0]['eenheid'] ?></span>
                  <input id='answer' type='text' class='form-control'>
            </div>
          
        <?php
        } else { 
          ?>
            <div class='input-group mb-3'>
              <input id='answer' type='text' class='form-control'>
              <span class='input-group-text'><?= $recset[0]['eenheid'] ?></span>
            </div>
        <?php }
        ?>
          </div>
          <div class='col-3'>
            <button class="btn btn-success" onclick="checkAnswer('<?= $recset[0]['antwoord'] ?>')">Check antwoord</button>
          </div>
        </div>
          </div>
          <div class="col-4">
            <?php 
              if($recset[0]['afbeelding'] != '')
              echo "<img src='{$recset[0]['afbeelding']}' 
                  alt='' style='height: 300px;' class='img-fluid'>";
            ?>


          </div>
        </div>

      </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-3">
                <!-- begin card -->
                <div class="card" style="margin-top: 200px">
                    <div class="card-header">
                      Oud
                    </div>
                    <div class="card-body">
                        <p>Denk ook aan</p>
                        <ul>
                            <li>zonder of exclusief BTW</li>
                            <li>zonder of exclusief korting</li>
                        </ul>
                    </div>
                    <div class="card-footer text-body-secondary">
                      <input id="inp_oud" class="form-control is-invalid" onchange="checkInput()">
                    </div>
                </div>
                <!-- einde card -->
            </div>
            <div class="col-4">
                <select id="select_soort" class="form-select" style="margin-top: 50px;" onchange="checkInput()">
                    <option value="">Kies...</option>
                    <option value="0">van</option>
                    <option value="1">toename</option>
                    <option value="2">afname</option>
                </select>
                <div class="input-group mb-3 mt-3">
                    <span class="input-group-text">Percentage</span>
                    <input id="inp_percentage" type="text" class="form-control" onchange="checkInput()">
                    <span class="input-group-text">%</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Vermenigvuldigingsfactor</span>
                    <input id="inp_factor" type="text" class="form-control" disabled>
                  </div>
                  <img src="pijlen.avif" alt="" class="img-fluid">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Deelfactor: /</span>
                    <input id="inp_deler" type="text" class="form-control" disabled>
                  </div>
                  <div class="d-grid">
                  <button id="losop_btn" type="button" class="btn btn-success" disabled onclick="solveProblem()">Los op</button>
                </div>
            </div>
            <div class="col-3">
                <!-- begin card -->
                <div class="card" style="margin-top: 200px">
                    <div class="card-header">
                      Nieuw
                    </div>
                    <div class="card-body">
                        <p>Denk ook aan</p>
                        <ul>
                            <li>met of inclusief BTW</li>
                            <li>met of inclusief korting</li>
                        </ul>
                    </div>
                    <div class="card-footer text-body-secondary">
                      <input id="inp_nieuw" class="form-control is-invalid" onchange="checkInput()">
                    </div>
                </div>
                <!-- einde card -->
            </div>
            <div class="col-1"></div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>