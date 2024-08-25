<div class="modal fade" id="updatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="updatemodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="update_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Category Name</label>
                        <input type="text" class="form-control" id="update_name" placeholder="Enter Category Name">
                        <input type="hidden" class="form-control" id="update_id">
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
        showloader()
        let res = await axios.post('/category-by-id', {
            id: update_id
        })
        hideloader()
        document.getElementById('update_name').value = res.data.data.name;
    }

    document.getElementById('update-btn').addEventListener('click', async function() {
        showloader()
        let update_name = document.getElementById('update_name').value;
        let form = document.getElementById('update_form');
        let update_id = document.getElementById('update_id').value;

        if (update_name.length == 0) {
            hideloader()
            errorToast('Please Enter Name')
        } else {
            let res = await axios.post('/products-category-update', {
                name: update_name,
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
