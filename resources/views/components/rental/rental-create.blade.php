<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Rental</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Car</label>
                                <select class="form-control form-select" id="carSelect">
                                    <option value="">Select Car</option>
                                </select>

                                <label class="form-label mt-2">Customer</label>
                                <select class="form-control form-select" id="customerSelect">
                                    <option value="">Select Customer</option>
                                </select>

                                <label class="form-label mt-2">Rental Start Date</label>
                                <input type="date" class="form-control" id="rentalStartDate">

                                <label class="form-label mt-2">Rental End Date</label>
                                <input type="date" class="form-control" id="rentalEndDate">

                                <label class="form-label mt-2">Total Cost</label>
                                <input type="text" class="form-control" id="totalCost" readonly>

                                <label class="form-label mt-2">Status</label>
                                <select class="form-control form-select" id="rentalStatus">
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    let dailyRentPrice = 0;

    $(document).ready(function() {
        FillCarDropDown();
        FillCustomerDropDown();

        $("#carSelect").change(function() {
            const carId = $(this).val();
            if (carId) {
                fetchDailyRentPrice(carId);
            }
        });

        document.getElementById('rentalStartDate').addEventListener('change', calculateTotalCost);
        document.getElementById('rentalEndDate').addEventListener('change', calculateTotalCost);
    });

    async function FillCarDropDown() {
        let res = await axios.get("/list-cars-id");
        res.data.forEach(function (item) {
            let option = `<option value="${item['id']}">${item['name']} (${item['brand']})</option>`;
            $("#carSelect").append(option);
        });
    }

    async function FillCustomerDropDown() {
        let res = await axios.get("/list-users-id");
        res.data.forEach(function (item) {
            let option = `<option value="${item['id']}">${item['name']}</option>`;
            $("#customerSelect").append(option);
        });
    }

    async function fetchDailyRentPrice(carId) {
        try {
            let res = await axios.get(`/get-car-price/${carId}`);
            dailyRentPrice = res.data.daily_rent_price || 0;
            calculateTotalCost();
        } catch (error) {
            console.error("Error fetching daily rent price:", error);
            dailyRentPrice = 0;
        }
    }

    function calculateTotalCost() {
        const rentalStartDate = new Date(document.getElementById('rentalStartDate').value);
        const rentalEndDate = new Date(document.getElementById('rentalEndDate').value);

        if (rentalStartDate && rentalEndDate && rentalEndDate > rentalStartDate) {
            const rentalDays = Math.ceil((rentalEndDate - rentalStartDate) / (1000 * 60 * 60 * 24));
            const totalCost = dailyRentPrice * rentalDays;
            document.getElementById('totalCost').value = totalCost.toFixed(2);
        } else {
            document.getElementById('totalCost').value = "";
        }
    }

    async function Save() {
        let carId = document.getElementById('carSelect').value;
        let customerId = document.getElementById('customerSelect').value;
        let rentalStartDate = document.getElementById('rentalStartDate').value;
        let rentalEndDate = document.getElementById('rentalEndDate').value;
        let totalCost = document.getElementById('totalCost').value;
        let rentalStatus = document.getElementById('rentalStatus').value;

        if (!carId) {
            errorToast("Car Required!");
        } else if (!customerId) {
            errorToast("Customer Required!");
        } else if (!rentalStartDate) {
            errorToast("Rental Start Date Required!");
        } else if (!rentalEndDate) {
            errorToast("Rental End Date Required!");
        } else if (!totalCost) {
            errorToast("Total Cost Required!");
        } else {
            document.getElementById('modal-close').click();

            let rentalData = {
                car_id: carId,
                customer_id: customerId,
                rental_start_date: rentalStartDate,
                rental_end_date: rentalEndDate,
                total_cost: totalCost,
                status: rentalStatus
            };

            showLoader();
            let res = await axios.post("/create-rental", rentalData);
            hideLoader();

            if (res.status === 201) {
                successToast('Rental created successfully!');
                await getList();
            } else {
                errorToast("Request failed!");
            }
        }
    }
</script>
