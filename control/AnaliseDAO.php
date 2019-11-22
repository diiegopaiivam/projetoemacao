<?php 
  
  include "GenericDAO.php";

  class AnaliseDAO extends GenericDAO{

    //Consulta dados força
    public function DadosForca($idanalise){
        return parent::select("SELECT * FROM forca WHERE idanalise = ?",[1 =>$idanalise]);
    }

    //Consulta dados ameaca
    public function DadosAmeaca($idanalise){
        return parent::select("SELECT * FROM ameaca WHERE idanalise = ?",[1 =>$idanalise]);
    }

    //Consulta dados fraqueza
    public function DadosFraqueza($idanalise){
        return parent::select("SELECT * FROM fraqueza WHERE idanalise = ?",[1 =>$idanalise]);
    }

    //Consulta dados oportunidade
    public function DadosOportunidade($idanalise){
        return parent::select("SELECT * FROM oportunidade WHERE idanalise = ?",[1 =>$idanalise]);
    }

    //Cadastrar nova análise
    public function CadastrarAnalise($idsumario,$idanalise,$forcas,$ameacas,$fraquezas,$oportunidades){

        $i = 0;

        //verifica se array possui valores, se valores nao sao nulos e cadastra
        if (count($forcas) > 0) {
         	foreach ($forcas as $key) {
         			if($key <> null){
           			parent::save("INSERT INTO forca(idanalise, idsumario, forca)
                               VALUES (?,?,?)",[1 => $idanalise, 2 => $idsumario, 3 => $key]);

                $i++;
              }
         	}
       	} 

        //verifica se array possui valores, se valores nao sao nulos e cadastra
        if (count($ameacas) > 0) {
          foreach ($ameacas as $key) {
              if($key <> null){
                parent::save("INSERT INTO ameaca(idanalise, idsumario, ameaca)
                               VALUES (?,?,?)",[1 => $idanalise, 2 => $idsumario, 3 => $key]);
                $i++;
              }
          }
        } 

        //verifica se array possui valores, se valores nao sao nulos e cadastra
        if (count($fraquezas) > 0) {
          foreach ($fraquezas as $key) {
              if($key <> null){
                parent::save("INSERT INTO fraqueza(idanalise, idsumario, fraqueza)
                               VALUES (?,?,?)",[1 => $idanalise, 2 => $idsumario, 3 => $key]);
                $i++;
              }
          }
        } 

        //verifica se array possui valores, se valores nao sao nulos e cadastra
        if (count($oportunidades) > 0) {
          foreach ($oportunidades as $key) {
              if($key <> null){
                parent::save("INSERT INTO oportunidade(idanalise, idsumario, oportunidade)
                               VALUES (?,?,?)",[1 => $idanalise, 2 => $idsumario, 3 => $key]);
                $i++;
              }
          }
        } 

        //retorna o contador, caso seja maior que 0, ele redireciona a página para a tela alterar
        return $i;

    }

    //Deletar valor do forca da tela de editar da analise
    public function DeletarForca($idvalor){
        return parent::delete("DELETE FROM forca WHERE idforca = $idvalor");
    }

    //Deletar valor do fraqueza da tela de editar da analise
    public function DeletarFraqueza($idvalor){
        return parent::delete("DELETE FROM fraqueza WHERE idfraqueza = $idvalor");
    }

    //Deletar valor do oportundiade da tela de editar da analise
    public function DeletarOportunidade($idvalor){
        return parent::delete("DELETE FROM oportunidade WHERE idoportunidade = $idvalor");
    }

    //Deletar valor do ameaca da tela de editar da analise
    public function DeletarAmeaca($idvalor){
        return parent::delete("DELETE FROM ameaca WHERE idameaca = $idvalor");
    }

 
}
?>



