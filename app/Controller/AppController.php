<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    const DDS = 20;


    public $components = array(
        'Session',
        'RequestHandler',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
//            'authorize' => array('Controller')
        )
    );
    
//    public function isAuthorized($user) {
//        // Admin can access every action
//        if (isset($user['role']) && $user['role'] === 'admin') {
//            return true;
//        }
//
//        // Default deny
//        return false;
//    }

    public function beforeFilter() {
        $this->set('loggedIn', $this->Auth->loggedIn());
    }
    
    /*
     * Array to hold js variables to be used in layout/view.
     *
     * @var   array $_jsVars Array of the js variables to be used in the layout/view
     */
    var $_jsVars = array();
 
    /**
     * Method to set javascript variables
     *
     * This method puts the passed variable in an array. That array is
     * then converted to json object in layout and can be used
     * in js files
     *
     * @param string $name Name of the variable
     * @param mixed $value Value of the variable
     *
     * @return void
     */
    public function setJsVar($name, $value)
    {
        $this->_jsVars[$name] = $value;
    }//end setJsVar()
 
    /**
     * Function (callback) which gets called before rendering the output
     *
     * @return void
     */
    public function beforeRender()
    {
        // Set the jsVars array which holds the variables to be used in js
        $this->set('jsVars', $this->_jsVars);
    }
    
    public function calculateDDS($price) {
        return $price + (self::DDS / 100) * $price;
    }
}
