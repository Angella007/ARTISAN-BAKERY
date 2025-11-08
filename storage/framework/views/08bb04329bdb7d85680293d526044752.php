<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Bakery - Fresh Baked Daily</title>
    <link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="<?php echo e(url('/')); ?>" class="logo">🥖 Artisan Bakery</a>
            <ul>
                <li><a href="<?php echo e(url('/')); ?>" class="active">Home</a></li>
                <li><a href="<?php echo e(url('/about')); ?>">About</a></li>
                <li><a href="<?php echo e(url('/contact')); ?>">Order Now</a></li>
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
            <h1>Welcome to Artisan Bakery</h1>
            <p>Freshly baked goods made with love, every single day</p>
            <a href="<?php echo e(url('/contact')); ?>" class="btn">Order Your Favorites</a>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section>
        <div class="container">
            <h2>Our Fresh Baked Goods</h2>
            <p>From artisan breads to delicate pastries, each item is crafted with premium ingredients and traditional techniques.</p>
            
            <div class="gallery">
                <div class="gallery-item">
                    <img src="<?php echo e(asset('images/pexels-pixabay-209206.jpg')); ?>" alt="Fresh Bread">
                    <div class="overlay">
                        <h3>Artisan Breads</h3>
                        <p>Sourdough, baguettes, and whole grain loaves</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="<?php echo e(asset('images/pexels-klaus-nielsen-6287300.jpg')); ?>" alt="Pastries">
                    <div class="overlay">
                        <h3>Delicate Pastries</h3>
                        <p>Croissants, danishes, and sweet treats</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="<?php echo e(asset('images/pexels-karola-g-6660187.jpg')); ?>" alt="Cakes">
                    <div class="overlay">
                        <h3>Custom Cakes</h3>
                        <p>Beautiful cakes for every celebration</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="<?php echo e(asset('images/pexels-valeriiamiller-3020919.jpg')); ?>" alt="Cookies">
                    <div class="overlay">
                        <h3>Fresh Cookies</h3>
                        <p>Chocolate chip, oatmeal, and seasonal flavors</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="<?php echo e(asset('images/pexels-marta-dzedyshko-1042863-2067631.jpg')); ?>" alt="Specialty Items">
                    <div class="overlay">
                        <h3>Specialty Items</h3>
                        <p>Unique creations and seasonal specials</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="<?php echo e(asset('images/pexels-vlada-karpovich-7099883.jpg')); ?>" alt="Desserts">
                    <div class="overlay">
                        <h3>Gourmet Desserts</h3>
                        <p>Decadent desserts for discerning palates</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section style="background-color: white;">
        <div class="container">
            <h2>Why Choose Artisan Bakery?</h2>
            <div class="features">
                <div class="feature-card">
                    <h3>🌾 Fresh Ingredients</h3>
                    <p>We use only the finest locally-sourced ingredients, ensuring every bite is packed with flavor and quality.</p>
                </div>
                <div class="feature-card">
                    <h3>👨‍🍳 Master Bakers</h3>
                    <p>Our experienced bakers bring decades of expertise and passion to every loaf, pastry, and cake.</p>
                </div>
                <div class="feature-card">
                    <h3>⏰ Baked Daily</h3>
                    <p>Everything is baked fresh each morning, so you always get the warmest, most delicious products.</p>
                </div>
                <div class="feature-card">
                    <h3>🎂 Custom Orders</h3>
                    <p>Need something special? We create custom cakes and platters for all your celebrations and events.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="hero" style="padding: 3rem 0;">
        <div class="container">
            <h2 style="color: var(--primary-color); font-size: 2.5rem;">Ready to Taste the Difference?</h2>
            <p style="margin-bottom: 2rem;">Visit us today or place your order online for pickup</p>
            <a href="<?php echo e(url('/contact')); ?>" class="btn">Place Your Order</a>
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
<?php /**PATH C:\wamp64\www\bakery\resources\views/index.blade.php ENDPATH**/ ?>