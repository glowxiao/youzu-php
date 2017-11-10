/**
 * 背景轮播
 */
$().ready(function(){
	$index=0;
	var li=$("ul#point").children();
	var img = $('#box').children();
	function move() {
		$len=$("#box img").size();
        $index++;
        if ($index == $len) {
            $index = 0;
        }
        $("ul#point li").eq($index).addClass("active3").siblings().removeClass("active3");
        $("#box img").eq($index).fadeIn(1500).siblings().fadeOut(1500);
    }
	 var time = setInterval(move, 2000);
	 $("ul#point li").click(function(){
		clearInterval(time);
		clearTimeout(st);
		$num = $(this).index();
		$(li).removeClass("active3");
		$(li[$num]).addClass("active3");
		$(img).fadeOut(1000);
		$(img[$num]).fadeIn(1000);
		$index=$num;
		var st = setTimeout(function(){   //设置定时器,若3秒内没有鼠标点击操作,就重新设置轮播定时器
	            time = setInterval(move,2000);
	        },1000);
	});

});

//图片移入产生下划线
function zeng(){
	$arr=$(".ul1 li");
	$arr1=$(".ul1 li span");
	for($i=0;$i<$arr.length;$i++){
		$arr[$i].index=$i;
		$(".ul1 li").mouseover(function(){
			$(".ul1 li span").eq(this.index).animate({width:"90px"},200);
		});	
		$(".ul1 li").mouseout(function(){
			$(".ul1 li span").eq(this.index).animate({width:"0px"},50);
		});	
	}
}
zeng();


//弹出注册页面
function zhuce(){
	var input4=document.getElementById("input4");
	var zhebg=document.getElementById("zhebg");
	var zhuce=document.getElementById("zhuce");
	var span=document.getElementById("span");
	 window.onscroll=function(){
		 zhebg.style.width=document.body.clientWidth+'px';
    	 zhebg.style.height=document.body.clientHeight+'px';
    	 var h=document.body.scrollTop+document.documentElement.scrollTop;
		setTimeout(function(){
   		 zhuce.style.top=50+h+'px';
   	 },300);
	}
	input4.onclick=function(){
		zhebg.style.display='block';
		zhuce.style.display='block';
	}
	span.onclick=function(){
		zhebg.style.display='none';
		zhuce.style.display='none';
	}
}
zhuce();