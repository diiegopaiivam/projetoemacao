<?php 

  $frase = 'Agora é hora de agir!';
  $titulo = 'Controle';
  
  include '../menu_include.php';

  $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);

  require_once "../../control/ControleDAO.php";
  require_once "../../control/SelecionadoDAO.php";

  $selecao = new SelecionadoDAO();
  $objetivo = $selecao->Objetivo($idsum)->fetch(PDO::FETCH_OBJ)->idobjetivo ?? 0;

  if($idsum == null || $idsum == 0 || $objetivo == null)
    header("Location: ../planejamento-selecionado.php?idsum=$idsum");

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
                <form>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Objetivo ?</label>
                        <select class="form-control" name="objetivo">
                          <option>Select</option>
                          <option>Select</option>
                          <option>Select</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Perspectiva</label>
                        <input type="text" name="perspectiva" class="form-control" placeholder="Perspectiva">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Indicadores</label>
                        <input type="text" name="indicadores" class="form-control" placeholder="Indicadores">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Meta</label>
                        <input type="text" name="meta" class="form-control" placeholder="Meta">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Ações</label>
                        <input type="text" name="acoes" class="form-control" placeholder="Ações">
                      </div>
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Objetivo ?</label>
                        <select class="form-control" name="objetivo">
                          <option>Select</option>
                          <option>Select</option>
                          <option>Select</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Perspectiva</label>
                        <input type="text" name="perspectiva" class="form-control" placeholder="Perspectiva">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Indicadores</label>
                        <input type="text" name="indicadores" class="form-control" placeholder="Indicadores">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Meta</label>
                        <input type="text" name="meta" class="form-control" placeholder="Meta">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Ações</label>
                        <input type="text" name="acoes" class="form-control" placeholder="Ações">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row justify-content-between m-0">
                  <button class="btn btn-danger">Cancelar <i class="fa fa-trash-alt ml-2"></i></button>
                  <button class="btn btn-success">Cadastrar <i class="fa fa-plus ml-2"></i></button>
                </div>
              </div>
            </div>
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