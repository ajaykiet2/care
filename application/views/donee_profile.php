<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
            <h5 class="title">Edit Donee Profile</h5>
        </div>
        <div class="card-body" id="doneeInfo">
            <input type="hidden" id="id" value="<?=$this->encryption->encrypt($donee->id)?>">
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" disabled="" placeholder="Username" value="<?=$donee->username;?>">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name" value="<?=$donee->name;?>">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label>Status</label>
                      <div>
                        <select class="selectpicker" id="status" data-size="2" data-style="form-control btn btn-primary btn-round btn-lg" title="Admin Type">
                          <?php foreach(["active","inactive"] as $status): 
                            $selected = ($donee->status == $status) ? "selected" : "";?>
                            <option value="<?=$status;?>" <?=$selected;?>><?=$status;?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                  </div>
              </div>
              
              <div class="col-md-5">
                  <div class="form-group">
                      <label for="mobile">Mobile Number</label>
                      <input type="text" class="form-control" id="mobile" placeholder="Mobile" value="<?=$donee->mobile;?>">
                  </div>
              </div>
              <div class="col-md-7">
                  <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Email" value="<?=$donee->email;?>">
                  </div>
              </div>
              
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" id="address" placeholder="Address" value="<?=$donee->address;?>">
                  </div>
              </div>
              <div class="col-md-12">
                <span id="updateDonee" class="btn btn-primary btn-md btn-round pull-right">Update</span>
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
              <h5 class="title"><?=$donee->name;?></h5>
            </a>
            <p class="description">
              <?=$donee->username;?>
            </p>
          </div>
          <p class="description text-center"><?=$donee->address;?></p>
        </div>
      </div>
    </div>
</div>
</div>
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/plugins/bootstrap-selectpicker.js")?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.validate.min.js")?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.bootstrap-wizard.js")?>"></script>
<script src="<?=base_url("assets/js/modules/Donee.js")?>"></script>
<script>
  $(document).ready(()=>{
    Donee.initProfile();
  });
</script>
<?php $this->load->view("common/footer");?>