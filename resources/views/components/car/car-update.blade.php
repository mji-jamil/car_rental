<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Car</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Car Name *</label>
                                <input type="text" class="form-control" id="carNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Brand *</label>
                                <input type="text" class="form-control" id="brandUpdate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Model *</label>
                                <input type="text" class="form-control" id="modelUpdate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Year of Manufacture *</label>
                                <input type="number" class="form-control" id="yearOfManufactureUpdate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Car Type *</label>
                                <select class="form-select" id="carTypeUpdate">
                                    <option value="SUV">SUV</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="Hatchback">Hatchback</option>
                                    <option value="Truck">Truck</option>
                                    <option value="Coupe">Coupe</option>
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Daily Rent Price *</label>
                                <input type="number" class="form-control" id="dailyRentPriceUpdate" step="0.01">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Car Image URL *</label>
                                <input type="text" class="form-control" id="carImageUpdate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Availability *</label>
                                <select class="form-select" id="availabilityStatusUpdate">
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                        aria-label="Close">Close
                </button>
                <button onclick="UpdateCar()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function FillUpUpdateForm(id) {
        document.getElementById("updateID").value = id;
        showLoader();

        let res = await axios.post(`/car-by-id/${id}`);
        hideLoader();

        document.getElementById("carNameUpdate").value = res.data["name"];
        document.getElementById("brandUpdate").value = res.data["brand"];
        document.getElementById("modelUpdate").value = res.data["model"];
        document.getElementById("yearOfManufactureUpdate").value = res.data["year_of_manufacture"];
        document.getElementById("carTypeUpdate").value = res.data["car_type"];
        document.getElementById("dailyRentPriceUpdate").value = res.data["daily_rent_price"];
        document.getElementById("carImageUpdate").value = res.data["car_image"];
        document.getElementById("availabilityStatusUpdate").value = res.data["availability_status"];
    }

    async function UpdateCar() {
        let carName = document.getElementById("carNameUpdate").value;
        let brand = document.getElementById("brandUpdate").value;
        let model = document.getElementById("modelUpdate").value;
        let year_of_manufacture = document.getElementById("yearOfManufactureUpdate").value;
        let car_type = document.getElementById("carTypeUpdate").value;
        let daily_rent_price = document.getElementById("dailyRentPriceUpdate").value;
        let car_image = document.getElementById("carImageUpdate").value;
        let availability_status = document.getElementById("availabilityStatusUpdate").value;
        let updateID = document.getElementById("updateID").value;

        if (carName.length === 0 || brand.length === 0 || model.length === 0 || year_of_manufacture.length === 0 || car_type.length === 0 || daily_rent_price.length === 0 || car_image.length === 0) {
            errorToast("All fields are required!");
        } else {
            document.getElementById("update-modal-close").click();
            showLoader();

            let res = await axios.post(`/update-car/${updateID}`, {
                name: carName,
                brand: brand,
                model: model,
                year_of_manufacture: year_of_manufacture,
                car_type: car_type,
                daily_rent_price: daily_rent_price,
                car_image: car_image,
                availability_status: availability_status
            });

            hideLoader();

            if (res.status === 201 && res.data.status === 'success') {
                document.getElementById("update-form").reset();
                successToast("Car updated successfully!");
                await getList();
            } else {
                errorToast("Failed to update car!");
            }
        }
    }
</script>
