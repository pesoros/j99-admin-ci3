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
        #-------------------------------#
        $this->form_validation->set_rules('emailassign',display('emailassign ')  ,'required');
        $this->form_validation->set_rules('dateassign',display('dateassign ')  ,'required');
        $this->form_validation->set_rules('trip_assign',display('trip_assign ')  ,'required');
       
        #-------------------------------#
        if ($this->form_validation->run()) {
            $postData = [
                'status'  => 1,
                'email_assign'  => $this->input->post('emailassign',true),
                'trip_date'  => $this->input->post('dateassign',true),
                'trip_assign'  => $this->input->post('trip_assign',true),
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
            $data['trip_list'] = $this->manifest_model->tripAssignDropdown();
            $data['manifest']    = $this->manifest_model->manifest_view();
            $data['page']  = "manifest_form";   
            echo Modules::run('template/layout', $data); 
        }
    }

    public function addmanifest(Type $var = null)
    {
        $this->permission->method('price','update')->redirect();
        #-------------------------------#
         $this->form_validation->set_rules('emailassign',display('emailassign ')  ,'required');
         $this->form_validation->set_rules('dateassign',display('dateassign ')  ,'required');
        $tripId = $this->input->post('tripId') != null ? $this->input->post('tripId') : [];
        
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            
            $postData = [
                'status'  => 1,
                'email_assign'  => $this->input->post('emailassign',true),
                'trip_date'  => $this->input->post('dateassign',true),
                'trip_assign'  => $this->input->post('trip_assign',true),
                'fleet'  => $this->input->post('fleet',true),
            ];   

            $savaData = $this->manifest_model->manifest_create($postData);
            if ($savaData) { 
                $this->session->set_flashdata('message', display('successfully_saved'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("manifest/manifest_controller/create_manifest");

        } else {
            $data['title']     = 'manifest add';
            $data['data']      =[];
            $data['trip_list'] = $this->manifest_model->tripAssignDropdown();
            $data['fleet_list'] = $this->manifest_model->fleetDropdown();
            $data['module']    = "manifest";    
            $data['page']      = "add_manifest_form";   
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
        $this->form_validation->set_rules('emailassign',display('emailassign ')  ,'required');
        $this->form_validation->set_rules('dateassign',display('dateassign ')  ,'required');
       $tripId = $this->input->post('tripId') != null ? $this->input->post('tripId') : [];
        
       #-------------------------------#
       if ($this->form_validation->run() === true) {

            $postData = [
                'email_assign'  => $this->input->post('emailassign',true),
                'trip_date'  => $this->input->post('dateassign',true),
                'trip_assign'  => $this->input->post('trip_assign',true),
                'fleet'  => $this->input->post('fleet',true),
            ];   
            if ($this->manifest_model->update_manifest($id,$postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("manifest/manifest_controller/create_manifest");

        } else {
            $data['title']     = display('update');
            $data['data']      =$this->manifest_model->manifest_updateForm($id);
            $data['manifest_trip']      =$this->manifest_model->manifest_trip($id);
            $data['trip_list'] = $this->manifest_model->tripAssignDropdown();
            $data['fleet_list'] = $this->manifest_model->fleetDropdown();
            $data['module']    = "manifest";    
            $data['page']      = "update_manifest_form";   
            echo Modules::run('template/layout', $data);  
        }   
    }

    public function manifest_report($id=null){
        $data['title']     = 'Report';
        $data['data']      =$this->manifest_model->manifest_report($id);
        $data['saldo']      =$this->manifest_model->manifest_saldo($id);
        $data['module']    = "manifest";    
        $data['page']      = "manifest_report";   
        echo Modules::run('template/layout', $data);  
    }

    public function manifest_detail($id=null){
        $getman = $this->manifest_model->manifest_check($id);
        $data['title']     = 'Detail';
        $data['data']      =$this->manifest_model->manifest_detail($getman->trip_assign,$getman->trip_date,$id);
        $data['module']    = "manifest";    
        $data['page']      = "manifest_detail";   
        echo Modules::run('template/layout', $data);  
    }

    public function manifest_detail_pr($id=null){
        $getman = $this->manifest_model->manifest_check($id);
        $data['title']     = 'Detail';
        $data['data']      =$this->manifest_model->manifest_detail($getman->trip_assign,$getman->trip_date,$id);
        $data['module']    = "manifest";    
        $data['page']      = "manifest_detail_price";   
        echo Modules::run('template/layout', $data);  
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
