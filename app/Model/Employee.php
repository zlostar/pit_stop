<?php

App::uses('AppModel', 'Model');

class Employee extends AppModel {
    
    public $hasAndBelongsToMany = array(
        'Performed' => array(
            'className' => 'Service',
        )
    );
    
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
    
    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Името е задължително'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Фамилията е задължителна'
            )
        )
    );
}
