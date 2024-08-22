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
                        <h3 class="fw-900 fs-30 mb-3 fw-bolder text-uppercase">OTP Verify</h3>
                        <!-- Form Start -->
                        {{-- <form> --}}
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="otpcode" class="form-label">OTP CODE</label>
                            <input type="text" class="form-control" id="otpcode" placeholder="Enter 4 Digits OTP CODE">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success" onclick="otpverify();">VERIFY</button>
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
        async function otpverify() {
            let otpcode = document.getElementById('otpcode').value;
            if (otpcode.length === 0) {
                errorToast('Please Enter Code')
            } else {
                showloader();
                let res = await axios.post('/verify-otp', {
                    email: sessionStorage.getItem('email'),
                    otp: otpcode
                })
                if (res.status === 200 && res.data.status === 'success') {
                    successToast(res.data.massage)
                    hideloader()
                    setTimeout(() => {
                        window.location.href = '/reset-password';
                    }, 2000);
                } else {
                    hideloader()
                    errorToast(res.data.massage)
                }
            }
        }
    </script>
@endsection
