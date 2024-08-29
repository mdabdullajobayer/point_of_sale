@extends('pages.layouts.master')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Products</label>
                    <h1 id="product"></h1>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Category</label>
                    <h1 id="category"></h1>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Customer</label>
                    <h1 id="customer"></h1>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Invoice</label>
                    <h1 id="invoice"></h1>
                </div>

            </div>
            <div class="col-md-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Sale</label>
                    <h1 id="total"></h1>
                </div>

            </div>
            <div class="col-md-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Vat</label>
                    <h1 id="vat"></h1>
                </div>

            </div>
            <div class="col-md-2 mt-2">
                <div class="card border-0 shadow p-2">
                    <label>Total Payable Amount</label>
                    <h1 id="payable"></h1>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        getList();
        async function getList() {
            showloader();
            let res = await axios.get("/summary");

            document.getElementById('product').innerText = res.data['product']
            document.getElementById('category').innerText = res.data['category']
            document.getElementById('customer').innerText = res.data['customer']
            document.getElementById('invoice').innerText = res.data['invoice']
            document.getElementById('total').innerText = res.data['total'] + 'Tk';
            document.getElementById('vat').innerText = res.data['vat'] + 'Tk';
            document.getElementById('payable').innerText = res.data['payable'] + 'Tk';


            hideloader();
        }
    </script>
@endsection
