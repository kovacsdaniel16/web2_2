<?php

class Nyitolap_Controller
{
	public $baseName = 'nyitolap';  //1. megatározom, hol vagyok
	public function main(array $vars) // 2. router
	{
		//3. load View_Loader
		$view = new View_Loader($this->baseName."_main");
	}
}

?>