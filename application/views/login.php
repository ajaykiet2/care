<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Admin portal login | Care of yours</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="<?=base_url("assets/css/all.css");?>" rel="stylesheet">
  <link href="<?=base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet" />
  <link href="<?=base_url("assets/css/now-ui-dashboard.min69ea.css?v=1.1.2");?>" rel="stylesheet" />
  <link href="<?=base_url("assets/demo/demo.css");?>" rel="stylesheet" />
</head>
<body class="sidebar-mini">
  <div class="wrapper wrapper-full-page ">
    <div class="full-page login-page section-image" filter-color="black" data-image="<?=base_url("assets/img/bg14.jpg");?>">
      <div class="content">
        <div class="container">
          <div class="col-md-4 ml-auto mr-auto">
            <form class="form" method="" action="#">
              <div class="card card-login card-plain">
                <div class="card-header ">
                  <div class="logo-container">
                    <img src="../../assets/img/min-logo.png" alt="">
                  </div>
                </div>
                <div class="card-body ">
                  <div class="input-group no-border form-control-lg">
                    <span class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons users_circle-08"></i>
                      </div>
                    </span>
                    <input type="text" class="form-control" placeholder="First Name...">
                  </div>
                  <div class="input-group no-border form-control-lg">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons text_caps-small"></i>
                      </div>
                    </div>
                    <input type="text" placeholder="Last Name..." class="form-control">
                  </div>
                </div>
                <div class="card-footer ">
                  <a href="#pablo" class="btn btn-primary btn-round btn-lg btn-block mb-3">Get Started</a>
                  <div class="pull-left">
                    <h6><a href="#pablo" class="link footer-link">Create Account</a></h6>
                  </div>
                  <div class="pull-right">
                    <h6><a href="#pablo" class="link footer-link">Need Help?</a></h6>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer" >
        <div class="container-fluid">
          <div class="copyright" id="copyright">
            &copy; <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>, Designed by <a href="#">Invision</a>. Coded by <a href="#">Ajay Kumar</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="<?=base_url("assets/js/core/jquery.min.js");?>" ></script>
  <script src="<?=base_url("assets/js/core/popper.min.js");?>" ></script>
  <script src="<?=base_url("assets/js/core/bootstrap.min.js");?>" ></script>
  <script src="<?=base_url("assets/js/plugins/perfect-scrollbar.jquery.min.js");?>" ></script>
  <script src="<?=base_url("assets/js/plugins/moment.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/bootstrap-switch.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/sweetalert2.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/jquery.validate.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/jquery.bootstrap-wizard.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/bootstrap-selectpicker.js");?>" ></script>
  <script src="<?=base_url("assets/js/plugins/bootstrap-datetimepicker.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/jquery.dataTables.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/bootstrap-tagsinput.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/jasny-bootstrap.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/fullcalendar.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/jquery-jvectormap.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/nouislider.min.js");?>" ></script>
  <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <script async defer src="<?=base_url("assets/js/plugins/buttons.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/chartjs.min.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/bootstrap-notify.js");?>"></script>
  <script src="<?=base_url("assets/js/now-ui-dashboard.min69ea.js");?>" type="text/javascript"></script>
  <script src="<?=base_url("assets/demo/demo.js");?>"></script>

  <script>
  $(document).ready(function(){
    $().ready(function(){
      $sidebar = $('.sidebar');
      $sidebar_img_container = $sidebar.find('.sidebar-background');
      $full_page = $('.full-page');
      $sidebar_responsive = $('body > .navbar-collapse');
      sidebar_mini_active = true;
      window_width = $(window).width();
      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
      $('.fixed-plugin a').click(function(event){
        if($(this).hasClass('switch-trigger')){
          if(event.stopPropagation){
            event.stopPropagation();
          }
          else if(window.event){
            window.event.cancelBubble = true;
          }
        }
      });

      $('.fixed-plugin .background-color span').click(function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if($sidebar.length != 0){
          $sidebar.attr('data-color',new_color);
        }

        if($full_page.length != 0){
          $full_page.attr('filter-color',new_color);
        }

        if($sidebar_responsive.length != 0){
          $sidebar_responsive.attr('data-color',new_color);
        }
      });

      $('.fixed-plugin .img-holder').click(function(){
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if( $sidebar_img_container.length !=0 && $('.switch-sidebar-image input:checked').length != 0 ){
          $sidebar_img_container.fadeOut('fast', function(){
            $sidebar_img_container.css('background-image','url("' + new_image + '")');
            $sidebar_img_container.fadeIn('fast');
          });
        }

        if($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0 ) {
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $full_page_background.fadeOut('fast', function(){
            $full_page_background.css('background-image','url("' + new_image_full_page + '")');
            $full_page_background.fadeIn('fast');
          });
        }

        if( $('.switch-sidebar-image input:checked').length == 0 ){
          var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $sidebar_img_container.css('background-image','url("' + new_image + '")');
          $full_page_background.css('background-image','url("' + new_image_full_page + '")');
        }

        if($sidebar_responsive.length != 0){
          $sidebar_responsive.css('background-image','url("' + new_image + '")');
        }
      });

      $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function(){
        $full_page_background = $('.full-page-background');

        $input = $(this);

        if($input.is(':checked')){
          if($sidebar_img_container.length != 0){
            $sidebar_img_container.fadeIn('fast');
            $sidebar.attr('data-image','#');
          }

          if($full_page_background.length != 0){
            $full_page_background.fadeIn('fast');
            $full_page.attr('data-image','#');
          }

          background_image = true;
        } else {
          if($sidebar_img_container.length != 0){
            $sidebar.removeAttr('data-image');
            $sidebar_img_container.fadeOut('fast');
          }

          if($full_page_background.length != 0){
            $full_page.removeAttr('data-image','#');
            $full_page_background.fadeOut('fast');
          }
          background_image = false;
        }
      });
      $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function(){
        var $btn = $(this);
        if(sidebar_mini_active == true){
          $('body').removeClass('sidebar-mini');
          sidebar_mini_active = false;
          nowuiDashboard.showSidebarMessage('Sidebar mini deactivated...');
        }else{
          $('body').addClass('sidebar-mini');
          sidebar_mini_active = true;
          nowuiDashboard.showSidebarMessage('Sidebar mini activated...');
        }
        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function(){
          window.dispatchEvent(new Event('resize'));
        },180);
        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function(){
          clearInterval(simulateWindowResize);
        },1000);
      });
    });
  });
  </script>
  <script>
  $(document).ready(function(){
    demo.checkFullPageBackgroundImage();
  });
</script>
</body>
</html>
