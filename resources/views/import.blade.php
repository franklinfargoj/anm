@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content">
            {{--<div class="flex-center position-ref full-height">--}}
                {{--{!!  Form::open(array('route' => 'import.file','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}--}}
                {{--<div class="row">--}}

                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}--}}
                            {{--<div class="col-md-9">--}}
                                {{--{!! Form::file('sample_file', array('class' => 'form-control')) !!}--}}
                                {{--{!!  $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}--}}
                                {{--@if (session()->has('error'))--}}
                                    {{--<p class="alert alert-danger">--}}
                                        {{--{{ session()->get('error') }}<br>--}}
                                    {{--</p>--}}
                                {{--@endif--}}
                                {{--@if(session()->has('success'))--}}
                                    {{--<p class="alert alert-success">--}}
                                        {{--{{ session()->get('success') }}--}}
                                    {{--</p>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
                        {{--{!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            {{--</div>--}}

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
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
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
<!-- ./wrapper -->
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

                    { "data": "id" },
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
