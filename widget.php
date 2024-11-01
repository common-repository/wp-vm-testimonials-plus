<script src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php bloginfo("home"); ?>/wp-content/plugins/wp-vm-testimonials-plus/js/jquery.innerfade.js"></script>
<?php 
$vm_tm_loop =  VM_Testimonials_plus_actions('listofpool','');   
if(count($vm_tm_loop)<1){
echo "There are no Testimonials in pool to show, please check from <a href=".get_option('siteurl')."/wp-admin/admin.php?page=vm-testimonial_plus_admin>admin panel</a>..";    
?>

<?php    
}else{
$vm_tm_settings = get_option('vm_tetmonial_settings');
$vm_widget_width = $vm_tm_settings['vm_widget_width'];
$vm_tm_effects = $vm_tm_settings['vm_tm_effects']; 
$vm_widget_height = $vm_tm_settings['vm_widget_height'];
$vm_widget_width = ($vm_widget_width=='')?300:$vm_widget_width;
$vm_tm_effects = ($vm_tm_effects=='')?'':strtolower($vm_tm_effects);
$vm_widget_height = ($vm_widget_height=='')?100:$vm_widget_height;
  ?>  
   <div  id="vm_tm_widget" style="width: <?=$vm_widget_width?>px !important;">

   <div id="alltestimonials" >
<?php 

for($k=0;$k<count($vm_tm_loop);$k++){
$vm_tm_loop_item = $vm_tm_loop[$k];
?>
<div id="vm_tm_innerdiv<?=$vm_tm_loop_item['id']?>" style="width:<?=$vm_widget_width?>px !important;"">
<div >
<?php echo $vm_tm_loop_item['message']; ?>
</div>
<div style="float: right;">
<span><b>By:</b></span>
<span><?php echo $vm_tm_loop_item['name']; ?></span><br /> 
<span><?php echo $vm_tm_loop_item['company']; ?></span><br />  
<span><?php echo $vm_tm_loop_item['designation']; ?></span><br />
<?php
if($vm_tm_loop_item['website']!=""){
    ?>
<span><a href="<?php echo $vm_tm_loop_item['website']; ?>" target="_blank" style="text-decoration: none;">website</a></span><br />  
<?php
}
?>
</div>
</div>
<br/><br/>
<?php
}
}
?>
	
</div>
   </div>
<?php
if($vm_tm_effects=='fade'){
?>
<script>

 $(document).ready(
				function(){
					$('#alltestimonials').innerfade({
						animationtype: '<?=$vm_tm_effects?>',
						speed: 5000,
						timeout: 500,
						containerheight: <?=$vm_widget_height?>
                        
					});


			});
</script>
<?php
}
if($vm_tm_effects=='slide'){
?>
<script>

 $(document).ready(
				function(){
					$('#alltestimonials').innerfade({
						animationtype: '<?=$vm_tm_effects?>',
						speed: 500,
						timeout: 1000,
						containerheight: <?=$vm_widget_height?>
                        
					});


			});
</script>
<?php
}
?>