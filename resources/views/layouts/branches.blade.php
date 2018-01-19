<div class="card mb-3">
  <div class="card-body">

     <div class="d-flex justify-content-between align-items-center text-center ">

        <img src="{{ optional(auth()->user())->avatar }}" alt="" height="50" width="50">
        <h5>
                <small>Logged In As</small>
                <span class="text-primary">{{ optional(auth()->user())->name }}</span>
        </h5>
       
       <div class="d-flex justify-content-between align-items-center">
           <h5><small>Active Branch</small></h5>
           <div class="ml-2">
            @if(auth()->user()->activeBranch())
              <active-branch 
                 :active="{{ auth()->user()->activeBranch() }}"
                 :all="{{ auth()->user()->allBranches() }}"
                 :user-id="{{ auth()->id() }}"
              ></active-branch> 
              @endif
           </div>
       </div>

       @if (auth()->user()->isAdmin())
        <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('branches.index') }}">
               <i class="fa fa-globe"></i>
                All Branches
            </a>
            <a class="btn btn-outline-primary" href="{{ route('users.index') }}">
               <i class="fa fa-group"></i>
                All Users
            </a>
        </div>
         

       @endif
      
     </div>
      
      
  </div>
</div>
