<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manifest_controller extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'manifest_model'
        ));      
    }

    public function create_manifest()
    { 
        $this->permission->method('price', 'read')->redirect();
        #-------------------------------#
        $this->form_validation->set_rules('emailassign',display('emailassign ')  ,'required');
        $this->form_validation->set_rules('dateassign',display('dateassign ')  ,'required');
        $this->form_validation->set_rules('trip_id',display('trip_id ')  ,'required');
       
        #-------------------------------#
        if ($this->form_validation->run()) {
            $packet_number = $this->codeGenerate('PK',10);
            $postData = [
                'status'  => 1,
                'email_assign'  => $this->input->post('emailassign',true),
                'trip_date'  => $this->input->post('dateassign',true),
                'trip_id_no'  => $this->input->post('trip_id',true),
            ];   

            if ($this->manifest_model->manifest_create($postData)) { 
                $this->session->set_flashdata('message', display('successfully_saved'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("manifest/manifest_controller/create_manifest");
        } else {
            $data['title'] = "manifest";
            $data['module']= "manifest";
            $data['trip_list'] = $this->manifest_model->tripDropdown();
            $data['manifest']    = $this->manifest_model->manifest_view();
            $data['page']  = "manifest_form";   
            echo Modules::run('template/layout', $data); 
        }
    }

    public function manifest_delete($id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->manifest_model->delete_manifest($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('manifest/manifest_controller/create_manifest');
    }

    public function manifest_close($id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->manifest_model->close_manifest($id)) {
            #set success message
            $this->session->set_flashdata('message',display('close_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('manifest/manifest_controller/create_manifest');
    }

    public function manifest_update($id = null)
    { 
        $this->permission->method('price','update')->redirect();
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
            if ($this->manifest_model->update_paket($Data)) { 
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
            $data['data']      =$this->manifest_model->paket_updateForm($id);
            $data['rout']      = $this->manifest_model->rout();
            $data['vehc']      = $this->manifest_model->vehicles();
            $data['bb']        =$this->manifest_model->get_id($id);
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
