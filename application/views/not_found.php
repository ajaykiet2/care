<?php $this->load->view("common/sidebar");?>
<?php $this->load->view("common/header");?>
<?php $this->load->view("common/widgets/blank_header");?>
<style type="text/css">
.card-header .code{
	font-size: 9em;
	font-family:calibri;
	font-weight: bold;
	padding:0px;
	text-shadow:0 0 10px #000;
}
.not-found .message{
	margin-top:-48px;
	padding-left:20px;
	font-size:3em;
	font-family:calibri;
}

.not-found .info{
	font-size: 1em;
	font-family:calibri;
	color:#999;
}

</style>
<div class="content">
	<div class="col-md-10 mr-auto ml-auto">
		<div class="not-found">
			<div class="card card-wizard active">
				<div class="card-header" data-background-color="black">
					<h1 class="card-title code">WHOOPS! <span class="pull-right">[404]</span></h1>
					<div class="clearfix"></div>
					<p class="message">It may have broken something..</p>
				</div>
				<div class="card-body">
					<p class="info">This page you are looking for is no longer here. After much rejigging of this site, things have been moved or 'disappeared'.</p>
				</div>
				<div class="card-footer">
					<h5 class="info-text">Please go with navigation links only</h5>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("common/scripts");?>
<?php $this->load->view("common/footer");?>
