<?php 

  $frase = 'Agora é hora de agir!';
  $titulo = 'Estratégias';

  require_once '../menu_include.php';

  $idsum = filter_input(INPUT_GET, 'idsum', FILTER_SANITIZE_STRING);

  require_once "../../control/EstrategiaDAO.php";
  require_once "../../control/SelecionadoDAO.php";
  
  require_once "../../include/ConversaoData.php";

  $selecao = new SelecionadoDAO();
  $objetivo = $selecao->Objetivo($idsum)->fetch(PDO::FETCH_OBJ)->idobjetivo ?? 0;
  $estrategia = $selecao->Estrategia($idsum)->fetch(PDO::FETCH_OBJ)->idestrategia ?? 0;

  if($idsum == null || $idsum == 0 || $objetivo == 0)
    header("Location: ../listagem.php");

  if($estrategia == 0 || $estrategia == null)
    header("Location: ../planejamento-selecionado.php?idsum=$idsum");

  $estrategiadao = new EstrategiaDAO();
  $listagemestrategia = $estrategiadao->DadosEstrategia($idsum);

  $i = 0;

?>
      <div class="panel-header">
        <h1 class="text-center text-white">Atualizar estratégias</h1>
      </div>
      <div class="content">
        <div class="row">
          <div class="col">
            <div class="card">

              <?php 
                $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
            
                $idobjetivo = filter_input(INPUT_POST, 'idobjetivo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $local = filter_input(INPUT_POST, 'local', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $responsavel = filter_input(INPUT_POST, 'responsavel', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $valor = filter_input(INPUT_POST, 'valor', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                $cdata = new ConversaoData(); 

                if(isset($idobjetivo)){

                  $num = 0;

                  foreach ($idobjetivo as $objetivo) {

                    $valor[$i] = str_replace(['.', ','], ['', '.'], $valor[$i]) ?? 0;

                    $estrategialista = [1 => $idsum, 2 => $objetivo, 3 => utf8_decode($local[$i]), 
                                        4 => $cdata->DataEUA($data[$i]), 5 => utf8_decode($responsavel[$i]), 6 => $valor[$i], 7 => utf8_decode($status[$i])];

                    $result = $estrategiadao->AlterarEstagio($estrategialista);

                    $i++;
                  }

                  if ($result > 0) {
                    header("refresh:1,url=altestrategias.php?idsum=$idsum");
                  }

                }

              ?>

              <div class="card-header">
                <a class="btn btn-info btn-sm float-right" href="../listagem.php"> 
                  <i class="fa fa-home ml-2"></i> Voltar
                </a>
                <h5 class="title">Atualizar estratégia :)</h5>
              </div>
              <div class="card-body">
                <form method="POST">
                  <?php while ($row = $listagemestrategia->fetch(PDO::FETCH_OBJ)) { ?>
                  <div class="row mt-5">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Por que ?</label>
                        <input type="text" class="form-control" disabled value="<?php echo $estrategiadao->ObjetivoSelecionado($row->idobjetivo) ?>"  >
                        <input type="hidden" name="idobjetivo[<?php echo $i ?>]" value="<?php echo $row->idobjetivo ?>" >
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Onde ?</label>
                        <input type="text" name="local[<?php echo $i ?>]" class="form-control" placeholder="Onde ?"
                         value="<?php echo utf8_encode($row->local) ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Quando ?</label>
                        <input type="text" name="data[<?php echo $i ?>]" class="form-control date" placeholder="Quando ?"
                          value="<?php echo $cdata->DataBR($row->data) ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Por quem ?</label>
                        <input type="text" name="responsavel[<?php echo $i ?>]" class="form-control" placeholder="Por quem ?"
                        value="<?php echo utf8_encode($row->responsavel) ?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Quanto ?</label>
                        <input type="text" name="valor[<?php echo $i ?>]" class="form-control valor" placeholder="Quanto ?"
                        value="<?php echo number_format($row->valor, 2, ',', '.') ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label class="text-dark font-weight-bold">Status</label>
                        <select name="status[<?php echo $i ?>]" class="form-control">
                          <?php 
                            $status = utf8_encode($row->status);
                            echo ($status == '' || $status == null) ? 
                            "<option value=''>-- Selecione --</option>" : "<option value = $status > $status </option>" 
                          ?> 
                          <option value="Atrasado">Atrasado</option>
                          <option value="Atenção">Atenção</option>
                          <option value="Não iniciado">Não iniciado</option>
                          <option value="Em andamento">Em andamento</option>
                          <option value="Concluído">Concluído</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr class="bg-success">
                  <?php $i++; } ?>
              </div>
              <div class="card-footer">
                <div class="row justify-content-between m-0">
                  <a href="../planejamento-selecionado.php?idsum=<?php echo $idsum ?>" class="btn btn-danger">Cancelar <i class="fa fa-trash-alt ml-2"></i></a>
                  <button class="btn btn-success" name="acao" value="salvar">Atualizar <i class="fa fa-plus ml-2"></i></button>
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
  <script type="text/javascript" src="../../assets/js/jquery.maskMoney.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../../assets/js/mask/dist/jquery.mask.min.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->

  <script>
    $(document).ready(function(){
      $('.date').mask('00/00/0000');
      $('.valor').maskMoney({ decimal: ',', thousands: '.', precision: 2 });
    });
  </script>

</html>