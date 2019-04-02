<?php
add_action('admin_menu', 'boj_myplugin_add_page'); 

function boj_myplugin_add_page() 
{   
add_options_page( 'My Plugin', 'FINAL', 'manage_options',        
'boj_myplugin', 'boj_myplugin_option_page'    ); }
// Draw the option page 
function boj_myplugin_option_page() 
    {   
    
    ?>
    <div class="wrap">     
    <?php screen_icon(); ?>      
    <h2> My plugin </h2> 
    <form name="my_setting" action="options.php" method="post">      
        <p>
            <?php settings_fields('boj_myplugin_options'); ?>      
            <?php do_settings_sections('boj_myplugin'); ?>  
            <input name="Submit" type="submit" value="Save Changes" onclick= "my_print(); "/>       
            </p>

        <h1> <?php echo get_option("$text_string"); ?>
    </form>  
    </div>  
    
    
    <?php  }     
     // Register and define the settings 
     add_action('admin_init', 'boj_myplugin_admin_init'); 
     function boj_myplugin_admin_init()
     {    register_setting( 'boj_myplugin_options', 'boj_myplugin_options',        
     'boj_myplugin_validate_options' );    
     add_settings_section( 'boj_myplugin_main', 'My Plugin Settings',        
     'boj_myplugin_section_text', 'boj_myplugin' );    
     add_settings_field( 'boj_myplugin_text_string', 'Enter text here',        
     'boj_myplugin_setting_input', 'boj_myplugin', 'boj_myplugin_main' ); } 
     // Draw the section header 
     function boj_myplugin_section_text() 
        {    
        echo " <p> Enter your settings here. </p> "; }        
         // Display and fill the form field 
    function boj_myplugin_setting_input() 
         {    // get option 'text_string' value from the database    
         $options = get_option( 'boj_myplugin_options' );    
         $text_string = $options['text_string'];     
         
         // echo the field   
            echo " <input id= $text_string  name='boj_myplugin_options[text_string]'        
          type='text' value='$text_string' /> "; }   
          echo $text_string;     
          // Validate user input (we want text only) 
          function boj_myplugin_validate_options( $input ) 
          {    $valid = array();    
          $valid['text_string'] = preg_replace(        
              '/[^a-zA-Z]/',   '',
              $input['text_string'] );    
              return $valid; }     

        function my_print()
        {
            echo "$text_string";
        }
?>