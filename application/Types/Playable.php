<?php

namespace FML;

/**
 * Type indicating media attributes
 *
 * @author Steff
 */
interface Playable {
	/**
	 * Protected properties
	 */
	protected $data = '';
	protected $play = 0;
	protected $looping = 0;
	protected $music = 1;
	protected $volume = 1.;

	/**
	 * Set data
	 *
	 * @param string $data        	
	 */
	public function setData($data);

	/**
	 * Set play
	 *
	 * @param bool $play        	
	 */
	public function setPlay($play);

	/**
	 * Set looping
	 *
	 * @param bool $looping        	
	 */
	public function setLooping($looping);

	/**
	 * Set music
	 *
	 * @param bool $music        	
	 */
	public function setMusic($music);

	/**
	 * Set volume
	 *
	 * @param real $volume        	
	 */
	public function setVolume($volume);
}

?>
