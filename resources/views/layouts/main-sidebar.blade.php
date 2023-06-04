<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
{{--				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/BFound2.png')}}" class="main-logo" alt="logo"></a>--}}
{{--				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/BFound2.png')}}" class="main-logo dark-theme" alt="logo"></a>--}}
{{--				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/BFound2.png')}}" class="logo-icon" alt="logo"></a>--}}
{{--				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/BFound2.png')}}" class="logo-icon dark-theme" alt="logo"></a>--}}
                <h3 class="desktop-logo logo-light active">كاريزما</h3>
			</div>

			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">كاريزما</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">القوائم</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}"><span class="side-menu__icon"><i class="la la-home"></i></span><span class="side-menu__label">الرئيسية</span></a>
					</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fa fa-users"></i></span><span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page="listUsers") }}">قائمة المستخدمين</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">المناسبات</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page='listEvents') }}">عرض المناسبات</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='addEvent') }}">اضافة مناسبة</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='getEventReg') }}">اضافة كوفي شوب</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='settingEvent') }}">الاعدادات</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fa fa-gamepad"></i></span><span class="side-menu__label">الالعاب</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page="gameIndex") }}">قائمة الالعاب</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fa fa-envelope"></i></span><span class="side-menu__label">Royal</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page="getCouponeActive") }}">الكوبونات المسجلة</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page="couponPage") }}">طباعة الكوبونات</a></li>
                            <li><a class="slide-item" href="{{ route('royal.winner') }}">السحب</a></li>
                            <li><a class="slide-item" href="{{ route('royal.searchCobon.index') }}">البحث عن كوبون</a></li>
                            <li><a class="slide-item" href="{{ route('royal.royalGift') }}">سحب هدايا</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fa fa-envelope"></i></span><span class="side-menu__label">Jawwal</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('jawwal.index') }}">الكوبونات المسجلة</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page="couponPage") }}">طباعة الكوبونات</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fa fa-envelope"></i></span><span class="side-menu__label">QR</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('qr.attachment') }}">Qr PDF</a></li>
                            <li><a class="slide-item" href="{{ route('qr.link') }}">Qr Link</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fa fa-envelope"></i></span><span class="side-menu__label">التصويت</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('polls.index') }}">عرض التصويت</a></li>
                            <li><a class="slide-item" href="{{ route('polls.addpage') }}">اضافة تصويت</a></li>
                        </ul>
                    </li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
