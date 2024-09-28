<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 center-screen">
            <div class="card shadow-lg border-0 rounded-lg animated fadeIn w-100 p-4" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <h4 class="text-center text-dark mb-4" style="font-weight: bold;">Create Your Account</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-6 p-2">
                                <label for="email" class="font-weight-bold text-muted">Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control border-0 shadow-sm rounded" type="email" required/>
                            </div>
                            <div class="col-md-6 p-2">
                                <label for="name" class="font-weight-bold text-muted">Full Name</label>
                                <input id="name" placeholder="Full Name" class="form-control border-0 shadow-sm rounded" type="text" required/>
                            </div>
                            <div class="col-md-6 p-2">
                                <label for="mobile" class="font-weight-bold text-muted">Phone Number</label>
                                <input id="mobile" placeholder="Phone Number" class="form-control border-0 shadow-sm rounded" type="text" required/>
                            </div>
                            <div class="col-md-6 p-2">
                                <label for="address" class="font-weight-bold text-muted">Address</label>
                                <input id="address" placeholder="Address" class="form-control border-0 shadow-sm rounded" type="text" required/>
                            </div>
                            <div class="col-md-6 p-2">
                                <label for="password" class="font-weight-bold text-muted">Password</label>
                                <input id="password" placeholder="User Password" class="form-control border-0 shadow-sm rounded" type="password" required/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-12 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100 bg-gradient-primary text-white rounded-pill shadow" style="background-color: #007bff; border: none;">
                                    Complete Registration
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function onRegistration() {
        let email = document.getElementById('email').value;
        let name = document.getElementById('name').value;
        let mobile = document.getElementById('mobile').value;
        let address = document.getElementById('address').value;
        let password = document.getElementById('password').value;

        if (email.length === 0) {
            errorToast('Email is required');
        } else if (name.length === 0) {
            errorToast('Name is required');
        } else if (mobile.length === 0) {
            errorToast('Phone Number is required');
        } else if (address.length === 0) {
            errorToast('Address is required');
        } else if (password.length === 0) {
            errorToast('Password is required');
        } else {
            showLoader();
            try {
                let res = await axios.post("/user-registration", {
                    email: email,
                    name: name,
                    mobile: mobile,
                    address: address,
                    password: password,
                });
                hideLoader();
                if (res.status === 201 && res.data['status'] === 'success') {
                    successToast(res.data['message']);
                    setTimeout(function () {
                        window.location.href = '/userLogin';
                    }, 2000);
                } else {
                    errorToast(res.data['message']);
                }
            } catch (error) {
                hideLoader();
                errorToast('An error occurred. Please try again.');
            }
        }
    }
</script>
