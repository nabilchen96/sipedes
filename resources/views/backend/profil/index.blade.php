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
            <div class="col-lg-12 mt-4">
                @php
                    
                    $idUser = Auth::id();
                    $showAlert = false;
                    $output = ''; // Simpan isi alert untuk ditampilkan jika perlu

                    // === PROFIL ===
                    $data = DB::table('profils')->where('id_user', $idUser)->first();
                    $fieldsToCheck = ['nik', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'id_wilayah', 'id_jabatan', 'tanggal_mulai_kerja', 'pendidikan_terakhir'];
                    $emptyFields = [];

                    if ($data) {
                        foreach ($fieldsToCheck as $field) {
                            if (is_null($data->$field) || $data->$field === '') {
                                $emptyFields[] = $field;
                            }
                        }
                        if (!empty($emptyFields)) {
                            $showAlert = true;
                            $fieldNames = array_map(function ($field) {
                                $field = preg_replace('/^id_/', '', $field);
                                return ucwords(str_replace('_', ' ', $field));
                            }, $emptyFields);
                            $output .= "<hr><b>a. Data Profil: </b>" . implode(', ', $fieldNames);
                        }
                    }

                    // === PEGAWAI ===
                    $data = DB::table('pegawais')->where('id_user', $idUser)->first();
                    $fieldsToCheck = ['no_rekening', 'id_bank', 'nama_rekening', 'no_sk', 'siltap', 'potongan_bpjs', 'tunjangan', 'tmt_mulai_bertugas', 'tmt_berhenti_bertugas'];
                    $emptyFields = [];

                    if ($data) {
                        foreach ($fieldsToCheck as $field) {
                            if (is_null($data->$field) || $data->$field === '') {
                                $emptyFields[] = $field;
                            }
                        }
                        if (!empty($emptyFields)) {
                            $showAlert = true;
                            $fieldNames = array_map(function ($field) {
                                $field = preg_replace('/^id_/', '', $field);
                                return ucwords(str_replace('_', ' ', $field));
                            }, $emptyFields);
                            $output .= "<br><b>b. Data Pegawai: </b>" . implode(', ', $fieldNames);
                        }
                    }

                    // === KELUARGA ===
                    $data = DB::table('keluargas')->where('id_user', $idUser)->first();
                    if (!$data) {
                        $showAlert = true;
                        $output .= "<br><b>c. Data Keluarga</b>";
                    }
                @endphp

                @if(Auth::user()->role != 'Admin' && $showAlert)
                    <div class="alert alert-danger" role="alert">
                        Segera lengkapi data anda berikut ini:
                        {!! $output !!}
                    </div>
                @endif
            </div>
            <div class="col-md-12 col-12">
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