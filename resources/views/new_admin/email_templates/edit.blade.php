@extends('new_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Email Template</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('admin.email_templates.list') }}">Email
                                Templates List</a></li>
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
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Email Template</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.email_template.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $email_template->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $email_template->name }}" disabled placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label>Dynamic Variable</label>
                                    <p>
                                        Note: Please use these dynamic variable for your template.
                                    </p>
                                    @if ($email_template->variables)
                                        @php
                                            $variables = explode(',', $email_template->variables);
                                        @endphp
                                        @foreach ($variables as $variable)
                                            @php
                                                $vari = explode('-->', $variable);
                                            @endphp
                                            <div>
                                                <b style="width:210px; display:inline-block"> {{ $vari[0] }} : </b>
                                                &emsp; {{ $vari[1] }}<br>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control rounded-0 ckeditor" name="value" placeholder="Enter Description" rows="10">{{ $email_template->value }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6 pl-0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->



                </div>

            </div>
        </div>
    </section>
@endsection
