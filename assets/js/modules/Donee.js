/*=====================================================
 * Module: Donee
 * Description: This module will handle all activity on donee
 * Author: Ajay Kumar
 ============================================================*/

class Donee{
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

  static async loadDonees($target){
    return await $target.DataTable({
			"serverSide": true,
			"processing": true,
			"iDisplayLength": 10,
			"searching": true,
			"ajax": {
				"url": "admin/ajax/getDonees",
				"type": "POST",
			},
      'createdRow': function( row, data, dataIndex ) {
				$(row).data('id', data.id);
			},
      "columns": [
				{ "data": "name" },
				{ "data": "mobile" },
				{ "data": "email" },
				{ "data": "address" },
				{ "data": "type" },
				{ "data": "action","orderable":false }
			],
      "order": [[1, 'desc']],
			"language": {
				"paginate": {
				  "previous": "<i class='fa fa-caret-left'></i>",
				  "next": "<i class='fa fa-caret-right'></i>"
				},
				"processing": "<span class='text-danger now-ui-icons education_atom'></span> </br> Loading.."
			},
		});
  }

  static async addDonee(donee){
    let $self = this;
    return await $self.sendRequest(window.env.adminUri,admin);
  }

  static async bindEvents(){
    let $self = this;
    // code for binding events
  }

  // Initialize the module
  static async init(){
    let $self = this;
    $self.loadDonees($("#doneeListing"));
  }
}
