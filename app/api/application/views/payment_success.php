
<link href="/css/styles-vendor.min.css" rel="stylesheet" />
<link href="/css/styles-custom.min.css" rel="stylesheet" />
<style>
    .navbar-toggle-support-center {
        border-color: #fff!important;
    }

    .navbar-inverse-support-center {
        background-color: #51ad96;
        border: 0;
    }

    .navbar-inverse-support-center .navbar-nav>li {
        height: 100%;
    }

    .navbar-inverse-support-center .navbar-nav>li>a {
        padding: 0;
        text-align: center;
        font: 400 18px/18px Arial,Helvetica,sans-serif;
        color: #FFF;
        border-color: #FFF;
        -webkit-transition: color .8s ease,border-color .8s ease;
    }

    footer>div>ul>li>a,li.content>a {
        -webkit-transition: color .5s ease;
        text-decoration: none;
    }

    .navbar-inverse-support-center .navbar-nav>li>a:visited {
        color: #FFF;
    }

    .navbar-inverse-support-center .navbar-nav>li>a:hover {
        color: #c8c8c8;
        border-color: #c8c8c8;
    }

    .navbar-inverse-support-center .navbar-nav>li:nth-child(2)>a {
        background: 0 0;
    }

    .navbar-inverse-bar-customer {
        background-color: #000;
        border: 0;
    }

    .navbar-li-site>a {
        font-size: 12px!important;
        font-weight: 700!important;
    }

    @media (max-width:500px) {
        .suppot-center-title-div {
            height: 40px;
        }

        .suppot-center-title>li {
            line-height: 20px;
            font-size: 12px;
        };
    }

    @media (min-width:501px) {
        .suppot-center-title-div {
            height: 60px;
        }

        .suppot-center-title>li {
            line-height: 60px;
            font-size: 12px;
        }

        .suppot-center-title>li:first-child {
            width: 4%;
        };
    }

    @media (max-width:767px) {
        .navbar-inverse-support-center .navbar-nav>li:nth-child(2),.navbar-inverse-support-center .navbar-nav>li:nth-child(3),.navbar-inverse-support-center .navbar-nav>li:nth-child(4),.navbar-nav>li:first-child,.navbar-nav>li:nth-child(2),.suppot-center-title>li:first-child {
            display: none;
        }

        .navbar-inverse-support-center .navbar-nav>li {
            height: 44px!important;
        }

        .navbar-inverse-support-center .navbar-nav>li>a {
            height: 44px;
        }

        .navbar-header-support-center {
            background: url(../../../../../img/support-center/logo.png) 30% 50% no-repeat;
        }

        .suppot-center-title>li {
            width: 100%;
            height: 100%;
            text-align: center;
        };
    }

    @media (min-width:768px) {
        .container {
            width: 719px;
            padding: 0!important;
        }

        .container-bar-customer {
            height: 36px;
        }

        .navbar-inverse-bar-customer {
            margin: 0;
            background: 0 0;
        }

        .navbar-nav {
            width: 100%;
        }

        .navbar-wrapper-support-center {
            margin: 0;
        }

        .navbar-inverse-support-center .navbar-nav>li:nth-child(2)>a {
            background: url(../../../../../img/support-center/logo.png) center no-repeat;
            width: 184px;
        }

        .navbar-li-site {
            padding-left: 10px!important;
        }

        .navbar-li-site:last-child {
            padding-left: 63px!important;
        }

        .navbar-li-site:first-child,.navbar-li-site:nth-child(2),.navbar-li-site:nth-child(3),.navbar-li-site:nth-child(4) {
            padding-left: 0!important;
        }

        .navbar-inverse-support-center .navbar-nav>li {
            padding-left: 50px;
            height: 74px;
        }

        .navbar-inverse-support-center .navbar-nav>li>a {
            height: 74px;
        }

        .navbar-inverse-support-center .navbar-nav>li:nth-child(3) {
            padding-left: 100px;
            display: none;
        }

        .navbar-inverse-support-center .navbar-nav>li:nth-child(2) {
            padding-left: 0;
        }

        .suppot-center-title-div {
            height: 70px;
        }

        .suppot-center-title>li {
            line-height: 70px;
            font-size: 14px;
        }

        .suppot-center-title>li:first-child {
            width: 3%;
        }

        .suppot-center-description {
            font-size: 14px;
        };
    }

    @media (min-width:850px) {
        .navbar-nav>li:first-child,.suppot-center-title>li:first-child {
            width: 5%;
        }

        .suppot-center-title-div {
            height: 80px;
        }

        .suppot-center-title>li {
            line-height: 80px;
            font-size: 18px;
        }

        .suppot-center-description {
            font-size: 16px;
        }

        .container-100-percent {
            width: 100%!important;
        };
    }

    @media (min-width:900px) {
        .navbar-nav>li:first-child,.suppot-center-title>li:first-child {
            width: 9%;
        }

        .suppot-center-title-div {
            height: 90px;
        }

        .suppot-center-title>li {
            line-height: 90px;
            font-size: 22px;
        }

        .suppot-center-description {
            font-size: 18px;
        }

        .container-100-percent {
            width: 100%!important;
        };
    }

    @media (min-width:992px) {
        .navbar-nav>li:first-child,.suppot-center-title>li:first-child {
            width: 13%;
        }

        .suppot-center-title-div {
            height: 100px;
        }

        .suppot-center-title>li {
            line-height: 100px;
            font-size: 28px;
        }

        .suppot-center-description {
            font-size: 20px;
        }

        .container {
            width: 719px;
            padding: 0!important;
        }

        .container-100-percent {
            width: 100%!important;
        }

        .navbar-li-site>a {
            font-size: 14px!important;
        };
    }

    @media (max-width:1199px) {
        .suppot-center-description-img {
            width: 100%;
        };
    }

    @media (min-width:1200px) {
        .suppot-center-description-img {
            width: 900px;
        }

        .navbar-nav>li:first-child,.suppot-center-title>li:first-child {
            width: 18%;
        }

        .suppot-center-title-div {
            height: 108px;
        }

        .suppot-center-title>li {
            line-height: 108px;
            font-size: 36px;
            color: #000;
        }

        .suppot-center-description {
            font-size: 22px;
        }

        .container {
            width: 719px;
            padding: 0!important;
        }

        .container-100-percent {
            width: 100%!important;
        }

        .navbar-li-site>a {
            font-size: 16px!important;
        };
    }

    @media (min-width:1900px) {
        .navbar-nav>li:first-child {
            width: 23.35%;
        }

        .container {
            width: 719px;
            padding: 0!important;
        }

        .container-100-percent {
            width: 100%!important;
        }

        .navbar-li-site>a {
            font-size: 20px!important;
        };
    }

    .suppot-center-title {
        padding: 0;
    }

    .suppot-center-title>li {
        float: left;
        font-weight: 700;
        color: #000;
    }

    .suppot-center-description {
        color: #000;
    }

    .suppot-center-description>span.title {
        padding-top: 20px;
        padding-bottom: 4px;
        display: block;
        font-weight: 700;
    }

    .footer-padding {
        background: #FFF;
    }

    footer>div {
        border-top: solid #868686;
        background: #262626;
        float: left;
        width: 100%;
    }

    footer>div>ul>li>a {
        color: #868686;
    }

    footer>div>ul>li>a:hover {
        color: #FFF;
    }

    footer>div>ul>li>a:link {
        text-decoration: none;
    }

    @media (max-width:500px) {
        .title_top_bg {
            width: 100%;
        };
    }

    @media (min-width:501px) {
        .title_top_bg {
            height: 200px;
        };
    }

    li.title {
        padding: 0;
        font-size: 22px;
    }

    li.title>h3 {
        color: #000;
    }

    li.title>hr {
        border-color: #8c8c8c;
    }

    li.content {
        padding: 0 0 10px;
    }

    li.content>a {
        font-size: 14px;
        color: #3a3a3a;
    }

    li.content>a:hover {
        color: #64c864;
    }
</style>
<div class="navbar-wrapper navbar-wrapper-support-center" style="position:relative;">
    <div class="container" style="width:100%;">
        <nav class="navbar navbar-inverse navbar-inverse-support-center navbar-static-top" role="navigation" style="margin:0; border-radius:0; background:rgb(81,173,150)">
            <div class="container" style="width:100%;">
                <div class="navbar-header navbar-header-support-center">
                    <button type="button" class="navbar-toggle navbar-toggle-support-center collapsed" data-toggle="collapse" data-target="#navbar_site_support_center"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div id="navbar_site_support_center" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-nav-site">
                        <li class="navbar-li-site"></li>
                        <li class="navbar-li-site"><a href="/"></a></li>
                        <li class="navbar-li-site"></li>
                        <li class="navbar-li-site" style="width:24%;"></li>
                        <li class="navbar-li-site"><a href="/" style="margin-top:20px; height:40px; padding:10px; border-width:1px; border-style:solid; border-radius:6px;">Back to Greenspot.com</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>





<div class="container-100-percent bg-success">
    <div class="container text-success">
        <br/><br/><br/><br/><br/>
        <h1>Thank You for using our service, and welcome to the GreenSpots' big family!!!</h1>
        <br/>
        <h2>We have received your payment for GreenSpot Services!</h2>
        <br/>
        <p style="font-style: italic;">If you have any questions, please don't hesitate to contact us! Call On: 0800 00 1747</p>
        <br/><br/><br/><br/><br/>
    </div>
</div>





<!-- /END THE FEATURETTES -->
<!-- FOOTER -->
<div class="footer-padding"></div>
<footer>
    <div class="col-lg-12">
        <ul class="col-md-4 col-md-offset-1">
            <li>
                <h3>General</h3>
            </li>
            <li>
                <a href="/support_center">Support Center</a>
            </li>
            <li>
                <a href="/support_center/how_do_you_choose_your_authentication_method">Choose the method of Authentication</a>
            </li>
            <li>
                <a href="/support_center/set_your_customers_wifi_time">Set your customers' Wi-Fi time</a>
            </li>
            <li>
                <a href="/support_center/choose_a_templet_for_your_wifi_authentication_page">Choose a templet for your Wi-Fi Authentication page</a>
            </li>
            <li>
                <a href="/support_center/upload_your_logo_contact_and_info_to_authentication_page">Upload your logo, contact and Info to Authentication page</a>
            </li>
            <li>
                <a href="/support_center/upload_your_promotion_images">Upload your promotion images</a>
            </li>
            <li>
                <a href="/support_center/set_black_white_list">Set Black/White list</a>
            </li>
            <li>
                <a href="/support_center/how_you_set_membership_card">Set your membership card</a>
            </li>
        </ul>
        <ul class="col-md-2">
            <li>
                <h3>Account</h3>
            </li>
            <li>
                <a href="/support_center/change_your_password">Change your password</a>
            </li>
            <li>
                <a href="/support_center/sms_topup">SMS Top-Up</a>
            </li>
        </ul>
        <ul class="col-md-2">
            <li>
                <h3>User</h3>
            </li>
            <li>
                <a href="/support_center/check_dashboard">Check Dashboard</a>
            </li>
            <li>
                <a href="/support_center/check_user_list">Check User list</a>
            </li>
        </ul>
        <ul class="col-md-2">
            <li>
                <h3>E-shop</h3>
            </li>
            <li>
                <a href="/support_center/e_shop/general">General</a>
            </li>
            <li>
                <a href="/support_center/e_shop/template">Template</a>
            </li>
            <li>
                <a href="/support_center/e_shop/ads">Ads</a>
            </li>
            <li>
                <a href="/support_center/e_shop/section">Section</a>
            </li>
            <li>
                <a href="/support_center/e_shop/information">Information</a>
            </li>
            <li>
                <a href="/support_center/e_shop/message">Message</a>
            </li>
        </ul>
        <span class="col-md-12" style="text-align:center; display:block; padding:40px 0;">Copyright &copy; 2015 Greenspot. All Rights Reserved.</span>
    </div>
</footer>