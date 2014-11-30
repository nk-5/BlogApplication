<?php

class FollowingRepository extends DbRepository
{

/******** Record Insert for Following Table ********/

	public function insert($user_id,$following_id)
	{
		$sql = "INSERT INTO following VALUES(:user_id,:following_id)";

		$stmt = $this->execute($sql,array(
			':user_id'		=> $user_id,
			':following_id'	=> $following_id,
		));
	}

/******** Check is Following ********/

	public function isFollowing($user_id,$following_id)
	{
		$sql = "SELECT COUNT(user_id) as count FROM following WHERE user_id = :user_id AND following_id = :following_id";

		$row = $this->fetch($sql,array(
			':user_id'		=> $user_id,
			':following_id'	=> $following_id,
		));

		if($row['count'] !== '0'){
			return true;
		}

		return false;
	}

	public function getFollowingId($user_id)
	{
		$sql = "SELECT following_id FROM following WHERE :user_id = user_id";

		return $this->fetchAll($sql,array(':user_id' => $user_id));
	}

	public function getFollowingCount($user_id,$send_user_id)
	{
		$sql = "SELECT COUNT(send_user_id) FROM mails WHERE following_id = :user_id AND send_user_id = :send_user_id";

		return $this->fetch($sql,array(
			':user_id' => $user_id,
			':send_user_id' => $send_user_id,
		));
	}
}