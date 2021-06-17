<h1>Register</h1>

<?php \app\core\widgets\Form::begin('','POST')?>
<?= $form->field($model, 'firstname') ?>
<?= $form->field($model, 'lastname')->textField() ?>
<?= $form->field($model, 'emailname')->emailField() ?>
<?= $form->field($model, 'password')->passwordField()?>
<?= $form->field($model, 'confirmPassword') ?>

<button type="submit" class="btn btn-primary">Save</button>

<?php \app\core\widgets\Form::end()?>

<!-- <form action="" method="POST">
  <div class="mb-3">
    <label class="form-label">Firstname</label>
    <input type="text" name = "firstname" class="form-control" <?= $model->hasError('firstname')?'is_invalued' : '' ?> value= "<?= $model->firstname?>" >

    <div class="invalid-feedback">   
      < ?= $model->getFirstError('firstname')?>
    </div>    
  </div>
  <div class="mb-3">
    <label class="form-label">Lastname</label>
    <input type="text" name = "lastname" class="form-control" value= "<?= $model->lastname?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input name="email" class="form-control" id="" cols="30" rows="10" value= "<?= $model->email?>"></input>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input name="password" class="form-control" id="" cols="30" rows="10" value= "<?= $model->password?>"></input>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input name="confirmPassword" class="form-control" id="" cols="30" rows="10" value= "<?= $model->confirmpassword?>"></input>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form> -->