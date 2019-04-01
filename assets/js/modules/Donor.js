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
      success:(response)=>{ return response; },
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
        let rowClass = (data.status != 'Active') ? "text-danger" : "";
        $(row).addClass(rowClass);
			},
      "columns": [
				{ data: "name" },
				{ data: "mobile" },
				{ data: "email" },
				{ data: "amount" },
        { data: "status" },
        { data: "donee" },
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

  static async updateDonor(donor){
    let self = this;
    let response = await self.sendRequest(router.update_donor,donor);
    if(!response.status){
      let errors = [];
      if(response.errors.length)
        errors = response.errors.map(error=>{ return $("<div>").text(error);});
      else
        errors.push(response.message);
      $("#error").empty().append(errors).removeClass("hide");
      setTimeout(() => { $("#error").empty().addClass("hide"); },5000);
    }else{
      swal({
        title: "Success!",
        html: response.message,
        buttonsStyling: false,
        confirmButtonClass: "btn btn-success",
        type: "success"
      }).then((result)=>{
        if (result){
          window.location.reload();
        }
      });
    }
  }

  // Initialize the module
  static async init(){
    let $self = this;
    $self.loadDonors($("#donorListing"));
  }

  static async initProfile(){
    let self = this;
    let fields = ["id","name","mobile","email","status","pan_number","payment_mode","payment_schedule","purpose","amount","address"];
    $("#resetProfile").click(()=>{ window.location.reload()});
    $("#updateProfile").click(()=>{ 
      let donor = {};
      fields.map(field => {donor[field] = $("#"+field).val()});
      self.updateDonor(donor);
    });
  }
}
