<?php

class ConversaoData{

  public function DataEUA($data){

    if(empty($data) || $data =='' || $data=='dd/mm/aaaa' ){
      return NULL;
    }else{
      if(substr($data,2,1)=='/'){

        $diadata = substr($data,0,2);
        $mesdata = substr($data,3,2);
        $anodata = substr($data,6,4);
        $data = $anodata."-".$mesdata."-".$diadata;
      }else{
        $data = explode("-",$data);
        $dia = $data[2];
        $mes = $data[1];
        $ano = $data[0];
        $data = $dia."/".$mes."/".$ano;

        $diadata = substr($data,0,2);
        $mesdata = substr($data,3,2);
        $anodata = substr($data,6,4);
        $data = $anodata."-".$mesdata."-".$diadata;
      }

      $checardata = checkdate($mesdata, $diadata, $anodata);

      if($checardata==1){
        return $data;
      }else{
        return NULL;
      }
    }
  }
  public function DataBR($data){
    if(empty($data)){
      return NULL;
    }else{
      $data = explode("-",$data);
      $dia = $data[2];
      $mes = $data[1];
      $ano = $data[0];
      $data = $dia."/".$mes."/".$ano;

      return $data;
    }    
  }
}