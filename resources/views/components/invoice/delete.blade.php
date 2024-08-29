<div class="modal fade" id="deleteModalin" tabindex="-1" aria-labelledby="deleteModalin" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Delete Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h3>Are You Sure You want to delete This Invoice! </h3>
                        <input class="form-control" id="id" type="hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="invoice-close-btn"
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
        let id = document.getElementById('id').value;
        let form = document.getElementById('form');

        if (id.length == 0) {
            errorToast('ID invalid')
        } else {
            let res = await axios.post('/invoice-delete', {
                invoice_id: id,
            })
            hideloader()
            if (res.status === 200 && res.data === 1) {
                successToast('Invoice Delete Success')
                form.reset()
                await getdata()
                document.getElementById('invoice-close-btn').click();
            } else {
                errorToast('Delete Faild')
            }
        }
    })
</script>
