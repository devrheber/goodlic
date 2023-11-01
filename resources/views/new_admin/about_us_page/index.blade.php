@extends('new_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">About Us</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"> About Us </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-md-12">
                    <form action="{{route('admin.about_us_page.store')}}" enctype="multipart/form-data"  method="post">
                        @csrf
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Section 1</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" required name="section_1_title"
                                value="{{isset($content->section_1_title)?$content->section_1_title:''}}"
                                    placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" placeholder="Enter Description" required name="section_1_description" cols="30"
                                    rows="10">{{isset($content->section_1_description)?$content->section_1_description:''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="section_1_image" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Section 2</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" value="{{isset($content->section_2_title)?$content->section_2_title:''}}" required name="section_2_title"
                                    placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" placeholder="Enter Description" required name="section_2_description" cols="30"
                                    rows="10">{{isset($content->section_2_description)?$content->section_2_description:''}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Icon 1</label>
                                        <input type="file" name="section_2_first_image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Heading</label>
                                        <input type="text" class="form-control" value="{{isset($content->section_2_first_heading)?$content->section_2_first_heading:''}}" required name="section_2_first_heading"
                                            placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Heading</label>
                                        <input type="text" value="{{isset($content->section_2_first_sub_heading)?$content->section_2_first_sub_heading:''}}" class="form-control" required
                                            name="section_2_first_sub_heading" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Icon 2</label>
                                        <input type="file" name="section_2_second_image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Heading</label>
                                        <input type="text" class="form-control" required value="{{isset($content->section_2_second_heading)?$content->section_2_second_heading:''}}" name="section_2_second_heading"
                                            placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Heading</label>
                                        <input type="text" class="form-control" required value="{{isset($content->section_2_second_sub_heading)?$content->section_2_second_sub_heading:''}}"
                                            name="section_2_second_sub_heading" placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Icon 3</label>
                                        <input type="file" name="section_2_third_image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Heading</label>
                                        <input type="text" class="form-control" required value="{{isset($content->section_2_third_heading)?$content->section_2_third_heading:''}}" name="section_2_third_heading"
                                            placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Heading</label>
                                        <input type="text" class="form-control" value="{{isset($content->section_2_third_sub_heading)?$content->section_2_third_sub_heading:''}}" required
                                            name="section_2_third_sub_heading" placeholder="Enter Title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Section 3</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" value="{{isset($content->section_3_title)?$content->section_3_title:''}}" required name="section_3_title"
                                    placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" placeholder="Enter Description" required name="section_3_description" cols="30"
                                    rows="10">{{isset($content->section_3_description)?$content->section_3_description:''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="section_3_image" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 pl-0 pt-3">
                        <button class="btn btn-primary" type="submit">
                            Update
                        </button>
                    </div>
                    </form>
                </div>
            </div>
    </section>
@endsection

@section('footer_script')
    <script>
        $(function() {
            $("#idselector").select2();
        });
    </script>
@endsection

<style>
    .select2-selection {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 100% !important;
    }
</style>
