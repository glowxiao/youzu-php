/**
 * 积分商城
 */
$().ready(function(){
	lun();
	Da();
});
var time;
function lun(){
	var top=$("#box").css("top");
	top=parseInt(top)-20;
	if(top<=-960){
		top=0;
	}
	$("#box").css("top",top+"px");
	if(top%480==0){
		var num=Math.abs(top/480)+1;
        $("[id^='s-']").removeClass('chu');
        $("#s-"+num).addClass("chu");		
        time=setTimeout(lun,2000);
	}else{
		time=setTimeout(lun,200);
	}
}
function Da(){
	var date=new Date();
	var day=date.getDate();
    var month=date.getMonth()+1;
    var year=date.getFullYear();
	day<10 ? day="0"+day:day;
	month<10 ? month="0"+month:month;
	$(".right1 ul li").eq(0).html(day);
	$(".right1 ul li").eq(2).html(year+"."+month);
}