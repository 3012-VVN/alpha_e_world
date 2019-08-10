<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Title</title>
</head>

<body>
    <div>
        <div class="row">
            <div class="col-xs-12">
                <!-- tabs -->
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs" style="height: 320px;">
                        <li class="active"><a href="#home" data-toggle="tab">Card Payment</a></li>
                        <li><a href="#about" data-toggle="tab">Bank Transfer</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <h3 class="card-title">Enter Your Card Details</h3>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-name">Name on card</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder=""
                                                required>
                                            <small class="text-muted">Full name as displayed on card</small>
                                            <div class="invalid-feedback">
                                                Name on card is required
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-number">Credit card number</label>
                                            <input type="text" class="form-control" id="cc-number" placeholder=""
                                                required>
                                            <div class="invalid-feedback">
                                                Credit card number is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-expiration">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration" placeholder=""
                                                required>
                                            <div class="invalid-feedback">
                                                Expiration date required
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-expiration">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Security code required
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to
                                        checkout</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="about">

                            <h3 class="card-title">Bank details</h3>


                            <p>Bank Name: <span style="font-weight: bold;">SOCIETE GENERALE BANKA SRBIJA
                                    AD</span><br>
                                Account no. <span style="font-weight: bold;">275002022316677422</span><br>
                                Swift Code: <span style="font-weight: bold;">SOGYRSBG</span><br>
                                Branch: <span style="font-weight: bold;">Požarevac</span>

                            </p>
                            <h6 class="card-title">Bank Transfer Details</h6>

                            <input type="file" placeholder="Transaction Deatils" name='recipt'>


                            <p style="margin-top: 80px;font-size: 10px;">Please update your payment details by uploading
                                the payment receipt.</p>

                        </div>
                    </div>
                </div>
                <!-- /tabs -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
    .tabs-left>.nav-tabs {
        border-bottom: 0;
    }

    .tab-content>.tab-pane,
    .pill-content>.pill-pane {
        display: none;
    }

    .tab-content>.active,
    .pill-content>.active {
        display: block;
    }

    .tabs-left>.nav-tabs>li {
        float: none;
    }

    .tabs-left>.nav-tabs>li>a {
        min-width: 74px;
        margin-right: 0;
        margin-bottom: 3px;
    }

    .tabs-left>.nav-tabs {
        float: left;
        margin-right: 19px;
        border-right: 1px solid #ddd;
    }

    .tabs-left>.nav-tabs>li>a {
        margin-right: -1px;
        -webkit-border-radius: 4px 0 0 4px;
        -moz-border-radius: 4px 0 0 4px;
        border-radius: 4px 0 0 4px;
    }

    .tabs-left>.nav-tabs>li>a:hover,
    .tabs-left>.nav-tabs>li>a:focus {
        border-color: #eeeeee #dddddd #eeeeee #eeeeee;
    }

    .tabs-left>.nav-tabs .active>a,
    .tabs-left>.nav-tabs .active>a:hover,
    .tabs-left>.nav-tabs .active>a:focus {
        border-color: #ddd transparent #ddd #ddd;
        *border-right-color: #ffffff;
    }
    </style>
</body>

</html>