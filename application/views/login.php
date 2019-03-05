<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link async rel="apple-touch-icon" sizes="76x76" href="<?=base_url("assets/img/min-logo.png");?>">
  <link async  rel="icon" type="image/png" href="<?=base_url("assets/img/min-logo.png");?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Admin portal login | We care of yours</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link async  href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link async  href="<?=base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet" />
  <link async  href="<?=base_url("assets/css/care.css");?>" rel="stylesheet" />
  <link async  href="<?=base_url("assets/css/now-ui-dashboard.min69ea.css?v=1.1.2");?>" rel="stylesheet" />
  <script src="<?=base_url("assets/js/modules/router.js")?>"></script>
</head>
<body class="sidebar-mini">
  <div class="wrapper wrapper-full-page ">
    <div class="full-page login-page section-image" filter-color="black" data-image="<?=base_url("assets/img/banner.jpg");?>">
      <div class="content">
        <div class="container">
          <div class="col-md-4 ml-auto mr-auto">
            <form id="loginForm" class="form" method="post" action="/login">
              <div class="card card-user card-plain">
                <div class="image">
                  <img src="<?=base_url("assets/img/bg7.jpg");?>" alt="...">
                </div>
                <div class="card-body">
                  <div class="author">
                    <a href="#">
                      <img class="avatar border-gray" src="<?=base_url("assets/img/avatar.png");?>" alt="...">
                    </a>
                    <div class="input-group ">
                      <span class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="now-ui-icons users_circle-08"></i>
                        </div>
                      </span>
                      <input type="text" class="form-control" name="username" placeholder="username" required>
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="now-ui-icons objects_key-25"></i>
                        </div>
                      </div>
                      <input type="password" name="password" placeholder="password" class="form-control" required>
                    </div>
                    <?php if(isset($response)):?>
                    <h6 class="text-center"><span class="link footer-link text-danger"><?=$response->message;?></span></h6>
                    <?php endif;?>
                  </div>
                  <div class="card-footer text-center">
                    <button type="submit" name="logMeIn" class="btn btn-primary btn-round btn-md">LOG ME IN <span class="now-ui-icons ui-1_lock-circle-open"></span></button>
                    <div class="text-center">
                      <br>
                      <h6><span id="forgotPasswordBtn" class="link footer-link">Forgot Password ?</span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div id="resetPasswordForm" class="hide">
              <div class="card card-user card-plain">
                <div class="image">
                  <img src="<?=base_url("assets/img/bg2.jpg");?>" alt="...">
                </div>
                <div class="card-body">
                  <div class="author">
                    <a href="#">
                      <img class="avatar border-gray" src="<?=base_url("assets/img/avatar.png");?>" alt="...">
                    </a>
                    <div class="input-group">
                      <span class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="now-ui-icons ui-1_email-85"></i>
                        </div>
                      </span>
                      <input type="text" id="resetInput" class="form-control" placeholder="email id" required>
                    </div>
                    <h6 id="resetMessage" class="text-center hide"><span class="link footer-link"></span></h6>
                  </div>
                  <div class="card-footer text-center">
                    <button id="getResetLink" class="btn btn-primary btn-round btn-md">GET RESET LINK <span class="now-ui-icons arrows-1_minimal-right"></span></button>
                    <div class="text-center">
                      <br>
                      <h6><span id="logMeInBtn" class="link footer-link">Back To Login</span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  <script src="<?=base_url("assets/js/modules/Login.js");?>"></script>
  <script>
  $(document).ready(function(){Login.init()});
  </script>
</body>
</html>
