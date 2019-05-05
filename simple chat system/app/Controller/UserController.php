<?php 
class UserController extends AppController {

    public $name = 'User';

    public $uses = 'tUser';
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','regist'); 
    }
    
    public function login() {
        // Nếu tồn tại session User.e-mail thì redirect đến feed
        if($this->Session->check('User.id')){
            $this->redirect(array('controller'=>'Chat', 'action' => 'feed'));      
        }
        // Nếu không thì thực hiện xác thực người 
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('name')));
                $this->Session->write('User.e-mail', $this->Auth->user('e-mail'));
                $this->Session->write('User.name', $this->Auth->user('name'));
                $this->Session->write('User.id', $this->Auth->user('id'));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại .'));
            }
        } 
    }
 
    public function logout() {
        $this->Session->delete('User.e-mail');
        $this->Session->delete('User.name');
        $this->Session->delete('User.id');
        $this->redirect($this->Auth->logout());
    }

    public function regist() {
        if ($this->request->is('post')) {
        $this->tUser->create();
            if ($this->tUser->save($this->request->data)) {
                $this->Session->setFlash(__('Tài khoản đã được tạo'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('Có lỗi xảy ra, tài khoản chưa được tạo!!!'));
            }   
        }
    }
}
 ?>