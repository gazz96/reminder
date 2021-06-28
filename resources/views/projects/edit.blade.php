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

            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0)">
                    <span>Edit</span>
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

                            </ul>


                            <div class="tab-content" id="simpletabContent">

                                <div class="tab-pane fade show active" id="informasi_dasar-tab">

                                    <div class="form-group">
                                        <label for="i-client">Client</label>
                                        <input name="client" type="text" class="form-control" id="i-client" value="{{ $row->client }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-nama_perusahaan">Perubahan</label>
                                        <input name="nama_perusahaan" type="text" class="form-control" id="i-nama_perusahaan" value="{{ $row->nama_perusahaan }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-email">Email</label>
                                        <input name="email" type="text" class="form-control" id="i-email" value="{{ $row->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-kontak">Kontak</label>
                                        <input name="kontak" type="text" class="form-control" id="i-kontak" value="{{ $row->kontak }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-domain">Domain</label>
                                        <input name="domain" type="text" class="form-control" id="i-domain" value="{{ $row->domain }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="i-register">Register</label>
                                        <input name="register" type="text" class="form-control" id="i-register" value="{{ $row->register }}">
                                    </div>

                                    <div class="form-row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="i-tanggal_beli_domain">Tanggal Beli Domain</label>
                                                <input name="tanggal_beli_domain" type="date" class="form-control" id="i-tanggal_beli_domain" value="{{ $row->tanggal_beli_domain }}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="i-tanggal_beli_domain">Tanggal Expired Domain</label>
                                                <input name="tanggal_beli_domain" type="date" class="form-control" id="i-tanggal_beli_domain" value="{{ $row->tanggal_expired_domain }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="i-status">Staus</label>
                                        <select name="status" type="text" class="form-control" id="i-status">

                                            <?php

                                            $statuses = [
                                                'AKTIF', 'NONAKTIF', 'CANCELED'
                                            ];

                                            ?>

                                            @foreach( $statuses as $status )
                                            <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <button class="btn btn-primary">Update</button>

                        </form>


                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

@endsection
