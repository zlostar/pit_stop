<?php

App::uses('AppModel', 'Model');

class Client extends AppModel {
    
    public $hasMany = 'Car';
    public $belongsTo = 'User';
    
    public $validate = array(
        'user_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Потребителското ид е задължително'
            )
        ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Името е задължително'
            )
        ),
        'country' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Държавата е задължителна'
            )
        ),
        'city' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Градът е задължителен'
            )
        ),
        'phone' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Телефонът е задължителен'
            )
        )
    );
}
