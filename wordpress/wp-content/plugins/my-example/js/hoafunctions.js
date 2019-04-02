
var plugin_name = "my-example";
var html_file = "wp-content/plugins/"+plugin_name+"/html/";
var php_file = "wp-content/plugins/"+plugin_name+"/";

function Hoa_phone_button(){
  $('#hoa_page_1').modal('show');
}


function Hoa_email_button(){

  var html_str = '\
  <div id="hoa_email_form" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Request Form\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="Request">Request</a>\
      <a class="item" data-tab="User_Request">Your Requests</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Request">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="User_Request">\
      Second\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  $('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#hoa_email_form').modal('show');
  $('.menu .item').tab();
 
  
}


function Hoa_chart_button(){

  var html_str = '\
  <div id="hoa_report_form" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Report\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="Report_1">Your Report_1</a>\
      <a class="item" data-tab="Report_2">Your Report_2</a>\
      <a class="item" data-tab="Report_3">Your Report_3</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Report_1">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_2">\
      Second\
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_3">\
      Third\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  
  //$('#tab_one_form').load(html_file+'hoa_email_form.html');
  
  $('#hoa_report_form').modal('show');
  $('.menu .item').tab();

}


//Board Member
function Hoa_board_email_button(){

  var html_str = '\
  <div id="hoa_email_form" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Request Form\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="Request">Request</a>\
      <a class="item" data-tab="User_Request">Your Requests</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Request">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="User_Request">\
      Second\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  $('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#hoa_email_form').modal('show');
  $('.menu .item').tab();
 
  
}

function Hoa_board_chart_button(){
  var html_str = '\
  <div id="hoa_report_form" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Report\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="Report_1">Your Report_1</a>\
      <a class="item" data-tab="Report_2">Your Report_2</a>\
      <a class="item" data-tab="Report_3">Your Report_3</a>\
      <a class="item" data-tab="Report_4">Community Report</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Report_1">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_2">\
      Second\
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_3">\
      Third\
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_4">\
      Third\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  
  //$('#tab_one_form').load(html_file+'hoa_email_form.html');
  
  $('#hoa_report_form').modal('show');
  $('.menu .item').tab();

}





//property_employee

function Hoa_add_request_button(){
  $('#hoa_add_request_page').modal('show');
}

function Hoa_property_employee_box_button(){
  var html_str = '\
  <div id="employee_box" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Request Form\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="Request_Box">Request Box</a>\
      <a class="item" data-tab="User_Request">Your Requests</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Request_Box">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="User_Request">\
      Second\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  //$('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#employee_box').modal('show');
  $('.menu .item').tab();
}

function Hoa_property_employee_chart_button_(){
  var html_str = '\
  <div id="employee_box" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        Report\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="Report_1">Report_1</a>\
      <a class="item" data-tab="Report_2">Report_2</a>\
      <a class="item" data-tab="Report_3">Report_3</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Report_1">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_2">\
      Second\
    </div>\
    <div class="ui bottom attached tab segment" data-tab="Report_3">\
      Third\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  //$('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#employee_box').modal('show');
  $('.menu .item').tab();
}


//supervisor

function Hoa_assign_work_button(){
  var html_str = '\
  <div id="assign_work_page" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        Manage Panel\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="assign_work">Assign Work</a>\
      <a class="item" data-tab="work_status">Work Status</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="assign_work">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="work_status">\
      Second\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  //$('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#assign_work_page').modal('show');
  $('.menu .item').tab();
}

function Hoa_property_supervisor_chart_button(){
  var html_str = '\
  <div id="supervisor_report" class="ui longe modal">\
    <i class="close icon"></i>\
      <div class="header">\
        Manage Panel\
      </div>\
    <div class="content">\
      <div class="ui top attached tabular menu">\
      <a class="item active"" data-tab="report_1">Report_1</a>\
      <a class="item" data-tab="report_2">Report_2</a>\
    </div>\
    <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="report_1">\
      <!--Form-->\
      \
    </div>\
    <div class="ui bottom attached tab segment" data-tab="report_2">\
      Second\
    </div>\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert_place");
  insertDiv.innerHTML = html_str;
  //$('#tab_one_form').load(html_file+'hoa_email_form.html');
  $('#supervisor_report').modal('show');
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