<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveLead extends CI_Controller{



	public function __construct(){

		parent::__construct();

	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model('AppModel');
	    $this->load->model('EmployeeModel');
	    $this->load->model('UserModel');
	    $this->load->model('DesigModel');
	    $this->load->model('UserTypeModel');
	    $this->load->model('StudentModel');
	    $this->load->model('LiveLeadModel');
	    $this->load->library('session');
	    $this->load->library('email');
	}

	public function downloadCSVlead(){
        $data = $this->LiveLeadModel->getDataForCSVleads();
        $fileName = 'data_leads' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/csv;");
        $file = fopen('php://output', 'w');
        $header = array('id', 'Name', 'Email','Mobile','Course','Work Experience','Best Time To Call','College','Message','Came From','Url','Date/Time');
        fputcsv($file, $header);
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
        exit;
    }
	public function get_leads(){
	    $data['allLeads']=$this->LiveLeadModel->get_all_leads();
	    $this->load->view('show-leads/index',$data);

	}
    public function application_details_leads(){
		$data['allLeads']=$this->LiveLeadModel->appli_details_leads();
	    $this->load->view('show-leads/apply_now_leads',$data);
	}

	public function applied_job_applicant_details(){
		$data['detail']=$this->LiveLeadModel->applied_job_details();
	    $this->load->view('show-leads/details_of_applicant',$data);
	}


	//live call enquiry submit form method

    public function livecall_leadsubmit(){
    	$this->form_validation->set_rules('your_name','Name','required|alpha_numeric_spaces');
	  	$this->form_validation->set_rules('your_mobile','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('calldate','Choose Date','required');
        $this->form_validation->set_rules('time_call','Time','required');
        if($this->form_validation->run()){
			$name=$this->input->post('your_name');
		  	$mobile_no=$this->input->post('your_mobile');
		  	$calldate=$this->input->post('calldate');
		  	$calltime=$this->input->post('time_call');
		  	$url_source=$this->input->post('url_source');
		    $data=array(
			 	'name'=>$name,
				'mobile'=>$mobile_no,
				'date'=>$calldate,
				'url_source'=>$url_source,
				'time'=>$calltime,
		 	);

    		 $gcid=$this->LiveLeadModel->insertLiveCallLead($data);
    		if($gcid>0){
			 	$this->admingGetCallConfirmEmail($data);
			 //Send mail
			   print_r(json_encode(['message'=>'success','response'=>"Message sent successfully."]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }

    	}else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));

		}
	}

//



   public function embedded_full_stackapply(){

         $cid=0;
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.') ;

	    $mobileerrmsg=array(
	  				'required'=>'Mobile No. Can not Be Empty.',
	  				'numeric'=>'Mobile No. Must Be 10-Digit Number',
	  				'exact_length'=>'Mobile No. Must Be 10-Digit Number') ;

	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;
        $messageerrmsg=array(
	  				'required'=>'Message Can not Be Empty.',
	  				);

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
	  	$this->form_validation->set_rules('collegename','college Name','required');


	  	//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);



		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
		  	$mobile_no=$this->input->post('mobileno');
		  	$college_name=$this->input->post('collegename');
		  	$message=$this->input->post('message');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	if(!isset($message)){

		 		$message='LiteBox Form';

		 	}

		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$mobile_no,
				'college_name'=>$college_name,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);

	      $cid = $this->LiveLeadModel->insertLiveLead($data);

        	if($cid>0){

			 	$admin_mail_status_enquiry=$this->adminConfirmEmail($data);
			 	$user_mail_status=$this->applicantphytecConfirmEmail($data);
           header('Content-Type: application/json');
			        print json_encode(array('message'=>'SUCCESS','response'=>"Enquiry Submitted Successfully!"));
	        }
	        else{
		        header('HTTP/1.1 501 Internal Server');
		        header('Content-Type: application/json; charset=UTF-8');
		        print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Message Faield! Try Again')));
	        }

		}else{

        	header('HTTP/1.1 500 Internal Server');
        	header('Content-Type: application/json; charset=UTF-8');
        	print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));
		}

   }


  //iit download brochure, curriculum,project list and talk to cousellor
   public function iitgsubmitmform(){

                $cid=0;
		$nameerrmsg=array(
	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');
	    $mobileerrmsg=array('required'=>'Mobile Number Can not Be Empty.');
	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.');

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]',$mobileerrmsg);
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
	  	$this->form_validation->set_rules('workexperience','Work Experience','required');
	  	$this->form_validation->set_rules('calltime','Best Time To Call','required');


	  	//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);



		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$mobile_no=$this->input->post('mobileno');
		  	$email_id=$this->input->post('email');
		  	$work_experience=$this->input->post('workexperience');
		  	$call_time=$this->input->post('calltime');
		  	$form_name=$this->input->post('form_name');
		  	$usage_type=$this->input->post('usage_type');
		 	$url_source=$this->input->post('url_source');

		 	$data = array(
			 	'name'=>$name,
				'mobile_no'=>$mobile_no,
				'email_id'=>$email_id,
				'work_experience'=>$work_experience,
				'best_time_call'=>$call_time,
				'came_from'=>$form_name,
				'usage_type'=>$usage_type,
				'url_source'=>$url_source,
		 	);

	      $cid = $this->LiveLeadModel->insertLiveLead($data);

        	if($cid>0){
			 	$this->iitgdadminConfirmEmail($data);
			 	//$user_mail_status=$this->applicantphytecConfirmEmail($data);
			      print_r(json_encode(array('message'=>'success','response'=>'Enquiry Submitted Successfully!')));
	        }
	        else{
		        print_r(json_encode(array('message' => 'sererror','response'=>'Message Faield! Try Again')));
	        }

		}else{
        	print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
		}
   }


   public function iitgsubtaddfform(){

	$cid=0;
$nameerrmsg=array(
			  'required'=>'Name Cannot Be Empty.',
			'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');
$mobileerrmsg=array('required'=>'Mobile Number Can not Be Empty.');
$emailerrmsg=array(
		  'required'=>'Email Can not Be Empty.',
		  'valid_email'=>'Email Must Be A Valid Email.');

$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric',$mobileerrmsg);
$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
$this->form_validation->set_rules('workexperience','Work Experience','required');
$this->form_validation->set_rules('calltime','Best Time To Call','required');


//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);



if($this->form_validation->run()){
$name=$this->input->post('fullname');
  $mobile_no=$this->input->post('mobileno');
  $email_id=$this->input->post('email');
  $work_experience=$this->input->post('workexperience');
  $call_time=$this->input->post('calltime');
  $form_name=$this->input->post('form_name');
 $url_source=$this->input->post('url_source');

 $data = array(
	 'name'=>$name,
	'mobile_no'=>$mobile_no,
	'email_id'=>$email_id,
	'work_experience'=>$work_experience,
	'best_time_call'=>$call_time,
	'came_from'=>$form_name,
	'url_source'=>$url_source,
 );

$cid = $this->LiveLeadModel->insertLiveLead($data);

if($cid>0){
	 $this->iitgaddConfirmationmail($data);
	 //$user_mail_status=$this->applicantphytecConfirmEmail($data);
	  print_r(json_encode(array('message'=>'success','response'=>'Enquiry Submitted Successfully!')));
}
else{
	print_r(json_encode(array('message' => 'sererror','response'=>'Message Faield! Try Again')));
}

}else{
print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
}
}



	public function liveleadsubmit(){
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');

	    $mobileerrmsg=array(
	  				'required'=>'Mobile No. Can not Be Empty.',
	  				'numeric'=>'Mobile No. Must Be 10-Digit Number',
		 ) ;

	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;
	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);

	  	//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);
		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
			$countrycode=$this->input->post('countrycoden');
		  	$mobile_no=$this->input->post('mobileno');
            $college_name=$this->input->post('collegename');
			$work_experience=$this->input->post('workexperience');
		  	$call_time=$this->input->post('calltime');
		  	$message=$this->input->post('message');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$countrycode.$mobile_no,
                'college_name'=>$college_name,
			    'work_experience'=>$work_experience,
	            'best_time_call'=>$call_time,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);



			// $apidata = json_encode([
			//     'ownerId' => 2646,
			//  	'lastName' => $name,
			// 	'phoneNumbers' => array([
			// 		'type' => 'MOBILE',
			// 		'code' => 'IN',
			// 		'dialCode' => '+91',
			// 		'value' => $mobile_no
			// 	]),

			// 	'emails' => array([
			// 	  'type' => 'OFFICE',
			// 	  'value' => $email_id,
			// 	  'primary' => true
			// 	 ]),

			// 	'requirementName' => $message,
			// 	'address'=>$url_source

		 // 	]);

			//echo $apidata;



	  	  	//---------Database Section---------------

	      	$cid = $this->LiveLeadModel->insertLiveLead($data);



			//API Start

			// $curl = curl_init();



			// curl_setopt_array($curl, array(

			//   CURLOPT_URL => 'https://api.kylas.io/v1/leads',

			//   CURLOPT_RETURNTRANSFER => true,

			//   CURLOPT_ENCODING => '',

			//   CURLOPT_MAXREDIRS => 10,

			//   CURLOPT_TIMEOUT => 0,

			//   CURLOPT_FOLLOWLOCATION => true,

			//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

			//   CURLOPT_CUSTOMREQUEST => 'POST',

			//   CURLOPT_POSTFIELDS => $apidata,

			//   CURLOPT_HTTPHEADER => array(

			// 	'api-key: 6c93f526-de3a-4e6e-a392-9ded320e0409',

			// 	'Content-Type: application/json'

			//   ),

			// ));



			// $response = curl_exec($curl);
			// curl_close($curl);
			//echo $response;

			//exit;

        	if($cid>0){
			 	$this->adminConfirmEmail($data);
			 	//$this->userConfirmEmail($data);
			 //Send mail
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}

	public function advanced_gen_ai_submit(){
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');
	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);

	  	//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);
		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
			$countrycode=$this->input->post('countrycoden');
		  	$mobile_no=$this->input->post('mobileno');
            $college_name=$this->input->post('collegename');
			$work_experience=$this->input->post('workexperience');
		  	$call_time=$this->input->post('calltime');
		  	$message=$this->input->post('message');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$countrycode.$mobile_no,
                'college_name'=>$college_name,
			    'work_experience'=>$work_experience,
	            'best_time_call'=>$call_time,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);
	      	$cid = $this->LiveLeadModel->insertLiveLead($data);
             $webhook_payload = array(
			"name" => $name,
			"email" => $email_id,
			"phone" => $countrycode . $mobile_no,
			"college_name" => $college_name,
			"work_experience" => $work_experience,
			"call_time" => $call_time,
			"message" => $message,
			"form_name" => $form_name,
			"url_source" => $url_source
		);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://automate.ftsginnovations.com/webhook/trigger',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($webhook_payload),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		curl_exec($curl);
		curl_close($curl);
        	if($cid>0){
			 	$this->GenAIAdminConfirmEmail($data);
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));

	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}


    public function advanced_gen_ai_download_brochure_submit(){
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');
	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
	  	$this->form_validation->set_rules('qualification','Qualification','required');

	  	//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);
		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
			$countrycode=$this->input->post('countrycoden');
		  	$mobile_no=$this->input->post('mobileno');
            $college_name=$this->input->post('collegename');
			$work_experience=$this->input->post('workexperience');
			$qualification=$this->input->post('qualification');
		  	$call_time=$this->input->post('calltime');
		  	$message=$this->input->post('message');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$countrycode.$mobile_no,
                'college_name'=>$college_name,
			    'work_experience'=>$work_experience,
			    'qualification'=>$qualification,
	            'best_time_call'=>$call_time,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);
	      	$cid = $this->LiveLeadModel->insertLiveLead($data);
			 $webhook_payload = array(
			"name" => $name,
			"email" => $email_id,
			"phone" => $countrycode . $mobile_no,
			"college_name" => $college_name,
			"work_experience" => $work_experience,
			"call_time" => $call_time,
			"message" => $message,
			"form_name" => $form_name,
			"url_source" => $url_source
		);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://automate.ftsginnovations.com/webhook/trigger',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($webhook_payload),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		curl_exec($curl);
		curl_close($curl);
        	if($cid>0){
			 	$this->GenAIAdminConfirmEmail($data);
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}


	public function FormSubmitDAMLgenerarativeai(){
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');

	    $mobileerrmsg=array(
	  				'required'=>'Mobile No. Can not Be Empty.',
	  				'numeric'=>'Mobile No. Must Be 10-Digit Number',
	  				'exact_length'=>'Mobile No. Must Be 10-Digit Number') ;

	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;
	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
		  	$mobile_no=$this->input->post('mobileno');
		  	$countrycode=$this->input->post('countrycoden');
			$work_experience=$this->input->post('workexperience');
		  	$call_time=$this->input->post('calltime');
            $college_name=$this->input->post('collegename');
		  	$message=$this->input->post('message');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$countrycode.$mobile_no,
				'work_experience'=>$work_experience,
	            'best_time_call'=>$call_time,
               'college_name'=>$college_name,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);

	      	$cid = $this->LiveLeadModel->insertLiveLead($data);

        	if($cid>0){
			 	$this->DamlgenaiadminConfirmEmail($data);
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}





	public function newpopupsubmitsvc(){
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');

	    $mobileerrmsg=array(
	  				'required'=>'Mobile No. Can not Be Empty.',
	  				'numeric'=>'Mobile No. Must Be 10-Digit Number',
	  				'exact_length'=>'Mobile No. Must Be 10-Digit Number') ;

	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;
	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
	  	$this->form_validation->set_rules('coursename','Course Name','required|Required');

		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
		  	$mobile_no=$this->input->post('mobileno');
			$countrycode=$this->input->post('countrycoden');
            $college_name=$this->input->post('collegename');
		  	$message=$this->input->post('coursename');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$countrycode.$mobile_no,
               'college_name'=>$college_name,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);

			 $cid = $this->LiveLeadModel->insertLiveLead($data);
        	if($cid>0){
			 	$this->adminConfirmEmail($data);
			 	$this->userConfirmEmail($data);
			 //Send mail
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}


	public function newleadsubmitfd(){
		$nameerrmsg=array(
	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');
	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;
	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);

	  	//$this->form_validation->set_rules('message','Message','required|Required',$messageerrmsg);
		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$email_id=$this->input->post('email');
		  	$mobile_no=$this->input->post('mobileno');
            $college_name=$this->input->post('collegename');
		  	$message=$this->input->post('message');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'email_id'=>$email_id,
				'mobile_no'=>$mobile_no,
               'college_name'=>$college_name,
				'message'=>$message,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);
	      	$cid = $this->LiveLeadModel->insertLiveLead($data);

        	if($cid>0){
			 	$this->newAdminConfirmmail($data);
			 	$this->userConfirmEmail($data);
			 //Send mail
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}





	public function allenquiryldsubmit() {
		$nameErrMsg = [
			'required' => 'Name Cannot Be Empty.',
			'alpha_numeric_spaces' => 'Name Must Contain Only Letters of English Alphabet and Spaces.'
		];

		$mobileErrMsg = [
			'required' => 'Mobile No. Cannot Be Empty.',
			'numeric' => 'Mobile No. Must Be a 10-Digit Number',
			'exact_length' => 'Mobile No. Must Be a 10-Digit Number'
		];

		$emailErrMsg = [
			'required' => 'Email Cannot Be Empty.',
			'valid_email' => 'Email Must Be a Valid Email.'
		];

		$this->form_validation->set_rules('fullname', 'Name', 'required|alpha_numeric_spaces', $nameErrMsg);
		$this->form_validation->set_rules('mobileno', 'Mobile No.', 'required|numeric|min_length[10]');
		$this->form_validation->set_rules('email', 'Email ID', 'required|valid_email', $emailErrMsg);

		if ($this->form_validation->run()) {
			$data = [
				'name' => $this->input->post('fullname'),
				'email_id' => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobileno'),
				'college_name' => $this->input->post('collegename'),
				'message' => $this->input->post('message'),
				'came_from' => $this->input->post('form_name'),
				'url_source' => $this->input->post('url_source')
			];

			$cid = $this->LiveLeadModel->insertLiveLead($data);

			if ($cid > 0) {
				$this->adminConfirmEmail($data);
				$this->userConfirmEmail($data);
				echo json_encode(['message' => 'success', 'response' => 'Enquiry Submitted Successfully!']);
			} else {
				echo json_encode(['message' => 'sererror', 'response' => 'Message Failed! Try Again']);
			}
		} else {
			echo json_encode(['message' => 'error', 'response' => validation_errors()]);
		}
	}

	public function quiz_homepage_submit(){

		$rawBody = file_get_contents('php://input');
    
		$data = json_decode($rawBody, true);
		if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
			echo json_encode(array('message' => 'error', 'response' => 'Invalid JSON format'));
			return;
		}
	
		    $qid=0;
            $name=$data[10]['fullname'];
			$email=$data[10]['email'];
			$countrycode=$data[10]['countrycode'];
			$mobile=$data[10]['mobileno'];
			$qualification=$data[10]['workexperience'];
		 	$data = array(
				'q1'=>$data[0]['question'],
				'a1'=>$data[0]['selectedAnswer'],
				'q2'=>$data[1]['question'],
				'a2'=>$data[1]['selectedAnswer'],
				'q3'=>$data[2]['question'],
				'a3'=>$data[2]['selectedAnswer'],
				'q4'=>$data[3]['question'],
				'a4'=>$data[3]['selectedAnswer'],
				'q5'=>$data[4]['question'],
				'a5'=>$data[4]['selectedAnswer'],
				'q6'=>$data[5]['question'],
				'a6'=>$data[5]['selectedAnswer'],
				'q7'=>$data[6]['question'],
				'a7'=>$data[6]['selectedAnswer'],
				'q8'=>$data[7]['question'],
				'a8'=>$data[7]['selectedAnswer'],
				'q9'=>$data[8]['question'],
				'a9'=>$data[8]['selectedAnswer'],
				'q10'=>$data[9]['question'],
				'a10'=>$data[9]['selectedAnswer'],
			 	'fullname'=>$name,
				'mobile'=>$countrycode.$mobile,
				'email'=>$email,
				'qualification'=>$qualification,
		 	);

			 $isExist=$this->LiveLeadModel->isextisquizmail($email);

			 if($isExist>5){
				print json_encode(array('message'=>'success','response'=>"You have Already Exists"));
			 }
			 else{

               $qid = $this->LiveLeadModel->homequizsubmit($data);
        	   if($qid>0){
				$this->adminhomequizEmail($data);
				$this->userhomequizEmail($data);
				print json_encode(array('message'=>'success','response'=>"Quiz Submitted Successfully!"));
		   }
		   else{
			   print_r(json_encode(array('message' => 'sererror','response'=>'Quiz Faield! Try Again')));
		   }
			 }

		
	}

    public function adminhomequizEmail($data){

		$from_email = "enquiry@theiotacademy.co";
		$to_email = "info@theiotacademy.co";
		$this->email->from($from_email,'Quiz Details | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Quiz Details Received Through The IoT Academy By '.$data['fullname']);
		$this->email->message($this->load->view('mailFormat/quizadmin_mail',$data,TRUE));
        //Sending Email

        if($this->email->send()){
        	return TRUE ;
        }else{

        	return FALSE ;
        }
	}
    
	public function userhomequizEmail($data){

		$from_email = "enquiry@theiotacademy.co";
		$to_email = $data['email'];
		$message="Hello <strong>".$data['fullname'] ."!</strong>
		<br><p>Thank you for completing our Which Course is Right for You? quiz! We hope it gave you some valuable insights into the courses we offer. Based on your responses, we’ll analyze your results and arrange a call with our expert counselors for a personalized consultation.</p>
<br><br><p>Stay tuned for your personalized course suggestion, we will schedule your call shortly!</p>
<br> <br><strong>Best regards<br />The IoT Academy<br/>Website: ".base_url();
		$this->email->from($from_email,'Quiz Details | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('Your Quiz Submission is Confirmed! '.$data['fullname']);
		$this->email->message($message);
        //Sending Email

        if($this->email->send()){
        	return TRUE ;
        }else{

        	return FALSE ;
        }

	}
	//Function For Sending Enquiry Received Email For ADMIN

	public function iitgdadminConfirmEmail($data){

		$from_email = "enquiry@theiotacademy.co";
		$to_email = "admissions.eictiitg@theiotacademy.co";
		$this->email->from($from_email,'Enquiry | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Enquiry Received Through The IoT Academy By '.$data['name']);
		$this->email->message($this->load->view('mailFormat/iitgmadminenquiry_mail',$data,TRUE));
        //Sending Email

        if($this->email->send()){
        	return TRUE ;
        }else{

        	return FALSE ;
        }

	}


	public function iitgaddConfirmationmail($data){

		$from_email = "enquiry@theiotacademy.co";
		$to_email = "himanshu.singh@theiotacademy.co";
		$this->email->from($from_email,'Enquiry | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Enquiry Received Through The IoT Academy By '.$data['name']);
		$this->email->message($this->load->view('mailFormat/iitgmadminenquiry_mail',$data,TRUE));
        //Sending Email

        if($this->email->send()){
        	return TRUE ;
        }else{

        	return FALSE ;
        }

	}

  	public function adminConfirmEmail($data){
		$from_email = "enquiry@theiotacademy.co";
		$to_email = "info@theiotacademy.co";
		$this->email->from($from_email,'Enquiry | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Enquiry Received Through The IoT Academy By '.$data['name']);
		$this->email->message($this->load->view('mailFormat/adminenquiry_mail',$data,TRUE));
        //Sending Email
        if(!$this->email->send()){
        	return TRUE ;
			//$error = $this->email->print_debugger(['headers']);
			//echo json_encode(['status' => 'error', 'message' => 'Failed to send email', 'debug' => $error]);
        }else{
        	return FALSE ;
			//$error = $this->email->print_debugger(['headers']);
			//echo json_encode(['status' => 'error', 'message' => 'send email']);
        }
  	}

	  public function GenAIAdminConfirmEmail($data){
		$from_email = "enquiry@theiotacademy.co";
		$to_email = "info.eict@theiotacademy.co";
		$this->email->from($from_email,'Enquiry | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Enquiry Received Through The IoT Academy By '.$data['name']);
		$this->email->message($this->load->view('mailFormat/adminenquiry_mail',$data,TRUE));
        if(!$this->email->send()){
        	return TRUE ;
        }else{
        	return FALSE ;
        }
  	}

    public function DamlgenaiadminConfirmEmail($data){
		$from_email = "enquiry@theiotacademy.co";
		$to_email = "admissions.damlai@theiotacademy.co";
		$this->email->from($from_email,'Enquiry | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Enquiry Received Through The IoT Academy By '.$data['name']);
		$this->email->message($this->load->view('mailFormat/adminenquiry_mail',$data,TRUE));
        if(!$this->email->send()){
        	return TRUE ;
        }else{
        	return FALSE ;
        }
	}


	  public function newAdminConfirmmail($data){
		$from_email = "enquiry@theiotacademy.co";
		$to_email = "himanshu.singh@theiotacademy.co";
		$this->email->from($from_email,'Enquiry | The IoT Academy');
		$this->email->to($to_email);
		$this->email->subject('New Enquiry Received Through The IoT Academy By '.$data['name']);
		$this->email->message($this->load->view('mailFormat/adminenquiry_mail',$data,TRUE));
        //Sending Email
        if($this->email->send()){
        	return TRUE ;
        }else{
        	return FALSE ;
        }
  	}


   //admin get call back mail

  	public function admingGetCallConfirmEmail($data){



  		//------Email Section-----

		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";



		$this->email->from($from_email,'Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('New Call Back  Received  Through The IoT Academy By '.$data['name']);

		$this->email->message($this->load->view('mailFormat/adminenquiry_getCallBackMail',$data,TRUE));

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}

  //end admin gget call back mail

  	//admin get call back mail

  	public function admin_join_News_Email($data){



  		//------Email Section-----

		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";



		$this->email->from($from_email,'Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('News Letter Join Through The IoT Academy By '.$data['email_id']);

		$this->email->message($this->load->view('mailFormat/adminenquiry_News_JoinMail',$data,TRUE));

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}

  //end admin get call back mail



  //start user join news email confirmation

  public function user_join_news_email($data)

  {

     $from_email = "enquiry@theiotacademy.co";

		$to_email = $data['email_id'];



		$message="Dear <strong>".$data['email_id'] ."!</strong>

		<br>Thanks for join news letter at The IoT Academy!<br>

		<br> <br>

		<strong>With best regards<br/>

		Team The IoT Academy<br/>

		Website: ".base_url();



		$this->email->from($from_email,'Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('Thanks for connecting us');

		$this->email->message($message);

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }



  }

//end user join news email confirmation



//Function For Sending Enquiry Received Email  For USER

public function userConfirmEmail($data){



  		//------Email Section-----

		$from_email = "enquiry@theiotacademy.co";

		$to_email = $data['email_id'];



		$message="Dear <strong>".$data['name'] ."!</strong>

		<br>Thanks for connecting at <a href='<?=base_url()?>' style='text-decoration:none; color:black;
font-weight:bold;'>The IoT Academy!</a><br>

Soon our team member will call you on mobile number <a href='tel:".$data[' mobile_no']."'> ".$data['mobile_no']."</a> .

<br> <br>

<strong>With best regards<br />

    Team The IoT Academy<br />

    Website: ".base_url();



    $this->email->from($from_email,'Enquiry | The IoT Academy');

    $this->email->to($to_email);

    $this->email->subject('Thanks for connecting us');

    $this->email->message($message);

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{
    return FALSE ;

    }
}







    public function online_registration_submit(){



    $this->form_validation->set_rules('student_course','Student Course','required');

    $this->form_validation->set_rules('student_name','Student Name','required');

    $this->form_validation->set_rules('student_mobile','Student Mobile No','required');

    $this->form_validation->set_rules('student_email','Student Email','required');

    $this->form_validation->set_rules('student_gender','Student Gender','required');

    $this->form_validation->set_rules('student_highest_qualification','Student Highest Qualification','required');

    $this->form_validation->set_rules('student_current_address','Student Current Address','required');

    $this->form_validation->set_rules('student_message','Student Message','required');



    if($this->form_validation->run()){


    $student_course=$this->input->post('student_course');

    $student_name=$this->input->post('student_name');

    $student_mobile=$this->input->post('student_mobile');

    $student_email=$this->input->post('student_email');

    $student_gender=$this->input->post('student_gender');

    $student_highest_qualification=$this->input->post('student_highest_qualification');

    $student_current_address=$this->input->post('student_current_address');

    $student_message=$this->input->post('student_message');

    $url_source_name=$this->input->post('url_source_name');



    $data=array(

    'student_course'=>$student_course,

    'student_name'=>$student_name,

    'student_mobile'=>$student_mobile,

    'student_email'=>$student_email,

    'student_gender'=>$student_gender,

    'student_highest_qualification'=>$student_highest_qualification,

    'student_current_address'=>$student_current_address,

    'student_message'=>$student_message,

    'hash_url'=>$url_source_name,

    );



    $isExist=$this->LiveLeadModel->isEmailExists_online_registration($student_email);



    if(!$isExist||$isExist){



    $registration_id=$this->LiveLeadModel->onlineformregistration($data);



    if($registration_id>0){



    $admin_reg_mail_status=$this->admin_online_registration_Email($data);

    $user_reg_mail_status=$this->user_registration_ConfirmEmail($data);

    //Send mail

    // if($admin_reg_mail_status){
    // header('Content-Type: application/json');
    // print json_encode(array('message'=>'SUCCESS','response'=>"Your Details Registered Successfully."));

    // }else{
    // //header('HTTP/1.1 500 Internal Server');

    // header('Content-Type: application/json; charset=UTF-8');

    // die(json_encode(array('message' => 'SUCCESS', 'response'=>"&#x2714; Your Details Registered Successfully .")));

    // }
    header('Content-Type: application/json');
    print json_encode(array('message'=>'SUCCESS','response'=>"Your Details Registered Successfully."));

    }

    else{

    header('HTTP/1.1 501 Internal Server');

    header('Content-Type: application/json; charset=UTF-8');

    print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Message Faield! Try Again')));

    }

    }else{

    header('HTTP/1.1 501 Internal Server');

    header('Content-Type: application/json; charset=UTF-8');

    print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'You Have Already Registered !')));

    }

    }else{

    header('HTTP/1.1 500 Internal Server');

    header('Content-Type: application/json; charset=UTF-8');

    print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));

    }



    }



    //----end online registration form-----



    //start online registration admin mail

    public function admin_online_registration_Email($data){



    //------Email Section-----

    $from_email = "enquiry@theiotacademy.co";

    $to_email = "info@theiotacademy.co";



    $this->email->from($from_email,'Enquiry | The IoT Academy');

    $this->email->to($to_email);

    $this->email->subject('Online Registration Recived Through The IoT Academy By '.$data['student_name']);

    $this->email->message($this->load->view('mailFormat/admin_online_reg_mail',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }





    //end online registration admin mail





    //sending user online registration confirmation mail

    public function user_registration_ConfirmEmail($data){



    //------Email Section-----

    $from_email = "enquiry@theiotacademy.co";

    $to_email = $data['student_email'];

    $this->email->from($from_email,'Enquiry | The IoT Academy');

    $this->email->to($to_email);

    $this->email->subject('The IoT Academy Registration Successful');

    $this->email->message($this->load->view('mailFormat/useronlinemailmessage',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }

    //end sending user online registration confirmation mail





    //start book free demo submit form and send mail admin and user

    public function book_free_demo_submit(){



    $this->form_validation->set_rules('student_name','Student Name','required');

    $this->form_validation->set_rules('student_mobile','Student Mobile No','required');

    $this->form_validation->set_rules('student_email','Student Email','required');

    $this->form_validation->set_rules('student_course','Student Course','required');

    $this->form_validation->set_rules('student_date',' Select Date','required');

    $this->form_validation->set_rules('student_demo_time',' Select Time','required');



    if($this->form_validation->run()){



    $student_name=$this->input->post('student_name');

    $student_mobile=$this->input->post('student_mobile');

    $student_email=$this->input->post('student_email');

    $student_course=$this->input->post('student_course');

    $student_date=$this->input->post('student_date');

    $student_demo=$this->input->post('student_demo_time');

    $url_source_name=$this->input->post('demo_url_source_name');



    $data=array(

    'student_name'=>$student_name,

    'student_mobile'=>$student_mobile,

    'student_email'=>$student_email,

    'student_course'=>$student_course,

    'student_date'=>$student_date,

    'student_demo_time'=>$student_demo,

    'hash_url'=>$url_source_name,

    );



    $isExist=$this->LiveLeadModel->isEmailExists_bookfreedemo($student_email);



    if(!$isExist||$isExist){



    $book_freedemo_id=$this->LiveLeadModel->book_free_demo_register($data);



    if($book_freedemo_id>0){



    $admin_book_demo_mail_status=$this->admin_book_free_demo_Email($data);

    $user_book_demo_mail_status=$this->user_book_free_demo_ConfirmEmail($data);

    //Send mail

    // if($admin_book_demo_mail_status){
    // header('Content-Type: application/json');
    // print json_encode(array('message'=>'SUCCESS','response'=>"&#x2714; Your Demo Requested Successfully."));

    // }else{

    // //header('HTTP/1.1 500 Internal Server');
    // header('Content-Type: application/json; charset=UTF-8');

    // die(json_encode(array('message' => 'SUCCESS', 'response'=>"&#x2714;Your Demo Requested Successfully .")));

    // }
    header('Content-Type: application/json');
    print json_encode(array('message'=>'SUCCESS','response'=>"&#x2714; Your Demo Requested Successfully."));

    }

    else{

    header('HTTP/1.1 501 Internal Server');

    header('Content-Type: application/json; charset=UTF-8');

    print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Message Faield! Try Again')));

    }

    }else{

    header('HTTP/1.1 501 Internal Server');

    header('Content-Type: application/json; charset=UTF-8');

    print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'You Have Already Book Your Free
    Demo !')));

    }

    }else{

    header('HTTP/1.1 500 Internal Server');

    header('Content-Type: application/json; charset=UTF-8');

    print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));

    }



    }



    //----end book demo form-----



    //start book demo admin mail

    public function admin_book_free_demo_Email($data){



    //------Email Section-----

    $from_email = "enquiry@theiotacademy.co";

    $to_email = "info@theiotacademy.co";



    $this->email->from($from_email,'Enquiry | The IoT Academy');

    $this->email->to($to_email);

    $this->email->subject('New Demo Received for ' .$data['student_course']. ' course through Website By '
    .$data['student_name']);

    $this->email->message($this->load->view('mailFormat/book_free_demo_admin_email',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }





    //end boo demo admin mail





    //sending user online registration confirmation mail

    public function user_book_free_demo_ConfirmEmail($data){



    //------Email Section-----

    $from_email = "enquiry@theiotacademy.co";

    $to_email = $data['student_email'];

    $this->email->from($from_email,'Enquiry | The IoT Academy');

    $this->email->to($to_email);

    $this->email->subject('Congratulations '.$data['student_name'].'! Your Free Demo Requested Successfully');

    $this->email->message($this->load->view('mailFormat/user_bookfree_demo_mail',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }

    //end book free demo submit form and send mail admin and user



    // public function applicantphytecConfirmEmail($data){
    //$to_email = $data['email_id'];
    public function applicantphytecConfirmEmail(){

    $from_email = "admin@theiotacademy.online";
    $to_email = "raveendra.verma@theiotacademy.co";

    $message="Greetings Candidate, <br><br><br>Thank you for applying.<br><br>
    <br><br>This is to notify you that this form is for the qualifier test which we are going to conduct in order to
    select the desired candidates. Kindly check the important dates of the entire process mentioned below :-
    <br><br>
    23rd April :- Qualifier Test
    <br><br>
    2nd May :- Start of the batch
    <br><br>
    For the syllabus and preparation material, please find the attached document.
    <br></br>
    For any further queries, kindly reach out to us.

    <br><br><br>
    Thank you
    <br><br>
    Email: info@theiotacademy.co
    <br><br>
    Mobile Number: +919354068856
    ";

    $this->email->from($from_email,'Embedded Full Stack IIoT Analyst');
    $this->email->to($to_email);
    $this->email->subject('Confirmation mail for Embedded Full Stack IIoT Analyst Course');
    $this->email->message($message);
    //Sending Email
    // if($this->email->send()){
    // return TRUE ;
    // }else{
    // return FALSE ;
    // }
    if ($this->email->send()) {
    echo json_encode(['status' => 'success', 'message' =>"mail sent succesfully"]);
    } else {
    $error = $this->email->print_debugger(['headers']);
    echo json_encode(['status' => 'error', 'message' => 'Failed to send email', 'debug' => $error]);
    }

    }


public function welcome_kit_eict_submit(){
		$nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.');
	    $emailerrmsg=array(
	  				'required'=>'Email Can not Be Empty.',
	  				'valid_email'=>'Email Must Be A Valid Email.') ;

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
	  	$this->form_validation->set_rules('batch_number','Batch Number','required');
	  	$this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);
		$this->form_validation->set_rules('mobile','Mobile No.','required|numeric|min_length[10]');
	  	$this->form_validation->set_rules('address','House No/Flat No, Area and Street','required');
	  	$this->form_validation->set_rules('pincode', 'Pin Code', 'required|min_length[6]|max_length[6]');
	  	$this->form_validation->set_rules('city','City/District/Town','required');
	  	$this->form_validation->set_rules('state','State','required');
	  	// $this->form_validation->set_rules('landmark','Landmark','required');
	  	$this->form_validation->set_rules('tshirt_size','T-Shirt Size','required');

		if($this->form_validation->run()){
			$name=$this->input->post('fullname');
		  	$batch_number=$this->input->post('batch_number');
			$email=$this->input->post('email');
		  	$mobile=$this->input->post('mobile');
            $address=$this->input->post('address');
            $pincode=$this->input->post('pincode');
			$city=$this->input->post('city');
		  	$state=$this->input->post('state');
		  	$landmark=$this->input->post('landmark');
		  	$tshirt=$this->input->post('tshirt_size');
		  	$form_name=$this->input->post('form_name');
		 	$url_source=$this->input->post('url_source');
		 	$data = array(
			 	'name'=>$name,
				'batch_number'=>$batch_number,
				'email'=>$email,
                'contact'=>$mobile,
			    'house_number'=>$address,
	            'pincode'=>$pincode,
				'city'=>$city,
				'state'=>$state,
				'landmark'=>$landmark,
				'tshirt_size'=>$tshirt,
				'came_from'=>$form_name,
				'url_source'=>$url_source,
		 	);
	      	$cid = $this->LiveLeadModel->insert_welcome_kit($data);
        	if($cid>0){
			 	$this->WelcomeAdminConfirmEmail($data);
			    print_r(json_encode(['message'=>'success','response'=>"Enquiry Submitted Successfully!"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Message Faield! Try Again']));
	        }
		}
		else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));
		}
	}	


public function WelcomeAdminConfirmEmail($data){

    $from_email = "enquiry@theiotacademy.co";
    $to_email = "welcomekit.eictiitg@theiotacademy.co";
    $this->email->from($from_email,'Enquiry | The IoT Academy');
    $this->email->to($to_email);
    $this->email->subject('New Enquiry Received for Welcome Kit By '
    .$data['name']);

    $this->email->message($this->load->view('mailFormat/welcome_kit_admin_email',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }



public function seed_fund_submit_form() {
    // --- Validation Rules ---
    $this->form_validation->set_rules('name', 'Full Name', 'required|alpha_numeric_spaces');
    $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
    $this->form_validation->set_rules('mobile', 'Phone Number', 'required|numeric|min_length[10]');
    $this->form_validation->set_rules('portfolio', 'LinkedIn / Portfolio ID', 'valid_url');
    $this->form_validation->set_rules('startup_name', 'Startup Name', 'required');
    $this->form_validation->set_rules('funding_stream', 'Funding Stream', 'required');
    $this->form_validation->set_rules('problem_statement', 'Problem Statement', 'required');
    $this->form_validation->set_rules('solution', 'Solution', 'required');
    // --- If Validation Passes ---
    if ($this->form_validation->run()) {

        // --- Collect Data ---
        $data = array(
            'name'                => $this->input->post('name'),
            'email'               => $this->input->post('email'),
            'mobile'              => $this->input->post('mobile'),
            'portfolio'           => $this->input->post('portfolio'),
            'startup_name'        => $this->input->post('startup_name'),
            'funding_stream'      => $this->input->post('funding_stream'),
            'problem_statement'   => $this->input->post('problem_statement'),
            'your_solution'            => $this->input->post('solution'),
            'technology_stack'    => $this->input->post('technology_stack'),
            'team_size'           => $this->input->post('team_size'),
            'team_expertise'      => $this->input->post('team_expertise'),
            'team_description'    => $this->input->post('team_description'),
            'mvp_description'     => $this->input->post('mvp_description'),
            'mvp_demo_link'             => $this->input->post('mvp_url'),
            'revenue_model'       => $this->input->post('revenue_model'),
            'target_market'    => $this->input->post('target_marketing'),
            'marketing_plan'      => $this->input->post('marketing_plan'),
            'employment_impact'   => $this->input->post('employment_impact'),
            'funding_ammount'     => $this->input->post('funding_ammount'),
            'funding_utilization_plan' => $this->input->post('funding_utilization'),
            'additional_information' => $this->input->post('additional_information'),
            'created_at'          => date('Y-m-d H:i:s')
        );

        // --- Save to Database ---
        $insert_id = $this->LiveLeadModel->insertSeedFundApplication($data);

        if ($insert_id > 0) {
            // Optional: Send confirmation email
             $this->seed_fund_ConfirmEmail($data);

            print_r(json_encode([
                'message'  => 'success',
                'response' => 'Application submitted successfully!'
            ]));
        } else {
            print_r(json_encode([
                'message'  => 'server_error',
                'response' => 'Something went wrong. Please try again.'
            ]));
        }

    } else {
        // --- Validation Failed ---
        print_r(json_encode([
            'message'  => 'error',
            'response' => validation_errors()
        ]));
    }
}


public function seed_fund_ConfirmEmail($data){

    $from_email = "enquiry@theiotacademy.co";
    $to_email = "seed_fund@theiotacademy.co";
    $this->email->from($from_email,'Enquiry | The IoT Academy');
    $this->email->to($to_email);
    $this->email->subject('New Application Received for Seed Fund By '
    .$data['name']);

    $this->email->message($this->load->view('mailFormat/seed_fund_admin_email',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }




}

    ?>