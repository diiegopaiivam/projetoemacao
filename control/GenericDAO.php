<?php

include 'Conexao.php';

class GenericDAO
{
    public $pdo = null;
    // construtor
    function __construct(){
        $this->pdo = new Conexao();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function select($query, $campos)
    {

        try {

            $stmt = $this->pdo->prepare($query);
            $sum = 0;

            if (isset($campos[0]) && !empty($campos[0])) {
                $sum = 1;
            }

            foreach ($campos as $i => $parametros) {

                $stmt->bindValue($i + $sum, $parametros);
            }

            $stmt->execute();

            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }


    public function selectAll($query)
    {
        try {

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function delete($query)
    {
        try {

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function save($query, $campos)
    {//passa array normal, sem indicar localização
        try {

            $stmt = $this->pdo->prepare($query);
            $sum = 0;

            if (isset($campos[0]) && !empty($campos[0])) {
                $sum = 1;
            }

            foreach ($campos as $i => $parametros) {

                $stmt->bindValue($i + $sum, $parametros);
            }

            $stmt->execute();

            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function saveAll($query)
    {
        try {

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function saveReturnId($query, $campos)
    {//passa array normal, sem indicar localização
        try {

            $stmt = $this->pdo->prepare($query);
            $sum = 0;

            if (isset($campos[0]) && !empty($campos[0])) {
                $sum = 1;
            }

            foreach ($campos as $i => $parametros) {

                $stmt->bindValue($i + $sum, $parametros);
            }

            $stmt->execute();

            return $this->pdo->lastInsertId();

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function Update($query, $campos)
    {

        try {
            $sum = 0;
            if (isset($campos[0]) && !empty($campos[0])) {
                $sum = 1;
            }

            $stmt = $this->pdo->prepare($query);
            foreach ($campos as $i => $parametros) {
                $stmt->bindValue($i + $sum, $parametros);
            }

            $stmt->execute();

            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function updateAll($query)
    {
        try {

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function verificaColuna($user, $tabela, $coluna)
    {
        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->pdo->prepare("SELECT COUNT(COLUMN_NAME) AS qtd FROM INFORMATION_SCHEMA.COLUMNS
                                                    WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND  COLUMN_NAME = ?");
            $stmt->bindValue(1, $user."_sgae");
            $stmt->bindValue(2, $tabela);
            $stmt->bindValue(3, $coluna);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if ($data->qtd > 0) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    /**
     * Get the value of pdo
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}

?>