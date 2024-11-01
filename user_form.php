<style>
.vmformclass{
    text-align: left !important;
}
.vmformclass img{
   margin-left: -20px !important;
}</style>
<?php 
if(isset($_POST) && $_POST['addvmtest']=='addvmtest'){
    if(empty($_SESSION['vm-session'] ) ||
	  strcasecmp($_SESSION['vm-session'], $_POST['vm_captha']) != 0)
	{
    	echo "The captcha code does not match!";
      
        
	}else{
 echo VM_Testimonials_plus_actions('insert',$_POST);   
    }
}
?>
<?php echo "  <h2>" . __('Submit New Testimonial:', 'vm_testimonials') . "</h2>"; ?>
    <p><?php echo __('Fill the below form to Submit a new testimonial.', 'vm_testimonials'); ?></p>

    <form method="post" action="" name="vmtform" class="vmformclass">
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Name', 'vm_testimonials'); ?><span style="color: red;">*</span></label>
                </th>
                <td>
                    <input type="text" id="vm_name" name="vm_name" class="regular-text" value=""/>
                </td>
            </tr>
             
            <tr valign="top">
                <th scope="row"><label for="quote"><?php echo __('Testimonial', 'vm_testimonials'); ?><span style="color: red;">*</span></label>
                </th>
                <td>
                    <textarea class="large-text code" id="vm_testimonial" cols="40" rows="5" name="vm_testimonial"></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('WebSite', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_website" name="vm_website" class="regular-text" value=""/>
                </td>
            </tr>
             <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Company', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_company" name="vm_company" class="regular-text" value=""/>
                </td>
            </tr>
              <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Designation', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_Designation" name="vm_Designation" class="regular-text" value=""/>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="name">
                <div style="width: 120px !important;">
                <img src="<?php bloginfo("home"); ?>/wp-content/plugins/wp-vm-testimonials-plus/vm-captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' />
                <a href='javascript: refreshCaptcha();'><img style="padding: 5px;"src="<?php bloginfo("home"); ?>/wp-content/plugins/wp-vm-testimonials-plus/refresh.jpeg"/></a>
                </div>
                </th>
                <td> 
               <input id="vm_captha" name="vm_captha" type="text"/><br/>
               <label for='message'>Enter the code above </label>
             </td>
            </tr>
            <tbody>

            <input type="hidden" value="P" name="vm_status" id="vm_status"/>
        </p>
        </table>
        <p class="submit">

        <input type="hidden" value="addvmtest" name="addvmtest"/>
       <input type="submit" value="Submit Testimonial" class="button-primary" name="Submit"/>
          
    </form>
    <script>
    function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
    </script>

