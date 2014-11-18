<?php

App::uses('AppModel', 'Model');

class ServiceType extends AppModel {
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Името е задължително'
            )
        )
    );
}