@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
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
                            <h3 class="mb-0 fw-bold text-white">Dashboard</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card rounded-3">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center
                                            mb-3">
                            <div>
                                <h4 class="mb-0">Users Terdaftar</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary
                                              rounded-1">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div>
                            <h1 class="fw-bold">{{ $user }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card rounded-3">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center
                                            mb-3">
                            <div>
                                <h4 class="mb-0">Keluarahan/Desa</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary
                                              rounded-1">
                                <i class="bi bi-geo-alt-fill fs-4"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div>
                            <h1 class="fw-bold">{{ $desa }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card rounded-3">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center
                                            mb-3">
                            <div>
                                <h4 class="mb-0">Kepala Desa</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary
                                              rounded-1">
                                <i class="bi bi-person-circle fs-4"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div>
                            <h1 class="fw-bold">{{ $kades }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card rounded-3">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center
                                            mb-3">
                            <div>
                                <h4 class="mb-0">Perangkat Desa</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary
                                              rounded-1">
                                <i class="bi bi-boxes fs-4"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div>
                            <h1 class="fw-bold">{{ $perangkat }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row  -->
        <div class="row mt-6">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([-3.4020431, 102.5991136], 10);
        // Adjust default view coordinates

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 21,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Fetch district data from Laravel backend
        fetch('/data-peta') // Adjust this endpoint as necessary
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    const marker = L.marker([district.latitude, district.longitude]).addTo(map);
                    marker.bindPopup(`
                        <strong>${district.name}</strong> <br>
                        ${district.sebagai} ${district.nama_wilayah}
                    `);
                });
            })
            .catch(error => console.error('Error fetching district data:', error));
    </script>
@endpush