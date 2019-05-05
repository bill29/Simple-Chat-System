<?php 
App::uses('AuthComponent', 'Controller/Component');
 
class tUser extends AppModel {
     
    public $useTable='t_user';

    public $hasMany = array(
        'feed' => array(
            'className' => 'tFeed',
            'foreignKey' => 'user_id'
        )
    );
     
    public $validate = array(
        'name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Tên không được trống',
                'allowEmpty' => false
            ),
            'minLength' => array( 
                'rule' => array('minLength', 5), 
                'required' => true, 
                'message' => 'Tên của bạn quá ngắn!'
            ),
            'maxLength' => array( 
                'rule' => array('maxLength', 40), 
                'required' => true, 
                'message' => 'Tên của bạn quá dài!'
            )
        ),

        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Bạn chưa nhập mật khẩu!'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),  
                'message' => 'Mật khẩu phải dài hơn 6 kí tự!'
            )
        ),
         
        'e-mail' => array(
            'required' => array(
                'rule' => array('email', true),    
                'message' => 'Email không hợp lệ!'   
            )
        )
    );


    public function beforeSave($options = array()) {
        // Băm mật khẩu 
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        // 
        return parent::beforeSave($options);
    }
 
}
 ?>