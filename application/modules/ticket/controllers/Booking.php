<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->autocancel();
        $this->autocancel_cashbookig();
		$this->load->model(array(
            'booking_model', 
            'country_model', 
            'passenger_model',
            'price/price_model',
            'website/website_model' 
		));		 
	}
 
	public function index()
	{   
        // $this->permission->method('ticket','read')->redirect();
         $currency_details = $this->price_model->retrieve_setting_editdata();
        foreach ($currency_details as $price) {
        }
        $currency=$price['currency'];
		$data['title']    = display('list');  
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('ticket/booking/index');
        $config["total_rows"] = $this->booking_model->count_ticket();
        $config["per_page"] = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["bookings"] = $this->booking_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #   
        $data['currency'] = $currency;
		$data['module'] = "ticket";
		$data['page']   = "booking/list";   
		echo Modules::run('template/layout', $data); 
	}  

    public function view($id = null)
    { 
        // $this->permission->method('ticket','create')->redirect(); 
        $data['title'] = display('view');
        #-------------------------------#
        $data['booking'] = $this->booking_model->booking($id);
        $data['appSetting'] = $this->booking_model->website_setting();
        $data['module'] = "ticket";
        $data['page']   = "booking/ticket";   
        echo Modules::run('template/layout', $data); 
    }


 	public function form()
	{ 
        // $this->permission->method('ticket','create')->redirect(); 
		$data['title'] = display('add');
		#-------------------------------#
        $data['city_dropdown'] = $this->booking_model->city_dropdown();
        $data['route_dropdown'] = $this->booking_model->route_dropdown();
        $data['facilities_dropdown'] = $this->booking_model->facilities_dropdown();
        $data['country_dropdown'] = $this->country_model->country();
        $data['tps'] = $this->booking_model->fleet_dropdown();
        $data['module'] = "ticket";
        $data['page']   = "booking/form";   
        echo Modules::run('template/layout', $data); 
	}


	public function delete($id = null) 
	{ 
        // $this->permission->method('ticket','delete')->redirect();

		if ($this->booking_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('ticket/booking/index');
	}
       
    /*
    |----------------------------------------------
    |  Add Passenger
    |----------------------------------------------     
    */

    public function newPassenger()
    {  
        // $this->permission->method('ticket','create')->redirect();
        #-------------------------------#
        $this->form_validation->set_rules('firstname', display('firstname')  ,'required|max_length[50]');
        $this->form_validation->set_rules('lastname', display('lastname')  ,'required|max_length[50]');
        $this->form_validation->set_rules('phone', display('phone')  ,'max_length[30]');
        $this->form_validation->set_rules('email', display('email')  ,'required|valid_email|is_unique[tkt_passenger.email]|max_length[100]');
        $this->form_validation->set_rules('address_line_1', display('address_line_1')  ,'max_length[255]');
        $this->form_validation->set_rules('address_line_2', display('address_line_2')  ,'max_length[255]');
        $this->form_validation->set_rules('city', display('city')  ,'max_length[50]');
        $this->form_validation->set_rules('zip_code', display('zip_code')  ,'max_length[6]');
        $this->form_validation->set_rules('country', display('country')  ,'max_length[20]'); 
        #-------------------------------#
        $data['passenger'] = (Object) $postData = [
            'id_no'      => $this->randID(), 
            'firstname'  => $this->input->post('firstname'), 
            'lastname'   => $this->input->post('lastname'), 
            'phone'      => $this->input->post('phone'), 
            'email'      => $this->input->post('email'), 
            'password'   => md5(12345), 
            'address_line_1' => $this->input->post('address_line_1'), 
            'address_line_2' => $this->input->post('address_line_2'), 
            'city'       => $this->input->post('city'), 
            'zip_code'   => $this->input->post('zip_code'), 
            'country'    => $this->input->post('country'), 
            'status'     => 1, 
        ]; 
        #-------------------------------#
        if ($this->form_validation->run()) { 

            if ($this->passenger_model->create($postData)) {  
                $data['status'] = true;
                $data['message'] = display('save_successfully');
                $data['passenger_id_no'] = $postData['id_no'];
                $data['email'] = $postData['email'];
            } else {
                $data['status'] = false;
                $data['exception'] = display('please_try_again');
            }

        } else {  
            $data['status'] = false;
            $data['exception'] = validation_errors();
        }   

        echo json_encode($data);
    }

 
    public function randID()
    {
        $result = ""; 
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $charArray = str_split($chars);
        for($i = 0; $i < 7; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return "P".$result;
    }



    /*
    |____________________________________________________________________
    |  
    | Validate input 
    |____________________________________________________________________
    |--------------------------------------------------------------------
    | tracking seats, price and offer
    |----------------------------------------------
    */
    private function checkBooking($tripIdNo = null, $fleet_type_id = null, $newSeats = null,$booking_date = null)
    {
        //---------------fleet seats----------------
        $fleetSeats = $this->db->select("
                total_seat, seat_numbers, fleet_facilities
            ")->from("fleet_type")
            ->where('id', $fleet_type_id)
            ->get()
            ->row();

        $seatArray = array();
        $seatArray = array_map('trim', explode(',', $fleetSeats->seat_numbers));
 
        //-----------------booked seats-------------------
        $bookedSeats = $this->db->select("
                tb.trip_id_no,
                SUM(tb.total_seat) AS booked_seats, 
                GROUP_CONCAT(tb.seat_numbers SEPARATOR ', ') AS booked_serial 
            ")
            ->from('tkt_booking AS tb')
            ->where('tb.trip_id_no', $tripIdNo)
            ->like('tb.booking_date',$booking_date,'after')
            ->group_start()
                ->where("tb.tkt_refund_id IS NULL", null, false)
                ->or_where("tb.tkt_refund_id", 0)
                ->or_where("tb.tkt_refund_id", null)
            ->group_end()
            ->get()
            ->row();

        $bookArray = array();
        $bookArray = array_map('trim', explode(',', $bookedSeats->booked_serial));


        //-----------------booked seats-------------------
        $newSeatArray = array();
        $newSeatArray = array_map('trim', explode(',', $newSeats));

        if (sizeof($newSeatArray) > 0) {

            foreach ($newSeatArray as $seat) {

                if (!empty($seat)) {
                    if (in_array($seat, $bookArray)) {
                        return false; 
                    } else if (!in_array($seat, $seatArray)) {
                        return false; 
                    }    
                     } 

            }  
            return true;
        } else {
            return false;
        } 
    }

    private function checkPassenger($passengerIdNo = null)
    {
        $result = $this->db->select("CONCAT_WS(' ', firstname, lastname) AS name ")
            ->from('tkt_passenger')
            ->where('id_no', $passengerIdNo)
            ->get()
            ->row();

        if (sizeof($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


    private function checkOffer($offerCode = null, $offerRouteId = null, $tripDate = null)
    { 
        $checkOffer =  $this->db->select("
                of.offer_name,
                of.offer_end_date,
                of.offer_number,
                of.offer_discount 
            ")->from("ofr_offer AS of")
            ->where("of.offer_code", $offerCode)
            ->where("of.offer_route_id", $offerRouteId)
            ->where("of.offer_start_date <=", $tripDate)
            ->where("of.offer_end_date   >=", $tripDate)
            ->get()
            ->row();

        $bookingOffer = 0;
        $bookingOffer = $this->db->select("COUNT(id) AS booked_offer")
            ->from('tkt_booking')
            ->where('offer_code', $offerCode)
            ->group_start()
                ->where("tkt_refund_id IS NULL", null, false)
                ->or_where("tkt_refund_id", 0)
                ->or_where("tkt_refund_id", null)
            ->group_end()
            ->get()
            ->row()
            ->booked_offer;

        $data = array();
        if (sizeof($checkOffer) > 0 && ($checkOffer->offer_number - $bookingOffer) > 0) { 
            return $checkOffer->offer_discount;
        } else {
            return 0;
        } 
 
    }

    private function checkPrice($routeId = null, $fleetTypeId = null, $requestSeat = null)
    { 
        //---------------price---------------------
        $tripPrice = $this->db->select("*")
            ->from('pri_price')
            ->where('route_id', $routeId)
            ->where('vehicle_type_id', $fleetTypeId)
            ->order_by('group_size', 'desc')
            ->get()
            ->result();

        $maxGroup = 0;
        $maxGroupPrice = 0;
        $price = 0;

        if (sizeof($tripPrice) > 0) {

            foreach ($tripPrice as $value) {
                
                $singlePrice = $value->price;
                $groupSeat   = $value->group_size;
                $groupPrice  = $value->group_price_per_person;
                $price = 0;

                if ($requestSeat < $groupSeat) {
                    $price = ($requestSeat * $singlePrice); 
                } else if ($requestSeat >= $groupSeat) {

                    if ($maxGroup < $groupSeat) {
                        $maxGroup = $groupSeat; 
                        $maxGroupPrice = $groupPrice; 
                    } 
                    $price = ($requestSeat * $maxGroupPrice);
                }  
            }
        }  

        return $price;
    }


    /*
    |____________________________________________________________________
    |  
    | AJAX Functions 
    |____________________________________________________________________
    |--------------------------------------------------------------------
    | Create booking 
    |----------------------------------------------
    */

    public function createBooking()
    { 
        $bodyRaw = $this->input->post();
        
        $chooseBus = explode("-", $bodyRaw["choosebus"]);
        $setBookingData["booker_id"] = $this->session->userdata('id');
        $setBookingData["booker_name"] = $this->session->userdata('fullname');
        $setBookingData["booker_phone"] = "-";
        $setBookingData["booker_email"] = $this->session->userdata('email');
        $setBookingData["payment_method"] = "CASH";
        $setBookingData["payment_channel_code"] = "-";
        $setBookingData["agent"] = 1;

        $setBookingData["pergi"]["trip_id_no"] = $chooseBus[0];
        $setBookingData["pergi"]["trip_route_id"] = $chooseBus[1];
        $setBookingData["pergi"]["pickup_location"] = $chooseBus[5];
        $setBookingData["pergi"]["drop_location"] = $chooseBus[6];
        $setBookingData["pergi"]["pricePerSeat"] = $chooseBus[2];;
        $setBookingData["pergi"]["booking_date"] = $bodyRaw['approximate_time'];
        $setBookingData["pergi"]["fleet_type_id"] = $chooseBus[3];

        foreach ($bodyRaw['name'] as $key => $value) {
            $setBookingData["pergi"]["seatPicked"][$key]["name"] = $bodyRaw['name'][$key];
            $setBookingData["pergi"]["seatPicked"][$key]["phone"] = $bodyRaw['phone'][$key];
            $setBookingData["pergi"]["seatPicked"][$key]["food"] = $bodyRaw['food'][$key];
            $setBookingData["pergi"]["seatPicked"][$key]["seat"] = $bodyRaw['seat'][$key];
            $setBookingData["pergi"]["seatPicked"][$key]["baggage"] = $bodyRaw['baggage'][$key];
        }

        $setBooking = $this->httpPostXform("https://api.tiketjuragan99.id/booking/add", $setBookingData);

        redirect("ticket/booking/index");
    }
         
    /*
    |----------------------------------------------
    |  id genaretor
    |----------------------------------------------     
    */
    public function randomId($id_no = null)
    { 
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $charArray = str_split($chars);
        for($i = 0; $i < 7; $i++) {
                $randItem = array_rand($charArray);
                $id_no .="".$charArray[$randItem];
        }

        $check = $this->db->select("id_no")
            ->from('tkt_booking')
            ->where('id_no', "B".$id_no)
            ->get()
            ->num_rows();

        if ($check > 0) {
            $id_no = strrev($id_no);
        } 
        return "B".$id_no;
    }



    /*
    *------------------------------------------------------
    * Trip schedule
    *------------------------------------------------------
    */

    //display trip list with date 
    public function findTripByRouteDate()
    {
        $type   =  $this->input->post('tps', true);
        $routeID = $this->input->post('route_id', true);
        $datees     = $this->input->post('date', true);
        $date     = date("Y-m-d", strtotime($datees));
        $startDate = date("Y-m-d H:i:s", strtotime($date. '-1 hour'));
        $endDate   = date("Y-m-d H:i:s", strtotime($date. "+3 hour"));
          $tripResult =  $this->db->query("SELECT 
            ta.`trip_id` AS id_no, 
            fr.`total_seat`,
            fr.`type` As type_name,
            tr.`name`,
            ta.`type`,
            sh.`start`,
            sh.`end`
            FROM trip AS ta
            LEFT JOIN fleet_type AS fr ON fr.`id` = ta.`type`
            LEFT JOIN trip_route AS tr ON tr.`id` = ta.`route`
            LEFT JOIN shedule AS sh ON sh.`shedule_id` = ta.`shedule_id`
            WHERE tr.`id`= $routeID
            AND fr.`id` = $type
            AND (!FIND_IN_SET(DAYOFWEEK('$date'),ta.`weekend`))
            GROUP BY ta.`trip_id`

            ")->result();

        $html = "<table class=\"table table-condensed table-striped\">
            <thead>
                <tr class=\"bg-primary\">
                    <th>#</th>
                    <th>" . display('start')            . "</th>
                    <th>" . display('end')            . "</th>
                    <th>" . display('available_seats') . "</th>
                    <th>" . display('types')    . "</th> 
                </tr>
            </thead>
            <tbody>";

        $available     = null;
        foreach ($tripResult as $value) { 
           

            $bookingResult = 0;
            $bookingResult = $this->db->select("SUM(tb.total_seat) AS available")
                ->from("tkt_booking AS tb")
                ->join('trip AS ta', "ta.trip_id = tb.trip_id_no")
                ->where('tb.trip_id_no', $value->id_no)
                ->like('tb.booking_date',$date,'after')
                ->group_start()
                    ->where("tb.tkt_refund_id IS NULL", null, false)
                    ->or_where("tb.tkt_refund_id", 0)
                    ->or_where("tb.tkt_refund_id", null)
                ->group_end()
                ->get()
                ->row()
                ->available; 

            if (($value->total_seat-$bookingResult) > 0)
            $html .= "<tr>
                    <td>
                        <input type=\"radio\" name=\"tripIdNo\" value=".$value->id_no." class=\"tripIdNo radio-inline\" data-fleetRegNo=\"$value->reg_no\" data-fleetTypeId=\"$value->type\"> 
                        <input type=\"hidden\" name=\"fleet_registration_id\" value=\"$value->reg_no\">
                        <input type=\"hidden\" name=\"fleet_type_id\" value=\"$value->type\">
                    </td>
                    <td>".$value->start."</td>
                    <td>".$value->end."</td>
                    <td class=\"text-center\">". ($value->total_seat-$bookingResult)."</td>
                    <td>".$value->type_name ."</td>
                </tr> ";
 
        } 

        if (!$tripResult) {
            $html .= "<tr><td colspan=\"4\">No trip available!</td></tr>";
        }
        $html .= "</tbody></table>"; 



        //---------------location---------------
        $tripLocation = $this->db->select('stoppage_points')
            ->from('trip_route')
            ->where('id', $routeID)
            ->get()
            ->row();

        $locationArray = array();
        $locationArray = array_map('trim', explode(',', $tripLocation->stoppage_points));
        $loc = "";
        foreach ($locationArray as $lx) {
            $loc .= "<option value=\"\">'Please Select Location'</option>";
            $loc .= "<option value=\"$lx\">$lx</option>";
        }

        echo json_encode(array(
            'html' => $html,
            'location' => $loc
        ));
    }


    /*
    *------------------------------------------------------
    * Seats
    *------------------------------------------------------
    */


    //find seats by trip id 
    public function findSeatsByTripID() 
    {
        $tripIdNo   = $this->input->post('tripIdNo', true);
        $fleetTp = $this->input->post('fleetTp', true);
        $bdate = $this->input->post('bdate', true);
        $date     = date("Y-m-d", strtotime($bdate));
        //-----------------booked seats-------------------
        $bookedSeats = $this->db->select("
                tb.trip_id_no,
                SUM(tb.total_seat) AS booked_seats, 
                GROUP_CONCAT(tb.seat_numbers SEPARATOR ', ') AS booked_serial 
            ")
            ->from('tkt_booking AS tb')
            ->where('tb.trip_id_no', $tripIdNo)
            ->like('tb.booking_date',$date,'after')
            ->group_start()
                ->where("tb.tkt_refund_id IS NULL", null, false)
                ->or_where("tb.tkt_refund_id", 0)
                ->or_where("tb.tkt_refund_id", null)
            ->group_end()
            ->get()
            ->row();


        $bookArray = array();
        $bookArray = array_map('trim', explode(',', $bookedSeats->booked_serial));


        //---------------fleet seats----------------
        $fleetSeats = $this->db->select("
                total_seat, seat_numbers, fleet_facilities
            ")->from("fleet_type")
            ->where('id', $fleetTp)
            ->get()
            ->row();

        $seatArray = array();
        $seatArray = array_map('trim', explode(',', $fleetSeats->seat_numbers));


        $html = "<h4 class=\"bg-primary\" style=\"padding:5px;margin:0\">". display('select_seats') ."</h4>";

        foreach ($seatArray as $seat) {
            if (in_array($seat, $bookArray)) {
                $html .= "<button style=\"margin:1px;min-width:60px\" type=\"button\" class=\"btn btn-sm btn-square btn-danger disabled\">$seat</button>";
            } else {
                $html .= "<button style=\"margin:1px;min-width:60px\" type=\"button\" class=\"btn btn-sm btn-square btn-primary ChooseSeat\">$seat</button>";
            }
        }


        //---------------find facilities---------------
        $facilities = "";
        $facilitiesArray = array();
        $facilitiesArray = array_map('trim', explode(',', $fleetSeats->fleet_facilities));
        if (sizeof($facilitiesArray) > 0) {
            foreach ($facilitiesArray as $key => $fa) {
                if ($fa != "")
                $facilities .= "<input id=\"f$key\" name=\"request_facilities[]\" class=\"inline-checkbox\" type=\"checkbox\" value=\"$fa\"> <label for=\"f$key\">$fa</label> ";
            }
        }

        echo json_encode(array(
            'html'=> $html,
            'facilities' => $facilities
        )); 
    }


    /*
    *------------------------------------------------------
    * Price & Discount
    * return price & group price
    *------------------------------------------------------
    */
    public function priceByRouteTypeAndSeat()
    {
        $routeId     = $this->input->post('routeId', true);
        $fleetTypeId = $this->input->post('fleetTypeId', true);
        $requestSeat = $this->input->post('totalSeat', true);
        $child       = $this->input->post('child', true);
        $adult       = $this->input->post('adult', true);
        $special     = $this->input->post('special', true);
        $checkseat   = $this->input->post('checkseat', true);
        //---------------price---------------------
        $tripPrice = $this->db->select("*")
            ->from('pri_price')
            ->where('route_id', $routeId)
            ->where('vehicle_type_id', $fleetTypeId)
            ->order_by('group_size', 'desc')
            ->get()
            ->result();
            if($checkseat=='false'){
               $data['status'] = false;
                $data['price'] = 0;
                 $data['exception'] = "Please check Seat !!";  
            }else{

        if (sizeof($tripPrice) > 0) {

            $maxGroup = 0;
            $maxGroupPrice = 0;
            $total_childgprice=0;
            $total_specialgprice=0;
            foreach ($tripPrice as $value) {
                
                $singlePrice = $value->price;
                $childprice  = $value->children_price;
                $specialprice = $value->special_price;
                $groupSeat  = $value->group_size;
                $groupPrice = $value->group_price_per_person;
                $price = 0;

                if ($requestSeat < $groupSeat OR $groupSeat < 1) {
                    $price = ($adult * $singlePrice);
                    $total_childprice   = ($child * $childprice);
                    $total_specialprice = ($specialprice * $special);
                    $data['status'] = true;
                    $data['price'] = $price+$total_childprice+$total_specialprice;

                } else if ($requestSeat >= $groupSeat) {

                    if ($maxGroup < $groupSeat) {
                        $maxGroup = $groupSeat; 
                        $maxGroupPrice = $groupPrice; 
                    } 
                    $total = ($adult * $maxGroupPrice);
                    $total_childgprice   = ($child * $maxGroupPrice);
                    $total_specialgprice = ($special * $maxGroupPrice);
                    //$price = ($requestSeat * $maxGroupPrice);

                    $data['status'] = true;
                    $data['price'] =  $total+$total_childgprice+$total_specialgprice ; 

                } else {

                    $data['status'] = false;
                    $data['price'] = $price;
                } 

            }

        } else {
            $data['status'] = false;
            $data['exception'] = "Price not found!";
        }
        }
   
        echo json_encode($data);
    }


    /*
    *------------------------------------------------------
    * Offer
    *------------------------------------------------------
    */

    public function findOfferByCode()
    {
        $offerCode    = $this->input->post('offerCode', true);
        $offerRouteId = $this->input->post('offerRouteId', true);
        $tripDate     = date("Y-m-d", strtotime($this->input->post('tripDate')));

        $checkOffer =  $this->db->select("
                of.offer_name,
                of.offer_end_date,
                of.offer_number,
                of.offer_discount 
            ")->from("ofr_offer AS of")
            ->where("of.offer_code", $offerCode)
            ->where("of.offer_route_id", $offerRouteId)
            ->where("of.offer_start_date <=", $tripDate)
            ->where("of.offer_end_date   >=", $tripDate)
            ->get()
            ->row();

        $bookingOffer = 0;
        $bookingOffer = $this->db->select("COUNT(id) AS booked_offer")
            ->from('tkt_booking')
            ->where('offer_code', $offerCode)
            ->group_start()
                ->where("tkt_refund_id IS NULL", null, false)
                ->or_where("tkt_refund_id", 0)
                ->or_where("tkt_refund_id", null)
            ->group_end()
            ->get()
            ->row()
            ->booked_offer;

        $data = array();
        if (sizeof($checkOffer) > 0 && ($checkOffer->offer_number - $bookingOffer) > 0) { 
            $data['status'] = true;
            $data['message'] = "The $checkOffer->offer_name offer will be exired on $checkOffer->offer_end_date ";
            $data['discount'] = $checkOffer->offer_discount;

        } else {
            $data['status'] = false;
            $data['message'] = "No offer found!";
        } 

        echo json_encode($data);
    }


    /*
    *------------------------------------------------------
    * Passenger
    *------------------------------------------------------
    */

    public function findPassengerName()
    {
        $passengerEamil = $this->input->post('passengerEamil', true);

        $result = $this->db->select("CONCAT_WS(' ', firstname, lastname) AS name,id_no ")
            ->from('tkt_passenger')
            ->where('email', $passengerEamil)
            ->get()
            ->row();

        if (sizeof($result) > 0) {
            $data['passenger_id'] = $result->id_no;
            $data['status'] = true;
            $data['name'] = "<span class=\"text-success\">$result->name</span>";
        } else {
            $data['status'] = false;
            $data['name']   = "<span class=\"text-danger\">Invalid passenger</span>";
        }

        echo json_encode($data);
    }
    // loacally ticket view
    public function ticket_view($booking_id_no = null)
    { 
        // $this->permission->method('ticket','create')->redirect(); 
        $data['title'] = display('view');
        #-------------------------------#
        $data['ticket'] = $this->booking_model->ticket($booking_id_no);
        $data['appSetting'] = $this->booking_model->website_setting();
        $data['module'] = "ticket";
        $data['page']   = "booking/ticket";   
        echo Modules::run('template/layout', $data); 
    }
    // booking paid information
    public function booking_paid()
    {
     

     $this->permission->method('ticket','create')->redirect(); 

        $data['title'] = display('paid');
        #-------------------------------#
        $id_no = $this->input->post('booking_id');
        $payinfo = $this->booking_model->ticket_paid($id_no);
        foreach ($payinfo as $payinfor) {
        }
        $id=$payinfor->id;
       $postData = [    'id'                   => $payinfor->id,  
                        'id_no'                => $id_no, 
                        'trip_id_no'           => $payinfor->trip_id_no, 
                        'tkt_passenger_id_no'  => $payinfor->tkt_passenger_id_no, 
                        'trip_route_id'        => $payinfor->trip_route_id, 
                        'pickup_trip_location' => $payinfor->pickup_trip_location, 
                        'drop_trip_location'   => $payinfor->drop_trip_location, 
                        'request_facilities'   => $payinfor->request_facilities, 
                        'price'                => $payinfor->price, 
                        'discount'             => $payinfor->discount, 
                        'total_seat'           => $payinfor->total_seat, 
                        'seat_numbers'         => $payinfor->seat_numbers, 
                        'offer_code'           => $payinfor->offer_code, 
                        'tkt_refund_id'        => $payinfor->tkt_refund_id, 
                        'agent_id'             => $payinfor->agent_id, 
                        'booking_date'         => $payinfor->booking_date,
                        'booking_type'         => $payinfor->booking_type,  
                        'date'                 => $payinfor->date,
                        'payment_status'       => ''
                    ];  
                $updata=$this->db->where('id_no',$id_no)
            ->update('tkt_booking',$postData);

              $pemail = $this->db->select('*')->from('tkt_passenger')->where('id_no',$payinfor->tkt_passenger_id_no)->get()->row();
               $id= $this->input->post('booking_id');
               $name= $pemail->firstname;
               if($updata){
               $email=$pemail->email;
                $this->load->library('pdfgenerator'); 
                $datas['appSetting'] = $this->website_model->read_setting();
                $datas['ticket'] = $this->website_model->getTicket($id);
                $html = $this->load->view('booking/ticket_pdf', $datas, true);
                $dompdf = new DOMPDF();
                $dompdf->load_html($html);
                $dompdf->render();
                $output = $dompdf->output();
                file_put_contents('assets/data/pdf/'.$id.'.pdf', $output);
                $file_path = 'assets/data/pdf/'.$id.'.pdf';
                 $send_email = '';
                 if (!empty($email)) {
                    $send_email = $this->setmail($email,$file_path,$id,$name);
                    redirect("ticket/booking/confirmation");
                 }
        }
    }
    
    // success mail strat

public function setmail($email,$file_path,$id=null,$name=null)
    {
$setting_detail = $this->db->select('*')->from('email_config')->get()->row();
       

        $subject ='ticket Information';
     $message =display('email_gritting').' '.$name.display('email_ticket_idinfo').'-'.$id;

        $config = Array(
            'protocol'      => $setting_detail->protocol,
            'smtp_host'     => $setting_detail->smtp_host,
            'smtp_port'     => $setting_detail->smtp_port,
            'smtp_user'     => $setting_detail->smtp_user, 
            'smtp_pass'     => $setting_detail->smtp_pass, 
            'mailtype'      => $setting_detail->mailtype,
            'charset'       => 'utf-8'
        );
        
 
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($setting_detail->smtp_user);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($file_path);

        $check_email = $this->test_input($email);

        if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {

            if($this->email->send())
            {
                $this->session->set_flashdata(array('message'=>display('email_send_to_passenger')));
                return true;
            }else{
                $this->session->set_flashdata(array('exception'=>display('please_configure_your_mail')));
                return false;
            }

        }else{
            $this->session->set_flashdata(array('message'=>display('successfully_added')));
            redirect("website/Paypal/local_success/". $id);
        }
    }

    //Email testing for email
    public function test_input($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
// sucessmail end    
    
    
    
    /*Booking cancel automaticallay
    |
    */
    public function autocancel(){
        $timezone=$this->db->select('*')->from('ws_setting')->where('id',1)->get()->row();
       $downtime=$this->db->select('*')->from('booking_downtime')->get()->result();
       foreach ($downtime as $down) {}
       $dntime=$down->downtime;
        $cancele = $this->db->select('*')->from('tkt_booking')->where('payment_status',1)->get()->result();

        if ($cancele) {
            foreach ($cancele as $can) { }
           $default= date_default_timezone_set($timezone->timezone);
            $day1 = $can->date;
            $day1 = strtotime($day1);
            $day2 = $date = date('Y-m-d H:i:s', time());
            $day2 = strtotime($day2);
            $diffHours = round(($day2 - $day1) / 3600)+0.001;
            // $sql = "DELETE FROM tkt_booking WHERE $diffHours > $dntime AND payment_status=1";

            if ($this->db->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
     public function autocancel_cashbookig(){
        $timezone=$this->db->select('*')->from('ws_setting')->where('id',1)->get()->row();
       $downtime=$this->db->select('*')->from('booking_downtime')->get()->result();
       
        $cancele = $this->db->select('*')->from('tkt_booking')->where('payment_status',2)->get()->result();
        return false;

        if ($cancele) {
            foreach ($cancele as $can) { }
           $default= date_default_timezone_set($timezone->timezone);
            $day1 = $can->date;
            $day1 = strtotime($day1);
            $day2 = $date = date('Y-m-d H:i:s', time());
            $day2 = strtotime($day2);
            $diffHours = round(($day2 - $day1) / 3600)+0.001;
            // $sql = "DELETE FROM tkt_booking WHERE $diffHours > $dntime AND payment_status=2";
            if ($this->db->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }


        public function confirmation()
    {   
        $data["confirm"] = $this->booking_model->confirmation();
        $data['module']  = "ticket";
        $data['page']    = "booking/confirmlist";   
        echo Modules::run('template/layout', $data); 
    }
    // unpaid cash bookin list
      public function unpaisd_cash_booking()
    {   
        $data["bookings"] = $this->booking_model->upaid_cash_bookig();
        $data['module']   = "ticket";
        $data['page']     = "booking/unpaid_cashbooking";   
        echo Modules::run('template/layout', $data); 
    }
    
 // ticket transaction confirmation  delete
 public function delete_confirmation($id = null) 
    { 

    if ($this->booking_model->confirmation_delete($id)) {
        #set success message
        $this->session->set_flashdata('message',display('delete_successfully'));
    } else {
        #set exception message
        $this->session->set_flashdata('exception',display('please_try_again'));
    }
     redirect("ticket/booking/confirmation");
    } 

    //payment term and condition
    public function terms_and_condition_form($id = null)
 {
//   $this->permission->method('ticket','create')->redirect();
  $data['title'] = display('add');
  #-------------------------------#
  $this->form_validation->set_rules('how_to_pay', display('how_to_pay')  ,'required|max_length[1000]');
  $this->form_validation->set_rules('terms_and_condition', display('terms_and_condition')  ,'max_length[1000]');
  #-------------------------------#
     $data['term']   = (Object) $postData = [
        'id'                 => $this->input->post('id'), 
   'how_to_pay'              => $this->input->post('how_to_pay'), 
   'terms_and_condition'     => $this->input->post('terms_and_condition')
  ];

  if ($this->form_validation->run()) { 

   if (empty($postData['id'])) {

        //   $this->permission->method('ticket','create')->redirect();
       
    if ($this->booking_model->create_terms($postData)) { 
     $this->session->set_flashdata('message', display('save_successfully'));
     redirect('ticket/booking/terms_and_condition_list');
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("ticket/booking/terms_and_condition_form"); 

   } else {

    // $this->permission->method('ticket','update')->redirect();

    if ($this->booking_model->update_condition($postData)) { 
    
     $this->session->set_flashdata('message', display('update_successfully'));
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("ticket/booking/terms_and_condition_form/".$postData['id']);  
   }
 

  } else { 
   if(!empty($id)) {
    $data['title'] = display('update');
    $data['terms'] = $this->booking_model->terms_and_cond_data($id);
   }
   $data['module'] = "ticket";
   $data['page']   = "booking/terms_form";   
   echo Modules::run('template/layout', $data); 
   }   
 }

// terms and condition list
  public function terms_and_condition_list()
    {   
        $data["terms"]  = $this->booking_model->term_and_condition_list();
        $data['module'] = "ticket";
        $data['page']   = "booking/term_condition_list";   
        echo Modules::run('template/layout', $data); 
    }
    //terms_delete
     public function terms_delete($id = null) 
    { 

    if ($this->booking_model->terms_delete($id)) {
        #set success message
        $this->session->set_flashdata('message',display('delete_successfully'));
    } else {
        #set exception message
        $this->session->set_flashdata('exception',display('please_try_again'));
    }
     redirect("ticket/booking/terms_and_condition_list");
    } 

    public function httpPostXform($url, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        return $result;
    }
      
}
