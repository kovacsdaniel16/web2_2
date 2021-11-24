<?php

class Kereso_Controller
{
	public $baseName = 'kereso';  //1. megatározom, hol vagyok
	public function main(array $vars) // 2. router
	{
		$keresoModel = new Kereso_Model; 
		 
	
		$view = new View_Loader($this->baseName."_main");
	}
}

?>