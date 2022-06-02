<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends CI_Model {
 
    public function price_view()
	{
		return $this->db->select("
                a.*,b.reg_no,c.*,
                CONCAT_WS(' ', d.first_name, d.second_name) AS driver_name,
                CASE WHEN a.closed_by_id THEN 'bg-success' ELSE NULL END AS isClosed,
                e.name AS trip_route_name,
                ftp.type AS class
            ")
            ->from("trip_assign a")
            ->join('trip c','a.trip = c.trip_id','left')
            ->join('fleet_registration b','a.fleet_registration_id = b.id','left')
            ->join('fleet_type ftp','b.fleet_type_id = ftp.id','left')
            ->join('employee_history d','a.driver_id = d.id','left')
            ->join('trip_route e','c.route = e.id','left')
            ->order_by('a.id','desc')
            ->limit($limit, $start)
            ->get()
            ->result();
	}
	public function price_create($data = array())
	{
		return $this->db->insert('pri_price', $data);
	}

	public function delete_price($id = null)
	{
		$this->db->where('price_id',$id)
			->delete('pri_price');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function update_price($data = array())
	{
		return $this->db->where('price_id', $data["price_id"])
			->update("pri_price", $data);
	}
	public function price_updateForm($id){
        $this->db->where('price_id',$id);
        $query = $this->db->get('pri_price');
        return $query->row();
    }
public  function get_id($id)
    {
        $query=$this->db->get_where('pri_price',array('price_id'=>$id));
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
	

}
