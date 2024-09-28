<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID"/>
                <input class="d-none" id="deleteFilePath"/>

            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteID(id) {
        document.getElementById('deleteID').value = id;
    }

    async function itemDelete() {
        let id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();  // Close the modal
        showLoader();

        let res = await axios.post(`/delete-rental/${id}`);

        hideLoader();

        if (res.data.status === 'success') {
            successToast("Rental deleted successfully!");
            await getList();
        }else {
            errorToast("Failed to delete rental!");
        }
    }
</script>
