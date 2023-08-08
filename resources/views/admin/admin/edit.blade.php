@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit New User</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              {{-- <h3 class="card-title"></h3> --}}
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="">
                {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" value="{{$getRecord->name }}" required placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label >Email address</label>
                  <input type="email" class="form-control" name="email"  value="{{ $getRecord->email }}"  required placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control" name="password" required placeholder="Password">
                  <p>Do you want to change password so please adad new password</p>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

  @endsection