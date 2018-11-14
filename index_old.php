<html>
    <head>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script>
        function insertData() {
            $.ajax({
                type: "POST",
                url: "./dataops.php",
                data: { 
                    id: $('#reqID').val(),
                    name: $('#input_name').val(),
                    location:$('#location').val() ,
                    date:$('#input_date').val(),
                    starttime:$('#input_starttime').val() ,
                    endtime : $('#input_endtime').val(),
                    breaktime: $("#breaktime option:selected").val() ,
                    status: $('input[name=status]:checked').val() 
                },
                success: function(result){
                    alert(result);
                }
            })  
        }
        function getData(){
            $.ajax({
                url: './dataops.php',   
                type: "GET",
                data: { 
                    name: "swapnil", // to send data to php function 
                },
                success: function(result)         
                {
                   // alert (result);
                    var data = $.parseJSON(result);
                    $('#input_name').val(data[0]["name"]);
                    $("#location").val(data[0]["location"]);
                    $("#breaktime").val(data[0]["break_time"]);
                    $('input:radio[name="status"][value="'+data[0]["status"]+'"]').attr('checked', true);
                    $('#input_date').val(data[0]["date"]);
                    $('#input_starttime').val(data[0]["start_time"]);
                    $('#input_endtime').val(data[0]["end_time"]);
                } 
            })
        }
    </script>
    </head>
    <body>
<form action="" method="">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter Your Availability</h4>
        </div>
        <div class="modal-body">
            <form id="inputForm">
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">ID</label>
                </div>
                <div class="col-md-9">
                    <label class="control-label" id="reqID">12345</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Your Name<span class="required">*</span></label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="input_name" name="input_name" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Location<span class="required">*</span></label>
                </div>
                <div class="col-md-9">
                    <select id= "location" name ="location" class="form-control" >
                        <option value="front_counter_phones">Front Counter Phones</option>
                        <option value="test_center_duties">Test Center Duties</option>
                        <option value="emails">Emails</option>
                        <option value="scanning">Scanning</option>
                        <option value="social_media">Social Media</option>
                        <option value="document_processing">Document Processing</option>
                        <option value="office_support">Office Support</option>
                        <option value="rise">Rise</option>
                        <option value="database_development">Database Development</option>
                        <option value="non-resident_emails">Non-Resident Emails</option>
                        <option value="training">Training</option>
                        <option value="meeting">Meeting</option>
                        <option value="campus_closed">Campus Closed</option>
                        <option value="graphics_design">Graphics Design</option>
                        <option value="sick_absent">Sick/Absent</option>
                        <option value="tour">Tour</option>
                        <option value="rise_tutoring">Rise Tutoring</option>
                        <option value="photo_id">Photo ID</option>
                    </select> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Date<span class="required">*</span></label>
                </div>
                <div class="col-md-9">
                    <input type="date" id="input_date" name="input_date" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Start Time<span class="required">*</span></label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="input_starttime" name="input_starttime" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">End Time<span class="required">*</span></label>
                </div>
                <div class="col-md-9">
                    <input type="text" id="input_endtime" name="input_endtime" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Break</label>
                </div>
                <div class="col-md-9">
                    <select id= "breaktime" name= "breaktime" class="form-control" >
                        <option value="30mins">30 Mins</option>
                        <option value="60mins">60 Mins</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Status</label>
                </div>
                <div class="col-md-9">
                    <label class="radio-inline"><input type="radio" name="status" id="status" checked value="draft">Draft</label>
                    <label class="radio-inline"><input type="radio" name="status" id="status" value="active">Active</label>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id= "close">Close</button>
            <button type="submit" value="submit" id="submit" class="btn btn-primary" onclick="insertData()">Submit</button>
            <button type="button" value="get" id="get" class="btn btn-primary" onclick="getData()" >Get</button>
            <button class="btn btn-danger" data-dismiss="modal" id="reject">Reject</button>
        </div>
        </div>
    </div>
</form>
</body>
</html>
