<?php 
  
  include "GenericDAO.php";

	class EstrategiaDAO extends GenericDAO{

		//Consulta dados objetivo
		public function DadosEstrategia($idsumario){
			return parent::select("SELECT * FROM estrategia WHERE idsumario = ?",[1 =>$idsumario]);
		}

		public function ObjetivoSelecionado($objetivo){
			return parent::select("SELECT objetivo FROM objetivo WHERE idobjetivo = ?",[1 =>$objetivo])->fetch(PDO::FETCH_OBJ)->objetivo;
		}

		public function DadosObjetivo($idsumario){
	        return parent::select("SELECT * FROM objetivo WHERE idsumario = ?",[1 =>$idsumario]);
	    }

		//Cadastrar nova objetivo
	    public function CadastrarEstagio($estrategia){

	        $i = 0;
	        $num = 0;
	        $verify = 0;
	        $cont = count($estrategia);

	        //verifica se array possui valores, se valores nao sao nulos e cadastra
	        if ($cont > 0) {
	        		
	        	while ($num < $cont) {
	        		if($estrategia[$num] <> null)
	        			$verify++;

	        		$num++;
	        	}

	         	if ($verify > 0) {
	           			parent::save("INSERT INTO estrategia(idsumario, idobjetivo, local, data, responsavel, valor, status)
	                               VALUES (?,?,?,?,?,?,?)",$estrategia);
	         	}


	         	return $verify;
	         	
	       	} 

	        //retorna o contador, caso seja maior que 0, ele redireciona a página para a tela alterar
	        return $verify;

	    }

	    //Cadastrar nova objetivo
	    public function AlterarEstagio($estrategia){

	        $i = 0;
	        $num = 0;
	        $verify = 0;
	        $cont = count($estrategia);

	        //verifica se array possui valores, se valores nao sao nulos e cadastra
	        if ($cont > 0) {
	        		
	        	while ($num < $cont) {
	        		if($estrategia[$num] <> null)
	        			$verify++;

	        		$num++;
	        	}

	         	if ($verify > 0) {

	         			$contador = parent::selectAll("SELECT idobjetivo FROM estrategia WHERE idobjetivo = $estrategia[2]")->fetch(PDO::FETCH_OBJ)->idobjetivo;

	         			if($contador > 0){
	         				parent::Update("UPDATE estrategia SET local = ?, data = ?, responsavel = ?, valor = ?, status = ?
	         								WHERE idobjetivo = ?",
	         				[1 => $estrategia[3] ,2 => $estrategia[4], 3 => $estrategia[5], 4 => $estrategia[6], 5 => $estrategia[7], 6 => $estrategia[2]]);
	         			} else {
	         				parent::save("INSERT INTO estrategia(idsumario, idobjetivo, local, data, responsavel, valor, status)
	                               VALUES (?,?,?,?,?,?,?)",$estrategia);	
	         			}

	           			
	         	}


	         	return $verify;
	         	
	       	} 

	        //retorna o contador, caso seja maior que 0, ele redireciona a página para a tela alterar
	        return $verify;

	    }


	}
?>



