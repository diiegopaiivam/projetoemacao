<?php 

  $activepla = 'class="active"';

  require_once 'menu.php';

  require_once "../control/SumarioDAO.php";
  $sumariodao = new SumarioDAO();

  $listagem = $sumariodao->ListagemPlanejamentos();


?>


      <div class="panel-header">
        <h1 class="text-center text-white">Listagem Planejamentos <br> estratégicos</h1>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">


              <?php 

                  $acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

                  if ($acao == 'excluir') {
                    
                    $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);

                    $result = $sumariodao->Deletar($idsum);

                    if($result)
                    {
                      echo "<div class='alert alert-success'>
                          <button type='button' aria-hidden='true' class='close' data-dismiss='alert' aria-label='Close'>
                            <i class='now-ui-icons ui-1_simple-remove'></i>
                          </button>
                          <span>Excluído com sucesso.</span>
                        </div>";
                    }

                  }
                
                ?>

                <div class="row justify-content-between ml-2 mr-2">
                  <h4 class="card-title">Listagem</h4>
                  <a class="btn btn-success" href="plan/planejamento.php">
                    Cadastrar um novo :) <i class="fa fa-plus ml-2 text-white" ></i>
                  </a>
                </div>
              </div>
              <div class="card-body">

                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Empresa
                      </th>
                      <th>
                        Ação
                      </th>
                    </thead>
                    <tbody>
                        
                      <?php while ($row = $listagem->fetch(PDO::FETCH_ASSOC)) { ?>

                      <tr>
                        <td>
                          <?php echo $row['nomeplanejamento']; ?>
                        </td>
                        <td>
                          <?php echo $row['nomefantasia']; ?>
                        </td>
                        <td>
                          <a class="fas fa-book text-info" href="planejamento-selecionado.php?idsum=<?php echo $row['idsum'] ?>"></a>
                          <a class="fa fa-edit ml-2 text-warning" href="plan/altplanejamento.php?idsum=<?php echo $row['idsum'] ?>"></a>
                          <a class="fa fa-trash-alt ml-2 text-danger" href="listagem.php?acao=excluir&idsum=<?php echo $row['idsum'] ?>"></a>
                        </td>
                      </tr>

                      <?php } ?>
                      
                    </tbody>
                  </table>
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
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
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