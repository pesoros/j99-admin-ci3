<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_controller extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'paket_model'
        ));      
    }

    public function create_paket()
    { 
        #-------------------------------#
        $this->form_validation->set_rules('pengirim',display('pengirim ')  ,'required');
        $this->form_validation->set_rules('nopengirim',display('nopengirim ')  ,'required');
        $this->form_validation->set_rules('penerima',display('penerima ')  ,'required');
        $this->form_validation->set_rules('nopenerima',display('nopenerima ')  ,'required');
        $this->form_validation->set_rules('berat',display('berat ')  ,'required');
        $this->form_validation->set_rules('panjang',display('panjang ')  ,'required');
        $this->form_validation->set_rules('lebar',display('lebar ')  ,'required');
        $this->form_validation->set_rules('dari',display('dari ')  ,'required');
        $this->form_validation->set_rules('ke',display('ke ')  ,'required');
        $this->form_validation->set_rules('price',display('price'),'required|max_length[20]');
       
        #-------------------------------#
        if ($this->form_validation->run()) {
            $packet_number = $this->codeGenerate('PK',10);
            $postData = [
                'packet_code'  => $packet_number,
                'sender_name'  => $this->input->post('pengirim',true),
                'sender_phone'  => $this->input->post('nopengirim',true),
                'receiver_name'  => $this->input->post('penerima',true),
                'receiver_phone'  => $this->input->post('nopenerima',true),
                'weight'  => $this->input->post('berat',true),
                'width'  => $this->input->post('panjang',true),
                'height'  => $this->input->post('lebar',true),
                'pool_sender_id'  => $this->input->post('dari',true),
                'pool_receiver_id'  => $this->input->post('ke',true),
                'price'           => $this->input->post('price',true),
            ];   

            if ($this->paket_model->paket_create($postData)) { 
                $this->session->set_flashdata('message', display('successfully_saved'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("paket/paket_controller/create_paket");
        } else {
            $data['title'] = "paket";
            $data['module']= "paket";
            $data['location_list'] = $this->paket_model->locationDropdown();
            $data['paket']    = $this->paket_model->paket_view();
            $data['page']  = "paket_form";   
            echo Modules::run('template/layout', $data); 
        }
    }

    public function paket_delete($id=null){
        if($this->paket_model->delete_paket($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('paket/paket_controller/create_paket');
    }

    public function paket_update($id = null)
    { 
        #-------------------------------#
         $this->form_validation->set_rules('id',display('id'));
         $this->form_validation->set_rules('pengirim',display('pengirim ')  ,'required');
        $this->form_validation->set_rules('nopengirim',display('nopengirim ')  ,'required');
        $this->form_validation->set_rules('penerima',display('penerima ')  ,'required');
        $this->form_validation->set_rules('nopenerima',display('nopenerima ')  ,'required');
        $this->form_validation->set_rules('berat',display('berat ')  ,'required');
        $this->form_validation->set_rules('panjang',display('panjang ')  ,'required');
        $this->form_validation->set_rules('lebar',display('lebar ')  ,'required');
        $this->form_validation->set_rules('dari',display('dari ')  ,'required');
        $this->form_validation->set_rules('ke',display('ke ')  ,'required');
        $this->form_validation->set_rules('price',display('price'),'required|max_length[20]');
        
        $id = $this->input->post('id');
       $paket_info = $this->db->select('*')->from('packet')->where('id',$id)->get();
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $Data = [    
                'packet_code'  => $packet_number,
                'sender_name'  => $this->input->post('pengirim',true),
                'sender_phone'  => $this->input->post('nopengirim',true),
                'receiver_name'  => $this->input->post('penerima',true),
                'receiver_phone'  => $this->input->post('nopenerima',true),
                'weight'  => $this->input->post('berat',true),
                'width'  => $this->input->post('panjang',true),
                'height'  => $this->input->post('lebar',true),
                'pool_sender_id'  => $this->input->post('dari',true),
                'pool_receiver_id'  => $this->input->post('ke',true),
                'price'           => $this->input->post('price',true),
            ];   
        if($paket_info->num_rows() < 2){
            if ($this->paket_model->update_paket($Data)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
        }else{
               $this->session->set_flashdata('exception', 'This Route Price Already Exist');  
            }
            redirect("paket/paket_controller/create_paket");

        } else {
            $data['title']     = display('update');
            $data['data']      =$this->paket_model->paket_updateForm($id);
            $data['rout']      = $this->paket_model->rout();
            $data['vehc']      = $this->paket_model->vehicles();
            $data['bb']        =$this->paket_model->get_id($id);
            $data['module']    = "paket";    
            $data['page']      = "update_paket_form";   
            echo Modules::run('template/layout', $data);  
        }   
    }

    public function codeGenerate($head = 'J99', $length = 12)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $result = $head . '-' . $randomString;

        return $result;
    }

}
