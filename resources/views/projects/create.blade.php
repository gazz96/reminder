@extends('layouts.app')


@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

    <div class="widget-content widget-content-area br-6">

        <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('projects') }}">
                    <span>Data</span>
                </a>
            </li>

        </ul>
        <div class="tab-content pt-4" id="simpletabContent">

            <div class="tab-pane fade show active">


                <div class="row">

                    <div class="col-12">


                        <form action="{{ url('projects') }}" method="POST" enctype="multipart/form-data">

                            <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#informasi_dasar-tab">Informasi Dasar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#reminder-tab">Order</a>
                                </li>

                            </ul>


                            <div class="tab-content" id="simpletabContent">

                                <div class="tab-pane fade show active" id="informasi_dasar-tab">

                                    <div class="form-group">
                                        <label for="i-client">Client</label>
                                        <input name="client" type="text" class="form-control" id="i-client" value="{{ old('client') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-perusahaan">Perubahan</label>
                                        <input name="perusahaan" type="text" class="form-control" id="i-perusahaan" value="{{ old('perusahaan') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-email">Email</label>
                                        <input name="email" type="text" class="form-control" id="i-email" value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-kontak">Kontak</label>
                                        <input name="kontak" type="text" class="form-control" id="i-kontak" value="{{ old('kontak') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-domain">Domain</label>
                                        <input name="domain" type="text" class="form-control" id="i-domain" value="{{ old('domain') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-register">Register</label>
                                        <input name="register" type="text" class="form-control" id="i-register" value="{{ old('register') }}">
                                    </div>

                                    <div class="form-row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="i-tanggal_beli_domain">Tanggal Beli Domain</label>
                                                <input name="tanggal_beli_domain" type="date" class="form-control" id="i-tanggal_beli_domain" value="{{ old('tanggal_beli_domain') }}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="i-tanggal_beli_domain">Tanggal Expired Domain</label>
                                                <input name="tanggal_beli_domain" type="date" class="form-control" id="i-tanggal_beli_domain" value="{{ old('tanggal_expired_domain') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="i-status">Staus</label>
                                        <select name="status" type="text" class="form-control" id="i-status" value="{{ old('status') }}">
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <button class="btn btn-primary">Tambah</button>

                        </form>


                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

@endsection
