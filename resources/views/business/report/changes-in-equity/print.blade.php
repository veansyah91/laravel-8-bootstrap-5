@inject('carbon', 'Carbon\Carbon')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Laporan Perubahan Modal</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('vendors/iconly/bold.css') }}" rel="stylesheet">

    <link href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">

    <link href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="p-4">
        {{-- Header --}}
        @if ($identity)
            <div class="header row">
                <div class="col-2" id="logo-bumdes">
                    <img src="{{ asset($identity['logo_usaha']) }}" alt="logo_usaha" class="img-fluid mt-2 p-3" alt="logo_usaha" width="200px" loading='lazy'>
                </div>
                <div class="col-10 my-auto" id="identity">
                    <h4 class="font-bold">{{ $identity['nama_bumdes'] }}</h4>
                    {{ $identity['nama_desa'] }}
                </div>
            </div>
        @endif
        
        <div class="row justify-content-center mb-3">
            <div class="col-12 text-end">
                <h4 class="text-gray font-bold">Unit Usaha : {{ $business->nama }}</h4>
            </div>
        </div>

        <div class="row justify-content-center mb-2" data-business="{{ $business->id }}" id="content">
            <div class="col-12 text-center">
                <h5 class="text-black font-bold" style="font-size: 16pt">Laporan Perubahan Modal
                <h5 class="text-black font-bold" style="font-size: 12pt">Untuk Tahun yang Berakhir Pada Tanggal 31 Desember <span class="periods" id="period-title"></span>

            </div>
        </div>

        <div class="row justify-content-center mb-2 mt-2" data-business="{{ $business->id }}" id="content">
            <div class="row justify-content-center">
                <div class="col-10 text-end">
                    <p class="fst-italic">Periode: <span id="period"></span></p>
                </div>
            </div>

            <div class="row mt-3 justify-content-center">
                <div class="col-10">
                    <h5>Penyertaan Modal Desa</h5>
                    <table class="table">
                        <tbody id="equity">
                            
                        </tbody>
                        <tfoot id="total-current-asset-now">
                            
                        </tfoot>
                    </table>
                </div>
                
            </div>

            <div class="row justify-content-center">
                <div class="col-10">
                    <h5>Laba Ditahan</h5>
                    <table class="table">
                        <tbody id="lost-profit">
                            
                        </tbody>
                        <tfoot id="total-lost-profit-now">
                            
                        </tfoot>
                        
                    </table>

                    <table class="table">
                        <thead id="total-equity">
                            
                        </thead>
                    </table>
                </div>
                
            </div>

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row justify-content-end mx-2" style="margin-top: 6rem">
                <div class="col-4 text-center p-1" style="border-top: 1px solid black;">
                    {{ $author->name }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-10">
            <button class="btn btn-success d-print-none" onclick="funcPrint()">print</button>
        </div>
    </div>
    
    <script>
        function funcPrint()
        {
            window.print()
        }
    </script>

    <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}" defer></script>

    <script src="{{ asset('js/admin/bootstrap.min.js') }}" defer></script>

    <script src="{{ asset('js/public.js') }}" defer></script> 

    <script src="/js/business/report/changes-in-equity-print.js"></script>
    <script src="/js/business/report/api.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>