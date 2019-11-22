<!DOCTYPE html>
<html lang="pt-Br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Listagem Planejamentos
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="index.php" class="simple-text logo-mini">
          PL
        </a>
        <a href="index.php" class="simple-text logo-normal">
          Planejamento <br> em alcance
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li <?php echo $activepla ?? '';  ?> >
            <a href="listagem.php">
              <i class="now-ui-icons design_app"></i>
              <p>Plano estratégico</p>
            </a>
          </li>
          <li <?php echo $activeglo ?? ''; ?> >
            <a href="index.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Glossário Executivo</p>
            </a>
          </li>
          <li>
            <a data-toggle="modal" data-target="#faleConosco">
              <i class="now-ui-icons location_map-big"></i>
              <p>Fale conosco</p>
            </a>
            <div class="modal" id="faleConosco" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Olá tudo bem entre em contato com a gente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span>email</span><br>
                    <p class="lead mb-3"><i class="fa fa-envelope-o ml-2"></i> agilidade.evolucao@gmail.com</p>
                    <span>Rede Social</span><br> 
                      <a target="_blank" href="https://pt-br.facebook.com/casuloevolucao/"><i class="fa fa-facebook fa-2x"></i></a>
                      <a target="_blank" href="https://www.instagram.com/casulo.evolucao/"><i class="fa fa-instagram fa-2x"></i></a>
                      <a target="_blank" href="https://github.com/casuloevolucao"><i class="fa fa-github fa-2x"></i></a>
                      <a target="_blank" href="https://www.youtube.com/channel/UCp9gn-aRUUC7riTRUIgi2Ow"><i class="fa fa-youtube-play fa-2x"></i></a>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <a data-toggle="modal" data-target="#modeDeUso">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Modo de uso</p>
            </a>
            <div class="modal" id="modeDeUso" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Olá veja nosso modo de uso :)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <ul>
                      <li>1 - Cria um planejamento estratégico</li>
                      <li>2 - Cadastra a matriz SWOT</li>
                      <li>3 - Cadastra os Objetivos (Os objetivos são importantes, pois, serão preenchidos automaticamente nas telas Estratégias e Controle)</li>
                      <li>4 - Cadastrar Estratégia</li>
                      <li>5 - Cadastrar Controle</li>
                      <li>6 - O relatório estará disponível após todas as estapas estarem preenchidas</li>
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <a data-toggle="modal" data-target="#privacidade">
              <i class="now-ui-icons users_single-02"></i>
              <p>Política de privacidade</p>
            </a>
            <div class="modal" id="privacidade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Olá veja nossa politica de privacidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="active-pro">
            <a href="https://www.faculdadeevolucao.edu.br/" target="_blank">
              <p class="text-center">Copyright by &copy; TechEvolucao</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"> <?php echo isset($frase)  ? $frase : 'Compreenda mais!' ?> </a> 
          </div>
        </div>
        <a class="navbar-brand" href="#pablo"> <?php echo isset($titulo) ? $titulo :  'Página inicial' ?> </a>
      </nav>
      <!-- End Navbar -->