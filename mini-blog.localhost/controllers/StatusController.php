<?php

class StatusController extends Controller
{

	protected $auth_actions = array('index','post');

	public function indexAction()
	{
		$user 		= $this->session->get('user');
		$statuses 	= $this->db_manager->get('Status')
			->fetchAllPersonalArchivesByUserId($user['id']);

		return $this->render(array(
			'statuses'	=> $statuses,
			'body'		=> '',
			'_token'		=> $this->generateCsrfToken('status/post'),
		));
	}

	public function postAction()
	{
		if(!$this->request->isPost()){
			$this->forward404();
		}

		$token = $this->request->getPost('_token');

		if(!$this->checkCsrfToken('status/post',$token)){
			return $this->redirect('/');
		}

		$body = $this->request->getPost('body');

		$errors = array();

	/********** baridetion of BODY **************/

		if(!strlen($body)){
			$errors[] = 'Please input one comment';
		}else if(mb_strlen($body) > 200){
			$errors[] = 'Comment is 200 char less than';
		}


		if(count($errors) === 0){
			$user = $this->session->get('user');
			$this->db_manager->get('Status')->insert($user['id'],$body);

			return $this->redirect('/');
		}

		$user = $this->session->get('user');
		$statuses = $this->db_manager->get('Status')
				->fetchAllPersonalArchivesByUserId($user['id']);

			return $this->render(array(
				'errors'		=> $errors,
				'body'		=> $body,
				'statuses'	=> $statuses,
				'_token'		=> $this -> generateCsrfToken('status/post'),
			),'index');
	}

	public function userAction($params)
	{
		$user = $this->db_manager->get('User')->fetchByUserName($params['user_name']);
		
		if(!$user){
			$this->forward404();
		}	

		$statuses = $this->db_manager->get('Status')->fetchAllByUserId($user['id']);

	/**** follow check ***/
		$following = null;
		if($this->session->isAuthenticated()){
			$my = $this->session->get('user');
			if($my['id'] !== $user['id']){
				$following = $this->db_manager->get('Following')->isFollowing($my['id'],$user['id']);
			}
		}

		return $this->render(array(
			'user'		=> $user,
			'statuses'	=> $statuses,
			'following'	=> $following,
			'_token'		=> $this->generateCsrfToken('account/follow'),
		));
	}

	public function showAction($params)
	{
		$status = $this->db_manager->get('Status')->fetchByIdAndUserName($params['id'],$params['user_name']);

		if(!$status){
			$this->forward404();
		}

		return $this->render(array('status' => $status));
	}

	
	public function findAction($params)
	{	
		$statuses = $this->db_manager->get('Status')->fetchByBodyContents($params['id']);

		if(!$statuses){
			$this->forward404();
		}

		$user = $this->db_manager->get('User')->fetchByUserName($params['user_name']);

		return $this->render(array(
			'user'		=> $user,
			'statuses'	=> $statuses,
		));
	}

	public function searchindexAction()
	{

		return $this->render(array(
			'search_name'		=> '',
			'_token'		=> $this->generateCsrfToken('status/searchpost'),
		));
	}

	public function searchpostAction()
	{
		if(!$this->request->isPost()){
			$this->forward404();
		}

		$token = $this->request->getPost('_token');

		if(!$this->checkCsrfToken('status/searchpost',$token)){
			return $this->redirect('/');
		}

		$search_name = $this->request->getPost('search_name');
		$search_id = $this->session->get('user');

		$my_name = $this->db_manager->get('User')->fetchSearchByUserName($search_id['id']);
		$errors = array();

	/********** baridetion of SearchID **************/

		if(!strlen($search_name)){
			$errors[] = 'Please input Your ID';
			

		}else if ($search_name != $my_name['user_name']/*$this->db_manager->get('User')->fetchSearchByUserName($search_id['id']*/){
			$errors[] = 'This ID is not Your ID';
		}

	
		$statuses = $this->db_manager->get('Status')->fetchByBodyContents($search_id['id']);

	

		//$user = $this->db_manager->get('User')->fetchByUserName($params['user_name']);

		return $this->render(array(
			'errors'		=> $errors,
			'search_id'	=> $search_id,
			'search_name'=> $search_name,
			'statuses'	=> $statuses,
			'_token'		=> $this -> generateCsrfToken('status/searchpost'),
		),'find');
	}


}