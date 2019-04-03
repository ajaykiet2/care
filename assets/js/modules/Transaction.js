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
    let table = await $target.DataTable({
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
    return table;
  }
  
  static async loadTransaction(txn_id){
    let self = this;
    let response = await self.sendRequest(router.loadTransaction,{txn_id});
    if(response.status){
      let container = $("<div>").css({background:"#CCC",padding:"10px"});
      let txnTable = $("<table>").addClass("table table-striped");
      let headings = $("<tr>").append([$("<th>").text("FIELD"),$("<th>").text("VALUE")]).addClass("bg-primary text-white");
      let body = $("<tbody>");
      for (let key in response.transaction) {
        if (response.transaction.hasOwnProperty(key)) {
          let val = response.transaction[key] || "N/A";
          body.append($("<tr>").append([$("<td>").text(key.toUpperCase()),$("<td>").text(val.toUpperCase())]));
        }
      }
      txnTable.append([headings,body]);
      container.append(txnTable);
      return container;
    }else{
      return $("<p>").addClass("text-danger").text(response.message);
    }
  }

  // initialize the events
  static async initEvents(table){
    // code for events
    let self = this;
    $('table#transactionListing').on('click', 'td.details-control', async function () {
      var tr = $(this).closest('tr');
      var row = table.row(tr);
      if (row.child.isShown()) {
          row.child.hide(200);
          tr.removeClass('shown');
      } else {
          tr.addClass("loading");
          let txnDetail = await self.loadTransaction(tr.data("id"));
          row.child(txnDetail).show(200);
          tr.addClass('shown');
          tr.removeClass("loading");
          tr.next().child("td").css("padding","0!important");
              
         
      }
  });
  }

  // Initialize the instance
  static async init(){
    // holding the current object
    let self = this;
    let table = await self.loadTransactions($("#transactionListing"));
    self.initEvents(table);
  }
}
