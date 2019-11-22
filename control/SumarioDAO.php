<?php 
  
  include "GenericDAO.php";

  class SumarioDAO extends GenericDAO{
    
    //Listar planejamentos cadastrados
    public function ListagemPlanejamentos(){
       	return parent::selectAll("SELECT * FROM sumarioexecutivo");
    }

    //Dados do sumário para tela de editar
    public function DadosSumario($idsum){
       	return parent::select("SELECT * FROM sumarioexecutivo WHERE idsum = ?",[1 =>$idsum]);
    }

    //Dados dos valores do súmário selecionado para tela de editar
    public function DadosValor($idsum){
       	return parent::select("SELECT * FROM valor WHERE idsumario = ?",[1 =>$idsum]);
    }

    //Deletar valor do sumário da tela de editar
    public function DeletarValor($idvalor){
       	return parent::delete("DELETE FROM valor WHERE idvalor = $idvalor");
    }



    //Cadastrar novo sumário executivo
    public function CadastrarSumario($sumario,$valores){

       	parent::save("INSERT INTO sumarioexecutivo(emissao, cnpj, razaosocial, nomefantasia, segmento, capitaosocial, endereco, missao, visao, nomeplanejamento)
                           VALUES (now(),?,?,?,?,?,?,?,?,?)",$sumario);
       	
        $cnpj = $sumario[1];
        $query = "SELECT MAX(idsum) AS idsum FROM sumarioexecutivo WHERE cnpj = ?";
        $idsum = parent::select($query,[1 => $cnpj])->fetch(PDO::FETCH_OBJ)->idsum;

        parent::saveAll("INSERT INTO analise(emissao, idsumario)
                         VALUES (now(),$idsum)");
       	

        if (count($valores) > 0) {

       		foreach ($valores as $key) {
       			if($key <> null){
         			parent::save("INSERT INTO valor(emissao, valor, idsumario)
                             VALUES (now(),?,?)",[1 => $key, 2 => $idsum]);
            }
       			
       		}


       	} 

        return true;

    }

    //Editar sumário executivo
    public function AtualizarSumario($sumario){

       return	parent::Update("UPDATE sumarioexecutivo 
       					   SET emissao = NOW(), cnpj = ?, razaosocial = ?, nomefantasia = ?, segmento = ?, capitaosocial = ?, endereco = ?, missao = ?, visao = ?, nomeplanejamento = ? 
       					 WHERE idsum = ?",$sumario);
       	

    }

    // Deletar sumário executivo
    public function Deletar($idsum){
        try
        {

        	//Consulta se há algum registro na análise ambiental ou nos objetivos
        	$forca = parent::select("SELECT * FROM forca WHERE idsumario = ?",[1 => $idsum])->rowCount();
        	$fraqueza = parent::select("SELECT * FROM fraqueza WHERE idsumario = ?",[1 => $idsum])->rowCount();
        	$oportunidade = parent::select("SELECT * FROM oportunidade WHERE idsumario = ?",[1 => $idsum])->rowCount();
        	$ameaca = parent::select("SELECT * FROM ameaca WHERE idsumario = ?",[1 => $idsum])->rowCount();
        	$objetivo = parent::select("SELECT * FROM objetivo WHERE idsumario = ?",[1 => $idsum])->rowCount();
        	//fim consulta
            
            //verifica se não tem registro, se não tiver exclui
            if ($forca == 0 && $fraqueza == 0 && $oportunidade == 0 && $ameaca == 0 && $objetivo == 0) {

              $pdo = parent::getPdo();
              $query = "DELETE FROM valor WHERE idsumario = ? ";
              $stmtvalor = $pdo->prepare($query);
              $stmtvalor->bindValue(1,$idsum);
              $stmtvalor->execute();

            	
	            $query = "DELETE FROM sumarioexecutivo WHERE idsum = ? ";
	            $stmt = $pdo->prepare($query);
	            $stmt->bindValue(1,$idsum);
	            $stmt->execute();

              return true;

            } else {
            	echo "Negado, planejamento com histórico!";
            }

            
        }catch( PDOException $e )
        {   
            echo $e->getMessage();
        }
            
    }

 
}
?>



