<?php 

  $activepla = 'class="active"';
  
  $frase = 'Compreenda mais!';
  $titulo = 'Planejamento estratégico';
  include 'menu.php';

  $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);
  
  include "../control/GenericDAO.php";
  require_once "../control/SelecionadoDAO.php";

  $selecao = new SelecionadoDAO();
  $empresa = $selecao->Empresa($idsum)->fetch(PDO::FETCH_OBJ)->nomefantasia ?? 0;
  $analise = $selecao->Analise($idsum)->fetch(PDO::FETCH_OBJ)->idanalise ?? 0;
  $forca = $selecao->Forca($idsum)->fetch(PDO::FETCH_OBJ)->idforca ?? 0;
  $ameaca = $selecao->Ameaca($idsum)->fetch(PDO::FETCH_OBJ)->idameaca ?? 0;
  $fraqueza = $selecao->Fraqueza($idsum)->fetch(PDO::FETCH_OBJ)->idfraqueza ?? 0;
  $oportunidade = $selecao->Oportunidade($idsum)->fetch(PDO::FETCH_OBJ)->idoportunidade ?? 0;
  $objetivo = $selecao->Objetivo($idsum)->fetch(PDO::FETCH_OBJ)->idobjetivo ?? 0;
  $estrategia = $selecao->Estrategia($idsum)->fetch(PDO::FETCH_OBJ)->idestrategia ?? 0;
  $controle = $selecao->Controle($idsum)->fetch(PDO::FETCH_OBJ)->idcontrole ?? 0;


  //consulta para saber se há valor, se tiver cria o link de alterar e, a estilizacao do botao
  if ( ($forca <> null || $forca > 0) || 
       ($ameaca <> null || $ameaca > 0) || 
       ($fraqueza <> null || $fraqueza > 0) || 
       ($oportunidade <> null || $oportunidade > 0) ) 
  {
    $linkanalise = "analise/altmatriz-fofa.php?idanalise=$analise&idsum=$idsum";
    $textanalise = "text-white";
    $bganalise = "bg-success";
  } else {
    $linkanalise = "analise/matriz-fofa.php?idsum=$idsum";
  }
  
  if ($objetivo <> null || $objetivo > 0) {
    $linkobjetivo = "obj/altobjetivos.php?idobjetivo=$objetivo&idsum=$idsum";
    $textobjetivo = "text-white";
    $bgobjetivo = "bg-success";
  } else {
    $linkobjetivo = "obj/objetivos.php?idsum=$idsum";
  }
  
  if ($estrategia <> null || $estrategia > 0) {
    $linkestrategia = "estrategias/altestrategias.php?idestrategia=$estrategia&idsum=$idsum";
    $textestrategia = "text-white";
    $bgestrategia = "bg-success";
  } else {
    $linkestrategia = "estrategias/estrategias.php?idsum=$idsum";
  }

  if ($controle <> null || $controle > 0) {
    $linkcontrole = "controle/altcontrole.php?idcontrole=$controle&idsum=$idsum";
    $textcontrole = "text-white";
    $bgcontrole = "bg-success";
  } else {
    $linkcontrole = "controle/controle.php?idsum=$idsum";
  }
  //fim da consulta
  $dados = $objetivo.$linkestrategia.$controle;

  if($idsum == null || $idsum == 0 || $empresa == null)
    header('Location: listagem.php');
?>
      <!-- End Navbar -->
      <div class="panel-header">
        <h1 class="text-center text-white"><?php echo $empresa ?></h1>
      </div>
      <div class="content">
        <div class="row justify-content-start">
          <!--Sumário executivo-->
          <div class="col-lg-3">
            <a class="card card-chart bg-success" href="plan/altplanejamento.php?idsum=<?php echo $idsum ?>" style="height: 200px;">

              <div class="card-body">
                <p class="lead text-center text-white" style=" margin-top: 30%;">
                    1 - Sumário executivo                   
                </p>
              </div>

            </a>
          </div>
          <!--Análise Ambiental-->
          <div class="col-lg-3">
            <a class="card card-chart <?php echo $bganalise ?>" 
              href="<?php echo $linkanalise ?>" style="height: 200px;">

              <div class="card-body">
                <p class="lead text-center <?php echo $textanalise ?>" style="margin-top: 30%;">
                  2 - Análise Ambiental                  
                </p>
              </div>
              
            </a>
          </div>
          <!--Objetivos-->
          <div class="col-lg-3">
            <a class="card card-chart <?php echo $bgobjetivo ?? '' ?>" 
              href="<?php echo $linkobjetivo ?>" style="height: 200px;">

              <div class="card-body">
                <p class="lead text-center <?php echo $textobjetivo ?? '' ?>" style=" margin-top: 30%;">
                  3 - Objetivos                   
                </p>
              </div>
   
            </a>
          </div>
        </div>
        <div class="row justify-content-end">
          <!--Sumário executivo-->
          <div class="col-lg-3">
            <a class="card card-chart <?php echo $bgestrategia ?? '' ?>" 
              href="<?php echo $linkestrategia ?>" style="height: 200px;">

              <div class="card-body">
                <p class="lead text-center <?php echo $textestrategia ?? '' ?>" style="margin-top: 30%;">
                    4 - Estratégias <br>
                    <?php echo $objetivo == null || $objetivo == 0 ? '<span class="small text-secondary">É necessário preencher os objetivos</span>' : '' ?>                   
                </p>
              </div>

            </a>
          </div>
          <!--Análise Ambiental-->
          <div class="col-lg-3">
            <a class="card card-chart <?php echo $bgcontrole ?? '' ?>" href="<?php echo $linkcontrole ?>" style="height: 200px;">

              <div class="card-body">
                <p class="lead text-center <?php echo $textcontrole ?? '' ?>" style=" margin-top: 30%;">
                  5 - Controle <br>        
                  <?php echo $objetivo == null || $objetivo == 0 ? '<span class="small text-secondary">É necessário preencher os objetivos</span>' : '' ?>        
                </p>
              </div>

            </a>
          </div>
          <!--Objetivos-->
          <div class="col-lg-3">
            <a class="card card-chart" style="height: 200px;">
              <div class="card-body">
                <p class="lead text-center" style=" margin-top: 30%;">
                  6 - Relatórios                  
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>
</html>