<html>
 <head>
  <title>Live Add Edit Delete Datatables Records using PHP Ajax</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
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
  <div class="divFilter">
        From: <input type="date" id="min" name="min">
        To: <input type="date" id="max" name="max">
        <button type="button" name="add" id="add" class="btn btn-info">Show</button>
    </div>
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
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
    var  data = {id:id, column_name:column_name, value:value};
    console.log('id: '+data.id + data.column_name + data.value);
    $.ajax({
    url:"update.php",
    method:"POST",
    data:data,
    success:function(data)
    {
    console.log( 'success'+data.id);
    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    },
    error: function(data)
    {
        console.log('fail'+data);
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   console.log('id: ', id)
   update_data(id, column_name, value);
    

  });
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
//   $(document).on('click', '#add', function(){
//     //   console.log('clicked');
//     //   var min = new Date($('#min').val()).valueOf();  
//     //   var max =new Date($('#max').val()).valueOf();
//     //   console.log(min +"   "+ max);
//     var  data = {from_date:'2018-11-27', to_date:'2018-12-05'};
//     $('#user_data').DataTable().destroy();
//     var dataTable = $('#user_data').DataTable({
//         "processing" : true,
//         "serverSide" : true,
//         "order" : [],
//         "ajax" : {
//         url:"filter.php",
//         type:"POST",
//         data: data
//         }
//     });
//   })
  $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        console.log(new Date(d).valueOf());

        var min = new Date($('#min').val()).valueOf();  //;
        var max =new Date($('#max').val()).valueOf();
        var testdate = new Date(data[3]).valueOf(); // use data for the age column

        if(isNaN( min ) && isNaN( max)) { return true;}
        if(min<=testdate && testdate<=max)
        {
            return true;
        }

        return false;
    }
);
 });
</script>