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
                        <h3 class="fw-900 fs-30 mb-3 fw-bolder text-uppercase">Forgate Password</h3>
                        <!-- Form Start -->
                        {{-- <form> --}}
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email"
                                placeholder="Enter Your Email Address">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" onclick="sendmailfunc();" class="btn btn-success">SEND MAIL</button>
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
        async function sendmailfunc() {
            let email = document.getElementById('email').value;
            if (email.length === 0) {
                errorToast('Please Enter Email Address')
            } else {
                showloader();
                let res = await axios.post('/send-otp', {
                    email: email
                });
                if (res.status == 200 && res.data['status'] == 'success') {
                    successToast(res.data.massage)
                    sessionStorage.setItem('email', email);
                    setTimeout(() => {
                        window.location.href = '/verify-otp';
                    }, 2000);
                } else {
                    hideloader()
                    errorToast(res.data.massage)
                }
            }
        }
    </script>
@endsection
