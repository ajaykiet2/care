<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<?php $title = (empty($donee)) ? "Add New Donee" : "Update Donee Details for : <b>{$donee->username}</b>";?>
<?php if(empty($donee)){
    $donee = (object)array(
        "name" => "",
        "mobile" => "",
        "username" => "",
        "email" => "",
        "address" => "",

    );
}?>
<div class="content">
<div class="col-md-10 mr-auto ml-auto">
    <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" >
            <form id="doneeForm" action="#" method="">
                <div class="card-header text-center" data-background-color="black">
                    <h3 class="card-title text-left"><?=$title;?></h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center"> 
                        <div class="col-lg-10 mt-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons users_circle-08"></i>
                                            </div>
                                        </div>
                                        <input type="text" value="<?=$donee->name;?>" class="form-control" placeholder="Name (Required)" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons text_caps-small"></i>
                                            </div>
                                        </div>
                                        <input type="text" value="<?=$donee->mobile?>" placeholder="Mobile (Required)" class="form-control valid-mobile" name="mobile"/>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-lg-10 mt-3">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="input-group form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons text_caps-small"></i>
                                            </div>
                                        </div>
                                        <input type="text" value="<?=$donee->username;?>" placeholder="Username (Required)" class="form-control" name="username"/>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="input-group form-control-lg">
                                        <button class="btn btn-primary btn-round btn-icon"><i class="now-ui-icons arrows-1_refresh-69"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons text_caps-small"></i>
                                            </div>
                                        </div>
                                        <input type="email" value="<?=$donee->email;?>" placeholder="Email (Required)" class="form-control" name="email"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 mt-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons users_circle-08"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Password (Required)" name="password" id="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group form-control-lg">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="now-ui-icons text_caps-small"></i>
                                            </div>
                                        </div>
                                        <input type="password" placeholder="Re-Password (Required)" class="form-control" name="re_password"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 mt-3">
                            <div class="form-group">
                                <textarea rows="4" cols="80" name="address" class="form-control" placeholder="Donee Address"><?=$donee->address;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <div class="row justify-content-center"> 
                        <div class="col-lg-10 mt-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <span class="btn btn-danger btn-round" id="clearForm"><i class="fa fa-refresh"></i> Clear</span>
                                        <span class="btn btn-primary btn-round" id="saveDonee"><i class="fa fa-hdd"></i> Save</span>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- wizard container -->
</div>
</div>
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/plugins/bootstrap-selectpicker.js")?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.validate.min.js")?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.bootstrap-wizard.js")?>"></script>
<script src="<?=base_url("assets/js/modules/AddDonee.js")?>"></script>
<?php $this->load->view("common/footer");?>