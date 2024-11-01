<?php
if ( !session_id() )
	session_start();
/*
Plugin Name: VM Testimonials Plus
Plugin URI: htt://blog.vinmatrix.com
Description: 
Author: Vinay
Version: 1.0
Author URI: htt://blog.vinmatrix.com
*/
$wpdb->vm_testimonials = $table_prefix.'vm_testimonials';

add_action('admin_menu', 'wp_vm_testimonials_plus_page');
add_action('init', 'VM_Testimonials_plus_install');
// action function for above hook

function VM_Testimonials_plus_install()
{
    global $wpdb;
    if ($wpdb->get_var("SHOW TABLES LIKE '$wpdb->vm_testimonials'") != $wpdb->vm_testimonials)
    {
        $sql = "CREATE TABLE " . $wpdb->vm_testimonials . " (  
      id int(10) NOT NULL AUTO_INCREMENT,   
      name varchar(255) NOT NULL,  
      designation varchar(255) NULL,
      company varchar(255) NULL,
      message text NOT NULL,   
      website varchar(255) NULL,
      status varchar(50)NOT NULL,
	  isinpool enum('yes', 'no') DEFAULT 'no' NOT NULL,
      PRIMARY KEY (id),  
      KEY id (id)  
    );";
        mysql_query($sql);
    }
}
function wp_vm_testimonials_plus_page() {
    // Add a new top-level menu (ill-advised):
    add_menu_page(__('VM Testimonials','menu-test'), __('VM Testimonials','menu-test'), 'manage_options', 'vm-testimonial-intro', 'vm_testimonial_intro_page' );
    add_submenu_page('vm-testimonial-intro', __('Manage Testimonials','menu-test'), __('Manage Testimonials','menu-test'), 'manage_options', 'vm-testimonial_plus_admin', 'VM_Testimonials_plus_admin');
    add_submenu_page('vm-testimonial-intro', __('Settings','menu-test'), __('Settings','menu-test'), 'manage_options', 'vm-testimonial_plus_settings', 'VM_Testimonials_plus_settings');
  
}



function vm_testimonial_intro_page() {
    echo "<h2>" . __( 'Introduction', 'menu-test' ) . "</h2>";
	require_once('intro.php');
}


function VM_Testimonials_plus_admin()
{
    require_once ('adminpanel.php');
}
function VM_Testimonials_plus_settings(){
     require_once ('settings.php');
}
function VM_Testimonials_plus_actions($action,$data)
{       
	  
    //NAME,designation,company,message,website,STATUS,isinpool
    global $wpdb;
  // print_r($action);
	switch ($action) {
		case 'delete':
			 $id = $data['vmid'];
          // print_r($data);
			$wpdb->query("DELETE FROM $wpdb->vm_testimonials WHERE id='$id'");
            return '<div class="updated"><p><strong>Testimonial Deleted..</strong></p></div>';
           
		break;
		case 'insert':
                $name = $data['vm_name'];
                $testimonial = $data['vm_testimonial'];
                $website = $data['vm_website'];
                $company = $data['vm_company'];
                $Designation = $data['vm_Designation'];
                $status = $data['vm_status'];
              	if($name=='' || $testimonial=='')
                return '<strong>Name & Testimonial are required fields!..</strong>';
               
                if(($name=='' || $testimonial=='')&& ($status=='A'))
                return '<div class="error"><p><strong>Name & Testimonial are required fields!..</strong></p></div>';
                    $wpdb->query("INSERT INTO $wpdb->vm_testimonials (name,designation,company,message,website,STATUS) VALUES ('$name', '$Designation', '$company','$testimonial','$website','$status')");
		       if($status=='P'){
		        
		          $vm_tm_settings = get_option('vm_tetmonial_settings');
                  $vm_email = $vm_tm_settings['vm_email'];
                  if($vm_email==''){
                  $vm_email =   get_option('admin_email');
                  }
		          $to = $vm_email;
                  $subject = "New Testimonial Arrived & Waiting for Approval!..";
                  
                  $headers ="From: ".get_option('siteurl');
                  mail($to,$subject,'',$headers);
                return '<strong>Testimonial submitted..</strong>';
             
		       }
               return '<div class="updated"><p><strong>Testimonial Added..</strong></p></div>';
           
            
            break;
      
    	case 'update':
        $name = $data['vm_name'];
        $testimonial = $data['vm_testimonial'];
        $website = $data['vm_website'];
        $company = $data['vm_company'];
        $Designation = $data['vm_Designation'];
        $status = $data['vm_status'];
        $id = $data['vmtestid'];
      	$wpdb->query("UPDATE  $wpdb->vm_testimonials SET name='$name',designation='$Designation',company='$company',message='$testimonial',website='$website' WHERE id=".$id);
        return '<div class="updated"><p><strong>Testimonial Updated..</strong></p></div>';
   
    
            break;
        case 'list':
             
	        $sql = "SELECT * FROM $wpdb->vm_testimonials where status='A'" ;
           	$found = 0;
            $data = Array();
            if ($results = $wpdb->get_results($sql, ARRAY_A)) {
		      
            
			foreach ($results as $value) {
			 
			$found++;
            }
            if($found==0){
                return $data; 
            }else{
                $data = $wpdb->get_results($sql, ARRAY_A); 
               return $data; 
            }
           
		  }
	        
    
		break;
         case 'listofpool':
             
	        $sql = "SELECT * FROM $wpdb->vm_testimonials where isinpool='yes'";
           	$found = 0;
            $data = Array();
            if ($results = $wpdb->get_results($sql, ARRAY_A)) {
		      
            
			foreach ($results as $value) {
			 
			$found++;
            }
            if($found==0){
                return $data; 
            }else{
                $data = $wpdb->get_results($sql, ARRAY_A); 
               return $data; 
            }
           
		  }
	        
    
		break;
        case 'listofusertestimonials':
             
	        $sql = "SELECT * FROM $wpdb->vm_testimonials where status='P' ";
           	$found = 0;
            $data = Array();
            if ($results = $wpdb->get_results($sql, ARRAY_A)) {
		      
            
			foreach ($results as $value) {
			 
			$found++;
            }
            if($found==0){
                return $data; 
            }else{
                $data = $wpdb->get_results($sql, ARRAY_A); 
               return $data; 
            }
           
		  }
	        
    
		break;
        
         case 'approvetestimonial':
             
	$id = $data['vmid'];
       
      	$wpdb->query("UPDATE  $wpdb->vm_testimonials SET status='A' WHERE id=".$id);
        return '<div class="updated"><p><strong>Testimonial Approved..</strong></p></div>';
   
	        
    
		break;
         case 'addtopool':
      
        $id = $data['vmid'];
      	$wpdb->query("UPDATE  $wpdb->vm_testimonials SET isinpool='yes' WHERE id=".$id);
        return '<div class="updated"><p><strong>Testimonial Added to Pool..</strong></p></div>';
   
	        
    
		break;
         case 'removefrompool':
             
	
        $id = $data['vmid'];
      	$wpdb->query("UPDATE  $wpdb->vm_testimonials SET isinpool='no' WHERE id=".$id);
        return '<div class="updated"><p><strong>Testimonial Removed from Pool..</strong></p></div>';
   
	        
    
		break;
        	case 'byid':
            
            $id = $data['vmid'];
            $sql = "SELECT * FROM $wpdb->vm_testimonials where id=".$id;
           	$found = 0;
            $data = Array();
            if ($results = $wpdb->get_results($sql, ARRAY_A)) {
		      
            
			foreach ($results as $value) {
			 
			$found++;
            }
            if($found==0){
                return $data; 
            }else{
                $data = $wpdb->get_results($sql, ARRAY_A); 
               return $data; 
            }
           
		  }
            
            break;
        case 'vm_tm_settings':
        update_option('vm_tetmonial_settings',$data);     
	
       return '<div class="updated"><p><strong>Updated..</strong></p></div>';
   
	        
    
		break;
            
        default:
        
        	break;
	}
}

function getVMUserTestimonialForm(){
    require_once ('user_form.php');
}
function getVMTestimonialsWeidget(){
    require_once ('widget.php');
}
add_shortcode('VM-Testimonials-Form', 'getVMUserTestimonialForm');
add_shortcode('VM-Testimonials-Widget', 'getVMTestimonialsWeidget');
?>