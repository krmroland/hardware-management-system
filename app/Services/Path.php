<?php

namespace App\Services;

Class Path
{
	/**
	 * the directory for the resource
	 * @var string
	 */
	protected $directory;
	/**
	 * the folder name
	 */
	protected $folder;
	/**
	 * the name of the resource
	 * @var string
	 */
	protected $name;
	/**
	 * instatiate this class
	 *
	 * @param      string  $directory  The directory
	 * @param      string  $name       The name
	 */
	public function __construct($directory, $name)
	{
		$this->directory = $directory;

		$this->name = $name;
	}
	
	/**
	 * instatiate this class globally
	 *
	 * @param      string  $directory  
	 * @param      string  $name       
	 *
	 * @return     self 
	 */
	public static function make($directory, $name)
	{
		return new static($directory,$name);
	}
	/**
	 * the storage path
	 *
	 * @return     string  
	 */
	public function storage()
	{
		return sprintf("public/%s",$this->base());
	}
	/**
	 * the base path
	 *
	 * @return     string  
	 */
	protected function base()
	{
		//$folder=isset($this->folder)?"/$this->folder/":'';

		return "$this->directory/$this->name";
	}
	/**
	 * the url path
	 *
	 * @return     string
	 */
	public  function url()
	{
		return sprintf("/storage/%s", $this->base());
	}

	/**
	 * sets the folder
	 *
	 * @param      string  $folder  
	 *
	 * @return     self
	 */
	public function inFolder(string $folder)
	{
		$this->folder=$folder;

		return $this;
	}
	/**
	 * magically call a method on an instance as a setter
	 *
	 * @param      Function  $key    
	 *
	 * @return     mixed    
	 */
	public function __get($key)
	{
		return call_user_func([$this, $key]);
	}

	public function getName()
	{
		return $this->name;
	}

}