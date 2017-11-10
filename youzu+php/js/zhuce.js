/**
 * 注册页面的验证
 */
function Move(){
    var a=document.getElementById('zhanghao');
    var c=/^[a-zA-Z]\w{5,17}$/
    var d=a.value;
    	if(c.test(d)||d.length==0){
            a.style.color='#6C6C6C';
        }else{
            a.value='';
        	a.setAttribute("placeholder","长度应该为6-18个字符,且需以字母开头");
        }
}
function Move1(){
    var a=document.getElementById('pwd');
    var c=document.getElementById('queren');
    if(a.value==c.value){
    	a.style.color='#6C6C6C';
    }else{
    	a.value='';
    	c.value='';
    	c.setAttribute("placeholder","两次填写密码不一致，请重新输入！");
    	c.style.color='red';
    }
}