<?php $this->load->view("common/head");?>
<body class="sidebar-mini">
    <div class="wrapper ">
      <div class="sidebar" data-color="gray">
      <div class="logo">
        <a href="<?=base_url();?>" class="simple-text logo-mini hide-lg">
          <img src="<?=base_url("assets/img/min-logo.png");?>" class="img img-responsive" style="margin-left:2px;height:32px;padding:2px;">
        </a>
        <a href="<?=base_url();?>" class="simple-text logo-normal">
          <img src="<?=base_url("assets/img/lg-logo.png");?>" class="img img-responsive" style="height:32px;padding:2px;">
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?=base_url("assets/img/james.jpg")?>" />
          </div>
          <div class="info">
            <a href="javascript:return false;"><span>Ajay Kumar</span></a>
            <div class="clearfix"></div>
          </div>
        </div>
        <?=createMenus($this->environment->getMenus());?>
      </div>
    </div>
