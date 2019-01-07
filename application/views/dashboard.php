<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/datachart");?>
<div class="content">
	<!-- Content -->
	<?php $this->load->view("common/widgets/aggregation_data");?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Transactions</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-shopping" id="transactionListing">
							<thead class="">
								<th>Txn#ID</th>
								<th>Amount</th>
								<th>Description</th>
								<th>From</th>
								<th>Reference</th>
								<th>TimeStamp</th>
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
<script src="<?=base_url("assets/js/plugins/chartjs.min.js");?>"></script>
<script src="<?=base_url("assets/js/plugins/jquery.dataTables.min.js");?>"></script>
<script src="<?=base_url("assets/js/modules/Report.js");?>"></script>
<script src="<?=base_url("assets/js/modules/Transaction.js");?>"></script>
<script>
$(document).ready(function(){
	Report.initRevenueChart();
	Report.initAggregationData();
	Transaction.init();
});
</script>
<?php $this->load->view("common/footer");?>
