<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('product_model');
        $this->load->model('categories/categories_model');
    }

    function index() {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . '/products/index';
        $config['total_rows'] = count($this->product_model->get_all());
        $config['per_page'] = 25;
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div> ';

        $config['next_link'] = "Next";
        $config['prev_link'] = "Previous";

        $config['cur_tag_open'] = '<a style="color:#000">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);
        $data['products'] = $this->product_model->fetch_products($config['per_page'], $this->uri->segment(3));

        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['success_message'] = $this->session->flashdata('success_message');
        $data['content'] = "content";
        $this->load->view('layout', $data);
    }

    function add() {

        //validate form input
        $this->form_validation->set_rules('code', "Code", 'required|xss_clean');
        $this->form_validation->set_rules('name', "Name", 'required|xss_clean');




        if ($this->form_validation->run() == true) {

            $data = array(
                'code' => $this->input->post('code'),
                'name' => $this->input->post('name'),
                'unit' => $this->input->post('unit'),
                'size' => $this->input->post('size'),
                'price' => $this->input->post('price'),
                'purchase_price' => $this->input->post('purchase_price'),
                'category_id' => $this->input->post('category_id'),
                'quantity' => $this->input->post('quantity')
            );
        }

        if ($this->form_validation->run() == true && $this->product_model->insert($data)) { //check to see if we are creating the customer
            //redirect them back to the admin page
            $this->session->set_flashdata('success_message', "Customer Added Successfully!");
            redirect("products", 'refresh');
        } else { //display the create customer form
            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $data['categories'] = $this->categories_model->get_all();
            $data['content'] = "add";
            $this->load->view('layout', $data);
        }
    }

    function edit($id = NULL) {


        //validate form input
        $this->form_validation->set_rules('name', "Name", 'required|xss_clean');
        $this->form_validation->set_rules('code', "Code", 'required|xss_clean');


        if ($this->form_validation->run() == true) {

            $data = array(
                'code' => $this->input->post('code'),
                'name' => $this->input->post('name'),
                'unit' => $this->input->post('unit'),
                'size' => $this->input->post('size'),
                'price' => $this->input->post('price'),
                'purchase_price' => $this->input->post('purchase_price'),
                'category_id' => $this->input->post('category_id'),
                'quantity' => $this->input->post('quantity')
            );
        }

        if ($this->form_validation->run() == true && $this->product_model->update($this->input->post('product_id'), $data)) {
            $this->session->set_flashdata('success_message', $this->lang->line("customer_updated"));
            redirect("products", 'refresh');
        } else {
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['product'] = $this->product_model->get($id);
            $data['categories'] = $this->categories_model->get_all();

            $data['id'] = $id;
            $data['content'] = 'edit';
            $this->load->view('layout', $data);
        }
    }

    function add_by_csv() {

        $groups = array('owner', 'admin');
        if (!$this->ion_auth->in_group($groups)) {
            $this->session->set_flashdata('message', $this->lang->line("access_denied"));
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            redirect('module=products', 'refresh');
        }

        $this->form_validation->set_rules('userfile', $this->lang->line("upload_file"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            if (DEMO) {
                $this->session->set_flashdata('message', $this->lang->line("disabled_in_demo"));
                redirect('module=home', 'refresh');
            }

            if (isset($_FILES["userfile"])) /* if($_FILES['userfile']['size'] > 0) */ {

                $this->load->library('upload');

                $config['upload_path'] = 'assets/uploads/csv/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '200';
                $config['overwrite'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error);
                    redirect("module=suppliers&view=add_by_csv", 'refresh');
                }

                $csv = $this->upload->file_name;

                $arrResult = array();
                $handle = fopen("assets/uploads/csv/" . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);

                $keys = array('name', 'email', 'phone', 'company', 'address', 'city', 'state', 'postal_code', 'country');

                $final = array();

                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
                $rw = 2;
                foreach ($final as $csv) {
                    if ($this->product_model->getCustomerByEmail($csv['email'])) {
                        $this->session->set_flashdata('message', $this->lang->line("check_customer_email") . " (" . $csv['email'] . "). " . $this->lang->line("customer_already_exist") . " " . $this->lang->line("line_no") . " " . $rw);
                        redirect("module=products&view=add_by_csv", 'refresh');
                    }
                    $rw++;
                }
            }

            $final = $this->mres($final);
            //$data['final'] = $final;
        }

        if ($this->form_validation->run() == true && $this->product_model->add_products($final)) {
            $this->session->set_flashdata('success_message', $this->lang->line("products_added"));
            redirect('module=products', 'refresh');
        } else {

            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['userfile'] = array('name' => 'userfile',
                'id' => 'userfile',
                'type' => 'text',
                'value' => $this->form_validation->set_value('userfile')
            );

            $meta['page_title'] = $this->lang->line("add_products_by_csv");
            $data['page_title'] = $this->lang->line("add_products_by_csv");
            $this->load->view('commons/header', $meta);
            $this->load->view('add_by_csv', $data);
            $this->load->view('commons/footer');
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id) {
            $this->product_model->delete($id);
        } else {
            return FALSE;
        }
    }

    function suggestions() {
        $term = $this->input->get('term', TRUE);

        if (strlen($term) < 2)
            break;

        $rows = $this->product_model->getCustomerNames($term);

        $json_array = array();
        foreach ($rows as $row)
            array_push($json_array, $row->name);

        echo json_encode($json_array);
    }

}
