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
                        <h3 class="fw-900 fs-30 mb-3 fw-bolder">SING IN</h3>
                        <!-- Form Start -->
                        {{-- <form action="#"> --}}
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email"
                                placeholder="Enter Your Email Address">
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="************"
                                autocomplete>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success" onclick="loginfunc();">SING IN NOW</button>
                        {{-- </form> --}}
                        <!-- End form -->
                        <!-- Foooter -->
                        <div class="d-flex gap-2 justify-content-end mt-2 ">
                            <a href="/register" class="text-decoration-none text-success">Register?</a>
                            <span class="ms-1 text-success">|</span>
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
        async function loginfunc() {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            if (email.length === 0) {
                errorToast('Plese Enter email')
            } else if (password.length === 0) {
                errorToast('Plese Enter password')
            } else {
                showloader();
                let res = await axios.post('/login', {
                    email: email,
                    password: password
                });
                if (res.status === 200 && res.data['status'] === 'success') {
                    successToast(res.data['massage'])
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1000);
                    hideloader();
                } else {
                    console.log(res.data['massage'])
                    errorToast(res.data['massage'])
                    hideloader();
                }
            }
        }
    </script>
@endsection
