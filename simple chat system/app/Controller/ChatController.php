<?php 
/**
* 
*/
class ChatController extends AppController
{
	public $uses = 'tFeed';

	public $helpers = array('Form', 'Html', 'Js', 'Time');

	// Function add new message or save message edit 
	public function feed()
	{
		if($this->Session->check('User.id')) {
			if ($this->request->is(array('post', 'put', 'submit'))) {
				$data = $this->request->data;

				if (isset($data['tFeed']['id'])) {  // Nếu có id tin sẽ thực hiện Edit tin nhắn
					if(!isset($data['tFeed']['image_file_name'])){
						echo 'Ok aaaaaaaaaaaaaaaaaaaaa';
					}
					$this->tFeed->id = $data['tFeed']['id'];
					$data['tFeed']['update_at'] = date('Y-m-d H:i:s');
					unset($data['tFeed']['image_file_name']);
					$this->tFeed->save($data);
				}else{	 // Nêu không có id tin thì thực hiện thêm tin nhắn mới 
					$this->tFeed->create();
					$data['tFeed']['user_id'] = $this->Session->read('User.id');	
					$data['tFeed']['create_at'] = date('Y-m-d H:i:s');

					if(isset($data['tFeed']['image_file_name'])){
						$file = $data['tFeed']['image_file_name'];
						$uploadFolder = 'img/upload/';
						move_uploaded_file($file['tmp_name'], $uploadFolder.$file['name']);
						$data['tFeed']['image_file_name'] = $file['name'];
					}
					$this->tFeed->save($data);
				}
			}
			// get data messages
			$messages = $this->tFeed->find('all', array('order' => array('tFeed.id' => 'desc')));
			$this->set('messages', $messages);
		}else{
			return $this->redirect(array('controller'=>'User','action' => 'login'));
		}
	}

	// function delete message
	public function delete($id =null) {
		if($this->Session->check('User.id')){
			$this->tFeed->delete($id);
			$this->Session->setFlash('Tin nhắn đã được xoá.');
			return $this->redirect(array('action' => 'feed'));
		}
	}

	// function load message edit
	public function edit($id = null) {
		if ($this->request->is('post')) {
			if ($messageEdit = $this->tFeed->findById($id)) {
				$this->set('messageEdit',$messageEdit);
			}
		}
		$messages = $this->tFeed->find('all');
		$this->set('messages', $messages);
		$this->render('feed');
	}
}
 ?>