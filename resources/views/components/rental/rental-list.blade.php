<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Car Rentals</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                                class="float-end btn m-0 bg-gradient-primary">Create
                        </button>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <table class="table" id="tableData">
                    <thead>
                    <tr class="bg-light">
                        <th>Rental ID</th>
                        <th>Customer Name</th>
                        <th>Car Details</th>
                        <th>Rental Start Date</th>
                        <th>Rental End Date</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableList">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    getList();

    async function getList() {
        showLoader();
        let res = await axios.get("/list-rentals");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        // Destroy the DataTable instance before clearing the table
        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item) {
            let row = `<tr>
                        <td>${item["id"]}</td>
                        <td>${item["customer_name"]}</td>
                        <td>${item["car_name"]} (${item["car_brand"]})</td>
                        <td>${item["rental_start_date"]}</td>
                        <td>${item["rental_end_date"]}</td>
                        <td>${item["total_cost"]}</td>
                        <td>${item["status"]}</td>
                        <td>
                            <button data-id="${item["id"]}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>`;
            tableList.append(row);
        });

        // Set up event listeners for buttons
        $(".editBtn").on("click", async function () {
            let id = $(this).data("id");
            await FillUpUpdateForm(id);
            $("#update-modal").modal("show");
        });

        $(".deleteBtn").on("click", function () {
            let id = $(this).data("id");
            $("#delete-modal").modal("show");
            $("#deleteID").val(id);
        });

        // Initialize DataTable after populating the rows
        new DataTable("#tableData", {
            order: [[0, "desc"]],
            lengthMenu: [5, 10, 15, 20, 30]
        });
    }
</script>
