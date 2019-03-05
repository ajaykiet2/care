<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
					<h4 class="card-title pull-left">EDIT ADMIN PROFILE</h4>
					<a href="<?=base_url("/admins");?>" class="btn btn-primary btn-round btn-icon pull-right" rel="tooltip" data-original-title="Back to admin listing" data-placement="left">
						<i class="now-ui-icons design_bullet-list-67"></i>
					</a>
        </div>
        <div class="clearfix"></div>
        <div class="card-body" id="adminInfo">
            <input type="hidden" id="id" value="<?=$this->encryption->encrypt($admin->id)?>">
            <div class="row">
              <div class="col-md-5">
                  <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" disabled="" placeholder="Username" value="<?=$admin->username;?>">
                  </div>
              </div>
              <div class="col-md-7">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name" value="<?=$admin->name;?>">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="mobile">Mobile Number</label>
                      <input type="text" class="form-control" id="mobile" placeholder="Mobile" value="<?=$admin->mobile;?>">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Email" value="<?=$admin->email;?>">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label>Admin Role</label>
                      <div>
                        <select class="selectpicker" id="type" data-size="7" data-style="form-control btn btn-primary btn-round btn-lg" title="Admin Type">
                          <?php foreach(["super_admin","sub_admin"] as $type): 
                            $selected = ($admin->type == $type) ? "selected" : "";?>
                            <option value="<?=$type;?>" <?=$selected;?>><?=$type;?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" id="address" placeholder="Address" value="<?=$admin->address;?>">
                  </div>
              </div>
              <div class="col-md-12">
                <span id="updateAdmin" class="btn btn-primary btn-md btn-round pull-right"><i class="now-ui-icons ui-1_check"></i> Update</span>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-user">
        <div class="image">
          <img src="<?=base_url("assets/img/banner.jpg");?>" alt="...">
        </div>
        <div class="card-body">
          <div class="author">
            <a href="#">
              <img class="avatar border-gray" src="<?=base_url("assets/img/avatar.png");?>" alt="...">
              <h5 class="title"><?=$admin->name;?></h5>
            </a>
            <p class="description">
              <?=$admin->username;?>
            </p>
          </div>
          <p class="description text-center"><?=$admin->address;?></p>
        </div>
      </div>
    </div>
</div>
</div>
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/plugins/bootstrap-selectpicker.js")?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.validate.min.js")?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.bootstrap-wizard.js")?>"></script>
<script src="<?=base_url("assets/js/modules/Admin.js")?>"></script>
<script>
  $(document).ready(()=>{
    Admin.initProfile();
  });
</script>
<?php $this->load->view("common/footer");?>