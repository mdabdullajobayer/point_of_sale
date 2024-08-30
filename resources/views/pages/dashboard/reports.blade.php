@extends('pages.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow mt-5 p-3">
                    <h2>Reports</h2>
                    <div class="mb-3 mt-3">
                        <label for="formdate" class="form-label">Form Date</label>
                        <input type="date" class="form-control" id="formdate">
                    </div>
                    <div class="mb-3">
                        <label for="todate" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="todate">
                    </div>
                    <button type="button" class="btn btn-success w-100" onclick="getReport()">Reports</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function getReport() {
            let formdate = document.getElementById('formdate').value;
            let Todate = document.getElementById('todate').value;
            if (formdate.length === 0 || Todate.length === 0) {
                errorToast('Please Select Date')
            } else {
                window.open('reports/' + formdate + '/' + Todate)
            }
        }
    </script>
@endsection
