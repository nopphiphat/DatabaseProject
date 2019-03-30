<?php
/**
 * plugin Name: HOA
 * Description: This is just an example plugin
 */


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
      $movie = $instance['movie'];
      $song = $instance['song'];
      $hoa_content = $instance['hoa_content'];
      ?>
      <p>Title:<input class=”widefat” 
         name="<?php echo $this->get_field_name('title');?>" 
         type="text" value=" <?php echo esc_attr( $title );?>"/></p>
      <p> Favorite Movie: <input class="widefat" 
         name="<?php echo $this->get_field_name('movie');?>"
         type=”text” value="<?php echo esc_attr( $movie );?>"></p>
      <p> Favorite Song: <textarea class="widefat"
         name="<?php echo $this-> get_field_name('song');?>" 
         value="<?php echo esc_attr($song);?>"> </textarea></p>
      <p>Content in HOA Widget:<textarea class="widefat"
         name="<?php echo $this-> get_field_name('hoa_content');?>"
         value="<?php echo esc_attr( $hoa_content );?>"></textarea></p>
      <?php
   }
   //save the widget settings
   function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['movie'] = strip_tags( $new_instance['movie'] );
      $instance['song'] = strip_tags( $new_instance['song'] );
      $instance['hoa_content'] = strip_tags( $new_instance['hoa_content'] );
      return $instance;
   }
   //display the widget
   function widget($args, $instance) {
      extract($args);
      echo $before_widget;
      $title = apply_filters('widget_title', $instance['title']);
      $movie = empty( $instance['movie'] )?'& nbsp;':$instance['movie'];
      $song = empty( $instance['song'] )?'& nbsp;':$instance['song'];
      $this->$php_content = empty( $instance['hoa_content'] )?'& nbsp;':$instance['hoa_content'];
      if (!empty($title) ) { echo $before_title . $title . $after_title; };
         echo '<p> Fav Movie:' . $movie . '</p>';
         echo '<p> Fav Song:'. $hoa_test . '</p>';
         echo '<div id="hoa_insert"><p> The content:'. $this->$php_content . '</p></div>';
         echo $after_widget;
         ?>
         <div class="ui horizontal relaxed list">
            <div class="item">
               <div class="ui animated button" tabindex="0" onclick=Hoa_phone_button()>
                  <div class="hidden content">Call</div>
                  <div class="visible content">
                  <i class="phone icon"></i>
               </div>
               </div>
            </div>
            
         
            <div class="item">
               <div class="ui animated button" tabindex="0" onclick=user_login_email()>
                  <div class="hidden content">Mail</div>
                  <div class="visible content">
                  <i class="envelope icon"></i>
               </div>
               </div>
            </div>


            <div class="item">
               <div class="ui animated button" tabindex="0" onclick=Hoa_chart_button()>
                  <div class="hidden content">Chart</div>
                  <div class="visible content">
                  <i class="chart area icon"></i>
               </div>
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


 function add_hoa_content(){
    ?>
    
   <div id="hoa_plugin">
    <!--Test-->
    <div class="ui middle aligned animated list" style="position:fixed;z-index:1000;top:40%;">
      <div class="item">
         <button class="ui active button" id="hoa_phone" style="width:130px" onclick=Hoa_phone_button()><i class="big phone icon"></i>Call </button>
      </div>

      <div class="item">
         <button class="ui active button" style="width:130px" onclick=user_login_email()><i class="big envelope icon"></i> Mail </button>
      </div>


      <div class="item">
         <button class="ui active button" style="width:130px" onclick=Hoa_chart_button()><i class="big chart area icon"></i> Chart </button>
      </div>
     </div>
   </div>
   
<!--the place will be inserted html-->   
<div id="hoa_insert">
   
</div>




<!--login page-->
<div id="hoa_page_2"class="ui longe modal">
  <i class="close icon"></i>
  <div class="header">
     HOA Login
  </div>
  <div class="content">

   <div class="ui labeled input" style="margin-left:30px;">
      <div class="ui label">
         UserName
      </div>
      <input id="hoa_username" type="text" placeholder="UserName" value="" style="width:250px">
   </div>

   <div class="ui labeled input" style="margin-left:50px">
      <div class="ui label">
         PassWord
      </div>
      <input id="hoa_password" type="text" placeholder="PassWord" value="" style="width:250px">
   </div>

  </div>
  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>
    <div class="ui positive right button" onclick=Hoa_login_page_login()>
      Log In
    </div>
  </div>
</div>



<!--chart page-->
<div id="hoa_page_3"class="ui long modal">
  <i class="close icon"></i>
  <div class="header">
     Chart
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
    
    <?php
 }
// add_action('wp','add_hoa_content');




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

