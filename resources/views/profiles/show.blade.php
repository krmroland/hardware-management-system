@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                  <h4 class="card-title text-center">Bio Data</h4>
                  <table class="table table-bordered table-hover table-sm">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Administrative Rights</th>

                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td> {{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->phoneNumber }}</td>
                              <td> {{ $user->isAdmin?"Yes":"No" }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </div>

            <div class="row">
                @include('profiles.changePassword')
                <div class="col-md-4 mt-3">
                  <div class="card">
                    <div class="card-body">

                        <h4 class="card-title text-center">Activated Branches</h4>
                        <ul class="list-group">
                          @foreach (auth()->user()->allBranches() as $branch)
                            <li class="list-group-item">{{ $branch->name }}</li>
                          @endforeach
                         
                         
                        </ul>
                 
                    </div>
                  </div>
                </div>
                
            </div>

           
    @endsection

