<?php

namespace Models;


class Avis extends AbstractModel
{
    protected string $nomDeLaTable = "avis";


    protected $id;
    public function getId()
    {
        return $this->id;
    }


    protected $author;

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    protected $content;

    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }

    protected $velo_id;

    public function getVeloId()
    {
        return $this->velo_id;
    }
    public function setVeloId($velo_id)
    {
        $this->velo_id = $velo_id;
    }

    /**
     * Affiche les avis liés à un vélo
     * 
     * @param int $velo_id
     *
     * @return array|bool 
     * 
     */
    public function findAllByVelo(velo $velo)
    {


        $maRequete = $this->pdo->prepare("SELECT * FROM {$this->nomDeLaTable}
                WHERE velo_id = :velo_id");

        $maRequete->execute([
            "velo_id" => $velo->getId()
        ]);


        $avis = $maRequete->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        return $avis;
    }


    /**
     * Sauvegarde un avis dans la DB
     *
     * 
     */
    public function save($avis): void
    {


        $maRequeteCreation = $this->pdo->prepare("INSERT INTO avis (author, content, velo_id) VALUES (:author, :content, :velo_id)");

        $maRequeteCreation->execute([
            "author" => $avis->author,
            "content" => $avis->content,
            "velo_id" => $avis->velo_id
        ]);
    }
}
