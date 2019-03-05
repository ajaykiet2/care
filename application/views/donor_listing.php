<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title pull-left">LIST OF DONORS</h4>
					<button class="btn btn-primary btn-round btn-icon pull-right" rel="tooltip" data-original-title="Add new donor" data-placement="left">
              <i class="now-ui-icons ui-1_simple-add"></i>
          </button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-shopping" id="donorListing">
							<thead class="">
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Status</th> 
								<th>Created At</th> 
								<th class="text-right">Action</th> 
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Content End --->
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/plugins/jquery.dataTables.min.js");?>"></script>
<script src="<?=base_url("assets/js/modules/Donor.js");?>"></script>
<script>
	$(document).ready(()=>{Donor.init();});
</script>
<?php $this->load->view("common/footer");?>
