<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet_registration_model extends CI_Model {
 
	private $table = "fleet_registration";


	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}

	public function typeInside($data = [])
	{	 
		return $this->db->insert('fleet_registration_type',$data);
	}

	public function read()
	{
		return $this->db->select("fr.*, ft.type as fleet_type")
			->from("fleet_registration as fr")
			->join("fleet_type as ft", "ft.id = fr.fleet_type_id", "left")
			->order_by('fr.reg_no','asc')
			->get()
			->result();
	} 

	public function findById($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('id',$id) 
			->get()
			->row();
	} 
	
	public function getType($reg)
	{
		return $this->db->select("
				frt.type as type_id
				,ft.type
			")
			->from("fleet_registration_type as frt")
			->join("fleet_type as ft", "ft.id = frt.type", "left")
			->where("registration",$reg)
			->order_by('frt.id','asc')
			->get()
			->result();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 


	public function deleteTypeUpdate($registration = null)
	{
		$this->db->where('registration',$registration)
			->delete('fleet_registration_type');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
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
				$list[$value->id] = $value->reg_no;
			return $list;
		} else {
			return false; 
		}
	}  
}
