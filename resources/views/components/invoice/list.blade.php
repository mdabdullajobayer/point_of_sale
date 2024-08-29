<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto mt-5">
            <div class="card border-none shadow p-5">
                <div class="mb-2 d-flex justify-content-between">
                    <h5>Invoice </h5>
                    <a href="/sale-page" class="btn btn-success">
                        Create Sale
                    </a>
                </div>
                <table class="table" id="datatable">
                    <thead>
                        <tr class="text-left ">
                            <th scope="col">No</th>
                            <th scope="col">Total</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Vat</th>
                            <th scope="col text-left">Payable</th>
                            <th scope="col text-left">Customer</th>
                            <th scope="col text-left">Phone</th>
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
            let res = await axios.post('/invoice-select')
            hideloader();

            let datatable = $("#datatable");
            let datalist = $("#datalist");

            datatable.DataTable().destroy();
            datalist.empty();

            res.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item.total} TK</td>
                    <td>${item.discount}%</td>
                    <td>${item.vat} TK</td>
                    <td>${item.payable} Tk</td>
                    <td>${item.customer.name}</td>
                    <td>${item.customer.number}</td>
                    <td>
                       <a href="#" data-id="${item.id}" data-customer="${item.customer.id}" class="viewBtn btn edit btn-success btn-sm text-light"><i class="fa-solid fa-eye"></i> View</a>
                        <a href="#" data-id="${item.id}" class="btn delete btn-danger btn-sm text-light"><i class="fa-solid fa-trash"></i> Delete</a>
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

            $('.delete').on('click', function() {
                let id = $(this).data('id')
                $('#deleteModalin').modal('show');
                $('#id').val(id);
            })


            $('.viewBtn').on('click', async function() {
                let id = $(this).data('id');
                let cus = $(this).data('customer');
                await InvoiceDetails(cus, id)
            })
        }
    </script>
@endsection
