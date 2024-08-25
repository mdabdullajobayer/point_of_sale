<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Delete Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h3>Are You Sure You want to delete This Customer! </h3>
                        <input class="form-control" id="customer_id" type="hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close-btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('delete').addEventListener('click', async function() {
        showloader()
        let customer_id = document.getElementById('customer_id').value;
        let form = document.getElementById('form');

        if (customer_id.length == 0) {
            errorToast('ID invalid')
        } else {
            let res = await axios.post('/customer-delete', {
                id: customer_id
            })
            hideloader()
            if (res.status === 200 && res.data.status === 'success') {
                successToast(res.data.massage)
                form.reset()
                await getdata()
                document.getElementById('close-btn').click();
            } else {
                successToast(res.data.massage)
            }
        }
    })
</script>
