<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     Login Module
 * @author      M Arfan 
 * @copyright   (c) 2014, CMS Development
 * @since       Version 0.1
 */
class admin_model extends MY_Model {

    // table name and rules defined for login form 
    
    public $rules_login = array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|trim'),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim')
    );

    public function __construct() {
        parent::__construct();
    }
    
    protected $primary_key = "id";
    protected $_table = 'administrator';

    /**
     * Admin login
     * @return boolean
     */
    public function login() {

        $user = $this->get_by(array(
            'username' => $this->input->post('username'),
            //'password' => md5($this->input->post('password')),
            'password' => $this->input->post('password'),
        ));
        if (count($user)) {
            // Log in user and store in session
            $data = array(
                'username' => $user->username,
                'name' => $user->name,
                'is_loggedin' => TRUE,
            );

            $this->session->set_userdata($data);
            return true;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
    }

    public function loggedin() {
        return $this->session->userdata('is_loggedin');
    }

}
