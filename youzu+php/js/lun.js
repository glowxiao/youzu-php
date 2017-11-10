/**
 * 轮播
 */
$().ready(function(){
        $("#box").mouseover(function(){
            clearTimeout(time);
        });
        $("#box").mouseout(function(){
            time=setTimeout(Gun,20);
        });
        
        Gun();
        Gun1();
    });
        function Gun(){
            var left=$("#box").css("left");
            left=parseInt(left)-5;
            if(left<=-4800){
                left=0;
            }
            $("#box").css("left",left+"px");
            if(left%1200==0){
                var num=Math.abs(left/1200)+1;
                $("[id^='l-']").removeClass('bian');
                $("#l-"+num).addClass("bian");
                time=setTimeout(Gun,2000);
            }else{
                time=setTimeout(Gun,20)
            }
       for(var i=0;i<$("[id^='l-']").length;i++){
                (function(i){
                    $("#l-"+(i+1)).click(function(){
                    	clearTimeout(time);
                        $("[id^='l-']").removeClass('bian');
                        $(this).addClass("bian");
                        $(".box").css("left",-i*1200+"px");
                });
                })(i);
            } 
        }
        
        
        
    function Gun1(){
	    var left=$("#div2_1_box").css("left");
	    left=parseInt(left)-5;
	    if(left<=-1080){
	        left=0;
	    }
	    $("#div2_1_box").css("left",left+"px");
	    if(left%270==0){
	        var num=Math.abs(left/270)+1;
	        $("[id^='r-']").removeClass('bian');
	        $("#r-"+num).addClass("bian");
	        time=setTimeout(Gun1,2000);
	    }else{
	        time=setTimeout(Gun1,20);
	    }
	    for(var i=0;i<$("[id^='r-']").length;i++){
	        (function(i){
	            $("#r-"+(i+1)).click(function(){
	                $("[id^='r-']").removeClass('bian');
	                $(this).addClass("bian");
	                $(".div2_1_box").css("left",-i*270+"px");
	        });
	        })(i);
	    } 
}
        