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
          <div class="col-md-4 ml-auto mr-auto">
            <div class="card card-login card-plain text-center">
              <div class="card-header">
                <div class="logo-container">
                  <!-- <img src="<?=base_url("assets/img/logo.png");?>" alt=""> -->
                  <img src="../../assets/img/emilyz.jpg" alt="...">
                </div>

              </div>
              <div class="card-body ">
                <h4 class="card-title">Joe Gardner</h4>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i>
                    </div>
                  </div>
                  <input type="password" placeholder="Enter Password" class="form-control" required>
                </div>
              </div>
              <div class="card-footer ">
                <a href="#pablo" class="btn btn-primary btn-round btn-md">Unlock <i class="now-ui-icons ui-1_lock-circle-open"></i></a>
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
