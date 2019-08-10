<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="row">
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">

                <button type="submit" class="btn blue changePlan1" style="margin-bottom: 10px;font-size: 14px;">
                    << Change Plan</button> <h5 class="card-title">Payment Options</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="payment-method">
                            <label for="card" class="method card blue-border">
                            <div class="card-logos">
                                <img src="/visa_logo.png">
                                <img src="/mastercard_logo.png">
                            </div>

                            <div class="radio-input">
                                <input id="card" type="radio" name="payment" checked>
                                Pay € <?php echo $sbamount; ?> with credit card
                            </div>
                            </label>

                            <label for="paypal" class="method paypal">
                            <img src="/bank_icon.png" style="height:30px">
                            <div class="radio-input">
                                <input id="paypal" type="radio" name="payment">
                                Pay € <?php echo $sbamount; ?> with Bank Transfer
                            </div>
                            </label>
                        </div>
                        <div id="pg">
                        <form method="POST" action="/ProcessPayment" enctype="multipart/form-data">
                        <div class="input-fields">
                            <div class="column-1">
                            <label for="cardholder">Cardholder's Name</label>
                            <input type="text" id="holdername" name="holdername">

                            <div class="small-inputs">
                                <div>
                                <label for="date">Valid thru</label>
                                <input type="text" id="date" name="card_exp" placeholder="MM / YYYY" maxlength="7">
                                </div>

                                <div>
                                <label for="verification">CVV / CVC *</label>
                                <input type="password" name="card_cvv" id="verification" maxlength="3">
                                </div>
                            </div>

                            </div>
                            <div class="column-2">
                            <label for="cardnumber">Card Number</label>
                            <input type="text" id="cardnumber" name="cardnumber" maxlength="16">
                            <input type="hidden" value="<?php echo $order_id; ?>" name="order_id" maxlength="16">

                            <span class="info">* CVV or CVC is the card security code, unique three digits number on the back of your card separate from its number.</span>
                            </div>
                        </div>
                        <div class="panel-footer">
      <button class="btn next-btn">Pay Now</button>
    </div>
</form>
</div>

    <div id="banktransfer">
    <form method="POST" action="/SubmitPaymentDetail1" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h6 class="card-title">Bank details</h6>

                                <p>Please update your payment details by uploading the payment receipt.</p>

                                <h7 style="font-weight: bold;">Bank Details</h7>
                                <p>Bank Name: <span style="font-weight: bold;">SOCIETE GENERALE BANKA SRBIJA AD</span><br>
                                    Account no. <span style="font-weight: bold;">275002022316677422</span><br>
                                    Swift Code: <span style="font-weight: bold;">SOGYRSBG</span><br>
                                    Branch: <span style="font-weight: bold;">Požarevac</span>
                            </p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                            <a href="#">Click here to download your invoice</a> 
                            <br>
                                <h6 class="card-title">Bank Transfer Details</h6>
                    </div></div></div>

                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Transaction Deatils</label>
                                <input type="text" class="form-control" placeholder="Transaction Deatils" name='tdetails'>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Transaction date</label>
                                <input type="date" class="form-control" placeholder="Date" name="tdate">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-5 pr-1">
                        <label>OR </label>
                        <label style="    color: black;">Upload Bank Recipt / Transaction Screenshot</label>
                        </div>

                   </div>

                   <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label style='color: orange;'>Add files...</label>
                                <input type="file" class="form-control" placeholder="Transaction Deatils" name='recipt'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">Update</button>
                        </div>
                    </div>
                    </form>
</div>
                    </div>
                </div>
                <!---
                <form method="POST" action="/SubmitPaymentDetail1" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h6 class="card-title">Bank details</h6>

                                <p>Please update your payment details by uploading the payment receipt.</p>

                                <h7 style="font-weight: bold;">Bank Details</h7>
                                <p>Bank Name: <span style="font-weight: bold;">SOCIETE GENERALE BANKA SRBIJA AD</span><br>
                                    Account no. <span style="font-weight: bold;">275002022316677422</span><br>
                                    Swift Code: <span style="font-weight: bold;">SOGYRSBG</span><br>
                                    Branch: <span style="font-weight: bold;">Požarevac</span>
                            </p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header">
                                <h6 class="card-title">Bank Transfer Details</h6>
                    </div></div></div>

                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Transaction Deatils</label>
                                <input type="text" class="form-control" placeholder="Transaction Deatils" name='tdetails'>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Transaction date</label>
                                <input type="date" class="form-control" placeholder="Date" name="tdate">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-5 pr-1">
                        <label>OR </label>
                        <label style="    color: black;">Upload Bank Recipt / Transaction Screenshot</label>
                        </div>

                   </div>

                   <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label style='color: orange;'>Add files...</label>
                                <input type="file" class="form-control" placeholder="Transaction Deatils" name='recipt'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">Update</button>
                        </div>
                    </div>
                    <div class="row" style ="border-width: 0.5px;
                    border-style: solid;
                    border-top: none;
                    border-right: none;
                    border-left: none;
                    border-color: #ececec;
                    "></div>
                    <div class="row">
                        <div class="col-md-5 pr-1">
                        <label>OR </label>
                        <label style="    color: black;">Pay Online</label>
                        </div>
                   </div>
                    </form>
                   <form method="POST" action="/ProcessPayment" enctype="multipart/form-data">
                   <div class="row">
                   <div class="col-md-5 pr-1">
                        <div class="checkout">
                            <div class="sbcard">
                                <div class="front side">
                                <span class="company">
                                    card
                                </span>
                                PAYMENT Card
                                <input type="text" placeholder="Card number" class="cc-num" name = "cardnumber" required />
                                <div> <div style="float: left;">
                                    Expires:
                                    <input type="text" placeholder="MM/YY" class="cc-exp" style="width:70px" name = "card_exp" required />

                                </div>
                                <div style="float: right;">
                                    CVV:
                                    <input type="password" placeholder="CVV" maxlength="3"  name = "card_cvv" required />
                                    </div></div>

                                <div style="clear:both;">
                                    <input type="text" placeholder="Card Holder Name" value="<?php echo $UserInfo['firstname'] . " " . $UserInfo['lastname']; ?>" name = "holdername" required />
                                </div>
                                </div>
                                <div class="back side">
                                <div class="stripe"></div>
                                <div class="signature">
                                    <span class="right">
                                    CVC: <input type="text" placeholder="000" class="cc-cvc" maxlength="4" />
                                    </span>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-4 pr-1">
                    </div>
                   <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">Pay Now</button>
                        </div>
                    </div>
                </form>
-->
            </div>
        </div>
    </div>
</div>
<style>
    *
--- Checkout Panel
*/
.checkout-panel {
  display: flex;
  flex-direction: column;
  width: 940px;
  height: 766px;
  background-color: rgb(255, 255, 255);
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .2);
}

/* Panel Body */
.panel-body {
  padding: 45px 80px 0;
  flex: 1;
}

.title {
  font-weight: 700;
  margin-top: 0;
  margin-bottom: 40px;
  color: #2e2e2e;
}

/* Progress Bar */
.progress-bar {
  display: flex;
  margin-bottom: 50px;
  justify-content: space-between;
}

.step {
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  display: block;
  width: 25px;
  height: 25px;
  margin-bottom: 30px;
  border: 4px solid #fff;
  border-radius: 50%;
  background-color: #efefef;
}

.step:after {
  position: absolute;
  z-index: -1;
  top: 5px;
  left: 22px;
  width: 225px;
  height: 6px;
  content: '';
  background-color: #efefef;
}

.step:before {
  color: #2e2e2e;
  position: absolute;
  top: 40px;
}

.step:last-child:after {
  content: none;
}

.step.active {
  background-color: #f62f5e;
}
.step.active:after {
  background-color: #f62f5e;
}
.step.active:before {
  color: #f62f5e;
}

.step.active + .step {
  background-color: #f62f5e;
}
.step.active + .step:before {
  color: #f62f5e;
}

.step:nth-child(1):before {
  content: 'Delivery';
}
.step:nth-child(2):before {
  right: -40px;
  content: 'Confirmation';
}
.step:nth-child(3):before {
  right: -30px;
  content: 'Payment';
}
.step:nth-child(4):before {
  right: 0;
  content: 'Finish';
}

/* Payment Method */
.payment-method {
  display: flex;
  margin-bottom: 60px;
  justify-content: space-between;
}

.method {
  display: flex;
  flex-direction: column;
  width: 382px;
  height: 122px;
  padding-top: 20px;
  cursor: pointer;
  border: 1px solid transparent;
  border-radius: 2px;
  background-color: rgb(249, 249, 249);
  justify-content: center;
  align-items: center;
}

.blue-border {
  border: 1px solid rgb(110, 178, 251);
}

.card-logos {
  display: flex;
  width: 150px;
  justify-content: space-between;
  align-items: center;
}

.radio-input {
  margin-top: 20px;
}

input[type='radio'] {
  display: inline-block;
}


/* Input Fields */
.input-fields {
  display: flex;
  justify-content: space-between;
}

.input-fields label {
  display: block;
  margin-bottom: 10px;
  color: #b4b4b4;
}

.warning {
  border-color: #f62f5e !important;
}

.info {
  font-size: 12px;
  font-weight: 300;
  display: block;
  margin-top: 50px;
  opacity: .5;
  color: #2e2e2e;
}

div[class*='column'] {
  width: 382px;
}

input[type='text'],
input[type='password'] {
  font-size: 16px;
  width: 100%;
  height: 50px;
  padding-right: 40px;
  padding-left: 16px;
  color: rgba(46, 46, 46, .8);
  border: 1px solid rgb(225, 225, 225);
  border-radius: 4px;
  outline: none;
}

input[type='text']:focus,
input[type='password']:focus {
  border-color: rgb(119, 219, 119);
}

#date { background: url(img/icons_calendar_black.png) no-repeat 90%; }
#cardholder { background: url(img/icons_person_black.png) no-repeat 95%; }
#cardnumber { background: url(img/icons_card_black.png) no-repeat 95%; }
#verification { background: url(img/icons_lock_black.png) no-repeat 90%; }

.small-inputs {
  display: flex;
  margin-top: 20px;
  justify-content: space-between;
}

.small-inputs div {
  width: 182px;
}

/* Panel Footer */
.panel-footer {
  display: flex;
  width: 100%;
  height: 96px;
  padding: 0 80px;
  /*background-color: rgb(239, 239, 239);*/
  justify-content: space-between;
  align-items: center;
}

/* Buttons */
.btn {
  font-size: 16px;
  width: 163px;
  height: 48px;
  cursor: pointer;
  transition: all .2s ease-in-out;
  letter-spacing: 1px;
  border: none;
  border-radius: 23px;
}

.back-btn {
  color: #f62f5e;
  background: #fff;
}

.next-btn {
  color: #fff;
  background: #f62f5e;
}

.btn:focus {
  outline: none;
}

.btn:hover {
  transform: scale(1.1);
}
    </STYLE>

    <script>
        function bankfun()
        {
            console.log("bankfun")
        }

        function pgfun()
        {
            console.log("pgfun")
        }

        $(document).ready(function(){
            $("#pg").show();
           $("#banktransfer").hide();
        $('#card').click(function(){
           $("#pg").show();
           $("#banktransfer").hide();
        });

        $('#paypal').click(function(){
            $("#pg").hide();
           $("#banktransfer").show();
        });
    });
        </script>