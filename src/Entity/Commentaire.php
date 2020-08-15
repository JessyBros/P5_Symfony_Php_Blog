<?php
namespace App\Entity;

use Exception;

class Commentaire
{
    private int $id;
    private string $auteur;
    private string $message;
    private bool $commentaire_valider;
    private int $blog_id;

      /* CONSTRUCTEUR */
      public function __construct(array $data){
        $this -> hydrate($data);
      }
  
      /* HYDRATATION */
      public function hydrate(array $data = null)
      {
        foreach ($data as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
                
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
            // On appelle le setter.
            $this->$method($value);
            }
        }
      }

     /* GETTER */
    public function getId()
    {
      return $this->id;
    }

    public function getAuteur()
    {
      return $this->auteur;
    }

    public function getMessage()
    {
      return $this->message;
    }

    public function getCommentaire_valider()
    {
      return $this->commentaire_valider;
    }

    public function getBlog_id()
    {
      return $this->blog_id;
    }

    /* SETTER */

      /* ID */
      public function setId(int $id)
    {
      $id = (int) $id;
      if (is_int($id) && $id >= 1) {
        $this->id = $id;
      } else {
        throw new Exception("L'id devrait être un entier supérieur à 0");
      }
    }

    /* AUTEUR */
    public function setAuteur(string $auteur):Commentaire
    {
      if (is_string($auteur)) {
          $this->auteur = $auteur;
          return $this;
        }
    }
    
    /* MESSAGE */
    public function setMessage(string $message):Commentaire
    {
      if (is_string($message)) {
        $this->message = $message;
        return $this;
      }
    }

    /* VALIDER */
    public function setCommentaire_valider(bool $commentaire_valider):Commentaire
    {
      if (is_bool($commentaire_valider)) {
        $this->commentaire_valider = $commentaire_valider;
        return $this;
      }
    }

    /* BLOG_ID */
    public function setBlog_id(int $blog_id)
    {
      if (is_int($blog_id) && $blog_id >= 1 ) {
        $this->blog_id = $blog_id;
        return $this;
      } 
    } 
}