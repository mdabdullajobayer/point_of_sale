@extends('pages.layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <!-- card -->
                <div class="card shadow p-3 mb-5 bg-body rounded border-0">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- Title -->
                        <h3 class="fw-900 fs-30 mb-3 fw-bolder">SING UP</h3>
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
                            <input type="text" class="form-control" id="email"
                                placeholder="Enter Your Email Address">
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
                        <button type="submit" class="btn btn-success" onclick="registerfunc();">SING UP NOW</button>
                        {{-- </form> --}}
                        <!-- End form -->
                        <!-- Foooter -->
                        <div class="d-flex gap-2 justify-content-end mt-2 ">
                            <a href="/login" class="text-decoration-none text-success">Login ?</a>
                            <a href="/send-otp" class="text-decoration-none text-success">Forgate Password?</a>
                        </div>
                        <!-- Footer End -->
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
        async function registerfunc() {
            let firstname = document.getElementById('firstname').value;
            let lastname = document.getElementById('lastname').value;
            let email = document.getElementById('email').value;
            let phone = document.getElementById('phone').value;
            let password = document.getElementById('password').value;

            if (firstname.length === 0) {
                errorToast('Please Enter First Name')
            } else if (lastname.length === 0) {
                errorToast('Please Enater Your Last Name')
            } else if (email.length === 0) {
                errorToast('Please Enter Your Email')
            } else if (phone.length === 0 && phone.length < 13) {
                errorToast('Plese Enter Valid Phone')
            } else if (password.length === 0) {
                errorToast('please Enter Password')
            } else {
                let res = await axios.post('/register', {
                    firstName: firstname,
                    lastName: lastname,
                    email: email,
                    mobile: phone,
                    password: password
                })
                if (res.status === 200 && res.data['status'] === 'success') {
                    successToast(res.data['massage'])
                } else {
                    errorToast(res.data['massage'])
                }
            }

        }
    </script>
@endsection
