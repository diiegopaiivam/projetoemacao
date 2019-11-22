<?php 

  $frase = 'Agora é hora de agir!';
  $titulo = 'Planejamento estratégico';
  
  include '../menu_include.php';

?>
      <div class="panel-header panel-header-sm">
      </div>
      <form method="post">
      <div class="content">
        <div class="container">
          <div class="col">
            <div class="card">

              <?php 
                 require_once "../../control/SumarioDAO.php";
                  $sumariodao = new SumarioDAO();
                  $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
                  if ($acao == 'salvar') {         
                    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
                    $razaosocial = filter_input(INPUT_POST, 'razaosocial', FILTER_SANITIZE_STRING);
                    $nomefantasia = filter_input(INPUT_POST, 'nomefantasia', FILTER_SANITIZE_STRING);
                    $segmento = filter_input(INPUT_POST, 'segmento', FILTER_SANITIZE_STRING);
                    $capitaosocial = filter_input(INPUT_POST, 'capitaosocial', FILTER_SANITIZE_STRING);
                    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
                    $missao = filter_input(INPUT_POST, 'missao', FILTER_SANITIZE_STRING);
                    $visao = filter_input(INPUT_POST, 'visao', FILTER_SANITIZE_STRING);
                    $nomeplanejamento = filter_input(INPUT_POST, 'nomeplanejamento', FILTER_SANITIZE_STRING);

                    $valor = filter_input(INPUT_POST, 'valores', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                    $capitaosocial = str_replace(['.', ','], ['', '.'], $capitaosocial);
                    
                    $cnpj = str_replace(".", "", $cnpj);
                    $cnpj = str_replace("-", "", $cnpj);
                    $cnpj = str_replace("/", "", $cnpj);

                    $sumario = array(1 => $cnpj, 2 => utf8_decode($razaosocial), 3 => utf8_decode($nomefantasia), 4 => utf8_decode($segmento), 5 => utf8_decode($capitaosocial), 6 => utf8_decode($endereco), 7 => utf8_decode($missao), 8 => utf8_decode($visao), 9 => utf8_decode($nomeplanejamento));

                    $result = $sumariodao->CadastrarSumario($sumario,$valor);

                    if($result)
                    {
                      echo "<div class='alert alert-success'>
                          <button type='button' aria-hidden='true' class='close' data-dismiss='alert' aria-label='Close'>
                            <i class='now-ui-icons ui-1_simple-remove'></i>
                          </button>
                          <span>Salvo com sucesso.</span>
                        </div>";
                    }

                  }

              ?>

              <div class="card-header">
                <a class="btn btn-info btn-sm float-right" href="../listagem.php"> 
                  <i class="fa fa-home ml-2"></i> Voltar
                </a>
                <h5 class="title">Cadastrar um novo Planejamento :)</h5>
              </div>

              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Título planejamento</label>
                        <input type="text" name="nomeplanejamento" class="form-control" placeholder="Digite um Título para seu planejamento" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">CNPJ</label>
                        <input type="text" name="cnpj" class="form-control cnpj" placeholder="cnpj" required>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Razão Social</label>
                        <input type="text" name="razaosocial" class="form-control" placeholder="Razão Social" required>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Nome Fantasia</label>
                        <input type="text" name="nomefantasia" class="form-control" placeholder="Nome Fantasia" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Segmento</label>
                        <input type="text" name="segmento" class="form-control" placeholder="Segmento">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Capital Social</label>
                        <input type="text" name="capitaosocial" class="form-control" placeholder="Capital Social">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Endereço</label>
                        <input type="text" name="endereco" class="form-control" placeholder="Endereço">
                      </div>
                    </div>
                  </div>
                  <hr class="mt-4 mb-4 bg-dark">
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Missão</label>
                        <input type="text" name="missao" class="form-control" placeholder="Missão">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Visão</label>
                        <input type="text" name="visao" class="form-control" placeholder="Visão">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <ul id = "ul_valores" style = "list-style-type: none;" class="col-md-12">
                      <li>
                        <div class="row">
                          <div class="col-md-11">
                            <div class="form-group">
                              <label class="text-dark font-weight-bold">Valores</label>
                              <input type="text" name="valores[0]" class="form-control" placeholder="Valores">
                            </div>
                          </div>
                          <div class="col-md-1 align-self-center">
                            <i onclick="addValor()" class="fa fa-plus-circle fa-2x text-success mt-3"></i>
                          </div>
                        </div>
                      </li>
                    </ul>	
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row justify-content-between m-0">
                  <a class="btn btn-danger" href="listagem.php">Cancelar <i class="fa fa-trash-alt ml-2"></i></a>
                  <button class="btn btn-success" name="acao" value="salvar">Cadastrar <i class="fa fa-plus ml-2"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
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
  <script src="../../assets/js/mask/dist/jquery.mask.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../../assets/js/plugins/chartjs.min.js"></script>
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
  <script>
    $(document).ready(function(){
      $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    });
  </script>
  <script>
		var countValores = 0;
		function addValor () {
			countValores++;
			$("#ul_valores").append(
        '<li>'+
          '<div class="row">'+
            '<div class="col-md-11">'+
              '<div class="form-group">'+
                '<label class="text-dark font-weight-bold">Valores</label>'+
                '<input type="text" name="valores['+countValores+']" class="form-control" placeholder="Valores">'+
              '</div>'+
            '</div>'+
            '<div class="col-md-1 align-self-center">'+
              '<i onclick="removerValores(this);" class="fa fa-trash-alt fa-2x text-danger mt-3"></i>'+
            '</div>'+
          '</div>'+
        '</li>'
			);
		}
		function removerValores (element) {
			countValores--;
			$(element).closest("li").remove();
		}	
	</script>

</html>