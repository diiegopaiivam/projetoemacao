<?php 

  $frase = 'Agora é hora de agir!';
  $titulo = 'Controle';

  require_once '../menu_include.php';

  $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);

  require_once "../../control/ControleDAO.php";
  require_once "../../control/SelecionadoDAO.php";
  
  require_once "../../include/ConversaoData.php";

  $selecao = new SelecionadoDAO();
  $objetivo = $selecao->Objetivo($idsum)->fetch(PDO::FETCH_OBJ)->idobjetivo ?? 0;
  $controle = $selecao->Controle($idsum)->fetch(PDO::FETCH_OBJ)->idcontrole ?? 0;

  if($idsum == null || $idsum == 0 || $objetivo == 0)
    header("Location: ../listagem.php");

  if($controle > 0)
    header("Location: altcontrole.php?idsum=$idsum&idestrategia=$controle");

  $controledao = new ControleDAO();
  $listagemobjetivo = $controledao->DadosObjetivo($idsum);

  $i = 0;

?>
      <div class="panel-header">
        <h1 class="text-center text-white">Atualizar Controle</h1>
      </div>
      <div class="content">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-info btn-sm float-right" href="../listagem.php"> 
                  <i class="fa fa-home ml-2"></i> Voltar
                </a>
                <h5 class="title">Atualizar controle :)</h5>
              </div>
              <div class="card-body">

              <?php 
                $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
            
                $idobjetivo = filter_input(INPUT_POST, 'idobjetivo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $perspectiva = filter_input(INPUT_POST, 'perspectiva', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $indicadores = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $meta = filter_input(INPUT_POST, 'meta', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $acoes = filter_input(INPUT_POST, 'acoes', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                $cdata = new ConversaoData();

                if(isset($idobjetivo)){

                  $num = 0;

                  foreach ($idobjetivo as $objetivo) {

                    $controlelista = [1 => $idsum, 2 => $objetivo, 3 => utf8_decode($perspectiva[$i]), 
                                        4 => utf8_decode($indicadores[$i]), 5 => utf8_decode($meta[$i]), 6 => utf8_decode($acoes[$i])];

                    $result = $controledao->AlterarControle($controlelista);

                    $i++;
                  }

                  if ($result > 0) {
                    header("refresh:1,url=altcontrole.php?idsum=$idsum");
                  }

                }

              ?>

                <form method="post">
                <?php while ($row = $listagemobjetivo->fetch(PDO::FETCH_OBJ)) { ?>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Objetivo ?</label>
                        <input type="text" class="form-control" disabled value="<?php echo utf8_encode($row->objetivo) ?>" >
                        <input type="hidden" class="form-control" name="idobjetivo[<?php echo $i ?>]" value="<?php echo $row->idobjetivo ?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Perspectiva</label>
                        <input type="text" name="perspectiva[<?php echo $i ?>]" class="form-control" placeholder="Perspectiva">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Indicadores</label>
                        <input type="text" name="indicadores[<?php echo $i ?>]" class="form-control" placeholder="Indicadores">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Meta</label>
                        <input type="text" name="meta[<?php echo $i ?>]" class="form-control" placeholder="Meta">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Ações</label>
                        <input type="text" name="acoes[<?php echo $i ?>]" class="form-control" placeholder="Ações">
                      </div>
                    </div>
                  </div>
                  <hr class="bg-success">
                  <?php $i++; } ?>
              </div>
              <div class="card-footer">
                <div class="row justify-content-between m-0">
                  <a href="../planejamento-selecionado.php?idsum=<?php echo $idsum ?>" class="btn btn-danger">Cancelar <i class="fa fa-trash-alt ml-2"></i></a>
                  <button class="btn btn-success" name="acao" value="salvar">Cadastrar <i class="fa fa-plus ml-2"></i></button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer">
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
</body>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();
    });
  </script>

</html>