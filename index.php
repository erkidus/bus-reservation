<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Urji Go</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    
    <style>
      
        /* Navbar styles */
        .navbar {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; /* Ensure the navbar is on top of other content */
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: #555;
        }
        .navbar a i {
            margin-right: 5px; /* Add some space between icon and text */
        }

        /* Parallax effect styles */
        .parallax-section {
            height: 100vh;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }
        .parallax-content {
            z-index: 1;
            position: relative;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5); /* Transparent background */
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
        }
        .parallax-content h1, .parallax-content p, .parallax-content ul {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Footer styles */
        footer {
            background-color: #333;
            color: #f2f2f2;
            text-align: center;
            padding: 20px 0;
            width: 100%;
        }
        .social-icons {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .social-icons li {
            margin-right: 10px;
        }
        .social-icons li a {
            text-decoration: none;
            display: flex;
            align-items: center;
            color: #ffffff;
            transition: color 0.3s ease;
        }
        .social-icons li a:hover {
            color: #000000;
        }
        .social-icons li a i {
            font-size: 24px;
            margin-right: 5px;
        }
        .social-icons li span {
            font-size: 16px;
        }
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .back-to-top:hover {
            background-color: #555;
        }
        .back-to-top i {
            font-size: 20px;
        }
        
        .about-content {
    background-color: rgba(200, 200, 200, 0.8); /* Light gray with transparency */
    padding: 20px;
    border-radius: 10px;
    width: 80%; /* Increase max-width for bigger content */
    margin: 0 auto; /* Center the content */
    margin-bottom: 40px; /* Add some space at the bottom */
    font-size: 18px; /* Increase font size for better readability */
}



.about-content h2 {
    color: #333; /* Darken the text color for better contrast */
}
.social-icons {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .social-icons li {
            margin-right: 10px;
        }

        .social-icons li a {
            text-decoration: none;
            display: flex;
            align-items: center;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .social-icons li a:hover {
            color: #000000;
        }

        .social-icons li a i {
            font-size: 24px;
            margin-right: 5px;
        }

        .social-icons li span {
            font-size: 16px;
        }
    </style>

    <style>
       .parallax-content {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            color: white;
        }

        .parallax-content h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .parallax-content p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .parallax-content ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .parallax-content ul li {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .navbar img {
            height: 7dvb;

        }
    </style>
</head>
<body>
    <div class="navbar">
    <a href="index.php"></i><i class="fas fa-bus"></i> Urjigo</a></li>
        <a href="#home"><i class="fas fa-home"></i>Home</a>
        <a href="#about"><i class="fas fa-info-circle"></i>About</a>
        <a href="#services"><i class="fas fa-cogs"></i>Our Services</a>
        <a href="contactus.php"><i class="fas fa-envelope"></i>Contact Us</a>
        <a href="admin/"><i class="fas fa-user-shield"></i>Admin</a>
        <a href="user/"><i class="fas fa-user"></i>User</a>
    </div>

<a href="" name="home"></a>
<div class="parallax-section" style="background-image: url('assets/image1.jpg');">
    <div class="parallax-content">
        <h1>Welcome to Urji Go</h1>
        <p>Your go-to destination for all your travel needs</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('assets/image2.jpg');">
    <div class="parallax-content">
        <h1>Explore Our Range of Services</h1>
        <p>Discover the convenience of Urji Go's services designed to enhance your travel experience. From booking tickets to accessing your journey details, we've got you covered every step of the way.</p>
        <ul>
            <li>Effortless Online Booking System</li>
            <li>Personalized Route Planning Assistance</li>
            <li>24/7 Access to Ticket Details and Itinerary</li>
            <li>Seamless Updates and Notifications</li>
            <li>Dedicated Customer Support for Any Queries</li>
        </ul>
        <p>Experience the ease and efficiency of traveling with Urji Go.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('assets/image3.jpg');">
    <div class="parallax-content">
        <h1>Why Choose Urji Go?</h1>
        <p>Urji Go is your trusted travel companion, committed to making your journey memorable and stress-free. With a focus on reliability and convenience, we strive to exceed your expectations every time you travel with us.</p>
        <ul>
            <li>Wide Network of Reputable Bus Operators</li>
            <li>Transparent Pricing with No Hidden Costs</li>
            <li>Convenient Access to Ticket Details Anytime, Anywhere</li>
            <li>Efficient Communication and Support Channels</li>
            <li>Effortless Itinerary Management for Peace of Mind</li>
        </ul>
        <p>Discover why travelers choose Urji Go for their travel needs.</p>
    </div>
</div>

<a href="" name="services"></a>
<div class="parallax-section" style="background-image: url('assets/image4.jpg');">
    <div class="parallax-content">
        <h1>Experience Excellence with Urji Go</h1>
        <p>At Urji Go, we prioritize your comfort and satisfaction above all else. Our commitment to excellence shines through in every aspect of our service, ensuring a smooth and enjoyable journey for every traveler.</p>
        <ul>
            <li>Streamlined Booking Process for Effortless Planning</li>
            <li>Accessible Ticket Details for Added Convenience</li>
            <li>Prompt Updates and Notifications for Peace of Mind</li>
            <li>Personalized Assistance from Our Dedicated Support Team</li>
            <li>Reliable Itinerary Management for Stress-Free Travel</li>
        </ul>
        <p>Join the Urji Go family and experience travel like never before.</p>
    </div>
</div>

<a href="" name="about"></a>
<div class="parallax-section" style="background-image: url('assets/image5.jpg');">
    <div class="parallax-content">
        <h1>About Us</h1>
        <p>Welcome to Urji Bus Reservation! We are a leading online platform for booking bus tickets and managing your travel plans. Our mission is to provide a convenient and hassle-free experience for bus travelers.</p>
        <p>At Urji Bus Reservation, we partner with various bus operators to offer a wide range of routes and destinations. Whether you're planning a short trip or a long journey, we have you covered.</p>
        <p>Our user-friendly website and mobile app allow you to easily search for available buses, compare prices, and make secure bookings. With our reliable services and customer support, you can travel with confidence.</p>
        <p>Thank you for choosing Urji Bus Reservation for all your bus travel needs!</p>
    </div>
</div>


<footer>
    <button class="back-to-top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"><i class="fas fa-arrow-up"></i></button>
    <ul class="social-icons">
        <li><a href="#"><i class="fab fa-telegram"></i><span>Telegram</span></a></li>
        <li><a href="#"><i class="fab fa-instagram"></i><span>Instagram</span></a></li>
        <li><a href="#"><i class="fab fa-facebook"></i><span>Facebook</span></a></li>
    </ul><br><br>
    <p>&copy; 2024 Urji Go. All rights reserved.</p>
</footer>

</body>
</html>
