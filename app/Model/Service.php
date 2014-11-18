<?php

App::uses('AppModel', 'Model');

class Service extends AppModel {
    
    public $hasAndBelongsToMany = array(
        'PerformedBy' => array(
            'className' => 'Employee',
        )
    );


    public $validate = array(
//        'first_name' => array(
//            'required' => array(
//                'rule' => array('notEmpty'),
//                'message' => 'Името е задължително'
//            )
//        ),
//        'last_name' => array(
//            'required' => array(
//                'rule' => array('notEmpty'),
//                'message' => 'Фамилията е задължителна'
//            )
//        )
    );
    
    public function saveServices($data) {
       
        $serviceData = array();
        foreach ($data['Service'] as $row) {
            
            $serviceData['Service']['description'] = $row['service_description'];
            $serviceData['Service']['count'] = $row['service_count'];
            $serviceData['Service']['price'] = $row['service_price'];
            $serviceData['Service']['order_id'] = $row['order_id'];
            $serviceData['Service']['car_id'] = $row['car_id'];
            
            $this->create();
            $service = $this->save($serviceData['Service']);
            $serviceId = $service['Service']['id'];
            foreach ($row['services_employees'] as $employeeId) {
                $serviceData['Service'][]['employee_id'] = $employeeId;
                $serviceData['Service'][]['service_id'] = $serviceId;
                $this->query("INSERT INTO employees_services (employee_id,service_id) VALUES ($employeeId,$serviceId);");
            }
        }    
    }
}
