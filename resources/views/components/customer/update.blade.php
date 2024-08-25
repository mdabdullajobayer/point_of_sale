<div class="modal fade" id="updatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="updatemodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="update_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Customers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="update_name" class="form-label">Enter Name</label>
                        <input type="text" class="form-control" id="update_name" placeholder="Enter  Name">
                        <input type="hidden" class="form-control" id="update_id" />
                    </div>

                    <div class="mb-3">
                        <label for="update_email" class="form-label">Enter Email</label>
                        <input type="email" class="form-control" id="update_email" placeholder="Enter Email">
                    </div>

                    <div class="mb-3">
                        <label for="update_number" class="form-label">Enter Number</label>
                        <input type="text" class="form-control" id="update_number" placeholder="Enter Number">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="up_close_btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="update-btn">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    async function formfill(id) {
        let update_id = document.getElementById('update_id').value = id;
        showloader();
        try {
            let res = await axios.post('/customer-by-id', {
                id: update_id
            });
            hideloader();
            document.getElementById('update_name').value = res.data.data.name;
            document.getElementById('update_email').value = res.data.data.email;
            document.getElementById('update_number').value = res.data.data.number;
        } catch (error) {
            hideloader();
            console.error('Error fetching customer data:', error);
            errorToast('Failed to fetch customer data');
        }
    }

    document.getElementById('update-btn').addEventListener('click', async function() {
        let update_name = document.getElementById('update_name').value;
        let update_email = document.getElementById('update_email').value;
        let update_phone = document.getElementById('update_number').value;
        let form = document.getElementById('update_form');
        let update_id = document.getElementById('update_id').value;

        if (update_name.length == 0) {
            errorToast('Please Enter Name')
        } else {
            showloader()
            let res = await axios.post('/customer-update', {
                name: update_name,
                email: update_email,
                phone: update_phone,
                id: update_id
            })
            hideloader()
            if (res.status === 200 && res.data.status === 'success') {
                successToast(res.data.massage)
                await getdata()
                document.getElementById('up_close_btn').click();
            } else {
                errorToast(res.data.massage)
            }
        }
    })
</script>
