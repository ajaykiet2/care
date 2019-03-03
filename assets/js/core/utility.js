/*==============================================================
# module: Utility
# description: This is for providing utlity functions
=================================================*/
class Utility{
    static async blockUI($element,status){
        if(status){
            let loaderImage = $("<img />")
                .attr("src",window.base_url+"assets/img/loader.gif")
                .addClass("img img-responsive")
                .css({height:'60px'});
            let spinner = $("<p />").addClass('text-center').css({
                position:"absolute",
                width:"100%",
                top:"50%",
                color:"#ff3636",
                fontSize:"36px",
                fontWeight:"100",
                transition:"transform(-50%,0%)"
            }).append(loaderImage);

            $("<div />").addClass("element-overlay").css({
                position: "absolute",
                width: "100%",
                height: "100%",
                borderRadius:"3px",
                left: 0,
                top: 0,
                background:"rgb(255,255,255,0.6)",
                zIndex: 1000000,
            }).append(spinner).appendTo($element.css("position", "relative"));
        }else{
            $element.find(".element-overlay").remove();
        }
    }
}