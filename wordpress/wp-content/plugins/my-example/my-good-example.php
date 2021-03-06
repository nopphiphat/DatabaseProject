<?php
/**
 * plugin Name: HOA
 * Description: This is just an example plugin
 */


include "my_setting.php";

/*
Get Current User information
*/
$current_user;
$current_user_id;
$current_user_name;
$current_user_email;
$current_user_firstname;
$current_user_lastname;
$current_user_display_name;
$current_user_role;

add_action('init','init_hoa_plugin');

function init_hoa_plugin(){
   $current_user = wp_get_current_user();
   $current_user_id = $current_user->ID;
   update_option('hoa_user_id',$current_user->ID);
   update_option('hoa_user_name',$current_user->user_login);
   update_option('hoa_user_email',$current_user->user_email);
   update_option('hoa_user_firstname',$current_user->user_firstname);
   update_option('hoa_user_lastname',$current_user->user_lastname);
   update_option('hoa_user_dispaly_name',$current_user->display_name);
   update_option('hoa_user_role',implode(', ', get_userdata($current_user_id)->roles));
}

/*
import varibale php
*/

/*
php option variables
*/
$username = "";
$password = "";
$privilege = "";
/*
Set the options in to wordpress 
*/ 

add_option("hoa_username",$username);
add_option("hoa_password",$password);
add_option("hoa_privilege",$privilege);

/*
The plugin setting area
add_option('color','red);
*/

/*
Create the roles
*/
add_role(
   'Homeowener',
   __( 'Homeowner' ),
   array(
       'read'         => true,  // true allows this capability
       'edit_posts'   => true,
   )
);

add_role(
   'Property Manager Employee',
   __( 'Property Manager Employee' ),
   array(
       'read'         => true,  // true allows this capability
       'edit_posts'   => true,
   )
);

add_role(
   'Property Manager Supervisor',
   __( 'Property Manager Supervisor' ),
   array(
       'read'         => true,  // true allows this capability
       'edit_posts'   => true,
   )
);

add_role(
   'Board of Directors Member',
   __( 'Board of Directors Member' ),
   array(
       'read'         => true,  // true allows this capability
       'edit_posts'   => true,
   )
);

add_role(
   'Board of Directors President',
   __( 'Board of Directors President' ),
   array(
       'read'         => true,  // true allows this capability
       'edit_posts'   => true,
   )
);




/*
Add menu page
*/

/*example
*/

// Hook for adding admin menus
add_action('admin_menu', 'hoa_add_pages');

// action function for above hook
function hoa_add_pages() {

   //($parent_slug, $page_title,$menu_title,$capability,$menu_slug, $function)

    // Add a new submenu under Settings:
    add_options_page('HOA Settings','HOA Settings', 'manage_options', 'hoasettings', 'hoa_settings_page');

    // Add a new submenu under Tools:
    add_management_page( 'HOA Tools', 'HOA Tools', 'manage_options', 'hoatools', 'hoa_tools_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page('HOA Settings', 'HOA Settings', 'manage_options', 'hoa-top-level-handle', 'hoa_toplevel_page' );

    // Add a submenu to the custom top-level menu:
    add_submenu_page('hoa-top-level-handle', 'HOA Sublevel', 'HOA Sublevel', 'manage_options', 'sub-page', 'hoa_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page('hoa-top-level-handle', 'HOA Sublevel 2', 'HOA Sublevel 2', 'manage_options', 'sub-page2', 'hoa_sublevel_page2');
}

// mt_settings_page() displays the page content for the Test Settings submenu
function hoa_settings_page() {
    echo "<h2>" . __( 'HOA Settings', 'menu-test' ) . "</h2>";
}

// mt_tools_page() displays the page content for the Test Tools submenu
function hoa_tools_page() {
    echo "<h2>" . __( 'HOA Tools', 'menu-test' ) . "</h2>";
}

// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function hoa_toplevel_page() {
    echo "<h2>" . __( 'HOA Settings', 'menu-test' ) . "</h2>";
}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function hoa_sublevel_page() {
    echo "<h2>" . __( 'Test Sublevel', 'menu-test' ) . "</h2>";
}

// mt_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function hoa_sublevel_page2() {
    echo "<h2>" . __( 'Test Sublevel2', 'menu-test' ) . "</h2>";
}

/*
Plugin Administartion Page
*/

add_action('admin_menu','hoa_admin_page');
function hoa_admin_page(){
   add_object_page('HOA Plugin','HOA Plugin','manage_options','hoa_plugin','hoa_plugin_options_page');
}

function hoa_plugin_options_page(){
   ?>
   <div class="wrap">
   <?php screen_icon();?>
   <h2>HOA Plugin Setting</h2>
   <form action="options.php" method="post">
   </form></div>
   <?php
}



/*
init widgets
*/

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'hoa_register_widgets' );
//register our widget
function hoa_register_widgets() {
   register_widget( 'hoa_widget' );
}
//boj_widget_my_info class
class hoa_widget extends WP_Widget {

   //process the new widget
   function hoa_widget() {
      $this->$php_content="";

      //Set the options of widget 
      $widget_ops = array(
            'classname' => 'hoa_widget_class',
            'description' => 'Help the houseowner.'
      );
      //Set the name of Widget
      $this-> WP_Widget( 'hoa_widget', 'Homeowner Assistant',$widget_ops );
   }
//build the widget settings form
   function form($instance) {
      $defaults = array('title' => 'Homeowner Assistant', 'hoa_phone'=>'','hoa_email'=>'','hoa_content'=> '');
      $instance = wp_parse_args((array) $instance, $defaults );
      $title = $instance['title'];
      $hoa_phone = $instance['hoa_phone'];
      $hoa_email = $instance['hoa_email'];
      $hoa_content = $instance['hoa_content'];
      ?>
      <p>Title:<input class=”widefat” name="<?php echo $this->get_field_name('title');?>" 
         type="text" value="<?php echo esc_attr($title);?>"/></p>
      <p>Phone:<input class=”widefat” name="<?php echo $this->get_field_name('hoa_phone');?>" 
         type="text" value="<?php echo esc_attr($hoa_phone);?>"/></p>
      <p>Email:<input class=”widefat” name="<?php echo $this->get_field_name('hoa_email');?>" 
         type="text" value="<?php echo esc_attr($hoa_email);?>"/></p>
      <p>Content in HOA Widget:<textarea class="widefat" name="<?php echo $this-> get_field_name('hoa_content');?>"
         value="<?php echo esc_attr($hoa_content);?>"></textarea></p>
      <?php
   }

   //save the widget settings
   function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['hoa_content'] = strip_tags( $new_instance['hoa_content'] );
      $instance['hoa_phone'] = strip_tags( $new_instance['hoa_phone'] );
      $instance['hoa_email'] = strip_tags( $new_instance['hoa_email'] );
      return $instance;
   }

   //display the widget
   function widget($args, $instance) {
      extract($args);
      echo $before_widget;
      $user_name = get_option('hoa_user_name');
      $user_role = get_option('hoa_user_role');
      $title = apply_filters('widget_title', $instance['title']);
      $php_content = empty($instance['hoa_content'] )?'& nbsp;':$instance['hoa_content'];
      $hoa_phone = empty($instance['hoa_phone'] )?'& nbsp;':$instance['hoa_phone'];
      $hoa_email = empty($instance['hoa_email'] )?'& nbsp;':$instance['hoa_email'];

      if (!empty($title) ) { echo $before_title . $title . $after_title; };
         echo '<p> HI ' . $user_name . '</p>';
         echo '<p> You are one of '. $user_role . 's in our community.</p>';
         echo '<p> '. $php_content . '</p>';
         echo $after_widget;
      if($user_role=='homeowner'){$this->hoa_homeowner($hoa_phone,$hoa_email);}
      elseif($user_role=='Board of Directors Member'||$user_role=='Board of Directors President'){$this->hoa_board_member($hoa_phone,$hoa_email);}
      elseif($user_role=='Property Manager Employee'){$this->hoa_property_employee();}
      elseif($user_role=='Property Manager Supervisor'){$this->hoa_property_supervisor();}
      else{$this->hoa_homeowner($hoa_phone,$hoa_email);}
      //else{$this->hoa_property_manager_employee();}
      
   }

   
   //property_supervisor

   function hoa_property_employee(){
      $the_id=get_option('hoa_user_id') 
         ?>
      <div id="hoa_insert_place"></div>
         
         

         <div class="three ui buttons" style="margin-bottom:30px">
               <div class="ui animated button" tabindex="0" onclick=Hoa_add_request_button(<?php echo $the_id; ?>)>
                  <div class="hidden content">Add Request</div>
                  <div class="visible content">
                  <i class="wpforms icon"></i>
               </div>
               </div>
            
               <div class="ui animated button" tabindex="0" onclick=Hoa_property_employee_box_button(<?php echo $the_id; ?>)>
                  <div class="hidden content">Reuqest Box</div>
                  <div class="visible content">
                  <i class="box icon"></i>
               </div>
               </div>


               <div class="ui animated button" tabindex="0" onclick=Hoa_property_employee_chart_button_()>
                  <div class="hidden content">Chart</div>
                  <div class="visible content">
                  <i class="chart area icon"></i>
               </div>
            </div>
         </div>
         <?php
   }



   //for hoa_property_supervisor
   function hoa_property_supervisor(){
         ?>
         <div id="hoa_insert_place"></div>
         

         <div class="two ui buttons" style="margin-bottom:30px">
               <div class="ui animated button" tabindex="0" onclick=Hoa_assign_work_button()>
                  <div class="hidden content">Assign Work</div>
                  <div class="visible content">
                  <i class="sitemap icon"></i>
               </div>
               </div>
            
               <div class="ui animated button" tabindex="0" onclick=Hoa_property_supervisor_chart_button()>
                  <div class="hidden content">Report</div>
                  <div class="visible content">
                  <i class="chart area icon"></i>
               </div>
               </div>
         </div>
         <?php
   }


   function hoa_board_member($hoa_phone,$hoa_email){

         ?>
         <div id="hoa_insert_place"></div>
         
         <div id="hoa_page_1" class="ui longe modal">
               <i class="close icon"></i>
            <div class="header">
               Homeowner Assitant
            </div>
            <div class="content">
               <p>HOA will help you to manage your Home.</p>
               <p>HOA PHONE: <?php echo $hoa_phone;?></p>
               <p>HOA EMAIL: <?php echo $hoa_email;?></p>
            </div>
            <div class="actions">
               <div class="ui positive right button">
                  Confirm
               </div>
            </div>
         </div>
         

         <div class="three ui buttons" style="margin-bottom:30px">
               <div class="ui animated button" tabindex="0" onclick=Hoa_phone_button()>
                  <div class="hidden content">Call</div>
                  <div class="visible content">
                  <i class="phone icon"></i>
               </div>
               </div>
            
               <div class="ui animated button" tabindex="0" onclick=Hoa_board_email_button()>
                  <div class="hidden content">Mail</div>
                  <div class="visible content">
                  <i class="envelope icon"></i>
               </div>
               </div>


               <div class="ui animated button" tabindex="0" onclick=Hoa_board_chart_button()>
                  <div class="hidden content">Chart</div>
                  <div class="visible content">
                  <i class="chart area icon"></i>
               </div>
            </div>
         </div>
         <?php
   }

   //show for homeowner only
   function hoa_homeowner($hoa_phone,$hoa_email){
         $the_id=get_option('hoa_user_id') 
         //test
         ?>
         <div id="hoa_insert_place"></div>
            <div id="hoa_page_1" class="ui longe modal">
               <i class="close icon"></i>
            <div class="header">
               Homeowner Assitant
            </div>
            <div class="content">
               <p>HOA will help you to manage your Home.</p>
               <p>HOA PHONE: <?php echo $hoa_phone;?></p>
               <p>HOA EMAIL: <?php echo $hoa_email;?></p>
            </div>
            <div class="actions">
               <div class="ui positive right button">
                  Confirm
               </div>
            </div>
            </div>
         

         <div class="three ui buttons" style="margin-bottom:30px">
               <div class="ui animated button" tabindex="0" onclick=Hoa_phone_button()>
                  <div class="hidden content">Call</div>
                  <div class="visible content">
                  <i class="phone icon"></i>
               </div>
               </div>
            
               <div class="ui animated button" tabindex="0" onclick=Hoa_email_button(<?php echo $the_id; ?>)>
                  <div class="hidden content">Mail</div>
                  <div class="visible content">
                  <i class="envelope icon"></i>
               </div>
               </div>


               <div class="ui animated button" tabindex="0" onclick=Hoa_chart_button()>
                  <div class="hidden content">Chart</div>
                  <div class="visible content">
                  <i class="chart area icon"></i>
               </div>
            </div>
         </div>
         <?php
      }

   }





 //add semantic ui to wb_header


 function add_semantic_ui(){
    ?>
    <!--plugin css-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.min.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dimmer.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/accordion.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/rating.css"/>

     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dimmer.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/accordion.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/rating.js"></script>
     <script type="text/javascript" src=<?php echo plugins_url('js/hoafunctions.js',__FILE__) ?>></script>
     
    <?php
 }

 add_action('wp_footer','add_semantic_ui');




 function my_good_example_function()
 {
    $information = "Hello Word";


 }
 add_shortcode('example','my_good_example_function');




 
 
 
 function init_db(){
   global $wpdb;
   #$Request_table_name = $wpdb->prefix .$plugin_db_prefix. "Request";
   $User_table_name = $wpdb->prefix."users";
   $Request_table_name = $wpdb->prefix . "HOA_REQUEST";
   $Action_table_name = $wpdb->prefix . "HOA_ACTION";
   $Work_table_name = $wpdb->prefix . "HOA_WORK";
   
   #get charset
   $charset_collate = $wpdb->get_charset_collate();
  /*$sqlUser = "CREATE TABLE IF NOT EXISTS ".$User_table_name." (
 `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `user_login` VARCHAR(60) NOT NULL DEFAULT '',
 `user_pass` VARCHAR(255) NOT NULL DEFAULT '',
 `user_nicename` VARCHAR(50) NOT NULL DEFAULT '',
 `user_email` VARCHAR(100) NOT NULL DEFAULT '',
 `user_url` VARCHAR(100) NOT NULL DEFAULT '',
 `user_registered` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
 `user_activation_key` VARCHAR(255) NOT NULL DEFAULT '',
 `user_status` INT(11) NOT NULL DEFAULT '0',
 `display_name` VARCHAR(250) NOT NULL DEFAULT '',
 PRIMARY KEY (`ID`),
 INDEX `user_login_key` (`user_login` ASC) ,
 INDEX `user_nicename` (`user_nicename` ASC) ,
 INDEX `user_email` (`user_email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_520_ci;";*/
  $sqlUser ="ALTER TABLE ".$User_table_name." ADD INDEX `user_login_key` (`user_login` ASC);
ALTER TABLE ".$User_table_name." ADD INDEX `user_nicename` (`user_nicename` ASC);
ALTER TABLE ".$User_table_name." ADD INDEX `user_email` (`user_email` ASC);";
  
  $sqlRequest = "CREATE TABLE IF NOT EXISTS ". $Request_table_name . " (
 `Request_ID` INT NOT NULL AUTO_INCREMENT,
 `Request_Title` VARCHAR(100) NOT NULL,
 `Request_Description` VARCHAR(200) NOT NULL,
 `Request_Method` VARCHAR(40) NOT NULL,
 `Request_Users_ID` BIGINT(20) NULL,
 `Record_Employee_ID` BIGINT(20) NULL,
 `Record_Time` TIMESTAMP NOT NULL,
 `Request_Handler_ID` BIGINT(20) NOT NULL,
 `Request_Status` INT(11) NOT NULL,
 `Status_Time` TIMESTAMP NOT NULL,
 `Due_Time` TIMESTAMP NULL DEFAULT NULL,
 `Request_Rating` FLOAT NULL DEFAULT NULL,
 `Rating_time` TIMESTAMP NULL DEFAULT NULL,
 PRIMARY KEY (`Request_ID`),
 INDEX Request_Users_ID ( `Request_Users_ID` ))
ENGINE = InnoDB;";
  
  
  $sqlAction = "CREATE TABLE IF NOT EXISTS ". $Action_table_name . " (
 `Action_ID` INT NOT NULL AUTO_INCREMENT,
 `Request_ID` INT NOT NULL,
 `Assignee_ID` BIGINT(20) UNSIGNED NOT NULL,
 `Action_Description` VARCHAR(200) NOT NULL,
 `Start_Time` TIMESTAMP NOT NULL,
 `Action_Status` INT NOT NULL,
 `Status_Time` TIMESTAMP NOT NULL,
 `Due_Time` TIMESTAMP NOT NULL,
 PRIMARY KEY (`Action_ID`, `Request_ID`, `Assignee_ID`),
 CONSTRAINT `fk_h_actiion_h_hoa_request`
   FOREIGN KEY (`Request_ID`)
   REFERENCES `".$Request_table_name."` (`Request_ID`)
   ON DELETE NO ACTION
   ON UPDATE NO ACTION,
 CONSTRAINT `fk_h_actiion_h_users1`
   FOREIGN KEY (`Assignee_ID`)
   REFERENCES `".$User_table_name."` (`ID`)
   ON DELETE NO ACTION
   ON UPDATE NO ACTION,
  INDEX Request_ID ( `Request_ID` ),
  INDEX Assignee_ID ( `Assignee_ID` ))
ENGINE = InnoDB;";
  
  
  $sqlWork = "CREATE TABLE IF NOT EXISTS ".$Work_table_name." (
 `Work_User_ID` BIGINT(20) UNSIGNED NOT NULL,
 `Action_ID` INT NOT NULL,
 `Work_Description` VARCHAR(200) NOT NULL,
 `Record_Time` TIMESTAMP NOT NULL,
 PRIMARY KEY (`Work_User_ID`, `Action_ID`),
 CONSTRAINT `fk_Work_h_action1`
   FOREIGN KEY (`Action_ID`)
   REFERENCES `".$Action_table_name."` (`Action_ID`)
   ON DELETE NO ACTION
   ON UPDATE NO ACTION,
 CONSTRAINT `fk_Work_h_users1`
   FOREIGN KEY (`Work_User_ID`)
   REFERENCES `".$User_table_name."` (`ID`)
   ON DELETE NO ACTION
   ON UPDATE NO ACTION,
  INDEX Action_ID ( `Action_ID` ),
  INDEX Work_User_ID ( `Work_User_ID` )
  )ENGINE = InnoDB;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sqlUser );
  dbDelta( $sqlRequest );
  dbDelta( $sqlAction );
  dbDelta( $sqlWork );
}
//set default option
register_activation_hook(__FILE__,'init_db');
//init database

//deaction
//register_deactivation_hook($file,$function);
//deaction
//register_deactivation_hook($file,$function);
 

 //track the script in the path
 //plugin_dir_path(__FILE__).'js/script.js';
 //refer an image
 //<img src="'.plugins_url('images/icon.png',__FILE__).'">';

 //set default option
 //register_activation_hook(__FILE__,'INIT_FUNCTION');
 //INIT DATABASE

 //deaction
 //register_deactivation_hook($file,$function);


?>

