<div class="container-fluid">
    <div class="row">

        <!-- Total Number of Cars -->
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="totalCars"></span>
                                </h5>
                                <p class="mb-0 text-sm">Total Cars</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
{{--                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">--}}
{{--                                <img class="w-100" src="{{asset('images/icon-car.png')}}" />--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Cars -->
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="availableCars"></span>
                                </h5>
                                <p class="mb-0 text-sm">Available Cars</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Number of Rentals -->
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="totalRentals"></span>
                                </h5>
                                <p class="mb-0 text-sm">Total Rentals</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Earnings from Rentals -->
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    $<span id="totalEarnings"></span>
                                </h5>
                                <p class="mb-0 text-sm">Total Earnings</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
{{--                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">--}}
{{--                                <img class="w-100" src="{{asset('images/icon-earnings.svg')}}" />--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    getList();
    async function getList() {
        let res = await axios.get("/summary");
        document.getElementById('totalCars').innerText = res.data['totalCars'];
        document.getElementById('availableCars').innerText = res.data['availableCars'];
        document.getElementById('totalRentals').innerText = res.data['totalRentals'];
        document.getElementById('totalEarnings').innerText = res.data['totalEarnings'];
    }

</script>
