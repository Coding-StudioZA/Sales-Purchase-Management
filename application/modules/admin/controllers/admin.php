<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     Login Controller
 * @author      M Arfan
 * @copyright   (c) 2014 CMS
 */
class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

    function change_profile() {
        $data = array(
            "name" => $this->input->post('name'),
            "username" => $this->input->post('username')
        );
        if ($this->input->post('password')) {
            $data['password'] = $this->input->post('password');
        }
        
       
        $this->admin_model->update(1 , $data);
        redirect('dashboard');
    }

    public function index() {
        if ($this->admin_model->loggedin()) {
            redirect('dashboard');
        }

        // Apply login rules 
        $rules = $this->admin_model->rules_login;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            // if validation true validate username and password
            if ($this->admin_model->login()) {
                redirect("dashboard");
            } else {
                // login failed 
                $this->session->set_flashdata('error', 'That username/password combination does not exist');
                redirect('admin', 'refresh');
            }
        }
        $this->load->view('admin/login');
    }

    public function logout() {
        $this->admin_model->logout();
        redirect('admin');
    }

}
