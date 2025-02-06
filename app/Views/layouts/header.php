<!--begin::Header-->
<div id="kt_header" style="" class="header align-items-stretch">
	<!--begin::Container-->
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<!--begin::Aside mobile toggle-->
		<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
			<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
				<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
				<span class="svg-icon svg-icon-2x mt-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
						<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
		</div>
		<!--end::Aside mobile toggle-->
		<!--begin::Mobile logo-->
		<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
			<a href="../../demo1/dist/index.html" class="d-lg-none">
				<img alt="Logo" src="<?= base_url('assets/media/logos/logo-2.svg') ?>" class="h-30px" />
			</a>
		</div>
		<!--end::Mobile logo-->
		<!--begin::Wrapper-->
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
			<!--begin::Navbar-->
			<div class="d-flex align-items-stretch" id="kt_header_nav">
				<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
					<!--begin::Title-->
					<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><?= $title ?? ""; ?></h1>
					<!--end::Title-->
					<!--begin::Separator-->
					<span class="h-20px border-gray-200 border-start mx-4"></span>
					<!--end::Separator-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
						<!--begin::Item-->
						<li class="breadcrumb-item text-muted">
							<span class="text-muted text-hover-primary"><?= $sub_title ?? ""; ?></span>
						</li>
						<!--end::Item-->
					</ul>
					<!--end::Breadcrumb-->
				</div>
			</div>
			<!--end::Navbar-->
			<!--begin::Topbar-->
			<div class="d-flex align-items-stretch flex-shrink-0">
				<!--begin::Toolbar wrapper-->
				<div class="d-flex align-items-stretch flex-shrink-0">
					<!--begin::Notifications-->
					<?php if (session()->get('logged_in') == true) : ?>
						<div class="d-flex align-items-center ms-1 ms-lg-3">
							<!--begin::Menu- wrapper-->
							<div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
								<!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
								<span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2zM18 16V10c0-3.3-2.7-6-6-6s-6 2.7-6 6v6l-2 2v1h16v-1l-2-2z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon-->

							</div>
							<!--begin::Menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
								<!--begin::Heading-->
								<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('assets/media/misc/pattern-1.jpg')">
									<!--begin::Title-->
									<h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifications
										<!--end::Title-->
								</div>
								<!--end::Heading-->
								<!--begin::Tab content-->
								<div class="tab-content">
									<!--begin::Tab panel-->
									<div class="tab-pane fade show active" id="kt_topbar_notifications_2" role="tabpanel">
										<!--begin::Wrapper-->
										<div class="d-flex flex-column px-9">
											<!--begin::Illustration-->
											<div class="px-4 mt-5 scroll-y" style="max-height: 300px; overflow-y: auto;">
												<?php foreach (session()->getFlashdata() as $key => $message) : ?>
													<?php if (strpos($key, 'alert_message_') === 0) : ?>
														<div class="alert alert-primary alert-dismissible fade show" role="alert">
															<?= $message ?>
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
											<!--end::Illustration-->
										</div>
										<!--end::Wrapper-->
									</div>
									<!--end::Tab panel-->
								</div>
								<!--end::Tab content-->
							</div>
							<!--end::Menu-->
							<!--end::Menu wrapper-->
						</div>
					<?php endif; ?>
					<!--end::Notifications-->


					<!--begin::User-->
					<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
						<!--begin::Menu wrapper-->
						<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
							<img src="<?= base_url('assets/media/avatars/150-26.jpg') ?>" alt="user" />
						</div>
						<!--begin::Menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
						<?php if (session()->has('user_id')): ?>
							<!-- Jika user_id ada, tampilkan profil dan logout -->
							<div class="menu-item px-3">
								<div class="menu-content d-flex align-items-center px-3">
									<!--begin::Avatar-->
									<div class="symbol symbol-50px me-5">
										<img alt="Logo" src="<?= base_url('assets/media/avatars/150-26.jpg') ?>" />
									</div>
									<!--end::Avatar-->
									<!--begin::Username-->
									<div class="d-flex flex-column">
										<div class="fw-bolder d-flex align-items-center fs-5"><?= session()->get('nama') ?>
											<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"><?= session()->get('role') ?></span>
										</div>
										<a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?= session()->get('email') ?></a>
									</div>
									<!--end::Username-->
								</div>
							</div>
							<div class="separator my-2"></div>
							<div class="menu-item px-5">
								<a href="<?= base_url('profile') ?>" class="menu-link px-5">My Profile</a>
							</div>
							<div class="menu-item px-5">
								<a href="<?= base_url('logout') ?>" class="menu-link px-5">Sign Out</a>
							</div>
						<?php else: ?>
							<!-- Jika user_id tidak ada, tampilkan login -->
							<div class="menu-item px-5">
								<a href="<?= base_url('login') ?>" class="menu-link px-5">Login</a>
							</div>
						<?php endif; ?>
					</div>
						<!--end::Menu-->
						<!--end::Menu wrapper-->
					</div>
					<!--end::User -->
					<!--begin::Heaeder menu toggle-->
					<div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
						<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
							<!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
									<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
					</div>
					<!--end::Heaeder menu toggle-->
				</div>
				<!--end::Toolbar wrapper-->
			</div>
			<!--end::Topbar-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Container-->
</div>
<!--end::Header-->