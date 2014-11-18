<?php

App::uses('AppController', 'Controller');

class OrdersController extends AppController {

    private $_clientsData = null;
    private $_carsData = null;
    private $_servicesData = null;
    private $_partsData = null;

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index($date = null) {
        if ($date) {
            $this->setJsVar('date', $date);
        }
        $this->set('orders', $this->getOrders($date));
    }

    public function view($id = null) {
        $this->loadModel('Client');
        $this->loadModel('Car');
        $this->loadModel('Part');
        $this->loadModel('Service');


        $order = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));
        $car = $this->Car->find('first', array('conditions' => array('Car.id' => $order['Order']['car_id'])));
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $car['Car']['client_id'])));
        $parts = $this->Part->find('all', array('conditions' => array('Part.order_id' => $id)));
        $services = $this->Service->find('all', array('conditions' => array('Service.order_id' => $id)));

        $this->set('order', $order);
        $this->set('car', $car);
        $this->set('client', $client);
        $this->set('parts', $parts);
        $this->set('services', $services);
    }

    public function add() {
        $this->setJsVar('registration_plates', $this->getRegistrationPlates());
        /*
         * get employees
         */
        $this->loadModel('Employee');
        $employees = $this->Employee->find('all', array(
            'conditions' => array('Employee.user_id' => $this->Auth->user('id'))
        ));

        $employees_select = array();
        foreach ($employees as $employee) {
            $employees_select[$employee['Employee']['id']] = $employee['Employee']['first_name'] . ' ' . $employee['Employee']['last_name'];
        }
        $this->set('employees_select', $employees_select);
        //$this->setJsVar('employees', $employees);
        /*
         * end get employees
         */

        if ($this->request->is('post')) {
            $this->clientData($this->request->data);
            $this->loadModel('Client');
            $clientExists = $this->Client->find('first', array(
                'order' => array('Client.created' => 'desc'),
                'conditions' => array(
                    'Client.user_id' => $this->_clientsData['Client']['user_id'],
                    'Client.name' => $this->_clientsData['Client']['name']
                )
            ));

            if (!$clientExists) {
                $client = $this->Client->save($this->_clientsData);
                $clientId = $client['Client']['id'];
            } else {
                $clientId = $clientExists['Client']['id'];
            }

            $this->carData($this->request->data, $clientId);
            $this->loadModel('Car');
            $carExists = $this->Car->find('first', array(
                'order' => array('Car.created' => 'desc'),
                'conditions' => array(
                    'Car.client_id' => $clientId,
                    'Car.registration_plate' => $this->_carsData['Car']['registration_plate']
                )
            ));

            if (!$carExists) {
                $car = $this->Car->save($this->_carsData);
                $carId = $car['Car']['id'];
            } else {
                $carId = $carExists['Car']['id'];
            }

            $this->Order->create();
            $data = array();
            $data['Order']['user_id'] = $this->Auth->user('id');
            $date = date_create_from_format('Y-m-d', $this->request->data['order_created']);
            $data['Order']['created'] = date_format($date, 'Y-m-d');
            $data['Order']['description'] = $this->request->data['order_description'];
            $data['Order']['car_id'] = $carId;

            $order = $this->Order->save($data);

            if ($order) {

                $this->servicesData($this->request->data, $order['Order']['id'], $carId);
                $this->partsData($this->request->data, $order['Order']['id'], $carId);

                $this->loadModel('Service');
                $this->Service->saveServices($this->_servicesData);

                $this->loadModel('Part');
                $this->Part->saveMany($this->_partsData['Part']);
                
                
                //calculate employee_payments

                $this->Session->setFlash(__('The Order has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                    __('The Order could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        
    }

    public function delete($id = null) {
        
    }

    private function clientData($data) {
        $this->_clientsData['Client']['user_id'] = $this->Auth->user('id');
        $this->_clientsData['Client']['name'] = $data['client_name'];
        $this->_clientsData['Client']['country'] = $data['client_country'];
        $this->_clientsData['Client']['city'] = $data['client_city'];
        $this->_clientsData['Client']['street'] = $data['client_street'];
        $this->_clientsData['Client']['street_number'] = $data['client_street_number'];
        $this->_clientsData['Client']['phone'] = $data['client_phone'];
        $this->_clientsData['Client']['email'] = $data['client_email'];
        $this->_clientsData['Client']['is_company'] = $data['client_is_company'];
        $this->_clientsData['Client']['mol'] = $data['client_mol'];
        $this->_clientsData['Client']['bulstat'] = $data['client_bulstat'];
    }

    private function carData($data, $clientId) {
        $this->_carsData['Car']['client_id'] = $clientId;
        $this->_carsData['Car']['registration_plate'] = $data['car_registration_plate'];
        $this->_carsData['Car']['make'] = $data['car_make'];
        $this->_carsData['Car']['model'] = $data['car_model'];
        $this->_carsData['Car']['mileage'] = $data['car_mileage'];
        $this->_carsData['Car']['description'] = $data['car_description'];
    }

    private function servicesData($data, $orderId, $carId) {
        $this->_servicesData['Service'] = array_values($data['Service']);
        for ($i = 0; $i < count($this->_servicesData['Service']); $i++) {
            $this->_servicesData['Service'][$i]['order_id'] = $orderId;
            $this->_servicesData['Service'][$i]['car_id'] = $carId;
        }
        //$this->_servicesEmployeesData['ServicesEmployees'][''] = $data[''];
    }

    private function partsData($data, $orderId, $carId) {
        $this->_partsData['Part'] = array_values($data['Part']);
        for ($i = 0; $i < count($this->_partsData['Part']); $i++) {
            $this->_partsData['Part'][$i]['description'] = $this->_partsData['Part'][$i]['part_description'];
            $this->_partsData['Part'][$i]['count'] = $this->_partsData['Part'][$i]['part_count'];
            $this->_partsData['Part'][$i]['price'] = $this->_partsData['Part'][$i]['part_price'];
            unset($this->_partsData['Part'][$i]['part_description']);
            unset($this->_partsData['Part'][$i]['part_count']);
            unset($this->_partsData['Part'][$i]['part_price']);

            $this->_partsData['Part'][$i]['order_id'] = $orderId;
            $this->_partsData['Part'][$i]['car_id'] = $carId;
        }
    }

    private function getOrders($date = null) {
        if (!$date) {
            $date = date('Y-m-d');
        }
        $orders = $this->Order->find('all', array(
            'conditions' => array('Order.user_id' => $this->Auth->user('id'), 'Order.created' => $date),
            'order' => 'Order.created DESC',
        ));

        $this->loadModel('Client');
        $this->loadModel('Car');

        $i = 0;
        foreach ($orders as $order) {
            $car = $this->Car->find('first', array(
                'conditions' => array('Car.id' => $order['Order']['car_id'])
            ));

            if (!$car) {
                unset($orders[$i]);
                continue;
            }

            $orders[$i]['Order']['car'] = $car['Car']['make'] . ' ' . $car['Car']['model'];
            $orders[$i]['Order']['car_reg_plate'] = $car['Car']['registration_plate'];

            $client = $this->Client->find('first', array(
                'conditions' => array('Client.id' => $car['Car']['client_id'])
            ));

            if (!$client) {
                unset($orders[$i]);
                continue;
            }

            $orders[$i]['Order']['client_name'] = $client['Client']['name'];
            $orders[$i]['Order']['client_phone'] = $client['Client']['phone'];
            $i++;
        }

        return $orders;
    }

    private function getRegistrationPlates() {
        $this->loadModel('Car');
        $cars = $this->Car->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id')),
            'fields' => array('Car.registration_plate'),
            'recursive' => 0
        ));

        $registration_plates = '';

        foreach ($cars as $car) {
            $registration_plates .= $car['Car']['registration_plate'] . ',';
        }

        return substr($registration_plates, 0, strlen($registration_plates) - 1);
    }

    public function getAddFormData($registration_plate) {
        if ($this->request->is('ajax')) {
            $this->disableCache();

            $this->loadModel('Car');
            $data = $this->Car->find('first', array(
                'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Car.registration_plate' => $registration_plate)
            ));

            $this->set('data', $data);
            $this->set('_serialize', array('data'));
        }
    }

}
