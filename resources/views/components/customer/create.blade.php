<div class="modal fade" id="createmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="create-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Name</label>
                        <input type="text" class="form-control" id="c_name" placeholder="Enter Name">
                    </div>
                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Email</label>
                        <input type="email" class="form-control" id="c_email" placeholder="Enter Email">
                    </div>
                    {{-- Phone --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Mobile</label>
                        <input type="text" class="form-control" id="c_mobile" placeholder="Enter Mobile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="create-close-btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save-btn">Create Customer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('save-btn').addEventListener('click', async function() {
        let name = document.getElementById('c_name').value;
        let email = document.getElementById('c_email').value;
        let mobile = document.getElementById('c_mobile').value;
        let form = document.getElementById('create-form');

        if (name.length === 0) {
            errorToast('Please Enter Name')
        } else if (email.length === 0) {
            errorToast('Please Enter Email')
        } else if (mobile.length === 0) {
            errorToast('Please Enter Mobile')
        } else {
            showloader()
            let res = await axios.post('/customer-create', {
                name: name,
                email: email,
                mobile: mobile
            })
            hideloader()
            if (res.status === 200 && res.data.status === 'success') {
                successToast(res.data.massage)
                form.reset()
                await getdata()
                document.getElementById('create-close-btn').click();
            } else {
                successToast(res.data.massage)
            }
        }
    })
</script>
