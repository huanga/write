<?php
namespace Write\Model;

use ArrayIterator;
use ArrayAccess;
use IteratorAggregate;
use Phalcon\DI\InjectionAwareInterface;
use Write\Model\AbstractModel;

abstract class AbstractPhalconCache extends AbstractModel implements ArrayAccess, IteratorAggregate, InjectionAwareInterface
{
    protected $_model;
    protected $_di;

    public function __construct($di)
    {
        $this->_di = $di;
        if ( $this->load() === false ) {
            $this->_initialize();
        }
    }

    abstract protected function _initialize();

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->_di;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->_model);
    }

    /**
     * Load persisted data from cache
     *
     * @return boolean
     */
    public function load()
    {

        return false;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->_model[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->_model[$offset];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (empty($value) || empty($offset)) {
            $inserted = false;
        } else {
            $this->_model[$offset] = $value;
            $inserted = true;
        }

        return $inserted;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->_model[$offset]);
    }

    /**
     * Persists data into cache
     *
     * @return boolean
     */
    public function save()
    {
        // TODO: IMPLEMENT SAVING TO CACHE

        return false;
    }

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI($dependencyInjector)
    {
        $this->_di = $dependencyInjector;
    }
}