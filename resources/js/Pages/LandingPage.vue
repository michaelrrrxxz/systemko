<template>
    <div>
      <!-- Hero Section -->
      <section class="hero-section text-white text-center d-flex justify-content-center align-items-center">
        <div class="hero-content">
          <h1 class="display-4 mb-4">Welcome to Our Service</h1>
          <p class="lead mb-4">Revolutionize the way you work with our cutting-edge technology.</p>
          <Link :href="route('login')" class="btn btn-custom btn-lg">Get Started</Link>
        </div>
      </section>

      <!-- Features Section -->
      <section class="features-section py-5 text-center">
        <div class="container">
          <h2 class="mb-4">Features</h2>
          <div class="row">
            <div class="col-md-4">
              <div class="feature-card p-4">
                <h4 class="mb-3">Feature 1</h4>
                <p>Innovative and user-friendly interface that streamlines your work.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="feature-card p-4">
                <h4 class="mb-3">Feature 2</h4>
                <p>Advanced analytics to help you make data-driven decisions.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="feature-card p-4">
                <h4 class="mb-3">Feature 3</h4>
                <p>Seamless integration with your existing tools and workflows.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- About Section -->
      <section class="about-section py-5 bg-light text-center">
        <div class="container">
          <h2 class="mb-4">About Us</h2>
          <p>We are a team of passionate innovators committed to providing top-notch solutions that help businesses grow. Our mission is to make your work easier and more efficient.</p>
        </div>
      </section>

      <!-- Contact Section -->
      <section class="contact-section py-5 text-center">
        <div class="container">
          <h2 class="mb-4">Get in Touch</h2>
          <p>If you have any questions or want to learn more, feel free to contact us!</p>
          <a href="mailto:contact@ourservice.com" class="btn btn-custom">Contact Us</a>
        </div>
      </section>

      <!-- Footer -->
      <footer class="footer bg-dark text-white text-center py-3">
        <p>&copy; 2025 Our Service. All Rights Reserved.</p>
      </footer>
    </div>
  </template>

  <script>
  import { Link } from '@inertiajs/vue3';
  export default {
    name: 'LandingPage',
    components: {
      Link
    },
  };
  </script>

  <style scoped>
  /* Hero Section */
  .hero-section {
    background: linear-gradient(to right, #2ecc71, #27ae60);
    height: 100vh;
    color: white;
  }

  .hero-content {
    max-width: 600px;
    text-align: center;
  }

  /* Features Section */
  .features-section {
    background-color: #f8f9fa;
  }

  .feature-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-10px);
  }

  /* About Section */
  .about-section {
    background-color: #f8f9fa;
  }

  /* Contact Section */
  .contact-section {
    background-color: #2ecc71;
    color: white;
  }

  /* Footer */
  .footer {
    background-color: #333;
  }

  /* Custom Button */
  .btn-custom {
    background-color: #2ecc71;
    color: white;
    border-radius: 4px;
    padding: 12px 24px;
    font-size: 1.2rem;
    text-decoration: none;
  }

  .btn-custom:hover {
    background-color: #27ae60;
  }

  /* General Styles */
  h2 {
    font-weight: bold;
  }

  p {
    color: #555;
  }
  </style>
