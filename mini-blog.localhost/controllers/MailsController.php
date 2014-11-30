<?php 

class MailsController extends Controller
{
	/****** SEND MAILS ******/

	public function sendmailviewAction()
	{
		$user_id = $this->session->get('user');
		// $send_user = array();
		$send_user = $this->db_manager->get('Mails')->sendUserSelect($user_id['id']);

		return $this->render(array(
			'user_id'	 => $user_id,
			'send_user'	 => $send_user,
			'mail_body'	 => '',
			'_token'		 => $this->generateCsrfToken('mails/sendmailpost'),
		));
	}
	
	public function sendmailpostAction()
	{
		if(!$this->request->isPost()){
			$this->forward404();
		}

		$token = $this->request->getPost('_token');

		if(!$this->checkCsrfToken('mails/sendmailpost',$token)){
			return $this->redirect('/');
		}
		$send_user_id	= $this->session->get('user');
		$send_user 		= $this->db_manager->get('User')->fetchSearchByUserName($send_user_id['id']);
		$mail_body	 	= $this->request->getPost('mail_body');
		$get_user 		= $this->request->getPost('send_user');
		$following_id 	= $this->db_manager->get('User')->fetchSearchByUserId($get_user);

		$errors = array();

	/********** baridetion of SearchID **************/

		if(!strlen($mail_body)){
			$errors[] = 'Error! Please input mail contents';
			
		}else if(mb_strlen($mail_body) > 600){
			$errors[] = 'Comment is 600 char less than';
		}
	 	
	 	$statuses = $this->db_manager->get('Mails')->getMailContents($send_user_id['id']);

	 	$other_user_statuses = $this->db_manager->get('Mails')->getMailUserContents($send_user_id['id']);

		if(count($errors) === 0){
			$this->db_manager->get('Mails')->insertSendMails($send_user_id['id'],$send_user['user_name'],$mail_body,$get_user,$following_id['id']);

			//return $this->redirect('/');
		}


		return $this->render(array(
			'errors'		=> $errors,
			'send_user'	=> $send_user,
			'mail_body'	=> $mail_body,
			'statuses'	=> $statuses,
			'other_user_statuses' => $other_user_statuses,
			'get_user'	=> $get_user,
			'_token'		=> $this -> generateCsrfToken('mails/sendmailpost'),
		),'mailbox');
	}

	public function mailboxviewAction($params)
	{	
		//$user_id = $this->db_manager->get('User')->fetchAllByUserId($params['user_id']);

	 	$mail_contents = $this->db_manager->get('Mails')->getMailUserContents($params['user_id']);

		if(!$mail_contents){
			$this->forward404();
		}

		return $this->render(array('mail_contents' => $mail_contents));

	}
}