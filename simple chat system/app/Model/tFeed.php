
<?php 
	App::uses('tUser', 'Model');


	class tFeed extends AppModel
	{
		public $useTable='t_feed';

		public $belongsTo = array(
			'tUser' => array(
				'className' => 'tUser', 
				'foreignKey' => 'user_id'
			)
		);

		public $validate = array(
			'user_id' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'user_id is empty'
				),
				'userExist' => array(
					'rule' => array('userExist'),
					'message' => 'user id not exist'
				)
			),
			'message' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'message is empty'
				)
			),
			'image_file_name' => array(
				"isEmage" => array(
					'rule' => array('extension',array('gif', 'jpeg', 'png', 'jpg', "")),
					'message' => 'Please supply a valid image.'
				)
			)
		);

		public function userExist($check)
		{	
			return true;
		}
	}
?>