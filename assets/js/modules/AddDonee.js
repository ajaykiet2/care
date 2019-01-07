class AddDonee{
    static async sendRequest(url,data){
        return await $.ajax({
            url: url,
            data: data,
            type:"post",
            dataType: "json",
            success:(response)=>{
                return response;
            },
            error:()=>{
                return {status:false, message:"Unable to connect with server!"};
            }
        });
    }

    static async checkUserName(username){
        let self = this;
        if(!username.length){
            $.alert({
                title: "Oops!",
                content: "Please enter the username before processing!",
                type: "red"
            });
        }
        let url = "admin/ajax/doneeActions";
        let data = {action:"checkUserName",username};
        let response = await self.sendRequest(url,data);
        if(response.status){
            // TODO: Fill the validation in template
        }else{
            $.alert({
                title: "Oops!",
                content: response.message,
                type: "red"
            });
        }
    }

    static async generateUsername(name){
        let self = this;
        if(!name.length){
            $.alert({
                title:"Oops!",
                content: "Please enter the email id before processing!",
                type : "red"
            });
            return false;
        }
        let url = "admin/ajax/doneeActions";
        let data = {action:"generateUserName",name:name};
        let response = await self.sendRequest(url,data);
        if(response.status){
            //TODO: fill the user name in template
        }else{
            $.alert({
                title: "Oops!",
                content: response.message,
                type: "red"
            });
        }
    }

    static async formToJson($form){
        let unindexed_array = $form.serializeArray();
        let json = {};
        $.map(unindexed_array, field=>{
            json[field['name']] = field['value'];
        });
        return json;
    }

    static async save($form){
        let self = this;
        let data = await self.formToJson($form);
        let url = "/admin/ajax/addDonee";
        let response = await self.sendRequest(url,data);
        let status = response.status ? "success" : "error";
        $.notify(response.message, status);
        return response.status;
    }
    
    //=============================================================
    static async initUI(){
        let self = this;
        self.validator = $('form#doneeForm').validate({
        	rules: {
        		name: {
        			required: true,
        			minlength: 3
        		},
        		mobile: {
                    required: true,
                    digits:true,
                    minlength:10, 
                    maxlength:10
        		},
        		email: {
        			required: true,
        			minlength: 3,
                },
                username:{
                    required: true,
                    minlength: 6,
                },
                password:{
                    required: true,
                    minlength:8,
                    maxlength:16,
                },
                re_password:{
                    required:true,
                    equalTo:"#password"
                },
                address:{
                    required: true,
                    minlength: 5
                }
        	},
        	highlight: function (element) {
        		$(element).closest('.input-group').removeClass('has-success').addClass('has-danger');
        	},
        	success: function (element) {
        		$(element).closest('.input-group').removeClass('has-danger').addClass('has-success');
        	}
        });
    } 

    // Binding events 
    static async bindEvents(){
        let self = this;
        $("#saveDonee").click(()=>{
            if(!$('form#doneeForm').valid()) {
                self.validator.focusInvalid();
                return false;
            }else{
                self.save($('form#doneeForm'));
            }
        });
        $("#clearForm").click(()=>{
            $('form#doneeForm').clear();
        });


    }
    
    // Initialize the instance
    static async init(){
        this.initUI();
        this.bindEvents();
    }
}

AddDonee.init();