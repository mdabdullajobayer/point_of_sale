@extends('pages.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow border-0 p-3" style="height: 80vh">
                    <div class="row">
                        <div class="col-md-8 billed">
                            <h4>Billed To</h4>
                            <p class="text-xs mx-0 my-1">Name : <span id="CName"></span></p>
                            <p class="text-xs mx-0 my-1">Email : <span id="CEmail"></span></p>
                            <p class="text-xs mx-0 my-1">User ID : <span id="CID"></span></p>
                        </div>
                        <div class="col-md-4">
                            {{-- <img class="w-50" src="{{ 'images/logo.png' }}"> --}}
                            <h1>LOGO</h1>
                            <h5 class="text-bold mx-0 my-1 text-dark">Invoice </h5>
                            <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100">
                                    <tr class="text-xs">
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                        <td>Remove</td>
                                    </tr>
                                </thead>
                                <tbody class="w-100" id="invoiceList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span
                                    id="total"></span></p>
                            <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i>
                                <span id="payable"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i>
                                <span id="vat"></span>
                            </p>
                            <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i>
                                <span id="discount"></span>
                            </p>
                            <span class="text-xxs">Discount(%):</span>
                            <input onkeydown="return false" value="0" min="0" type="number"
                                onchange="DiscountChange()" class="form-control w-40 " id="discountP" />
                            <p>
                                <button onclick="createInvoice()" class="btn  my-3 btn-success w-40">Confirm</button>
                            </p>
                        </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0 p-3" style="height: 80vh">
                    <h4>Products</h4>
                    <hr>
                    <table id="productsTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productList">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card shadow border-0 p-3" style="height: 80vh">
                    <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                        <table class="table table-sm w-100" id="customerTable">
                            <thead class="w-100">
                                <tr class="text-xs text-bold">
                                    <td>Customer</td>
                                    <td>Pick</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="customerList">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    {{-- <label class="form-label">Product ID *</label> --}}
                                    <input type="hidden" class="form-control" id="PId">
                                    <label class="form-label mt-2">Product Name *</label>
                                    <input type="text" class="form-control" id="PName">
                                    <label class="form-label mt-2">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label mt-2">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn btn-success">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
        (async () => {
            showloader();
            await CustomerList();
            await ProductList();
            hideloader();
        })()

        let InvoiceItemList = [];

        async function CustomerList() {
            let res = await axios.get("/customers-list");
            let customerTable = $("#customerTable");
            let customerList = $('#customerList');
            customerTable.DataTable().destroy();
            customerList.empty();

            res.data.data.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td><i class="bi bi-person"></i> ${item['name']}</td>
                        <td><a data-name="${item['name']}" data-email="${item['email']}" data-id="${item['id']}" class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                     </tr>`
                customerList.append(row)
            })
            new DataTable('#customerTable', {
                order: [
                    [0, 'desc']
                ],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });

            $('.addCustomer').on('click', async function() {

                let CName = $(this).data('name');
                let CEmail = $(this).data('email');
                let CId = $(this).data('id');

                $("#CName").text(CName)
                $("#CEmail").text(CEmail)
                $("#CID").text(CId)

            })
        }

        async function ProductList() {
            let res = await axios.get("/products-list");
            let productList = $("#productList");
            let productTable = $("#productsTable");
            productTable.DataTable().destroy();
            productList.empty();

            res.data.data.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td> <img style="width:50px" src="${item['image_url']}"/></td>
                        <td>${item['title']} (Tk ${item['price']})</td>
                        <td><a data-name="${item['title']}" data-price="${item['price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0">Add</a></td>
                     </tr>`
                productList.append(row)
            })
            new DataTable('#productsTable', {
                order: [
                    [0, 'desc']
                ],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });

            $('.addProduct').on('click', async function() {
                let PName = $(this).data('name');
                let PPrice = $(this).data('price');
                let PId = $(this).data('id');
                addModal(PId, PName, PPrice)
            })

        }

        function addModal(id, name, price) {
            document.getElementById('PId').value = id
            document.getElementById('PName').value = name
            document.getElementById('PPrice').value = price
            $('#create-modal').modal('show')
        }

        function add() {
            let PId = document.getElementById('PId').value;
            let PName = document.getElementById('PName').value;
            let PPrice = document.getElementById('PPrice').value;
            let PQty = document.getElementById('PQty').value;
            let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);
            if (PId.length === 0) {
                errorToast("Product ID Required");
            } else if (PName.length === 0) {
                errorToast("Product Name Required");
            } else if (PPrice.length === 0) {
                errorToast("Product Price Required");
            } else if (PQty.length === 0) {
                errorToast("Product Quantity Required");
            } else {
                let item = {
                    product_name: PName,
                    product_id: PId,
                    qty: PQty,
                    sale_price: PTotalPrice
                };
                InvoiceItemList.push(item);
                $('#create-modal').modal('hide')
                ShowInvoiceItem();
            }
        }

        function ShowInvoiceItem() {

            let invoiceList = $('#invoiceList');

            invoiceList.empty();

            InvoiceItemList.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td>${item['product_name']}</td>
                        <td>${item['qty']}</td>
                        <td>${item['sale_price']}</td>
                        <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1 btn-danger btn-sm m-0">Remove</a></td>
                     </tr>`
                invoiceList.append(row)
            })

            CalculateGrandTotal();

            $('.remove').on('click', async function() {
                let index = $(this).data('index');
                removeItem(index);
            })
        }

        function CalculateGrandTotal() {
            let Total = 0;
            let Vat = 0;
            let Payable = 0;
            let Discount = 0;
            let discountPercentage = (parseFloat(document.getElementById('discountP').value));

            InvoiceItemList.forEach((item, index) => {
                Total = Total + parseFloat(item['sale_price'])
            })

            if (discountPercentage === 0) {
                Vat = ((Total * 5) / 100).toFixed(2);
            } else {
                Discount = ((Total * discountPercentage) / 100).toFixed(2);
                Total = (Total - ((Total * discountPercentage) / 100)).toFixed(2);
                Vat = ((Total * 5) / 100).toFixed(2);
            }

            Payable = (parseFloat(Total) + parseFloat(Vat)).toFixed(2);


            document.getElementById('total').innerText = Total;
            document.getElementById('payable').innerText = Payable;
            document.getElementById('vat').innerText = Vat;
            document.getElementById('discount').innerText = Discount;
        }

        function DiscountChange() {
            CalculateGrandTotal();
        }

        function removeItem(index) {
            InvoiceItemList.splice(index, 1);
            ShowInvoiceItem()
        }

        async function createInvoice() {
            let total = document.getElementById('total').innerText;
            let discount = document.getElementById('discount').innerText
            let vat = document.getElementById('vat').innerText
            let payable = document.getElementById('payable').innerText
            let CId = document.getElementById('CID').innerText;


            let Data = {
                "total": total,
                "discount": discount,
                "vat": vat,
                "payable": payable,
                "customer_id": CId,
                "products": InvoiceItemList
            }


            if (CId.length === 0) {
                errorToast("Customer Required !")
            } else if (InvoiceItemList.length === 0) {
                errorToast("Product Required !")
            } else {
                showloader();
                let res = await axios.post("/invoice-create", Data)
                hideloader();
                if (res.data === 1) {
                    successToast("Invoice Created");
                    setTimeout(() => {
                        window.location.href = '/invoices'
                    }, 1000);
                } else {
                    errorToast("Something Went Wrong")
                }
            }

        }
    </script>
@endsection
