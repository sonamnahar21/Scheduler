<html>
 <head>
  <title>Live Add Edit Delete Datatables Records using PHP Ajax</title>
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script> 
  
  
  

  
  <script src="./script.js"></script>

  
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
 </head>
 <body>
  <div class="container box">
  <!-- From : <input type="date" id= "fromdate">
  To <input type="date" id= "todate">
  <input  type="submit" name="filter" id= "filter" class="btn btn-success" value="filter" /> -->

   <div class="table-responsive">
   <br />
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>ID</th>
       <th>Name</th>
       <th>Location</th>
       <th>Date</th>
       <th>Start Time</th>
       <th>End Time</th>
       <th>Approved by Admin</th>
       <th>Confirmed by Student</th>
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>

