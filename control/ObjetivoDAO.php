<?php 
  
  include "GenericDAO.php";

  class ObjetivoDAO extends GenericDAO{

    //Consulta dados objetivo
    public function DadosObjetivo($idsumario){
        return parent::select("SELECT * FROM objetivo WHERE idsumario = ?",[1 =>$idsumario]);
    }

    //Cadastrar nova objetivo
    public function CadastrarObjetivo($idsumario,$objetivos){

        $i = 0;

        //verifica se array possui valores, se valores nao sao nulos e cadastra
        if (count($objetivos) > 0) {
         	foreach ($objetivos as $key) {
         			if($key <> null){
           			parent::save("INSERT INTO objetivo(idsumario, objetivo)
                               VALUES (?,?)",[1 => $idsumario, 2 => $key]);

                $i++;
              }
         	}
       	} 

        //retorna o contador, caso seja maior que 0, ele redireciona a página para a tela alterar
        return $i;

    }

    //Deletar valor do objetivo da tela de editar
    public function DeletarObjetivo($idvalor){
        return parent::delete("DELETE FROM objetivo WHERE idobjetivo = $idvalor");
    }



 
}
?>



