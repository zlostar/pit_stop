<?php

App::uses('AppController', 'Controller');

class ServiceTypesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        
    }

    public function index() {
        $this->ServiceType->recursive = 0;
       // $this->set('service_types', $this->paginate());
        $this->set('service_types', $this->ServiceType->find('all', array(
            'conditions' => array('ServiceType.user_id' => $this->Auth->user('id'))
        )));
    }

    public function view($id = null) {
        $this->ServiceType->id = $id;
        if (!$this->ServiceType->exists()) {
            throw new NotFoundException(__('Invalid Service Type'));
        }
        $this->set('service_type', $this->ServiceType->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->ServiceType->create();
            $this->request->data['ServiceType']['user_id'] = $this->Auth->user('id');
            
            if ($this->ServiceType->save($this->request->data)) {
                $this->Session->setFlash(__('The Service Type has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The Service Type could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->ServiceType->id = $id;
        if (!$this->ServiceType->exists()) {
            throw new NotFoundException(__('Invalid Service Type'));
        }
        
       
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ServiceType->save($this->request->data)) {
                $this->Session->setFlash(__('The Service Type has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The Service Type could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->ServiceType->read(null, $id);
            if ($this->Auth->user('id') !== $this->request->data['ServiceType']['user_id']) {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->ServiceType->id = $id;
        if (!$this->ServiceType->exists()) {
            throw new NotFoundException(__('Invalid Service Type'));
        }
        
        if ($this->ServiceType->delete()) {
            $this->Session->setFlash(__('Service Type deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Service Type was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}