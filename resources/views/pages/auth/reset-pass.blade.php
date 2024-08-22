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
                        <h3 class="fw-900 fs-30 mb-3 fw-bolder text-uppercase">change password</h3>
                        <!-- Form Start -->
                        {{-- <form> --}}
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="************">
                        </div>
                        <!--Confirm Password -->
                        <div class="mb-3">
                            <label for="conpassword" class="form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="conpassword" placeholder="************">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success text-uppercase" onclick="changepass()">change
                            password</button>
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
        async function changepass() {
            let password = document.getElementById('password').value;
            let conpassword = document.getElementById('conpassword').value;
            if (password.length === 0) {
                errorToast('Please Fill The Fild')
            } else if (conpassword.length === 0) {
                errorToast('Confirm Password Is Requird')
            } else if (password !== conpassword) {
                errorToast('Password Not Match')
            } else {
                showloader()
                let res = await axios.post('/reset-password', {
                    password: password
                })
                if (res.status === 200 && res.data.status === 'success') {
                    successToast(res.data.massage)
                    hideloader()
                    setTimeout(() => {
                        window.location.href = '/login'
                    }, 1000);
                } else {
                    hideloader()
                    errorToast(res.data.massage)
                }
            }
        }
    </script>
@endsection
