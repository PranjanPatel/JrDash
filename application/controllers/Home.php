<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
        {
        parent::__construct();
        $this->load->model('Common_model');
        // $id = $this->session->userdata('id');
        // $this->load->library('image_lib');
        //     $this->load->library('upload');
        }
	public function index()
	{
        $this->load->view('login_view');
    }
    public function users()
	{
        $this->load->view('login_view');
    }
     public function todo_add()
    {
        $data = array(
                'name' => $this->input->post('name'),
                'is_complete' => '0',
                'status' => 'active',
                'created_by' => $this->session->userdata('id')
            );
            $result = $this->Common_model->add_data('tb_todo',$data);
                    $msg = '';
        if ($result) {
        $msg .= 'Added in Todo list.';
        } else {
        $msg .= 'ERROR! Try Again';
        }
        return $msg;
        exit();
    }
    
    public function todo_delete($id = 0)
    {
            $this->Common_model->delete_data('tb_todo',array('id'=>$id));
            exit();
    }
    public function todo_update($id = 0,$isComplete = 0)
    {
        if($isComplete == 1){
            $this->Common_model->update_data('tb_todo',array('is_complete'=>0),array('id'=>$id));
        } else {
            $this->Common_model->update_data('tb_todo',array('is_complete'=>1),array('id'=>$id));
        }
            exit();
    }
    public function get_all_todoes()
    {
        $todoes = $this->Common_model->get_data_by_id(array('created_by' => $this->session->userdata('id')),'tb_todo');
        $html = '';
      
        foreach($todoes as $todo){
        $html .= '<tr>';
        $html .= "<td>".$todo['name']."</td>";
        $html .= "<td>";
        if($todo['is_complete'] == 1){
            $html .= "<a href='javascript:void(0)' onClick='updateTodo(".$todo['id'].",".$todo['is_complete'].")' id='deleteTodo'><i class='fa fa-times' aria-hidden='true'></i></a>";
        } else {
            $html .= "<a href='javascript:void(0)' onClick='updateTodo(".$todo['id'].",".$todo['is_complete'].")' id='deleteTodo'><i class='fa fa-check' aria-hidden='true'></i></a>";
        }
        $html .= "</td>";
        $html .= "<td>";
        $html .= "<a href='javascript:void(0)' onClick='deleteTodo(".$todo['id'].")' id='deleteTodo'><i class='fa fa-minus-circle' aria-hidden='true'></i></a>";
        $html .= "</td>";
        
        $html .= '</tr>';
        }

        echo $html;
    }
    public function get_all_notes(){
        $notes = $this->Common_model->get_data_by_id(array('created_by' => $this->session->userdata('id')),'tb_notes');
        $html = '';
        foreach($notes as $note){
            $html .= '<tr>';
            // $html .= "<td>".$note['title']."</td>";
            $html .= "<td>";
            $html .= "<a href='javascript:void(0)' onClick='viewDescription(".$note['id'].")' id='editNote'>".$note['title']."</a>";
            $html .= "</td>";
            $html .= "<td>";
            $html .= "<a href='javascript:void(0)' onClick='updateNote(".$note['id'].")' id='editNote'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>";
            $html .= "</td>";
            $html .= "<td>";
            $html .= "<a href='javascript:void(0)' onClick='deleteNote(".$note['id'].")' id='deleteNote'><i class='fa fa-minus-circle' aria-hidden='true'></i></a>";
            $html .= "</td>";
            $html .= "</tr>";
            $html .= "<tr id='".$note['id']."DescHide' style='display:none'>";
            $html .= "<td colspan='3' style='display:block;'>";
            $html .= "<input type='text' class='form-control' disabled id='".$note['id']."Note' value='".$note['description']."'/>";
            $html .= "</td>";
            $html .= '</tr>';
            $html .= "<tr id='".$note['id']."Descedit' style='display:none'>";
            $html .= "<td colspan='3' style='display:block;'>";
            $html .= "<form method='post' id='notes_form_edit'>";
            $html .= "<input type='text' class='form-control' name='".$note['id']."titleEdit' id='".$note['id']."titleEdit' value='".$note['title']."'/>";
            $html .= "<textarea rows='3' name='".$note['id']."descriptionEdit' id='".$note['id']."descriptionEdit' style='width: 100%;'>".$note['description']."</textarea>";
            $html .= "<input type='button' onClick='saveUpdateNote(".$note['id'].")' class='btn btn-success' value='Save'>";
            $html .= "<input type='button' onClick='hideNoteEdit(".$note['id'].")' class='btn btn-default' value='Cancel'>";
            $html .= "</form>";
            $html .= "</td>";
            $html .= '</tr>';
            }
    
            echo $html;
    }
    public function note_delete($id = 0){
        $this->Common_model->delete_data('tb_notes',array('id'=>$id));
            exit();
    }
    public function note_add()
    {
        $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => 'active',
                'created_by' => $this->session->userdata('id')
            );
            $result = $this->Common_model->add_data('tb_notes',$data);
                    $msg = '';
        if ($result) {
        $msg .= 'Added in Todo list.';
        } else {
        $msg .= 'ERROR! Try Again';
        }
        return $msg;
        exit();
    }
    public function updateNote($id = 0){
        $data = array(
            'title' => $this->input->post($id.'titleEdit'),
            'description' => $this->input->post($id.'descriptionEdit'),
            'status' => 'active'
        );
        $result = $this->Common_model->update_data('tb_notes',$data,array('id'=>$id));
                $msg = '';
    if ($result) {
    $msg .= 'Added in Todo list.';
    } else {
    $msg .= 'ERROR! Try Again';
    }
    return $msg;
    exit();
    }
}
