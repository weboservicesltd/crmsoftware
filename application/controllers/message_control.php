<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message_control extends CI_Controller {
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Login_model');
  //$this->load->model('mahana_model');
  $this->load->model('menu_models');
  $this->load->model('User_model');
  $this->load->model('Message_model');
  $this->load->library('session');
  //$this->load->library('mahana_messaging');
	//$msg = $this->mahana_messaging->get_message($msg_id, $sender_id);
  $this->load->helper(array('form','url'));
 }
      public function compose_msg(){
        $data['title']='Inbox';
        $data['menus'] = $this->menu_models->menus();
        $data['company']=$this->menu_models->getCompanyLogo();
        $data['h']=$this->User_model->view_user();
        $this->load->view('templates/header.php',$data);
        $this->load->view('pages/compose.php');
        $this->load->view('templates/footer.php');
       }
       public function send_msg(){

           if($this->Message_model->send_message())
           {
             $data['title']='Inbox';
             $data['msg']="Message sent";
             $data['m']=$this->Message_model->getMessage();
             $data['menus'] = $this->menu_models->menus();
             $data['company']=$this->menu_models->getCompanyLogo();
             $this->load->view('templates/header.php',$data);
             $this->load->view('pages/inbox.php');
             $this->load->view('templates/footer.php');
           }
        }
         public function inbox()
         {
          $data['title']='Inbox';
          $data['menus'] = $this->menu_models->menus();
          $data['company']=$this->menu_models->getCompanyLogo();
          $data['m']=$this->Message_model->getMessage();
          //$data['count']=mysql_num_rows($data['m']);
          $this->load->view('templates/header.php',$data);
          $this->load->view('pages/inbox.php',$data);
          $this->load->view('templates/footer.php');
        }
        public function sentbox()
        {
          $data['title']='sentbox';
          $data['menus'] = $this->menu_models->menus();
          $data['company']=$this->menu_models->getCompanyLogo();
          $data['s']=$this->Message_model->getSentMessage();
          //$data['count']=mysql_num_rows($data['s']);
          $this->load->view('templates/header.php',$data);
          $this->load->view('pages/sentbox.php',$data);
          $this->load->view('templates/footer.php');
        }


  /*
        public function send_new_message()
        {
          if($this->session->userdata('user_id')!=''){
           $sender_id=$this->session->userdata('user_id');
         }
         else{
          $sender_id=$this->session->userdata('admin_id');
         }
        $reciever_id=$this->input->post('recipients');
        $title=$this->input->post('subject');
        $body=$this->input->post('body');
        $status=0;
        $data=array(
          'reciever_id'=>$reciever_id,
          'sender_id'=>$sender_id,
          'message_title'=>$title,
          'message_body'=>$body,
          'message_status'=>$status
        )
        $this->db->insert('message_details',$data);
        return true;
        }
*/
public function deleteMessage($checkbox)
{
  if($this->Message_model->delMessage())
  {
    $data['title']='sentbox';
    $data['menus'] = $this->menu_models->menus();
    $data['company']=$this->menu_models->getCompanyLogo();
    $data['s']=$this->Message_model->getSentMessage();
    //$data['count']=mysql_num_rows($data['s']);
    $this->load->view('templates/header.php',$data);
    $this->load->view('pages/sentbox.php',$data);
    $this->load->view('templates/footer.php');
  }
}

}
