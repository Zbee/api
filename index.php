<!DOCTYPE html>

<html>

  <head>

    <!--Meta-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--About-->
    <title>Zbee's APIs</title>
    <meta name="description" content="APIs made by Ethan Henderson (Zbee)">
    <meta name="author" content="Ethan Henderson (Zbee)">

    <!--Style-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/roboto.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.min.css">
    <style>
      * {
        box-sizing: border-box;
      }

      .header-panel {
        background-color: #009587;
        height: 144px;
        position: relative;
        z-index: 3;
      }
      .header-panel div {
        position: relative;
        height: 100%;
      }
      .header-panel h1 {
        color: #FFF;
        font-size: 20px;
        font-weight: 400;
        position: absolute;
        bottom: 10px;
        padding-left: 35px;
      }

      .menu {
        overflow: auto;
        padding: 0;
      }
      .menu, .menu * {
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      .menu ul {
        padding: 0;
        margin: 7px 0;
      }
      .menu ul li {
        list-style: none;
        padding: 20px 0 20px 50px;
        font-size: 15px;
        font-weight: normal;
        cursor: pointer;
      }
      .menu ul li.active {
        background-color: #dedede;
        position: relative;
      }
      .menu ul li a {
        color: rgb(51, 51, 51);
        text-decoration: none;
      }

      .pages {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 4;
        padding: 0;
        overflow: auto;
      }
      .pages > div {
        padding: 0 5px;
        padding-top: 64px;
      }

      .pages .header {
        color: rgb(82, 101, 162);
        font-size: 24px;
        font-weight: normal;
        margin-top: 5px;
        margin-bottom: 60px;
        letter-spacing: 1.20000004768372px;
      }

      .page {
        transform: translateY(1080px);
        transition: transform 0 linear;
        display: none;
        opacity: 0;
        font-size: 16px;
      }

      .page.active {
        transform: translateY(0px);
        transition: all 0.3s ease-out;
        display: block;
        opacity: 1;
      }

      #opensource {
        color: rgba(0, 0, 0, 0.62);
        position: fixed;
        margin-top: 50px;
        margin-left: 50px;
        z-index: 100;
      }

      #source-modal h4 {
        color: black;
      }

      .expandedReturn {
        border-left: 5px solid rgba(0,0,0,0.25);
        padding-left: 5px;
      }

      a {
        cursor: pointer;
      }
    </style>

    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>
    <script>$.material.init()</script>

  </head>

  <body>

    <div class="header-panel shadow-z-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-3">
            <h1>Zbee's APIs</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid main">
      <div class="row">
        <nav class="col-xs-3 menu">
          <ul>
            <li class="active withripple" data-target="#about">About</li>
            <li class="withripple" data-target="#usage">How to Use</li>
            <li class="withripple" data-target="#school">School Endpoints</li>
          </ul>
        </nav>
        <div class="pages col-xs-9">
          <div class="col-xs-11">
            <div class="well page active" id="about">
              <h1 class="header">About</h1>
              <p>I tend to be both pretty lazy and much more inclined towards accessing data programattically; so, here is where I will put all of the APIs I make, most of which will simply be a JSON/RSS jab at very simple data.</p>
              <p>The idea behind starting to write and collect my APIs here is wanting to make programs that notified me of grade changes when my school's grading system offered no API, and wanting to share this ability with many others.</p>
              <p>Since I live in Colorado Springs, most of these endpoints will also be centered around me, and this city. However, I do strive to use standards and existing APIs if they are available, so not everything will require you to be me to use. Requests for additional endpoints or additions to what is supported by an endpoint can be made to me <a href="https://keybase.io/zbee">personally</a>.</p>
            </div>

            <div class="well page" id="usage">
              <h1 class="header">How to Use</h1>
              <h3>Get a Key</h3>
              <p>Before you may use any of the APIs provided here that are not specifically made to be for public use, a key must be acquired so as to aide in my identifying users and usage.</p>
              <p>You may get a key using the form below. Once you request a key, I will manually approve you within the week.</p>
              <br>
              <div class="row">
                <form method="post" action="" class="col-xs-6">
                  <div class="error"></div>
                  <input type="text" class="form-control floating-label" placeholder="First Name" name="fname">
                  <br>
                  <input type="text" class="form-control floating-label" placeholder="Last Name" name="lname">
                  <br>
                  <input type="email" class="form-control floating-label" placeholder="Email Address" name="email">
                  <br>
                  <input type="text" class="form-control floating-label" placeholder="GitHub Username" name="github">
                  <br>
                  <input type="submit" class="btn btn-primary" value="Request Key">
                </form>
                <script>
                $("#usage form").submit(function() {
                  $(this).find(".error").html("<div class='alert alert-success'>Request submitted.</div><br>")
                  return false
                })
                </script>
              </div>
              <hr>
              <h3>Connect</h3>
              <p>To connect to an API endpoint, you simply have to load the URL with your key:</p>
              <pre><code>https://api.zbee.me/{endpoint}?key={key}</code></pre>
              <br>
              <p>If you wanted to check your grades, for example, you could use:</p>
              <pre><code>https://api.zbee.me/school/csec/grades?key=xxxxxxxxxxxxxxxxxxxx</code></pre>
              <br>
              <p>If you wanted to check the status of a school campus -a public endpoint-, you could use:</p>
              <pre><code>https://api.zbee.me/school/csec/status</code></pre>
              <hr>
              <h3>First-time Connecting</h3>
              <p>The first time you use a private endpoint, you may receive an error telling you to provide more information.</p>
              <p>This error is given because some endpoints require additional data, which can be overridden at any point.</p>
              <p>One example of this is the grades endpoint; login information is required to actually access the grades, and must be provided in a POST method to the endpoint.</p>
              <hr>
              <h3>Standards</h3>
              <h4>Capitalisation</h4>
              <p>
                All capitalisation of words and phrases provided via the APIs is either lowercase or camelCase.
                <a href="http://www.cs.loyola.edu/~binkley/papers/icpc09-clouds.pdf">[1]</a>
              </p>
              <p>All strings passed into the APIs is made to be lowercase with the exception of case-sensitive inputs.</p>
              <br>
              <h4>Spelling</h4>
              <p>
                All spelling of words is American English with the exception words with greek roots use s's, not z's.
                <a href="http://www.etymonline.com/index.php?term=-ize">[1]</a>
                <a href="https://www.worldcat.org/title/dictionary-of-modern-english-usage/oclc/815620926">[2]</a>
              </p>
            </div>

            <div class="well page" id="school">
              <h1 class="header">School Endpoints <small>/school/</small></h1>
              <h3>Endpoints</h3>
              <ul>
                <li>Campus Status <span class="label">Public</span> <small>{school/district}/status</small></li>
                <li>Grades <span class="label">Private</span> <small>{school}/grades</small></li>
              </ul>
              <hr>
              <h3>Campus Status <span class="label">Public</span> <small>{school/district}/status</small></h3>
              <p>This endpoint is for checking the status of a campus/school district (whether it's open, delayed, closed, etc.) with standardized outputs via <a href="http://www.flashalert.net/" target="_blank">FlashAlert</a>.</p>
              <br>
              <h4>Currently Supports</h4>
              <ul>
                <li>
                  <kbd>csec</kbd> <a href="https://api.zbee.me/school/csec/status" target="_blank">Colorado Springs Early Colleges</a>
                </li>
                <li>
                  <kbd>doherty</kbd> <a href="https://api.zbee.me/school/doherty/status" target="_blank">Doherty</a>
                </li>
                <li>
                  <kbd>liberty</kbd> <a href="https://api.zbee.me/school/liberty/status" target="_blank">Liberty</a>
                </li>
                <li>
                  <kbd>ppcc</kbd> <a href="https://api.zbee.me/school/ppcc/status" target="_blank">Pikes Peak Community College</a>
                </li>
                <li>
                  <kbd>vista</kbd> <a href="https://api.zbee.me/school/vista/status" target="_blank">Vista Ridge</a>
                </li>
                <li>
                  <kbd>cocsd3</kbd> <a href="https://api.zbee.me/school/cocsd3/status" target="_blank">Colorado Springs, CO D3</a>
                </li>
                <li>
                  <kbd>cocsd11</kbd> <a href="https://api.zbee.me/school/cocsd11/status" target="_blank">Colorado Springs, CO D11</a>
                </li>
                <li>
                  <kbd>cocsd20</kbd> <a href="https://api.zbee.me/school/cocsd20/status" target="_blank">Colorado Springs, CO D20</a>
                </li>
                <li>
                  <kbd>cocsd49</kbd> <a href="https://api.zbee.me/school/cocsd49/status" target="_blank">Colorado Springs, CO D49</a>
                </li>
              </ul>
              <br>
              <h4>Returns</h4>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </tfoot>

                <tbody>
                  <tr>
                    <td>status</td>
                    <td>(string) <code>normal</code>, <code>delayed</code>, <code>closed</code></td>
                  </tr>

                  <tr>
                    <td>special</td>
                    <td>
                      (boolean) <code>false</code> | <a data-toggle="collapse" data-target="#schoolstatusRspecial">(array)</a>
                      <div id="schoolstatusRspecial" class="collapse expandedReturn">
                        special[0] (string) <code>title</code><br>
                        special[1] (string) <code>explanation</code>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
              <h4>Examples</h4>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th>Input</th>
                    <th>Output</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Input</th>
                    <th>Output</th>
                  </tr>
                </tfoot>

                <tbody>
                  <tr>
                    <td>https://api.zbee.me/school/csec/status</td>
                    <td><code>{"status":"delayed","special":false}</code></td>
                  </tr>

                  <tr>
                    <td>https://api.zbee.me/school/cocsd49/status</td>
                    <td><code>{"status":"normal","special":["rally","classes 10 minutes shorter"]}</code></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <h3>Grades <span class="label">Private</span> <small>{school}/grades</small></h3>
              <p>This endpoint is for checking grades with standardized outputs and formats via scraping.</p>
              <br>
              <h4>Currently Supports</h4>
              <ul>
                <li>
                  <kbd>csec</kbd> Colorado Springs Early Colleges
                </li>
              </ul>
              <br>
              <h4>Additional information</h4>
              This information must be provided via a POST request at least the first time a connection to this endpoint is made, and can be overwritten at any point with another POST.
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </tfoot>

                <tbody>
                  <tr>
                    <td>username</td>
                    <td>(string) <code>username to access grades site</code></td>
                  </tr>

                  <tr>
                    <td>password</td>
                    <td>(string) <code>password to access grades site</code></td>
                  </tr>
                </tbody>
              </table>
              <br>
              <h4>Returns</h4>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Key</th>
                    <th>Value</th>
                  </tr>
                </tfoot>

                <tbody>
                  <tr>
                    <td>student</td>
                    <td>(string) <code>student's name</code></td>
                  </tr>

                  <tr>
                    <td>classes</td>
                    <td>
                      <a data-toggle="collapse" data-target="#schoolgradesRclasses">(object)</a>
                      <div id="schoolgradesRclasses" class="collapse expandedReturn">
                        classes[className]
                        <a data-toggle="collapse" data-target="#schoolgradesRclassesclassname">(array)</a>
                        <div id="schoolgradesRclassesclassname" class="collapse expandedReturn">
                          classes[className][0] (float) <code>0.000</code>-<code>1.000</code><br>
                          classes[className][1] (string) <code>a</code>, <code>b</code>, <code>c</code>, <code>d</code>, <code>f</code><br>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>average</td>
                    <td>
                      <a data-toggle="collapse" data-target="#schoolgradesRaverage">(array)</a>
                      <div id="schoolgradesRaverage" class="collapse expandedReturn">
                        classes[0] (float) <code>0.000</code>-<code>1.000</code><br>
                        classes[1] (string) <code>a</code>, <code>b</code>, <code>c</code>, <code>d</code>, <code>f</code><br>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>gpa</td>
                    <td>(float)  <code>0.0</code>-<code>4.0</code></td>
                  </tr>
                </tbody>
              </table>
              <br>
              <h4>Examples</h4>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th>Input</th>
                    <th>Output</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Input</th>
                    <th>Output</th>
                  </tr>
                </tfoot>

                <tbody>
                  <tr>
                    <td>https://api.zbee.me/school/csec/grades?key=xxxxxxxxxxxxxxxxxxxx</td>
                    <td><code>{"student":,"Ethan Henderson","classes":{"math":[0.984,"a"],"english":[0.861,"b"]},"average":[0.922,"a"],"gpa":3.7}</code></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!--<div class="col-xs-2">
            <button class="btn btn-fab btn-material-grey-200" id="opensource"><i class="mdi-action-open-in-new"></i></button>
          </div>-->
        </div>
      </div>
    </div>


    <!-- Open source code -->
    <script>
      window.page = window.location.hash || "#about";

      $(document).ready(function() {
        if (window.page != "#about") {
          $(".menu").find("li[data-target=" + window.page + "]").trigger("click");
        }
      });

      $(window).on("resize", function() {
        $("html, body").height($(window).height());
        $(".main, .menu").height($(window).height() - $(".header-panel").outerHeight());
        $(".pages").height($(window).height());
      }).trigger("resize");

      $(".menu li").click(function() {
        // Menu
        if (!$(this).data("target")) return;
        if ($(this).is(".active")) return;
        $(".menu li").not($(this)).removeClass("active");
        $(".page").not(page).removeClass("active").hide();
        window.page = $(this).data("target");
        var page = $(window.page);
        window.location.hash = window.page;
        $(this).addClass("active");


        page.show();

        var totop = setInterval(function() {
          $(".pages").animate({scrollTop:0}, 0);
        }, 1);

        setTimeout(function() {
          page.addClass("active");
          setTimeout(function() {
            clearInterval(totop);
          }, 1000);
        }, 100);
      });
    </script>

    <!-- Sliders -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.min.js"></script>
    <script>
      $(function() {
        $.material.init();
        $(".shor").noUiSlider({
          start: 40,
          connect: "lower",
          range: {
            min: 0,
            max: 100
          }
        });

        $(".svert").noUiSlider({
          orientation: "vertical",
          start: 40,
          connect: "lower",
          range: {
            min: 0,
            max: 100
          }
        });
      });
    </script>

    <!-- Dropdown.js -->
    <script src="https://cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.js"></script>
    <script>
      $("#dropdown-menu select").dropdown();
    </script>


  </body>

</html>
