/*===========================================================================================================
 |* Module: ServiceWorker
 |* Description: This module is responsible to provide the view level security for application.
 |* Author: Ajay Kumar
 |* Version: 1.0.0
============================================================================================================*/
// Settings for app locker
let env = {
  interval : 5000, // ms = 5sec
  maxAttempts : 4
};
class ServiceWorker {
  static async sendRequest(url, data){
    return await $.ajax({
      url: url,
      data: data,
      type:"post",
      dataType:"json",
      success:(response)=>{
        return response;
      },
      error:()=>{
        return {status: false, message:"Unable to connect with server"}
      }
    });
  }

  static async lockApp(status){
    let self = this;
    if(status){
      clearInterval(self.runner);
      let response = await this.sendRequest(router.checkActivity, {action:"lockit"});
      if(response.status){
        window.location.reload();
      }
    }
  }

  static async checkLogs(){
    let $self = this;
    let response = await $self.sendRequest(router.checkActivity,{action:"checkLocker"});
    $self.lockApp(response.status);
  }

  static async init(){
    let $self = this;
    $self.runner = null;
    $self.runner = setInterval(()=>{
      $self.checkLogs();
    }, env.interval);
  }
}
