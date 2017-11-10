/**
 * 充值中心
 */
//点击左边，右边发生相应变化
function Chu(){
	var a=document.getElementById("right1");
	var b=a.getElementsByTagName("li");
	var c=document.getElementById("main");
	var d=c.querySelectorAll("div.left");
	for(var i=0;i<b.length;i++){
		b[i].index=i;
		b[i].onclick=function(){
			for(var j=0;j<b.length;j++){
				d[j].style.display="none";
			}
			d[this.index].style.display="block";
		}
	}
}
Chu();
//给选择充值方式和金额添加边框和背景
function pay_active(){
	this.pay=function(m){	
		$arr=$(".left ul ."+m+" a");
		$arr.click(function(){
			$(this).addClass("pay_active").siblings().removeClass("pay_active");
		});
	}
}
var ob=new pay_active();
ob.pay('pay_to');
ob.pay('pay_num');

