<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CertificatePdfModel extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'certificate_pdf';
    }    

    public function getVerifiedMember($certificate_id){

        $this->db->where('certification_id',$certificate_id);
         $query = $this->db->get("certificate_pdf");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;   
    }

    
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    public function get_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 1 ORDER BY id DESC");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    

    public function fetch_certificate_name($offerid){

           $this->db->where('id',$offerid);
         $data= $this->db->get('certificate_pdf');
         foreach($data->result() as $row){

              $nameresult=$row;
         }

         return $nameresult;    
       
    }
    public function fetch_single_details($offerid){
        $this->db->where('id',$offerid);
         $data= $this->db->get('certificate_pdf');
         foreach($data->result() as $row){
// $path = base_url('assets/images/banners/bggg-iage-for-ccc.jpg');
// $type = pathinfo($path, PATHINFO_EXTENSION);
// $data = file_get_contents($path);
// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
 $path = base_url('assets/images/banners/new-certificate-of-template-new.png');
 $type = pathinfo($path, PATHINFO_EXTENSION);
 $data = file_get_contents($path);
 $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path1 = base_url('assets/images/upskill-logo-new.png');
$type1 = pathinfo($path1, PATHINFO_EXTENSION);
$data1 = file_get_contents($path1);
$base641 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

$path2 = base_url('assets/images/uctlogo-new.png');
$type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data2 = file_get_contents($path2);
$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);

$path3 = base_url('assets/images/stamp-logo-new.png');
$type3 = pathinfo($path3, PATHINFO_EXTENSION);
$data3 = file_get_contents($path3);
$base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);


$output.='<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            

       
        .fstdnnn{
            background-repeat: no-repeat;
            background-size: contain;
            background-position-x:center;
            background-origin: inherit;
            width:100%;
            background-image:url("'.$base64.'");
        }
    </style>
</head>

<body class="fstdnnn" style="padding-bottom:30px;z-index:9999;">
   <div  style="">
      <div >
        <div style="padding:10px 40px;">
          <div style="margin-bottom: 10px; margin-top: 35px;float: left;padding-left:50px;"><img style="height: 3.4rem;" src="'.$base641.'"/> </div>
          <div style="margin-bottom: 10px; margin-top: 25px;margin-right:60px;float: right;">
             <img style="height: 70px;" src="'.$base642.'"/>
           </div>
        </div>
        <div style="padding-top:80px;text-align:center;"> <span style="margin-right:50px; font-size:32px; font-weight:bold;">Certificate of Internship</span> <br><br> <div style="font-size:22px;"><i>This certificate is presented to</i></div> <br>
          <div style="margin: 0px 26%;padding-bottom:5px;"><span style="font-size:30px;font-weight:bold;color: #009bcc;"><b>'.$row->name.'</b></span></div>
             <hr style="color:#be8b31;margin-left:30%;margin-right:30%;">
          <div style="line-height: 28px;"> <span style="font-size:20px;color: #6c6666;">in recognition of his/her efforts and achievements for successfully completing the internship program in </span> </div><br> <div style="font-size:30px;font-weight:bold;">'.$row->domain_name.' </div><br>
          <div style="font-size:20px;font-weight:bold;">from '.$row->course_start_date.' to '.$row->course_end_date.'.</div>
          <div style="padding:15px"> <span style="font-size:18px;color: #6c6666;">We wish him/her best of luck for all the future endeavours</span> </div>

          <div style="display:flex;margin: auto;width: 100%;padding-top:0px;padding-bottom:10px;">
            <div style="position:absolute;bottom:100px;left:140px;font-size: 17px;"><b>Issue Date: </b> '.$row->issue_date.'</div>
              <div style="position:absolute;bottom:100px;right:42%;margin: 0px;">
                  <img style="height: 100px;" src="'.$base643.'"/><br>
                  <hr style="color:#be8b31;">
                  <span><b>Authorized Signatory</b></span>

               </div>
            <div style="position:absolute;bottom:100px;right:140px;font-size: 16px;"><span><b>Certification ID:</b> '.$row->certification_id.'</span></div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>';
       }
        return $output;    
}



    public function user_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 0");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 0");
        if ($query->num_rows()>0) 
            return true;
        else
            return false;
    }
    

    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("updated", $data)){
                $data['updated'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("updated", $data)){
                $data['updated'] = date("Y-m-d H:i:s");
            }
            
            // Update offerpdf data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    
     public function fetch_member_email($Ids)
     {
        $query = $this->db->query("SELECT * FROM `certificate_pdf` WHERE `id` IN ($Ids) LIMIT 30");
        if ($query->num_rows()>0) 
        {
            return $query->result();
        }
        else
        {
            return false;
        }
     }

     public function user_mail_status($ID)
     {
        $query = $this->db->query("UPDATE `certificate_pdf` SET `mail_status`=1 WHERE `id` = '$ID'");
         if ($query) 
        {
            return true;
        }
        else
        {
            return false;
        }
     }


     
}