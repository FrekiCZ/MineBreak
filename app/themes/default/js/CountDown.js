var CountDown = function(e, time, endm){
	this.startTime = time;
	this.e = e;
	this.endMess = endm;
	this.time = 0;

	this.constructor = function(){
		this.calculate();
		$(this.e).html('<div class="countDown_day countDown_data"></div><div class="countDown_hour countDown_data"></div><div class="countDown_min countDown_data"></div><div class="countDown_sec countDown_data"></div>');
		this.render();
	};
	

	this.calculate = function(){//Výpočet zbývajícího času
		var date = new Date(this.startTime.substr(0,4), Number(this.startTime.substr(5,2))-1, this.startTime.substr(8,2), this.startTime.substr(11,2), this.startTime.substr(14,2), this.startTime.substr(17,2), 0);
		var now  = new Date();
		var delta = date.getTime()-now.getTime();
		this.time = (delta>0) ? delta : 0;
	};

	this.render = function(){
		this.calculate();
		var ntime = this.count(this.time);
		var d = (ntime.day == 1) ? "den" : (ntime.days > 1 && ntime.days <= 4)? "dny" : "dní";
		var h = (ntime.hours == 1) ? "hodina" : (ntime.hours > 1 && ntime.hours <= 4)? "hodiny" : "hodin";
		var m = (ntime.minutes == 1) ? "minuta" : (ntime.minutes > 1 && ntime.minutes <= 4)? "minuty" : "minut";
		var s = (ntime.seconds == 1) ? "sekunda" : (ntime.seconds > 1 && ntime.seconds <= 4)? "sekundy" : "sekund";
		
//		var d = (ntime.day == 1) ? "" : (ntime.days > 1 && ntime.days <= 4)? "" : "";
//		var h = (ntime.hours == 1) ? "" : (ntime.hours > 1 && ntime.hours <= 4)? "" : "";
//		var m = (ntime.minutes == 1) ? "" : (ntime.minutes > 1 && ntime.minutes <= 4)? "" : "";
//		var s = (ntime.seconds == 1) ? "" : (ntime.seconds > 1 && ntime.seconds <= 4)? "" : "";

		$(this.e).attr("data-time", Math.round(this.time/1000).toString());
		$(this.e+" .countDown_day").html("<span class=\"number\">"+ntime.days.toString()+"</span><span class=\"unit\">"+d+"</span>");
		$(this.e+" .countDown_day").attr("data-time", ntime.days.toString());
		$(this.e+" .countDown_hour").html("<span class=\"number\">"+ntime.hours.toString()+"</span><span class=\"unit\">"+h+"</span>");
		$(this.e+" .countDown_hour").attr("data-time", ntime.hours.toString());	
		$(this.e+" .countDown_min").html("<span class=\"number\">"+ntime.minutes.toString()+"</span><span class=\"unit\">"+m+"</span>");
		$(this.e+" .countDown_min").attr("data-time", ntime.minutes.toString());
		$(this.e+" .countDown_sec").html("<span class=\"number\">"+ntime.seconds.toString()+"</span><span class=\"unit\">"+s+"</span>");
		$(this.e+" .countDown_sec").attr("data-time", ntime.seconds.toString());
		if(this.time>0){
			var th = this;
			window.countDownTimers[this.e] = window.setTimeout(function(){th.render()}, 1000);
		}
		else{
			$(this.e).html('<div class="countDown_end countDown_data">'+this.endMess+"</div>");
		}
	};

	this.count = function(t){//Výpočet dní, hodin, minut, sekund
		var tp = {};
		tp.days =  Math.floor(t/1000/60/60/24);
		tp.hours = Math.floor(t/1000/60/60 - tp.days*24);
		tp.minutes = Math.floor(t/1000/60 - tp.days*24*60 - tp.hours*60);
		tp.seconds = Math.floor(t/1000 - tp.days*24*60*60 - tp.hours*60*60 - tp.minutes*60);
		return tp;
	};

	this.constructor();
}

CountDown.getRandom = function(from, to){
	return Math.floor(Math.random()*(to-from+1)+from);
}

CountDown.inc = function(){
	for(c in window.countDownTimers){
		window.clearTimeout(window.countDownTimers[c]);
	}
	window.countDownElems = [];
	window.countDownTimers = [];
	$("*").each(function(){
		if(typeof $(this).attr("data-datum") != "undefined"){
			if(typeof $(this).attr("id") == "undefined")
				$(this).attr("id", "CountDown"+(new Date()).getTime().toString()+CountDown.getRandom(0,1000));

			if(typeof $(this).attr("data-zprava") == "undefined")
				$(this).attr("data-zprava", "Odpočet skončil");

			var e = new CountDown("#"+$(this).attr("id"), $(this).attr("data-datum"), $(this).attr("data-zprava"));
			window.countDownElems[$(this).attr("id")] = e;
		}
	})
};

$(document).ready(CountDown.inc);