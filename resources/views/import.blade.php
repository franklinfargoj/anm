@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">ANM Import</h1>
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

    {!!  Form::open(array('route' => 'import.file','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>District</label>
                        {!! Form::select('district', $district, '',['class' => 'form-control' ,'id'=>"district"])!!}
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Month</label>
                        <select class="form-control" name="month">
                            @for($m=1; $m<=12; $m++)
                                <option value="{{$m}}">{{date('F', mktime(0,0,0,$m, 1, date('Y')))}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Year</label>
                        <select class="form-control" name="year">
                            @foreach (range(date('Y'), 2025) as $key => $value) {
                                <option>{{$value}}</option>;
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>SMS schedule</label>
                        <input type="text" id="schedule_at" name="schedule_at" placeholder="Select date and time" class="form-control">
                    </div>
                </div>

                <div class="col-sm-2">
                        <label>Select File to Import:</label>
                        <input type="file" class="form-control" name="sample_file" >
                </div>

                <div class="col-sm-2">
                    <div class="form-group btn-area">
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {!! Form::close() !!}
    <section>
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
    </section>

@endsection



@section('js')
    <script>

        $(function () {
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
        } );


        var d1 = new Date();
        var d2 = new Date();
        d1.setHours(+d2.getHours()+2);

        $("#schedule_at").datetimepicker({
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii',
            startDate: d1
        });
    </script>

@endsection