/**
 * 新闻中心
 */
//图片轮播
function Gun(){
	    var left=$("#right2_1_box").css("left");
	    left=parseInt(left)-5;
	    if(left<=-1080){
	        left=0;
	    }
	    $("#right2_1_box").css("left",left+"px");
	    if(left%270==0){
	        var num=Math.abs(left/270)+1;
	        $("[id^='r-']").removeClass('bian');
	        $("#r-"+num).addClass("bian");
	        time=setTimeout(Gun,2000);
	    }else{
	        time=setTimeout(Gun,20);
	    }
	    for(var i=0;i<$("[id^='r-']").length;i++){
	        (function(i){
	            $("#r-"+(i+1)).click(function(){
	                $("[id^='r-']").removeClass('bian');
	                $(this).addClass("bian");
	                $(".right2_1_box").css("left",-i*270+"px");
	        });
	        })(i);
	    } 
}
Gun();
//图片移入产生下划线
function zeng(){
	$arr=$(".left_dao li");
	$arr1=$(".left_dao li span");
	for($i=0;$i<$arr.length;$i++){
		$arr[$i].index=$i;
		$(".left_dao li").mouseover(function(){
			$(".left_dao li span").eq(this.index).animate({width:"150px"},300);
		});	
		$(".left_dao li").mouseout(function(){
			$(".left_dao li span").eq(this.index).animate({width:"0px"},300);
		});	
	}
}
zeng();
