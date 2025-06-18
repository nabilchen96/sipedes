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
                                <a class="border nav-link active" aria-current="page" href="{{ url('detail-profil') }}/{{ $id }}" style="border-radius: 0; padding: 12px;">
                                    <i class="bi bi-person"></i> Data Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="border nav-link" href="{{ url('detail-pegawai') }}/{{ $id }}" style="border-radius: 0; padding: 12px;">
                                  <i class="bi bi-person-vcard-fill"></i>  Data Pegawai
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
                            <input type="hidden" name="id_user" id="id_user" value="{{ $profil->id_user }}">
                            <input type="hidden" name="id" id="id" value="{{ $profil->id }}">
                            <div class="row">
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Nama <sup class="text-danger">*</sup></label>
                                    <input type="text" value="{{ $profil->name }}" placeholder="Nama" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label for="">Email <sup class="text-danger">*</sup></label>
                                    <input type="email" value="{{ $profil->email }}" placeholder="email" class="form-control" name="email" id="email"
                                        required>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label for="">No. WA <sup class="text-danger">*</sup></label>
                                    <input type="text" value="{{ $profil->no_wa }}" placeholder="No. WA" class="form-control" name="no_wa" id="no_wa"
                                        required>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Password</label>
                                    <input type="password" placeholder="password" class="form-control" name="password"
                                        id="password">
                                    <span class="text-danger error" style="font-size: 12px;" id="password_alert"></span>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>NIK <sup class="text-danger">*</sup> </label>
                                    <input type="text" placeholder="NIK" value="{{ $profil->nik }}" class="form-control" name="nik" id="nik" required>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" value="{{ $profil->tanggal_lahir }}" placeholder="Tanggal Lahir" class="form-control" name="tanggal_lahir"
                                        id="tanggal_lahir">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Tempat Lahir</label>
                                    <input type="text" value="{{ $profil->tempat_lahir }}" placeholder="Tempat Lahir" class="form-control" name="tempat_lahir"
                                        id="tempat_lahir">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                        <option {{ $profil->jenis_kelamin == 'Laki-laki' ?? 'selected' }}>Laki-laki</option>
                                        <option {{ $profil->jenis_kelamin == 'Perempuan' ?? 'selected' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Wilayah</label>
                                    <select name="id_wilayah" id="id_wilayah" class="form-select">
                                        @php 
                                            $wilayah = DB::table('wilayahs')->where('jenis', 'Kelurahan/Desa')->get();
                                        @endphp
                                        @foreach($wilayah as $w)
                                            <option {{ $w->id == $profil->id_wilayah ? 'selected' : '' }} value="{{ $w->id }}">KODE {{ $w->kode }} KEL/DESA {{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Jabatan</label>
                                    <select name="id_jabatan" id="id_jabatan" class="form-select">
                                        @php 
                                            $jabatan = DB::table('jabatans')->get();
                                        @endphp
                                        @foreach($jabatan as $j)
                                            <option {{ $j->id == $profil->id_jabatan ? 'selected' : '' }} value="{{ $j->id }}">JABATAN {{ $j->jabatan }} SEBAGAI {{ $j->sebagai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Tanggal Mulai Kerja</label>
                                    <input type="date"value="{{ $profil->tanggal_mulai_kerja }}" placeholder="Tanggal Mulai Kerja" class="form-control"
                                        name="tanggal_mulai_kerja" id="tanggal_mulai_kerja">
                                </div>
                                <div class="col-lg-6 form-group mb-4">
                                    <label>Pendidikan Terkahir</label>
                                    <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select">
                                        <option {{ $profil->pendidikan_terakhir == 'SD' ?? 'selected' }}>SD</option>
                                        <option {{ $profil->pendidikan_terakhir == 'SMP' ?? 'selected' }}>SMP</option>
                                        <option {{ $profil->pendidikan_terakhir == 'SMA' ?? 'selected' }}>SMA</option>
                                        <option {{ $profil->pendidikan_terakhir == 'D1' ?? 'selected' }}>D1</option>
                                        <option {{ $profil->pendidikan_terakhir == 'D2' ?? 'selected' }}>D2</option>
                                        <option {{ $profil->pendidikan_terakhir == 'D3' ?? 'selected' }}>D3</option>
                                        <option {{ $profil->pendidikan_terakhir == 'D4' ?? 'selected' }}>D4</option>
                                        <option {{ $profil->pendidikan_terakhir == 'S1' ?? 'selected' }}>S1</option>
                                        <option {{ $profil->pendidikan_terakhir == 'S2' ?? 'selected' }}>S2</option>
                                        <option {{ $profil->pendidikan_terakhir == 'S3' ?? 'selected' }}>S3</option>
                                    </select>
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
                url: '/update-profil',
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