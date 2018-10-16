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
					<h4 class="card-title">Customers</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-shopping" id="donor-table">
							<thead class="">
								<th >Product</th>
								<th >	Color</th>
								<th >Size</th>
								<th  class="text-right" >	Price</th>
								<th  class="text-right" >Qty</th>
								<th  class="text-right" >Amount</th>
							</thead>
							<tbody>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
								<tr>
									<td class="td-name">Suede Biker Jacket</td>
									<td>Black</td>
									<td>M</td>
									<td class="td-number"><small>€</small>3,390</td>
									<td class="td-number">1</td>
									<td class="td-number"><small>€</small>549</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Content End --->
<?php $this->load->view("common/scripts");?>
<script src="<?=base_url("assets/js/modules/Report.js");?>"></script>
<script>
$(document).ready(function(){
	Report.initRevenueChart();
	Report.initAggregationData();
});
</script>
<?php $this->load->view("common/footer");?>
