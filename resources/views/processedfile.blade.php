@extends('layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Processed File Details</h1>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-12 text-right"><button type="submit" class="btn btn-primary">Export to excel</button></div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="processfile" width="100%" border="0">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Block</th>
                            <th>PHC Name</th>
                            <th>Web Link</th>
                            <th>SMS Text</th>
                        </tr>
                        </thead>
                    </table>

                    <a  class="btn btn-default" href="{{ url('/') }}">Back</a>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('js')
    <script>
        $(function () {
            $('#processfile').dataTable({

                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/fetch-process-data/'.$id);?>",
                "columns": [

                    { "data": "sr_no" },
                    { "data": "block" },
                    { "data": "phc_name" },
                    { "data": "weblink" },
                    { "data": "sms" },
                ],
            });
        });
    </script>
@endsection