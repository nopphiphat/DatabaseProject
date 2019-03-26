
var constants = {
  website:"https://localhost:8443/",
  mainsite:"",
  login_status:false,
  username:'',
  password:'',
  email_form:false,
};


function Hoa_phone_button(){
  $('#hoa_page_1')
  .modal('show');
  console.log("work1!");
}


function Hoa_mail_button(){
  if(constants.login_status){
    user_login_email();
  }
  else{
    $('#hoa_page_2')
    .modal('show');
  }
}

function Hoa_chart_button(){
  if(constants.login_status){
    user_login_email();
  }else{
    $('#hoa_page_2')
    .modal('show');
  }
}

function Hoa_login_page_login(){
  $('hoa_page_1')
  .modal('show');
  constants.username = $('#hoa_username').val();
  constants.password = md5($('#hoa_password').val());
  console.log(constants.password);

  //send username and password to back-end
  axios.get(constants.website+'hoa_login',{
    params:{
      username:constants.username,
      password:constants.password,
    }
  }
  )//.then(function(response){
    //constants.login_status = response.data.login_status;
  //})

  if(constants.login_status){
      user_login_email();
  }else{
    login_faile();
  }

}

function user_login_email(){
  if(constants.email_form){
    $('#hoa_email_form')
    .modal('show');
    $('.menu .item')
    .tab();
  }
  else{
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
  
  $(function(){
    $.ajax({
      type:"POST",
      url:"wp-content/plugins/my-example/js/hoa_email_form.html",
      cache:false,
      success:function(html){
        var email_formDiv =document.getElementById("tab_one_form");
        email_formDiv.innerHTML = html;
      }
    });
  });

  $('#hoa_email_form')
  .modal('show');
  $('.menu .item')
  .tab();
  constants.email_form = true;
  }
  
}

function login_faile(){
  var html_str = '\
  <div id="hoa_page_failed"class="ui mini modal">\
    <i class="close icon"></i>\
      <div class="header">\
        HOA Login\
      </div>\
    <div class="content">\
      Sorry, you login failed.\
    </div>\
    <div class="actions">\
      <div class="ui positive right button">\
        Confirm\
      </div>\
    </div>\
  </div>';
  var insertDiv = document.getElementById("hoa_insert");
  insertDiv.innerHTML = html_str;
  $('#hoa_page_failed')
  .modal('show');

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

  alert("Email has been sent.");
  console.log(hoa_form);
  axios.post(constants.website+'hoa_c_send_email',hoa_form);
}