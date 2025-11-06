<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Certificatepdf extends CI_Controller {

    function __construct() {

            parent::__construct();
            // Load member model
            $this->load->model('EmailSetupModel');

            $this->load->model('SubjectAndMessageModel');

            // Load form validation library

            $this->load->library('form_validation');

            // Load file helper

            $this->load->helper('file');
            $this->load->helper('utility_helper');
            $this->load->library('form_validation');
            $this->load->model('BatchModel');
            $this->load->model('BatchDaysModel');
            $this->load->model('BatchModel');
            $this->load->model('BatchModel');
            $this->load->model('AppModel');
            $this->load->model('EmployeeModel');
            $this->load->model('UserModel');
            $this->load->model('RegisterModel');
            $this->load->model('StudentModel');
            //$this->load->model('EnquiryModel');
            $this->load->model('PaymentModel');
            $this->load->model('ClassRoomModel');
            $this->load->library('session');
            $this->load->library('email');
            $this->load->library('pdf');

            }

    public function iotoff_certificate_verify(){
          
        $this->load->view('iotuserverifycertificate');
        
    }  
    public function iotuser_verified_certimem(){
        $this->form_validation->set_rules('serialno','Certification ID','required');
        if($this->form_validation->run()){
            $certificate_id=$this->input->post('serialno');

        $data = $this->CertificatePdfModel->getVerifiedMember($certificate_id);


                 if ($data) {
            
        $output = '';
           $output.='<div class="row post mb-50 ">';
                foreach($data as $result){
                    $name = $result->name;
                    $certificate_id=$result->certification_id;
                    $domain_name=$result->domain_name;
                    $email=$result->email;
                    $issue_date=$result->issue_date;
                    $acronym = substr($name, 0, 1);


                    // Creating HTML structure 
                    
                    $output.='<div class="col-lg-12 text-center">
                        <div class="">
                            <div class="verif-ups-images">
                            <img src="'.base_url().'assets/images/the-iot-logo-new.webp">
                            </div>
                            <div class="blog-content p-3">
                               <h4 class="text-success">Validation Successful</h4>
                                <p class="mt-3 mb-3"> The certificate with Certification id <b>'.$certificate_id.'</b> has been issued to <b>'.$name.' </b>for the Domain Name <b>'.$domain_name.'</b> on <b>'.$issue_date.'</b> </p>
                                <div class="nameemb"><p class="fstppf"><span class="firstnamel">'.$acronym.'</span> </p><p>'.$name.'<br> '.$email.'</p></div>
                                
                            </div>
                        </div>
                    </div>';        
                }
       //echo $output.'</div>';
       $resrtd=$output.'</div>';
       print_r(json_encode(['message' => 'success','response'=>$resrtd]));
     }
     else{
        print_r(json_encode(['message' => 'notmatch','response'=>"<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>"]));
     }
        
       }
       else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

        }
    }        

    public function verify_certificate(){

        $this->load->view('admin/certificatepdf/verifycertificate');
    }
    
    public function verified_member(){
        
        $this->form_validation->set_rules('serialno','Certification ID','required');
        if($this->form_validation->run()){
            $certificate_id=$this->input->post('serialno');

        $data = $this->CertificatePdfModel->getVerifiedMember($certificate_id);


                 if ($data) {
            
        $output = '';
           $output.='<div class="row post mb-50 ">';
                foreach($data as $result){
                    $name = $result->name;
                    $certificate_id=$result->certification_id;
                    $domain_name=$result->domain_name;
                    $email=$result->email;
                    $issue_date=$result->issue_date;
                    $acronym = substr($name, 0, 1);


                    // Creating HTML structure 
                    
                    $output.='<div class="col-lg-12 text-center">
                        <div class="">
                            <div class="verif-ups-images">
                            <img src="'.base_url().'assets/images/upskill-logo-new.png" >
                            </div>
                            <div class="blog-content p-3">
                               <h4 class="text-success">Validation Successful</h4>
                                <p class="mt-3 mb-3"> The certificate with Certification id <b>'.$certificate_id.'</b> has been issued to <b>'.$name.' </b>for the internship <b>'.$domain_name.'</b> on <b>'.$issue_date.'</b> </p>
                                <div class="nameemb"><p class="fstppf"><span class="firstnamel">'.$acronym.'</span> </p><p>'.$name.'<br> '.$email.'</p></div>
                                
                            </div>
                        </div>
                    </div>';        
                }
       //echo $output.'</div>';
       $resrtd=$output.'</div>';
       print_r(json_encode(['message' => 'success','response'=>$resrtd]));
     }
     else{
        print_r(json_encode(['message' => 'notmatch','response'=>"<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>"]));
     }
        
       }
       else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

        }     
    }


    public function index(){
        try{
        $data = array();
        $data['members'] = $this->CertificatePdfModel->getRows();
     }
      catch(Exception $e){
        print_r($e);
      }
        $this->load->view('admin/certificatepdf/index', $data);


    }

    public function import(){
        $data = array(); 
        $memData = array();
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data

            if($this->form_validation->run() == true){

                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                

                // If file uploaded

                if(is_uploaded_file($_FILES['file']['tmp_name'])){

                    // Load CSV reader library

                    //$this->load->library('CSVReader');

                    

                    // Parse data from CSV file

                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    

                    // Insert/update CSV data into database

                    if(!empty($csvData)){
                        foreach($csvData as $row)

                        {

                          $randmcer='USC'.rand(1000,1000000).'TIA';
                         if ($row['Name']=='' || $row['Email']=='' || $row['Mobile']=='' || $row['Domain']==''|| $row['Collegename']==''  || $row['Issuedate']=='' || $row['Startdate']=='' || $row['Enddate']=='') {
                             
                             $this->session->set_flashdata('success_msg', 'All Field Are Required');
                             redirect('certificate-pdf-home');
                         }
                         else{
                         $rowCount++;
                       
                        $memData = array(
                            'name' => ucwords(strtolower($row['Name'])),
                            'email' => strtolower($row['Email']),
                            'mobile' => $row['Mobile'],
                            'domain_name' => ucwords(strtolower($row['Domain'])),
                            'college_name' => ucwords(strtolower($row['Collegename'])),
                            'certification_id' => $randmcer,
                            'issue_date' => $row['Issuedate'],
                            'course_start_date' => $row['Startdate'],
                            'course_end_date' => $row['Enddate']

                            );


                        $updaData = array(
                            'name' => ucwords(strtolower($row['Name'])),
                            'email' => strtolower($row['Email']),
                            'mobile' => $row['Mobile'],
                            'domain_name' => ucwords(strtolower($row['Domain'])),
                            'college_name' => ucwords(strtolower($row['Collegename'])),
                            'issue_date' => $row['Issuedate'],
                            'course_start_date' => $row['Startdate'],
                            'course_end_date' => $row['Enddate']

                            );



                            // Check whether email already exists in the database

                            $con = array(

                                'where' => array(
                                    'email' => $row['Email']
                                ),

                                'returnType' => 'count'

                            );

                            $prevCount = $this->CertificatePdfModel->getRows($con);
                            if($prevCount > 0){

                                // Update member data

                                $condition = array('email' => $row['Email']);
                                $update = $this->CertificatePdfModel->update($updaData, $condition);

                                if($update){
                                    $updateCount++;
                                }

                            }else{

                                // Insert member data

                                $insert = $this->CertificatePdfModel->insert($memData);
                                if($insert){
                                    $insertCount++;
                                }
                            }
                           $dynamic_no++;
                        }

                    }

                        
                        // Status message with imported data count

                        $notAddCount = ($rowCount - ($insertCount + $updateCount));

                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';

                        $this->session->set_flashdata('success_msg', $successMsg);

                    }

                }else{

                    $this->session->set_flashdata('error_msg', 'Error on file upload, please try again.');

                }

            }else{

                $this->session->set_flashdata('error_msg', 'Invalid file, please select only CSV file.');

            }

        }

        redirect('certificate-pdf-home');

    }

    

    /*

     * Callback function to check file value and type during validation

     */

    public function file_check($str){

        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){

            $mime = get_mime_by_extension($_FILES['file']['name']);

            $fileAr = explode('.', $_FILES['file']['name']);

            $ext = end($fileAr);

            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){

                return true;

            }else{

                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');

                return false;

            }

        }else{

            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

    public function view_result()

    {
        $data = array();
        $data['members'] = $this->CertificatePdfModel->get_data();
        $this->load->view('admin/certificatepdf/result', $data);
    }

    public function store() {

        if($this->input->post('Submit'))
           {
            $data = array();
            $data = $this->CertificatePdfModel->get_status_data();
        }

        else
        {
            redirect('certificate-pdf-home');
        }
    }

    public function certificatepdfdetails($ID)
     {
        if($this->uri->segment(3)){

          $offerid=$this->uri->segment(3);
          $html_content =$this->CertificatePdfModel->fetch_single_details($offerid);
             $this->dompdf->loadHtml($html_content);
              $this->dompdf->setPaper('A4', 'landscape');
             $this->dompdf->render();
             $this->dompdf->stream("certificate.pdf", array("Attachment"=>0));
     }
  }

  public function downloadpdfdetails($ID)
     {
        if($this->uri->segment(3)){

          $offerid=$this->uri->segment(3);
          $html_content =$this->CertificatePdfModel->fetch_single_details($offerid);
          $offer_name =$this->CertificatePdfModel->fetch_certificate_name($offerid);
          // echo $offer_name->name;exit;
             $this->dompdf->loadHtml($html_content);
             $this->dompdf->setPaper('A4', 'landscape');
             $this->dompdf->render();
             $this->dompdf->stream($offer_name->name, array("Attachment"=>1));
     }
  }
}