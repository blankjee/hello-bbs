<div class="header">
    <nav class="navbar container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/mybbs/">
                <img src="static/images/logo.png" alt="BBS论坛系统"
                     width="112" height="28">
            </a>

            <div class="navbar-burger burger" data-target="navMenuExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navMenuExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item " href="area.php?id=1">
                    <span class="emoji">🦌&nbsp;</span>
                    校园生活
                </a>
                <a class="navbar-item " href="area.php?id=2">
                    <span class="emoji">🤛&nbsp;</span>
                    学术交流
                </a>
                <a class="navbar-item " href="area.php?id=3">
                    <span class="emoji">💁&nbsp;</span>
                    休闲娱乐
                </a>
                <a class="navbar-item " href="area.php?id=4">
                    <span class="emoji">🎨&nbsp;</span>
                    二手交易
                </a>
                <a class="navbar-item " href="about.php">
                    <span class="emoji">❤️&nbsp;</span>
                    关于我
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item search-bar">
                    <form id="search-form">
                        <div class="control has-icons-left">
                            <input class="input" placeholder="搜索本站内容">
                            <span class="icon is-small is-left">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </form>
                </div>
                <?php
                //判断用户是否登录，从而显示不同的导航界面
                if (isset($_SESSION['username']) && $_SESSION['username']){
                ?>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link is-active" href="javascript:void(0);">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <div class="navbar-dropdown ">
                            <a class="navbar-item " href="profile.php">
                                我的主页
                            </a>
                            <hr class="navbar-divider"/>

                            <hr class="navbar-divider"/>
                            <a data-no-instant class="navbar-item is-hidden-desktop-only" href="logout.php">
                                注销
                            </a>
                        </div>
                    </div>
                <?php
                }else{
                ?>
                    <a class="navbar-item is-hidden-desktop-only" href="signup.php">
                        注册
                    </a>
                    <a class="navbar-item is-hidden-desktop-only" href="signin.php">
                        登录
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
</div>
