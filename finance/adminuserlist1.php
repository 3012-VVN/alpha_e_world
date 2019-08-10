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
if ($plan < 3 || ($email != 1 && $email != 2)) {
    header('Location: Login');
}
$qq = '';
if ($email == 1 || $email == 2) {
    $qq = " and Users.`joinid`='$email'";
}

$page = "admintopuplist";
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
                    <th>Name</th>
                    <th>User ID</th>
                    <th>TopUp Date</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Plan</th>

                    <th>View Payment</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
//---------TopUp
$checksql = "Select Users.firstname,Users.lastname,Users.email,Users.mobile,Users.joindate,topup.date,topup.amount,topup.ID,Users.username,topup.userid from topup join Users on topup.userid=Users.ID where topup.step=2" . $qq;
//$checksql = "Select * from Users";
$checkrst = mysqli_query($con, $checksql);
while ($row = mysqli_fetch_assoc($checkrst)) {
    $uid = $row['ID'];
    ?>
                <tr>
                    <td><a
                            href="/UserDetails?id=<?php echo $row['userid']; ?>"><?php echo $row['firstname'] . " " . $row['lastname']; ?></a>
                    </td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo number_format(intval($row['amount'])); ?></td>
                    <td style=" text-align: center;"><a href="javascript:showMe(<?php echo $uid; ?>)"><img
                                src="/img/document_search.png" style="width: 20px;"></a></td>
                    <td><a href="javascript:ActivateUser(<?php echo $uid; ?>)" id="a<?php echo $uid; ?>">Approve
                            TopUp</a></td>
                    <td><a href="javascript:ActivateUser1(<?php echo $uid; ?>)" id="ab<?php echo $uid; ?>">Resubmit
                            Payment Detail</a></td>
                </tr>
                <?php
}
?>
            </tbody>
        </table>
    </div>
</div>
<?php include "./common/footer1.php";?>
</div>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" style="background-color: #00000047;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;">View User Submitted Document</h5>
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
$(document).ready(function() {
    $('#myTable').DataTable({
        "order": [
            [2, "desc"]
        ]
    });
    setTimeout(activate, 1000);

    $(".closemodal").click(function() {
        $(".modal").hide();
    });
});

function activate() {
    console.log('activete');
    $('.uact').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
    });

    $('.uact').change(function() {
        // $('#console-event').html('Toggle: ' + $(this).prop('checked'));
        var bool1 = 0;
        // console.log('activete',$(this).attr('data-id')+ $(this).prop('checked'));
        if ($(this).prop('checked')) {
            bool1 = 1;
        } else {
            bool1 = 0;
        }

        $.post("/ActUser", {
                uid: $(this).attr('data-id'),
                bool: bool1
            })
            .done(function(data) {
                alert(data);
            });
    })
}

function ActivateUser(id) {
    $("#a" + id).hide();
    $.post("/ApproveTopUp", {
            uid: id
        })
        .done(function(data) {
            alert(data);
        });
}

function ActivateUser1(id, bool1) {
    $("#ab" + id).hide();
    $.post("/GetDoc2", {
            uid1: id
        })
        .done(function(data) {
            alert(data);
        });
}

function showMe(id) {
    $(".modal").show();
    $("#mmbody").html("<p>Loading Data</p>");
    $.post("/GetSubmittedData1", {
            uid: id
        })
        .done(function(data) {
            $("#mmbody").html(data);
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