$(function() {
    var calendar = $('#calendar').fullCalendar({
        height: 650,
        aspectRatio: 2,
        defaultView: 'agendaWeek',
        nowIndicator: true,
        header: 
        {
            left: 'prev,next today',
            center: 'addEventButton, showMySchedule, printView',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        events:function(start, end, timezone, callback) {        
            $.ajax({
                url: './data-ops/dataGet.php',   
                type: "GETALL",
                success: function(result)         
                {
                    var data = JSON.parse(result);
                    var events = [];
                    for (i = 0; i < data.length; i++) {
                        events.push({
                            title: data[i]["name"],
                            id: data[i]["id"],
                            start: data[i]["date"]+'T'+data[i]["start_time"],
                            end: data[i]["date"]+'T'+data[i]["end_time"],
                            color: assignColor(data[i]["location"],data[i]["status"] ),
                        });
                    }
                    callback(events);
                }
            });
        },  
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        navLinks: true,
        eventClick:  function(event, jsEvent, view) {
            $.ajax({
                url: './data-ops/dataGet.php',   
                type: "GET",
                data: { 
                    id: event.id,
                },
                success: function(result)         
                {
                    var data = $.parseJSON(result);
                    $("#input_fullCalModal").modal();
                    $('#modal-title').text("Your Shift");
                    $('#reqID').text(data[0]["id"]);
                    $('#input_name').val(data[0]["name"]);
                    $("#location").val(data[0]["location"]);
                    $("#breaktime").val(data[0]["break_time"]);
                    $('input:radio[name="status"][value="'+data[0]["status"]+'"]').attr('checked', true);
                    $('#input_date').val(data[0]["date"]);
                    $('#input_starttime').val(data[0]["start_time"]);
                    $('#input_endtime').val(data[0]["end_time"]);
                    // $("#inputForm :input").prop("disabled", true);
                    $("#created").text(data[0]["created"]);
                    $("#submit").hide();
                    $("#close").hide();
                    $("#approve").show();
                    $("#reject").show();
                    $('#approve').on('click', function() {
                        var enteredDate = $('#input_date').val();
                        var enteredStartTime = $('#input_starttime').val();
                        var enteredEndTime = $('#input_endtime').val();
                        var eventStatus = $('input[name=status]:checked').val(); 
                        var eventColor = assignColor($('#location').val(),eventStatus ); 
                        var eventBreakTime = $("#breaktime option:selected").val();
                        // start format : 2018-11-01T6:00:00,  color: '#257e4a'
                        $.ajax({
                            type: "POST",
                            url: "./data-ops/dataUpdate.php",
                            data: { 
                                id : data[0]["id"],
                                name: $('#input_name').val(),
                                location:$('#location').val() ,
                                date:enteredDate,
                                starttime:enteredStartTime ,
                                endtime : enteredEndTime,
                                breaktime: eventBreakTime ,
                                status: eventStatus
                            },
                            success: function(result){
                                alert(result);
                                setTimeout(function(){// wait for 5 secs(2)
                                    location.reload(); // then reload the page.(3)
                                }, 1000); 
                            }
                        }); 
                        $("#inputForm").trigger("reset");
                    }) 
                    $('#reject').on('click', function() {
                        $.ajax({
                            type: "POST",
                            url: "./data-ops/dataDelete.php",
                            data: { 
                                id : data[0]["id"],
                            },
                            success: function(result){
                                alert(result);
                            }
                        }); 
                        $("#inputForm").trigger("reset");
                    })
                }
            })
        },
        views: {
          month: { // name of view
            titleFormat: 'YYYY/MM/DD'
          }
        },
        weekends: false, // will hide Saturdays and Sundays
        // dayClick:  function(date,event, jsEvent, view) {
        //     console.log(date.format());
        //     $('#input_fullCalModal').modal();
        //     $('#input_title').val(date.format())
        // },
        customButtons: {
            printView: {
                text: 'Print',
                click: function() {
                    console.log('clicked Print');
                    window.print();
                }
            },
            // exportToExcel: {
            //     text: 'Export',
            //     click: function() {
            //         $.ajax({
            //             type: "POST",
            //             url: "./data-ops/dataExport.php",
            //             data: { 
            //                 name: 'sonam'
            //             },
            //             success: function(result){
            //               console.log(result);
            //             }
            //         })
            //     }
            // },
            showMySchedule: {
                text: 'My Shifts',
                click: function() {
                $.ajax({
                    type: "GET",
                    url: "./data-ops/mySchedule.php",
                    data: { 
                        name: 'sonam'
                    },
                    success: function(result){
                        var data = JSON.parse(result);
                        var events = []
                        for (i = 0; i < data.length; i++) {
                            events.push({
                                title: data[i]["name"],
                                start: data[i]["date"]+'T'+data[i]["start_time"],
                                end: data[i]["date"]+'T'+data[i]["end_time"],
                                color: assignColor(data[i]["location"],data[i]["status"] ), 
                            });
                        }
                        console.log(events);
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar( 'addEventSource', events );             
                    }
                });  
            }
            },
            addEventButton: {
              text: 'Add Availability',
              click: function() {
                $("#input_fullCalModal").modal();
                $("#inputForm").trigger("reset");
                $("#submit").show();
                $("#close").show();
                $("#approve").hide();
                $("#reject").hide();
                $("#created").text('');
                $("reqID").text('');
                $('#submit').on('click', function() {
                    var enteredDate = $('#input_date').val();
                    var enteredStartTime = $('#input_starttime').val();
                    var enteredEndTime = $('#input_endtime').val();
                    var eventStatus = $('input[name=status]:checked').val(); 
                    var eventColor = assignColor($('#location').val(),eventStatus ); 
                    var eventBreakTime = $("#breaktime option:selected").val();
                    var currentdate = new Date(); 
                    var thistime = (currentdate.getHours() > 12) ? (currentdate.getHours()-12 + ':' + currentdate.getMinutes() +' PM') : (currentdate.getHours() + ':' + currentdate.getMinutes() +' AM');
                    var created = (currentdate.getMonth()+1)  + "/"
                                +  currentdate.getDate() + "/" 
                                + currentdate.getFullYear() + " @ "  
                                + thistime;
                    // start format : 2018-11-01T6:00:00,  color: '#257e4a'
                    $.ajax({
                        type: "POST",
                        url: "./data-ops/dataCreate.php",
                        data: { 
                            name: $('#input_name').val(),
                            location:$('#location').val() ,
                            date:enteredDate,
                            starttime:enteredStartTime ,
                            endtime : enteredEndTime,
                            breaktime: eventBreakTime ,
                            status: eventStatus,
                            created: created
                        },
                        success: function(result){
                            alert(result);
                            $('#calendar').fullCalendar('renderEvent', {
                                title: $('#input_name').val() ,
                                date:enteredDate,
                                start: enteredDate+'T'+enteredStartTime ,
                                end: enteredDate+'T'+enteredEndTime,
                                color: eventColor,
                                status : eventStatus,
                                breaktime : eventBreakTime,
                                location: $("#location option:selected").val(),
        
                            }); 
                            
                            setTimeout(function(){// wait for 5 secs(2)
                                    location.reload(); // then reload the page.(3)
                            }, 1000); 
                        }
                    }); 
                    $("#inputForm").trigger("reset");

                });
              }
            },
          }
    })
    
    function assignColor(location,eventStatus)
    {
        var color ='';
        if(eventStatus == 'draft')
        {
            color= '#dcdcdc';
        }
        else if(location == 'front_counter_phones')
        {
           color = '#257e4a';
        }
        else if(location == 'database_development')
        {
            color = '#00FFFF';
        }
       
        return color
    }
    $('#admin').click(function() {
        console.log('admin');
        window.location.href = './admin-console/admin-console.php';
        return false;
    });
});