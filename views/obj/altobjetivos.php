<?php 

  $frase = 'Agora é hora de agir!';
  $titulo = 'Objetivos';
  
  include '../menu_include.php';

  $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);

  require_once "../../control/ObjetivoDAO.php";
  require_once "../../control/SelecionadoDAO.php";

  $selecao = new SelecionadoDAO();
  $verifica = $selecao->Objetivo($idsum)->fetch(PDO::FETCH_OBJ)->idobjetivo ?? 0;

  if($idsum == null || $idsum == 0 || $verifica == null || $verifica == 0)
    header('Location: ../listagem.php');

?>
      <div class="panel-header">
        <h1 class="text-center text-white">Atualizar Objetivos</h1>
      </div>
      <div class="content">
        <div class="row">
          <div class="col">
            <div class="card">

              <?php 

                $objetivodao = new ObjetivoDAO();
                $listagemobjetivo = $objetivodao->DadosObjetivo($idsum);

                $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
                $acaoe = filter_input(INPUT_GET, 'acaoe', FILTER_SANITIZE_STRING);

                if ($acaoe == 'excluir') {

                    $idobjetivo = filter_input(INPUT_GET, 'idobjetivo', FILTER_VALIDATE_INT);

                    if ($idobjetivo > 0) {
                      $result = $objetivodao->DeletarObjetivo($idobjetivo);
                      header("Location: altobjetivos.php?idsum=$idsum");
                    }

                }

                if ($acao == 'alterar') {

                  $objetivos = filter_input(INPUT_POST, 'objetivos', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                  $result = $objetivodao->CadastrarObjetivo($idsum,$objetivos);

                  if ($result > 0) {
                    header("Location: altobjetivos.php?idsum=$idsum");
                  }

                }

              ?>

              <div class="card-header">
                <a class="btn btn-info btn-sm float-right" href="../listagem.php"> 
                  <i class="fa fa-home ml-2"></i> Voltar
                </a>
                <h5 class="title">Atualizar objetivos :)</h5>
                <p class="lead">
                  Aqui estarão dispostos os bjetivos a serem realizados. 
                  Esses objetivos serão utilizados no preenchimento das estratégias e controle. 
                  O preenchimento deles é obrigatório para prosseguir as etapas e 
                  finalizar o planejamento. Pois, são as diretrizes base.
                </p>
              </div>
              <div class="card-body">
                <form method="post">
                  <?php while ($row = $listagemobjetivo->fetch(PDO::FETCH_OBJ)) { ?>

                  <div class="row">
                    <div class="col-md-11">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Objetivos</label>
                        <input type="text" disabled class="form-control" 
                        value="<?php echo utf8_encode($row->objetivo) ?>" placeholder="Objetivos">
                      </div>
                    </div>
                    <div class="col-md-1 align-self-center">
                      <a class="fa fa-trash-alt fa-2x text-danger mt-3" href="altobjetivos.php?idsum=<?php echo $idsum ?>&acaoe=excluir&idobjetivo=<?php echo $row->idobjetivo ?>"></a>
                    </div>
                  </div>

                  <?php } ?>
                  <div class="row">
                    <ul id = "ul_objetivo" style = "list-style-type: none;" class="col-md-12">
                      <li>
                        <div class="row">
                          <div class="col-md-11">
                            <div class="form-group">
                              <label>Objetivos</label>
                              <input type="text" name="objetivos[0]" class="form-control" placeholder="Objetivos">
                            </div>
                          </div>
                          <div class="col-md-1 align-self-center">
                            <i onclick="addObjetivo()" class="fa fa-plus-circle fa-2x text-success mt-3"></i>
                          </div>
                        </div>
                      </li>
                    </ul>	
                  </div>
              </div>
              <div class="card-footer">
                <div class="row justify-content-between m-0">
                  <a href="../planejamento-selecionado.php?idsum=<?php echo $idsum ?>" class="btn btn-danger">Cancelar <i class="fa fa-trash-alt ml-2"></i></a>
                  <button class="btn btn-success" name="acao" value="alterar">Alterar <i class="fa fa-plus ml-2"></i></button>
                </div>
              </div>
              </form>
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
		var countObjetivos = 0;
		function addObjetivo () {
			countObjetivos++;
			$("#ul_objetivo").append(
        '<li>'+
          '<div class="row">'+
            '<div class="col-md-11">'+
              '<div class="form-group">'+
                '<label>Objetivos</label>'+
                '<input type="text" name="objetivos['+countObjetivos+']" class="form-control" placeholder="Objetivos">'+
              '</div>'+
            '</div>'+
            '<div class="col-md-1 align-self-center">'+
              '<i onclick="removerObjetivo(this);" class="fa fa-trash-alt fa-2x text-danger mt-3"></i>'+
            '</div>'+
          '</div>'+
        '</li>'
			);
		}
		function removerObjetivo(element) {
			countObjetivos--;
			$(element).closest("li").remove();
		}	
	</script>

</html>