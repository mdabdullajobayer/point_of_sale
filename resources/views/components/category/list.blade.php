<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <div class="card border-none shadow p-5">
                <div class="mb-2 d-flex justify-content-between">
                    <h5>Product Category</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createmodal">
                        Create
                    </button>
                </div>
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="datalist">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('js')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
        getdata();
        async function getdata() {
            showloader();
            let res = await axios.get('/products-category-list')
            hideloader();

            let datatable = $("#datatable");
            let datalist = $("#datalist");

            datatable.DataTable().destroy();
            datalist.empty();

            res.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item.name}</td>
                    <td>
                       <a href="#" data-id="${item.id}" class="btn edit btn-info btn-sm">Edit</a>
                        <a href="#" data-id="${item.id}" class="btn delete btn-danger btn-sm">Delete</a>
                    </td>
                    </tr>`;
                datalist.append(row)
            });
            datatable.DataTable({
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [10, 20, 50, 100],
            })

            $('.edit').on('click', async function() {
                let id = $(this).data('id')
                await formfill(id);
                $('#updatemodal').modal('show');
            })

            $('.delete').on('click', function() {
                let id = $(this).data('id')
                $('#deleteModal').modal('show');
                $('#catagory_id').val(id);
            })
        }
    </script>
@endsection
