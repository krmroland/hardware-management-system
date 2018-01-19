<div class="col-md-8">
    <div class="card mt-3">
      <div class="card-body">
          <h4 class="card-title text-center">Change Your Password</h4>
          {{ Form::fields(function($form){
             $form->passwordField()->name('oldPassword')->label("Old Password");
             $form->passwordField()->name('newPassword')->label("New Password");
             $form->button()->text("Change Password");
             $form->action("/profile")->method("PUT");
          })
           }}
  
      </div>
    </div>
</div>
