<?php

App::uses('AppModel', 'Model');

class Profit extends AppModel {
    
    public $validate = array(
        'employee_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'employee_id е задължително'
            )
        ),
        'service_type_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'service_type_id е задължителна'
            )
        ),
        'employee_profit' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Печалбата е задължителна'
            )
        )
    );

    public function saveEmployeeProfits($service_types, $employee_id) {
        
        $data = array();
        foreach ($service_types as $key => $val) {
            $service_type_id = substr_replace($key, '', 0, 13);
            $data[] = array('employee_id' => $employee_id, 'service_type_id' => $service_type_id, 'employee_profit' => $val);
        }
        $this->saveMany($data);
    }
    
    public function updateEmployeeProfits($service_types, $employee_id) {
        
        $data = array();
        foreach ($service_types as $key => $val) {
            $service_type_id = substr_replace($key, '', 0, 13);
            $profit = $this->find('all', array(
                'conditions' => array('Profit.employee_id' => $employee_id, 'service_type_id' => $service_type_id)
            ));
            
            $data[] = array('id' => $profit[0]['Profit']['id'],'employee_id' => $employee_id, 'service_type_id' => $service_type_id, 'employee_profit' => $val);
        }
        $this->saveMany($data);
    }
}
