
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->library('session');

        // $id = $this->session->userdata('id');
        // $this->load->library('image_lib');
        //     $this->load->library('upload');
    }
    public function index()
    {
        $this->load->view('login_view');
    }
    public function process()
    {
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $result =  $this->Common_model->get_data_by_id(array('user_name' => $user), "tb_user");
        if (!empty($result)) {
            if (($user == $result[0]['user_name'] && md5($pass) == $result[0]['password'])) {
                //declaring session  
                $this->session->set_userdata(array('user' => $user,'id'=>$result[0]['user_id']));
                $this->load->view('TODO/home');
            } else {
                $data['error'] = 'Your Account is Invalid';
                $this->load->view('login_view', $data);
            }
        } else {
            $data['error'] = 'Your Account is Invalid';
            $this->load->view('login_view', $data);
        }
    }
    public function logout()
    {
        //removing session  
        $this->session->unset_userdata('user','id');
        redirect("Login");
    }

    public function openRegister()
    {
        $this->load->view('TODO/register');
    }

    public function register()
    {
        $pass = md5($this->input->post('password'));
        $data = array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('fname'),
            'user_name' => $this->input->post('userName'),
            'password' => $pass
        );
        $result = $this->Common_model->add_data('tb_user', $data);
        $msg = '';
        if ($result) {
            $this->load->view('login_view');
        } else {
            $msg .= 'ERROR! Try Again';
        }
        return $msg;
        exit();
    }
}
?> 