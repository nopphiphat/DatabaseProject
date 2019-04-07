
var plugin_name = "my-example";
var html_file = "wp-content/plugins/"+plugin_name+"/html/";
var php_file =  "wp-content/plugins/"+plugin_name+"/";
var user_ID = -1;

function Hoa_phone_button(){
  $('#hoa_page_1').modal('show');
}

//get the items
function hoa_get_items(user_id){
  //Get data from php file
  var items="";

  $.ajax({
    url:php_file+"getrequest.php",
    method:"POST",
    data:{"user_id":user_id}
  }).done(function( msg ) {
    console.log(msg);
  });


}

function Hoa_email_button(user_id){


  var item = '<div class="title">\
  <div class="ui list">\
    <div class="item">\
      <i class="dropdown icon"></i>\
      Clean House\
      <div id="the_star" class="ui star rating" data-rating="0" style="float:right"></div>\
    </div>\
    <div class="item">\
      <div><i class="hire a helper icon"></i>Jack Ma</div>\
    </div>\
  </div>\
  </div>\
<div class="content">\
  <p class="transition hidden">I need to clean my house.</p>\
</div>';
  
  user_ID = user_id;
  console.log(user_id);
  console.log(user_ID);
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
    <form id="email_form" class="ui form">\
    <h4 class="ui dividing header">Hoa Contact</h4>\
    <div class="field">\
        <label>Title</label>\
        <input id="hoa_c_title" type="text" name="hoa-from-title" placeholder="Title">\
    </div>\
        <div class="field">\
          <label>Content</label>\
          <textarea id="hoa_c_description" type="text" placeholder="Tell us more..."></textarea>\
        </div>\
    <div id="hoa_send_email" class="ui button" tabindex="0" onclick=HOA_Send_Mail()>Send</div>\
  </form>\
    </div>\
    <div class="ui bottom attached tab segment" data-tab="User_Request">\
    \
    \
    <div id="request_items" class="ui styled accordion" style="width:100%">\
    '+ item +'\
    '+ item +'\
    </div>\
    \
    \
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
  $('#hoa_email_form').modal('show');
  $('.menu .item').tab();
  $('#request_items')
  .accordion({
    selector: {
      trigger: '.title'
    }
  })
;
$('#the_star')
  .rating({
    initialRating: 0,
    maxRating: 5
  })
;
  
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
  hoa_c_title:"",
  hoa_c_description:"",
  hoa_c_method:"form",
  hoa_c_user_id:-1,
  
  hoa_c_status:"submitted",
  hoa_c_record_time:0,
  
}

//send email button event
function HOA_Send_Mail(){
  var d = new Date();
  hoa_form.hoa_c_title=$('#hoa_c_title').val();
  hoa_form.hoa_c_description=$('#hoa_c_description').val();
  hoa_form.hoa_c_address=$('#hoa_c_address').val()+" "+$('#hoa_c_apt').val();
  hoa_form.hoa_c_user_id=user_ID;
  hoa_form.hoa_c_record_time=d.getTime();

  alert("Email has been sent.");
  console.log(hoa_form);
/*
  axios.post(php_file+"hoa_varible.php",{
    params:{
      "hoa_request_form":hoa_form
    }
  }).then(function(response){
    console.log(response);
  });
  */
  
  $.ajax({
    url:php_file+"hoa_varible.php",
    method:"POST",
    data:{"hoa_request_form":hoa_form}
  }).done(function( msg ) {
    console.log(msg);
  });
}