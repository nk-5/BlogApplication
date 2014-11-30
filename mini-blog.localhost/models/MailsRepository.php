<?php

class MailsRepository extends DbRepository
{
	/********* SEND MAILS  ********/
	public function insertSendMails($send_user_id,$send_user,$mail_body,$get_user,$following_id)
	{
		$now = new DateTime();

		$sql = "INSERT INTO mails(send_user_id,send_user,mail_body,created_at,get_user,following_id) VALUES(:send_user_id,:send_user,:mail_body,:created_at,:get_user,:following_id)";

		$stmt = $this->execute($sql,array(
			':send_user_id'	=> $send_user_id,
			':send_user'		=> $send_user,
			':mail_body'		=> $mail_body,
			':created_at'	=> $now->format('Y-m-d H:i:s'),
			':get_user'		=> $get_user,
			':following_id'	=> $following_id,
		));
	}


	public function sendUserSelect($user_id)
	{
		$sql = "SELECT user_name FROM user WHERE id IN(SELECT following_id FROM following WHERE user_id = :user_id)";

		return $this->fetchAll($sql,array(':user_id' => $user_id));
	}

	public function getMailContents($send_user_id)
	{
		$sql = "SELECT send_user,mail_body,created_at FROM mails WHERE send_user_id = :send_user_id";

		return $this->fetchAll($sql,array(':send_user_id' => $send_user_id));
	}

	public function getMailUserContents($user_id)
	{
		$sql = "SELECT send_user,mail_body,created_at FROM mails WHERE following_id = :user_id";

		return $this->fetchAll($sql,array('user_id' => $user_id));
	}

	public function getSendUser($user_id)
	{
		$sql = "SELECT DISTINCT send_user FROM mails WHERE following_id = :user_id";

		return $this->fetchAll($sql,array(
			':user_id' => $user_id
		));
	}

	public function getSendUserCount($user_id)
	{
		$sql = "SELECT COUNT(DISTINCT send_user) FROM mails WHERE following_id = :user_id";

		return $this->fetch($sql,array(':user_id' => $user_id));
	}

}