<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">New Donor Profile Details</h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Name</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Mobile</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="mobile">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label>Email ID</label>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label>Address</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Latitude</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="latitude">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Longitude</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="longitude">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">New Donor Other Information</h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Aadhaar Number</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="aadhaar_number">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>PAN Number</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="pan_number">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div style="height:10px;width:100%"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Payment Mode</label>
                                <div>
                                    <select class="selectpicker" id="payment_mode" data-size="2" data-style="form-control btn btn-primary btn-round btn-lg" title="Payment Mode">
                                        <option value="online" selected>Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Account Status</label>
                                <div>
                                    <select class="selectpicker" id="status" data-size="2" data-style="form-control btn btn-primary btn-round btn-lg" title="Account Status">
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div style="height:10px;width:100%"></div>
                        <div class="col-sm-4">
                            <label>Amount</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="amount">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Latitude</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="latitude">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Longitude</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="longitude">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-fill btn-default">Clear Form</button>
                    <button class="btn btn-fill btn-primary">Add Donor</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/plugins/bootstrap-selectpicker.js")?>"></script>
<script src="<?=base_url("assets/js/modules/Donor.js")?>"></script>
<script>
$(document).ready(()=>{
    Donor.initAddDonor();
});
</script>
<?php $this->load->view("common/footer");?>