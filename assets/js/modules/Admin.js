/*=====================================================
 * Module: Admin
 * Description: This module will handle all activity on admin
 * Author: Ajay Kumar
 ============================================================*/
class Admin extends Utility{
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

  static async loadAdmins($target){
    let self = this;
    self.blockUI($("#adminListing"),true);
    return await $target.DataTable({
			"serverSide": true,
			"iDisplayLength": 10,
			"searching": true,
			"ajax": {
				"url": router.getAdmins,
				"type": "POST",
			},
      'createdRow': function( row, data, dataIndex ) {
				$(row).data('id', data.id);
			},
      "columns": [
				{ "data": "name" },
				{ "data": "mobile","orderable":false},
				{ "data": "email" },
				{ "data": "type" },
				{ "data": "action","orderable":false}
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

  static async updateAdmin(admin){
    let self = this;
    let response = await self.sendRequest(router.update_admin,admin);
    if(response.status){
      swal({
        title: "Success!",
        html: response.message,
        buttonsStyling: false,
        confirmButtonClass: "btn btn-success",
        type: "success"
      }).then((result) => {
				if (result) {
					window.location.reload();
				}
			});
    }else{
      swal({
        title: "Oops!",
        html: response.message+'<br>'+response.errors.join("<br>"),
        buttonsStyling: false,
        confirmButtonClass: "btn btn-danger",
        type: "error"
      });
    }
  }

  static async addAdmin(admin){
    let self = this;
    return await self.sendRequest(window.env.adminUri,admin);
  }

  static async bindEvents(){
    let self = this;
    // code for binding events
    
  }
  
  static async initProfile(){
    let self = this;
    $("#updateAdmin").click(()=>{
      let admin = {};
      admin.id = $("#adminInfo #id").val();
      admin.name = $("#adminInfo #name").val();
      admin.mobile = $("#adminInfo #mobile").val();
      admin.email = $("#adminInfo #email").val();
      admin.type = $("#adminInfo #type").val();
      admin.address = $("#adminInfo #address").val();
      self.updateAdmin(admin);
    });
  }
  // Initialize the module
  static async init(){
    let self = this;
    await self.loadAdmins($("#adminListing"));
  }
}
