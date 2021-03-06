<?php
class Requests extends Admin_controller {

    public function view($id = NULL)
    {
        $this->data['requests_item'] = $this->request_model->getrequests($id);
        if (empty($this->data['requests_item']))
        {
            show_404();
        }
        $this->data['title'] = $this->data['requests_item']['title'];
        $this->data['inner_view'] = 'requests/view';
        $this->load->view('template', $this->data);
    }
        
    public function index()
    {
        $this->data['requests'] = $this->request_model->getrequests();
        $this->data['title'] = 'Requests archive';
        $this->data['inner_view'] = 'requests/index';
        $this->load->view('template', $this->data);
    }
        
    public function edit($id = FALSE){
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        if ($id)
        {
            $this->data['requests_item'] = $this->request_model->getrequests($id);
            if (empty($this->data['requests_item']))
            {
                show_404();
            }
            $this->data['title'] = 'Edit request №:'.$id;
        }
        else
        {
            $this->data['title'] = 'Create a request';
            $this->data['requests_item'] = NULL;
        }
        if ($this->form_validation->run() === FALSE)
        {
            $this->data['inner_view'] = 'requests/edit';
            $this->load->view('template', $this->data);
        }
        else
        {
            $post = array(
                'title'   => $this->input->post('title'),
                'text'    => $this->input->post('text'),
                'user_id' => $this->session->userdata('logged_in')['id']
            );
            if (!$id)
            {
                $post['adddate'] = date("Y-m-d H:i:s");
            }
            if ($id)
            {
                $post['status'] = $this->input->post('status');
            }
            $this->request_model->set_data($id, $post);
            redirect('requests');
        }
    }
    
    public function delete($id)
    {
        $this->request_model->delete($id);
        redirect('requests');
    }
    
    public function filter($class, $id)
    {
        $this->data['requests'] = $this->request_model->filter_by_class('user', $id);
        $this->data['title'] = 'Requests archive';
        $this->data['inner_view'] = 'requests/index';
        $this->load->view('template', $this->data);
    }
}
?>