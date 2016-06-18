jQuery(document).ready(function($) {
    var time;
    var scroll = '';
    var offset_form = '';
    $(window).resize(function(event) {
        clearTimeout(time);
        time = setTimeout(function(){
                $(window).scroll(function(event) {
                    if($(window).width() >= 992){
                        if(scroll == ''){
                            scroll = $(window).scrollTop();
                        }
                        var t = 0;
                        if($('#top_toolbar-sticky-wrapper').length && $('#top_toolbar-sticky-wrapper').hasClass('is-sticky')){
                            if($('#top_toolbar').length){
                                t += $('#top_toolbar').height();
                            }
                        }
                        if($('#st_header_wrap_inner-sticky-wrapper').length && $('#st_header_wrap_inner-sticky-wrapper').hasClass('is-sticky')){
                            if($('#main-header').length){
                                t += $('#main-header').height();
                            }
                            if($('#top_toolbar').length){
                                t += $('#top_toolbar').height();
                            }
                        }
                        
                        var h = 0;
                        if($('.hotel-room-form').length){
                            h = $('.hotel-room-form').offset().top - $(window).scrollTop();
                            if(offset_form == ''){
                                offset_form = $('.hotel-room-form').offset().top;
                            }
                        }
                        if(h <= t){

                            w = $('.hotel-room-form').width();
                            
                            var top_kc = t;
                            if ($('#wpadminbar').length > 0){ 
                                top_kc += $('#wpadminbar').height();
                            }
                            
                            if( ! $('.hotel-room-form').hasClass('sidebar-fixed')){
                                $('.hotel-room-form').css('top', top_kc);
                                $('.hotel-room-form').addClass('sidebar-fixed').css('width', w);
                                $('.hotel-room-form').addClass('no_margin_top');
                            }
                        }
                        if($(window).scrollTop() <= offset_form && $(window).scrollTop() < scroll){
                            $('.hotel-room-form').removeClass('sidebar-fixed').css('width', 'auto');
                            $('.hotel-room-form').css('top', 0);
                            $('.hotel-room-form').removeClass('no_margin_top');
                        }

                        scroll = $(window).scrollTop();
                    }
                });
        }, 500);
    }).resize();
    
});

jQuery(document).ready(function($) {
    var listDate = [];
    $('input.checkin_hotel, input.checkout_hotel').each(function() {
        $(this).datepicker({
            language:st_params.locale,
            format: $('[data-date-format]').data('date-format'),
            todayHighlight: true,
            autoclose: true,
            startDate: 'today',
            weekStart: 1,
        });
        date_start = $(this).datepicker('getDate');
        $(this).datepicker('addNewClass','booked');
        var $this = $(this);
        if(date_start == null)
            date_start = new Date();

        month_start = date_start.getMonth() + 1;
        year_start = date_start.getFullYear();
        post_id = $(this).data('post-id');
        ajaxGetRentalOrder(month_start, year_start, $this, post_id);
    });
    

    $('input.checkin_hotel').on('changeMonth', function(e) {
        var $this = $(this);
        month =  new Date(e.date).getMonth() + 1;
        year =  new Date(e.date).getFullYear();
        post_id = $(this).data('post-id');
        ajaxGetRentalOrder(month, year, $this, post_id);
    });

    $('input.checkin_hotel').on('changeDate',function(e){
        var new_date = e.date;      
        new_date.setDate(new_date.getDate() + 1);
        $('input.checkout_hotel').datepicker('setStartDate', new_date);
        $('input.checkout_hotel').datepicker('setDate', new_date);
    });
    
    $('input.checkout_hotel').on('changeMonth', function(e) {
        var $this = $(this);
        month =  new Date(e.date).getMonth() + 1;
        year =  new Date(e.date).getFullYear();
        post_id = $(this).data('post-id');
        ajaxGetRentalOrder(month, year, $this, post_id);
    });

    function ajaxGetRentalOrder(month, year, me, post_id){
        var data = {
            room_id: post_id,
            month: month,
            year: year,
            security:st_params.st_search_nonce,
            action:'st_get_disable_date_hotel',
        };
        $('.date-overlay').addClass('open');
        $.post(st_params.ajax_url, data, function(respon) {
            if(respon!= ''){
                listDate = respon;
            }
            if($('.input-daterange').length > 0){
                booking_period = $('.input-daterange').data('booking-period');
                if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
                    var data = {
                        booking_period : booking_period,
                        action: 'st_getBookingPeriod'
                    };
                    $.post(st_params.ajax_url, data, function(respon1) {
                        if(respon1 != ''){
                            listDate = listDate.concat(respon1);
                            me.datepicker('setRefresh',true);
                            me.datepicker('setDatesDisabled',listDate);    
                            $('.date-overlay').removeClass('open');
                        }

                    },'json');
                }else{
                    me.datepicker('setRefresh',true);
                    me.datepicker('setDatesDisabled',listDate);
                    $('.date-overlay').removeClass('open');
                }
            }else{

                $('.date-overlay').removeClass('open');
            }  
        },'json');
        
    }

    var HotelCalendar = function(container){
        var self = this;
        this.container = container;
        this.calendar= null;
        this.form_container = null;

        this.init = function(){
            self.container = container;
            self.calendar = $('.calendar-content', self.container);
            self.form_container = $('.calendar-form', self.container);
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
                    left:   'prev',
                    center: 'title',
                    right:  'next'
                },
                contentHeight: 360,
                events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: st_params.ajax_url,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action:'st_get_availability_hotel_room',
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
                    /*$('#calendar_price', self.form_container).val(event.price);
                    $('#calendar_number', self.form_container).val(event.number);
                    $('#calendar_status option[value='+event.date+']', self.form_container).prop('selected');*/
                },
                eventRender: function(event, element, view){
                    var html = "";
                    var title = "";
                    var html_class = "btn-disabled";   
                    var is_disabled = "disabled";
                    var today_y_m_d = new Date().getFullYear() +"-"+(new Date().getMonth()+1)+"-"+new Date().getDate();

                    if(event.status == 'booked'){ }
                    if(event.status == 'past'){ }
                    if(event.status == 'disabled'){ }

                    if(event.status == 'avalable'){
                        html_class = "btn-available";
                        is_disabled = "";
                        title = st_checkout_text.origin_price + ": "+event.price;
                    }                    
                    html += "<button  "+is_disabled+" data-toggle='tooltip' data-placement='top' class= '"+html_class+" btn' title ='"+title+"''>"+event.day;  
                    if (today_y_m_d === event.date) {
                        html += "<span class='triangle'></span>";
                    }        
                    html+="</button>";
                    $('.fc-content', element).html(html);
                },
                eventAfterRender: function( event, element, view ) {
                    $('[data-toggle="tooltip"]').tooltip({html:true});
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
    if($('.calendar-wrapper').length){
        $('.calendar-wrapper').each(function(index, el) {
            var t = $(this);
            var hotel = new HotelCalendar(t);
            hotel.init();
        });
    }
});

