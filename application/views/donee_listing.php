<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title pull-left">LIST OF DONEES</h4>
					<a href="<?=base_url("new_donee")?>" class="btn btn-primary btn-round btn-icon pull-right" rel="tooltip" data-original-title="Add new donee" data-placement="left">
						<i class="now-ui-icons ui-1_simple-add"></i>
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-shopping" id="doneeListing">
							<thead class="">
								<th>Name</th>
								<th>Username</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Status</th>
								<th class="text-right">Actions</th>
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
<script src="<?=base_url("assets/js/modules/Donee.js");?>"></script>
<script>
	$(document).ready(()=>{Donee.init();});
</script>
<?php $this->load->view("common/footer");?>
