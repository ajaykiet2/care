<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title pull-left">LIST OF DONEES</h4>
					<button class="btn btn-primary btn-round btn-icon pull-right" rel="tooltip" data-original-title="Add new donee" data-placement="left">
              <i class="now-ui-icons ui-1_simple-add"></i>
          </button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-shopping" id="doneeListing">
							<thead class="">
								<th >Product</th>
								<th >	Color</th>
								<th >Size</th>
								<th  class="text-right" >	Price</th>
								<th  class="text-right" >Qty</th>
								<th  class="text-right" >Amount</th>
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
<script src="<?=base_url("assets/js/modules/Donee.js");?>"></script>
<script>
	$(document).ready(()=>{Donee.init();});
</script>
<?php $this->load->view("common/footer");?>
