<?php

namespace App;

class Response
{




    /**
     * 
     *  redirige vers l'url passée en parametre
     * 
     * @param string $url
     * 
     * @return void
     * 
     */


    public static function redirect(?array $parametres = null)
    {

        $url = "index.php";
        if ($parametres) {
            $url = "?";
            foreach ($parametres as $cle => $valeur) {
                $nouveauParaGet = $cle . "=" . $valeur . "&";
                $url .= $nouveauParaGet;
            }
            header("Location: " . $url);
        }
    }
}
