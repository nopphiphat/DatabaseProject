
var plugin_name = "my-example";
var html_file = "wp-content/plugins/"+plugin_name+"/html/";
var php_file =  "wp-content/plugins/"+plugin_name+"/";
var user_ID = -1;



/** 
 * This part is for homeowner.
 * 
*/

/**
 * Buttone_1
 * 
 */
function Hoa_phone_button(){
  $('#hoa_page_1').modal('show');
}




/**
 * Buttone_2
 * 
 */

function Hoa_email_button(user_id){


console.log(items);
  
  user_ID = user_id;
  //console.log(user_id);
  //console.log(user_ID);
  var items = hoa_get_items(user_id);
  
  if($("#hoa_email_form").length){
    var insertDiv = document.getElementById("request_items");
    insertDiv.innerHTML = items;
  }else{
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
    '+ items +'\
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
  }
  $('#hoa_email_form').modal('show');
  $('.menu .item').tab();
  $('#request_items')
  .accordion({
    selector: {
      trigger: '.title'
    }
  });
$('.ui.rating')
  .rating({
    initialRating: 0,
    maxRating: 5
  })
;
  
}

//sub functionality
function send_comment_from_request(request_item_id){
  var submit_comment = {
    "request_id":request_item_id,
    "rate":0,
    "comment":"",
  }
  console.log(submit_comment);
  submit_comment["rate"] = $('#'+request_item_id+'the_star' ).rating("get rating");
  submit_comment["comment"] = $("#"+request_item_id+"request_comment").val();
  
  $.ajax({
    url:php_file+"save_comment_rating.php",
    method:"POST",
    data:{"hoa_comment_rating":submit_comment}
  }).done(function( msg ) {
    console.log(msg);
  });
  alert("Comment is sent successfully.")

}

function hoa_request_item(item_data){
  console.log(item_data["Request_Title"]);
  var $star;
  var $star_block="";
  if(item_data["Request_Rating"]==null){
    $star = 0;
  }else{
    $star = item_data["Request_Rating"];
    $star_block ='<div class="ui star rating" data-rating="'+$star+'" style="float:right"></div>'
  }
  var item = '<div id="'+item_data["Request_ID"]+'_request" class="title">\
  <div class="ui list">\
    <div class="item">\
      <i class="dropdown icon"></i>\
      '+item_data["Request_Title"]+'\
      '+$star_block+'\
    </div>\
  </div>\
  </div>\
<div class="content">\
  <p class="transition hidden">'+item_data["Request_Description"]+'</p>\
  <table class="ui table">\
  <tbody>\
    <tr>\
      <td class="active">Employee ID</td>\
      <td>'+item_data["Record_Employ_ID"]+'</td>\
      <td class="active">Handler ID</td>\
      <td>'+item_data["Request_Handler_ID"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Record Time</td>\
      <td>'+item_data["Record_Time"]+'</td>\
      <td class="active">Rating Time</td>\
      <td>'+item_data["Rating_time"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Status</td>\
      <td>'+item_data["Request_Status"]+'</td>\
      <td class="active">Status Time</td>\
      <td>'+item_data["Status_Time"]+'</td>\
    </tr>\
  </tbody></table>\
  <textarea id="'+item_data["Request_ID"]+'request_comment" type="text" placeholder="Comment"></textarea>\
  <button class="ui button" style="margin:10px" onclick=send_comment_from_request('+item_data["Request_ID"]+')>\
    Comment\
  </button>\
  <div id="'+item_data["Request_ID"]+'the_star" class="ui right star rating" data-rating="0" style="float:right"></div>\
</div>';

console.log(item);

  return item;

}

//get the items
function hoa_get_items(user_id){
  
  //Get data from php file
  var datas =null;
  var items ="";

  $.ajax({
    url:php_file+"getrequest.php",
    method:"POST",
    data:{"user_id":user_id},
    async:false,
    success:function(msg){
      datas = eval(JSON.parse(msg));
      //items=items+hoa_request_item(datas[0]);
    }
  });
  console.log(datas);
  for(var i=0;i<datas.length;i++){
    items=items+hoa_request_item(datas[i]);
  }
  return items;
  

}


/**
 * 
 * Button_3
 */

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













/**
 * This part is for Board Member, only difference is board member can check all report.
 */

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












/**
 * 
 * This part is for employee, employee need to create action and set those action to member, they can check the request they get and add work.
 */
//property_employee



/**
 * 
 * Employee Button_1
 */


function Hoa_add_request_button(user_id){
  /**
   * A modal, each item can submit a form to add action.
   */
  console.log(user_id);
  user_ID = user_id;
  var items = hoa_get_all_items();
  if($("#hoa_add_request_page").length){
    var insertDiv = document.getElementById("hoa_add_request_page");
    insertDiv.innerHTML = items;
  }else{
  
  var html_str = '\
  <div id="hoa_add_request_page" class="ui longe modal">\
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
    '+ items +'\
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
  }
  $('#hoa_add_request_page').modal('show');
  $('.menu .item').tab();
  $('#request_items')
  .accordion({
    selector: {
      trigger: '.title'
    }
  })
;

}


function hoa_save_action(item_id){
  var actions = {
    "Request_ID":item_id,
    "Assignee":"",
    "Action_Description":"",
    "Action_Status":1,
    "Action_Due":""
  }
  var datas=null;

  actions["Assignee"]=$('#'+item_id+'_employee').val();
  actions["Action_Description"]=$('#'+item_id+'_description').val();
  actions["Action_Due"]=$('#'+item_id+'_due').val();

  console.log(actions);

  $.ajax({
    url:php_file+"saveaction.php",
    method:"POST",
    data:{"action_form":actions},
    async:false,
    success:function(msg){
      console.log(msg);
    }
  });

  alert("creating action successfully.");

}


function hoa_set_items(item_data){
  console.log(item_data["Request_Title"]);
  var $star;
  var $star_block="";
  var confirm_button="";
  if(item_data["Request_Status"]==2){
    confirm_button='<button class="ui positive right button" onclick=complete_request("'+item_data["Request_ID"]+'")>Complete</button>'
  }

  if(item_data["Request_Rating"]==null){
    $star = 0;
  }else{
    $star = item_data["Request_Rating"];
    $star_block ='<div class="ui star rating" data-rating="'+$star+'" style="float:right"></div>'
  }
  var item = '<div id="'+item_data["Request_ID"]+'_request" class="title">\
  <div class="ui list">\
    <div class="item">\
      <i class="dropdown icon"></i>\
      '+item_data["Request_Title"]+'\
      '+$star_block+'\
    </div>\
  </div>\
  </div>\
<div class="content">\
  <p class="transition hidden">'+item_data["Request_Description"]+'</p>\
  <table class="ui table">\
  <tbody>\
    <tr>\
      <td class="active">Employee ID</td>\
      <td>'+item_data["Record_Employ_ID"]+'</td>\
      <td class="active">Handler ID</td>\
      <td>'+item_data["Request_Handler_ID"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Record Time</td>\
      <td>'+item_data["Record_Time"]+'</td>\
      <td class="active">Rating Time</td>\
      <td>'+item_data["Rating_time"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Status</td>\
      <td>'+item_data["Request_Status"]+'</td>\
      <td class="active">Status Time</td>\
      <td>'+item_data["Status_Time"]+'</td>\
    </tr>\
  </tbody></table>\
  <div class="two fileds">\
  <label>Employee ID</label>\
  <input id="'+item_data["Request_ID"]+'_employee" type="text" placeholder="Enter the Employee ID"/>\
  </div>\
  <label>Due Date</label>\
  <input id="'+item_data["Request_ID"]+'_due" type="datetime-local"/>\
  <div class="filed">\
  <label>Action Description</label>\
  <textarea id="'+item_data["Request_ID"]+'_description" placeholder="Action Description"></textarea>\
  </div>\
  <button class="ui button" style="margin:10px" onclick=hoa_save_action('+item_data["Request_ID"]+')>\
    Create Action\
  </button>\
  '+ confirm_button +'\
</div>';

console.log(item);

  return item;

}

function hoa_get_all_items(){
  //Get all actions that just be submited
  //Get data from php file
  var datas =null;
  var items ="";

  $.ajax({
    url:php_file+"getsubmittedrequest.php",
    method:"POST",
    async:false,
    success:function(msg){
      datas = eval(JSON.parse(msg));
      console.log(datas);
      //items=items+hoa_request_item(datas[0]);
    }
  });
  console.log(datas);
  if(datas!=null){
    for(var i=0;i<datas.length;i++){
      items=items+hoa_set_items(datas[i]);
    }
  }
  return items;
  
}



/**
 * Employee button 2 
 */




//!
//Employee check what action they have and create work

function Hoa_property_employee_box_button(user_id){
  //Employee for checking the actions and create work

  user_ID = user_id;
  var action_items = hoa_check_actions(user_ID);
  if($("#employee_box").length){
    var insertDiv = document.getElementById("tab_one_form");
    insertDiv.innerHTML = action_items;
  }else{
  
    var html_str = '\
    <div id="employee_box" class="ui longe modal">\
      <i class="close icon"></i>\
        <div class="header">\
          HOA Request Form\
        </div>\
      <div class="content">\
        <div class="ui top attached tabular menu">\
        <a class="item active"" data-tab="Actions">Your Actions</a>\
        <a class="item" data-tab="Works">Your Works</a>\
      </div>\
      <div id="tab_one_form" class="ui bottom attached tab segment active" data-tab="Actions">\
      <div id="action_items" class="ui styled accordion" style="width:100%">\
        '+action_items+'\
        </div>\
      </div>\
      <div class="ui bottom attached tab segment" data-tab="Works">\
        //Works\
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
  }


  $('#employee_box').modal('show');
  $('.menu .item').tab();
  $('#action_items')
  .accordion({
    selector: {
      trigger: '.title'
    }
  });
}


//get the action, and employee can alter the status,and submitte work.
function hoa_check_actions(user_id){
  console.log(user_id);
  var datas = null;
  var items = "";

  $.ajax({
    url:php_file+"getaction.php",
    method:"POST",
    data:{"user_id":user_id},
    async:false,
    success:function(msg){
      console.log(msg);
      datas = eval(JSON.parse(msg));
    }
  });

  for(var i=0;i<datas.length;i++){
    items=items+hoa_action_item(datas[i]);
  }
  console.log("test get data");
  console.log(items);
  return items;
}

//get the DBdata and create items
function hoa_action_item(item_data){
  
  var item = '<div id="'+item_data["Action_ID"]+'_action" class="title">\
  <div class="ui list">\
    <div class="item">\
      <i class="dropdown icon"></i>\
      '+item_data["Request_Title"]+'\
    </div>\
    <div class="ui right item">\
      '+ item_data["Status_Time"] +'\
    </div>\
  </div>\
  </div>\
<div class="content">\
  <table class="ui table">\
  <label>Request Description</label>\
  <p class="transition hidden">'+item_data["Request_Description"]+'</p>\
  <tbody>\
    <tr>\
      <td class="active">Employee ID</td>\
      <td>'+item_data["Record_Employ_ID"]+'</td>\
      <td class="active">Handler ID</td>\
      <td>'+item_data["Request_Handler_ID"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Record Time</td>\
      <td>'+item_data["Record_Time"]+'</td>\
      <td class="active">Rating Time</td>\
      <td>'+item_data["Rating_time"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Status</td>\
      <td>'+item_data["Request_Status"]+'</td>\
      <td class="active">Status Time</td>\
      <td>'+item_data["Status_Time"]+'</td>\
    </tr>\
  </tbody></table>\
  <table class="ui table">\
  <label>Action Description</label>\
  <p class="transition hidden">'+item_data["Action_Description"]+'</p>\
  <tbody>\
    <tr>\
      <td class="active">Start Time</td>\
      <td>'+item_data["Start_Time"]+'</td>\
      <td class="active">Due Time</td>\
      <td>'+item_data["Due_Time"]+'</td>\
    </tr>\
    <tr>\
      <td class="active">Action Status</td>\
      <td>'+item_data["Action_Status"]+'</td>\
      <td class="active">Status Time</td>\
      <td>'+item_data["Status_Time"]+'</td>\
    </tr>\
  </tbody></table>\
  <textarea id="'+item_data["Request_ID"]+'work" type="text" placeholder="Work"></textarea>\
  <button class="ui button" style="margin:10px" onclick=send_work('+item_data["Request_ID"]+')>\
    Create Work\
  </button>\
  <button class="ui positive right button" onclick=complete_request("'+item_data["Request_ID"]+'")>Finish</button>\
  <div id="'+item_data["Request_ID"]+'the_star" class="ui right star rating" data-rating="0" style="float:right"></div>\
</div>';

  return item;
}

function send_work(request_id){

}






/**
 * 
 * Employee Button 3
 */




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




/**
 * 
 * Supervisor 
 */
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