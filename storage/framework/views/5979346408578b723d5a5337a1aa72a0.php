

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 2rem;">
    <a href="<?php echo e(route('orders.index')); ?>" class="btn-secondary">← Back to Orders</a>
</div>

<div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 2px solid var(--accent-color); padding-bottom: 1rem;">
        <h1 style="color: var(--secondary-color);">Order #<?php echo e($order->id); ?></h1>
        <div>
            <a href="<?php echo e(route('orders.edit', $order)); ?>" class="btn">Edit Order</a>
            <form action="<?php echo e(route('orders.destroy', $order)); ?>" method="POST" style="display: inline;" 
                  onsubmit="return confirm('Are you sure you want to delete this order?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-danger">Delete Order</button>
            </form>
        </div>
    </div>

    <!-- Customer Information -->
    <section style="margin-bottom: 2rem;">
        <h2 style="color: var(--secondary-color); font-size: 1.5rem; margin-bottom: 1rem;">Customer Information</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div>
                <strong>Name:</strong><br>
                <?php echo e($order->full_name); ?>

            </div>
            <div>
                <strong>Email:</strong><br>
                <a href="mailto:<?php echo e($order->email); ?>"><?php echo e($order->email); ?></a>
            </div>
            <div>
                <strong>Phone:</strong><br>
                <a href="tel:<?php echo e($order->phone); ?>"><?php echo e($order->phone); ?></a>
            </div>
            <div>
                <strong>Order Type:</strong><br>
                <span style="background: var(--accent-color); padding: 0.25rem 0.75rem; border-radius: 12px;">
                    <?php echo e(ucfirst(str_replace('-', ' ', $order->order_type))); ?>

                </span>
            </div>
        </div>
    </section>

    <!-- Pickup Information -->
    <section style="margin-bottom: 2rem;">
        <h2 style="color: var(--secondary-color); font-size: 1.5rem; margin-bottom: 1rem;">Pickup Details</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div>
                <strong>Pickup Date:</strong><br>
                <?php echo e($order->pickup_date ? $order->pickup_date->format('F d, Y') : 'Not specified'); ?>

            </div>
            <div>
                <strong>Pickup Time:</strong><br>
                <?php echo e($order->pickup_time ?? 'Not specified'); ?>

            </div>
        </div>
    </section>

    <!-- Products & Preferences -->
    <section style="margin-bottom: 2rem;">
        <h2 style="color: var(--secondary-color); font-size: 1.5rem; margin-bottom: 1rem;">Products & Preferences</h2>
        <div style="margin-bottom: 1rem;">
            <strong>Products Interested In:</strong><br>
            <?php if($order->products && count($order->products) > 0): ?>
                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="background: var(--accent-color); padding: 0.25rem 0.75rem; border-radius: 12px; margin-right: 0.5rem; display: inline-block; margin-bottom: 0.5rem;">
                        <?php echo e(ucfirst($product)); ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <em>None selected</em>
            <?php endif; ?>
        </div>
        <div>
            <strong>Dietary Preferences:</strong><br>
            <?php echo e($order->dietary ? ucfirst(str_replace('-', ' ', $order->dietary)) : 'None'); ?>

        </div>
    </section>

    <!-- Order Details -->
    <section style="margin-bottom: 2rem;">
        <h2 style="color: var(--secondary-color); font-size: 1.5rem; margin-bottom: 1rem;">Order Details</h2>
        <div style="background: var(--light-color); padding: 1rem; border-radius: 5px; border-left: 4px solid var(--primary-color);">
            <?php echo e($order->order_details); ?>

        </div>
    </section>

    <!-- Marketing Preferences -->
    <section style="margin-bottom: 2rem;">
        <h2 style="color: var(--secondary-color); font-size: 1.5rem; margin-bottom: 1rem;">Marketing Preferences</h2>
        <div>
            <strong>Newsletter Subscription:</strong> 
            <?php if($order->newsletter): ?>
                <span style="color: green;">✓ Yes</span>
            <?php else: ?>
                <span style="color: #999;">✗ No</span>
            <?php endif; ?>
        </div>
        <div>
            <strong>SMS Alerts:</strong> 
            <?php if($order->sms_alerts): ?>
                <span style="color: green;">✓ Yes</span>
            <?php else: ?>
                <span style="color: #999;">✗ No</span>
            <?php endif; ?>
        </div>
    </section>

    <!-- Timestamps -->
    <section style="border-top: 1px solid var(--accent-color); padding-top: 1rem; color: #666; font-size: 0.9rem;">
        <div><strong>Submitted:</strong> <?php echo e($order->created_at->format('F d, Y \a\t h:i A')); ?></div>
        <?php if($order->updated_at != $order->created_at): ?>
            <div><strong>Last Updated:</strong> <?php echo e($order->updated_at->format('F d, Y \a\t h:i A')); ?></div>
        <?php endif; ?>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\bakery\resources\views/orders/show.blade.php ENDPATH**/ ?>