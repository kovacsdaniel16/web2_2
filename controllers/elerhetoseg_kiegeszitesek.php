<?php

class Elerhetoseg_kiegeszitesek_Controller
{
	public $baseName = 'elerhetoseg_kiegeszitesek';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>