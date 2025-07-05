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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Favicons -->
  <!-- <link href="{{ url('pandu.jpeg') }}" rel="icon">
  <link href="{{ url('pandu.jpeg') }}" rel="apple-touch-icon"> -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    @media (max-width: 768px) {
      .bg {
        display: none;
      }
    }
    .bg {
      position: relative;
      background-size: cover;
      background-position: center;
      min-height: 100vh; /* agar gambar memenuhi tinggi */
    }

    /* Overlay hitam transparan */
    .bg-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4); /* Sesuaikan tingkat kegelapan */
      z-index: 1;
    }

    /* Kontainer logo di bagian bawah */
    .logo-container {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 2;
      display: flex;
      gap: 20px;
      justify-content: center;
      align-items: center;
    }

    .logo-container img {
      /* height: 40px; Ukuran logo */
      filter: drop-shadow(0 0 2px white); /* Tambahkan efek agar makin terlihat */
    }

    .carousel-wrapper {
      position: absolute;
      bottom: 200px; /* posisikan di atas logo */
      left: 50%;
      transform: translateX(-50%);
      width: 80%; /* biar tidak full */
      max-width: 800px;
      z-index: 2;
      border-radius: 10px;
      overflow: hidden;
      /* box-shadow: 0 0 20px rgba(255, 255, 255, 0.2); */
    }

    .carousel-inner img {
      height: 500px;
      object-fit: cover;
      border-radius: 10px;
    }

  </style>
  <title>SIPEDES</title>
</head>

<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('pegunungan.jpeg') }}');">
      <div class="bg-overlay"></div>

      <div class="carousel-wrapper">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <!-- Carousel controls & items -->
           @php
              $slide = DB::table('slide_shows')->where('status', 'Aktif')->get();
            @endphp
          <div class="carousel-indicators">
            @foreach($slide as $k => $se)
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $k+1 }}" class="active" aria-current="true" aria-label="Slide 1"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
            
            @foreach($slide as $s)
              <div class="carousel-item">
                <img style="height: 500px;" src="{{ asset('slide_show') }}/{{ $s->gambar }}" class="d-block w-100" alt="...">
              </div>
            @endforeach
          </div>
          
        </div>
      </div>


      <div class="logo-container">
        <img src="{{ asset('berakhlak.png') }}" width="200px" alt="Logo 1">
        <img src="{{ asset('bangga.png') }}" width="200px" alt="Logo 2">
        <img src="{{ asset('MAHABA3.png') }}" width="200px" alt="Logo 3">
      </div>
    </div>

    <div class="contents order-2 order-md-1" style="background: white;">

      <div class="container">
        <div class="row align-items-center justify-content-center" style="background: white; margin-top: -50px !important;">
          <div class="col-md-7">
            <h3>Login to <br> Sistem Informasi <strong><span class="text-danger">SIPEDES</span></strong></h3>
            <br>
            <form id="formLogin">
              <div class="form-group first">
                <label>Email</label>
                <input type="text" class="border form-control" placeholder="Email" id="nip_email" name="nip_email" required>
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="border form-control" name="password" placeholder="Your Password" id="password"
                  required>
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked" />
                  <div class="control__indicator"></div>
                </label>
                {{-- <span class="ml-auto"><a href="login-form-02/#" class="forgot-pass">Forgot Password</a></span> --}}
              </div>

              <div class="d-grid">
                <button type="submit" id="btnLogin" class="btn btn-primary btn-lg btn-block">Sign in</button>

                <button style="display: none; background: #0d6efd;" id="btnLoginLoading"
                  class="btn btn-info btn-moodle text-white btn-lg btn-block" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                </button>
              </div>
              <br>
              Dont Have an account? <a href="{{ url('register') }}" class="text-primary">Register</a> <br>
              Forget Password? <a href="{{ url('reset-password') }}" class="text-primary">Reset Password</a>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    formLogin.onsubmit = (e) => {

      e.preventDefault();

      const formData = new FormData(formLogin);
      document.getElementById(`btnLogin`).style.display = "none";
      document.getElementById(`btnLoginLoading`).style.display = "block";

      axios({
        method: 'post',
        url: '/loginProses',
        data: formData,
      })
        .then(function (res) {
          //handle success
          if (res.data.responCode == 1) {

            Swal.fire({
              icon: 'success',
              title: 'Berhasil Login',
              timer: 1000,
              text: 'Anda akan diarahkan ke halaman dashboard',
              showConfirmButton: false,
              // text: res.data.respon
            })

            setTimeout(() => {
              location.reload(res.data.respon);
            }, 1500);

          } else {

            Swal.fire({
              icon: 'warning',
              title: 'Ada kesalahan',
              text: `${res.data.respon}`,
            })
          }
        })
        .catch(function (res) {
          //handle error
          console.log(res);
        }).then(function () {
          // always executed              
          document.getElementById(`btnLogin`).style.display = "block";
          document.getElementById(`btnLoginLoading`).style.display = "none";

        });

    }
  </script>

</body>

</html>