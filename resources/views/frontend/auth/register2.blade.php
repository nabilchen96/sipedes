<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="login-form-02/https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="login-form-02/fonts/icomoon/style.css">

    <link rel="stylesheet" href="login-form-02/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login-form-02/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="login-form-02/css/style.css">

    <!-- Select2 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Favicons -->
    <!-- <link href="{{ url('pandu.jpeg') }}" rel="icon">
    <link href="{{ url('pandu.jpeg') }}" rel="apple-touch-icon"> -->

    <title>SIPEDES</title>


    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 15px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
    </style>

</head>

<body>


    <div class="d-lg-flex half" style="height: 125vh !important;">
        <div class="bg order-1 order-md-2" style="background-image: url('sipedes.jpeg');"></div>
        <div class="contents order-2 order-md-1" style="background: white;">
            <div class="container">
                <div class="row align-items-center justify-content-center"
                    style="background: white; margin-top: -50px !important; height: 125vh !important;">
                    <div class="col-md-9">
                        <!-- <h3>Register to <br><strong>APLIKASI PENDATAAN MANDIRI  TENAGA NON ASN</strong></h3> -->
                        <h3>Register to <br> Sistem Informasi <strong><span class="text-danger">SIPEDES</span></strong>
                        </h3>
                        <br>
                        <form id="formRegister">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama <sup class="text-danger">*</sup></label>
                                        <input type="text" name="name" class="border form-control" id="name" placeholder="Nama"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email <sup class="text-danger">*</sup></label>
                                        <input type="email" name="email" class="border form-control" id="email"
                                            placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Lahir <sup class="text-danger">*</sup></label>
                                        <input type="text" name="tempat_lahir" class="border form-control" id="tempat_lahir"
                                            placeholder="Tempat Lahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin <sup class="text-danger">*</sup></label>
                                        <select name="jenis_kelamin" class="border form-control" id="jenis_kelamin" required>
                                            <option>Laki-laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>NIK<sup class="text-danger">*</sup></label>
                                        <input type="number" name="nik" class="border form-control" id="nik" placeholder="NIK"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password <sup class="text-danger">*</sup></label>
                                        <input type="password" name="password" class="border form-control" id="password"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir <sup class="text-danger">*</sup></label>
                                        <input type="date" name="tanggal_lahir" class="border form-control" id="tanggal_lahir"
                                            placeholder="Tanggal Lahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No WA <sup class="text-danger">*</sup></label>
                                        <input type="number" name="no_wa" class="border form-control" id="no_wa"
                                            placeholder="No Whatsapp" readonly value="{{ session('user_otp')->no_wa }}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Wilayah<sup class="text-danger">*</sup></label>
                                <select class="form-control border" style="height: 58px !important; width: 100%;"
                                    name="id_wilayah" id="select2-ajax" required>
                                    <option value="">Pilih Data</option>
                                </select>
                            </div>

                            <br>
                            <div class="d-grid">
                                <button type="submit" id="btnLogin" class="btn btn-primary btn-lg btn-block">Sign
                                    Up</button>

                                <button style="display: none; background: #0d6efd;" id="btnLoginLoading"
                                    class="btn btn-info btn-moodle text-white btn-lg btn-block" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>

                                </button>
                            </div>
                            <br>
                            Have an account? <a href="{{ url('login') }}" class="text-primary">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <!-- Select2 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        formRegister.onsubmit = (e) => {
            e.preventDefault();

            // Ambil lokasi pengguna
            navigator.geolocation.getCurrentPosition(function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Buat FormData dari form
                const formData = new FormData(formRegister);

                // Tambahkan koordinat ke FormData
                formData.append('latitude', latitude);
                formData.append('longitude', longitude);

                // Kirim data dengan Axios
                axios({
                    method: 'post',
                    url: '/registerProses',
                    data: formData,
                })
                    .then(function (res) {
                        if (res.data.responCode == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Mendaftar',
                                text: 'Data anda berhasil diregistrasi, anda bisa menggunakan nip dan password untuk login',
                                timer: 1000,
                                showConfirmButton: false
                            })

                            setTimeout(() => {
                                window.location.href = '/dashboard';
                            }, 1000);
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ada kesalahan',
                                text: `${res.data.respon}`,
                            })
                        }
                    })
                    .catch(function (res) {
                        console.log(res);
                    })
                    .then(function () {
                        document.getElementById(`btnLogin`).style.display = "block";
                        document.getElementById(`btnLoginLoading`).style.display = "none";
                    });

            }, function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengambil Lokasi',
                    text: error.message
                });
            });
        };
    </script>
    <script>
        $(document).ready(function () {
            $('#select2-ajax').select2({
                ajax: {
                    url: '/search-wilayah',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(item => ({ id: item.id, text: item.kode + ', ' + item.nama }))
                        };
                    }
                },
                placeholder: "Cari Data...",
                minimumInputLength: 2
            });
        });
    </script>
</body>

</html>