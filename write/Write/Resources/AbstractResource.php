<?php
namespace Write\Resources;

class AbstractResource {

	protected $_instance;

	/**
	 * Magic caller to transparently pass request to real object.
	 *
	 * @param  string $name         Method name to call
	 * @param  array  $arguments    Arguments to be passed to the called method
	 * @return mixed                The data returned from the called method
	 */
	public function __call($name, $arguments)
	{
		return call_user_func_array( array( $this->_instance, $name ), $arguments );
	}

	/**
	 * Magic getter to transparently acquire attributes from the real object
	 *
	 * @param  string $name         The name of the attribute to get from the real object.
	 * @return mixed                The attribute value
	 */
	public function __get( $name ) {
		return $this->_instance->$name;
	}
}