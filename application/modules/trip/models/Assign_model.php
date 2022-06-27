<?php defined('BASEPATH') or exit('No direct script access allowed');

class Assign_model extends CI_Model
{

    private $table = "trip_assign";

    public function create($data = [])
    {
        //print_r($data);exit;
        return $this->db->insert($this->table, $data);
    }

    public function read($limit = null, $start = null)
    {
        return $this->db->select("a.*,b.reg_no,c.*,CONCAT_WS(' ', d.first_name, d.second_name) AS driver_name,CASE WHEN a.closed_by_id THEN 'bg-success' ELSE NULL END AS isClosed,e.name AS trip_route_name")
            ->from("trip_assign a")
            ->join('trip c', 'a.trip = c.trip_id', 'left')
            ->join('fleet_registration b', 'a.fleet_registration_id = b.id', 'left')
            ->join('employee_history d', 'a.driver_id = d.id', 'left')
            ->join('trip_route e', 'c.route = e.id', 'left')
            ->order_by('a.id', 'desc')
            ->limit($limit, $start)
            ->get()
            ->result();

    }

    public function findById($id = null)
    {
        return $this->db->select("
			a.*,
			a.status as statusassign,
			c.*,
			b.reg_no AS fleet_registration_name,
			e.name AS trip_route_name,
			CONCAT_WS(' ', d.first_name, d.second_name) AS driver_name,
			CONCAT_WS(' ', a1.first_name, a1.second_name) AS assistant_1_name,
			CONCAT_WS(' ', a2.first_name, a2.second_name) AS assistant_2_name,
			CONCAT_WS(' ', a3.first_name, a3.second_name) AS assistant_3_name,
			CONCAT_WS(' ', u.firstname, u.lastname) AS closed_by_id
		")
            ->from("trip_assign a")
            ->join('trip c', 'a.trip = c.trip_id', 'left')
            ->join('trip_route e', 'c.route = e.id', 'left')
            ->join('fleet_registration b', 'a.fleet_registration_id = b.id', 'left')
            ->join('employee_history d', 'a.driver_id = d.id', 'left')
            ->join('employee_history AS a1', 'a1.id = a.assistant_1', 'left')
            ->join('employee_history AS a2', 'a2.id = a.assistant_2', 'left')
            ->join('employee_history AS a3', 'a3.id = a.assistant_3', 'left')
            ->join('user AS u', 'u.id = a.closed_by_id', 'left')
            ->where('a.id', $id)
            ->get()
            ->row();
    }

    public function findByIdNo($id_no = null)
    {
        return $this->db->select("
			t.*,
			fr.reg_no AS fleet_registration_name,
			tr.name AS trip_route_name,
			CONCAT_WS(' ', d.first_name, d.second_name) AS driver_name,
			CONCAT_WS(' ', a1.first_name, a1.second_name) AS assistant_1_name,
			CONCAT_WS(' ', a2.first_name, a2.second_name) AS assistant_2_name,
			CONCAT_WS(' ', a3.first_name, a3.second_name) AS assistant_3_name,
			CONCAT_WS(' ', u.firstname, u.lastname) AS closed_by_id
		")->from("trip_assign AS t")
            ->join('trip AS tp', 'tp.trip_id = t.trip', 'left')
            ->join('fleet_registration AS fr', 't.fleet_registration_id =fr.id', 'left')
            ->join('trip_route AS tr', 'tr.id = tp.route', 'left')
            ->join('employee_history AS d', 'd.id = t.driver_id', 'left')
            ->join('employee_history AS a1', 'a1.id = t.assistant_1', 'left')
            ->join('employee_history AS a2', 'a2.id = t.assistant_2', 'left')
            ->join('employee_history AS a3', 'a3.id = t.assistant_3', 'left')
            ->join('user AS u', 'u.id = t.closed_by_id', 'left')
            ->where('t.id_no', $id_no)
            ->get()
            ->row();
    }

    public function update($data = [])
    {
        return $this->db->where('id', $data['id'])
            ->update($this->table, $data);
    }

    public function delete($id = null)
    {
        $this->db->where('id', $id)
            ->delete($this->table);

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function readOnlyClosedTrip($limit = null, $start = null)
    {
        return $this->db->select("a.*,b.reg_no,c.*,CONCAT_WS(' ', d.first_name, d.second_name) AS driver_name,e.name AS trip_route_name")
            ->from("trip_assign a")
            ->join('trip c', 'a.trip = c.trip_id', 'left')
            ->join('fleet_registration b', 'a.fleet_registration_id = b.id', 'left')
            ->join('employee_history d', 'a.driver_id = d.id', 'left')
            ->join('trip_route e', 'c.route = e.id', 'left')
            ->where_not_in('a.closed_by_id', ['', 0])
            ->limit($limit, $start)
            ->get()
            ->result();
    }

    public function fleet_dropdown()
    {
        $data = $this->db->select("*")
            ->from("fleet_registration")
        // ->where('is_assign',0)
            ->where('status', 1)
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->reg_no;
            }

            return $list;
        } else {
            return false;
        }
    }
    // Fleet List for update
    public function fleet_dropdown_update()
    {
        $data = $this->db->select("*")
            ->from("fleet_registration")
            ->where('status', 1)
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->reg_no;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function driver_dropdown()
    {

        $data = $this->db->select("id, CONCAT_WS(' ',first_name, second_name) AS name")
            ->from("employee_history")
            ->where('position', 'Driver')
        // ->where('is_assign',0)
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->name;
            }

            return $list;
        } else {
            return false;
        }
    }
    // update driver dropdown
    public function driver_dropdown_update()
    {

        $data = $this->db->select("id, CONCAT_WS(' ',first_name, second_name) AS name")
            ->from("employee_history")
            ->where('position', 'Driver')
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->name;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function assistant_dropdown()
    {
        $data = $this->db->select("id, CONCAT_WS(' ',first_name, second_name) AS name")
            ->from("employee_history")
            ->where('position', 'Assistant')
        // ->where('is_assign',0)
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->name;
            }

            return $list;
        } else {
            return false;
        }
    }

    // Update dropdowdn
    public function assistant_dropdown_update()
    {
        $data = $this->db->select("id, CONCAT_WS(' ',first_name, second_name) AS name")
            ->from("employee_history")
            ->where('position', 'Assistant')
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->name;
            }

            return $list;
        } else {
            return false;
        }
    }
// insert shedule
    public function create_shedule($data = [])
    {
        return $this->db->insert('shedule', $data);
    }
    public function update_shedule($data = [])
    {
        return $this->db->where('shedule_id', $data['shedule_id'])
            ->update('shedule', $data);
    }

    public function findById_shedule($id = null)
    {
        return $this->db->select("*")->from("shedule ")
            ->where('shedule_id', $id)
            ->get()
            ->row();
    }
    public function shedule_list()
    {
        return $this->db->select("*")
            ->from("shedule ")
            ->get()
            ->result();
    }

    public function delete_shedule($id = null)
    {
        $this->db->where('shedule_id', $id)
            ->delete('shedule');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function shedule_dropdown()
    {
        $data = $this->db->select("shedule_id, CONCAT_WS(' - ', start, end) AS shedule_time")
            ->from("shedule")
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->shedule_id] = $value->shedule_time;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function trip_dropdown()
    {
        $data = $this->db->select("*")
            ->from("trip")
            ->where('status', 1)
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

    public function resto_dropdown()
    {
        $data = $this->db->select("*")
            ->from("resto")
            ->where('status', 1)
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->resto_name;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function getTripPoint($tripAssignId)
    {
        $trip = $this->db->select("*")
            ->from("trip_point")
            ->where("trip_assign_id", $tripAssignId)
            ->get()
            ->result();

        foreach ($trip as $key => $value) {
            $price = $this->db->select("a.*, b.type as class")
                ->from("trip_point_price a")
                ->where("a.point_id", $value->id)
                ->join("fleet_type b", "b.id = a.type")
                ->get()
                ->result();
            $value->price = $price;
        }
        
        return $trip;
    }

    public function getTripPointUpdate($id)
    {
        $trip = $this->db->select("*")
            ->from("trip_point")
            ->where("id", $id)
            ->get()
            ->result();

        foreach ($trip as $key => $value) {
            $price = $this->db->select("a.*, b.type as class")
                ->from("trip_point_price a")
                ->where("a.point_id", $value->id)
                ->join("fleet_type b", "b.id = a.type")
                ->get()
                ->result();
            $value->price = $price;
        }
        
        return $trip;
    }

    public function getFleetType($traid)
    {
        return $this->db->select("frt.*,ft.type as typeName")
            ->from("fleet_registration_type frt")
            ->join("fleet_registration fr", "fr.reg_no = frt.registration")
            ->join("trip_assign ta", "ta.fleet_registration_id = fr.id")
            ->join("fleet_type ft", "ft.id = frt.type")
            ->where("ta.id", $traid)
            ->get()
            ->result();
    }

    public function getTripRoute($tripAssignId)
    {
        return $this->db->select("trpr.stoppage_points")
            ->from('trip_assign ta')
            ->join('trip tr', 'ta.trip = tr.trip_id')
            ->join('trip_route trpr', 'tr.route = trpr.id')
            ->where("ta.id", $tripAssignId)
            ->get()
            ->row();
    }

    public function pointSave($data)
    {
        $this->db->insert('trip_point', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function pointTypeSave($data)
    {
        $this->db->insert('trip_point_price', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function pointSaveUpdate($data,$id)
    {
        return $this->db->where('id', $id)
            ->update('trip_point', $data);
    }

    public function pointTypeDelete($pointid)
    {
        $this->db->where('point_id', $pointid)
            ->delete('trip_point_price');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePoint($id = null)
    {
        $this->db->where('id', $id)
            ->delete('trip_point');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function type_dropdown($tid)
    {
        $data = $this->db->select("ft.*")
            ->from("fleet_type ft")
            ->join("trip_point_price tpr", "tpr.type = ft.id")
            ->join("trip_point tpoint", "tpoint.id = tpr.point_id")
        // ->where('is_assign',0)
            ->where('ft.status', 1)
            ->where('tpoint.trip_assign_id', $tid)
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->type;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function getPriceext($tripAssignId)
    {
        return $this->db->select("
				tpe.id
				,tpe.date
				,tpe.price
				,ft.type
			")
            ->from("trip_price_ext tpe")
            ->join("fleet_type ft", "ft.id = tpe.type", 'left')
            ->where("assign_id", $tripAssignId)
            ->get()
            ->result();
    }

    public function priceextSave($data)
    {
        $this->db->insert('trip_price_ext', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

	public function deletePriceext($id = null)
    {
        $this->db->where('id', $id)
            ->delete('trip_price_ext');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
