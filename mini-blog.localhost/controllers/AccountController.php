<?php
class AccountController extends Controller
{

	protected $auth_actions = array('index','signout','follow');

	public function signupAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/account');
		}

		return $this->render(array(
			'user_name'	=> '',
			'password'	=> '',
			'_token' 	=> $this->generateCsrfToken('account/signup'),
		));
	}

	public function registerAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/account');
		}

		if(!$this->request->isPost()){
			$this->forward404();
		}
	/************ CSRF Token Check *************/
		$token = $this->request->getPost('_token');
		if(!$this->checkCsrfToken('account/signup',$token)){
			return $this->redirect('/account/signup');
		}

		$user_name = $this->request->getPost('user_name');
		$password = 	$this->request->getPost('password');

		$errors = array();

	/************ Baridetion of User_ID *************/

		if(!strlen($user_name)){
			$errors[] = 'Error!! Please input User_ID';
		}else if (!preg_match('/^\w{3,20}$/',$user_name)){
			$errors[] = 'Error!! Please input User_ID = 3~20char and Alphanumeric characters';
		}else if (!$this->db_manager->get('User')->isUniqueUserName($user_name)){
			$errors[] = 'Error!! This User_ID = used';
		}

	/************ Baridetion of Password *************/

		if(!strlen($password)){
			$errors[] = 'Error!! Please input Password';
		}else if(4 > strlen($password) || strlen($password) > 30){
			$errors[] = 'Error!! Please input Password = 4~30char';
		}

	/************ Record's Account and Get *************/

		if(count($errors) === 0){
			$this->db_manager->get('User')->insert($user_name,$password);
			$this->session->setAuthenticated(true);

			$user = $this->db_manager->get('User')->fetchByUserName($user_name);
			$this->session->set('user',$user);

			return $this->redirect('/');
		}

		return $this->render(array(
			'user_name'	=> $user_name,
			'password'	=> $password,
			'errors'		=> $errors,
			'_token'		=> $this->generateCsrfToken('account/signup'),
		),'signup');
	}


	public function indexAction()
	{
		$user = $this->session->get('user');
		$followings = $this->db_manager->get('User')->fetchAllFollowingsByUserId($user['id']);
		$send_users = $this->db_manager->get('Mails')->getSendUser($user['id']);

		$following_ids = array();
		$following_ids = $this->db_manager->get('Following')->getFollowingId($user['id']);
		foreach ($following_ids as $following_id) {
			$following_count[] = $this->db_manager->get('Following')->getFollowingCount($user['id'],$following_id['following_id']);
		}
		$following_user_count = $this->db_manager->get('Mails')->getSendUserCount($user['id']);

		//$following_count = $following_count['COUNT(DISTINCT user_id)'] - 1;
		//$send_users = $this->db_manager->get('Mails')->getSendUser($following_id[$following_count]['following_id']);

		return $this->render(array(
			//'following_ids' => $following_ids,
			'user' 		=> $user,
			'followings'	=> $followings,
			'send_users'	=> $send_users,
			'following_count' => $following_count,
			'following_user_count' => $following_user_count,
		));

	}

	public function signinAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/account');
		}

		return $this->render(array(
			'user_name'	=> '',
			'password'	=> '',
			'_token'		=> $this->generateCsrfToken('account/signin'),
		));
	}

	public function authenticateAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/account');
		}

		if(!$this->request->isPost()){
			$this->forward404();
		}

		$token = $this->request->getPost('_token');
		if(!$this->checkCsrfToken('account/signin',$token)){
			return $this->redirect('/account/signin');
		}

		$user_name = $this->request->getPost('user_name');
		$password = $this->request->getPost('password');

		$errors = array();

		if(!strlen($user_name)){
			$errors[] = 'Please input User-ID';
		}

		if(!strlen($password)){
			$errors[] = 'Please input Password';
		}

		if(count($errors) === 0){
			$user_repository = $this->db_manager->get('User');
			$user = $user_repository->fetchByUserName($user_name);

			if(!$user || ($user['password'] !== $user_repository->hashPassword($password))){
				$errors[] = 'Which does fault User-ID or Password';
			}else{
				$this->session->setAuthenticated(true);
				$this->session->set('user',$user);

				return $this->redirect('/');
			}
		}

		return $this->render(array(
			'user_name'	=> $user_name,
			'password'	=> $password,
			'errors'		=> $errors,
			'_token'		=> $this->generateCsrfToken('account/signin'),
		),'signin');
	}

	public function signoutAction()
	{
		$this->session->clear();
		$this->session->setAuthenticated(false);

		return $this->redirect('/account/signin');
	}


	public function followAction()
	{
		if(!$this->request->isPost()){
			$this->forward404();
		}

		$following_name = $this->request->getPost('following_name');
		if(!$following_name){
			$this->forward404();
		}

		$token = $this->request->getPost('_token');
		if(!$this->checkCsrfToken('account/follow',$token)){
			return $this->redirect('/user/' . $following_name);
		}

		$follow_user = $this->db_manager->get('User')->fetchByUserName($following_name);
		if(!$follow_user){
			$this->forward404();
		}

		$user = $this->session->get('user');

		$following_repository = $this->db_manager->get('Following');
		if($user['id'] !== $follow_user['id'] && !$following_repository->isFollowing($user['id'],$follow_user['id'])){
			$following_repository->insert($user['id'],$follow_user['id']);
		}

		return $this->redirect('/account');
	}
}