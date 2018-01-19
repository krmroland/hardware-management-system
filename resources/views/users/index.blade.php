@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-between">
        <h4 class="card-title text-center">Registered Users</h4>
        <h5>
          <small>  Total Users:</small>
          <strong> ({{ $users->count() }})</strong>
      </h5>
      <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
        <i class="fa fa-plus"></i>
        New  User
    </a>
</div>

<hr>
<data-table :data="{{ $users }}">
  <table-col label="Users Name" data-key="name"></table-col>  
  <table-col label="Phone Number" data-key="phoneNumber"></table-col>  
  <table-col label="Email" data-key="email"></table-col>
  <table-col label="Is Admin" data-key="isAdmin"></table-col>    
  <table-col>
     <template scope="row">
        <a :href="'/users/'+row.id+'/passwordReset'">Reset Password</a>
    </template>
  </table-col>  
</data-table> 

</div>
</div>

@endsection

