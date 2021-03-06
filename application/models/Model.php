<?php 

	defined('BASEPATH') OR exit('No direct script access allowed !');

	class Model extends CI_Model{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
         
		}



    
public function loginAuthentication($email, $password) {
    $query = $this->db->get_where('user', array('Email' => $email));  
      if(!empty($query->row_array())) { //data berhasil ditangkap dari database
        $query = $query->row_array();
      } else { //email tidak terdaftar di database
        $_SESSION['gagalLogin'] = "Maaf, email / password salah!";
        redirect('home/login');
      }
      
      if(!empty($query) && $email == $query['Email'] && password_verify($password, $query['Password']) == true) {
        $_SESSION['loggedInAccount'] = $query; 
        return 1; //data match
      } else { //email bener tapi password salah
        $_SESSION['gagalLogin'] = "Maaf, email / password salah!";
        redirect('home/login');
      }
    }

		public function AddData($Name, $Email, $Password, $ProfilePicture, $Role)//UNTUK REGISTER
		{
		  $this->db->trans_begin();
          
        
          $query = $this->db->insert("user", [
            "Name" => $Name,
            "Email" => $Email,
            "Password" => $Password,
            "ProfilePicture" => $ProfilePicture,
            "Role" => $Role


           ]);
     
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      echo "gagal";
    } else {
      return $query;
    }
			
			 
		}

		 public function ShowUser(){ //SHOW USER DI ADMIN
         $query = $this->db->query("SELECT * FROM user");
        return $query->result_array();
     }
     


		 public function AddFacilities($Name, $Description, $Image, $StartTime, $EndTime){//UNTUK ADD FASILITAS
		
		  $this->db->trans_begin();
    
          $query = $this->db->insert("facilities", [  
      "Name" => $Name,
      "Description" => $Description,
      "Image" => $Image,
      "StartTime" => $StartTime,
      "EndTime" => $EndTime
     
  
        
          ]);
     
          $this->db->trans_complete();

          if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              echo "gagal";
          } else {
              return $query;
                 }
			
			 
		}
    public function ShowFacilities(){ //SHOW Facilities di admin
         $query = $this->db->query("SELECT * FROM facilities");
        return $query->result_array();
     }
     public function FacilitiesDetails($id){ //SHOW Facilities di admin
         $query = $this->db->query("SELECT * FROM facilities WHERE id_facilities = $id");
         
        return $query->result_array();
     }
      public function UserDetails($id){ //SHOW Facilities di admin
         $query = $this->db->query("SELECT * FROM user WHERE id_user = $id");
        return $query->result_array();
     }
	
	
    public function UpdateFacilities($id, $Name, $Description, $Image, $StartTime, $EndTime) {

    $this->db->trans_begin();
    
    $data = array(
      "Name" => $Name,
      "Image" => $Image,
      "Description" => $Description,
      "StartTime" => $StartTime,
      "EndTime" => $EndTime
     
    );

    $this->db->where('id_facilities', $id);
    $query = $this->db->update('facilities', $data);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return FALSE;
    } else {
      return $query;
    }
  }

   public function UpdateUser($id, $Name, $Email, $ProfilePicture) {

    $this->db->trans_begin();
    
    $data = array(
      "Name" => $Name,
      "ProfilePicture" => $ProfilePicture,
      "Email" => $Email
     
    );

    $this->db->where('id_user', $id);
    $query = $this->db->update('user', $data);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return FALSE;
    } else {
      return $query;
    }
  }
  
   public function RequestBooking($FacilityID, $ReservationDate, $StartTime, $EndTime, $UserID){
    
		
		  $this->db->trans_begin();
    
          $query = $this->db->insert("request", [
            "id_facilities" => $FacilityID,
            "ReservationDate" => $ReservationDate,
            "StartTime" => $StartTime,
            "EndTime" => $EndTime,
            "id_user" => $UserID,
            "status" => 'Waiting for approval!'
        
          ]);
     
          $this->db->trans_complete();

          if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              echo "gagal";
          } else {
              return $query;
                 }
			
			 
		}
   public function RequestListUser($id){ 
         $query = $this->db->query("SELECT * FROM request WHERE id_user = $id");
        return $query->result_array();
     }
   public function RequestListAll(){ 
         $query = $this->db->query("SELECT * FROM request");
        return $query->result_array();
     }
    
     public function ApproveRequest($id){ 
  
        $status = array('status' => 'approved!');    
        $this->db->where('id_request', $id);
        $this->db->update('request', $status);     

     }
      public function RejectRequest($id){ 
  
        $status = array('status' => 'REJECTED!');    
        $this->db->where('id_request', $id);
        $this->db->update('request', $status);     
     
     }
     function CheckAdmin(){ 
  if($_SESSION['loggedInAccount']['Role'] != "admin") {
   redirect(base_url() . 'index.php/ErrorHandler/ErrorMessage');
  }
 }

 function CheckUser(){
  if($_SESSION['loggedInAccount']['Role'] != "user") {
   redirect(base_url() . 'index.php/ErrorHandler/ErrorMessage');
   // $this->load->view('pages/errorView');
  }
 }

 function CheckManager(){
 if($_SESSION['loggedInAccount']['Role'] != "management") {
   redirect(base_url() . 'index.php/ErrorHandler/ErrorMessage');
  }
 }


	 
  }
?>