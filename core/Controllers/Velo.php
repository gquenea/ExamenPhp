<?php

namespace Controllers;

class Velo extends AbstractController
{

    protected $defaultModelName = \Models\Velo::class;

    /**
     *  affiche tous les vélos
     * 
     * @return void
     */

    public function index()
    {


        $velos = $this->defaultModel->findAll();


        return $this->render("velos/index", [
            "pageTitle" => "Tous les vélos",
            "velos" => $velos
        ]);
    }

    /**
     *  affiche un seul vélo
     * 
     * @return void
     */

    public function show()
    {

        $id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (!$id) {
            return $this->redirect();
        }


        $velo = $this->defaultModel->findById($id);

        if (!$velo) {
            return $this->redirect();
        }

        $modelVelo = new \Models\avis();

        $avis = $modelVelo->findAllByVelo($velo);




        return $this->render("velos/show", [
            "pageTitle" => $velo->getName(),
            "velo" => $velo,
            "avis" => $avis
        ]);
    }




    /**
     *  Creer un nouveau vélo
     * 
     * @return void
     */
    public function new()
    {


        $name = null;
        $description = null;
        $image = null;
        $price = null;

        if (!empty($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
        }
        if (!empty($_POST['description'])) {
            $description = htmlspecialchars($_POST['description']);
        }
        if (!empty($_POST['image'])) {
            $image = htmlspecialchars($_POST['image']);
        }
        if (!empty($_POST['price']) && ctype_digit($_POST['price'])) {
            $price = $_POST['price'];
        }

        if ($name && $description && $image && $price) {

            $velo = new \Models\Velo();
            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setImage($image);
            $velo->setPrice($price);



            $this->defaultModel->save($velo);
            return $this->redirect([
                'type' => 'velo',
                'action' => 'index'
            ]);
        }


        return $this->render("velos/create", [
            "pageTitle" => "Nouveau Velo"
        ]);
    }


    /**
     *  supprimer un velo de la DB
     * 
     * @return Response
     */
    public function delete()

    {

        $id = null;
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }
        if (!$id) {
            return $this->redirect();
        }
        if (!$this->defaultModel->findById($id)) {
            return $this->redirect();
        }

        $this->defaultModel->remove($id);

        return $this->redirect([
            'type' => 'velo',
            'action' => 'index'
        ]);
    }
}
