/**
 * 用户中心
 */
function Dian(){
	this.dian=function(id){
		var a=document.getElementById(id);
		a.onmouseover=function(){
			a.style.display="block";
		}
		a.onmouseout=function(){
			a.style.display="none";
		}
	}
}
var ob=new Dian();
/*ob.dian("zhanghao");
ob.dian("ziliao");*/
ob.dian("game");
ob.dian("message");
ob.dian("pay");
ob.dian("jifen");