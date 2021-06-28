@extends('layouts.app')


@section('content')


<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

    <div class="widget-content widget-content-area br-6">

        <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0)">
                    <span>Data</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard/permohonan-baru/create') }}">
                    <span>Tambah</span>
                </a>
            </li>
        </ul>
        <div class="tab-content pt-4" id="simpletabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                    <div class="col-12 col-md-6">

                        <div class="input-group">


                            <input type="text" class="form-control" id="form-search" placeholder="Masukkan keyword">
                            <select id="form-searchBy" class="form-control">
                                <option value="nomor_permohonan">Nomor Pemohon</option>
                                <option value="nomor_ktp">Nomor KTP</option>
                                <option value="nama_lengkap">Nama Lengkap</option>
                            </select>

                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary" id="triggerFilter">Filter</button>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-6"></div>

                </div>

                <div class="table-responsive mb-4 mt-4">

                    <table id="datatable-permohonan_baru" class="table table-hover">

                        <thead></thead>
                        <tbody></tbody>

                    </table>
                    <div id="pagination-wrapper"></div>

                </div>

            </div>
        </div>

    </div>

</div>


@endsection


@section('footer_scripts')



    <script>
        $(function(){

            let request = {
                search: '',
                order: '',
                orderBy: '',
                searchBy: '',
            }



            $(document).on('click', '[data-toggle=columnOrder]', function(){

                let _this   = $(this);
                let orderBy = _this.data('orderby');
                let order   = _this.data('order');

                request.orderBy = orderBy;
                request.order   = order;
                request.search  = $('#form-search').val();
                request.searchBy  = $('#form-searchBy').val();

                console.log( request );

                Main.Views.createDataTablePermohonan( request )
                .then( ( response ) => {

                    $('#pagination-wrapper').html( Main.Helpers.createPagination( response ) )
                    if( order == 'ASC') {
                        _this.data('order', 'DESC');
                    }

                    if( order == 'DESC') {
                        _this.data('order', 'ASC');
                    }
                });

            })

            $('#triggerFilter').click(function(){
                request.order   = '';
                request.search  = $('#form-search').val();
                request.searchBy = $('#form-searchBy').val();
                Main.Views.createDataTablePermohonan( request )
                .then( response => {
                    $('#pagination-wrapper').html( Main.Helpers.createPagination( response ) )
                });


            })

            Main.Views.createDataTablePermohonan()
                .then( response => {
                    $('#pagination-wrapper').html( Main.Helpers.createPagination( response ) )
                });

            $(document).on('click', '[data-toggle=pagination] li > a', function(e){
                e.preventDefault();
                let _this   = $(this);
                let url     = _this.attr('href');
                var block   = $('#datatable-permohonan_baru');


                const urlParams = new URL( url );
                request.page = urlParams.searchParams.get('page');


                Main.Views.createDataTablePermohonan( request )
                    .then( response => {
                        $('#pagination-wrapper').html( Main.Helpers.createPagination( response ) )
                    });


            })

        })

    </script>

@endsection
