<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan < 3) {
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

$checksql = "Select * from kycdetails where `userid`='$email'";
$checkrst = mysqli_query($con, $checksql);
$rowcount2 = mysqli_num_rows($checkrst);
$UserBankInfo = mysqli_fetch_assoc($checkrst);

$checksql1 = "SELECT * FROM `topup` where `step`< 4 and `userid`='$email'";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);
$UserBankInfo1 = mysqli_fetch_assoc($checkrst1);

if ($rowcount1 == 1) {
    $plan = intval($UserBankInfo1['step']);
    $sbamount = $UserBankInfo1['amount'];
} else {
    $plan = 0;
}

include "./common/header.php";
include "./common/sidebar.php";

$_SESSION['payid'] = 2;
$payment = "";
if (isset($_REQUEST['payment'])) {
    $payment = $_REQUEST['payment'];
}

if ($payment == "SUCCESS" && isset($_REQUEST['trans_id'])) {
    $trans_id = $_REQUEST['trans_id'];

    if (intval($_SESSION['order_id']) > 0) {
        $payment = "";
        $payjoin = 1;

        $checksql1 = "SELECT * FROM `topup` where `step`=1 and userid='$email'";
        $checkrst1 = mysqli_query($con, $checksql1);
        $rowcount1 = mysqli_num_rows($checkrst1);
        $UserBankInfo1 = mysqli_fetch_assoc($checkrst1);
        $id = $UserBankInfo1['ID'];

        $insert = "INSERT INTO `userpayment` (`ID`, `userid`, `recipt`, `tranferdetails`, `transferdate`,`planid`,`pg_transfer_id`,`verified`) VALUES (NULL, '$email', '', '', '','$plan','" . $_SESSION['order_id'] . "',0);";
        mysqli_query($con, $insert);

        $checksql = "UPDATE `topup` SET `step`='2'  WHERE `ID`='$id'";
        mysqli_query($con, $checksql);
        $plan = 2;

        $update = "UPDATE `payment` SET `trans_id` = '$trans_id' WHERE `payment`.`ID` = " . $_SESSION['order_id'];
        mysqli_query($con, $update);
    }
}

if ($plan == 1) {
    echo $inst = "INSERT INTO `payment` (`ID`, `user_id`,`trans_id`) VALUES (NULL, '$email','0');";
    mysqli_query($con, $inst);
    $order_id = mysqli_insert_id($con);

    $_SESSION['order_id'] = $order_id;
} /*else {
$update = "SELECT * from `payment` WHERE `user_id` = '$email' and `trans_id`!=''and `trans_id`!='0' ORDER BY `payment`.`ID` ASC"; //..SELECT * from `payment` WHERE `user_id` = '$email'";
$checkrst1 = mysqli_query($con, $update);
$rowcount1 = mysqli_num_rows($checkrst1);
$UserBankInfo1 = mysqli_fetch_assoc($checkrst1);
if ($plan == 2) {

}
}*/

?>

<style>
.perfect-scrollbar-on .main-panel {
    background-size: cover !important;
    background-repeat: no-repeat !important;
}

.footer-nav ul li p {
    color: #fff !important;
    font-weight: bold;
}

.footer-nav a {
    color: white !important;
    font-weight: bold;
}

.credits {
    color: white !important;
    font-weight: bold;
}


@import url(https://fonts.googleapis.com/css?family=Roboto+Slab:300|Roboto|Allura);

h1,
.credit {
    font-family: "Roboto Slab";
}

.credit {
    text-align: center;
    font-size: 0.7em;
    padding: 10px;
}

.item {
    width: 60px;
    vertical-align: middle;
    margin-right: 15px;
}

.sbcard .company {
    box-sizing: border-box;
    float: right;
}

.sbcard {
    position: relative;
    perspective: 600px;
}

.sbcard,
.sbcard .side {
    width: 350px;
    height: 200px;
}

.sbcard .side {
    border-radius: 5px 5px;
    transition: all 0.4s linear;
    background: #333;
    color: #FFF;
    box-sizing: border-box;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    position: absolute;
    top: 0;
    left: 0;
}

.sbcard .front {
    padding: 10px;
    transform: rotateX(0deg) rotateY(0deg);
}

.sbcard.flip .front {
    transform: rotateY(180deg);
}

.sbcard .cc-num {
    width: 100%;
    padding-top: 100px;
}

.sbcard input {
    outline: none;
    border: 0px solid;
    background: none;
    color: #FFF;
}

.sbcard[data-type="visa"] input::-webkit-input-placeholder,
.sbcard[data-type="mastercard"] input::-webkit-input-placeholder {
    color: #DDD;
}

.sbcard[data-type="visa"] input::-moz-placeholder,
.sbcard[data-type="mastercard"] input::-moz-placeholder {
    color: #DDD;
}

.sbcard[data-type="visa"] input:-ms-placeholder,
.sbcard[data-type="mastercard"] input:-ms-placeholder {
    color: #DDD;
}

.sbcard[data-type="visa"] .company {
    color: rgba(255, 255, 255, 0.9);
    font-style: italic;
    text-shadow: 0px 0px 3px rgba(17, 123, 173, 0.9);
}

.sbcard[data-type="visa"] .side {
    background: #1db1cf;
}

.sbcard[data-type="mastercard"] .side {
    background: #4d86ce;
}

.sbcard[data-type="mastercard"] .company div {
    float: left;
    width: 15px;
    height: 15px;
    border-radius: 10px;
    background: rgba(239, 209, 57, 0.8);
}

.sbcard[data-type="mastercard"] .company div:first-child {
    background: rgba(223, 40, 40, 0.8);
    margin-right: -5px;
}

.signature {
    background: #DDD;
    color: #000;
    padding: 10px;
}

.right {
    float: right;
}

.sig {
    font-family: "Allura";
}

.signature input.cc-cvc {
    color: #000;
    width: 40px;
}

.stripe {
    margin: 20px 0;
    height: 40px;
    background: #000;
}

.sbcard .back {
    padding-top: 15px;
    transform: rotateY(-180deg);
}

.sbcard.flip .back {
    transform: rotateX(0deg) rotateY(0deg);
}

.sbbutton {
    background: #0099CC;
    padding: 4px;
    color: #FFF;
    cursor: pointer;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    border-radius: 5px 5px;
}

.sbbutton:hover {
    background: #33B5E5;
}

.checkout {
    margin: 0 auto;
    width: 350px;
}

.addr input {
    width: 100%;
    outline: none;
    border: 0px solid;
    padding: 5px;
}
</style>
<div class="content">
    <?php if ($rowcount2 == 0 && $plan >= 3) {?>


    <div class="alert alert-warning" style="    background-color: #797979;">
        <strong>Warning!</strong> Kindly Update Your Bank Details.<a href="/UserInfo#Bank" style="font-weight: bold;">
            For Update Click Here</a>
    </div>


    <?php
}
if ($payment == "") {
    if ($plan == 0) {
        include "common/selectplan1.php";
    } elseif ($plan == 1) {
        include "common/paymentinfo1.php";
    } elseif ($plan == 2) {
        $unique = $UserInfo['joinkey'];
        $checksql = "Select * from inviteuser where `unique`='$unique'";
        $checkrst = mysqli_query($con, $checksql);
        $inviteuser = mysqli_fetch_assoc($checkrst);

        if ($inviteuser['status'] == 2) {
            $sql = "Update inviteuser set status=3 where `unique`='$unique'";
            mysqli_query($con, $sql);
        }
        if ($payjoin == 1) {
            include "common/thanks1.php";
        } else {
            include "common/thanks.php";
        }
    }
} else if ($payment == "DECLINED") {
    include "common/declined.php";
} else if ($payment == "ERROR") {
    include "common/declined.php";
} else if ($payment == "SUCCESS") {
    include "common/declined.php";
}
?>
</div>
<?php include "./common/footer1.php";?>
</div>
</div>


<?php include "./common/footer.php";?>

<script>
// Generated by CoffeeScript 1.7.1
(function() {
    var $, cardFromNumber, cardFromType, cards, defaultFormat, formatBackCardNumber, formatBackExpiry,
        formatCardNumber, formatExpiry, formatForwardExpiry, formatForwardSlashAndSpace, hasTextSelected, luhnCheck,
        reFormatCVC, reFormatCardNumber, reFormatExpiry, reFormatNumeric, replaceFullWidthChars, restrictCVC,
        restrictCardNumber, restrictExpiry, restrictNumeric, safeVal, setCardType,
        __slice = [].slice,
        __indexOf = [].indexOf || function(item) {
            for (var i = 0, l = this.length; i < l; i++) {
                if (i in this && this[i] === item) return i;
            }
            return -1;
        };

    $ = window.jQuery || window.Zepto || window.$;

    $.payment = {};

    $.payment.fn = {};

    $.fn.payment = function() {
        var args, method;
        method = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        return $.payment.fn[method].apply(this, args);
    };

    defaultFormat = /(\d{1,4})/g;

    $.payment.cards = cards = [{
        type: 'elo',
        patterns: [4011, 4312, 4389, 4514, 4573, 4576, 5041, 5066, 5067, 509, 6277, 6362, 6363, 650, 6516,
            6550
        ],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'visaelectron',
        patterns: [4026, 417500, 4405, 4508, 4844, 4913, 4917],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'maestro',
        patterns: [5018, 502, 503, 506, 56, 58, 639, 6220, 67],
        format: defaultFormat,
        length: [12, 13, 14, 15, 16, 17, 18, 19],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'forbrugsforeningen',
        patterns: [600],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'dankort',
        patterns: [5019],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'visa',
        patterns: [4],
        format: defaultFormat,
        length: [13, 16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'mastercard',
        patterns: [51, 52, 53, 54, 55, 22, 23, 24, 25, 26, 27],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'amex',
        patterns: [34, 37],
        format: /(\d{1,4})(\d{1,6})?(\d{1,5})?/,
        length: [15],
        cvcLength: [3, 4],
        luhn: true
    }, {
        type: 'dinersclub',
        patterns: [30, 36, 38, 39],
        format: /(\d{1,4})(\d{1,6})?(\d{1,4})?/,
        length: [14],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'discover',
        patterns: [60, 64, 65, 622],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }, {
        type: 'unionpay',
        patterns: [62, 88],
        format: defaultFormat,
        length: [16, 17, 18, 19],
        cvcLength: [3],
        luhn: false
    }, {
        type: 'jcb',
        patterns: [35],
        format: defaultFormat,
        length: [16],
        cvcLength: [3],
        luhn: true
    }];

    cardFromNumber = function(num) {
        var card, p, pattern, _i, _j, _len, _len1, _ref;
        num = (num + '').replace(/\D/g, '');
        for (_i = 0, _len = cards.length; _i < _len; _i++) {
            card = cards[_i];
            _ref = card.patterns;
            for (_j = 0, _len1 = _ref.length; _j < _len1; _j++) {
                pattern = _ref[_j];
                p = pattern + '';
                if (num.substr(0, p.length) === p) {
                    return card;
                }
            }
        }
    };

    cardFromType = function(type) {
        var card, _i, _len;
        for (_i = 0, _len = cards.length; _i < _len; _i++) {
            card = cards[_i];
            if (card.type === type) {
                return card;
            }
        }
    };

    luhnCheck = function(num) {
        var digit, digits, odd, sum, _i, _len;
        odd = true;
        sum = 0;
        digits = (num + '').split('').reverse();
        for (_i = 0, _len = digits.length; _i < _len; _i++) {
            digit = digits[_i];
            digit = parseInt(digit, 10);
            if ((odd = !odd)) {
                digit *= 2;
            }
            if (digit > 9) {
                digit -= 9;
            }
            sum += digit;
        }
        return sum % 10 === 0;
    };

    hasTextSelected = function($target) {
        var _ref;
        if (($target.prop('selectionStart') != null) && $target.prop('selectionStart') !== $target.prop(
                'selectionEnd')) {
            return true;
        }
        if ((typeof document !== "undefined" && document !== null ? (_ref = document.selection) != null ? _ref
                .createRange : void 0 : void 0) != null) {
            if (document.selection.createRange().text) {
                return true;
            }
        }
        return false;
    };

    safeVal = function(value, $target) {
        var currPair, cursor, digit, error, last, prevPair;
        try {
            cursor = $target.prop('selectionStart');
        } catch (_error) {
            error = _error;
            cursor = null;
        }
        last = $target.val();
        $target.val(value);
        if (cursor !== null && $target.is(":focus")) {
            if (cursor === last.length) {
                cursor = value.length;
            }
            if (last !== value) {
                prevPair = last.slice(cursor - 1, +cursor + 1 || 9e9);
                currPair = value.slice(cursor - 1, +cursor + 1 || 9e9);
                digit = value[cursor];
                if (/\d/.test(digit) && prevPair === ("" + digit + " ") && currPair === (" " + digit)) {
                    cursor = cursor + 1;
                }
            }
            $target.prop('selectionStart', cursor);
            return $target.prop('selectionEnd', cursor);
        }
    };

    replaceFullWidthChars = function(str) {
        var chars, chr, fullWidth, halfWidth, idx, value, _i, _len;
        if (str == null) {
            str = '';
        }
        fullWidth = '\uff10\uff11\uff12\uff13\uff14\uff15\uff16\uff17\uff18\uff19';
        halfWidth = '0123456789';
        value = '';
        chars = str.split('');
        for (_i = 0, _len = chars.length; _i < _len; _i++) {
            chr = chars[_i];
            idx = fullWidth.indexOf(chr);
            if (idx > -1) {
                chr = halfWidth[idx];
            }
            value += chr;
        }
        return value;
    };

    reFormatNumeric = function(e) {
        var $target;
        $target = $(e.currentTarget);
        return setTimeout(function() {
            var value;
            value = $target.val();
            value = replaceFullWidthChars(value);
            value = value.replace(/\D/g, '');
            return safeVal(value, $target);
        });
    };

    reFormatCardNumber = function(e) {
        var $target;
        $target = $(e.currentTarget);
        return setTimeout(function() {
            var value;
            value = $target.val();
            value = replaceFullWidthChars(value);
            value = $.payment.formatCardNumber(value);
            return safeVal(value, $target);
        });
    };

    formatCardNumber = function(e) {
        var $target, card, digit, length, re, upperLength, value;
        digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) {
            return;
        }
        $target = $(e.currentTarget);
        value = $target.val();
        card = cardFromNumber(value + digit);
        length = (value.replace(/\D/g, '') + digit).length;
        upperLength = 16;
        if (card) {
            upperLength = card.length[card.length.length - 1];
        }
        if (length >= upperLength) {
            return;
        }
        if (($target.prop('selectionStart') != null) && $target.prop('selectionStart') !== value.length) {
            return;
        }
        if (card && card.type === 'amex') {
            re = /^(\d{4}|\d{4}\s\d{6})$/;
        } else {
            re = /(?:^|\s)(\d{4})$/;
        }
        if (re.test(value)) {
            e.preventDefault();
            return setTimeout(function() {
                return $target.val(value + ' ' + digit);
            });
        } else if (re.test(value + digit)) {
            e.preventDefault();
            return setTimeout(function() {
                return $target.val(value + digit + ' ');
            });
        }
    };

    formatBackCardNumber = function(e) {
        var $target, value;
        $target = $(e.currentTarget);
        value = $target.val();
        if (e.which !== 8) {
            return;
        }
        if (($target.prop('selectionStart') != null) && $target.prop('selectionStart') !== value.length) {
            return;
        }
        if (/\d\s$/.test(value)) {
            e.preventDefault();
            return setTimeout(function() {
                return $target.val(value.replace(/\d\s$/, ''));
            });
        } else if (/\s\d?$/.test(value)) {
            e.preventDefault();
            return setTimeout(function() {
                return $target.val(value.replace(/\d$/, ''));
            });
        }
    };

    reFormatExpiry = function(e) {
        var $target;
        $target = $(e.currentTarget);
        return setTimeout(function() {
            var value;
            value = $target.val();
            value = replaceFullWidthChars(value);
            value = $.payment.formatExpiry(value);
            return safeVal(value, $target);
        });
    };

    formatExpiry = function(e) {
        var $target, digit, val;
        digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) {
            return;
        }
        $target = $(e.currentTarget);
        val = $target.val() + digit;
        if (/^\d$/.test(val) && (val !== '0' && val !== '1')) {
            e.preventDefault();
            return setTimeout(function() {
                return $target.val("0" + val + " / ");
            });
        } else if (/^\d\d$/.test(val)) {
            e.preventDefault();
            return setTimeout(function() {
                var m1, m2;
                m1 = parseInt(val[0], 10);
                m2 = parseInt(val[1], 10);
                if (m2 > 2 && m1 !== 0) {
                    return $target.val("0" + m1 + " / " + m2);
                } else {
                    return $target.val("" + val + " / ");
                }
            });
        }
    };

    formatForwardExpiry = function(e) {
        var $target, digit, val;
        digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) {
            return;
        }
        $target = $(e.currentTarget);
        val = $target.val();
        if (/^\d\d$/.test(val)) {
            return $target.val("" + val + " / ");
        }
    };

    formatForwardSlashAndSpace = function(e) {
        var $target, val, which;
        which = String.fromCharCode(e.which);
        if (!(which === '/' || which === ' ')) {
            return;
        }
        $target = $(e.currentTarget);
        val = $target.val();
        if (/^\d$/.test(val) && val !== '0') {
            return $target.val("0" + val + " / ");
        }
    };

    formatBackExpiry = function(e) {
        var $target, value;
        $target = $(e.currentTarget);
        value = $target.val();
        if (e.which !== 8) {
            return;
        }
        if (($target.prop('selectionStart') != null) && $target.prop('selectionStart') !== value.length) {
            return;
        }
        if (/\d\s\/\s$/.test(value)) {
            e.preventDefault();
            return setTimeout(function() {
                return $target.val(value.replace(/\d\s\/\s$/, ''));
            });
        }
    };

    reFormatCVC = function(e) {
        var $target;
        $target = $(e.currentTarget);
        return setTimeout(function() {
            var value;
            value = $target.val();
            value = replaceFullWidthChars(value);
            value = value.replace(/\D/g, '').slice(0, 4);
            return safeVal(value, $target);
        });
    };

    restrictNumeric = function(e) {
        var input;
        if (e.metaKey || e.ctrlKey) {
            return true;
        }
        if (e.which === 32) {
            return false;
        }
        if (e.which === 0) {
            return true;
        }
        if (e.which < 33) {
            return true;
        }
        input = String.fromCharCode(e.which);
        return !!/[\d\s]/.test(input);
    };

    restrictCardNumber = function(e) {
        var $target, card, digit, value;
        $target = $(e.currentTarget);
        digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) {
            return;
        }
        if (hasTextSelected($target)) {
            return;
        }
        value = ($target.val() + digit).replace(/\D/g, '');
        card = cardFromNumber(value);
        if (card) {
            return value.length <= card.length[card.length.length - 1];
        } else {
            return value.length <= 16;
        }
    };

    restrictExpiry = function(e) {
        var $target, digit, value;
        $target = $(e.currentTarget);
        digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) {
            return;
        }
        if (hasTextSelected($target)) {
            return;
        }
        value = $target.val() + digit;
        value = value.replace(/\D/g, '');
        if (value.length > 6) {
            return false;
        }
    };

    restrictCVC = function(e) {
        var $target, digit, val;
        $target = $(e.currentTarget);
        digit = String.fromCharCode(e.which);
        if (!/^\d+$/.test(digit)) {
            return;
        }
        if (hasTextSelected($target)) {
            return;
        }
        val = $target.val() + digit;
        return val.length <= 4;
    };

    setCardType = function(e) {
        var $target, allTypes, card, cardType, val;
        $target = $(e.currentTarget);
        val = $target.val();
        cardType = $.payment.cardType(val) || 'unknown';
        if (!$target.hasClass(cardType)) {
            allTypes = (function() {
                var _i, _len, _results;
                _results = [];
                for (_i = 0, _len = cards.length; _i < _len; _i++) {
                    card = cards[_i];
                    _results.push(card.type);
                }
                return _results;
            })();
            $target.removeClass('unknown');
            $target.removeClass(allTypes.join(' '));
            $target.addClass(cardType);
            $target.toggleClass('identified', cardType !== 'unknown');
            return $target.trigger('payment.cardType', cardType);
        }
    };

    $.payment.fn.formatCardCVC = function() {
        this.on('keypress', restrictNumeric);
        this.on('keypress', restrictCVC);
        this.on('paste', reFormatCVC);
        this.on('change', reFormatCVC);
        this.on('input', reFormatCVC);
        return this;
    };

    $.payment.fn.formatCardExpiry = function() {
        this.on('keypress', restrictNumeric);
        this.on('keypress', restrictExpiry);
        this.on('keypress', formatExpiry);
        this.on('keypress', formatForwardSlashAndSpace);
        this.on('keypress', formatForwardExpiry);
        this.on('keydown', formatBackExpiry);
        this.on('change', reFormatExpiry);
        this.on('input', reFormatExpiry);
        return this;
    };

    $.payment.fn.formatCardNumber = function() {
        this.on('keypress', restrictNumeric);
        this.on('keypress', restrictCardNumber);
        this.on('keypress', formatCardNumber);
        this.on('keydown', formatBackCardNumber);
        this.on('keyup', setCardType);
        this.on('paste', reFormatCardNumber);
        this.on('change', reFormatCardNumber);
        this.on('input', reFormatCardNumber);
        this.on('input', setCardType);
        return this;
    };

    $.payment.fn.restrictNumeric = function() {
        this.on('keypress', restrictNumeric);
        this.on('paste', reFormatNumeric);
        this.on('change', reFormatNumeric);
        this.on('input', reFormatNumeric);
        return this;
    };

    $.payment.fn.cardExpiryVal = function() {
        return $.payment.cardExpiryVal($(this).val());
    };

    $.payment.cardExpiryVal = function(value) {
        var month, prefix, year, _ref;
        _ref = value.split(/[\s\/]+/, 2), month = _ref[0], year = _ref[1];
        if ((year != null ? year.length : void 0) === 2 && /^\d+$/.test(year)) {
            prefix = (new Date).getFullYear();
            prefix = prefix.toString().slice(0, 2);
            year = prefix + year;
        }
        month = parseInt(month, 10);
        year = parseInt(year, 10);
        return {
            month: month,
            year: year
        };
    };

    $.payment.validateCardNumber = function(num) {
        var card, _ref;
        num = (num + '').replace(/\s+|-/g, '');
        if (!/^\d+$/.test(num)) {
            return false;
        }
        card = cardFromNumber(num);
        if (!card) {
            return false;
        }
        return (_ref = num.length, __indexOf.call(card.length, _ref) >= 0) && (card.luhn === false || luhnCheck(
            num));
    };

    $.payment.validateCardExpiry = function(month, year) {
        var currentTime, expiry, _ref;
        if (typeof month === 'object' && 'month' in month) {
            _ref = month, month = _ref.month, year = _ref.year;
        }
        if (!(month && year)) {
            return false;
        }
        month = $.trim(month);
        year = $.trim(year);
        if (!/^\d+$/.test(month)) {
            return false;
        }
        if (!/^\d+$/.test(year)) {
            return false;
        }
        if (!((1 <= month && month <= 12))) {
            return false;
        }
        if (year.length === 2) {
            if (year < 70) {
                year = "20" + year;
            } else {
                year = "19" + year;
            }
        }
        if (year.length !== 4) {
            return false;
        }
        expiry = new Date(year, month);
        currentTime = new Date;
        expiry.setMonth(expiry.getMonth() - 1);
        expiry.setMonth(expiry.getMonth() + 1, 1);
        return expiry > currentTime;
    };

    $.payment.validateCardCVC = function(cvc, type) {
        var card, _ref;
        cvc = $.trim(cvc);
        if (!/^\d+$/.test(cvc)) {
            return false;
        }
        card = cardFromType(type);
        if (card != null) {
            return _ref = cvc.length, __indexOf.call(card.cvcLength, _ref) >= 0;
        } else {
            return cvc.length >= 3 && cvc.length <= 4;
        }
    };

    $.payment.cardType = function(num) {
        var _ref;
        if (!num) {
            return null;
        }
        return ((_ref = cardFromNumber(num)) != null ? _ref.type : void 0) || null;
    };

    $.payment.formatCardNumber = function(num) {
        var card, groups, upperLength, _ref;
        num = num.replace(/\D/g, '');
        card = cardFromNumber(num);
        if (!card) {
            return num;
        }
        upperLength = card.length[card.length.length - 1];
        num = num.slice(0, upperLength);
        if (card.format.global) {
            return (_ref = num.match(card.format)) != null ? _ref.join(' ') : void 0;
        } else {
            groups = card.format.exec(num);
            if (groups == null) {
                return;
            }
            groups.shift();
            groups = $.grep(groups, function(n) {
                return n;
            });
            return groups.join(' ');
        }
    };

    $.payment.formatExpiry = function(expiry) {
        var mon, parts, sep, year;
        parts = expiry.match(/^\D*(\d{1,2})(\D+)?(\d{1,4})?/);
        if (!parts) {
            return '';
        }
        mon = parts[1] || '';
        sep = parts[2] || '';
        year = parts[3] || '';
        if (year.length > 0) {
            sep = ' / ';
        } else if (sep === ' /') {
            mon = mon.substring(0, 1);
            sep = '';
        } else if (mon.length === 2 || sep.length > 0) {
            sep = ' / ';
        } else if (mon.length === 1 && (mon !== '0' && mon !== '1')) {
            mon = "0" + mon;
            sep = ' / ';
        }
        return mon + sep + year;
    };

}).call(this);
</script>
<script>
$('input.cc-num').payment('formatCardNumber').on("keyup change", function() {
    var type = $.payment.cardType($(this).val());
    if (type == "visa") {
        $(".company").html("VISA");
        $(".sbcard").attr("data-type", "visa");
    } else if (type == "mastercard") {
        $(".company").html("<div></div><div></div>");
        $(".sbcard").attr("data-type", "mastercard");
    } else {
        $(".sbcard").attr("data-type", "unknown");
        $(".company").html("CARD");
    }
});
$('input.cc-exp').payment('formatCardExpiry');
$('input.cc-cvc').payment('formatCardCVC');
$(".button.flip").click(function() {
    $(".sbcard").toggleClass("flip");
});
</script>