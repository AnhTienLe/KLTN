<?php
include('dbcon.php');
$query = $conn->query("SELECT * FROM events ORDER BY id");
?>
  <script>
    $(document).ready(function() {
     var calendar = $('#calendar').fullCalendar({
      editable:true,
      header:{
       left:'prev,next today',
       center:'title',
       right:'month,agendaWeek,agendaDay'
      },
      events: [<?php while ($row = $query ->fetch_object()) { ?>{ id : '<?php echo $row->id; ?>', title : '<?php echo $row->title; ?>', start : '<?php echo $row->start_event; ?>', end : '<?php echo $row->end_event; ?>', }, <?php } ?>],
      selectable:true,
      selectHelper:true,
      select: function(start, end, allDay)
      {
      var title = prompt("Enter Event Title");
      if(title)
      {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
        url:'insert.php',
        type:"POST",
        data:{title:title, start:start, end:end},
        success:function(data)
        {
          calendar.fullCalendar('refetchEvents');
          alert("Added Successfully");
          window.location.replace("quantri.php?page_layout=event");
        }
        })
      }
      },
 
      editable:true,
      eventResize:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
        }
      })
      },
 
      eventDrop:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()
        {
        calendar.fullCalendar('refetchEvents');
        alert("Event Updated");
        }
      });
      },
 
      eventClick:function(event)
      {
      if(confirm("Are you sure you want to remove it?"))
      {
        var id = event.id;
        $.ajax({
        url:"delete.php",
        type:"POST",
        data:{id:id},
        success:function()
        {
          calendar.fullCalendar('refetchEvents');
          alert("Event Removed");
          window.location.replace("quantri.php?page_layout=event");
        }
        })
      }
      },
 
    });
  });
</script>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="quantri.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
        <li class="active"></li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Lên lịch sự kiện</h1>
    </div>
</div><!--/.row-->

<div class="row">
    
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="response"></div>
        <div id='calendar'></div>
        </div>
    </div>
</div>