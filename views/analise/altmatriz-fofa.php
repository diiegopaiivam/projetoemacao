<?php 
  
  $frase = 'Agora é hora de agir!';
  $titulo = 'Análise Ambiental';

  include '../menu_include.php';

  $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);
  $idanalise = filter_input(INPUT_GET, 'idanalise', FILTER_SANITIZE_STRING);

  if($idsum == null || $idsum == 0 || $idanalise == null || $idanalise == 0)
    header('Location: ../listagem.php');

?>
      <div class="panel-header">
        <h1 class="text-center text-white">Atualizar Matriz <br> Fofa</h1>
      </div>
      <div class="content">
        <div class="row">
          Para excluir, basta clicar na lixeira. Para salvar um novo valor, é necessário clicar no botão alterar.
        </div>
        <div class="row">
          <div class="col">
            <div class="card">

              <?php 

                require_once "../../control/AnaliseDAO.php";

                $analisedao = new AnaliseDAO();
                $listagemforca = $analisedao->DadosForca($idanalise);
                $listagemameaca = $analisedao->DadosAmeaca($idanalise);
                $listagemoportunidade = $analisedao->DadosOportunidade($idanalise);
                $listagemfraqueza = $analisedao->DadosFraqueza($idanalise);

                $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
                $acaoe = filter_input(INPUT_GET, 'acaoe', FILTER_SANITIZE_STRING);

                if ($acaoe == 'excluir') {

                    $idforca = filter_input(INPUT_GET, 'idforca', FILTER_VALIDATE_INT);
                    $idfraqueza = filter_input(INPUT_GET, 'idfraqueza', FILTER_VALIDATE_INT);
                    $idameaca = filter_input(INPUT_GET, 'idameaca', FILTER_VALIDATE_INT);
                    $idoportunidade = filter_input(INPUT_GET, 'idoportunidade', FILTER_VALIDATE_INT);

                    if ($idforca > 0) {
                      $result = $analisedao->DeletarForca($idforca);
                      header("Location: altmatriz-fofa.php?idsum=$idsum&idanalise=$idanalise");
                    }

                    else if ($idfraqueza > 0) {
                      $result = $analisedao->DeletarFraqueza($idfraqueza);
                      header("Location: altmatriz-fofa.php?idsum=$idsum&idanalise=$idanalise");
                    }

                    else if ($idoportunidade > 0) {
                      $result = $analisedao->DeletarOportunidade($idoportunidade);
                      header("Location: altmatriz-fofa.php?idsum=$idsum&idanalise=$idanalise");
                    }

                    else if ($idameaca > 0) {
                      $result = $analisedao->DeletarAmeaca($idameaca);
                      header("Location: altmatriz-fofa.php?idsum=$idsum&idanalise=$idanalise");
                    }

                }

                if ($acao == 'alterar') {

                  $forcas = filter_input(INPUT_POST, 'forcas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                  $ameacas = filter_input(INPUT_POST, 'ameacas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                  $fraquezas = filter_input(INPUT_POST, 'fraquezas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                  $oportunidades = filter_input(INPUT_POST, 'oportunidades', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                  $result = $analisedao->CadastrarAnalise($idsum,$idanalise,$forcas,$ameacas,$fraquezas,$oportunidades);

                  if ($result > 0) {
                    header("Location: altmatriz-fofa.php?idsum=$idsum&idanalise=$idanalise");
                  }

                }

              ?>

              <div class="card-header">
                <a class="btn btn-info btn-sm float-right" href="../listagem.php"> 
                  <i class="fa fa-home ml-2"></i> Voltar
                </a>
                <h5 class="title">Atualizar Matriz :)</h5>
              </div>
              <div class="card-body">
                <form method="post">

                  <?php while ($row = $listagemforca->fetch(PDO::FETCH_OBJ)) { ?>

                  <div class="row">
                    <div class="col-md-11">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Forças</label>
                        <input type="text" disabled class="form-control" 
                        value="<?php echo utf8_encode($row->forca) ?>" placeholder="Forças">
                      </div>
                    </div>
                    <div class="col-md-1 align-self-center">
                      <a class="fa fa-trash-alt fa-2x text-danger mt-3" href="altmatriz-fofa.php?idsum=<?php echo $idsum ?>&acaoe=excluir&idanalise=<?php echo $idanalise ?>&idforca=<?php echo $row->idforca ?>"></a>
                    </div>
                  </div>

                  <?php } ?>


                  <div class="row">
                    <ul id = "ul_forca" style = "list-style-type: none;" class="col-md-12">
                      <li>
                        <div class="row">
                          <div class="col-md-11">
                            <div class="form-group">
                              <label>Forças</label>
                              <input type="text" name="forcas[0]" class="form-control" placeholder="Forças">
                            </div>
                          </div>
                          <div class="col-md-1 align-self-center">
                            <i onclick="addForca()" class="fa fa-plus-circle fa-2x text-success mt-3"></i>
                          </div>
                        </div>
                      </li>
                    </ul>	
                  </div>

                  <?php while ($row = $listagemfraqueza->fetch(PDO::FETCH_OBJ)) { ?>

                  <div class="row">
                    <div class="col-md-11">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Fraquezas</label>
                        <input type="text" disabled class="form-control" 
                        value="<?php echo utf8_encode($row->fraqueza) ?>" placeholder="Fraquezas">
                      </div>
                    </div>
                    <div class="col-md-1 align-self-center">
                      <a class="fa fa-trash-alt fa-2x text-danger mt-3" href="altmatriz-fofa.php?idsum=<?php echo $idsum ?>&acaoe=excluir&idanalise=<?php echo $idanalise ?>&idfraqueza=<?php echo $row->idfraqueza ?>"></a>
                    </div>
                  </div>

                  <?php } ?>

                  <div class="row">
                      <ul id = "ul_fraqueza" style = "list-style-type: none;" class="col-md-12">
                        <li>
                          <div class="row">
                            <div class="col-md-11">
                              <div class="form-group">
                                <label>Fraquezas</label>
                                <input type="text" name="fraquezas[0]" class="form-control" placeholder="Fraquezas">
                              </div>
                            </div>
                            <div class="col-md-1 align-self-center">
                              <i onclick="addFraqueza()" class="fa fa-plus-circle fa-2x text-success mt-3"></i>
                            </div>
                          </div>
                        </li>
                      </ul>	
                    </div>

                    <?php while ($row = $listagemoportunidade->fetch(PDO::FETCH_OBJ)) { ?>

                    <div class="row">
                      <div class="col-md-11">
                        <div class="form-group">
                          <label class="text-dark font-weight-bold">Oportunidades</label>
                          <input type="text" disabled class="form-control" 
                          value="<?php echo utf8_encode($row->oportunidade) ?>" placeholder="Oportunidades">
                        </div>
                      </div>
                      <div class="col-md-1 align-self-center">
                        <a class="fa fa-trash-alt fa-2x text-danger mt-3" href="altmatriz-fofa.php?idsum=<?php echo $idsum ?>&acaoe=excluir&idanalise=<?php echo $idanalise ?>&idoportunidade=<?php echo $row->idoportunidade ?>"></a>
                      </div>
                    </div>

                    <?php } ?>

                    <div class="row">
                      <ul id = "ul_oportunidade" style = "list-style-type: none;" class="col-md-12">
                        <li>
                          <div class="row">
                            <div class="col-md-11">
                              <div class="form-group">
                                <label>Oportunidades</label>
                                <input type="text" name="oportunidades[0]" class="form-control" placeholder="Oportunidades">
                              </div>
                            </div>
                            <div class="col-md-1 align-self-center">
                              <i onclick="addOportunidade()" class="fa fa-plus-circle fa-2x text-success mt-3"></i>
                            </div>
                          </div>
                        </li>
                      </ul>	
                    </div>

                    <?php while ($row = $listagemameaca->fetch(PDO::FETCH_OBJ)) { ?>

                    <div class="row">
                      <div class="col-md-11">
                        <div class="form-group">
                          <label class="text-dark font-weight-bold">Ameaças</label>
                          <input type="text" disabled class="form-control" 
                          value="<?php echo utf8_encode($row->ameaca) ?>" placeholder="Ameaças">
                        </div>
                      </div>
                      <div class="col-md-1 align-self-center">
                        <a class="fa fa-trash-alt fa-2x text-danger mt-3" href="altmatriz-fofa.php?idsum=<?php echo $idsum ?>&acaoe=excluir&idanalise=<?php echo $idanalise ?>&idameaca=<?php echo $row->idameaca ?>"></a>
                      </div>
                    </div>

                    <?php } ?>

                    <div class="row">
                      <ul id = "ul_ameaca" style = "list-style-type: none;" class="col-md-12">
                        <li>
                          <div class="row">
                            <div class="col-md-11">
                              <div class="form-group">
                                <label>Ameaças</label>
                                <input type="text" name="ameacas[0]" class="form-control" placeholder="Ameaças">
                              </div>
                            </div>
                            <div class="col-md-1 align-self-center">
                              <i onclick="addAmeaca()" class="fa fa-plus-circle fa-2x text-success mt-3"></i>
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
  <script>
    var countForca = 0;
    function addForca () {
      countForca++;
      $("#ul_forca").append(
        '<li>'+
          '<div class="row">'+
            '<div class="col-md-11">'+
              '<div class="form-group">'+
                '<label>Forças</label>'+
                '<input type="text" name="forcas['+countForca+']" class="form-control" placeholder="Forças">'+
              '</div>'+
            '</div>'+
            '<div class="col-md-1 align-self-center">'+
              '<i onclick="removerForca(this);" class="fa fa-trash-alt fa-2x text-danger mt-3"></i>'+
            '</div>'+
          '</div>'+
        '</li>'
      );
    }
    function removerForca (element) {
      countForca--;
      $(element).closest("li").remove();
    }	
  </script>
  <script>
    var countFraqueza = 0;
    function addFraqueza () {
      countFraqueza++;
      $("#ul_fraqueza").append(
        '<li>'+
          '<div class="row">'+
            '<div class="col-md-11">'+
              '<div class="form-group">'+
                '<label>Fraquezas</label>'+
                '<input type="text" name="fraquezas['+countFraqueza+']" class="form-control" placeholder="Fraquezas">'+
              '</div>'+
            '</div>'+
            '<div class="col-md-1 align-self-center">'+
              '<i onclick="removerFraqueza(this);" class="fa fa-trash-alt fa-2x text-danger mt-3"></i>'+
            '</div>'+
          '</div>'+
        '</li>'
      );
    }
    function removerFraqueza(element) {
      countFraqueza--;
      $(element).closest("li").remove();
    }	
  </script>
  <script>
    var countOportunidade = 0;
    function addOportunidade () {
      countOportunidade++;
      $("#ul_oportunidade").append(
        '<li>'+
          '<div class="row">'+
            '<div class="col-md-11">'+
              '<div class="form-group">'+
                '<label>Oportunidades</label>'+
                '<input type="text" name="oportunidades['+countOportunidade+']" class="form-control" placeholder="Oportunidades">'+
              '</div>'+
            '</div>'+
            '<div class="col-md-1 align-self-center">'+
              '<i onclick="removerOportunidade(this);" class="fa fa-trash-alt fa-2x text-danger mt-3"></i>'+
            '</div>'+
          '</div>'+
        '</li>'
      );
    }
    function removerOportunidade (element) {
      countOportunidade--;
      $(element).closest("li").remove();
    }	
  </script>
  <script>
      var countAmeaca = 0;
      function addAmeaca () {
        countAmeaca++;
        $("#ul_ameaca").append(
          '<li>'+
            '<div class="row">'+
              '<div class="col-md-11">'+
                '<div class="form-group">'+
                  '<label>Ameaças</label>'+
                  '<input type="text" name="ameacas['+countAmeaca+']" class="form-control" placeholder="Ameaças">'+
                '</div>'+
              '</div>'+
              '<div class="col-md-1 align-self-center">'+
                '<i onclick="removerAmeaca(this);" class="fa fa-trash-alt fa-2x text-danger mt-3"></i>'+
              '</div>'+
            '</div>'+
          '</li>'
        );
      }
      function removerAmeaca (element) {
        countAmeaca--;
        $(element).closest("li").remove();
      }	
    </script>
</html>