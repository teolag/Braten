$(function() {


	
	var dates = $("#date_from, #date_to").datepicker({
		dateFormat: 'yy-mm-dd',
		minDate: +0,
		monthNames: ['Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December'],
		monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec'],
		dayNames: ['Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag'],
		dayNamesMin: ['Sö', 'Må', 'Ti', 'On', 'To', 'Fr', 'Lö'],
		dayNamesShort: ['Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör'],
		nextText: 'Nästa månad',
		prevText: 'Förra månaden',
		duration: 'fast',
		autoSize: true,
		/*showOn: 'button',
		buttonImage: '../img/calendar.png',
		buttonImageOnly: false,*/
		firstDay:1,
		altFormat: 'DD, d MM, yy',
		showWeek: true,
		weekHeader: 'v.',
		onSelect: function(selectedDate) {
			var option = this.id == "date_from" ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		},
		onClose: function(dateText, inst) {
			from = Date.parse($("#date_from").val());
			to = Date.parse($("#date_to").val());
			diff = (to-from)/(60*60*24*1000);
			if(diff>=0) {
			$('#nights').html("Antal nätter: "+diff);
			}
			else {
				$('#nights').html("");
			}
		}
	});
	
	$("#date_from").datepicker("option", "altField", '#alternate1');
	$("#date_to").datepicker("option", "altField", '#alternate2');
		
	
	
	$('form.jUpdate').submit(function() {
		var $this = $(this);
		var formData = $(this).serialize();
		var url = $(this).attr("action");
		$.post(url, formData, function(data) {
			
			$button = $this.find("button");
			if(data.error) $this.prepend("<div class='error hidden'>"+data.error+"</div>");
			if(data.message) $this.prepend("<div class='message hidden'>"+data.message+"</div>");
						
			$this.children("div.error").slideDown('slow').delay(4000).slideUp('slow', function() { $(this).remove(); });
			$this.children("div.message").slideDown('slow').delay(2000).slideUp('slow', function() { $(this).remove(); });
			
		}, "json");
		
		return false; 
	});	
	
	
	
});


