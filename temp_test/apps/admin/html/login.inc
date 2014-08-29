    <body class="loginPage">

    <div class="container-fluid">

        <div id="header">

            <div class="row-fluid">

                <div class="navbar">
                    <div class="navbar-inner">
                      <div class="container">
                            <a class="brand" href="{@HOMEADMINURL@}">{@COMPANYNAME@}<span class="slogan">erp {@VERSION@}</span></a>
                      </div>
                    </div><!-- /navbar-inner -->
                  </div><!-- /navbar -->
                

            </div><!-- End .row-fluid -->

        </div><!-- End #header -->

    </div><!-- End .container-fluid -->    

    <div class="container-fluid">

        <div class="loginContainer">
            <form class="form-horizontal"  id="loginForm" >
                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="username">
                                {@USERNAMELABEL@}:
                                <span class="icon16 icomoon-icon-user-3 right gray marginR10"></span>
                            </label>
                            <input class="span12" id="username" type="text" name="username" placeholder="{@USERNAMEPLACEHOLDER@}" value="" />
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="password">
                                {@USERPASSLABEL@}:
                                <span class="icon16 icomoon-icon-locked right gray marginR10"></span>
                                <span class="forgot"><a href="{@DOMAIN@}/{@PASSWORDRECOVERYURL@}">{@PASSWORDRECOVERYLABEL@}</a></span>
                            </label>
                            <input class="span12" id="password" type="password" name="password" placeholder="{@USERPASSPLACEHOLDER@}" value="" />
                        </div>
                    </div>
                </div>
                <div class="form-row row-fluid">                       
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="form-actions">
                            <div class="span12 controls">
                                <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" />{@USERREMMEMBERLABEL@} 
                                <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> {@LOGİNTITLE@}</button>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>

            </form>
        </div>

    </div><!-- End .container-fluid -->