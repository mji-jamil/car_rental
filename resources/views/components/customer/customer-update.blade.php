<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate" required>

                                <label class="form-label mt-3">Customer Email *</label>
                                <input type="email" class="form-control" id="customerEmailUpdate" required>

                                <label class="form-label mt-3">Customer Mobile *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate" required>

                                <label class="form-label mt-3">Customer Address *</label>
                                <input type="text" class="form-control" id="customerAddressUpdate" required>

                                <input type="hidden" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;

        showLoader();
        try {
            let res = await axios.post(`/customer-by-id/${id}`);
            if (res.status === 200) {
                document.getElementById('customerNameUpdate').value = res.data.name;
                document.getElementById('customerEmailUpdate').value = res.data.email;
                document.getElementById('customerMobileUpdate').value = res.data.mobile;
                document.getElementById('customerAddressUpdate').value = res.data.address;
            } else {
                errorToast("Failed to fetch customer details");
            }
        } catch (error) {
            errorToast("An error occurred: " + (error.response?.data.message || error.message));
        } finally {
            hideLoader();
        }
    }

    async function Update() {
        let customerName = document.getElementById('customerNameUpdate').value;
        let customerEmail = document.getElementById('customerEmailUpdate').value;
        let customerMobile = document.getElementById('customerMobileUpdate').value;
        let customerAddress = document.getElementById('customerAddressUpdate').value;
        let updateID = document.getElementById('updateID').value;


        if (!customerName || !customerEmail || !customerMobile || !customerAddress) {
            return errorToast("All fields are required!");
        } else {
            document.getElementById('update-modal-close').click();
            showLoader();

            try {
                let res = await axios.post(`/update-customer/${updateID}`, {
                    name: customerName,
                    email: customerEmail,
                    mobile: customerMobile,
                    address: customerAddress
                });

                if (res.status === 200 && res.data.status === 'success') {
                    successToast('Customer updated successfully!');
                    document.getElementById("update-form").reset();
                    await getList();
                } else {
                    errorToast("Request failed: " + res.data.message);
                }
            } catch (error) {
                hideLoader();
                errorToast("An error occurred: " + (error.response?.data.message || error.message));
            } finally {
                hideLoader();
            }
        }
    }
</script>
