<?php

class EmployeesController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index() {
        $this->calculateEmployeesPayments();
        
        $this->set('employees', $this->Employee->find('all', array(
            'conditions' => array('Employee.user_id' => $this->Auth->user('id'))
        )));
        
    }
    
    public function add() {
        $this->loadModel('ServiceType');
        $this->set('service_types', $this->ServiceType->find('all'));
        
        if ($this->request->is('post')) {
            $employee_service_types = array_slice($this->request->data, 0, -1);
            $this->request->data['Employee']['user_id'] = $this->Auth->user('id');
            
            $employee = $this->Employee->save($this->request->data);
            if ($employee) {
                $this->loadModel('Profit');
                $this->Profit->saveEmployeeProfits($employee_service_types, $employee['Employee']['id']);
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $employee = $this->Employee->findById($id);
        if (!$employee) {
            throw new NotFoundException(__('Invalid post'));
        }
        
        $this->loadModel('ServiceType');
        $service_types = $this->ServiceType->find('all');
        
        
        $this->loadModel('Profit');
        $profits = $this->Profit->find('all', array('conditions' => array('Profit.employee_id' => $id)));
        
        $i = 0;
        foreach($service_types as $service_type) {
            $j = 0;
            foreach($profits as $profit) {
                if ($profit['Profit']['service_type_id'] == $service_type['ServiceType']['id']) {
                    $service_types[$i]['ServiceType']['employee_profit'] = $profit['Profit']['employee_profit'];
                    unset($profits[$j]);    
                }
                $j++;
            }
            $i++;
        }
        $this->set('service_types', $service_types);
        
        if ($this->request->is(array('post', 'put'))) {
            $employee_service_types = array_slice($this->request->data, 0, -1);
            $this->Employee->id = $id;
            if ($this->Employee->save($this->request->data)) {
                
                $this->Profit->updateEmployeeProfits($employee_service_types, $id);
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $employee;
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        //TODO DELETE EMPLOYEE PROFITS
        if ($this->Employee->delete($id)) {
            $this->Session->setFlash(
                __('The post with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    public function calculateEmployeesPayments() {
        $this->loadModel('Employee');
        $employees = $this->Employee->find('all', array(
            'conditions' => array('Employee.user_id' => $this->Auth->user('id')),
           // 'fields' => array('Car.registration_plate'),
            'recursive' => 1
        ));
        debug($employees);
        
        
        
      //  $this->query("INSERT INTO employees_services (employee_id,service_id) VALUES ($employeeId,$serviceId);");
    }
    
//    public function isAuthorized($user) {
//        // All registered users can add posts
//        if ($this->action === 'add') {
//            return true;
//        }
//
//        // The owner of a post can edit and delete it
//        if (in_array($this->action, array('edit', 'delete'))) {
//            $postId = (int) $this->request->params['pass'][0];
//            if ($this->Post->isOwnedBy($postId, $user['id'])) {
//                return true;
//            }
//        }
//
//        return parent::isAuthorized($user);
//    }
}