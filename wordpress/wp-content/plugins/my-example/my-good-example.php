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

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/popup.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script type="text/javascript" src=<?php echo plugins_url('js/hoafunctions.js',__FILE__) ?>></script>
          <style>
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
      </style>
     
    <?php
 }

 add_action('wp_footer','add_semantic_ui');


 function add_hoa_content(){
    ?>
    
    
    <!--Test-->
    <div class="ui middle aligned animated list" style="position:fixed;z-index:1000;top:40%;">
      <div class="item">
         <button class="ui active button" id="hoa_phone" style="width:130px"><i class="big phone icon"></i>Call </button>
      </div>

      <div class="item">
         <button class="ui active button" style="width:130px"><i class="big envelope icon"></i> Mail </button>
      </div>


      <div class="item">
         <button class="ui active button" style="width:130px"><i class="big chart area icon"></i> Chart </button>
      </div>
</div>


<div id="hoa_page_1"class="ui modal">
  <i class="close icon"></i>
  <div class="header">
     HOA Login
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>
    <div class="ui positive right button">
      Log In
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

