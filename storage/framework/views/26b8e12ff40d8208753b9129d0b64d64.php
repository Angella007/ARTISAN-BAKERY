<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<h1 style="color: var(--secondary-color); margin-bottom: 2rem;">Admin Dashboard
    
</h1>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    <!-- Total Orders -->
    <div style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); padding: 2rem; border-radius: 15px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h3 style="font-size: 2.5rem; margin: 0;"><?php echo e(\App\Models\Order::count()); ?></h3>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Total Orders</p>
    </div>

    <!-- Pickup Orders -->
    <div style="background: linear-gradient(135deg, #667eea, #764ba2); padding: 2rem; border-radius: 15px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h3 style="font-size: 2.5rem; margin: 0;"><?php echo e(\App\Models\Order::where('order_type', 'pickup')->count()); ?></h3>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Pickup Orders</p>
    </div>

    <!-- Catering Orders -->
    <div style="background: linear-gradient(135deg, #f093fb, #f5576c); padding: 2rem; border-radius: 15px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h3 style="font-size: 2.5rem; margin: 0;"><?php echo e(\App\Models\Order::where('order_type', 'catering')->count()); ?></h3>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Catering Orders</p>
    </div>

    <!-- Custom Cakes -->
    <div style="background: linear-gradient(135deg, #4facfe, #00f2fe); padding: 2rem; border-radius: 15px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h3 style="font-size: 2.5rem; margin: 0;"><?php echo e(\App\Models\Order::where('order_type', 'custom-cake')->count()); ?></h3>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Custom Cakes</p>
    </div>
</div>

<!-- Recent Orders -->
<div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="color: var(--secondary-color); margin: 0;">Recent Orders</h2>
        <a href="<?php echo e(route('orders.index')); ?>" class="btn-secondary">View All Orders</a>
    </div>

    <?php
        $recentOrders = \App\Models\Order::latest()->take(5)->get();
    ?>

    <?php if($recentOrders->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Order Type</th>
                    <th>Pickup Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>#<?php echo e($order->id); ?></td>
                    <td><?php echo e($order->full_name); ?></td>
                    <td>
                        <span style="background: var(--accent-color); padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem;">
                            <?php echo e(ucfirst(str_replace('-', ' ', $order->order_type))); ?>

                        </span>
                    </td>
                    <td>
                        <?php if($order->pickup_date): ?>
                            <?php echo e($order->pickup_date->format('M d, Y')); ?>

                        <?php else: ?>
                            <em>Not specified</em>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span style="color: #28a745; font-weight: 500;">New</span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('orders.show', $order)); ?>" style="color: var(--secondary-color);">View Details</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; padding: 2rem; color: #666;">No orders yet.</p>
    <?php endif; ?>
</div>

<!-- Quick Actions -->
<div style="margin-top: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
    <a href="<?php echo e(route('orders.index')); ?>" class="btn" style="text-align: center;">
        📋 Manage Orders
    </a>
    <a href="<?php echo e(route('home')); ?>" class="btn-secondary" style="text-align: center;">
        🏠 View Public Site
    </a>
    <a href="<?php echo e(route('profile.edit')); ?>" class="btn-secondary" style="text-align: center;">
        👤 Edit Profile
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bakery\resources\views/dashboard.blade.php ENDPATH**/ ?>