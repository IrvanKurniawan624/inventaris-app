<div id="kt_aside" class="aside bg-primary" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-8" id="kt_aside_logo">
        <a href="/">
            <img alt="Logo" src="{{ asset('assets/img/logo-icon.png') }}" class="h-55px" />
        </a>
    </div>
    <div class="aside-nav d-flex flex-column align-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-6" data-kt-menu="true">
            @php
                $sub_url = Request::segment(1);
            @endphp                
            <div class="menu-item py-3">
                <a class="menu-link menu-center @if($sub_url == 'dashboard') active @endif" href="/" title="Dashboard" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                    <span class="menu-icon me-0">
                        <i class="bi bi-grid-fill fs-2"></i>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3 menu-dropdown">
                <span class="menu-link menu-center @if($sub_url == 'apps') active @endif" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Apps">
                    <span class="menu-icon me-0">
                        <i class="bi bi-back fs-2"></i>
                    </span>
                </span>
                <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4" data-popper-placement="right-start" style="z-index: 105; position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(100px, 187px, 0px);">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('barang') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Master Barang</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('kategori') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Kategori</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('supplier') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Supplier</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('peminjam') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Peminjam</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('ruang') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Ruang</span>
                        </a>
                    </div>
                </div>
                
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3 menu-dropdown">
                <span class="menu-link menu-center @if($sub_url == 'transaksi') active @endif" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Transaksi">
                    <span class="menu-icon me-0">
                        <i class="bi bi-cart-plus-fill fs-2"></i>
                    </span>
                </span>
                <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4" data-popper-placement="right-start" style="z-index: 105; position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(100px, 187px, 0px);">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('transaksi.barang_masuk') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Barang Masuk</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('transaksi.barang_keluar') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Barang Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3 menu-dropdown">
                <span class="menu-link menu-center @if($sub_url == 'pinjam') active @endif" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Pinjam Barang">
                    <span class="menu-icon me-0">
                        <i class="fas fa-boxes fs-2"></i>
                    </span>
                </span>
                <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4" data-popper-placement="right-start" style="z-index: 105; position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(100px, 187px, 0px);">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('pinjam') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pinjam Barang</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('pengembalian') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pengembalian Barang</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3 menu-dropdown">
                <span class="menu-link menu-center @if($sub_url == 'laporan') active @endif" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Laporan">
                    <span class="menu-icon me-0">
                        <i class="fas fa-book fs-2"></i>
                    </span>
                </span>
                <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4" data-popper-placement="right-start" style="z-index: 105; position: fixed; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(100px, 187px, 0px);">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('laporan.pinjam') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pinjaman Barang</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Primary menu-->
    </div>
    <!--end::Nav-->
    <div class="aside-footer d-flex flex-column align-items-center flex-column-auto" id="kt_aside_footer">
        <div class="mb-7">
            <a href="{{ route('about') }}">
                <button type="button" class="btn btm-sm btn-icon btn-color-white btn-active-color-primary btn-active-light @if($sub_url == 'about') active @endif" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="top-start" data-bs-toggle="tooltip" title="About This Project">
                    <i class="fas fa-info-circle fs-2"></i>
                </button>
            </a>
        </div>
    </div>
</div>