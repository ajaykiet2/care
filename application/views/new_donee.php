<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
<div class="col-md-10 mr-auto ml-auto">
    <div class="wizard-container" id="newDonee">
        <div class="card card-wizard active" data-color="primary">
            <div class="card-header text-center" data-background-color="black">
                <h3 class="card-title text-left">ADD NEW DONEE</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group form-control-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </div>
                            </div>
                            <input type="text" id="name" class="form-control" placeholder="Name (Required)" name="name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group form-control-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </div>
                            </div>
                            <input type="text" id="username" placeholder="Username (Required)" class="form-control" name="username"/>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group form-control-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </div>
                            </div>
                            <input type="text" id="mobile" placeholder="Mobile (Required)" class="form-control valid-mobile" name="mobile"/>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="input-group form-control-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </div>
                            </div>
                            <input type="email" id="email" placeholder="Email (Required)" class="form-control" name="email"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group form-control-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </div>
                            </div>
                            <input type="password" id="password" class="form-control" placeholder="Password (Required)" name="password" id="password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group form-control-lg">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </div>
                            </div>
                            <input type="password" id="re_password" placeholder="Re-Password (Required)" class="form-control" name="re_password"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Donee Address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row"> 
                    <div class="col-sm-12">
                        <div class="pull-right">
                            <span class="btn btn-danger btn-round" id="clearForm"><i class="fa fa-refresh"></i> Clear</span>
                            <span class="btn btn-primary btn-round" id="addNewDonee"><i class="fa fa-hdd"></i> Save</span>
                        </div>  
                    </div>               
                </div>
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
    Donee.initAddDonee();
});
</script>
<?php $this->load->view("common/footer");?>