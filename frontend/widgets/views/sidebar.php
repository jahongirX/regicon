<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">


            <ul class="kt-menu__nav">

                <li class="kt-menu__item mb-2 mt-2">
                     <span class="badge badge-light p-3" style="font-size: 1rem">Assalomu alaykum , <?=$user->username?></span>
                </li>



                <?php if($user->rank == 10): ?>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="<?=\yii\helpers\Url::to(['/task/add'])?>" class="text-left btn btn-block btn-brand btn-elevate btn-elevate-air">
                        <i class="flaticon-plus"></i>
                        <span class="kt-menu__link-text">Topshiriq yaratish</span>
                    </a>
                </li>

                <li class="kt-menu__item">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-list-2" style="color: cornflowerblue"></i>
                        <span class="kt-menu__link-text">Barcha topshiriqlar</span>
                    </a>
                </li>

                <li class="kt-menu__item">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-checkmark" style="color: limegreen"></i>
                        <span class="kt-menu__link-text">Yopilgan topshiriqlar</span>
                    </a>
                </li>

                <li class="kt-menu__item">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-exclamation" style="color: orangered"></i>
                        <span class="kt-menu__link-text">Muddati buzilganlari</span>
                    </a>
                </li>

                <li class="kt-menu__item">
                    <a href="#" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-statistics" style="color: hotpink"></i>
                        <span class="kt-menu__link-text">Xisobotlar</span>
                    </a>
                </li>

                <li class="kt-menu__item">
                    <a href="<?=\yii\helpers\Url::to(['branch/index'])?>" class="kt-menu__link">
                        <i class="kt-menu__link-icon flaticon-map" style="color: yellowgreen"></i>
                        <span class="kt-menu__link-text">Filiallar</span>
                    </a>
                </li>

                <li class="kt-menu__item">
                    <a href="<?=\yii\helpers\Url::to(['site/exit'])?>" class="kt-menu__link">
                        <i class="kt-menu__link-icon flaticon-logout" style="color: mediumvioletred"></i>
                        <span class="kt-menu__link-text">Chiqish</span>
                    </a>
                </li>

                <?php elseif($user->rank == 100): ?>

                    <li class="kt-menu__item">
                        <a href="#" class="kt-menu__link ">
                            <i class="kt-menu__link-icon flaticon-list-2" style="color: cornflowerblue"></i>
                            <span class="kt-menu__link-text">Barcha topshiriqlar</span>
                        </a>
                    </li>

                    <li class="kt-menu__item">
                        <a href="#" class="kt-menu__link ">
                            <i class="kt-menu__link-icon flaticon2-checkmark" style="color: limegreen"></i>
                            <span class="kt-menu__link-text">Yopilgan topshiriqlar</span>
                        </a>
                    </li>

                    <li class="kt-menu__item">
                        <a href="#" class="kt-menu__link ">
                            <i class="kt-menu__link-icon flaticon-exclamation" style="color: orangered"></i>
                            <span class="kt-menu__link-text">Muddati buzilganlari</span>
                        </a>
                    </li>

                    <li class="kt-menu__item">
                        <a href="#" class="kt-menu__link ">
                            <i class="kt-menu__link-icon flaticon-statistics" style="color: hotpink"></i>
                            <span class="kt-menu__link-text">Xisobotlar</span>
                        </a>
                    </li>

                    <li class="kt-menu__item">
                        <a href="<?=\yii\helpers\Url::to(['site/exit'])?>" class="kt-menu__link">
                            <i class="kt-menu__link-icon flaticon-logout" style="color: mediumvioletred"></i>
                            <span class="kt-menu__link-text">Chiqish</span>
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->