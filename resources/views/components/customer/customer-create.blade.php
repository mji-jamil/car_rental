<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerName" required>
                                <label class="form-label">Customer Email *</label>
                                <input type="email" class="form-control" id="customerEmail" required>
                                <label class="form-label">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobile" required>
                                <label class="form-label">Customer Password *</label>
                                <input type="password" class="form-control" id="customerPassword" required>
                                <label class="form-label">Customer Address *</label>
                                <input type="text" class="form-control" id="customerAddress" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Save() {

        let customerName = document.getElementById("customerName").value;
        let customerEmail = document.getElementById("customerEmail").value;
        let customerMobile = document.getElementById("customerMobile").value;
        let customerPassword = document.getElementById("customerPassword").value;
        let customerAddress = document.getElementById("customerAddress").value;

        if (customerName.length === 0) {
            return errorToast("Customer Name Required!");
        }
        if (customerEmail.length === 0) {
            return errorToast("Customer Email Required!");
        }
        if (customerMobile.length === 0) {
            return errorToast("Customer Mobile Required!");
        }
        if (customerPassword.length === 0) {
            return errorToast("Customer Password Required!");
        }
        if (customerAddress.length === 0) {
            return errorToast("Customer Address Required!");
        }

        document.getElementById("modal-close").click();
        showLoader();

        try {
            let res = await axios.post("/create-customer", {
                name: customerName,
                email: customerEmail,
                mobile: customerMobile,
                password: customerPassword,
                address: customerAddress
            });

            // Handle response
            if (res.status === 201) {
                successToast("Customer created successfully!");
                document.getElementById("save-form").reset();
                await getList();
            } else {
                errorToast("Request failed!");
            }
        } catch (error) {
            hideLoader();
            errorToast("An error occurred: " + (error.response?.data.message || error.message));
        } finally {
            hideLoader();
        }
    }
</script>
