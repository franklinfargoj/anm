@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('error'))
        <p class="alert alert-danger">
            {{ session()->get('error') }}<br>
        </p>
    @endif
    @if($errors->any())
        <p class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{$error}}<br>
            @endforeach
        </p>
    @endif
    @if(session()->has('success'))
        <p class="alert alert-success">
            {{ session()->get('success') }}
        </p>
    @endif

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Upload Target File</h3>
                </div>
            </div>
        </div>
    </section>

    {!!  Form::open(array('method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Month</label>
                        <select class="form-control" name="month">
                            @for($m=1; $m<=12; $m++)
                                <option value="{{$m}}">{{date('F', mktime(0,0,0,$m, 1, date('Y')))}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Month</label>
                        <select class="form-control" name="year">
                            @foreach (range(date('Y'), 2025) as $key => $value) {
                                <option>{{$value}}</option>;
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <label>Select File to Import:</label>
                    {!! Form::file('sample_file', ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    <label>Select Ranking to Import:</label>
                    {!! Form::file('rankings', ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    <div class="form-group btn-area">
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
    <!-- <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Uploaded File Details</h3>
                            <table id="uploadData" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>File Name</th>
                                    <th>Uploaded On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                </div>
            </div>
        </div>
    </section> -->

@endsection

@section('js')
    <script>
        $(function () {
            $('.alert').fadeOut(1500);
            $('#uploadData').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/get-anm-target-data');?>",
                "columns": [

                    { "data": "sr_no" },
                    { "data": "filenames" },
                    { "data": "uploaded_on" },
                    { "data": "status" },
                    { "data": "actions" },
                ],
                /* rowCallback: function (row, data,index){
                     var html = $.map(data['tag'], function(array){ return array['title']});
                     $("td:eq(0)", row).html(html.join(","));
                 }*/
            });
        });
    </script>
@endsection