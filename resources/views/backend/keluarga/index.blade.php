@extends('backend.app')
@push('style')

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
                            <h3 class="mb-0 fw-bold text-white">Data Perangkat Desa</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12 mt-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="border nav-link" aria-current="page" href="{{ url('detail-profil') }}/{{ $id }}"
                                    style="border-radius: 0; padding: 12px;"><i class="bi bi-person"></i> Data Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="border nav-link" href="{{ url('detail-pegawai') }}/{{ $id }}"
                                    style="border-radius: 0; padding: 12px;"><i class="bi bi-person-vcard-fill"></i> Data Pegawai</a>
                            </li>
                            <li class="nav-item">
                                <a class="border nav-link active" href="#" style="border-radius: 0; padding: 12px;"><i class="bi bi-people-fill"></i> Data
                                    Keluarga</a>
                            </li>
                        </ul>
                        <br>
                        <button data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-info text-white mb-4"
                            style="border-radius: 8px;">Tambah</button>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="bg-info text-white" width="5%">No</th>
                                        <th class="bg-info text-white">Nama</th>
                                        <th class="bg-info text-white">NIK</th>
                                        <th class="bg-info text-white">Sebagai</th>
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
                                <input type="hidden" name="id_user" id="id_user" value="{{ $id }}">
                                <div class="form-group mb-4">
                                    <label for="">Nama <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="Nama" class="form-control" id="nama_keluarga"
                                        name="nama_keluarga" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="">NIK <sup class="text-danger">*</sup></label>
                                    <input type="text" placeholder="NIK" class="form-control" id="nik"
                                        name="nik" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="">Sebagai <sup class="text-danger">*</sup></label>
                                    <select name="sebagai" id="sebagai" class="form-select" required>
                                        <option>Pasangan</option>
                                        <option>Anak</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="">Pasangan/Anak Ke <sup class="text-danger">*</sup></label>
                                    <input type="number" placeholder="Pasangan/Anak Ke" class="form-control" name="urutan" id="urutan" required>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            getData()
        })

        function getData() {
            $("#myTable").DataTable({
                "ordering": true,
                ajax: '/data-keluarga/{{ $id }}',
                processing: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },
                columnDefs: [
                    { orderable: false, targets: [1] } // Kolom ke-0 dan ke-2 tidak bisa di-sort
                ],
                columns: [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nama_keluarga"
                },
                {
                    data: "nik"
                },
                {
                    render: function (data, type, row, meta) {
                        return `${row.sebagai} Ke ${row.urutan}`
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
                modal.find('#nama_keluarga').val(cokData[0].nama_keluarga);
                modal.find('#nik').val(cokData[0].nik);
                modal.find('#sebagai').val(cokData[0].sebagai);
                modal.find('#urutan').val(cokData[0].urutan);
            }
        });



        form.onsubmit = (e) => {

            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: formData.get('id') == '' ? '/store-keluarga' : '/update-keluarga',
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
                    axios.post('/delete-keluarga', {
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