@extends('layouts.app')

@section('navmenu')
    <x-navbar :kategori="$business->kategori" :id="$business->id"/>
@endsection

@section('content')
    <div class="page-heading d-flex justify-content-between my-auto" data-business="{{ $business->id }}" id="content" data-identity="{{ $identity->nama_bumdes }}" data-business-name="{{ $business->nama }}">
        <h3>Pemberian Kredit</h3>

        <div class="d-flex">
            <form class="d-flex input-group mb-3" onsubmit="searchForm(event)">
                <input type="text" class="form-control" placeholder="Cari" aria-label="Cari" aria-describedby="search-input" id="search-input">
                <button class="btn btn-outline-secondary btn-sm" type="submit" id="search-button"><i class="bi bi-search"></i></button>
            </form>
            <div class="mx-1">
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModal" onclick="filterButton()"><i class="bi bi-filter"></i></button>
            </div>
        </div>
        <div class="d-none d-md-block">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" onclick="addData()">Tambah Data</button>
        </div>
        <div class="fixed-bottom text-end mb-3 mr-3 d-md-none ">
            <button class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#createModal" onclick="addData()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-lg-2 col-6 text-end my-auto">
                        <small all class="fst-italic">
                            <span id="count-data"> </span>
                        </small>
                    </div>
                    <div class="col-lg-1 col-1 text-end">
                        <button class="btn btn-sm" id="prev-page" onclick="prevButton()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </button>
                        
                    </div>
                    <div class="col-lg-1 col-1 my-auto">
                        <button class="btn btn-sm" id="next-page" onclick="nextButton()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="fw-bold d-md-flex d-none justify-content-between fw-bold border-top border-bottom py-2 px-1">
                    <div style="width:5%" class="px-2">
                    </div>
                    <div style="width:10%" class="px-2 my-auto">Tanggal</div>
                    <div style="width:15%" class="px-2 my-auto">No. Ref</div>
                    <div style="width:15%" class="px-2 my-auto">No. HP</div>
                    <div style="width:15%" class="px-2 my-auto">Nama</div>
                    <div style="width:15%" class="px-2 my-auto text-center">Tenor</div>                    
                    <div style="width:15%" class="px-2 my-auto text-end">Nilai Kredit (IDR)</div>                    
                    <div style="width:14%" class="px-2 my-auto text-center">Status</div>                    
                </div>

                <div style="height: 350px;" class="overflow-auto custom-scroll" id="list-data">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- Delete Confirmation --}}
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="fs-1 text-danger">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </div>
                    <h4>Hapus Data Pemberian Kredit ?</h4>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit-delete" data-bs-dismiss="modal" onclick="submitDeleteData()">
                        Hapus    
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Show Detail --}}
    <div class="modal fade" id="showDetailModal" tabindex="-1" aria-labelledby="showDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="showDetailModalLabel">Detail Pemberian Kredit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto custom-scroll">
                    <div class="text-center">
                        <h4 id="name-detail"></h4>
                        <p id="status-detail">
                            
                        </p>
                    </div>
                    <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-detail" type="button" role="tab" aria-controls="home-detail" aria-selected="true">Pemberian</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail-detail" type="button" role="tab" aria-controls="detail-detail" aria-selected="false">Detail</button>
                            </li>
                        </ul>
                        <div class="tab-content overflow-auto custom-scroll" id="myTabContent"  style="height: 330px;">
                            <div class="tab-pane fade show active" id="home-detail" role="tabpanel" aria-labelledby="home-tab">
                                <div class="mt-3">
                                    <div class="fw-bold">Produk</div>
                                    <div id="product-name-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Nilai Perolehan (IDR)</div>
                                    <div id="unit-price-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Nilai Penjualan (IDR)</div>
                                    <div id="value-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Tenor</div>
                                    <div id="tenor-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Angsuran Per Bulan (IDR)</div>
                                    <div id="installment-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">DP (IDR)</div>
                                    <div id="downpayment-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Tanggal Pemberian</div>
                                    <div id="date-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Jatuh Tempo</div>
                                    <div id="term-detail"></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Diinput Oleh</div>
                                    <div id="author-detail"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="detail-detail" role="tabpanel" aria-labelledby="detail-tab">
                                <div class="mt-3">
                                    <div class="fw-bold">No HP</div>
                                    <div>: <span id="phone-detail"></span></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">No KK</div>
                                    <div>: <span id="nkk-detail"></span></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">NIK</div>
                                    <div>: <span id="nik-detail"></span></div>
                                    
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Alamat</div>
                                    <div>: <span id="address-detail"></span></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Desa</div>
                                    <div>: <span id="village-detail"></span></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Kecamatan</div>
                                    <div>: <span id="district-detail"></span></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Kabupaten</div>
                                    <div>: <span id="regency-detail"></span></div>
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">Provinsi</div>
                                    <div>: <span id="province-detail"></span></div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-outline-success" id="send-wa" onclick="sendWa()">
                        <i class="bi bi-whatsapp"></i>
                        Kirim Via Whatsapp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- Create Akun --}}
    <form onsubmit="submitData(event)">
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="createModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="setDefault()"></button>
                    </div>
                    <div class="modal-body overflow-auto custom-scroll" style="height: 400px;"> 
                        <h5 class="fw-bold text-center">Identitas</h5>
                        <div>
                            <label for="date-input" class="form-label fw-bold">Tanggal Pemberian</label>
                            <input type="date" class="form-control" id="date-input" placeholder="Tanggal" onchange="changeDate(this)">
                        </div> 
                        <div class="mt-3">
                            <label for="no-ref-input" class="form-label fw-bold">No Ref</label>
                            <input type="text" class="form-control" id="no-ref-input" placeholder="No Ref" onchange="changeNoRef(this)">
                        </div>  
                        <div class="position-relative z-index-1 mt-3">
                            <div class="">
                                <label for="credit-proposal-input" class="form-label fw-bold">No. Pengajuan Kredit (Optional)</label>
                                <div class="mb-1 d-flex">
                                    <input type="text" class="form-control search-input-dropdown" placeholder="No. Pengajuan" aria-label="No. Pengajuan" aria-describedby="create-address" onclick="showCreditApplicationDropdown(this)" onkeyup="changeCreditApplicationDropdown(this)" onchange="changeCreditApplication(this)" id="credit-application-input" autocomplete="off">
                                    <button type="button" class="btn" id="btn-search-order" onclick="deleteCreditApplication()">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-light position-absolute list-group w-100 search-select overflow-auto custom-scroll border border-2 border-secondary d-none" id="credit-application-list" style="max-height: 130px">
                                
                            </div>
                        </div> 
                        <div class="position-relative z-index-1 mt-3" id="nik-input-dropdown">
                            <div class="">
                                <label for="contact-input" class="form-label fw-bold">NIK</label>
                                <div class="mb-1">
                                    <input type="text" class="form-control search-input-dropdown" placeholder="NIK " aria-label="NIK " aria-describedby="create-address" onclick="showContactDropdown(this)" onkeyup="changeContactDropdown(this)" onchange="changeContact(this)" id="contact-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="bg-light position-absolute list-group w-100 search-select overflow-auto custom-scroll border border-2 border-secondary d-none" id="contact-list" style="max-height: 130px">
                                
                            </div>
                        </div>                  
                        <div class="mt-3">
                            <label for="name" class="form-label fw-bold">Nama</label>
                            <input type="text" class="form-control" id="name-input" placeholder="Nama">
                        </div>
                        <h5 class="fw-bold text-center mt-4">Produk</h5>
                        <div class="position-relative z-index-1 mt-3" id="product-input-dropdown">
                            <div class="">
                                <label for="product-input" class="form-label fw-bold">Produk</label>
                                <div class="mb-1">
                                    <input type="text" class="form-control search-input-dropdown" placeholder="Produk" aria-label="Produk" aria-describedby="create-address" onclick="showProductDropdown(this)" onkeyup="changeProductDropdown(this)" onchange="changeProduct(this)" id="product-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="bg-light position-absolute list-group w-100 search-select overflow-auto custom-scroll border border-2 border-secondary d-none" id="product-list" style="max-height: 130px">
                                
                            </div>
                        </div>  
                        <div class="mt-3">
                            <label for="unit-price-input" class="form-label fw-bold">Nilai Perolehan (IDR)</label>
                            <input type="text" class="form-control text-end" 
                            inputmode="numeric" autocomplete="off" 
                            onclick="this.select()" value="0" onkeyup="setCurrencyFormat(this)" onchange="changeTotal(this)" id="unit-price-input">
                        </div>

                        <h5 class="fw-bold text-center mt-4">Harga</h5>
                        <div class="mt-3">
                            <label for="profit-input" class="form-label fw-bold">Profit Per Bulan (%)</label>
                            <input type="text" class="form-control text-end" 
                            inputmode="numeric" autocomplete="off" 
                            onclick="this.select()" value="0" onkeyup="setCurrencyFormat(this)" onchange="changeProfit(this)" id="profit-input">
                        </div>
                        <div class="mt-3">
                            <label for="cost-input" class="form-label fw-bold">Biaya Lain (IDR)</label>
                            <input type="text" class="form-control text-end" 
                            inputmode="numeric" autocomplete="off" 
                            onclick="this.select()" value="0" onkeyup="setCurrencyFormat(this)" onchange="changeCost(this)" id="cost-input">
                        </div>
                        <div class="mt-3">
                            <label for="tenor-input" class="form-label fw-bold">Tenor (Bulan)</label>
                            <input type="text" class="form-control text-end" inputmode="numeric" autocomplete="off" id="tenor-input" placeholder="tenor" onclick="this.select()" value="0" 
                            onkeyup="setCurrencyFormat(this)" onchange="changeTenor(this)">
                        </div>
                        <div class="mt-3">
                            <label for="value-input" class="form-label fw-bold">Nilai (IDR)</label>
                            <input type="text" class="form-control text-end" 
                            inputmode="numeric" autocomplete="off" 
                            onclick="this.select()" value="0" onkeyup="setCurrencyFormat(this)" onchange="changeProfit(this)" id="value-input" readonly>
                        </div>
                        <div class="mt-3">
                            <label for="downpayment-input" class="form-label fw-bold">DP (IDR)</label>
                            <input type="text" class="form-control text-end" 
                            inputmode="numeric" autocomplete="off" 
                            onclick="this.select()" value="0" onkeyup="setCurrencyFormat(this)" onchange="changeDownpayment(this)" id="downpayment-input">
                        </div>
                        <div class="mt-3">
                            <label for="installment-input" class="form-label fw-bold">Angsuran Per Bulan (IDR)</label>
                            <input type="text" class="form-control text-end" 
                            inputmode="numeric" autocomplete="off" 
                            onclick="this.select()" value="0" onkeyup="setCurrencyFormat(this)" onchange="changeInstallment(this)" id="installment-input" readonly>
                        </div>
                        <div class="mt-3">
                            <label for="term-input" class="form-label fw-bold">Tempo</label>
                            <input type="date" class="form-control" id="term-input" placeholder="Tanggal" onchange="changeTerm(this)" readonly>
                        </div> 
                        <div class="position-relative z-index-1 mt-3 d-none" id="account-input-dropdown">
                            <div class="">
                                <label for="contact-input" class="form-label fw-bold">Kas (Akun Debit)</label>
                                <div class="mb-1">
                                    <input type="text" class="form-control search-input-dropdown" placeholder="Kas (Akun Debit)" aria-label="NIK" aria-describedby="account" onclick="showAccountDropdown(this)" onkeyup="changeAccountDropdown(this)" onchange="changeAccount(this)" id="account-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="bg-light position-absolute list-group w-100 search-select overflow-auto custom-scroll border border-2 border-secondary d-none" id="account-list" style="max-height: 130px">
                                
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="setDefault()">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit">
                            <span id="btn-submit-label">Simpan</span>    
                        </button>
                    </div>
            </div>
            </div>
        </div>
    </form>

    {{-- Update Status --}}
    <form onsubmit="submitData(event)">
        <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateStatusModalLabel">Ubah Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="setDefault()"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-between"> 
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="pending" value="pending" onclick="setStatus(this)">
                            <label class="form-check-label text-success" for="pending">
                              Menunggu
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="rejected" value="rejected" checked onclick="setStatus(this)">
                            <label class="form-check-label text-danger" for="rejected">
                                Ditolak
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="approved" value="approved" onclick="setStatus(this)">
                            <label class="form-check-label text-primary" for="approved">
                                Diterima
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="setDefault()">Tutup</button>
                        <button data-bs-dismiss="modal" type="submit" class="btn btn-primary" id="btn-submit">
                            <span id="btn-submit-label">Simpan</span>    
                        </button>
                    </div>
            </div>
            </div>
        </div>
    </form>

    {{-- filter  --}}
    {{-- Modal Filter --}}
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="description-input" class="form-label fw-bold">Tanggal</label>
                        <select class="form-select" id="select-filter" onchange="changeFilter(this)">
                            <option value="today">Hari Ini</option>
                            <option value="this week">Minggu Ini</option>
                            <option value="this month">Bulan Ini</option>
                            <option value="this year">Tahun Ini</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="row d-none" id="date-range">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="start-filter" class="form-label">Dari</label>
                                <input type="date" class="form-control" id="start-filter" placeholder="Tanggal">
                                
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="end-filter" class="form-label">Ke</label>
                                <input type="date" class="form-control" id="end-filter" placeholder="Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description-input" class="form-label fw-bold">Status</label>
                        <select class="form-select" id="select-status" onchange="changeStatus(this)">
                            <option value="all">Semua</option>
                            <option value="pending">Menunggu</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="submitFilter()" data-bs-dismiss="modal">
                        Ok    
                    </button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="/js/business/credit-sales/index.js"></script>
    <script src="/js/business/credit-sales/api.js"></script>
@endsection
