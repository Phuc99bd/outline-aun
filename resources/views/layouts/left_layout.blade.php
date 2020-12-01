<div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar ps">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu metismenu">
                                <li class="app-sidebar__heading">Tổng quan</li>
                                <li>
                                    <a href="/dashboard" class="mm-active" aria-expanded="false">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Tổng quan
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Chức năng</li>
                                
                                @if($user->role == 1)

                                <li class="">
                                    <a href="#" aria-expanded="false">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Cài đặt
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse" style="height: 7.04px;">
                                        <li>
                                            <a href="/elo">
                                                <i class="metismenu-icon"></i>
                                                ELO
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/subject">
                                                <i class="metismenu-icon">
                                                </i>Subjects
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/setting">
                                                <i class="metismenu-icon">
                                                </i>Cài đặt chung
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Users</li>
                                <li class="">
                                    <a href="/users" aria-expanded="false">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Users
                                        <i class="metismenu-state-icon caret-left"></i>
                                    </a>
                                </li>
                                @endif
                                
                                
                                <li class="app-sidebar__heading">Outline</li>
                                <li class="">
                                    <a href="/outline" aria-expanded="false">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Outline
                                        <i class="metismenu-state-icon caret-left"></i>
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Faculty</li>
                                <li class="">
                                    <a href="/faculty" aria-expanded="false">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Faculty
                                        <i class="metismenu-state-icon caret-left"></i>
                                    </a>
                                </li>
                                
                                <li class="app-sidebar__heading">PRO Version</li>
                                <li>
                                    <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank" aria-expanded="false">
                                        <i class="metismenu-icon pe-7s-graph2">
                                        </i>
                                        Upgrade to PRO
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                </div>