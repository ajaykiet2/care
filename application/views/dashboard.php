<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/datachart");?>
<div class="content">
	<!-- Content -->
	<?php $this->load->view("common/widgets/aggregation_data");?>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-chart">
				<div class="card-header">
					<h5 class="card-category">New Donor Registrations</h5>
				</div>
				<div class="card-body">
					<div class="chart-area">
					<canvas id="newDonerRegistration"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Content End --->
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/plugins/chartjs.min.js");?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.dataTables.min.js");?>"></script>
<script src="<?=base_url("assets/js/modules/Report.js");?>"></script>
<script src="<?=base_url("assets/js/modules/Transaction.js");?>"></script>
<script>
$(document).ready(function(){
	Report.initRevenueChart();
	Report.initAggregationData();
	Report.initDonorRegistrationChart();
	Transaction.init();
});
</script>
<?php $this->load->view("common/footer");?>
