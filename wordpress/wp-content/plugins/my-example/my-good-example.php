<?php
/**
 * plugin Name: My-GOOD-EXAMPLE
 * Description: This is just an example plugin
 */

add_action('wp_enqueue_scripts', 'hoa_setting_up_scripts');
function hoa_setting_up_scripts() {
    //wp_register_style( 'hoa_css', plugins_url('css/hoa_style.css',__FILE__) );
    //wp_enqueue_style( 'hoa_css' );

}
 //add semantic ui to wb_header


 function add_semantic_ui(){
    ?>
    <!--plugin css-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.min.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.css"/>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.css"/>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script src="http://cdn.bootcss.com/blueimp-md5/1.1.0/js/md5.js"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
         <button class="ui active button" style="width:130px" onclick=Hoa_mail_button()><i class="big envelope icon"></i> Mail </button>
      </div>


      <div class="item">
         <button class="ui active button" style="width:130px" onclick=Hoa_chart_button()><i class="big chart area icon"></i> Chart </button>
      </div>
     </div>
   </div>
   
<!--the place will be inserted html-->   
<div id="hoa_insert">
   
</div>

<!--call page-->
<div id="hoa_page_1"class="ui modal">
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


<!--login page-->
<div id="hoa_page_2"class="ui modal">
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
<div id="hoa_page_3"class="ui modal">
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
 add_action('wp','add_hoa_content');




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

