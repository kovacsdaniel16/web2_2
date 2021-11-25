<?php

class Hozzaad_Controller
{
	public $baseName = 'hozzaad';  //1. megatározom, hol vagyok
	public function main(array $vars) // 2. router
	{
				$view = new View_Loader($this->baseName."_main");
	}
}

?>