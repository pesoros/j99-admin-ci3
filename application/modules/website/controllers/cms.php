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

    public function fasilitas()
    {
        $this->permission->module('website', 'update')->redirect();
        $data['title'] = display('website');
        #-------------------------------#
        $this->form_validation->set_rules('pemilihanseat', '', 'required');
        $this->form_validation->set_rules('onlinebooking', '', 'required');

        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $this->cms_model->update_fasilitas([
				'judul' => 'pemilihanseat',
				'konten' => $this->input->post('pemilihanseat')
			]);

			$this->cms_model->update_fasilitas([
				'judul' => 'onlinebooking',
				'konten' => $this->input->post('onlinebooking')
			]);

            redirect('website/cms/fasilitas');

        } else {

			$data['pemilihanseat'] = $this->cms_model->fasilitas('pemilihanseat');
			$data['onlinebooking'] = $this->cms_model->fasilitas('onlinebooking');
            $data['module'] = "website";
            $data['page'] = "cms/fasilitas";
            echo Modules::run('template/layout', $data);
        }
    }

    /*
    |____________________________________________________________________
    |
    | OFFER
    |____________________________________________________________________
    |
     */
    public function offer()
    {
        $this->permission->module('website', 'update')->redirect();
        $data['title'] = display('offer');
        #-------------------------------#
        $this->form_validation->set_rules('title', display('title'), 'required|max_length[50]');
        $this->form_validation->set_rules('position', display('position'), 'required|max_length[11]');
        #-------------------------------#
        //image upload
        $image = $this->fileupload->do_upload(
            'application/modules/website/assets/images/offer/',
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

        $data['offer'] = (object) $postData = [
            'title' => $this->input->post('title'),
            'position' => $this->input->post('position'),
            'image' => (!empty($image) ? $image : $this->input->post('old_image')),
        ];
        #-------------------------------#
        if ($this->form_validation->run() && (!empty($postData['image']))) {

            if ($this->cms_model->create_offer($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('website/setting/offer');

        } else {
            $data['offers'] = $this->cms_model->read_offer();
            $data['module'] = "website";
            $data['page'] = "setting/offer";
            echo Modules::run('template/layout', $data);
        }
    }

    public function delete_offer($id = null)
    {
        $this->permission->method('website', 'delete')->redirect();

        if ($this->cms_model->delete_offer($id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('website/setting/offer');
    }

}
