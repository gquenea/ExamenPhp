<?php

namespace Models;

require_once "core/Database/PdoMYSQL.php";

abstract class AbstractModel
{
    protected string $nomDeLaTable;
    protected $pdo;
    public function __construct()
    {
        $this->pdo = \Database\PdoMySQL::getPdo();
    }

    /**
     * 
     * retourne un tableau contenant TOUS les elements
     * 
     * @return array $elements
     * 
     * 
     */
    public function findAll(): array
    {


        $requete = $this->pdo->query("SELECT * FROM {$this->nomDeLaTable}");

        $elements = $requete->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        return $elements;
    }


    /**
     * 
     * trouver un cocktail par son id
     * renvoie un tableau contenant un element
     * 
     * @param integer $id
     * @return array|bool
     * 
     */
    public function findById(int $id)
    {

        $maRequete = $this->pdo->prepare("SELECT * 
                        FROM {$this->nomDeLaTable} WHERE id = :id");

        $maRequete->execute(
            [
                "id" => $id
            ]

        );


        $maRequete->setFetchMode(\PDO::FETCH_CLASS, get_class($this));

        $element = $maRequete->fetch();

        return $element;
    }




    /**
     * Supprime un element de la BDD
     * @param int $id
     *
     * 
     */
    public function remove(int $id): void
    {


        $maRequeteDelete = $this->pdo->prepare("DELETE FROM {$this->nomDeLaTable} WHERE id = :id");
        $maRequeteDelete->execute([
            "id" => $id
        ]);
    }
}
