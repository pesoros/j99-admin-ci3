<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resto_controller extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'resto_model'
        ));      
    }

    public function create_resto()
    { 
        $this->permission->method('price', 'read')->redirect();
        #-------------------------------#
        $this->form_validation->set_rules('namaresto',display('namaresto ')  ,'required');
        $this->form_validation->set_rules('pic',display('pic ')  ,'required');
        $this->form_validation->set_rules('phone',display('phone ')  ,'required');
        $this->form_validation->set_rules('address',display('address ')  ,'required');
       
        #-------------------------------#
        if ($this->form_validation->run()) {
            $postData = [
                'status'  => 1,
                'resto_name'  => $this->input->post('namaresto',true),
                'pic'  => $this->input->post('pic',true),
                'phone'  => $this->input->post('phone',true),
                'address'  => $this->input->post('address',true),
            ];   

            if ($this->resto_model->resto_create($postData)) { 
                $this->session->set_flashdata('message', display('successfully_saved'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("resto/resto_controller/create_resto");
        } else {
            $data['title'] = "resto";
            $data['module']= "resto";
            $data['resto']    = $this->resto_model->resto_view();
            $data['page']  = "resto_form";   
            echo Modules::run('template/layout', $data); 
        }
    }

    public function resto_menu($id = null)
	{
		$data['menu'] = $this->resto_model->getMenu($id);
		$data['class'] = $this->resto_model->getClass();
		$data['id'] = $id;
		$data['module'] = "resto";
		$data['page']   = "resto_menu";   
		echo Modules::run('template/layout', $data);  
	}

    public function resto_menu_save(Type $var = null)
    {
        //image upload
        $image = $this->fileupload->do_upload(
            'application/modules/resto/assets/images/',
            'image'
        );
        // if image is uploaded then resize the image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize($image, 640, 380);
        }
        //if image is not uploaded
        if ($image === false) {
            $this->session->set_flashdata('exception', display('invalid_logo'));
        }

        $data['menu'] = (Object) $postData = [
			'id_resto'          => $this->input->post('resto_id'), 
			'food_name'          => $this->input->post('menu'), 
			'price'        => $this->input->post('price'),
			'class'        => $this->input->post('class'),
			'image'         => $image,   
			'status'        => 1,
		]; 

		$save = $this->resto_model->menuSave($postData);

		redirect("resto/resto_controller/resto_menu/".$this->input->post('resto_id')); 
    }

    public function resto_delete($id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->resto_model->delete_resto($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('resto/resto_controller/create_resto');
    }

    public function menu_deactivate($idResto,$id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->resto_model->deactivate_menu($id)) {
            #set success message
            $this->session->set_flashdata('message',display('close_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
		redirect("resto/resto_controller/resto_menu/".$idResto); 
    }

    public function menu_activate($idResto,$id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->resto_model->activate_menu($id)) {
            #set success message
            $this->session->set_flashdata('message',display('activate_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
		redirect("resto/resto_controller/resto_menu/".$idResto); 
    }

    public function resto_close($id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->resto_model->close_resto($id)) {
            #set success message
            $this->session->set_flashdata('message',display('close_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('resto/resto_controller/create_resto');
    }

    public function resto_activate($id=null){
        $this->permission->method('price','delete')->redirect();
        if($this->resto_model->activate_resto($id)) {
            #set success message
            $this->session->set_flashdata('message',display('activate_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('resto/resto_controller/create_resto');
    }

    public function resto_update($id = null)
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
            if ($this->resto_model->update_paket($Data)) { 
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
            $data['data']      =$this->resto_model->resto_updateForm($id);
            $data['module']    = "resto";    
            $data['page']      = "update_resto_form";   
            echo Modules::run('template/layout', $data);  
        }   
    }

}
