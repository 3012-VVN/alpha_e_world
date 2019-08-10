<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$quote = [
    "Finance is not merely about making money. It's about achieving our deep goals and protecting the fruits of our labor. It's about stewardship and, therefore, about achieving the good society.",
    "A budget tells us what we can't afford, but it doesn't keep us from buying it.",
    "Beware of little expenses. A small leak will sink a great ship.",
];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan < 3 || $email != 1) {
    header('Location: Login');
}

$page = "adminuseraclist";
include "./common/header.php";
include "./common/sidebar.php";
?>

<link href='../assets/css/fullcalendar.min.css' rel='stylesheet' />
<link href='../assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />



<div class="content">
    <div id='calendar' style="background-color: white;padding: 10px;">
        <table id="myTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>PAN(for India)</th>
                    <th>Document Type</th>
                    <th>Document no</th>
                    <th>Bank Name</th>
                    <th>Bank acc</th>
                    <th>Holder name</th>
                    <th>IFSC Code(for India)</th>
                    <th>IBan</th>
                    <th>View Document</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
$checksql = "SELECT username,pancard,cardtype,adharcard,bankname,accno,accname,ifsccode,swiftcode,Users.ID FROM `kycdetails` JOIN Users on Users.ID= kycdetails.userid and kycdetails.status=0";
//$checksql = "Select * from Users";
$checkrst = mysqli_query($con, $checksql);
while ($row = mysqli_fetch_assoc($checkrst)) {
    $uid = $row['ID'];
    if ($row['plan'] == 1) {
        $rate = 100;
    } else if ($row['plan'] == 2) {
        $rate = 1000;
    } else if ($row['plan'] == 3) {
        $rate = 10000;
    }
    if (intval($row['status']) > 0) {
        $active1 = "checked";
    } else {
        $active1 = "";
    }
    ?>
                <tr>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['pancard'];?></td>
                    <td><?php echo $row['cardtype'];?></td>
                    <td><?php echo $row['adharcard'];?></td>
                    <td><?php echo $row['bankname'];?></td>
                    <td><?php echo $row['accno'];?></td>
                    <td><?php echo $row['accname'];?></td>
                    <td><?php echo $row['ifsccode'];?></td>
                    <td><?php echo $row['swiftcode'];?></td>
                    <td><a href="javascript:showMe('<?php echo $row['ID']; ?>')"><img src="/img/document_search.png" style="width: 20px;"></a></td>
                    <td><a href="javascript:showMe1('<?php echo $row['ID']; ?>')" id='ab<?php echo $row['ID']; ?>'>Approve</a></td>
                    <td><a href="javascript:showMe2('<?php echo $row['ID']; ?>')" id='abc<?php echo $row['ID']; ?>'>Resubmit Document</a></td>
                </tr>
                    <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php include "./common/footer1.php";?>
</div>
</div>

        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" style="background-color: #00000047;    color: black;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View User Submitted Document</h5>
        <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mmbody">

        <p>Loading Data</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include "./common/footer.php";?>
<script src='../assets/js/moment.min.js'></script>
<script src='../assets/js/jquery.min.js'></script>
<script src='../assets/js/fullcalendar.min.js'></script>
<script src='//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
$(document).ready( function () {
    $('#myTable').DataTable();
  setTimeout(activate,1000);

  $(".closemodal").click(function(){
    $(".modal").hide();
  });
});

function activate()
{
    console.log('activete');
    $('.uact').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });

    $('.uact').change(function() {
     // $('#console-event').html('Toggle: ' + $(this).prop('checked'));
     var bool1=0;
    // console.log('activete',$(this).attr('data-id')+ $(this).prop('checked'));
     if ($(this).prop('checked')){
        bool1=1;
     }else {
        bool1=0;
     }

     $.post( "/UpadteAccount", {uid: $(this).attr('data-id'),bool: bool1 })
        .done(function( data ) {
            alert(data );
        });
    })
}

function showMe(id)
{
    $(".modal").show();
    $("#mmbody").html("<p>Loading Data</p>");
    $.post( "/GetDoc", {uid: id })
        .done(function( data ) {
            $("#mmbody").html(data);
        });
}

function showMe1(id)
{
    $("#ab"+id).hide();
    $.post( "/GetDoc1", {uid: id })
        .done(function( data ) {
            alert(data);
        });
}

function showMe2(id)
{
    $("#abc"+id).hide();
    $.post( "/GetDoc1", {uid: id ,status:3})
        .done(function( data ) {
            alert(data);
        });
}
</script>
<style>
 .dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5em;
    border-style: solid;
    border-color: #65615a;
    border-width: 1px;
}
</style>