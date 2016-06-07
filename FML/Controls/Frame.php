<?php

namespace FML\Controls;

use FML\Elements\Format;
use FML\Types\Container;
use FML\Types\Renderable;
use FML\Types\ScriptFeatureable;

/**
 * Frame Control
 * (CMlFrame)
 *
 * @author    steeffeen <mail@steeffeen.com>
 * @copyright FancyManiaLinks Copyright © 2014 Steffen Schröder
 * @license   http://www.gnu.org/licenses/ GNU General Public License, Version 3
 */
class Frame extends Control implements Container {

	/*
	 * Protected properties
	 */
	protected $tagName = 'frame';
	/** @var Renderable[] $children */
	protected $children = array();
	/** @var Format $format */
	protected $format = null;

	/**
	 * @see Control::getManiaScriptClass()
	 */
	public function getManiaScriptClass() {
		return 'CMlFrame';
	}

	/**
	 * @see Container::add()
	 */
	public function add(Renderable $child) {
		if (!in_array($child, $this->children, true)) {
			array_push($this->children, $child);
		}
		return $this;
	}

	/**
	 * @see Container::removeChildren()
	 */
	public function removeChildren() {
		$this->children = array();
		return $this;
	}

	/**
	 * @see Container::getFormat()
	 */
	public function getFormat($createIfEmpty = true) {
		if (!$this->format && $createIfEmpty) {
			$this->setFormat(new Format());
		}
		return $this->format;
	}

	/**
	 * @see Container::setFormat()
	 */
	public function setFormat(Format $format) {
		$this->format = $format;
		return $this;
	}

	/**
	 * @see Control::getScriptFeatures()
	 */
	public function getScriptFeatures() {
		$scriptFeatures = $this->scriptFeatures;
		foreach ($this->children as $child) {
			if ($child instanceof ScriptFeatureable) {
				$scriptFeatures = array_merge($scriptFeatures, $child->getScriptFeatures());
			}
		}
		return $scriptFeatures;
	}

	/**
	 * @see Renderable::render()
	 */
	public function render(\DOMDocument $domDocument) {
		$domElement = parent::render($domDocument);
		if ($this->format) {
			$formatXml = $this->format->render($domDocument);
			$domElement->appendChild($formatXml);
		}
		foreach ($this->children as $child) {
			$childXmlElement = $child->render($domDocument);
			$domElement->appendChild($childXmlElement);
		}
		return $domElement;
	}
	
}
