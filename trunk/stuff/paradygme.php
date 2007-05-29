<?php
  /* Test du paradygme de chéplukoi pour la programmation objet
  */
  class myClass {
    protected $variable;
    protected static $instance;
    
    protected function __construct() {
      $this->variable="Une chaîne";
      //$this->instance=null;
      echo "Constructeur !!!\n";
    }

    public function getInstance() {
      if (myClass::$instance==null) {
        myClass::$instance=new myClass();
      }
      return myClass::$instance;
    }

    public function setVariable($chaine) {
      $this->variable=$chaine;
    }

    public function getVariable(){
      return $this->variable;
    }
  }

  // Impossible !!!
  //echo "Appel constructeur normal : \n";
  //$toto=new myClass();

  echo "--Appel constructeur statique : \n";
  $titi=myClass::getInstance();

  echo "--Utilisation du getter : \n";
  echo $titi->getVariable()."\n";
  echo "--Appel du setter : \n";
  $titi->setVariable("Une autre chaîne");
  echo "--Nouvel appel du getter : \n";
  echo $titi->getVariable()."\n";
  
  echo "--Nouvel appel constructeur statique : \n";
  $titi=myClass::getInstance();
  echo "--Nouvel appel du getter : \n";
  echo $titi->getVariable()."\n";

  echo "--Un coup de dump : \n";
  var_dump($titi);
  
?>
