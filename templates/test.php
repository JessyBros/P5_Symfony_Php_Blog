<?php

class Controller{

	private $_twig;

	public function __construct($twig) {

		$this-> twig = $twig;
	}

	public function targetpage(){

	$vari = $this -> twig;
	$vari -> render()

}

	}

} 