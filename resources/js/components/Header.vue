<template>
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                    <!--begin::Header Nav-->
                    <ul class="menu-nav">
                        <li
                            class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active">
                            <a :href="$FRONTEND_URL" class="menu-link" target="_blank">
                                <span class="menu-text">Visit Website</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->
            <div class="topbar">
                <!--begin::Notifications-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                           <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <defs/>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                           </span>

                            <span class="pulse-ring"></span>
                        </div>
                    </div>
                    <!--end::Toggle-->
                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                        <form>
                            <!--begin::Header-->
                            <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
                                style="background-image: url('./backend/assets/img/profile-bg.jpg')">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-2">
                                        <img alt="Logo"
                                            src="https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg">
                                    </div>
                                        <!--end::Avatar-->
                                        <!--begin::Username-->
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center fs-5 text-white">

                                                {{ user?.full_name }}
                                                <span
                                                    class="badge badge-warning fw-bold fs-8 px-2 py-1 ms-2 text-white text-capitalize">
                                                {{user?.role}}
                                            </span>
                                            </div>
                                            <a href="#" class="fw-semibold fs-7 text-white">
                                                {{ user?.email }}
                                            </a>
                                        </div>
<!--                                        <div>-->
<!--                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">-->
<!--                                                <g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="#888888" d="M13.5 3a1.5 1.5 0 0 0-3 0v10a1.5 1.5 0 0 0 3 0V3ZM7.854 5.75a1.5 1.5 0 1 0-1.661-2.5A10.492 10.492 0 0 0 1.5 12c0 5.799 4.701 10.5 10.5 10.5S22.5 17.799 22.5 12c0-3.654-1.867-6.87-4.693-8.75a1.5 1.5 0 0 0-1.66 2.5a7.5 7.5 0 1 1-8.292 0Z"/></g></svg>-->
<!--                                        </div>-->
                                    </div>
                                    <!--end::Username-->


                                <!--end::Title-->
                                <!--begin::Tabs-->
                                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show text-black" data-toggle="tab"
                                            href="#topbar_notifications_notifications">Profile</a>
                                    </li>
<!--                                    <li class="nav-item">-->
<!--                                        <a class="nav-link text-black" data-toggle="tab"-->
<!--                                            href="#topbar_notifications_events">Notification</a>-->
<!--                                    </li>-->
<!--                                    <li class="nav-item">-->
<!--                                        <a class="nav-link text-black" data-toggle="tab" href="#topbar_notifications_logs">Messages</a>-->
<!--                                    </li>-->
                                </ul>
                                <!--end::Tabs-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Content-->
                            <div class="tab-content">
                                <!--begin::Tabpane-->
                                <div class="tab-pane active show p-8" id="topbar_notifications_notifications"
                                    role="tabpanel">
                                    <!--begin::Scroll-->
                                    <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300"
                                        data-mobile-height="200">
                                        <!--begin::Item-->
<!--                                        <div class="d-flex align-items-center mb-6">-->
<!--                                            &lt;!&ndash;begin::Symbol&ndash;&gt;-->
<!--                                            <div class="symbol symbol-40 symbol-light-primary mr-5">-->
<!--                                                <span class="symbol-label">-->
<!--                                                    <span class="svg-icon svg-icon-lg svg-icon-primary">-->
<!--                                                        &lt;!&ndash;begin::Svg Icon | path:{{ asset('backend/assets/media/svg/icons/Home/Library.svg') }}&ndash;&gt;-->
<!--                                                        <svg xmlns="http://www.w3.org/2000/svg"-->
<!--                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"-->
<!--                                                            height="24px" viewBox="0 0 24 24" version="1.1">-->
<!--                                                            <g stroke="none" stroke-width="1" fill="none"-->
<!--                                                                fill-rule="evenodd">-->
<!--                                                                <rect x="0" y="0" width="24" height="24" />-->
<!--                                                                <path-->
<!--                                                                    d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"-->
<!--                                                                    fill="#000000" />-->
<!--                                                                <rect fill="#000000" opacity="0.3"-->
<!--                                                                    transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"-->
<!--                                                                    x="16.3255682" y="2.94551858" width="3" height="18"-->
<!--                                                                    rx="1" />-->
<!--                                                            </g>-->
<!--                                                        </svg>-->
<!--                                                        &lt;!&ndash;end::Svg Icon&ndash;&gt;-->
<!--                                                    </span>-->
<!--                                                </span>-->
<!--                                            </div>-->
<!--                                            &lt;!&ndash;end::Symbol&ndash;&gt;-->
<!--                                            &lt;!&ndash;begin::Text&ndash;&gt;-->
<!--                                            <div class="d-flex flex-column font-weight-bold">-->
<!--                                                <a href="#"-->
<!--                                                    class="text-dark text-hover-primary mb-1 font-size-lg">Profile</a>-->
<!--                                                <span class="text-muted">Goto your profile</span>-->
<!--                                            </div>-->
<!--                                            &lt;!&ndash;end::Text&ndash;&gt;-->
<!--                                        </div>-->
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-6">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40 symbol-light-warning mr-5">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                        <!--begin::Svg Icon | path:{{ asset('backend/assets/media/svg/icons/Communication/Write.svg') }}-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path
                                                                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column font-weight-bold">
                                                <a href="/logout"
                                                    class="text-dark-75 text-hover-primary mb-1 font-size-lg">Logout</a>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Tabpane-->
                                <!--begin::Tabpane-->
                                <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                    <!--begin::Nav-->
                                    <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300"
                                        data-mobile-height="200">
                                        <!--begin::Item-->
                                        <a href="#" class="navi-item">
                                            <div class="navi-link">
                                                <div class="navi-icon mr-2">
                                                    <i class="flaticon2-line-chart text-success"></i>
                                                </div>
                                                <div class="navi-text">
                                                    <div class="font-weight-bold">New report has been
                                                        received
                                                    </div>
                                                    <div class="text-muted">23 hrs ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="navi-item">
                                            <div class="navi-link">
                                                <div class="navi-icon mr-2">
                                                    <i class="flaticon2-paper-plane text-danger"></i>
                                                </div>
                                                <div class="navi-text">
                                                    <div class="font-weight-bold">Finance report has
                                                        been generated
                                                    </div>
                                                    <div class="text-muted">25 hrs ago</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Tabpane-->
                                <!--begin::Tabpane-->
                                <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                    <!--begin::Nav-->
                                    <div class="d-flex flex-center text-center text-muted min-h-200px">
                                        All caught up!
                                        <br />No new notifications.
                                    </div>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Tabpane-->
                            </div>
                            <!--end::Content-->
                        </form>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Notifications-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
</template>

<script>
export default {
    data(){
        return {
            user: User.userInfo(),
        }
    }
}
</script>

<style></style>
