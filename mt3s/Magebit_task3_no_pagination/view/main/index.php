<?php
if(!isset($this->data)) {
    $this->data = null;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Pineapple</title>
    <link rel="stylesheet" href="../../media/css/main.css">
    <link rel="stylesheet" href="../../media/css/fontello.css">
    <script>
        var checkboxCond = false;
        function EmailReplacer() {
            document.getElementById("email").setAttribute("style", "margin-right: 15px")
            document.getElementById("email").innerHTML = "e-mail  |";
            document.getElementById("input").setAttribute("style","border-color: #4066A5");
        }
        function EmailReplacer2() {
            document.getElementById("email2").setAttribute("style", "margin-right: 15px; width:60px;")
            document.getElementById("email2").innerHTML = "e-mail  |";
            document.getElementById("input2").setAttribute("style","border-color: #4066A5");
        }
        function checkboxSwitch() {
            if(!checkboxCond) {
                document.getElementById("checkBoxRect").
                setAttribute("style","fill:#4066A5;stroke:#4066A5;stroke-width: 1;");
                document.getElementById("checkBoxRect2").
                setAttribute("style","fill:#4066A5;stroke:#4066A5;stroke-width: 1;");
                document.getElementById("checkboxCheck").
                setAttribute("style","color:#FFFFFF; font-size:11;");
                document.getElementById("checkboxCheck2").
                setAttribute("style","color:#FFFFFF; font-size:11;");
                checkboxCond = true;
                document.getElementById("submButton").disabled = false;
                document.getElementById("submButton2").disabled = false;
                document.getElementById("errors").innerHTML = "";
                document.getElementById("errors2").innerHTML = "";
            }
            else {
                document.getElementById("checkBoxRect").
                setAttribute("style", "fill:#FFFFFF;stroke:#E3E3E4;stroke-width: 1;");
                document.getElementById("checkBoxRect2").
                setAttribute("style", "fill:#FFFFFF;stroke:#E3E3E4;stroke-width: 1;");
                document.getElementById("checkboxCheck").
                setAttribute("style","color:#FFFFFF; font-size:0;");
                document.getElementById("checkboxCheck2").
                setAttribute("style","color:#FFFFFF; font-size:0;");
                checkboxCond = false;
                document.getElementById("submButton").disabled = true;
                document.getElementById("submButton2").disabled = true;
                document.getElementById("errors").innerHTML = "You must accept terms and conditions";
                document.getElementById("errors2").innerHTML = "You must accept terms and conditions";
            }
        }
    </script>
</head>
<body>
    <div class="desktop">
        <div class="base">
            <div class="header" id="topBar">
                <div class ="logo">
                    <img src="static/logo_pineapple.svg" alt="Logo" class="logoImg">
                    <img src="static/pineapple.svg" alt="pineapple" class="logoTxt">
                </div>
                <div class ="links">
                    <a href="#"><span class="link">About</span></a>
                    <a href="#"><span class="link">How it works</span></a>
                    <a href="/database"><span class="link">Contact</span></a>
                </div>
            </div>
            <?php
            if($this->data !== true)
            { ?>
                <div class="heading" id="heading1">
                    <p>Subscribe to newsletter</p>
                </div>
                <div class="subheading" id="subheading1">
                    <p>Subscribe to our newsletter and get 10% discount on pineapple glasses</p>
                </div>
                <form id="emailForm" action="/" method="post">
                    <div class="input" id="inputElement">
                <span></span>
                <div class="inputL" id="input">
                    <p id="email"></p>
                    <input onfocus="EmailReplacer()" onchange="EmailChecker(this.value)" class="inputForm" type="text"
                           placeholder="Type your email address here..." id="new-email" name="email">
                    <div class="buttonBox">
                        <div class="buttonIcon">
                            <button class="submitButton" id="submButton" disabled>
                                <i class="icon-arrow"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <p id="errors"></p>
            <p style="color:red; margin-top:50px; margin-left: 140px; margin-bottom: -30px"><?php echo $this->data;?></p>
            <div class="TOS" id="tos">
                <svg height="26" width="26" class="checkbox" onclick="checkboxSwitch()">
                <rect x="0" y="0" rx="7" ry="7" width="26" height="26" id="checkBoxRect"/>
                    <foreignObject height="26" width="26" x="4" y="7">
                        <div id="checkboxCheck" class="checkboxCheck"><i class="icon-check"></i></div>
                    </foreignObject>
                </svg>
                <div class="TOS_text">
                    I agree to <a href="#">terms of service</a>
                </div>
            </div>
            <?php
            }
            if($this->data === true)
            { ?>
                <img src="/static/Union.svg" id="prize" style="margin-top: 133px; margin-left: 140px">
                <div class="heading" style="margin-top: 30px"><p>Thanks for subscribing!</p></div>
                <div class="subheading"><p>You have successfully subscribed to our email listing. Check your email for the discount code.</p></div>
            <?php
            }?>
            <span class="Line"></span>
            <div class="icons">
                <a href="#" >
                    <svg class="fbCircle" width="46" height="46">
                        <circle r="22" cx="23" cy="23"/>
                        <foreignObject x="12" y="14" height="20" width="20">
                            <div class="circleFbIcon"><i class="icon-fb"></i></div>
                        </foreignObject>
                    </svg>
                </a>
                <a href="#">
                    <svg class="instCircle" width="46" height="46">
                        <circle r="22" cx="23" cy="23"/>
                        <foreignObject x="12" y="14" height="20" width="20">
                            <div class="circleInstIcon"><i class="icon-inst"></i></div>
                        </foreignObject>
                    </svg>
                </a>
                <a href="#">
                    <svg class="twCircle" width="46" height="46">
                        <circle r="22" cx="23" cy="23"/>
                        <foreignObject x="12" y="16" height="20" width="20">
                            <div class="circleTwIcon"><i class="icon-tw"></i></div>
                        </foreignObject>
                    </svg>
                </a>
                <a href="#">
                    <svg class="ytCircle" width="46" height="46">
                        <circle r="22" cx="23" cy="23"/>
                        <foreignObject x="13" y="16" height="20" width="20">
                            <div class="circleYtIcon"><i class="icon-yt"></i></div>
                        </foreignObject>
                    </svg>
                </a>
            </div>
        </div>
        <div class="pageBackground">
        </div>
    </div>
    <div class="mobile">
        <div class="mHeader">
            <div class ="logo">
                <img src="static/logo_pineapple.svg" alt="Logo" class="logoImg">
            </div>
            <div class ="mLinks">
                <a href="#"><span class="mLink">About</span></a>
                <a href="#"><span class="mLink">How it works</span></a>
                <a href="#"><span class="mLink">Contact</span></a>
            </div>
        </div>
        <div class="mPageBackground">
            <div class="subBlock" id="subBlock">
                <?php if($this->data !== true) { ?>
                <div class="mHeading" id="heading2">
                    Subscribe to newsletter
                </div>
                <div class="mSubHeading" id="subheading2">
                    Subscribe to our newsletter and get 10% discount on pineapple glasses.
                </div>
                <form method="post" action="/">
                <div class="group" id="inputElement2">
                    <span></span>
                    <div class="mInput" id="input2">
                        <p id="email2"></p>
                        <input onfocus="EmailReplacer2()" onchange="EmailChecker(this.value)"
                               class="inputForm" type="text" name="email" placeholder="Type your email address here...">
                            <div class="mButtonIcon">
                                <button type="submit" id="submButton2" disabled"><i class="icon-arrow"></i></button>
                            </div>
                    </div>
                </div>
                </form>
                <p id="errors2"></p>
                <p style="color:red; margin-top:10px; margin-bottom: 10px; margin-left: 5%;"><?php echo $this->data;?></p>
                <div class="TOS" id="tos2">
                    <svg height="26" width="26" class="checkbox" onclick="checkboxSwitch()">
                        <rect x="0" y="0" rx="7" ry="7" width="26" height="26" id="checkBoxRect2"/>
                        <foreignObject height="26" width="26" x="4" y="7">
                            <div id="checkboxCheck2" class="checkboxCheck"><i class="icon-check"></i></div>
                        </foreignObject>
                    </svg>
                    <div class="TOS_text">
                        I agree to <a href="#">terms of service</a>
                    </div>
                </div>
                <?php
                }
                if($this->data === true) {
                ?>
                <img src="static/Union.svg" style="margin-left: 5%;">
                <div class="mHeading" style="margin-top: 39px;">Thanks for subscribing!</div>
                <div class="mSubHeading">You have successfully subscribed to our email listing. Check your email for the discount code.</div>
                <?php
                } ?>
                <span class="Line" id="divLine"></span>
                <div class="icons">
                    <a href="#" >
                        <svg class="fbCircle" width="46" height="46">
                            <circle r="22" cx="23" cy="23"/>
                            <foreignObject x="12" y="14" height="20" width="20">
                                <div class="circleFbIcon"><i class="icon-fb"></i></div>
                            </foreignObject>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="instCircle" width="46" height="46">
                            <circle r="22" cx="23" cy="23"/>
                            <foreignObject x="12" y="14" height="20" width="20">
                                <div class="circleInstIcon"><i class="icon-inst"></i></div>
                            </foreignObject>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="twCircle" width="46" height="46">
                            <circle r="22" cx="23" cy="23"/>
                            <foreignObject x="12" y="16" height="20" width="20">
                                <div class="circleTwIcon"><i class="icon-tw"></i></div>
                            </foreignObject>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="ytCircle" width="46" height="46">
                            <circle r="22" cx="23" cy="23"/>
                            <foreignObject x="13" y="16" height="20" width="20">
                                <div class="circleYtIcon"><i class="icon-yt"></i></div>
                            </foreignObject>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>