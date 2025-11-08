<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Artisan Bakery</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="{{ url('/') }}" class="logo">🥖 Artisan Bakery</a>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}" class="active">About</a></li>
                <li><a href="{{ url('/contact') }}">Order Now</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}" style="background: var(--primary-color); padding: 0.5rem 1rem; border-radius: 5px;">Register</a></li>
                @endguest
                @auth
                    @if(Auth::user()->is_admin)
                        <li><a href="{{ route('admin.dashboard') }}" style="background: var(--secondary-color); padding: 0.5rem 1rem; border-radius: 5px; color: white;">📊 Dashboard</a></li>
                    @endif
                    <li style="color: var(--primary-color);">👤 {{ Auth::user()->name }}</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: var(--text-color); cursor: pointer; font-size: 1rem;">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Our Story</h1>
            <p>Where passion meets tradition, one loaf at a time</p>
        </div>
    </section>

    <!-- About Content -->
    <section>
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3>Welcome to Artisan Bakery</h3>
                    <p>Founded in 2015, Artisan Bakery began as a dream to bring authentic, handcrafted baked goods to our community. What started as a small family operation has grown into a beloved neighborhood destination for fresh bread, pastries, and custom cakes.</p>
                    <p>Our founder, Maria Santos, grew up learning traditional baking techniques from her grandmother in a small European village. She brought those time-honored methods to our modern kitchen, where every recipe is still made by hand with the same care and attention to detail.</p>
                    <p>Today, our team of skilled bakers continues this tradition, rising before dawn each day to ensure that when you walk through our doors, you're greeted by the aroma of fresh-baked bread and the warmth of genuine hospitality.</p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/pexels-moh-adbelghaffar-14979840.jpg') }}" alt="Our Bakery">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section style="background-color: white;">
        <div class="container">
            <h2>Our Mission & Values</h2>
            <p>We believe in quality, community, and the simple joy of sharing good food</p>
            
            <div class="features">
                <div class="feature-card">
                    <h3>Quality First</h3>
                    <p>We never compromise on ingredients or technique. Every product that leaves our kitchen meets our highest standards of excellence.</p>
                </div>
                <div class="feature-card">
                    <h3>Community Focus</h3>
                    <p>We source locally whenever possible and actively support our neighborhood through partnerships with schools and charities.</p>
                </div>
                <div class="feature-card">
                    <h3>Sustainability</h3>
                    <p>From reducing waste to using eco-friendly packaging, we're committed to protecting our planet for future generations.</p>
                </div>
                <div class="feature-card">
                    <h3>Innovation</h3>
                    <p>While honoring tradition, we're always experimenting with new flavors and techniques to delight our customers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section>
        <div class="container">
            <h2>Behind the Scenes</h2>
            <p>Take a peek into our kitchen and see where the magic happens</p>
            
            <div class="gallery">
                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-asadphoto-29346178.jpg') }}" alt="Baking Process">
                    <div class="overlay">
                        <h3>Handcrafted Daily</h3>
                        <p>Every item made with care</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-ahmetyuksek-34386381.jpg') }}" alt="Fresh Ingredients">
                    <div class="overlay">
                        <h3>Premium Ingredients</h3>
                        <p>Quality you can taste</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-caleboquendo-34611831.jpg') }}" alt="Bakery Interior">
                    <div class="overlay">
                        <h3>Welcoming Space</h3>
                        <p>A place to gather and enjoy</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-idilcelikler-34581352.jpg') }}" alt="Artisan Techniques">
                    <div class="overlay">
                        <h3>Traditional Methods</h3>
                        <p>Time-tested techniques</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-planka-29137371.jpg') }}" alt="Baking Team">
                    <div class="overlay">
                        <h3>Skilled Bakers</h3>
                        <p>Passionate professionals</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-sejio402-28835203.jpg') }}" alt="Final Products">
                    <div class="overlay">
                        <h3>Perfect Results</h3>
                        <p>Made with love</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet the Team -->
    <section style="background-color: white;">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="features">
                <div class="feature-card">
                    <h3>👩‍🍳 Maria Santos</h3>
                    <p><strong>Founder & Head Baker</strong><br>30+ years of baking experience. Maria's passion for traditional techniques and quality ingredients is the foundation of everything we do.</p>
                </div>
                <div class="feature-card">
                    <h3>👨‍🍳 James Miller</h3>
                    <p><strong>Pastry Chef</strong><br>Trained in Paris, James brings European flair to our pastries and desserts. His creativity knows no bounds.</p>
                </div>
                <div class="feature-card">
                    <h3>👩‍🍳 Sofia Rodriguez</h3>
                    <p><strong>Cake Designer</strong><br>Sofia transforms celebrations into edible art. Her custom cake designs have become legendary in our community.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="hero" style="padding: 3rem 0;">
        <div class="container">
            <h2 style="color: var(--primary-color); font-size: 2.5rem;">Visit Us Today</h2>
            <p style="margin-bottom: 2rem;">Experience the difference that passion and quality make</p>
            <a href="{{ url('/contact') }}" class="btn">Place Your Order</a>
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
