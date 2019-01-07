class Login{

  static async sendRequest(url,data){
    return await $.ajax({
      url:url,
      data:data,
      type:"post",
      dataType: "json",
      success : (response) => {
        return response;
      },
      error: ()=>{
        return {status: false, message: "Unable to connect with server!"};
      }
    });
  }

  static async sendResetRequest(data){
    let $self = this;
    let url = "/admin/ajax/resetPassword";
    let response = await $self.sendRequest(url, data);
    if(response.status){
      swal({
        title: 'Congratulations!',
        text: response.message,
        type: 'success',
        showCancelButton: false,
        confirmButtonClass: 'btn btn-success',
        confirmButtonText: 'Go to login',
        buttonsStyling: false
    }).then(function() {
      window.location.href = "http://www.care.local/";
    }).catch(swal.noop);
    }else{
      $("#error_message").text(response.message).removeClass("hide");
    }
  }

  static async checkFullPageBackgroundImage(){
      let $page = $('.full-page');
      let image_src = $page.data('image');
      if(image_src !== undefined){
          let image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>';
          $page.append(image_container);
      }
  }

  static async bindEvents(){
    let $self = this;
    $(document).on("focusin","#new_password,#repeat_password",()=>{
      $("#error_message").text("").addClass("hide");
    });
    $("#resetPasswordButton").click(async (e)=>{
      let resetButton = $(e.target);
      let token = $("#token").val();
      let password = $("#new_password").val();
      let re_password = $("#repeat_password").val();
      if(!password.length || !re_password.length){
        $("#error_message").text("You can't leave blank any field!").removeClass("hide");
        return;
      }
      if(password !== re_password){
        $("#error_message").text("Repeat Password does not matched!").removeClass("hide");
        return;
      } 
      resetButton.addClass("disabled");
      await $self.sendResetRequest({token,password,re_password});
      resetButton.removeClass("disabled");
    });

    $("#forgotPasswordBtn").click(()=>{
      $("#loginForm").addClass("hide");
      $("#resetPasswordForm").removeClass("hide");
    });
    $("#logMeInBtn").click(()=>{
      $("#resetPasswordForm").addClass("hide");
      $("#loginForm").removeClass("hide");
    });
    $("button#getResetLink").click(async (e)=>{
      let $element = $(e.target);
      var email = $("input#resetInput").val();
      if(!email.length){
        $("#resetMessage").removeClass("hide");
        $("#resetMessage span").addClass("text-danger").text("Please enter the email id");
        setTimeout(()=>{$("#resetMessage").addClass("hide")},5000);
        return false;
      }
      $element.text("PLEASE WAIT");
      $element.addClass("disabled");
      var response = await $self.sendRequest("/admin/ajax/forgotPassword",{email});
      if(response.status){
        $element.text("Resend");
        $element.removeClass("disabled");
        $("#resetMessage").removeClass("hide");
        $("#resetMessage span").removeClass("text-danger").text(response.message);
        setTimeout(()=>{$("#resetMessage").addClass("hide")},5000);
      }else{
        $element.text("GET RESET LINK");
        $element.removeClass("disabled");
        $("#resetMessage").removeClass("hide");
        $("#resetMessage span").addClass("text-danger").text(response.message);
        setTimeout(()=>{$("#resetMessage").addClass("hide")},10000);
      }
    });
  }

  static async init(){
    let $self = this;
    $self.checkFullPageBackgroundImage();
    $self.bindEvents();
  }
}
