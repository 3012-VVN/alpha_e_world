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
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Nav Tab left Side </h3>
                <!-- tabs -->
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                        <li><a href="#about" data-toggle="tab">About</a></li>
                        <li><a href="#services" data-toggle="tab">Services</a></li>
                        <li><a href="#contact" data-toggle="tab">Contact</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="">
                                <h1>Home Tab</h1>
                                <p>These lists are meant to identify articles which deserve editor attention because
                                    they are the most important for an encyclopedia to have, as determined by the
                                    community of participating editors. They may also be of interest to readers as
                                    an alternative to lists of overview articles.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="about">
                            <div class="">
                                <h1>About Tab</h1>
                                <p>because they are the most important for an encyclopedia to have, as determined by
                                    the community of participating editors. They may also be of interest to readers
                                    as an alternative to lists of overview articles.</p>
                            </div>
                        </div>

                        <div class="tab-pane" id="services">
                            <div class="">
                                <h1>Services Tab</h1>
                                <p>meant to identify articles which deserve editor attention because they are the
                                    most important for an encyclopedia to have, as determined by the community of
                                    participating editors. They may also be of interest to readers as an alternative
                                    to lists of overview articles.</p>
                            </div>
                        </div>

                        <div class="tab-pane" id="contact">
                            <div class="">
                                <h1>Contact Tab</h1>
                                <p>deserve editor attention because they are the most important for an encyclopedia
                                    to have, as determined by the community of participating editors. They may also
                                    be of interest to readers as an alternative to lists of overview articles.</p>
                            </div>
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