
$(function(){

    window.Main = {
        Helpers: {},
        Models: {},
        Collections: {},
        Views: {}
    }


    Main.Helpers.getBaseUrl = function( url = '') {
        let baseUrl = window.location.origin;
        return baseUrl + url;
    }

    Main.Helpers.getRestUrl = function ( url = '' ) {
        return Main.Helpers.getBaseUrl( '/api/rest' + url );
    }

    Main.Helpers.blockUI = function( name ) {
        $(name).block({
            message: 'Loading...',
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                backgroundColor: 'transparent'
            }
        });

        return this;

    }

    Main.Helpers._ = function( str ) {
        if( ! str ) return '';
        return str;
    };

    Main.Collections.getJenisPermohonan = function( data = {} ) {
        return $.ajax({
            url: Main.Helpers.getRestUrl('jenis-permohonan'),
            data: data
        })
    }

    Main.Models.DataTable = function( data = {} ) {
        return $.ajax( data )
    }

    Main.Helpers.createPagination = function( results ) {
        let html = '';

        html += `<div class="paginating-container pagination-solid" data-toggle="pagination">`;
        html += `<ul class="pagination">`;

            // if( results.prev_page_url ) {
            //     html += `<li><a href="${results.prev_page_url}">Prev</a></li>`;
            // }

            results.links.map((v, i) => {
                html += `<li class="${v.active ? 'active' : ''}">
                    <a href="${v.url}">${v.label}</a>
                </li>`;
            });

            // if( results.next_page_url ) {
            //     html += `<li><a href="${results.next_page_url}">Next</a></li>`
            // }

        html += `</ul>`;
        html += `</div>`;

        return html;
    };

    Main.Helpers.createTable = function( columns = {},  data = {} ) {

        let header = Main.Helpers.generateTableHeader( columns );



    }

    Main.Helpers.generateTableHeader = function( columns ) {

        let html = '<tr>';

        columns.map( (v, i) => {

            //console.log( v );
            html += `<th>`;
            if( v.sort ) {

                html += `


                <a href="javascript:void(0)" class="column-order" data-toggle="columnOrder" data-orderby="${v.field}" data-order="ASC">
                    <span>${v.label}</span>
                    <span class="fas fa-sort-alpha-up order-icon"></span>
                </a>

                `


            } else {

                html += `<span>${v.label}</span>`

            }

            html += `</th>`;


        });

        html += '</tr>';

        return html;

    }

    Main.Helpers.generateTableBody = function ( columns = {}, data = {} ) {
        let html = '';

        data.data.map( (v,i) => {

            html += `<tr>`;

            columns.map( (column, index) => {
                html += '<td>';

                if( column.callback ) {
                    html += column.callback( v );
                }else {
                    html += Main.Helpers._( v[column.field] );
                }
                html += '</td>';
            });
            html += `</tr>`;
        });

        return html;
    }

    Main.Models.DataTableJenisPermohonan = function( data = {} ) {

        Main.Helpers.blockUI( '#datatable-jenis_permohonan' );
        let url = Main.Helpers.getRestUrl( '/jenis-permohonan' );

        return $.ajax({
            url: url,
            data: data,
            success: function( response ) {


                Main.Views.createJenisPermohonanTable( response );
                $('#datatable-jenis_permohonan').unblock();


            }
        })


    }

    Main.Views.createJenisPermohonanTable = function( results ) {

        let html  = '';
        results.data.map((v, i) => {
            //console.log( v );
            html += `
                <tr>
                    <td>${ Main.Helpers._( v.nama_permohonan ) }</td>
                    <td>${ Main.Helpers._( v.deskripsi_permohonan) }</td>
                    <td>
                        <a url='${Main.Helpers.getBaseUrl('/dashboard/jenis-permohonan/' + v.id )}' class='btn btn-warning'>Edit</a>
                        <form action='${Main.Helpers.getBaseUrl('/dashboard/jenis-permohonan/' + v.id)}' method='POST' class='d-inline'>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class='btn btn-danger' onclick="return confirm('DELETE ???')">Delete</button>
                        </form>
                    </td>
                </tr>
            `
        });

        $('#pagination-wrapper').html( Main.Helpers.createPagination(results));
        $('#datatable-jenis_permohonan').find('tbody').html(html);

        $(document).on('click', '[data-toggle=pagination] li > a', function(e){
            e.preventDefault();
            let _this = $(this);

            var block = $('#datatable-jenis_permohonan');
            Main.Helpers.blockUI( block );
            Main.Models.DataTable({
                url: $(this).attr('href'),
                success: function ( response ) {
                    Main.Views.createJenisPermohonanTable( response );
                    block.unblock();
                }
            })
        })

        return this;
    }

    /**
     * View Table Permohonan
     * @param {*} request
     * @returns
     */
    Main.Views.createDataTablePermohonan = function( request = {} ) {


        let dataTablePermohonanBaru = $('#datatable-permohonan_baru');

        Main.Helpers.blockUI( dataTablePermohonanBaru );
        let columns  = [
            {
                sort: true,
                label: 'Nomor',
                field: 'nomor_permohonan'
            },
            {
                sort: true,
                label: 'Nama Pemohon',
                field: 'nama_lengkap'
            },
            {
                sort: false,
                label: 'No KTP',
                field: 'nomor_ktp'
            },
            {
                sort: false,
                label: 'Tanggal',
                field: 'tanggal_permohonan'
            },
            {
                label: 'Status',
                field: 'status_permohonan',
                callback: function( data ) {
                    let badgeStyle = 'primary';

                    if( data.status_permohonan == 'PENDING' ) {
                        badgeStyle = 'warning';
                    }

                    if( data.status_permohonan == 'DRAFT' ) {
                        badgeStyle = 'dark';
                    }

                    if( data.status_permohonan == 'REJECTED' ) {
                        badgeStyle = 'danger';
                    }

                    if( data.status_permohonan == 'SUCCESS' ) {
                        badgeStyle = 'success';
                    }

                    return `<span class="badge badge-${badgeStyle}">${data.status_permohonan}</span>`;
                }
            },
            {
                label: 'Catatan',
                field: 'catatan_koreksi'
            },
            {
                sort: false,
                label: 'Aksi',
                field: 'aksi',
                callback: function ( data ) {

                    return `
                        <a href="${Main.Helpers.getBaseUrl('/dashboard/permohonan-baru/' + data.id)}" class="btn btn-secondary rounded-circle">
                            <span class="fas fa-eye"></span>
                        </a>
                        <a href="${Main.Helpers.getBaseUrl('/dashboard/permohonan-baru/' + data.id + '/edit')}" class="btn btn-warning rounded-circle">
                            <span class="fas fa-edit"></span>
                        </a>
                        <form action='${Main.Helpers.getBaseUrl('/dashboard/permohonan-baru/' + data.id)}' method='POST' class='d-inline'>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class='btn btn-danger rounded-circle' onclick="return confirm('DELETE ???')">
                                <span class="fas fa-trash"></span>
                            </button>
                        </form>

                    `;

                }
            }
        ]

        let thead = dataTablePermohonanBaru.find('thead');



        if( ! thead.html() ) {

            let header = Main.Helpers.generateTableHeader( columns );
            dataTablePermohonanBaru.find('thead').html( header );

        }

        return Main.Models.DataTable({
            url: Main.Helpers.getRestUrl( '/permohonan-baru' ),
            data: request,
        })

        .then( response => {

            dataTablePermohonanBaru.unblock();
            let body = Main.Helpers.generateTableBody( columns, response );
            dataTablePermohonanBaru.find('tbody').html( body );

            return response;

        })



    }


    Main.Models.Forms = {
        permohonanValidation: function() {
        }
    }


    Main.Views.createDataTableProjects = function( request = {} ) {
        let dataTableWrapper = $('#datatable-wrapper');

        Main.Helpers.blockUI( dataTableWrapper );
        let columns  = [
            {
                sort: true,
                label: 'Client',
                field: 'client'
            },
            {
                sort: true,
                label: 'Perusahaan',
                field: 'nama_perusahaan'
            },

            {
                label: 'Email',
                field: 'email'
            },
            {
                label: 'Kontak',
                field: 'kontak'
            },
            {
                label: 'Domain',
                field: 'domain'
            },
            {
                sort: false,
                label: 'Status',
                field: 'status',
                callback: function( data ) {
                    let badgeStyle = 'primary';

                    if( data.status == 'NONAKTIF' ) {
                        badgeStyle = 'warning';
                    }

                    if( data.status == 'AKTIF' ) {
                        badgeStyle = 'success';
                    }

                    return `<span class="badge badge-${badgeStyle}">${Main.Helpers._( data.status )}</span>`;
                }
            },
            {
                sort: false,
                label: 'Aksi',
                field: 'aksi',
                callback: function ( data ) {

                    return `
                        <a href="${Main.Helpers.getBaseUrl('/projects/' + data.id + '/orders')}" class="btn btn-info rounded-circle">
                            <span class="fas fa-list"></span>
                        </a>
                        <a href="${Main.Helpers.getBaseUrl('/projects/' + data.id + '/edit')}" class="btn btn-warning rounded-circle">
                            <span class="fas fa-edit"></span>
                        </a>
                        <form action='${Main.Helpers.getBaseUrl('/projects/' + data.id)}' method='POST' class='d-inline'>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class='btn btn-danger rounded-circle' onclick="return confirm('DELETE ???')">
                                <span class="fas fa-trash"></span>
                            </button>
                        </form>

                    `;

                }
            }
        ]

        let thead = dataTableWrapper.find('thead');



        if( ! thead.html() ) {

            let header = Main.Helpers.generateTableHeader( columns );
            dataTableWrapper.find('thead').html( header );

        }

        return Main.Models.DataTable({
            url: Main.Helpers.getRestUrl( '/projects' ),
            data: request,
        })

        .then( response => {

            dataTableWrapper.unblock();
            let body = Main.Helpers.generateTableBody( columns, response );
            dataTableWrapper.find('tbody').html( body );

            return response;

        })
    }
});


