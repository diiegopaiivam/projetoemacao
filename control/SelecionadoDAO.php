<?php 

  class SelecionadoDAO extends GenericDAO{
    
    //Seleciona o nome da empresa
    public function Empresa($idsum){
        return parent::select("SELECT nomefantasia FROM sumarioexecutivo WHERE idsum = ?",[1 =>$idsum]);
    } 

    //verifica se tem análise
    public function Analise($idsum){
        return parent::select("SELECT idanalise FROM analise WHERE idsumario = ?",[1 =>$idsum]);
    }

    //verifica se tem análise
    public function Forca($idsum){
        return parent::select("SELECT idforca FROM forca WHERE idsumario = ?",[1 =>$idsum]);
    }

    //verifica se tem análise
    public function Ameaca($idsum){
        return parent::select("SELECT idameaca FROM ameaca WHERE idsumario = ?",[1 =>$idsum]);
    }

    //verifica se tem análise
    public function Fraqueza($idsum){
        return parent::select("SELECT idfraqueza FROM fraqueza WHERE idsumario = ?",[1 =>$idsum]);
    }

    //verifica se tem análise
    public function Oportunidade($idsum){
        return parent::select("SELECT idoportunidade FROM oportunidade WHERE idsumario = ?",[1 =>$idsum]);
    } 

    public function Objetivo($idsum){
        return parent::select("SELECT idobjetivo FROM objetivo WHERE idsumario = ?",[1 =>$idsum]);
    } 

    public function Estrategia($idsum){
        return parent::select("SELECT idestrategia FROM estrategia WHERE idsumario = ?",[1 =>$idsum]);
    } 

    public function Controle($idsum){
        return parent::select("SELECT idcontrole FROM controle WHERE idsumario = ?",[1 =>$idsum]);
    } 
  
  }
?>



