jQuery(function($){
	$('.date-picker').datepicker({
        dateFormat: "mm/dd/yy"
    });

	var RentalCalendar = function(container){
		var self = this;
		this.container = container;
		this.calendar= null;
		this.form_container = null;

		this.init = function(){
			self.container = container;
			self.calendar = $('.calendar-content', self.container);
			self.form_container = $('.calendar-form', self.container);
			setCheckInOut('', '', self.form_container);
			self.initCalendar();
		}

		this.initCalendar = function(){
			self.calendar.fullCalendar({
				firstDay: 1,
                lang:st_params.locale,
				customButtons: {
			        reloadButton: {
                        text: st_params.text_refresh,
			            click: function() {
			                self.calendar.fullCalendar( 'refetchEvents' );
			            }
			        }
			    },
				header : {
				    left:   'today,reloadButton',
				    center: 'title',
				    right:  ' prev, next'
				},
				contentHeight: 480,
				selectable: true,
				select : function(start, end, jsEvent, view){
					var start_date = new Date(start._d).toString("MM");
					var end_date = new Date(end._d).toString("MM");
					var today = new Date().toString("MM");
					if(start_date < today || end_date < today){
						self.calendar.fullCalendar('unselect');
						setCheckInOut('', '', self.form_container);
					}else{
						var check_in = start._d.toString("MM/dd/yyyy");
						var	check_out = moment(end._d).subtract(1, 'day')._d.toString("MM/dd/yyyy");
						setCheckInOut(check_in, check_out, self.form_container);
					}
					
				},
				events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: ajaxurl,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action:'st_get_availability_rental',
                            post_id:self.container.data('post-id'),
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(doc){
                        	if(typeof doc == 'object'){
                            	callback(doc);
                        	}
                        },
                        error:function(e)
                        {
                            alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });
                },
				eventClick: function(event, element, view){
					
				},
				eventRender: function(event, element, view){
					var html = event.day; 
                    var html_class = "none";
                    if(typeof event.date_end != 'undefined'){
                        html += ' - '+event.date_end;
                        html_class = "group";
                    }                    
                    var today_y_m_d = new Date().getFullYear() +"-"+(new Date().getMonth()+1)+"-"+new Date().getDate();                    
                    if(event.status == 'available'){
                        var title ="";
                        
                        if (event.adult_price != 0) {title += st_checkout_text.adult_price+': '+event.adult_price + " <br/>"; }
                        if (event.child_price != 0) {title += st_checkout_text.child_price+': '+event.child_price + " <br/>"; }
                        if (event.infant_price != 0) {title += st_checkout_text.infant_price+': '+event.infant_price ;  }
                        
                        html  = "<button data-placement='top' title  = '"+title+"' data-toggle='tooltip' class='"+html_class+" btn btn-available'>" + html;
                    }else {
                        html  = "<button disabled data-placement='top' title  = 'Disabled' data-toggle='tooltip' class='"+html_class+" btn btn-disabled'>" + html;
                    }         
                    if (today_y_m_d === event.date) {
                        html += "<span class='triangle'></span>";
                    }
                    html  += "</button>";
                    element.addClass('event-'+event.id)
                    element.addClass('event-number-'+event.start.unix());
                    $('.fc-content', element).html(html);
				},
                loading: function(isLoading, view){                    
                    if(isLoading){
                        $('.calendar-wrapper-inner .overlay-form').fadeIn();
                    }else{
                        $('.calendar-wrapper-inner .overlay-form').fadeOut();
                    }
                },

			});
		}
	};

	function setCheckInOut(check_in, check_out, form_container){
		$('#calendar_check_in', form_container).val(check_in);
		$('#calendar_check_out', form_container).val(check_out);
	}
	function resetForm(form_container){
		$('#calendar_check_in', form_container).val('');
		$('#calendar_check_out', form_container).val('');
		$('#calendar_price', form_container).val('');
		$('#calendar_priority', form_container).val('');
		$('#calendar_number', form_container).val('');
	}
	jQuery(document).ready(function($) {
		if($('a[href="#availablility_tab"]').length){
			$('a[href="#availablility_tab"]').click(function(event) {
				setTimeout(function(){
					$('.calendar-content', '.calendar-wrapper').fullCalendar('today');
				}, 1000);
			});
		}
		$('.calendar-wrapper').each(function(index, el) {
			console.log('sasa');
			var t = $(this);
			var rental = new RentalCalendar(t);
			rental.init();

			var flag_submit = false;
			$('#calendar_submit', t).click(function(event) {
				var data = $('input, select', '.calendar-form').serializeArray();
					data.push({
						name: 'action',
						value: 'st_add_custom_price_rental'
					});
				$('.form-message', t).attr('class', 'form-message').find('p').html('');	
				$('.overlay', self.container).addClass('open');
				if(flag_submit) return false; flag_submit = true;
				$.post(ajaxurl, data, function(respon, textStatus, xhr) {
					if(typeof respon == 'object'){
						if(respon.status == 1){
							resetForm(t);
							$('.calendar-content', t).fullCalendar('refetchEvents');
						}else{
							$('.form-message', t).addClass(respon.type).find('p').html(respon.message);
							$('.overlay', self.container).removeClass('open');
						}
					}else{
						$('.overlay', self.container).removeClass('open');
					}

					flag_submit = false;
				}, 'json');
				return false;
			});
		});
	});
});
