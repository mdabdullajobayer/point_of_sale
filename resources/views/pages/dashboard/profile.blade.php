@extends('pages.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <!-- card -->
                <div class="card shadow p-3 mt-5 bg-body rounded border-0">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- Title -->
                        <h3 class="fw-900 fs-30 mb-3 fw-bolder">Profile</h3>
                        <!-- Form Start -->
                        {{-- <form action="#"> --}}
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter Your First Name">
                        </div>
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter Your Last Name">
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" placeholder="Enter Your Email Address"
                                readonly>
                        </div>
                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone">
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="************"
                                autocomplete>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success" onclick="update()">Update Profile</button>
                        {{-- </form> --}}
                        <!-- End form -->

                    </div>
                    <!-- card body -->
                </div>
                <!-- card -->
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        getProfile();
        async function getProfile() {
            showloader()
            let res = await axios.get("/userprofile")
            if (res.status === 200 && res.data['status'] === 'success') {
                hideloader()
                let data = res.data['data'];
                document.getElementById('email').value = data['email'];
                document.getElementById('firstname').value = data['firstName'];
                document.getElementById('lastname').value = data['lastName'];
                document.getElementById('phone').value = data['mobile'];
            } else {
                errorToast(res.data['message'])
            }
        }

        async function update() {

            let firstName = document.getElementById('firstname').value;
            let lastName = document.getElementById('lastname').value;
            let mobile = document.getElementById('phone').value;
            let password = document.getElementById('password').value;

            if (firstName.length === 0) {
                errorToast('First Name is required')
            } else if (lastName.length === 0) {
                errorToast('Last Name is required')
            } else if (mobile.length === 0) {
                errorToast('Mobile is required')
            } else if (password.length === 0) {
                errorToast('Password is required')
            } else {
                showloader()
                let res = await axios.post("/update-profile", {
                    firstName: firstName,
                    lastName: lastName,
                    mobile: mobile,
                    password: password
                })
                if (res.status === 200 && res.data['status'] === 'success') {
                    hideloader()
                    successToast(res.data['massage']);
                    await getProfile();
                } else {
                    hideloader()
                    errorToast(res.data['massage'])
                }
            }
        }
    </script>
@endsection
