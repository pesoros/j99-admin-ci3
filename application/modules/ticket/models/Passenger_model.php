<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Passenger_model extends CI_Model {
 
	private $table = "tkt_passenger";


	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}

	public function read($limit = null, $start = null)
	{
		$this->db->select("
			tp.*
			,tb.booking_code
			,tbh.payment_status
		");
		$this->db->from("tkt_passenger_pcs AS tp");
		$this->db->join("tkt_booking AS tb", "tp.booking_id = tb.id_no", "left") ;
		$this->db->join("tkt_booking_head AS tbh", "tb.booking_code = tbh.booking_code", "left") ;
		if ($this->session->userdata('isAdmin') == 0) {
			$this->db->where('tbh.agent', $this->session->userdata('id'));
		}
		$this->db->order_by('tp.id', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		// if ($query->num_rows() > 0) {
			return $query->result();
		// }
	} 

	public function passenger_ticket_info($id)
	{
		return $this->db->select("tb.*, tr.name AS route_name")
			->from("tkt_booking AS tb")
			->join("trip_route AS tr", "tr.id = tb.trip_route_id", "left") 
			->where('tb.tkt_passenger_id_no',$id)
			->get()
			->result();
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("
				t.*,
				CONCAT_WS(' ', t.firstname, t.middle_name, t.lastname) AS name
			")->from("tkt_passenger AS t")
			->where('id',$id) 
    		->limit($limit, $start)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 


	public function delete($id = null)
	{
		$this->db->where('id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function dropdown()
	{
		$data = $this->db->select("*")
			->from($this->table)
			->where('status', 1)  
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
