
var plugin_name = "my-example";
var html_file = "wp-content/plugins/"+plugin_name+"/html/";
var php_file = "wp-content/plugins/"+plugin_name+"/";

function Hoa_phone_button(){
$('#hoa_insert').load(html_file+'hoa_phone.html');
$('#hoa_page_1')
.modal('show');
console.log("work1!");
}


function Hoa_mail_button(){
    user_login_email();
}

function Hoa_chart_button(){
  if(constants.login_status){
    user_login_email();
  }else{
    $('#hoa_page_2')
    .modal('show');
  }
}

function user_login_email(){

  var html_str = '\
  <div id="hoa_email_form" class="ui longer modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Request Form\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item" data-tab="Request">Request</a>\
      <a class="item" data-tab="Report_1">Report_1</a>\
      <a class="item active" data-tab="Report_2">Report_2</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment" data-tab="Request">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_1">\
      Second\
    </div>\
    <div class="ui bottom attached tab segment active" data-tab="Report_2">\
      Third\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert");
  insertDiv.innerHTML = html_str;
  $('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#hoa_email_form').modal('show');
  $('.menu .item').tab();
 
  
}

//MD5js
//hex_md5("")

//
var hoa_form = {
  hoa_c_first_name:"",
  hoa_c_last_name:"",
  hoa_c_phone:0,
  hoa_c_email:"",
  hoa_c_address:"",
  hoa_c_state:"",
  hoa_c_country:"",
  hoa_c_community:"",
  hoa_c_email_content:"",
}

//send email button event
function HOA_Send_Mail(){
  hoa_form.hoa_c_first_name=$('#hoa_c_first_name').val();
  hoa_form.hoa_c_last_name=$('#hoa_c_last_name').val();
  hoa_form.hoa_c_phone=$('#hoa_c_phone_number').val();
  hoa_form.hoa_c_email=$('#hoa_c_email').val();
  hoa_form.hoa_c_address=$('#hoa_c_address').val()+" "+$('#hoa_c_apt').val();
  hoa_form.hoa_c_state=$('#hoa_c_state').val();
  hoa_form.hoa_c_country=$('#hoa_c_country').val();
  hoa_form.hoa_c_community=$('#hoa_c_community').val();
  hoa_form.hoa_c_email_content=$('#hoa_c_email_content').val();
  var hoa_test=$('#hoa_c_first_name').val();

  alert("Email has been sent.");
  console.log(hoa_form);
  $.ajax({
    url:php_file+"hoa_varible.php",
    method:"POST",
    data:{"hoa_request_form":hoa_form}
  }).done(function( msg ) {
    console.log(msg);
  });
}