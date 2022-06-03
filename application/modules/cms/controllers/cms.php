<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'cms_model',
        ));
    } 

    public function footer(Type $var = null)
    {
        $data['title'] = display('cms');
        #-------------------------------#
        $this->form_validation->set_rules('email', '', 'required');

        //image upload
        $image = $this->fileupload->do_upload(
            'application/modules/cms/assets/images/offer/',
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

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $this->cms_model->update_footer([
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'phone_cs' => $this->input->post('phone_cs'),
				'link_apple' => $this->input->post('link_apple'),
				'link_android' => $this->input->post('link_android'),
				'copyright' => $this->input->post('copyright'),
                'logo' => (!empty($image) ? $image : $this->input->post('old_image')),
			]);

            redirect('cms/cms/footer');

        } else {

			$data['show'] = $this->cms_model->footer();
            $data['module'] = "cms";
            $data['page'] = "cms/footer";
            echo Modules::run('template/layout', $data);
        }
    }
    

    public function home(Type $var = null)
    {
        $data['title'] = display('cms');
        #-------------------------------#
        $this->form_validation->set_rules('content', '', 'required');

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $this->cms_model->update_home([
				'content' => $this->input->post('content'),
			]);

            redirect('cms/cms/home');

        } else {

			$data['show'] = $this->cms_model->home();
            $data['module'] = "cms";
            $data['page'] = "cms/home";
            echo Modules::run('template/layout', $data);
        }
    }

    public function facilities(Type $var = null)
    {
			$data['facilities'] = $this->cms_model->facilities();
            $data['module'] = "cms";
            $data['page'] = "cms/facilities_list";
            echo Modules::run('template/layout', $data);
    }

    public function facilities_form($id)
    {
        $data['title'] = display('cms');
        #-------------------------------#
        $this->form_validation->set_rules('title', '', 'required');
        $this->form_validation->set_rules('description', '', 'required');

        //image upload
        $image = $this->fileupload->do_upload(
            'application/modules/cms/assets/images/offer/',
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

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $checker = $this->cms_model->facilities_check($id);
            if (count($checker) < 1) {
                $this->cms_model->create_facilities([
                    'facilities_id' => $id,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'image' => (!empty($image) ? $image : $this->input->post('old_image')),
                ]);
            } else {
                $this->cms_model->update_facilities([
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'image' => (!empty($image) ? $image : $this->input->post('old_image')),
                ],$id);
            }

            redirect('cms/cms/facilities_form/'.$id);

        } else {

			$data['show'] = $this->cms_model->facilities_single($id);
            $data['module'] = "cms";
            $data['page'] = "cms/facilities_form";
            echo Modules::run('template/layout', $data);
        }
    }

    public function sosmed(Type $var = null)
    {
        $data['title'] = display('cms');
        #-------------------------------#
        $this->form_validation->set_rules('youtube', '', 'required');

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $this->cms_model->update_sosmed([
				'youtube' => $this->input->post('youtube'),
				'instagram' => $this->input->post('instagram'),
				'twitter' => $this->input->post('twitter'),
				'facebook' => $this->input->post('facebook'),
			]);

            redirect('cms/cms/sosmed');

        } else {

			$data['show'] = $this->cms_model->sosmed();
            $data['module'] = "cms";
            $data['page'] = "cms/sosmed";
            echo Modules::run('template/layout', $data);
        }
    }

    public function pointtext(Type $var = null)
    {
			$data['pointtext'] = $this->cms_model->pointtext();
            $data['module'] = "cms";
            $data['page'] = "cms/pointtext_list";
            echo Modules::run('template/layout', $data);
    }

    public function pointtext_form($id)
    {
        $data['title'] = display('cms');
        #-------------------------------#
        $this->form_validation->set_rules('title', '', 'required');
        $this->form_validation->set_rules('description', '', 'required');

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $this->cms_model->update_pointtext([
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'icon' => $this->input->post('icon'),
            ],$id);

            redirect('cms/cms/pointtext_form/'.$id);

        } else {

			$data['show'] = $this->cms_model->pointtext_single($id);
            $data['module'] = "cms";
            $data['page'] = "cms/pointtext_form";
            echo Modules::run('template/layout', $data);
        }
    }
    





    
    public function delete_offer($id = null)
    {
        $this->permission->method('cms', 'delete')->redirect();

        if ($this->cms_model->delete_offer($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('cms/setting/offer');
    }

}
