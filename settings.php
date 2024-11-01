<?php
if(isset($_POST) && $_POST['vm_tm_settings']=='add'){
 echo VM_Testimonials_plus_actions('vm_tm_settings',$_POST);   
    
}
$vm_effects = array('None','Slide','Fade');
$vm_email = '';
$vm_widget_width = '';
$vm_widget_height = '';
$vm_tm_effects = '';
if(get_option('vm_tetmonial_settings')){
$vm_tm_settings = get_option('vm_tetmonial_settings');
$vm_email = $vm_tm_settings['vm_email'];
$vm_widget_width = $vm_tm_settings['vm_widget_width'];
$vm_widget_height = $vm_tm_settings['vm_widget_height'];
$vm_tm_effects = $vm_tm_settings['vm_tm_effects']; 
}


?>
<?php echo "  <h3>" . __('VM Testimonial Settings:', 'vm_testimonials') . "</h3>"; ?>
   
    <form method="post" action="">
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Testimonial Email:', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_email" name="vm_email" class="regular-text" value="<?php echo $vm_email;?>"/>
                </td>
            </tr>
             <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Testimonial Widget Width:', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input size="5" type="text" id="vm_widget_width" name="vm_widget_width" value="<?php echo $vm_widget_width;?>"/>
                </td>
            </tr>
               <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Testimonial Widget Height:', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input size="5" type="text" id="vm_widget_height" name="vm_widget_height" value="<?php echo $vm_widget_height;?>"/>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="quote"><?php echo __('Effects:', 'vm_testimonials'); ?></label>
                </th>
                <td>
                <select name="vm_tm_effects" id="vm_tm_effects">
                <?php
                for($j=0;$j<count($vm_effects);$j++){ 
                ?>
                <option value="<?=$vm_effects[$j]?>" <?=($vm_effects[$j]==$vm_tm_effects)?'selected':''?>><?=$vm_effects[$j]?></option>
                <?php
                } 
                ?>
               
               </select>
                </td>
                
            </tr>
              
            <tbody>
        </table>
        <p class="submit">
          <input type="hidden" name="vm_tm_settings" value="add" />
            <input type="submit" value="Submit" class="button-primary" name="Submit"/>
        </p>
    </form>

<hr/>