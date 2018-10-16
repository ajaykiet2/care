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
      serverSide : true,
      searching : true,
      ajax:{
        url: "",
        data : ()=>{
          return {};
        }
      },
      columns:[
        {name : "txn_number", orderable: false},
        {name : "reference", orderble: true}
      ]
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
    await $self.loadTransactions($("#transactionTable"));
    $self.initEvents();
  }
}
