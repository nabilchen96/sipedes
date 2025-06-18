@extends('backend.app')
@push('style')

@endpush
@section('content')
    <div class="bg-primary pt-10 pb-21" style="background-image: url('{{ asset('kampung.webp') }}');"></div>
    <div class="container-fluid mt-n22 px-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0 fw-bold text-white">Data Perangkat Desa</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 mt-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white" width="5%">No</th>
                                        <th class="bg-info text-white">Nama/NIK</th>
                                        <th class="bg-info text-white">Email/No. WA</th>
                                        <th class="bg-info text-white">Kode/Wilayah</th>
                                        <th class="bg-info text-white">Jabatan/Sebagai</th>
                                        <th class="bg-info text-white" width="5%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            getData()
        })

        function getData() {
            $("#myTable").DataTable({
                "ordering": true,
                ajax: '/data-profil',
                processing: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },
                columns: [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `${row.name} <br> <b>NIK. ${row.nik}</b>`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `${row.email} <br> ${row.no_wa}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `Kode. ${row.kode} <br> ${row.wilayah}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `${row.jabatan ?? '-'} <br> ${row.sebagai ?? '-'}`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a href="/detail-profil/${row.id_user}">
                            <i style="font-size: 1.5rem;" class="text-success bi bi-grid"></i>
                        </a>`
                    }
                },
                ]
            })
        }

        
    </script>
@endpush