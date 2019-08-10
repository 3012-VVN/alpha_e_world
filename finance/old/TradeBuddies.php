<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];


$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan <3)
{
  header('Location: Login');
}

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
    //header('Location: Login');
}

$page = "TradeBuddies";
include "./common/header.php";
include "./common/sidebar.php";

$name = $UserInfo['firstname']." ".$UserInfo['lastname'];

if (isset($_REQUEST['uid']))
{
    $unique = $_REQUEST['uid'];
    echo $checksql = "Select * from Users where `joinkey`='$unique'";
    $checkrst = mysqli_query($con, $checksql);
    $UserInfo1 = mysqli_fetch_assoc($checkrst);

    $email = $UserInfo1['ID'];

    $name1 = $name = $UserInfo1['firstname']." ".$UserInfo1['lastname'];
}else {
    $name1="My";
}

function getTree($con,$email,$mainid)
{
    $checksql = "Select * from Users where `referalcode`='A00$email'  ORDER BY `Users`.`leafno` ASC";
    $checkrst = mysqli_query($con, $checksql);
    $li="<ul>";
    while($tokenrow = mysqli_fetch_assoc($checkrst)){
        $id= $tokenrow['ID'];
        $checksql1 = "Select * from Users where `referalcode`='A00$id'";
        $checktokenrst1 = mysqli_query($con, $checksql1);

        $UserInfo2 = mysqli_fetch_assoc($checktokenrst1);
        $tokenrow1 = mysqli_num_rows($checktokenrst1);
        if($tokenrow1==0)
        {
            $jj= '{"icon":"/images/leaf.png"}';
        }else {
            $jj= '{"icon":"/images/tree.png"}';
        }
        if ($mainid==1) {
            $li .= "<li data-jstree='".$jj."'>".$tokenrow['firstname']." ".$tokenrow['lastname']." (<span style='font-weight:bold;color:blue;'>".$tokenrow['username']."</span>) Leaf no.".$tokenrow['leafno']." Parent ".$tokenrow['referalcode'];
        }else {
          $li .= "<li data-jstree='".$jj."'>".$tokenrow['firstname']." ".$tokenrow['lastname']." (<span style='font-weight:bold;color:blue;'>".$tokenrow['username'];
        }
        if ($tokenrow1>0) {
            $mytree = getTree($con,$id);
            $li.= $mytree;
        }
        $li .= '</li>';
    }
    return $li."</ul>"; 
}
?>

<link href='../assets/css/fullcalendar.min.css' rel='stylesheet' />
<link href='../assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />



<div class="content">
<div id='calendar' style="background-color: white;padding: 10px;">
<div class="card-header" style="    padding: 0 0;
    background-color: white;">
                <h5 class="card-title" ><?php echo $name1;?> Trade Buddies</h5>
              </div>
 <div id="jstree">
    <!-- in this example the tree is populated from inline HTML -->
    <ul>
        
      <li data-jstree='{"icon":"/images/tree.png"}'><?php echo $name; ?>
      <?php
            $mytree = getTree($con,$email);
            echo $mytree;
        ?>
      </li>
    </ul>
  </div>
  
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

  <!-- 5 include the minified jstree source -->
  <script src="dist/jstree.min.js"></script>
  <script>
  $(function () {
    // 6 create an instance when the DOM is ready
    //$('#jstree').jstree('open_all');
    // 7 bind to events triggered on the tree
    $('#jstree').on("changed.jstree", function (e, data) {
      console.log(data.selected);
    });
    // 8 interact with the tree - either way is OK
    //$('button').on('click', function () {
      //$('#jstree').jstree(true).select_node('child_node_1');
      //$('#jstree').jstree('select_node', 'child_node_1');
      //$.jstree.reference('#jstree').select_node('child_node_1');
      $('#jstree').jstree();

      $('#jstree').on('ready.jstree', function() {
            $("#jstree").jstree("open_all");          
        });

    //});
  });
  </script>