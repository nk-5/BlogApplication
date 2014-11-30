<?php

class MiniBlogApplication extends Application
{
	protected $login_action = array('account','signin');
	

	public function getRootDir()
	{
		return dirname(__FILE__);
	}

	public function registerRoutes()
	{
		return  array(
		//AccountController Rooting
			'/account' 					=> array('controller' => 'account','action' => 'index'),
			'/account/:action'			=> array('controller' => 'account'),
			'/follow'					=> array('controller' => 'account','action' => 'follow'),
		
		//Status Controller Other Rooting
			'/'							=> array('controller' => 'status', 'action' => 'index'),
			'/status/post'				=> array('controller' => 'status', 'action' => 'post'),
			'/user/:user_name'			=> array('controller' => 'status', 'action' => 'user'),
			'/user/:user_name/status/:id'	=> array('controller' => 'status','action'	=> 'show'),
			//'/find/user/:user_name/user/:id'			=> array('controller' => 'status', 'action' => 'find'),
			'/status/searchindex'		=> array('controller' => 'status', 'action' => 'searchindex'),
			'/status/searchpost'			=> array('controller' => 'status', 'action' => 'searchpost'),
			'/status/find'				=> array('controller' => 'status', 'action' => 'find'),
			'/mails/sendmailview'		=> array('controller' => 'mails', 'action' => 'sendmailview'),
			'/mails/sendmailpost'		=> array('controller' => 'mails', 'action' => 'sendmailpost'),
			'/mails/:user_id/mailboxview'	=> array('controller'	 => 'mails', 'action'	=> 'mailboxview'),

		);
	}

	protected function configure()
	{
		$this->db_manager->connect('master',array(
			'dsn'		=> 'mysql:dbname=mini_blog;host=localhost',
			'user'		=> 'dbuserkeigo',
			'password'	=> 'nkws0525',
		));
	}
}