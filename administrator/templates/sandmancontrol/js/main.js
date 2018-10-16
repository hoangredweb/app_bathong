
function toHHMMSS(sec_num) {
	var hours = Math.floor(sec_num / 3600);
	var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	var seconds = sec_num - (hours * 3600) - (minutes * 60);
	var time = '';
	// var time = hours + 'h ' + minutes + 'm ' + seconds + 's';
	if(hours) time+= hours + 'h ';
	if(minutes) time+= minutes + 'm ';
	time+= seconds + 's';

	return time;
}

(function($){
	$(document).ready(function(){
        //harvey --- customize templatesq
        //set avater
        $('.gravatar').hide();  
        $('.cpanel div.button a').css( "width" ,"166px"); 
        $('.cpanel div.button a').css( "height" ,"120px");
        $('.cpanel div.button a span:first-child').removeAttr('title');
        $('.page-title:contains("Control Panel")').each(function(){
             if($(this).children().length >0) {
                  //$(this).css("border","solid 2px red");
                  $(this).hide();
             }
        });
        $( ".cpanel div.button a[title='Add Corporate']" ).hover(function() {
            $(".cpanel div.button a[title='Add Corporate'] span:first-child" ).removeClass( "ico-48-ergo_corporates" ).addClass( "icon-48-ergo_corporates" );
        }, function() {
            $(".cpanel div.button a[title='Add Corporate'] span:first-child" ).removeClass( "icon-48-ergo_corporates" ).addClass( "ico-48-ergo_corporates" );
        } );
        
        $( ".cpanel div.button a[title='Corporates Master']" ).hover(function() {
            $(".cpanel div.button a[title='Corporates Master'] span:first-child" ).removeClass( "ico-48-ergo_corporates" ).addClass( "icon-48-ergo_corporates" );
        }, function() {
            $(".cpanel div.button a[title='Corporates Master'] span:first-child" ).removeClass( "icon-48-ergo_corporates" ).addClass( "ico-48-ergo_corporates" );
        } );
        
        $( ".cpanel div.button a[title='Policy Enquiry']" ).hover(function() {
            $(".cpanel div.button a[title='Policy Enquiry'] span:first-child" ).removeClass( "ico-48-ergo_policies" ).addClass( "icon-48-ergo_policies" );
        }, function() {
            $(".cpanel div.button a[title='Policy Enquiry'] span:first-child" ).removeClass( "icon-48-ergo_policies" ).addClass( "ico-48-ergo_policies" );
        } );
        
        $( ".cpanel div.button a[title='Add Policy Master']" ).hover(function() {
            $(".cpanel div.button a[title='Add Policy Master'] span:first-child" ).removeClass( "ico-48-ergo_policy" ).addClass( "icon-48-ergo_policy" );
        }, function() {
            $(".cpanel div.button a[title='Add Policy Master'] span:first-child" ).removeClass( "icon-48-ergo_policy" ).addClass( "ico-48-ergo_policy" );
        } );
        
        $( ".cpanel div.button a[title='Vehicle Cancellation Enquiry']" ).hover(function() {
            $(".cpanel div.button a[title='Vehicle Cancellation Enquiry'] span:first-child" ).removeClass( "ico-48-ergo_vehicle_cancellations" ).addClass( "icon-48-ergo_vehicle_cancellations" );
        }, function() {
            $(".cpanel div.button a[title='Vehicle Cancellation Enquiry'] span:first-child" ).removeClass( "icon-48-ergo_vehicle_cancellations" ).addClass( "ico-48-ergo_vehicle_cancellations" );
        } );
        
        $( ".cpanel div.button a[title='Notify Vehicle Cancellation']" ).hover(function() {
            $(".cpanel div.button a[title='Notify Vehicle Cancellation'] span:first-child" ).removeClass( "ico-48-ergo_vehicle_cancellation" ).addClass( "icon-48-ergo_vehicle_cancellation" );
        }, function() {
            $(".cpanel div.button a[title='Notify Vehicle Cancellation'] span:first-child" ).removeClass( "icon-48-ergo_vehicle_cancellation" ).addClass( "ico-48-ergo_vehicle_cancellation" );
        } );
        
        $( ".cpanel div.button a[title='Cover Note Enquiry']" ).hover(function() {
            $(".cpanel div.button a[title='Cover Note Enquiry'] span:first-child" ).removeClass( "ico-48-ergo_cover_notes" ).addClass( "icon-48-ergo_cover_notes" );
        }, function() {
            $(".cpanel div.button a[title='Cover Note Enquiry'] span:first-child" ).removeClass( "icon-48-ergo_cover_notes" ).addClass( "ico-48-ergo_cover_notes" );
        } );
        
        $( ".cpanel div.button a[title='Issue Cover Note']" ).hover(function() {
            $(".cpanel div.button a[title='Issue Cover Note'] span:first-child" ).removeClass( "ico-48-ergo_cover_note" ).addClass( "icon-48-ergo_cover_note" );
        }, function() {
            $(".cpanel div.button a[title='Issue Cover Note'] span:first-child" ).removeClass( "icon-48-ergo_cover_note" ).addClass( "ico-48-ergo_cover_note" );
        } );
        
        $( ".cpanel div.button a[title='C.I Enquiry']" ).hover(function() {
            $(".cpanel div.button a[title='C.I Enquiry'] span:first-child" ).removeClass( "ico-48-ergo_cis" ).addClass( "icon-48-ergo_cis" );
        }, function() {
            $(".cpanel div.button a[title='C.I Enquiry'] span:first-child" ).removeClass( "icon-48-ergo_cis" ).addClass( "ico-48-ergo_cis" );
        } );
        
        $( ".cpanel div.button a[title='Issue C.I']" ).hover(function() {
            $(".cpanel div.button a[title='Issue C.I'] span:first-child" ).removeClass( "ico-48-ergo_ci" ).addClass( "icon-48-ergo_ci" );
        }, function() {
            $(".cpanel div.button a[title='Issue C.I'] span:first-child" ).removeClass( "icon-48-ergo_ci" ).addClass( "ico-48-ergo_ci" );
        } );
        
         $( ".cpanel div.button a[title='C.I Type Master']" ).hover(function() {
            $(".cpanel div.button a[title='C.I Type Master'] span:first-child" ).removeClass( "ico-48-ergo_ci_types" ).addClass( "icon-48-ergo_ci_types" );
        }, function() {
            $(".cpanel div.button a[title='C.I Type Master'] span:first-child" ).removeClass( "icon-48-ergo_ci_types" ).addClass( "ico-48-ergo_ci_types" );
        } );
        
        
        $('.userinfo').css( "padding-bottom" ,"10px");  
        
        $('.userinfo .last-visit').css( "color" ,"black");
        $('.session_expire').hide();  
        //set filter
        $("a.btn.hasTooltip").css({'border-radius': '0'});
        $("#search_search").css({'border-radius': '0'});  
 
        //required * to red
        $('span.star').css( "color" ,"red"); 
        
          
		var editorSelect = $('#editor ul li a');  
		console.log(editorSelect);

		$('#editor ul li a').click(function(){
			var selectedEditorText = $(this).text();
			var selectedEditor = $(this).data('editor');

			$.post('templates/sandmancontrol/ajax-models/quickeditor.php', { editor: selectedEditor },function(data){
				// alert(data);
				if (data === 'success') {
					$('#editor .select-active').text(selectedEditorText);
				}
			});
		});		

		// Session Bar

		$.post('templates/sandmancontrol/ajax-models/sessionbar.php', function(data){
			// alert(data);
			var sessionExpire = parseInt(data);
			var sessionTimeRemaining = sessionExpire;

			var sessionProgress = $('.session_progress');
			var sessionTip = $('.session_tip');
			var sessionPercentage = 100;

			
			var sessionInterval = setInterval(function(){
				
				sessionTimeRemaining--;

				sessionTip.text(toHHMMSS(sessionTimeRemaining));
				var sessionWidth = sessionTip.width() + 15;

				sessionPercentage = (sessionTimeRemaining / sessionExpire) * 100;
				sessionProgress.css('width', sessionPercentage + '%');
				sessionTip.show();
				
				if (sessionTimeRemaining <= 10) {
					sessionTip.removeClass('warning-blink').addClass('danger-blink');
				} else if (sessionTimeRemaining <= 30) {
					sessionTip.addClass('warning-blink');
				} 

				if (sessionTimeRemaining <= 0) {
					window.clearInterval(sessionInterval);
					sessionTip.text('Session Expired').addClass('expired').removeClass('danger-blink').removeClass('warning-blink');
					sessionWidth = sessionTip.width() + 15;
				}

				sessionTip.css('left', '-' + sessionWidth + 'px');

			}, 1000);

		});



		// var sessionProgress = $('.session_progress');
		// var sessionPercentage = 100;

		// var sessionInterval = setInterval(function(){
		// 	if(sessionPercentage <= 0) {
		// 		window.clearInterval(sessionInterval);
		// 		return;
		// 	}
		// 	sessionProgress.css('width', sessionPercentage + '%');
		// 	sessionPercentage-=10;
		// }, 1000);
	});
}(jQuery));