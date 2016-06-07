<?php

namespace FML\ManiaCode;

/**
 * ManiaCode Element adding a buddy
 *
 * @author    steeffeen
 * @copyright FancyManiaLinks Copyright © 2014 Steffen Schröder
 * @license   http://www.gnu.org/licenses/ GNU General Public License, Version 3
 */
class AddBuddy extends Element {

	/*
	 * Protected properties
	 */
	protected $tagName = 'add_buddy';
	protected $login = null;

	/**
	 * Create a new AddBuddy Element
	 *
	 * @api
	 * @param string $login (optional) Buddy login
	 * @return static
	 */
	public static function create($login = null) {
		return new static($login);
	}

	/**
	 * Construct a new AddBuddy Element
	 *
	 * @api
	 * @param string $login (optional) Buddy login
	 */
	public function __construct($login = null) {
		if ($login !== null) {
			$this->setLogin($login);
		}
	}

	/**
	 * Set the buddy login
	 *
	 * @api
	 * @param string $login Buddy login
	 * @return static
	 */
	public function setLogin($login) {
		$this->login = (string)$login;
		return $this;
	}

	/**
	 * @see Element::render()
	 */
	public function render(\DOMDocument $domDocument) {
		$domElement   = parent::render($domDocument);
		$loginElement = $domDocument->createElement('login', $this->login);
		$domElement->appendChild($loginElement);
		return $domElement;
	}

}
