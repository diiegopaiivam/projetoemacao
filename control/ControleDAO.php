<?php 
  
  include "GenericDAO.php";

  class ControleDAO extends GenericDAO{
    
    public function DadosObjetivo($idsumario){
        return parent::select("SELECT * FROM objetivo WHERE idsumario = ?",[1 =>$idsumario]);
    }

    //Cadastrar nova objetivo
    public function CadastrarControle($controle){

        $i = 0;
        $num = 0;
        $verify = 0;
        $cont = count($controle);

        //verifica se array possui valores, se valores nao sao nulos e cadastra
        if ($cont > 0) {
        		
        	while ($num < $cont) {
        		if($controle[$num] <> null)
        			$verify++;

        		$num++;
        	}

         	if ($verify > 0) {
           			parent::save("INSERT INTO controle(idsumario, idobjetivo, perspectiva, indicadores, meta, acoes)
                               VALUES (?,?,?,?,?,?)",$controle);
         	}


         	return $verify;
         	
       	} 

        //retorna o contador, caso seja maior que 0, ele redireciona a página para a tela alterar
        return $verify;

    }

    //Cadastrar nova objetivo
	public function AlterarControle($controle){

	        $i = 0;
	        $num = 0;
	        $verify = 0;
	        $cont = count($controle);

	        //verifica se array possui valores, se valores nao sao nulos e cadastra
	        if ($cont > 0) {
	        		
	        	while ($num < $cont) {
	        		if($controle[$num] <> null)
	        			$verify++;

	        		$num++;
	        	}

	         	if ($verify > 0) {

	         			$contador = parent::selectAll("SELECT idobjetivo FROM controle WHERE idobjetivo = $controle[2]")->fetch(PDO::FETCH_OBJ)->idobjetivo;

	         			if($contador > 0){
	         				parent::Update("UPDATE controle SET perspectiva = ?, indicadores = ?, meta = ?, acoes = ? WHERE idobjetivo = ?",[1 => $controle[3] ,2 => $controle[4], 3 => $controle[5], 4 => $controle[6], 5 => $controle[2]]);
	         			} else {
	         				parent::save("INSERT INTO controle(idsumario, idobjetivo, perspectiva, indicadores, meta, acoes)
                               VALUES (?,?,?,?,?,?)",$controle);
	         			}

	           			
	         	}


	         	return $verify;
	         	
	       	} 

	        //retorna o contador, caso seja maior que 0, ele redireciona a página para a tela alterar
	        return $verify;

	    }

 
   }	
?>



