<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manifest_model extends CI_Model
{

    public function manifest_view()
    {
        return $this->db->select("
                mn.id,
                mn.status,
                mn.email_assign,
                mn.trip_date,
                mn.trip_assign,
                tr.trip_title,
                fr.reg_no
            ")
            ->from("manifest mn")
            ->join('trip_assign tras', 'mn.trip_assign = tras.id', 'left')
            ->join('trip tr', 'tras.trip = tr.trip_id', 'left')
            ->join('fleet_registration fr', 'fr.id = mn.fleet', 'left')
            ->order_by('mn.id', 'desc')
            ->get()
            ->result();
    }
    public function manifest_create($data = array())
    {
        $this->db->insert('manifest', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;

    }

    public function manifestInside($data = [])
    {
        return $this->db->insert('manifest_trip', $data);
    }

    public function delete_manifest($id = null)
    {
        $this->db->where('id', $id)
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

    public function update_manifest($id,$data = array())
    {
        return $this->db->where('id', $id)
            ->update("manifest", $data);
    }

    public function manifest_updateForm($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('manifest');
        return $query->row();
    }

    public function manifest_report($id)
    {
        return $this->db->select("
                c.*,
                b.allowance
            ")
            ->from("manifest a")
            ->join('trip_assign b', 'b.id = a.trip_assign')
            ->join('trip_expenses c', 'c.trip_id_no = b.id and c.trip_date = a.trip_date')
            ->where('a.id',$id)
            ->order_by('c.id', 'created_at')
            ->get()
            ->result();
    }

    public function manifest_saldo($id)
    {
        return $this->db->select("
                b.allowance
            ")
            ->from("manifest a")
            ->join('trip_assign b', 'b.id = a.trip_assign')
            ->where('a.id',$id)
            ->get()
            ->result();
    }

    public function manifest_trip($id)
    {
        return $this->db->select("
                mnt.trip_id_no,
                tr.trip_title
            ")
            ->from("manifest_trip mnt")
            ->join('trip tr', 'mnt.trip_id_no = tr.trip_id', 'left')
            ->order_by('mnt.id', 'desc')
            ->get()
            ->result();
    }

    public function delete_manifest_trip($id = null)
    {
        $this->db->where('manifest_id', $id)
            ->delete('manifest_trip');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
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

    public function tripAssignDropdown()
    {
        $data = $this->db->select("a.*, b.trip_title, c.reg_no")
            ->from('trip_assign a')
            ->join('trip b', 'b.trip_id = a.trip', 'left')
            ->join('fleet_registration c', 'c.id = a.fleet_registration_id', 'left')
            ->where('a.status', 1)
            ->order_by('a.id', 'asc')
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->trip_title;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function fleetDropdown()
    {
        $data = $this->db->select("id, reg_no")
            ->from('fleet_registration')
            ->where('status', 1)
            ->order_by('reg_no', 'asc')
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

    public function manifest_check($id)
    {
        return $this->db->select("
                a.trip_assign,
                a.trip_date
            ")
            ->from("manifest a")
            ->where('a.id',$id)
            ->get()
            ->row();
    }

    public function manifest_detail($trip_id_no,$booking_date)
    {
        $query = $this->db->select("
                tps.name,
                tbh.booking_code,
                tb.price,
                tb.adult,
                tps.ticket_number,
                tps.seat_number,
                tps.phone,
                rmen.food_name,
                IF(tps.baggage = 1, 'Bawa', 'Tidak Bawa') as baggage,
                IF(cst.status_name IS NULL, 'Menunggu', cst.status_name) as checkin_status,
                tb.pickup_trip_location,
                tb.drop_trip_location,
                tpoint.dep_time,
                tpoint.arr_time,
                ftp.type as class,
                tbh.created_at,
            ")
            ->from('tkt_passenger_pcs AS tps')
            ->join('tkt_booking AS tb', 'tps.booking_id = tb.id_no')
            ->join('tkt_booking_head AS tbh', 'tb.booking_code = tbh.booking_code')
            ->join('trip_assign AS tras', 'tb.trip_id_no = tras.trip')
            ->join('fleet_type AS ftp', 'ftp.id = tps.fleet_type')
            ->join('trip_point AS tpoint', 'tpoint.trip_assign_id = tras.id AND tpoint.dep_point = tb.pickup_trip_location AND tpoint.arr_point = tb.drop_trip_location')
            ->join('checkin AS cn', 'tps.ticket_number = cn.ticket_number','left')
            ->join('resto_menu AS rmen', 'tps.food = rmen.id','left')
            ->join('checkin_status AS cst', 'cn.status = cst.id','left')
            ->where('tras.id', $trip_id_no)
            ->where('tbh.payment_status', 1)
            ->where('DATE(tb.booking_date)', $booking_date)
            ->order_by('ftp.id','ASC')
            ->order_by('tps.seat_number','ASC')
            ->get()
            ->result();

        return $query;
    }

}
