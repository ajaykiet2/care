class Transaction extends Utility{
  // Communicate with server
  static async sendRequest(url,data){
    return await $.ajax({
      url: url,
      data: data,
      type: "post",
      dataType: "json",
      success: (response)=>{
        return response;
      },
      error: ()=>{
        return {status: false, message: "Unable to connect with server!"};
      }
    });
  }

  // Loading transactions
  static async loadTransactions($target){
    let self = this;
    self.blockUI($target,true);
    self.table = await $target.DataTable({
      "serverSide": true,
			"iDisplayLength": 10,
			"searching": true,
			"ajax": {
				"url": router.getTransactions,
				"type": "POST",
			},
      'createdRow': function( row, data, dataIndex ) {
				$(row).data('id', data.id);
			},
      "columns": [
        {
          "className": 'details-control',
          "orderable": false,
          "data": "details",
          "defaultContent": ''
        },
				{ "data": "id" },
				{ "data": "donee" },
				{ "data": "donor" },
				{ "data": "amount" },
				{ "data": "payment_type" },
				{ "data": "payment_mode" },
				{ "data": "status" },
				{ "data": "date" }
			],
      "order": [[7, 'desc']],
			"language": {
				"paginate": {
				  "previous": "<i class='now-ui-icons arrows-1_minimal-left'></i>",
				  "next": "<i class='now-ui-icons arrows-1_minimal-right'></i>"
				},
			},
		}).on("processing.dt",async function (e, settings, processing) {
      if (processing) {
        await self.blockUI($target,true);
      } else {
        await self.blockUI($target,false);
      }
    });
    return transactionTable;
  }
  

  // initialize the events
  static async initEvents(){
    // code for events
  }

  // Initialize the instance
  static async init(){
    // holding the current object
    let $self = this;
    self.table = null;
    await $self.loadTransactions($("#transactionListing"));
    $self.initEvents();
  }
}
