<div class="modal animated zoomIn" id="rental-update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Rental</h5>
            </div>
            <div class="modal-body">
                <form id="rental-update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer *</label>
                                <input type="text" class="form-control" id="rentalCustomerUpdate">
                                <input class="d-none" id="rentalUpdateID">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Car *</label>
                                <select class="form-select" id="rentalCarUpdate">
                                    <option value="SUV">SUV</option>
                                    <option value="Sedan">Sedan</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Rental Start Date *</label>
                                <input type="date" class="form-control" id="rentalStartDateUpdate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Rental End Date *</label>
                                <input type="date" class="form-control" id="rentalEndDateUpdate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Total Cost *</label>
                                <input type="number" class="form-control" id="rentalTotalCostUpdate" step="0.01">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Status *</label>
                                <select class="form-select" id="rentalStatusUpdate">
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
                <button id="rental-update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                        aria-label="Close">Close
                </button>
                <button onclick="UpdateRental()" id="rental-update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function FillUpRentalUpdateForm(id) {
        document.getElementById("rentalUpdateID").value = id;
        showLoader();

        let res = await axios.post(`/rental-by-id/${id}`);
        hideLoader();

        document.getElementById("rentalCustomerUpdate").value = res.data["customer_id"];
        document.getElementById("rentalCarUpdate").value = res.data["car_id"];
        document.getElementById("rentalStartDateUpdate").value = res.data["rental_start_date"];
        document.getElementById("rentalEndDateUpdate").value = res.data["rental_end_date"];
        document.getElementById("rentalTotalCostUpdate").value = res.data["total_cost"];
        document.getElementById("rentalStatusUpdate").value = res.data["status"];
    }

    async function UpdateRental() {
        let customer = document.getElementById("rentalCustomerUpdate").value;
        let car = document.getElementById("rentalCarUpdate").value;
        let rental_start_date = document.getElementById("rentalStartDateUpdate").value;
        let rental_end_date = document.getElementById("rentalEndDateUpdate").value;
        let total_cost = document.getElementById("rentalTotalCostUpdate").value;
        let status = document.getElementById("rentalStatusUpdate").value;
        let updateID = document.getElementById("rentalUpdateID").value;

        if (!customer || !car || !rental_start_date || !rental_end_date || !total_cost || !status) {
            errorToast("All fields are required!");
        } else {
            document.getElementById("rental-update-modal-close").click();
            showLoader();

            let res = await axios.post(`/update-rental/${updateID}`, {
                customer_id: customer,
                car_id: car,
                rental_start_date: rental_start_date,
                rental_end_date: rental_end_date,
                total_cost: total_cost,
                status: status
            });

            hideLoader();

            if (res.status === 200) {
                document.getElementById("rental-update-form").reset();
                successToast("Rental updated successfully!");
                await getRentalList();
            } else {
                errorToast("Failed to update rental!");
            }
        }
    }
</script>
