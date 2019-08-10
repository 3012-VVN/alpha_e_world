<?php $stitle = "Working Plan";?>

<div class="row">
    <h5 style="    color: white;">Select Your Plan</h5>
</div>
<div class="row">
    <p style="    color: white;">Based on your Requirement Add Pack<span id="val123"
            style="font-size: 20px;font-weight: bold;"> - Total Pack Value 0</span></p>
    <hr>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="javascript:selectplan(1)">
            <div class='planoverq' id="plan1"></div>
        </a>
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-money-coins text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category"></p>
                            <p class="card-title">&euro; 100<p>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-bottom: 0px;">
            <div style="font-size: 20px;height: 30px;">
                <div id="packno1"
                    style="float: left;text-align: center;background-color: #ffffff;width: 50%;font-weight: bold;"> X 0
                </div>
                <a href="javascript:subpack(1)">
                    <div
                        style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 25%;border-left-color: #65615a;border-left-style: solid;border-width: 1px;border-right: none;/* border-left: solid; */border-top: none;border-bottom: none;">
                        -</div>
                </a><a href="javascript:addpack(1)">
                    <div
                        style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 25%;">
                        +</div>
                </a>
            </div>
            <hr style="margin-top: 0px;">
            <div class="card-footer ">

                <div class="stats" style="font-weight: bold;color: black;">
                    <img src="/img/invest.png" style="width: 34px;"> <span id="packno1txt"> 0</span>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="javascript:selectplan(2)">
            <div class='planoverq' id="plan2"></div>
        </a>
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-money-coins text-success"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category"></p>
                            <p class="card-title">&euro; 1000
                                <p>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-bottom: 0px;">
            <div style="font-size: 20px;height: 30px;">
                <div id="packno2"
                    style="float: left;text-align: center;background-color: #ffffff;width: 50%;font-weight: bold;"> X 0
                </div>
                <a href="javascript:subpack(2)">
                    <div
                        style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 25%;border-left-color: #65615a;border-left-style: solid;border-width: 1px;border-right: none;/* border-left: solid; */border-top: none;border-bottom: none;">
                        -</div>
                </a><a href="javascript:addpack(2)">
                    <div
                        style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 25%;">
                        +</div>
                </a>
            </div>
            <hr style="margin-top: 0px;">
            <div class="card-footer ">

                <div class="stats" style="font-weight: bold;color: black;">
                    <img src="/img/invest.png" style="width: 34px;"> <span id="packno2txt"> 0</span>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="javascript:selectplan(3)">
            <div class='planoverq' id="plan3"></div>
        </a>
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-money-coins text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category"></p>
                            <p class="card-title">&euro; 10,000
                                <p>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-bottom: 0px;">
            <div style="font-size: 20px;height: 30px;">
                <div id="packno3"
                    style="float: left;text-align: center;background-color: #ffffff;width: 50%;font-weight: bold;"> X 0
                </div>
                <a href="javascript:subpack(3)">
                    <div
                        style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 25%;border-left-color: #65615a;border-left-style: solid;border-width: 1px;border-right: none;/* border-left: solid; */border-top: none;border-bottom: none;">
                        -</div>
                </a><a href="javascript:addpack(3)">
                    <div
                        style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 25%;">
                        +</div>
                </a>
            </div>
            <hr style="margin-top: 0px;">
            <div class="card-footer ">

                <div class="stats" style="font-weight: bold;color: black;">
                    <img src="/img/invest.png" style="width: 34px;"><span id="packno3txt"> 0</span>
                </div>
            </div>
        </div>
    </div>




</div>

<div class="row">
    <form method="POST" action="/GetPlan">
        <div class="update ml-auto mr-auto">
            <input type="hidden" name="plan" id="splan" value="">
            <input type="hidden" name="qty" value="" id="sqty">
            <button type="submit" class="btn btn-primary btn-round">Proceed</button>
        </div>
    </form>
</div>
<style>
.planover {

    position: absolute;
    background-color: #00000047;
    width: 91%;
    height: 90%;
    border-radius: 12px;
    box-shadow: 0 6px 10px -4px rgba(0, 0, 0, 0.15);
    /* background-color: #FFFFFF; */
    color: #252422;
    margin-bottom: 20px;
    /* position: relative; */
    z-index: 101;
    border: 0 none;
}
</style>
<script>
function selectplan(plan) {
    pack1 = 0;
    pack2 = 0;
    pack3 = 0;
    for (var i = 1; i <= 3; i++) {
        $("#plan" + i).show();
    }
    //$("#plan" + plan).hide();
}
var pack1 = 0;
var pack2 = 0;
var pack3 = 0;

var pack1val = 100;
var pack2val = 1000;
var pack3val = 10000;

function addpack(plan) {
    var val = 0;
    var val1 = 0;

    if (plan == 1) {
        pack1++;
        val = pack1;
        val1 = 100;
    } else if (plan == 2) {
        pack2++;
        val = pack2;
        val1 = 1000;
    } else if (plan == 3) {
        pack3++;
        val = pack3;
        val1 = 10000;
    }

    $("#splan").val(plan);


    if (pack1 >=9)
    {
        pack1 = 9;
    }
    if (pack2 >=9)
    {
        pack2 = 9;
    }
    if (pack3 >=9)
    {
        pack3 = 9;
    }
    if (val>=9)
    {
        val=9;
    }

    var tt = (pack3 * pack3val) + (pack2 * pack2val) + (pack1 * pack1val);
    $("#sqty").val(tt);
    $("#packno" + plan).html("X " + val);
    $("#packno" + plan + "txt").html(val * val1);
    $("#val123").html("- Total Pack Value " + (tt));


}

function subpack(plan) {
    var val = 0;
    var val1 = 0;

    if (plan == 1) {
        pack1--;
        val = pack1;
        val1 = 100;
    } else if (plan == 2) {
        pack2--;
        val = pack2;
        val1 = 1000;
    } else if (plan == 3) {
        pack3--;
        val = pack3;
        val1 = 10000;
    }

    $("#splan").val(plan);
    $("#sqty").val(val);

    if (val >= 0) {

        var tt = (pack3 * pack3val) + (pack2 * pack2val) + (pack1 * pack1val);
        $("#sqty").val(tt);
        $("#packno" + plan).html("X " + val);
        $("#packno" + plan + "txt").html(val * val1);
        $("#val123").html("- Total Pack Value " + (tt));
    } else {
        pack1 = 0;
        pack2 = 0;
        pack3 = 0;
    }

}
</script>