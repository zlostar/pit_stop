<?php

App::uses('AppModel', 'Model');

class Car extends AppModel {
    
    public $hasMany = array(
        'Order' => array(
            'className' => 'Order',
            'conditions' => array('Order.car_id' => 'Car.id'),
            'order' => 'Order.created DESC'
        )
    );
    
    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id'
        )
    );
    
    public $validate = array(
        'client_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Ид-то на клиента е задължително'
            )
        ),
        'registration_plate' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Регистрационният номер е задължителен'
            )
        ),
        'make' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Марката е задължителна'
            )
        ),
        'model' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Моделът е задължителен'
            )
        ),
        'mileage' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Изминатите километри са задължителни'
            )
        )
    );
}
