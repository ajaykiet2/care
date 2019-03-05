class Report extends Utility{
  static async sendRequest(url,data){
    return await $.ajax({
      url : url,
      data : data,
      type : "post",
      dataType: "json",
      success : (response) => { return response; },
      error : ()=>{ return {status:false, message: "Unable to connect server!"}; }
    });
  }
  static async initDonorRegistrationChart(){
    Utility.blockUI($("#newDonerRegistration"),true);
    var response = await this.sendRequest(router.getDonerRegistrationChart,null);
    var labels = [];
    var data = [];
    response.data.forEach((dataRow,idx)=>{
      labels.push(dataRow.month);
      data.push(dataRow.count);
    });

    let e = document.getElementById("newDonerRegistration").getContext("2d");
    let gradientFill = e.createLinearGradient(0, 0, 0, 100);
    gradientFill.addColorStop(0, "rgba(255, 0, 0, 1)");
    gradientFill.addColorStop(1, "rgba(255, 150, 0, 1)");

    let a =  {
      type : "bar",
      data : {
        labels : labels,
        datasets: [{
          label: "New Registrations",
          backgroundColor: gradientFill,
          data: data
        }]
      },
      options: {
        maintainAspectRatio: false,
        legend: { display: false },
        tooltips: {
          bodySpacing: 4,
          mode:"nearest",
          intersect: 0,
          position:"nearest",
          xPadding:10,
          yPadding:10,
          caretPadding:10
        },  
        responsive: true,
        scales: {
          yAxes: [{
            gridLines:0,
            maxTicksLimit:5,
            gridLines: { zeroLineColor: "transparent", drawBorder: false},
            ticks:{stepSize :1}
          }],
          xAxes: [{
            display:true,
            gridLines:0,
            ticks: {
              padding: 10,
              fontColor: "rgba(100,100,100,1)",
              fontStyle: "bold"
            },
            gridLines: {
              zeroLineColor: "transparent",
              drawTicks: false,
              display: false,
              drawBorder: false
            }
          }]
        },
        layout:{
          padding:{left:0,right:0,top:15,bottom:15}
        }
      }
    };
    new Chart(e,a);
    Utility.blockUI($("#newDonerRegistration"),false);
  }

  static async initRevenueChart(){
    Utility.blockUI($("#bigDashboardChart"),true);
    var chartColor = "#FFFFFF";
    var ctx = document.getElementById('bigDashboardChart').getContext("2d");

    var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
    gradientFill.addColorStop(0, "rgba(204, 0, 0, 0)");
    gradientFill.addColorStop(1, "rgba(204, 0, 0, 0.6)");
    var response = await this.sendRequest(router.getRevenueChart,null);
    var labels = [];
    var data = [];
    response.data.forEach((dataRow,idx)=>{
      labels.push(dataRow.month);
      data.push(dataRow.revenue);
    });
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: "Total Donation",
          borderColor: chartColor,
          pointBorderColor: chartColor,
          pointBackgroundColor: "#ff5923",
          pointHoverBackgroundColor: "#ff5923",
          pointHoverBorderColor: chartColor,
          pointBorderWidth: 1,
          pointHoverRadius: 7,
          pointHoverBorderWidth: 2,
          pointRadius: 5,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data:  data
        }]
      },
      options: {
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 0,
            bottom: 0
          }
        },
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: '#fff',
          titleFontColor: '#ff5923',
          bodyFontColor: '#444',
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest"
        },
        legend: {
          position: "bottom",
          fillStyle: "#FFF",
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              fontColor: "rgba(255,255,255,1)",
              fontStyle: "bold",
              beginAtZero: true,
              maxTicksLimit: 10,
              padding: 10
            },
            gridLines: {
              drawTicks: true,
              drawBorder: false,
              display: true,
              color: "rgba(255,255,255,0.2)",
              zeroLineColor: "transparent"
            }

          }],
          xAxes: [{
            gridLines: {
              zeroLineColor: "transparent",
              display: false,

            },
            ticks: {
              padding: 10,
              fontColor: "rgba(255,255,255,1)",
              fontStyle: "bold"
            }
          }]
        }
      }
    });
    Utility.blockUI($("#bigDashboardChart"),false);
  }

  static numberFormat(num, digits) {
    var si = [
      { value: 1, symbol: "" },
      { value: 1E6, symbol: "M" },
      { value: 1E9, symbol: "G" },
      { value: 1E12, symbol: "T" },
      { value: 1E15, symbol: "P" },
      { value: 1E18, symbol: "E" }
    ];
    var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    var i;
    for (i = si.length - 1; i > 0; i--) {
      if (num >= si[i].value) {
        break;
      }
    }
    return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
  }

  static async initAggregationData(){
    let $self = this;
    Utility.blockUI($("body"),true);
    let response = await this.sendRequest(router.getAggregationData,null);
    if(response.status){
      $("#aggregation_donees").text($self.numberFormat(response.data.donees,2));
      $("#aggregation_donors").text($self.numberFormat(response.data.donors,2));
      $("#aggregation_transactions").text($self.numberFormat(response.data.transactions,2));
      $("#aggregation_revenue").text($self.numberFormat(response.data.total_revenue,2));
    }
    Utility.blockUI($("body"),false);
  }
}
