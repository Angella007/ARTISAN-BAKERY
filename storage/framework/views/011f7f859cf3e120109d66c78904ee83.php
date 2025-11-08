

<?php $__env->startSection('title', 'Edit Order'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 2rem;">
    <a href="<?php echo e(route('orders.show', $order)); ?>" class="btn-secondary">← Back to Order</a>
</div>

<div class="form-container">
    <h1 style="text-align: center; color: var(--secondary-color); margin-bottom: 2rem;">Edit Order #<?php echo e($order->id); ?></h1>

    <form method="POST" action="<?php echo e(route('orders.update', $order)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Personal Information -->
        <div class="form-row">
            <div class="form-group required">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo e(old('first_name', $order->first_name)); ?>" required>
                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group required">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo e(old('last_name', $order->last_name)); ?>" required>
                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-group required">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email', $order->email)); ?>" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group required">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone', $order->phone)); ?>" required>
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Order Details -->
        <div class="form-group required">
            <label for="order_type">Order Type</label>
            <select id="order_type" name="order_type" required>
                <option value="">-- Select Order Type --</option>
                <option value="pickup" <?php echo e(old('order_type', $order->order_type) == 'pickup' ? 'selected' : ''); ?>>Pickup</option>
                <option value="catering" <?php echo e(old('order_type', $order->order_type) == 'catering' ? 'selected' : ''); ?>>Catering / Large Order</option>
                <option value="custom-cake" <?php echo e(old('order_type', $order->order_type) == 'custom-cake' ? 'selected' : ''); ?>>Custom Cake</option>
                <option value="weekly" <?php echo e(old('order_type', $order->order_type) == 'weekly' ? 'selected' : ''); ?>>Weekly Subscription</option>
            </select>
            <?php $__errorArgs = ['order_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="pickup_date">Preferred Pickup Date</label>
            <input type="date" id="pickup_date" name="pickup_date" 
                   value="<?php echo e(old('pickup_date', $order->pickup_date ? $order->pickup_date->format('Y-m-d') : '')); ?>">
            <?php $__errorArgs = ['pickup_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="pickup_time">Preferred Pickup Time</label>
            <select id="pickup_time" name="pickup_time">
                <option value="">-- Select Time --</option>
                <?php $__currentLoopData = ['7:00 AM', '8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM', '6:00 PM']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($time); ?>" <?php echo e(old('pickup_time', $order->pickup_time) == $time ? 'selected' : ''); ?>><?php echo e($time); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Product Preferences -->
        <div class="form-group">
            <label>Products Interested In (check all that apply)</label>
            <div class="checkbox-group">
                <?php $__currentLoopData = ['bread' => 'Artisan Breads', 'pastries' => 'Pastries', 'cakes' => 'Cakes', 'cookies' => 'Cookies', 'desserts' => 'Desserts', 'specialty' => 'Specialty Items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label>
                        <input type="checkbox" name="products[]" value="<?php echo e($value); ?>" 
                               <?php echo e(in_array($value, old('products', $order->products ?? [])) ? 'checked' : ''); ?>>
                        <?php echo e($label); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Dietary Preferences -->
        <div class="form-group">
            <label for="dietary">Dietary Preferences / Allergies</label>
            <select id="dietary" name="dietary">
                <option value="">None</option>
                <?php $__currentLoopData = ['gluten-free', 'vegan', 'dairy-free', 'nut-free', 'sugar-free']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($diet); ?>" <?php echo e(old('dietary', $order->dietary) == $diet ? 'selected' : ''); ?>>
                        <?php echo e(ucfirst(str_replace('-', ' ', $diet))); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Order Details -->
        <div class="form-group required">
            <label for="order_details">Order Details / Special Instructions</label>
            <textarea id="order_details" name="order_details" required><?php echo e(old('order_details', $order->order_details)); ?></textarea>
            <?php $__errorArgs = ['order_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color: #dc3545; font-size: 0.875rem;"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Marketing Preferences -->
        <div class="form-group">
            <label>
                <input type="checkbox" name="newsletter" value="1" <?php echo e(old('newsletter', $order->newsletter) ? 'checked' : ''); ?>>
                Subscribe to newsletter
            </label>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="sms_alerts" value="1" <?php echo e(old('sms_alerts', $order->sms_alerts) ? 'checked' : ''); ?>>
                Receive SMS alerts
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Update Order</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bakery\resources\views/orders/edit.blade.php ENDPATH**/ ?>