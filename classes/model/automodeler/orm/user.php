<?php defined('SYSPATH') or die('No direct script access.');

class Model_AutoModeler_ORM_User extends AutoModeler_ORM {

	public function __set($key, $value)
	{
		if($key == 'password')
		{
			$value = Auth::instance()->hash($value);
		}
		
		return parent::__set($key, $value);
	}
	
	protected $_table_name = 'users';

	protected $_has_many = array('roles');
	
	protected $_data = array(
		'id' => '',
		'username' => '',
	    'password' => '',
	    'email' => '',
	    'last_login' => '',
	    'logins' => '',
	);

	protected $_rules = array(
		'username' => array(
			array('not_empty'),
		),
		'email' => array(
			array('email'),
		),
	);

	
	/**
	 * Called by Auth each login.
	 *
	 * @return void
	 * @author Merrick Christensen
	 */
	public function complete_login()
	{
		if ($this->loaded())
		{
			// Update the number of logins
			$this->logins = new Database_Expression('logins + 1');

			// Set the last login date
			$this->last_login = time();

			// Save the user
			$this->save();
		}
	}
}