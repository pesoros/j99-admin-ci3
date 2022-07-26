<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Refund_model extends CI_Model {
 
	private $table = "tkt_refund";


	public function create($data = [])
	{	 
		$updata['payment_status'] = 2;
        $update = $this->db->where('booking_code',$data['tkt_booking_id_no'])
            ->update('tkt_booking_head',$updata);

		$ref = $this->db->insert($this->table,$data);
		
		$update = $this->db->where('booking_code',$data['tkt_booking_id_no'])
            ->update('tkt_booking',['tkt_refund_id' => '1']);

		return $ref;
	}

	public function read($limit = null, $start = null)
	{
		return $this->db->select("*")
			->from($this->table)
        	->limit($limit, $start)
			->order_by('date','desc')
			->get()
			->result();
	}   

	public function delete($id = null)
	{
		$this->db->where('tkt_booking_id_no',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

}
