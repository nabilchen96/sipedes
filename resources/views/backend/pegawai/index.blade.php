@extends('backend.app')
@push('style')

@endpush
@section('content')
    <div class="bg-primary pt-10 pb-21" style="background-image: url('{{ asset('kampung.webp') }}');"></div>
    <div class="container-fluid mt-n22 px-6 mb-5">
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
                                <a class="border nav-link" aria-current="page" href="{{ url('detail-profil') }}/{{ $id }}" style="border-radius: 0; padding: 12px;">
                                    <i class="bi bi-person"></i> Data Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="border nav-link active" href="{{ url('detail-pegawai') }}/{{ $id }}" style="border-radius: 0; padding: 12px;">
                                    <i class="bi bi-person-vcard-fill"></i> Data Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="border nav-link" href="{{ url('detail-keluarga') }}/{{ $id }}" style="border-radius: 0; padding: 12px;">
                                    <i class="bi bi-people-fill"></i> Data Keluarga
                                </a>
                            </li>
                        </ul>
                        <br>
                        <div id="respon_error"></div>
                        <form id="form">
                            <input type="hidden" name="id_user" id="id_user" value="{{ @$id }}">
                            <input type="hidden" name="id" id="id" value="{{ @$profil->id }}">
                            <div class="row">
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Jabatan <sup class="text-danger">*</sup></label>
                                    <input type="text" value="{{ @@$profil->jabatan }}" placeholder="Jabatan" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label for="">Sebagai <sup class="text-danger">*</sup></label>
                                    <input type="text" value="{{ @@$profil->sebagai }}" placeholder="Sebagai" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Bank</label>
                                    <select name="id_bank" id="id_bank" class="form-select">
                                        @php 
                                            $bank = DB::table('banks')->get();
                                        @endphp
                                        @foreach($bank as $b)
                                            <option {{ $profil->id_bank == $b->id ? 'selected' : '' }} value="{{ $b->id }}">{{ $b->bank }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label for="">Nomor Rekening <sup class="text-danger">*</sup></label>
                                    <input type="text" value="{{ @$profil->no_rekening }}" placeholder="No. Rekening" class="form-control" name="no_rekening" id="no_rekening">
                                </div>
                                
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Nama Rekening <sup class="text-danger">*</sup> </label>
                                    <input type="text" placeholder="Nama Rekening" value="{{ @$profil->nama_rekening }}" class="form-control" name="nama_rekening" id="nama_rekening">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Nomor SK</label>
                                    <input type="text" value="{{ @$profil->no_sk }}" placeholder="No. SK" class="form-control" name="no_sk"
                                        id="no_sk">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Siltap</label>
                                    <input type="number" value="{{ @$profil->siltap }}" placeholder="Siltap" class="form-control" name="siltap"
                                        id="siltap">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Potongan BPJS</label>
                                    <input type="number" value="{{ @$profil->potongan_bpjs }}" placeholder="Potongan BPJS" class="form-control" name="potongan_bpjs"
                                        id="potongan_bpjs">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Tunjangan</label>
                                    <input type="number" value="{{ @$profil->tunjangan }}" placeholder="Tunjangan" class="form-control" name="tunjangan"
                                        id="tunjangan">
                                </div>
                                
                                <div class="col-lg-6 form-group mb-4">
                                    <label>TMT Mulai Bertugas</label>
                                    <input type="date" value="{{ @$profil->tmt_mulai_bertugas }}" placeholder="TMT Mulai Bertugas" class="form-control"
                                        name="tmt_mulai_bertugas" id="tmt_mulai_bertugas">
                                </div>
                                
                                <div class="col-lg-6 form-group mb-4">
                                    <label>TMT Berhenti Bertugas</label>
                                    <input type="date" value="{{ @$profil->tmt_berhenti_bertugas }}" placeholder="TMT Berhenti Bertugas" class="form-control"
                                        name="tmt_berhenti_bertugas" id="tmt_berhenti_bertugas">
                                </div>
                            </div>
                            <hr>
                            <button id="tombol_kirim" style="border-radius: 8px;" class="btn btn-info text-white">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        form.onsubmit = (e) => {

            let formData = new FormData(form);

            document.getElementById('respon_error').innerHTML = ``

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                method: 'post',
                url: '/update-pegawai',
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

                        location.reload();

                    } else {
                        //respon 
                        let respon_error = ``
                        Object.entries(res.data.respon).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                respon_error += `<li>${message}</li>`;
                            });
                        });
                        respon_error = `<div class="alert alert-danger text-danger mb-4">${respon_error}</div>`

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
    </script>
@endpush 