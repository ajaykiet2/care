class Login{

  static async checkFullPageBackgroundImage(){
      let $page = $('.full-page');
      let image_src = $page.data('image');
      if(image_src !== undefined){
          let image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>';
          $page.append(image_container);
      }
  }

  static async bindEvents(){
    $("#forgotPasswordBtn").click(()=>{
      $("#loginForm").addClass("hide");
      $("#resetPasswordForm").removeClass("hide");
    });
    $("#logMeInBtn").click(()=>{
      $("#resetPasswordForm").addClass("hide");
      $("#loginForm").removeClass("hide");
    });
    $("button#getResetLink").click(()=>{
      $("#resetMessage").removeClass("hide");
      $("#resetMessage span").text("Reset password link has been sent to your registered email id. Please check your email id to reset password");
      setTimeout(()=>{
        $("#resetMessage").addClass("hide");
      },5000);
    });
  }

  static async init(){
    let $self = this;
    $self.checkFullPageBackgroundImage();
    $self.bindEvents();
  }
}
