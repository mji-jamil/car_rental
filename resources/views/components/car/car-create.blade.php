<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Car</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Car Name *</label>
                                <input type="text" class="form-control" id="carName">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Brand *</label>
                                <input type="text" class="form-control" id="brand">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Model *</label>
                                <input type="text" class="form-control" id="model">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Year of Manufacture *</label>
                                <input type="number" class="form-control" id="year_of_manufacture">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Car Type *</label>
                                <select class="form-select" id="car_type">
                                    <option value="SUV">SUV</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="Hatchback">Hatchback</option>
                                    <option value="Truck">Truck</option>
                                    <option value="Coupe">Coupe</option>
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Daily Rent Price *</label>
                                <input type="number" class="form-control" id="daily_rent_price" step="0.01">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Car Image URL *</label>
                                <input type="text" class="form-control" id="car_image">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Availability *</label>
                                <select class="form-select" id="availability_status">
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function Save() {
        let carName = document.getElementById('carName').value;
        let brand = document.getElementById('brand').value;
        let model = document.getElementById('model').value;
        let year_of_manufacture = document.getElementById('year_of_manufacture').value;
        let car_type = document.getElementById('car_type').value;
        let daily_rent_price = document.getElementById('daily_rent_price').value;
        let car_image = document.getElementById('car_image').value;
        let availability_status = document.getElementById('availability_status').value;

        if (carName.length === 0 || brand.length === 0 || model.length === 0 || year_of_manufacture.length === 0 || car_type.length === 0 || daily_rent_price.length === 0 || car_image.length === 0) {
            errorToast("All fields are required!");
        } else {
            document.getElementById('modal-close').click();
            showLoader();

            let res = await axios.post("/create-car", {
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

            if (res.status === 201) {
                successToast('Car created successfully!');
                document.getElementById("save-form").reset();
                await getList();
            } else {
                errorToast("Failed to create car!");
            }
        }
    }
</script>
