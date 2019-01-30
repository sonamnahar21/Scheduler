 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
//    var dataTable = $('#user_data').DataTable({
//     "processing" : true,
//     "serverSide" : true,
//     "order" : [],
//     "ajax" : {
//      url:"fetch.php",
//      type:"POST"
//     }
//    });


   var oTable = $('#user_data').DataTable({
    "oLanguage": {
      "sSearch": "Filter Data"
    },
    "iDisplayLength": -1,
    "sPaginationType": "full_numbers",
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
  
 });
