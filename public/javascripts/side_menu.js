$(function(){
    var menuStatus;
    $("a.showMenu").click(function(){
        if(menuStatus != true){
          // $("#menu").show();
          $(".ui-page-active").animate({
              marginLeft: "165px",
            }, 300, function(){menuStatus = true});
          $("#menu").css("z-index","1002");
          return false;
          } else {
            $(".ui-page-active").animate({
            marginLeft: "0px",
          }, 300, function(){menuStatus = false});
            $("#menu").hide();
            return false;
          }
    });
 
    $('.pages').live("swipeleft", function(){
        if (menuStatus){
        $(".ui-page-active").animate({
            marginLeft: "0px",
          }, 300, function(){menuStatus = false});
        $("#menu").hide();
          }
    });
 
    $('.pages').live("swiperight", function(){
        if (!menuStatus){
          $("#menu").show();
          $(".ui-page-active").animate({
            marginLeft: "165px",
          }, 300, function(){menuStatus = true});
          }
    });
 
    $("#menu li a").click(function(){
        var p = $(this).parent();
        if($(p).hasClass('active')){
            $("#menu li").removeClass('active');
        } else {
            $("#menu li").removeClass('active');
            $(p).addClass('active');
        }
    });
});