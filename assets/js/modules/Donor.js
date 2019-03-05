/*=====================================================
 * Module: Donor
 * Description: This module will handle all activity on donor
 * Author: Ajay Kumar
 ============================================================*/

class Donor extends Utility{
  static async sendRequest(url,data){
    return await $.ajax({
      url,
      data,
      type:"post",
      dataType: "json",
      success:(response)=>{
        return response;
      },
      error: ()=>{
        return {status:false,message:"Unable to connect server!"};
      }
    });
  }

  static async loadDonors($target){
    let self = this;
    self.blockUI($target,true);
    return await $target.DataTable({
			"serverSide": true,
			"iDisplayLength": 10,
			"searching": true,
			"ajax": {
				"url": router.getDonors,
				"type": "POST",
			},
      'createdRow': function( row, data, dataIndex ) {
        $(row).data('id', data.id);
        if(data.status != 'active') $(row).addClass("text-danger");
			},
      "columns": [
				{ data: "name" },
				{ data: "mobile" },
				{ data: "email" },
        { data: "status" },
        { data: "date" },
				{ data: "action","orderable":false }
			],
      "order": [[0, 'asc']],
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
  }

  static async addDonor(donor){
    let $self = this;
    return await $self.sendRequest(window.env.adminUri,donor);
  }

  static async bindEvents(){
    let $self = this;
    // code for binding events
  }

  // Initialize the module
  static async init(){
    let $self = this;
    $self.loadDonors($("#donorListing"));
    $self.bindEvents();
  }
}
