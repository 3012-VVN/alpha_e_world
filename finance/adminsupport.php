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

$page = "adminsupport";
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

                    <th>subject</th>
                    <th>Query</th>
                    <th>Reply</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
$checksql = "Select * from `support` where `userid`!='$email'" . $qq;
//$checksql = "Select * from Users";
$checkrst = mysqli_query($con, $checksql);
while ($row = mysqli_fetch_assoc($checkrst)) {
    $uid = $row['userid'];
    $checksql = "Select * from Users where `ID`='$uid'" . $qq;
    $checkrst1 = mysqli_query($con, $checksql);

    $row1 = mysqli_fetch_assoc($checkrst1)
    ?>
                <tr>
                    <form method="POST" action="/SubmitQuery">
                        <td><?php echo $row1['firstname'] . " " . $row1['lastname']; ?></td>
                        <td><?php echo $row1['username']; ?></td>


                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['query']; ?></td>
                        <td>
                            <input type="hidden" name="subject" value="<?php echo $row['subject']; ?>">
                            <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                            <input type="hidden" name="replyid" value="<?php echo $row['ID']; ?>">
                            <textarea name="reply"></textarea>
                        </td>
                        <td>
                            <input type="submit" value="Reply">
                        </td>
                    </form>
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
<div class="modal" tabindex="-1" role="dialog" style="background-color: #00000047;">
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
$(document).ready(function() {
    $('#myTable').DataTable();
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

function showMe(id) {
    $(".modal").show();
    $("#mmbody").html("<p>Loading Data</p>");
    $.post("/GetSubmittedData", {
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