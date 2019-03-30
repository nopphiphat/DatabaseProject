<?php
/**
 * plugin Name: HOA
 * Description: This is just an example plugin
 */


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
      $defaults = array('title' => 'Homeowner Assistant', 'movie' => '', 'song' => '', 'hoa_content'=> '');
      $instance = wp_parse_args((array) $instance, $defaults );
      $title = $instance['title'];
      $hoa_content = $instance['hoa_content'];
      ?>
      <p>Title:<input class=”widefat” name="<?php echo $this->get_field_name('title');?>" 
         type="text" value="<?php echo esc_attr($title);?>"/></p>
      <p>Content in HOA Widget:<textarea class="widefat" name="<?php echo $this-> get_field_name('hoa_content');?>"
         value="<?php echo esc_attr($hoa_content);?>"></textarea></p>
      <?php
   }

   //save the widget settings
   function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['hoa_content'] = strip_tags( $new_instance['hoa_content'] );
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

      if (!empty($title) ) { echo $before_title . $title . $after_title; };
         echo '<p> HI ' . $user_name . '</p>';
         echo '<p> You are one of '. $user_role . 's in our community.</p>';
         echo '<p> '. $this->$php_content . '</p>';
         echo $after_widget;
      if($user_role=='homeowner'){$this->hoa_homeowner();}
      elseif($user_role=='Board of Directors Member'||$user_role=='Board of Directors President'){$this->hoa_board_member();}
      elseif($user_role=='Property Manager Employee'){$this->hoa_property_employee();}
      elseif($user_role=='Property Manager Supervisor'){$this->hoa_property_supervisor();}
      //else{$this->hoa_property_manager_employee();}
      
   }

   
   //property_supervisor

   function hoa_property_employee(){
      
         ?>
         <div id="hoa_insert_place"></div>
         
         <div id="hoa_add_request_page" class="ui longe modal">
            <div class="content">
         <form id="email_form" class="ui form">
        <h4 class="ui dividing header">Hoa Request Form</h4>
        <div class="field">
          <label>Name</label>
          <div class="two fields">
            <div class="field">
              <input id="hoa_c_first_name" type="text" name="hoa-first-name" placeholder="First Name">
            </div>
            <div class="field">
              <input id="hoa_c_last_name" type="text" name="hoa-last-name" placeholder="Last Name">
            </div>
          </div>
        </div>
        
        <div class="two fields">
            <div class="field">
              <label>Phone Number</label>
              <div class="filed">
                  <input id="hoa_c_phone_number" type="number" name="hoa-from-phone" placeholder="Your Phone Number">
              </div>
            </div>
          <div class="field">
            <label>Email Address</label>
            <div class="filed">
              <input id="hoa_c_email" type="text" name="hoa-from-email" placeholder="Your Email">
            </div>
          </div>
        </div>

        <div class="field">
          <label>Address</label>
          <div class="fields">
            <div class="twelve wide field">
              <input id="hoa_c_address" type="text" name="hoa-address" placeholder="Street Address">
            </div>
            <div class="four wide field">
              <input id="hoa_c_apt" type="text" name="hoa-address-2" placeholder="Apt #">
            </div>
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>State</label>
            <select id="hoa_c_state" class="ui fluid dropdown">
              <option value="">State</option>
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="DC">District Of Columbia</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
            </select>
          </div>
          
          <div class="field">
              <label>Country</label>
              <input id="hoa_c_country" type="text" name="Country" placeholder="US">
            </div>
        </div>

        <div class="field">
            <label>Community</label>
            <select id="hoa_c_community" class="ui fluid dropdown">
              <option value="">Community_1</option>
              <option value="AL">Community_2</option>
              <option value="AK">Community_3</option>
              <option value="AZ">Community_4</option>
              <option value="AR">Other</option>
            </select>
        </div>

            <div class="field">
              <label>Email Content</label>
              <textarea id="hoa_c_email_content"></textarea>
            </div>
      </form>
      
      
      </div>
      <div class="actions">
      <div class="ui positive right button" onclick=HOA_Send_Mail()>
        Add Request
      </div>
      </div>
         </div>
         

         <div class="three ui buttons" style="margin-bottom:30px">
               <div class="ui animated button" tabindex="0" onclick=Hoa_add_request_button()>
                  <div class="hidden content">Add Request</div>
                  <div class="visible content">
                  <i class="wpforms icon"></i>
               </div>
               </div>
            
               <div class="ui animated button" tabindex="0" onclick=Hoa_property_employee_box_button()>
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


   function hoa_board_member(){

         ?>
         <div id="hoa_insert_place"></div>
         
         <div id="hoa_page_1" class="ui longe modal">
               <i class="close icon"></i>
            <div class="header">
               HOA PhoneNumber  571-234-1532
            </div>
            <div class="content">
               HOA will help you to manage your Home.
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


               <div class="ui animated button" tabindex="0" onclick=Hoa_board_chart_button_()>
                  <div class="hidden content">Chart</div>
                  <div class="visible content">
                  <i class="chart area icon"></i>
               </div>
            </div>
         </div>
         <?php
   }

   //show for homeowner only
   function hoa_homeowner(){
         //test
         ?>
         <div id="hoa_insert_place"></div>
            <div id="hoa_page_1" class="ui longe modal">
               <i class="close icon"></i>
            <div class="header">
               HOA PhoneNumber  571-234-1532
            </div>
            <div class="content">
               HOA will help you to manage your Home.
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
            
               <div class="ui animated button" tabindex="0" onclick=Hoa_email_button()>
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

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dimmer.js"></script>
     <script type="text/javascript" src=<?php echo plugins_url('js/hoafunctions.js',__FILE__) ?>></script>
     
    <?php
 }

 add_action('wp_footer','add_semantic_ui');




 function my_good_example_function()
 {
    $information = "Hello Word";


 }
 add_shortcode('example','my_good_example_function');

 

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

