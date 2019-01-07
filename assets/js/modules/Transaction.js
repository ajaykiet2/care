class Transaction{
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
  static async loadTransactions($table){
    return await $table.DataTable({
      
      // server side code
    });
  }

  // initialize the events
  static async initEvents(){
    // code for events
  }

  // Initialize the instance
  static async init(){
    // holding the current object
    let $self = this;
    await $self.loadTransactions($("#transactionListing"));
    $self.initEvents();
  }
}
