<?php

namespace FML;

/**
 * Unique ID Model Class
 *
 * @author    steeffeen
 * @copyright FancyManiaLinks Copyright © 2014 Steffen Schröder
 * @license   http://www.gnu.org/licenses/ GNU General Public License, Version 3
 */
class UniqueID
{

    /*
     * Constants
     */
    const PREFIX = 'FML_ID_';

    /*
     * Static properties
     */
    protected static $currentIndex = 0;

    /*
     * Protected properties
     */
    protected $index = null;

    /**
     * Create a new Unique ID
     *
     * @api
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Get a new global unique index
     *
     * @api
     * @return int
     */
    protected static function newIndex()
    {
        self::$currentIndex++;
        return self::$currentIndex;
    }

    /**
     * Construct a Unique ID
     *
     * @api
     */
    public function __construct()
    {
        $this->index = static::newIndex();
    }

    /**
     * Get the Unique ID index
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Get the Unique ID value
     *
     * @api
     * @return string
     */
    public function getValue()
    {
        return self::PREFIX . $this->getIndex();
    }

    /**
     * Get the string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

}
