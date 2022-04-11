<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manifest_model extends CI_Model {
 
    public function manifest_view()
	{
		return $this->db->select("
                mn.id,
                mn.status,
                mn.email_assign,
                mn.trip_date,
                tr.trip_title
            ")
            ->from("manifest mn")
            ->join('trip tr','mn.trip_id_no = tr.trip_id','left')
            ->order_by('mn.id','desc')
            ->get()
            ->result();
	}
	public function manifest_create($data = array())
	{
		return $this->db->insert('manifest', $data);
	}

	public function delete_manifest($id = null)
	{
		$this->db->where('id',$id)
			->delete('manifest');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function close_manifest($id = null)
	{
        $data['status'] = 2;
		$this->db->where('id', $id)
			->update("manifest", $data);

			return true;
	} 

    public function update_paket($data = array())
	{
		return $this->db->where('id', $data["paket_id"])
			->update("manifest", $data);
	}
	public function paket_updateForm($id){
        $this->db->where('id',$id);
        $query = $this->db->get('packet');
        return $query->row();
    }
public  function get_id($id)
    {
        $query=$this->db->get_where('packet',array('id'=>$id));
        return $query->row_array();
    } 

    public function rout(){
        $this->db->select('*');
        $this->db->from('trip_route');
        $query=$this->db->get();
        $data=$query->result();
        $list[''] = display('select_option');
        if(!empty($data)){
            foreach ($data as  $value) {
                $list[$value->id]=$value->name;
            }
        }
        return $list;
    }

    public function vehicles(){
        $this->db->select('*');
        $this->db->from('fleet_type');
        $query=$this->db->get();
        $data=$query->result();
        $list[''] = display('select_option');
        if(!empty($data)){
            foreach ($data as  $value) {
                $list[$value->id]=$value->type;
            }
        }
        return $list;
    }
    // currency and web information
     public function retrieve_setting_editdata()
    {
        $this->db->select('*');
        $this->db->from('ws_setting');
        $this->db->where('id',1);
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
			foreach($data as $value)
				$list[$value->trip_id] = $value->trip_title;
			return $list;
		} else {
			return false; 
		}
	}

}
