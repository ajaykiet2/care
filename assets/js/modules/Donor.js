/*=====================================================
 * Module: Donor
 * Description: This module will handle all activity on donor
 * Author: Ajay Kumar
 ============================================================*/

class Donor{
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
    return await $target.DataTable({

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
