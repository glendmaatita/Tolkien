<?php namespace Tolkien;

use Tolkien\Model\Widget;

class BuildWidget implements BuildNode
{
	private $config;
	private $widgets = array();

	public function __construct($config)
	{
		$this->config = $config;
	}

	public function build()
	{
		$widgets = $this->config['widgets'];
		foreach ($widgets as $widget) {
			$this->widgets[] = new Widget()
		}
	}

	public function getNodes()
	{

	}


}