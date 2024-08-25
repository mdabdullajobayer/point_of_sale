<div class="modal fade" id="createmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="create-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Category Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Category Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="create-close-btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save-btn">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('save-btn').addEventListener('click', async function() {
        showloader()
        let name = document.getElementById('name').value;
        let form = document.getElementById('create-form');

        if (name.length == 0) {
            hideloader()
            errorToast('Please Enter Name')
        } else {
            let res = await axios.post('/products-category-create', {
                name: name
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
