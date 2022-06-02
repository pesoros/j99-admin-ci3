<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_model extends CI_Model {
 
    public function paket_view()
	{
		return $this->db->select("
                pk.packet_code,
                pk.id as packet_id,
                pk.sender_name,
                pk.receiver_name,
                pk.sender_phone,
                pk.receiver_phone,
                tl1.name as sendfrom,
                tl2.name as sendto
            ")
            ->from("packet pk")
            ->join('trip_location tl1','pk.pool_sender_id = tl1.id','left')
            ->join('trip_location tl2','pk.pool_receiver_id = tl2.id','left')
            ->order_by('pk.id','desc')
            ->get()
            ->result();
	}
	public function paket_create($data = array())
	{
		return $this->db->insert('packet', $data);
	}

	public function delete_paket($id = null)
	{
		$this->db->where('id',$id)
			->delete('packet');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function update_paket($data = array())
	{
		return $this->db->where('id', $data["paket_id"])
			->update("packet", $data);
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
	
    public function locationDropdown()
	{
		$data = $this->db->select("*")
			->from('trip_location')
			->where('status', 1) 
			->order_by('name', 'asc')
			->get()
			->result();

		$list[''] = display('select_option');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->name;
			return $list;
		} else {
			return false; 
		}
	}

}
