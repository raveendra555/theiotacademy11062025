<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebinarModel extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'webinar';
    }    

    public function getVerifiedMember($certificate_id){

        $this->db->where('certification_id',$certificate_id);
         $query = $this->db->get("webinar");
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
        $query = $this->db->query("SELECT  * FROM webinar Where status = 1 ORDER BY id DESC");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    

    public function fetch_certificate_name($offerid){

           $this->db->where('id',$offerid);
         $data= $this->db->get('webinar');
         foreach($data->result() as $row){

              $nameresult=$row;
         }

         return $nameresult;    
       
    }
    public function fetch_single_details($offerid){
        $this->db->where('id',$offerid);
         $data= $this->db->get('webinar');
         foreach($data->result() as $row){

 $path = base_url('assets/images/banners/webinar-certificate-template.png');
 $type = pathinfo($path, PATHINFO_EXTENSION);
 $data = file_get_contents($path);
 $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path1 = base_url('assets/images/the-iot-logo-new.webp');
$type1 = pathinfo($path1, PATHINFO_EXTENSION);
$data1 = file_get_contents($path1);
$base641 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

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
          <div style="margin-bottom: 10px; margin-top:50px;text-align:center;"><img style="height: 4.8rem;" src="'.$base641.'"/> </div>
          
        </div>
        <div style="padding-top:10px;text-align:center;"> <span style="font-size:35px; font-weight:bold;">Certificate of Participation</span> <br> <hr style="color:#009bcc;margin-left:35%;margin-right:35%;"> <div style="font-size:22px; padding-top:0px;">This certificate is awarded to</div> <br>
          <div style="margin: 0px 26%;padding-bottom:5px;"><span style="font-size:30px;font-weight:bold;color: #000;"><b>'.$row->name.'</b></span></div>
          <div style="line-height: 28px;"> <span style="font-size:20px;color: #6c6666;">For participating in the </span> </div><br> <div style="font-size:25px;font-weight:bold;padding-left:150px;padding-right:150px;">"'.$row->topic.' "</div><br>
          
          <div style="display:flex;margin: auto;width: 100%;padding-top:0px;padding-bottom:10px;">
            <div style="position:absolute;bottom:100px;left:140px;font-size: 16px;">'.$row->issue_date.'  <span style="color: #6c6666;display:block;margin-top:6px;">Issue Date</span></div>
            <hr style="position:absolute;bottom:112px;left:130px; color: #009bcc;width:100px;">
              <div style="position:absolute;bottom:100px;right:42%;margin: 0px;">
                  <img style="height: 100px;" src="'.$base643.'"/><br>
                  <p style="color: #6c6666;paddig:0; margin:0">The IoT Academy</p>
                  <p style="color: #6c6666;padding:0;margin:0;">(Uniconverge Technologies Pvt. Ltd.)</p>

               </div>
            <div style="position:absolute;bottom:100px;right:140px;font-size: 16px;"><span>'.$row->certification_id.'</span> <span style="display:block;margin-top:6px;">Certification ID</span></div>
             <hr style="position:absolute;bottom:112px;right:150px; color: #009bcc;width:110px;">
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
        $query = $this->db->query("SELECT  * FROM webinar Where status = 0");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM webinar Where status = 0");
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
        $query = $this->db->query("SELECT * FROM `webinar` WHERE `id` IN ($Ids) LIMIT 30");
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
        $query = $this->db->query("UPDATE `webinar` SET `mail_status`=1 WHERE `id` = '$ID'");
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