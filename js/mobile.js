window.onload = function(){
	var getNavi = document.getElementById('navigation');

	var mobile = document.createElement("span");
	mobile.setAttribute("id","mobile-navigation");
	getNavi.parentNode.insertBefore(mobile,getNavi);

	document.getElementById('mobile-navigation').onclick = function(){
		var a = getNavi.getAttribute('style');
		if(a){
			getNavi.removeAttribute('style');
			document.getElementById('mobile-navigation').style.backgroundImage='url(images/mobile/mobile-menu.png)';
		} else {
			getNavi.style.display='block';
			document.getElementById('mobile-navigation').style.backgroundImage='url(images/mobile/mobile-close.png)';
		}
	};
	var getElm = getNavi.getElementsByTagName("LI");
	for(var i=0;i<getElm.length;i++){
		if(getElm[i].children.length>1){
			var smenu = document.createElement("span");
			smenu.setAttribute("class","mobile-submenu");
			smenu.setAttribute("OnClick","submenu("+i+")");
			getElm[i].appendChild(smenu);
		};
	};
	submenu = function (i){
		var sub = getElm[i].children[1];
		var b = sub.getAttribute('style');
		if(b){
			sub.removeAttribute('style');
			getElm[i].lastChild.style.backgroundImage='url(images/mobile/mobile-expand.png)';
			getElm[i].lastChild.style.backgroundColor='rgba(121, 101, 102, 0.91)';
		} else {
			sub.style.display='block';
			getElm[i].lastChild.style.backgroundImage='url(images/mobile/mobile-collapse.png)';
			getElm[i].lastChild.style.backgroundColor='rgba(204, 60, 104, 0.91)';
		}
	};
};

function getDateTime(state) {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = (state=='current')?now.getDate():now.getDate()+1;
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        if(state=='current')
            var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;   
        else
            var dateTime = year+'-'+month+'-'+day+' 00:00:00'
        return dateTime;
}

function addHiddenOrder(){
    console.log("function called");
    var current_time = getDateTime('current');
    var delivary_time = getDateTime('delivary');
    var element = document.getElementById("order-button");
    element.insertAdjacentHTML( 'afterend', `<input type="hidden" name="order_date" value="${current_time}" />` );
    element.insertAdjacentHTML( 'afterend', `<input type="hidden" name="delivary_time" value="${delivary_time}" />`);
    element.insertAdjacentHTML( 'afterend', `<input type="hidden" name="userid" value="${sessionStorage.getItem('userid')}" />`);
}

function addHiddenBooking(){
    var element = document.getElementById("book-button");
    element.insertAdjacentHTML( 'afterend', `<input type="hidden" name="userid" value="${sessionStorage.getItem('userid')}" />`);
}
