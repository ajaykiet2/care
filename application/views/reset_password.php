<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url("assets/img/min-logo.png");?>">
  <link rel="icon" type="image/png" href="<?=base_url("assets/img/min-logo.png");?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Admin portal login | We care of yours</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="<?=base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet" />
  <link href="<?=base_url("assets/css/care.css");?>" rel="stylesheet" />
  <link href="<?=base_url("assets/css/now-ui-dashboard.min69ea.css?v=1.1.2");?>" rel="stylesheet" />
  <?php $imgNum = mt_rand(1, 7);?>
</head>
<body class="sidebar-mini">
  <div class="wrapper wrapper-full-page ">
    <div class="full-page login-page section-image" filter-color="black" data-image="<?=base_url("assets/img/bg{$imgNum}.jpg");?>">
      <div class="content">
        <div class="container">
        <?php if($data->status):?>
          <input type="hidden" id="token" value="<?=$data->resetTokens;?>"> 
          <div class="col-md-4 ml-auto mr-auto">
              <div class="card card-login card-plain">
                <div class="card-header ">
                  <div class="logo-container">
                    <img src="<?=base_url("assets/img/logo.png");?>" alt="">
                  </div>
                </div>
                <div class="card-body">
                  <div class="input-group ">
                    <span class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons objects_key-25"></i>
                      </div>
                    </span>
                    <input type="password" id="new_password" class="form-control" name="password" placeholder="new password" required>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons arrows-1_refresh-69"></i>
                      </div>
                    </div>
                    <input type="password" id="repeat_password" name="re_password" placeholder="repeat-password" class="form-control" required>
                  </div>
                  <h6 class="text-center link footer-link text-danger hide" id="error_message">You can reset your password here</h6>
                </div>
                <div class="card-footer text-center">
                  <button id="resetPasswordButton"  class="btn btn-primary btn-round btn-md">RESET PASSWORD <span class="now-ui-icons arrows-1_minimal-right"></span></button>
                </div>
              </div>
          </div>
          <?php else:?>
          <div class="not-found">
            <div class="card card-wizard active">
              <div class="card-header" data-background-color="orange">
                <h1 class="card-title code">WHOOPS! <span class="pull-right">[302]</span></h1>
                <div class="clearfix"></div>
                <p class="message">It may have broken something..</p>
              </div>
              <div class="card-body">
                <h5 class="info text-center text-uppercase text-danger"><?=$data->message;?>.</h5>
              </div>
              <div class="card-footer text-center">
                <h5 class="info-text">Please try again to reset your password or contact to Super Administrator</h5>
                <a href="<?=base_url();?>" class="btn btn-primary btn-round btn-md">Home Page</a>
              </div>
            </div>
          </div>
          <?php endif;?>
        </div>
      </div>
      <footer class="footer" >
        <div class="container-fluid">
          <div class="copyright" id="copyright">
            &copy; <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>, Designed and developed by <a href="#">Ajay Kumar</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <?php $this->load->view("common/scripts");?>
  <script src="<?=base_url("assets/js/core/core.js");?>"></script>
  <script src="<?=base_url("assets/js/plugins/sweetalert2.min.js");?>"></script>
  <script src="<?=base_url("assets/js/modules/Login.js");?>"></script>
  <script>
  $(document).ready(function(){Login.init()});
  </script>
</body>
</html>
