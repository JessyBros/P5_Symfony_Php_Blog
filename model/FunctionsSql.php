<?php

class FunctionsSql extends Manager
{

	 public function lesDerniersBlogs()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT * FROM blog  ORDER BY id DESC  LIMIT 4 ');
        return $req;
    }

}