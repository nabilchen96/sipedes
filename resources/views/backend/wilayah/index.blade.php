@extends('backend.app')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<style>
    .ts-control{
        border-radius: 0.375rem; 
        line-height: 1.5 !important; 
        font-size: 0.9375rem !important;
        padding: 0.5rem 1rem !important;
    }
</style>
@endpush
@section('content')
    <div class="bg-primary pt-10 pb-21" style="
        background-image: url('{{ asset('kampung.webp') }}');">
    </div>
    <div class="container-fluid mt-n22 px-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0 fw-bold text-white">Data Wilayah</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 mt-6">
                <div class="card">
                    <div class="card-body">
                        <button data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-info text-white mb-4"
                            style="border-radius: 8px;">Tambah</button>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white" width="5%">No</th>
                                        <th class="bg-info text-white">Kode</th>
                                        <th class="bg-info text-white">Nama Wilayah / Jenis</th>
                                        <th class="bg-info text-white" width="25%">Latitude/Longitude</th>

                                        <th class="bg-info text-white" width="5%"></th>
                                        <th class="bg-info text-white" width="5%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Wilayah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="form">
                            <div class="modal-body">
                                <div id="respon_error" class="text-danger mb-4"></div>
                                <input type="hidden" name="id" id="id">
                                <div class="form-group mb-4">
                                    <label>Kode <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Kode" class="form-control" id="kode" name="kode"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nama Wilayah <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Nama Wilayah" class="form-control" id="nama" name="nama"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Jenis <sup class="text-danger">*</sup></label>
                                    <select name="jenis" class="form-select" id="jenis" required>
                                        <option value="">-- Jenis --</option>
                                        <option>Provinsi</option>
                                        <option>Kabupaten/Kota</option>
                                        <option>Kecamatan</option>
                                        <option>Kelurahan/Desa</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Induk</label>
                                    <select name="induk" class="select-2" id="induk">
                                        <option value="">-- Induk --</option>
                                        @php 
                                            $w = DB::table('wilayahs')->whereNotIn('jenis', ['Kelurahan/Desa'])->get();
                                        @endphp
                                        @foreach($w as $w)
                                            <option value="{{ $w->id }}">{{ $w->kode }}. {{ $w->jenis }} {{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Latitude</label>
                                    <input type="text" placeholder="Latitude" class="form-control" id="latitude" name="latitude">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Longitude</label>
                                    <input type="text" placeholder="Longitude" class="form-control" id="longitude" name="longitude">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="border-radius: 20px;" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button id="tombol_kirim" style="border-radius: 20px;" class="btn btn-info text-white">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        let select = ''
        document.addEventListener('DOMContentLoaded', function () {
            getData()
            select = new TomSelect('#induk');
        })


        function getData() {
            $("#myTable").DataTable({
                "ordering": true,
                ajax: '/data-wilayah',
                processing: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },
                columnDefs: [
                    { orderable: false, targets: [5] } // Kolom ke-0 dan ke-2 tidak bisa di-sort
                ],
                columns: [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "kode"
                },
                {
                    render: function (data, type, row, meta) {
                        return `${row.nama ?? '-'} <br> <b>${row.jenis ?? ''}</b>`;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `Latitude ${row.latitude ?? '-'} <br> Longitude ${row.longitude ?? ''}`;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a data-bs-toggle="modal" data-bs-target="#modal"
                            data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                            <i style="font-size: 1.5rem;" class="text-success bi bi-grid"></i>
                        </a>`
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return `<a href="javascript:void(0)" onclick="hapusData(` + (row.id) + `)">
                            <i style="font-size: 1.5rem;" class="text-danger bi bi-trash"></i>
                        </a>`
                    }
                },
                ]
            })
        }

        $('#modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('bs-id'); // Extract info from data-* attributes
            var cok = $("#myTable").DataTable().rows().data().toArray();

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            });

            document.getElementById("form").reset();
            document.getElementById('id').value = '';
            $('.error').empty();

            if (recipient) {
                // Edit Mode
                var modal = $(this);
                modal.find('#id').val(cokData[0].id);
                modal.find('#kode').val(cokData[0].kode);
                modal.find('#nama').val(cokData[0].nama);
                modal.find('#jenis').val(cokData[0].jenis);
                modal.find('#induk').val(cokData[0].induk);
                modal.find('#latitude').val(cokData[0].latitude);
                modal.find('#longitude').val(cokData[0].longitude);
                select.setValue(cokData[0].induk);
                
            }
        });



        form.onsubmit = (e) => {

            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-wilayah' : '/update-wilayah',
                data: formData,
            })
                .then(function (res) {
                    //handle success         
                    if (res.data.responCode == 1) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        })

                        $("#modal").modal("hide");
                        $('#myTable').DataTable().clear().destroy();
                        getData()

                    } else {
                        //respon 
                        let respon_error = ``
                        Object.entries(res.data.respon).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                respon_error += `<li>${message}</li>`;
                            });
                        });

                        document.getElementById('respon_error').innerHTML = respon_error

                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function (res) {
                    document.getElementById("tombol_kirim").disabled = false;
                    //handle error
                    console.log(res);
                });
        }

        hapusData = (id) => {
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.value) {
                    axios.post('/delete-wilayah', {
                        id
                    })
                        .then((response) => {
                            if (response.data.responCode == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    timer: 2000,
                                    showConfirmButton: false
                                })

                                $('#myTable').DataTable().clear().destroy();
                                getData();

                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal...',
                                    text: response.data.respon,
                                })
                            }
                        }, (error) => {
                            console.log(error);
                        });
                }

            });
        }
    </script>
@endpush