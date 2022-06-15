<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resto_model extends CI_Model
{

    public function resto_view()
    {
        return $this->db->select("
                rt.id,
                rt.resto_name,
                rt.pic,
                rt.phone,
                rt.address,
                rt.status
            ")
            ->from("resto rt")
            ->order_by('rt.resto_name', 'desc')
            ->get()
            ->result();
    }
    public function resto_create($data = array())
    {
        return $this->db->insert('resto', $data);
    }

    public function delete_resto($id = null)
    {
        $this->db->where('id', $id)
            ->delete('resto');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function close_resto($id = null)
    {
        $data['status'] = 0;
        $this->db->where('id', $id)
            ->update("resto", $data);

        return true;
    }

    public function activate_resto($id = null)
    {
        $data['status'] = 1;
        $this->db->where('id', $id)
            ->update("resto", $data);

        return true;
    }

    public function update_resto($data = array())
    {
        return $this->db->where('id', $data["resto_id"])
            ->update("resto", $data);
    }
    
    public function resto_updateForm($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('resto');
        return $query->row();
    }

    public function getMenu($id)
    {
        return $this->db->select("
                a.*,
                b.type as classname
            ")
            ->from("resto_menu as a")
            ->join("fleet_type as b","b.id = a.class","left")
            ->order_by('a.id', 'desc')
            ->get()
            ->result();
    }

    public function menuSave($data)
	{
		return $this->db->insert('resto_menu', $data);
	}

    public function deactivate_menu($id = null)
    {
        $data['status'] = 0;
        $this->db->where('id', $id)
            ->update("resto_menu", $data);

        return true;
    }

    public function activate_menu($id = null)
    {
        $data['status'] = 1;
        $this->db->where('id', $id)
            ->update("resto_menu", $data);

        return true;
    }

    public function get_id($id)
    {
        $query = $this->db->get_where('packet', array('id' => $id));
        return $query->row_array();
    }

    public function rout()
    {
        $this->db->select('*');
        $this->db->from('trip_route');
        $query = $this->db->get();
        $data = $query->result();
        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->name;
            }
        }
        return $list;
    }

    public function vehicles()
    {
        $this->db->select('*');
        $this->db->from('fleet_type');
        $query = $this->db->get();
        $data = $query->result();
        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->type;
            }
        }
        return $list;
    }
    // currency and web information
    public function retrieve_setting_editdata()
    {
        $this->db->select('*');
        $this->db->from('ws_setting');
        $this->db->where('id', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function tripDropdown()
    {
        $data = $this->db->select("*")
            ->from('trip')
            ->where('status', 1)
            ->order_by('trip_title', 'asc')
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->trip_id] = $value->trip_title;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function getClass()
    {
		$data = $this->db->select("id,type")
			->from('fleet_type')
			->get()
			->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach($data as $value)
                $list[$value->id] = $value->type;
            return $list;
        } else {
            return false; 
        }
	} 

}
