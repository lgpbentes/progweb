<?php

/**
* 
*/
namespace Equipamento\Sonoro;

class EquipamentoSonoro extends Equipamento
{
	public $volume;
	public $stereo;

	function __construct(){
		this->liga()
	}

	public function liga()
	{
		$this->volume=5;
	}

	public function mono()
	{
		$this->stereo = false;
	}

	public function stereo()
	{
		$this->stereo = true;
	}

	public function setVolume($novoVolume){
		$this->volume = $novoVolume;
	}
}