<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - Artisan Bakery</title>
    <link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="<?php echo e(url('/')); ?>" class="logo">🥖 Artisan Bakery</a>
            <ul>
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li><a href="<?php echo e(url('/about')); ?>">About</a></li>
                <li><a href="<?php echo e(url('/contact')); ?>" class="active">Order Now</a></li>
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li><a href="<?php echo e(route('register')); ?>" style="background: var(--primary-color); padding: 0.5rem 1rem; border-radius: 5px;">Register</a></li>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->is_admin): ?>
                        <li><a href="<?php echo e(route('admin.dashboard')); ?>" style="background: var(--secondary-color); padding: 0.5rem 1rem; border-radius: 5px; color: white;">📊 Dashboard</a></li>
                    <?php endif; ?>
                    <li style="color: var(--primary-color);">👤 <?php echo e(Auth::user()->name); ?></li>
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background: none; border: none; color: var(--text-color); cursor: pointer; font-size: 1rem;">Logout</button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Place Your Order</h1>
            <p>Fill out the form below and we'll have your fresh baked goods ready for pickup</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section>
        <div class="container">
            <div class="form-container">
                <h2 style="text-align: left; margin-bottom: 1.5rem;">Order Information</h2>
                
                <?php if(auth()->guard()->guest()): ?>
                    <div class="alert alert-error" style="margin-bottom: 2rem;">
                        <h3 style="margin: 0 0 1rem 0;">🔒 Login Required</h3>
                        <p style="margin-bottom: 1rem;">You need to be logged in to place an order. This helps us keep track of your orders and provide better service.</p>
                        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                            <a href="<?php echo e(route('login')); ?>" class="btn">Login</a>
                            <a href="<?php echo e(route('register')); ?>" class="btn-secondary">Create Account</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <div style="background: #e7f3ff; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid var(--primary-color);">
                        <p style="margin: 0;">
                            <strong>Welcome, <?php echo e(Auth::user()->name); ?>!</strong> Your order will be saved to your account.
                        </p>
                    </div>
                <?php endif; ?>
                
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('orders.store')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Personal Information -->
                    <div class="form-row">
                        <div class="form-group required">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
                        </div>
                        <div class="form-group required">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="your.email@example.com">
                    </div>

                    <div class="form-group required">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" required placeholder="(555) 123-4567">
                    </div>

                    <!-- Order Details -->
                    <div class="form-group required">
                        <label for="order_type">Order Type</label>
                        <select id="order_type" name="order_type" required>
                            <option value="">-- Select Order Type --</option>
                            <option value="pickup" <?php echo e(old('order_type') == 'pickup' ? 'selected' : ''); ?>>Pickup</option>
                            <option value="catering" <?php echo e(old('order_type') == 'catering' ? 'selected' : ''); ?>>Catering / Large Order</option>
                            <option value="custom-cake" <?php echo e(old('order_type') == 'custom-cake' ? 'selected' : ''); ?>>Custom Cake</option>
                            <option value="weekly" <?php echo e(old('order_type') == 'weekly' ? 'selected' : ''); ?>>Weekly Subscription</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pickup_date">Preferred Pickup Date</label>
                        <input type="date" id="pickup_date" name="pickup_date" value="<?php echo e(old('pickup_date')); ?>" min="<?php echo e(date('Y-m-d')); ?>">
                    </div>

                    <div class="form-group">
                        <label for="pickup_time">Preferred Pickup Time</label>
                        <select id="pickup_time" name="pickup_time">
                            <option value="">-- Select Time --</option>
                            <?php $__currentLoopData = ['7:00 AM', '8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM', '6:00 PM']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($time); ?>" <?php echo e(old('pickup_time') == $time ? 'selected' : ''); ?>><?php echo e($time); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Product Preferences -->
                    <div class="form-group">
                        <label>Products Interested In (check all that apply)</label>
                        <div class="checkbox-group">
                            <?php $__currentLoopData = ['bread' => 'Artisan Breads', 'pastries' => 'Pastries', 'cakes' => 'Cakes', 'cookies' => 'Cookies', 'desserts' => 'Desserts', 'specialty' => 'Specialty Items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label>
                                    <input type="checkbox" name="products[]" value="<?php echo e($value); ?>" <?php echo e(in_array($value, old('products', [])) ? 'checked' : ''); ?>>
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
                                <option value="<?php echo e($diet); ?>" <?php echo e(old('dietary') == $diet ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst(str_replace('-', ' ', $diet))); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Order Details -->
                    <div class="form-group required">
                        <label for="order_details">Order Details / Special Instructions</label>
                        <textarea id="order_details" name="order_details" required placeholder="Please describe what you'd like to order, including quantities, flavors, or any special requests..."><?php echo e(old('order_details')); ?></textarea>
                    </div>

                    <!-- Marketing Preferences -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="newsletter" value="1" <?php echo e(old('newsletter') ? 'checked' : ''); ?>>
                            Subscribe to our newsletter for weekly specials and baking tips
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="sms_alerts" value="1" <?php echo e(old('sms_alerts') ? 'checked' : ''); ?>>
                            Receive SMS alerts when my order is ready
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">Submit Order Request</button>
                    
                    <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem; color: #666;">
                        * Required fields. We'll contact you within 24 hours to confirm your order and provide pricing.
                    </p>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section style="background-color: white;">
        <div class="container">
            <h2>Other Ways to Reach Us</h2>
            <div class="features">
                <div class="feature-card">
                    <h3>📍 Visit Us</h3>
                    <p><strong>Artisan Bakery</strong><br>
                    123 Baker Street<br>
                    Hometown, ST 12345<br>
                    <em>Mon-Sat: 7am-6pm<br>Sunday: 8am-4pm</em></p>
                </div>
                <div class="feature-card">
                    <h3>📞 Call Us</h3>
                    <p><strong>Phone:</strong><br>
                    (555) 123-4567<br><br>
                    <strong>Fax:</strong><br>
                    (555) 123-4568</p>
                </div>
                <div class="feature-card">
                    <h3>✉️ Email Us</h3>
                    <p><strong>General Inquiries:</strong><br>
                    hello@artisanbakery.com<br><br>
                    <strong>Custom Orders:</strong><br>
                    orders@artisanbakery.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Artisan Bakery. All rights reserved.</p>
            <p>123 Baker Street | Phone: (555) 123-4567 | Email: hello@artisanbakery.com</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\wamp64\www\bakery\resources\views/contact.blade.php ENDPATH**/ ?>