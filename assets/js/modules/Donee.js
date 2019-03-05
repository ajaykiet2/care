/*=====================================================
 * Module: Donee
 * Description: This module will handle all activity on donee
 * Author: Ajay Kumar
 ============================================================*/

class Donee extends Utility{
	static async sendRequest(url, data) {
		return await $.ajax({
			url,
			data,
			type: "post",
			dataType: "json",
			success: (response) => {
				return response;
			},
			error: () => {
				return {
					status: false,
					message: "Unable to connect server!"
				};
			}
		});
	}

	static async loadDonees($target) {
		let self = this;
		self.blockUI($target,true);
		return await $target.DataTable({
			"serverSide": true,
			"iDisplayLength": 10,
			"searching": true,
			"ajax": {
				"url": router.getDonees,
				"type": "POST",
			},
			'createdRow': function (row, data, dataIndex) {
				$(row).data('id', data.id);
				if(data.status != 'active') $(row).addClass("text-danger");
			},
			"columns": [
				{ "data": "name" },
				{ "data": "username" },
				{ "data": "mobile" },
				{ "data": "email" },
				{ "data": "status" },
				{ "data": "action", "orderable": false }
			],
			"order": [
				[0, 'asc']
			],
			"language": {
				"paginate": {
				  "previous": "<i class='now-ui-icons arrows-1_minimal-left'></i>",
				  "next": "<i class='now-ui-icons arrows-1_minimal-right'></i>"
				},
			},
		}).on("processing.dt",async function (e, settings, processing) {
			if (processing) {
				self.blockUI($target,true);
			} else {
				self.blockUI($target,false);
			}
		});
	}

	static async addDonee(donee) {
		let self = this;
		//validate username
		let validate = await self.sendRequest(router.checkDoneeUsername,{username:donee.username});
		if(validate.status){
			let response = await self.sendRequest(router.addDonee,donee);
			if(!response.status){
				swal({
					title: "Oops!",
					html: response.message,
					buttonsStyling: false,
					confirmButtonClass: "btn btn-danger",
					type: "error"
				});
			}else{
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
			}
		}else{
			swal({
				title: "Oops!",
				html: validate.message,
				buttonsStyling: false,
				confirmButtonClass: "btn btn-danger",
				type: "error"
			});
		}
	}

	static async updateDonee(donee){
		let self = this;
		let response = await self.sendRequest(router.update_donee,donee);
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
        html: response.message+"<br>"+response.errors.join("<br>"),
        buttonsStyling: false,
        confirmButtonClass: "btn btn-danger",
        type: "error"
      });
		}
	}

	static async initProfile(){
		let self = this;
		$("#updateDonee").click(()=>{
			let donee = {
				id : $("#doneeInfo #id").val(),
				name : $("#doneeInfo #name").val(),
				status : $("#doneeInfo #status").val(),
				mobile : $("#doneeInfo #mobile").val(),
				email : $("#doneeInfo #email").val(),
				address : $("#doneeInfo #address").val()
			};
			self.updateDonee(donee);
		});
	}

	// Initialize the module
	static async init() {
		let $self = this;
		$self.loadDonees($("#doneeListing"));
	}

	static async initAddDonee() {
		let self = this;
		$("#newDonee #addNewDonee").click(()=>{
			let donee = {
				username : $("#newDonee #username").val(),
				name : $("#newDonee #name").val(),
				mobile : $("#newDonee #mobile").val(),
				email : $("#newDonee #email").val(),
				address : $("#newDonee #address").val(),
				password: $("#newDonee #password").val(),
				re_password: $("#newDonee #re_password").val(),
			};
			self.addDonee(donee);
		});
		$("#newDonee #clearForm").click(()=>{window.location.reload();});
	}
}
