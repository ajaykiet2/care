<?php
  $this->load->view("common/sidebar");
  $this->load->view("common/header");
  $this->load->view("common/widgets/blank_header");
?>

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title pull-left">Transactions</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-shopping" id="transactionListing">
							<thead class="">
								<th><i class="fa fa-plus"></i></th>
								<th>TRANSACTION ID</th>
								<th>Donee</th>
								<th>Donor</th>
								<th>Amount</th>
								<th>Payment Type</th>
								<th>Payment Mode</th>
								<th>Status</th> 
								<th>Date</th>
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

<?php $this->load->view("common/scripts"); ?>
<script src="<?=base_url("assets/js/plugins/jquery.dataTables.min.js");?>"></script>
<script src="<?=base_url("assets/js/modules/Transaction.js");?>"></script>
<script>
	$(document).ready(()=>{Transaction.init();});
</script>
<?php $this->load->view("common/footer"); ?>
