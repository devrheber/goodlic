@extends('new_admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Email Templates List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Email Templates List</li>
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
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Email Templates List</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="admin_users" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">SR. #</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        @php
                                $count = 1;
                            @endphp
                            @foreach ($email_templates as $template )
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$template->id}}</td>
                                <td>{{$template->name}}</td>
                                <td>
                                    <a href="{{ route('admin.email_template.detail', $template->id) }}"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @php
                            $count++;
                        @endphp
                            @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer_script')

<script>

    $('#admin_users').DataTable(
        {
            "responsive": true, "lengthChange": false, "autoWidth": false,
            dom: 'Bfrtip',
            lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'copyHtml5',
                title: 'Email Templates',
                 exportOptions: {
                    columns: ':visible',
                    rows: ':visible'
                 }
            },
            {
                extend: 'excelHtml5',
                title: 'Email Templates',
                exportOptions: {
                    columns: ':visible',
                    rows: ':visible'
                 }
            },
            {
                extend: 'csvHtml5',
                title: 'Email Templates',
                exportOptions: {
                    columns: ':visible',
                    rows: ':visible'
                 }
            },
            {
                extend: 'pdfHtml5',
                title: 'Email Templates',
                exportOptions: {
                    columns: ':visible',
                    rows: ':visible'
                 }
            },
            {
                extend: 'print',
                title: 'Email Templates',
                exportOptions: {
                    columns: ':visible',
                    rows: ':visible'
                 }
            },
            'pageLength'
        ],
        select: true
        }
    ).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
@endsection
