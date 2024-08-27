<div class="modal fade" id="createmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="create-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category">
                            <option>Select Option</option>
                        </select>
                    </div>
                    {{-- Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title">
                    </div>
                    {{-- price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="email" class="form-control" id="price" placeholder="Enter price">
                    </div>
                    {{-- unit --}}
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" placeholder="Enter unit">
                    </div>
                    {{-- Image --}}
                    <div class="mb-3">
                        <img class="w-25 mb-2" src="" id="preview" />
                        <br>
                        <label for="image" class="form-label">Image</label>
                        <input type="file" oninput="preview.src = window.URL.createObjectURL(this.files[0])"
                            class="form-control" id="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="create-close-btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save-btn" onclick="saveproduct()">Create
                        Products</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    async function saveproduct() {
        let category = document.getElementById('category').value;
        let title = document.getElementById('title').value;
        let price = document.getElementById('price').value;
        let unit = document.getElementById('unit').value;
        let image = document.getElementById('image').files[0];

        if (category.length === 0) {
            errorToast('please select category')
        } else if (title.length === 0) {
            errorToast('please fill title filed')
        } else if (price.length === 0) {
            errorToast('please fill price filed')
        } else if (unit.length === 0) {
            errorToast('please fill unit filed')
        } else if (!image) {
            errorToast('please fill image title filed')
        } else {
            let formData = new FormData();
            formData.append('category_id', category)
            formData.append('title', title)
            formData.append('price', price)
            formData.append('unit', unit)
            formData.append('image', image)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            showloader()
            let res = await axios.post('/products-create', formData, config)
            hideloader()
            if (res.data.status === 'success') {
                await getdata();
                document.getElementById("create-form").reset();
                // $('#createmodal').hide();
                successToast(res.data.massage)
            } else {
                errorToast(res.data.massage)
            }

            console.log(formData);
        }
    }
</script>
