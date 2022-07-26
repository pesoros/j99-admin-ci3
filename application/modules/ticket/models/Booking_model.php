<?php defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{

    private $table = "tkt_booking";

    public function create($data = [])
    {
        return $this->db->insert($this->table, $data);
    }

    public function read($limit = null, $start = null)
    {

        $this->db->select('tb.*
            , tr.name AS route_name
            ,tbh.booker
            ,tbh.payment_status as ps
            ,pr.payment_method
            ,pr.payment_channel_code
        ');
        $this->db->from('tkt_booking_head AS tbh');
        $this->db->join("tkt_booking AS tb", "tb.booking_code = tbh.booking_code");
        $this->db->join("trip_route AS tr", "tr.id = tb.trip_route_id", "left");
        $this->db->join("payment_registration AS pr", "pr.booking_code = tbh.booking_code", "left");
        if ($this->session->userdata('isAdmin') == 0) {
            $this->db->where('tbh.agent', $this->session->userdata('id'));
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('tb.id', 'desc');
        $query = $this->db->get();
        // if ($query->num_rows() > 0) {
            return $query->result();
        // }
        return false;

    }

    public function akumulasi()
    {

        $this->db->select('tb.*
            , tr.name AS route_name
            ,tbh.booker
            ,pr.payment_method
            ,pr.payment_channel_code
        ');
        $this->db->from('tkt_booking_head AS tbh');
        $this->db->join("tkt_booking AS tb", "tb.booking_code = tbh.booking_code");
        $this->db->join("trip_route AS tr", "tr.id = tb.trip_route_id", "left");
        $this->db->join("payment_registration AS pr", "pr.booking_code = tbh.booking_code", "left");
        if ($this->session->userdata('isAdmin') == 0) {
            $this->db->where('tbh.agent', $this->session->userdata('id'));
        }
        $this->db->order_by('tb.id', 'desc');
        $query = $this->db->get();
        // if ($query->num_rows() > 0) {
            return $query->result();
        // }
        return false;

    }

    public function findById($id_no = null)
    {
        return $this->db->select("
				tb.*,
				tr.name AS route_name,
				tp.image,
				trf.cancelation_fees,
				trf.causes,
				CONCAT_WS(' ', u.firstname, u.lastname) AS refund_by

			")->from("tkt_booking AS tb")
            ->join("trip_route AS tr", "tr.id = tb.trip_route_id", "left")
            ->join("tkt_passenger AS tp", "tp.id_no = tb.tkt_passenger_id_no", "left")
            ->join('tkt_refund AS trf', 'trf.tkt_booking_id_no = tb.id_no', "left")
            ->join('user AS u', 'u.id = trf.refund_by_id', "left")
            ->where('tb.id_no', $id_no)
            ->limit($limit, $start)
            ->get()
            ->row();
    }

    public function booking($booking_code = null)
    {
        // return booking data
        $result = $this->db->select("
                tb.*,
                tbh.booker,
                tbh.total_price,
                tbh.payment_status as ps,
                tr.name as route_name,
                pr.payment_method as method,
                pr.payment_channel_code as channel,
                pr.va_number as va,
                pr.mobile_link as link,
                tpoint.dep_time,
                tpoint.arr_time
            ")
            ->from('tkt_booking AS tb')
            ->join('tkt_booking_head AS tbh', 'tb.booking_code = tbh.booking_code', 'left')
            ->join('trip_route AS tr', 'tr.id = tb.trip_route_id', 'left')
            ->join('payment_registration AS pr', 'pr.booking_code = tb.booking_code', 'left')
            ->join('trip_assign AS tras', 'tb.trip_id_no = tras.trip')
            ->join('trip_point AS tpoint', 'tpoint.trip_assign_id = tras.id AND tpoint.dep_point = tb.pickup_trip_location AND tpoint.arr_point = tb.drop_trip_location')
            ->where('tb.booking_code', $booking_code)
            ->get()
            ->result();

        foreach ($result as $key => $value) {
            $value->ticket = $this->ticket($value->id_no);
        }

        return $result;
    }

    public function ticket($id_no)
    {
        return $this->db->select("
                tps.*,
                tb.price,
                rm.food_name as makanan,
                ftp.type as class
            ")
            ->from('tkt_passenger_pcs AS tps')
            ->join('tkt_booking AS tb', 'tb.id_no = tps.booking_id', 'left')
            ->join('resto_menu AS rm', 'rm.id = tps.food', 'left')
            ->join('fleet_type AS ftp', 'ftp.id = tps.fleet_type')
            ->where('tps.booking_id', $id_no)
            ->get()
            ->result();
    }

    public function website_setting()
    {
        return $this->db->get('ws_setting')->row();
    }

    public function update($data = [])
    {
        return $this->db->where('id_no', $data['id_no'])
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

    public function location_dropdown()
    {
        $data = $this->db->select("*")
            ->from("trip_location")
            ->where('status', 1)
            ->order_by('name', 'ASC')
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

    public function city_dropdown()
    {
        $data = $this->db->select("*")
            ->from("wil_city")
            ->order_by('name', 'ASC')
            ->get()
            ->result();

        $list[''] = display('select_option');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->name] = $value->name;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function route_dropdown()
    {
        $data = $this->db->select("*")
            ->from("trip_route")
            ->where('status', 1)
            ->order_by('name', 'ASC')
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

    public function facilities_dropdown()
    {
        $data = $this->db->select("*")
            ->from("fleet_facilities")
            ->where('status', 1)
            ->order_by('name', 'ASC')
            ->get()
            ->result();

        $list = array('' => 'Select One...');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->name;
            }

            return $list;
        } else {
            return false;
        }
    }

// paid information
    public function ticket_paid($id_no = null)
    {

        // return booking data
        return $this->db->select("*")
            ->from('tkt_booking')
            ->where('id_no', $id_no)
            ->get()
            ->result();
    }

    public function confirmation()
    {
        return $this->db->select("btr.*,btr.id as ids, tr.*")
            ->from("bank_transaction AS btr")
            ->join("tkt_booking AS tr", "tr.id_no = btr.booking_id", "left")
            ->order_by('btr.id', 'desc')
            ->get()
            ->result();
    }
    public function upaid_cash_bookig()
    {
        return $this->db->select("tb.*, tr.name AS route_name")
            ->from("tkt_booking AS tb")
            ->join("trip_route AS tr", "tr.id = tb.trip_route_id", "left")
            ->where('tb.payment_status', 2)
            ->order_by('id', 'desc')
            ->get()
            ->result();
    }
    // confirmation delete
    public function confirmation_delete($id = null)
    {
        $this->db->where('id', $id)
            ->delete('bank_transaction');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
// terms and condition  info
    public function terms_and_cond_data($id = null)
    {

        // return booking data
        return $this->db->select("*")
            ->from('payment_informations')
            ->where('id', $id)
            ->get()
            ->row();
    }
    public function term_and_condition_list()
    {
        return $terms = $this->db->select('*')
            ->from('payment_informations')
            ->get()
            ->result();
    }
    // terms delete
    public function terms_delete($id = null)
    {
        $this->db->where('id', $id)
            ->delete('payment_informations');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
// update terms and condition
    public function update_condition($data = [])
    {
        return $this->db->where('id', $data['id'])
            ->update('payment_informations', $data);
    }
    //create_terms
    public function create_terms($data = [])
    {
        return $this->db->insert('payment_informations', $data);
    }

    public function fleet_dropdown()
    {
        $data = $this->db->select("*")
            ->from("fleet_type")
            ->where('status', 1)
            ->get()
            ->result();

        $list = array('' => 'Select One...');
        if (!empty($data)) {
            foreach ($data as $value) {
                $list[$value->id] = $value->type;
            }

        }
        return $list;
    }
    public function count_ticket()
    {
        $this->db->select('*');
        $this->db->from('tkt_booking');
        if ($this->session->userdata('isAdmin') == 0) {
            $this->db->where('booked_by', $this->session->userdata('id'));
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
}
