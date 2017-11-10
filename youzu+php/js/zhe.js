/**
 * 公用
 */
//遮罩
function zhe(){
	this.Zhe=function(id){
		var a=document.getElementById(id);
		 var b=a.getElementsByClassName("jin");
		 var c=a.querySelectorAll("div .zhe");
		 var d=a.querySelectorAll("div .tan");
		 for(var i=0;i<b.length;i++){
			 b[i].index=i;
		    b[i].onmouseover=function(){
		    	console.log("11");
		    	c[this.index].style.display="block";
		    	d[this.index].style.display="block";
		    }
		    b[i].onmouseout=function(){
		    	c[this.index].style.display="none";
		    	d[this.index].style.display="none";
		    }
		    }
	}
	 
}

//列表
function lie(){
    var a=document.getElementById("lie");
    var b=document.getElementById("yu");
    var c=document.getElementById("kai");
    var d=document.getElementById("xin");
    a.onmouseover=function(){
        c.style.display="block";
        d.style.display="none";
        a.style.borderRight="1px solid #E6E6E6";
        a.style.background="#FBF4F5";
        a.style.color="black";
        b.style.color="#6c6c6c";
        b.style.background="white";
    }
    b.onmouseover=function(){
        d.style.display="block";
        c.style.display="none";
        b.style.borderLeft="1px solid #E6E6E6";
        b.style.background="#FBF4F5";
        b.style.color="black";
        a.style.color="#6c6c6c";
        a.style.background="white";
    }
}
lie();

//安卓图标

function An(){
	this.an=function(id){
		$(".three i").hide();
		$(".two i").hide();
		var a=document.getElementById(id);
		var b=a.getElementsByTagName("input");
		var c=a.querySelectorAll("i");
		for(var i=0;i<b.length;i++){
			b[i].index=i;
			b[i].onmouseover=function(){
				c[this.index].style.display="block";
			}
			b[i].onmouseout=function(){
				c[this.index].style.display="none";
			}
		}
	}
}

