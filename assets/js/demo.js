function LoadNotify()
{
    $.ajax({
	type:"GET",
	url: "notify.php",
	dataType: 'json',
	success: function(response)
	{
	   // console.log(response);
		$.each(response, function(key, value)
		{
			var date  = new Date(value.agreement_end_date);
			var showDate = date.toLocaleDateString("en-US", { year: 'numeric', month: 'long', day: 'numeric' });
			
			$('.renewal_notifications')
			    .append('<a href="#"><div class="notif-content pl-3"><span class="block">'+value.tenant_name+'\'s renewal is on '+showDate+'</span><span class="time">Token: '+value.token+' </span></div></a>');

// 		    $.notify({
// 				icon: 'none',
// 				title: 'Renewal Notifications',
// 				message: value.tenant_name+'\'s renewal is on '+showDate+'<br>Token No: '+value.token+'<br>Mobile: '+value.tenant_mobile,
// 			},{
// 				type: 'danger',
// 				placement: {
// 					from: "bottom",
// 					align: "right"
// 				},
// 				time: 5000,
// 			});
		});
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
        // alert("ajax error");
    }
});
}

function LoadBirthday()
{
    $.ajax({
	type:"GET",
	url: "birthday_staff.php",
	dataType: 'json',
	success: function(response)
	{
	   // console.log(response);
		$.each(response, function(key, value)
		{
		    if(value.simg != '')
		    {
    			$('.birthday_notifications')
    			    .append('<a href="#"><div class="notif-img"> <img src="../Staff/assets/img/staff/'+value.simg+'" alt="Img Profile"> </div> <div class="notif-content"> <span class="block">'+value.name+'\'s birthday is today! <i class="la la-birthday-cake text-warning"></i></span> <span class="time">Wish them best wishes!</span> </div> </a>');
		    }
		    else
		    {
		        $('.birthday_notifications')
    			    .append('<a href="#"><div class="notif-icon notif-danger"><i class="la la-birthday-cake"></i></div> <div class="notif-content"> <span class="block">'+value.name+'\'s birthday is today! <i class="la la-birthday-cake text-warning"></i></span> <span class="time">Wish them best wishes!</span> </div> </a>');
		    }
		});
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
        // alert("ajax error");
    }
});

    $.ajax({
	type:"GET",
	url: "birthday_agent.php",
	dataType: 'json',
	success: function(response)
	{
	   // console.log(response);
		$.each(response, function(key, value)
		{
		    $('.birthday_notifications')
    	        .append('<a href="#"><div class="notif-icon notif-danger"><i class="la la-birthday-cake"></i></div> <div class="notif-content"> <span class="block">'+value.name+'\'s birthday is today! <i class="la la-birthday-cake text-warning"></i></span> <span class="time">Wish them best wishes!</span> </div> </a>');
		});
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
        // alert("ajax error");
    }
});
}

function LoadSchedule()
{
    $.ajax({
	type:"GET",
	url: "schedule_notify.php",
	dataType: 'json',
	success: function(response)
	{
	   // console.log(response);
		$.each(response, function(key, value)
		{
			var date  = new Date(value.schedule);
			var showDate = date.toLocaleTimeString("en-US", { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute:'2-digit' });
			
			$('.schedule_notifications')
			    .append('<a href="#"><div class="notif-content pl-3"><span class="block"><b>'+value.name+'</b> is scheduled on <b>'+showDate+'</b></span></div></a>');
		});
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
        // alert("ajax error");
    }
});
}

LoadNotify();
LoadBirthday();
LoadSchedule();

















// $.notify({
// 	icon: 'none',
// 	title: 'Bootstrap notify',
// 	message: 'Turning standard Bootstrap alerts into "notify" like notifications',
// },{
// 	type: 'success',
// 	placement: {
// 		from: "top",
// 		align: "right"
// 	},
// 	time: 1000,
// });