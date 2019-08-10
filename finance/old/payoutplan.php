<?php

include "helper/header.php";
include "helper/config.php";

$email =  $_SESSION['userid'];

$quote = [
  "Finance is not merely about making money. It's about achieving our deep goals and protecting the fruits of our labor. It's about stewardship and, therefore, about achieving the good society.",
  "A budget tells us what we can't afford, but it doesn't keep us from buying it.",
  "Beware of little expenses. A small leak will sink a great ship."
];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan <3)
{
  header('Location: Login');
}

$page = "payoutplan";
include "./common/header.php";
include "./common/sidebar.php";
?>

<link href='../assets/css/fullcalendar.min.css' rel='stylesheet' />
<link href='../assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />



      <div class="content">
      <div id='calendar' style="background-color: white;
    padding: 10px;"></div>
      </div>
      <?php include "./common/footer1.php";?>
    </div>
  </div>
<?php include "./common/footer.php";?>

 <!-- Modal -->
 <div class="modal" tabindex="-1" role="dialog" style="background-color: #00000047;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:black;">Referal Details</h5>
        <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mmbody" style="    color: black;">

        <p>Loading Data</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script src='../assets/js/moment.min.js'></script>
<script src='../assets/js/jquery.min.js'></script>
<script src='../assets/js/fullcalendar.min.js'></script>
<script>

$(document).ready( function () {

  $(".closemodal").click(function(){
    $(".modal").hide();
  });
});

function showMe(date)
{
    $(".modal").show();
    $("#mmbody").html("<p>Loading Data</p>");
    $.post( "/GetLevelDetail", {date: date })
        .done(function( data ) {
            $("#mmbody").html(data);
        });
}
  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
      },

      // customize the button names,
      // otherwise they'd all just say "list"
      views: {
        listDay: { buttonText: 'list day' },
        listWeek: { buttonText: 'list week' }
      },

      defaultView: 'month',
      defaultDate: '<?php echo date('Y-m-d');?>',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        <?php 
          $checksql = "Select * from payourplan where `userid`='$email'";
          //$checksql = "Select * from Users";
          $checkrst = mysqli_query($con, $checksql);
          while ($row = mysqli_fetch_assoc($checkrst)) {
            //$date = date('Y-m-d',intval($row['date']));
            $date = $row['sdate'];
            $amount=$row['amount'];
            $topid= $row['planid'];
            if ($row['planid']==0) {
                echo "{
            title: 'Daily: $amount',
            start: '$date'
          },";
            }else {
              echo "{
                title: 'TopID $topid, Daily: $amount',
                start: '$date'
              },";
            }
            //$date1 = date('Y-m-d',intval($row['date']));
            /*$checksql = "Select SUM(Level) as amount from LevelBonus where `userid`='$email' and Date='$date'";
            //$checksql = "Select * from Users";
            $checkrst1 = mysqli_query($con, $checksql);
            while ($row = mysqli_fetch_assoc($checkrst1)) {
              $amount=$row['amount'];
              if ($amount>0) {
                  echo "{
                    title: 'Level: $amount',
                    start: '$date'
                  },";
              }
            }*/
          }

          $sql="SELECT sum(Level) as amount,Date FROM `LevelBonus` where `userid`='$email' GROUP by Date";
          $checkrst1 = mysqli_query($con, $sql);
            while ($rowq = mysqli_fetch_assoc($checkrst1)) {
              $amount=$rowq['amount'];
              if ($amount>0) {
                $date = $rowq['Date'];
                $date1 = '"'.$date.'"';
                  echo "{
                    url: 'javascript:showMe($date1)',
                    title: 'Level: $amount',
                    start: '$date'
                  },";
              }
            }
          
            $sql="SELECT sum(Amount) as total,Date FROM `userpaid` where `userid`='$email' GROUP by Date";
            $checkrst1 = mysqli_query($con, $sql);
              while ($rowq = mysqli_fetch_assoc($checkrst1)) {
                $amount=$rowq['total'];

                $amount = $amount - ($amount*(5/100));
                if ($amount>0) {
                  $date = $rowq['Date'];
                    echo "{
                      title: 'Paid: $amount',
                      start: '$date'
                    },";
                }
              }
            
          

        ?>
      ]
    });

  });
/*{
          title: 'All Day Event',
          start: '2019-01-01'
        },
        {
          title: 'Long Event',
          start: '2019-01-07',
          end: '2019-01-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-01-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-01-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-01-11',
          end: '2019-01-13'
        },
        {
          title: 'Meeting',
          start: '2019-01-12T10:30:00',
          end: '2019-01-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-01-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-01-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-01-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-01-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-01-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-01-28'
        }
        */
</script>

<style>
  .fc-event-time, .fc-event-title ,.fc-title{
padding: 0 1px !important;
white-space: normal !important;
}
.fc-event, .fc-event-dot {
    background-color: #3a87ad40 !important;
}

</style>