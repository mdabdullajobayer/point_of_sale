<div class="modal fade" id="updatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="updatemodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="update-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="updatecategory">
                            <option value="">Select Option</option>
                        </select>
                    </div>
                    {{-- Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="up_title" placeholder="Enter title">
                    </div>
                    {{-- price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="email" class="form-control" id="up_price" placeholder="Enter price">
                    </div>
                    {{-- unit --}}
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="up_unit" placeholder="Enter unit">
                    </div>
                    {{-- Image --}}
                    <div class="mb-3">
                        <img class="w-25 mb-2" src="" id="Up_preview" />
                        <br>
                        <label for="up_image" class="form-label">Image</label>
                        <input type="file" oninput="Up_preview.src = window.URL.createObjectURL(this.files[0])"
                            class="form-control" id="up_image">
                        <input type="hidden" class="form-control" id="update_id">
                        <input type="hidden" class="form-control" id="image_path">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="up_close_btn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="UpdateProduct()">Update Product</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    async function upcategory() {
        let res = await axios.get('/products-category-list')
        if (res.status === 200) {
            res.data.data.forEach(function(item, index) {
                let option = `<option value="${item.id}">${item.name}</option>`;
                $('#updatecategory').append(option);

            });
        }
    }
    async function formfill(id, data_path) {
        await upcategory();
        document.getElementById('update_id').value = id;
        document.getElementById('image_path').value = data_path;
        document.getElementById('Up_preview').src = data_path;

        showloader();
        let res = await axios.post('/products-by-id', {
            id: id
        });
        hideloader();
        document.getElementById('up_title').value = res.data.data.title;
        document.getElementById('up_price').value = res.data.data.price;
        document.getElementById('up_unit').value = res.data.data.unit;

    }

    async function UpdateProduct() {
        let up_title = document.getElementById('up_title').value;
        let updatecategory = document.getElementById('updatecategory').value;
        let up_price = document.getElementById('up_price').value;
        let up_unit = document.getElementById('up_unit').value;
        let image_path = document.getElementById('image_path').value;
        let update_id = document.getElementById('update_id').value;
        let image = document.getElementById('up_image').files[0];

        if (updatecategory.length === 0) {
            errorToast('Please Enter Category')
        } else if (up_title.length === 0) {
            errorToast('Title is required')
        } else if (up_price.length === 0) {
            errorToast('Price is required')
        } else if (up_unit.length === 0) {
            errorToast('Unit is required')
        } else {
            showloader();
            document.getElementById('up_close_btn').click();
            let formData = new FormData();
            formData.append('id', update_id);
            formData.append('file_path', image_path);
            formData.append('category_id', updatecategory);
            formData.append('title', up_title);
            formData.append('price', up_price);
            formData.append('unit', up_unit);
            formData.append('image', image);
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let res = await axios.post('/products-update', formData, config)
            if (res.status === 200 && res.data.status === 'success') {
                console.log(res.data.massage);

                successToast(res.data.massage);
                document.getElementById("update-form").reset();
                await getdata();
                hideloader()
            } else {
                hideloader()
                errorToast(res.data.massage)
            }
        }

    }
</script>
