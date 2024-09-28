<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3 text-warning">Delete!</h3>
                <p class="mb-3">Once deleted, you can't get it back.</p>
                <input class="d-none" id="deleteID" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn mx-2 bg-gradient-primary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn bg-gradient-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemDelete() {
        let id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();
        showLoader();

        try {
            let res = await axios.post(`/delete-customer/${id}`);
            hideLoader();

            if (res.status === 200 && res.data.status === 'success') {
                successToast("Customer deleted successfully!");
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
</script>
