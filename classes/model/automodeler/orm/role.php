<?php defined('SYSPATH') or die('No direct script access.');

class Model_AutoModeler_ORM_Role extends AutoModeler_ORM {

	protected $_table_name = 'roles';

	protected $_data = array(
		'id' => '',
		'name' => ''
	);

	protected $_belongs_to = array('users');

}