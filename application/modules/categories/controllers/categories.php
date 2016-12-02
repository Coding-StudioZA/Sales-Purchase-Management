<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('categories_model');
    }

    function index() {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . '/categories/index';
        $config['total_rows'] = count($this->categories_model->get_all());
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
        $data['categories'] = $this->categories_model->fetch_categories($config['per_page'], $this->uri->segment(3));
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['success_message'] = $this->session->flashdata('success_message');
        $data['content'] = "content";
        $this->load->view('layout', $data);
    }

    public function AjaxList() {
        $per_page = $this->input->post('showEntries');
        $page = $this->input->post('page');
        $cur_page = $page;
        $page -= 1;
        $start = $page * $per_page;

        $data = array(
            'title' => 'Categories',
            'page' => $page,
            'cur_page' => $cur_page,
            'per_page' => $per_page,
            'start' => $start,
            'previous_btn' => true,
            'next_btn' => true,
            'first_btn' => true,
            'last_btn' => true,
            'meta' => ($this->input->post('meta')) ? $this->input->post('meta') : 'id',
            'order' => ($this->input->post('order')) ? $this->input->post('order') : 'DESC',
            'searchResults' => $this->input->post('searchResults')
        );

        $Query = $this->categories_model->lists($data, "list");
        $recCount = $this->categories_model->lists($data);

        $data['Query'] = $Query->result();
        $data['recCount'] = $recCount->num_rows();
        $data['view'] = "ajax/list";

        $this->session->set_flashdata('message', $this->input->post('message'));
        $this->load->view('ajaxLayout', $data);
    }

    public function AjaxCall() {
        $action_name = $this->input->post('action_name');
        $column_id = $this->input->post('column_id');
        $id = $this->input->post('id');
        $page_name = $this->input->post('page_name');
        $url = $this->input->post('url');

        $detail = $this->category_model->get($id);

        if ($action_name == "status") {
            if ($detail->cat_status == 1) {
                $this->category_model->update($id, array('cat_status' => 0));
                $chek = "<img src=" . base_url() . 'assets/images/icons/delete.png' . " title='Click here to activate this row' style='margin: 0px 12px;'>";
                echo message_success("Message!", "Status changed to deactivated");
                echo $icon = "<a href='javascript:ajax_call(\"$id\", \"$action_name\", \"$page_name\", \"$column_id\", \"$url\", false)'>" . $chek . "</a>";
                exit();
            } else {
                $this->category_model->update($id, array('cat_status' => 1));
                $chek = "<img src=" . base_url() . 'assets/images/icons/accept.png' . " title='Click here to deactivate this row' style='margin: 0px 12px;'>";
                echo message_success("Message!", "Status changed to activated");
                echo $icon = "<a href='javascript:ajax_call(\"$id\", \"$action_name\", \"$page_name\", \"$column_id\", \"$url\", false)'>" . $chek . "</a>";
                exit();
            }
        }
    }

    function add() {

        //validate form input
        $this->form_validation->set_rules('name', $this->lang->line("name"), 'required|xss_clean');

        if ($this->form_validation->run() == true) {

            $data = array(
                'name' => $this->input->post('name')
            );
        }

        if ($this->form_validation->run() == true && $this->categories_model->insert($data)) { //check to see if we are creating the Category
            //redirect them back to the admin page
            $this->session->set_flashdata('success_message', "Category Added Successfully!");
            redirect("categories", 'refresh');
        } else { //display the create Category form
            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['name'] = array('name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('name'),
            );

            $data['content'] = "add";
            $this->load->view('layout', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id) {
            $this->categories_model->delete($id);
        } else {
            return FALSE;
        }
    }

    function edit($id = NULL) {


        //validate form input
        $this->form_validation->set_rules('name', $this->lang->line("name"), 'required|xss_clean');


        if ($this->form_validation->run() == true) {

            $data = array(
                'name' => $this->input->post('name')
            );
        }

        if ($this->form_validation->run() == true && $this->categories_model->update($this->input->post('category_id'), $data)) {
            $this->session->set_flashdata('success_message', $this->lang->line("Category_updated"));
            redirect("categories", 'refresh');
        } else {
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['category'] = $this->categories_model->get($id);

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
                    redirect("module=categories&view=add_by_csv", 'refresh');
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
                    if ($this->categories_model->getCategoryByEmail($csv['email'])) {
                        $this->session->set_flashdata('message', $this->lang->line("check_Category_email") . " (" . $csv['email'] . "). " . $this->lang->line("Category_already_exist") . " " . $this->lang->line("line_no") . " " . $rw);
                        redirect("module=categories&view=add_by_csv", 'refresh');
                    }
                    $rw++;
                }
            }

            $final = $this->mres($final);
            //$data['final'] = $final;
        }

        if ($this->form_validation->run() == true && $this->categories_model->add_categories($final)) {
            $this->session->set_flashdata('success_message', $this->lang->line("categories_added"));
            redirect('module=categories', 'refresh');
        } else {

            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['userfile'] = array('name' => 'userfile',
                'id' => 'userfile',
                'type' => 'text',
                'value' => $this->form_validation->set_value('userfile')
            );

            $meta['page_title'] = $this->lang->line("add_categories_by_csv");
            $data['page_title'] = $this->lang->line("add_categories_by_csv");
            $this->load->view('commons/header', $meta);
            $this->load->view('add_by_csv', $data);
            $this->load->view('commons/footer');
        }
    }

    function suggestions() {
        $term = $this->input->get('term', TRUE);

        if (strlen($term) < 2)
            break;

        $rows = $this->categories_model->getCategoryNames($term);

        $json_array = array();
        foreach ($rows as $row)
            array_push($json_array, $row->name);

        echo json_encode($json_array);
    }

}
