

<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-8">
            <div class="card d-flex mx-auto my-5">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12 c1 p-5">

                        <div id="hero" class="bg-transparent h-auto order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                            <img class="img-fluid animated"
                            src="<?php echo e(asset('general/images/Daco_227767.png')); ?>"
                            alt="">
                        </div>
                        <div class="row justify-content-center">
                            <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                <h1 class="wlcm">Welcome</h1> <span class="sp1"> <span
                                        class="px-3 bg-danger rounded-pill"></span> <span
                                        class="ml-2 px-1 rounded-circle"></span> <span
                                        class="ml-2 px-1 rounded-circle"></span> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 c2 px-5 pt-5">
                        <div class="row mb-5 m-3"> 
                            <a href="<?php echo e(route('cefa.welcome')); ?>"><img src="<?php echo e(asset('general/images/Group1.png')); ?>" width="40%" height="auto" alt=""></a> 
                        </div>
                        <form method="POST" action="<?php echo e(route('login')); ?>" class="px-5 pb-5" name="myform">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex">
                                <h3 class="font-weight-bold"> <?php echo e(__('Login')); ?></h3>
                            </div>
                           
                            <label for="email" class="col-md-12 col-form-label text-md-right"><?php echo e(__('E-Mail
                                Address')); ?></label>
                            <input id="email" type="text" class=" <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                value="<?php echo e(old('email')); ?>" required autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label for="password" class="col-md-12 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
                            <input id="password" type="password" class=" <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="password" required autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <button type="submit" class="text-white text-weight-bold btlogin">Login</button>
                            <a href="<?php echo e(route('cefa.user.register.index')); ?>" class="btn btlogin text-white">Registrarse</a>
                            <a class="btn btn-link forgot" href="<?php echo e(route('password.request')); ?>" > <?php echo e(__('Forgot Your Password?')); ?></a>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\resources\views/auth/login.blade.php ENDPATH**/ ?>