<html>
    <head>
        <!-- Full calender scripts and css-->
        <link rel='stylesheet' href='./fullcalendar-3.9.0/fullcalendar.css' />
        <script src='./fullcalendar-3.9.0//lib/jquery.min.js'></script>
        <script src='./fullcalendar-3.9.0/lib/moment.min.js'></script>
        <script src='./fullcalendar-3.9.0/fullcalendar.js'></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.print.css " rel="stylesheet" type="text/css" media="print" />
        <!---->
        <!--Bootstrap scripts and css-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!---->
      
        <script src="./script.js"></script>
        <link rel="stylesheet" src= './style.css'/>
    </head>
    <body>
        <form method="post" action="dataExport.php">
            <input  type="submit" name="export" class="btn btn-success" value="Export" />
        </form>
        <div id='calendar'></div>  
        <!-- <input type="submit" name="print" class="btn btn-success hidden-print" value="print" id= "printBtn"/> -->
        <div class="modal fade" id="input_fullCalModal" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" id='modal-title'>Enter Your Availability</h4>
                    </div>
                    <div class="modal-body">
                        <form id="inputForm">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">ID</label>
                            </div>
                            <div class="col-md-9">
                                <label class="control-label" id="reqID"></label>
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
                                <select id= "location" class="form-control" >
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
                                <input type="time" id="input_starttime" name="input_starttime" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">End Time<span class="required">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="time" id="input_endtime" name="input_endtime" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Break</label>
                            </div>
                            <div class="col-md-9">
                                <select id= "breaktime" class="form-control" >
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
                        <div class="row">
                            <div class="col-md-9">
                                <label class="control-label" id="created" class="created" name="created" style="font-weight: normal; font-size: x-small;"></label>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" id= "close">Close</button>
                      <button class="btn btn-primary" data-dismiss="modal" id="submit">Submit</button>
                      <button class="btn btn-primary" data-dismiss="modal" id="approve">Approve</button>

                      <button class="btn btn-danger" data-dismiss="modal" id="reject">Reject</button>
                    </div>
                  </div>
                  
                </div>
              </div>
              
            </div>
    </body>
</html>