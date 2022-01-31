<?php

namespace Controllers;


class Avis extends AbstractController
{

    protected $defaultModelName = "\Models\avis";

    /**
     *  creation d'un nouveau commentaire
     * 
     * @return void
     */

    public function new()
    {

        $id = null;
        $author = null;
        $content = null;

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }


        if (!empty($_POST['author']) && !empty($_POST['content'])) {
            $author = htmlspecialchars($_POST['author']);
            $content = htmlspecialchars($_POST['content']);
        }



        if (!$id || !$author || !$content) {
            return $this->redirect([
                'action' => 'show',
                'type' => 'velo',
                'id' => $id
            ]);
        }

        $modelVelo = new \Models\Velo();
        $velo = $modelVelo->findById($id);


        if (!$velo) {
            return $this->redirect();
        }

        $avis = new \Models\Avis();
        $avis->setVeloId($id);
        $avis->setAuthor($author);
        $avis->setContent($content);




        $this->defaultModel->save($avis);

        return $this->redirect([
            'action' => 'show',
            'type' => 'velo',
            'id' => $id
        ]);
    }

    /**
     *  supprime un avis de la DB
     * 
     * @return Response
     */
    public function delete()
    {

        $id = null;
        $veloId = null;

        if (!empty($_POST['veloId']) && ctype_digit($_POST['veloId'])) {
            $veloId = $_POST['veloId'];
        }

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }

        if (!$id) {
            die('Erreur sur ID');
        }

        $commentaire = $this->defaultModel->findById($id);


        if (!$commentaire) {
            return $this->redirect([
                'type' => 'velo',
                'action' => 'show',
                'id' => $veloId
            ]);
        }

        $this->defaultModel->remove($id);

        return $this->redirect([
            'type' => 'velo',
            'action' => 'show',
            'id' => $veloId
        ]);
    }
}
