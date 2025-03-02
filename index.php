<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Helping Hands</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom animations */

        @keyframes fadeIn {

            from {

                opacity: 0;

                transform: translateY(20px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }



        .fade-in {

            animation: fadeIn 1s ease-in-out forwards;

        }
    </style>

</head>

<body class="bg-gray-100 font-sans leading-relaxed tracking-wide">

    <!-- Navbar -->

    <!-- Navbar -->
    <nav class="bg-white shadow fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="#" class="text-2xl font-bold text-indigo-600">Helping Hands</a>

                <!-- Hamburger menu (mobile) -->
                <button id="menuToggle" class="block md:hidden focus:outline-none">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <!-- Navigation links -->
                <ul id="mobileMenu" class="hidden fixed top-0 left-0 w-64 h-full bg-white shadow-lg z-20 transform -translate-x-full transition-transform duration-300 md:hidden">
                    <li class="p-4 border-b">
                        <a href="#about" class="block hover:text-indigo-600">About Us </a>
                    </li>
                    <li class="p-4 border-b">
                        <a href="#services" class="block hover:text-indigo-600">Services</a>
                        <ul class="pl-4">
                            <li class="py-2">
                                <a href="files.html" class="block hover:text-indigo-600">Encrypt File</a>
                            </li>
                        </ul>
                    </li>
                    <li class="p-4 border-b">
                        <a href="#team" class="block hover:text-indigo-600">Team</a>
                    </li>
                    <li class="p-4 border-b">
                        <a href="#contact" class="block hover:text-indigo-600">Contact</a>
                    </li>
                    <li class="p-4">
                        <a href="#donate" class="block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Donate
                        </a>
                    </li>
                </ul>

                <!-- Desktop Navigation -->
                <ul class="hidden md:flex space-x-4 items-center">
                    <li>
                        <a href="#about" class="hover:text-indigo-600">About Us</a>
                    </li>
                    <li class="relative group">
                        <a href="#services" class="hover:text-indigo-600">Services</a>
                        <ul class="absolute left-0 pt-2 hidden group-hover:block bg-white shadow-lg rounded-lg w-48">
                            <li class="px-4 py-2 hover:bg-gray-100">
                                <a href="files.html">Encrypt File</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#team" class="hover:text-indigo-600">Team</a>
                    </li>
                    <li>
                        <a href="#contact" class="hover:text-indigo-600">Contact</a>
                    </li>
                    <li>
                        <a href="#donate" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Donate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen" style="background-image: url('https://media.giphy.com/media/3o7abKhOpu0NwenH3O/giphy.gif');">
        <div class="h-full flex items-center justify-center bg-black bg-opacity-50">
            <div class="text-center text-white px-4 fade-in">
                <h1 class="text-4xl md:text-6xl font-bold">Together, We Make a Difference</h1>
                <p class="mt-4 text-lg">Empowering communities through kindness and action.</p>
                <a href="#about" class="mt-6 inline-block bg-indigo-600 text-white py-3 px-6 rounded-full text-lg hover:bg-indigo-700">Learn More</a>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
            <h2 class="text-3xl font-bold text-center text-indigo-600">About Us Comapny</h2>
            <p class="mt-6 text-gray-700 text-center text-lg">Helping Hands is a platform dedicated to supporting the less fortunate, fostering community growth, and enabling education for everyone. Founded by Rishav Kumar, we strive to create a world where no one is left behind.</p>
        </div>
    </section>

    <!-- JavaScript for mobile menu -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>



    <!-- Services Section -->

    <section id="services" class="py-16 bg-gray-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">

            <h2 class="text-3xl font-bold text-center text-indigo-600">What We Do</h2>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="p-6 bg-white shadow-lg rounded-lg">

                    <div class="text-center">

                        <div class="text-indigo-600 text-5xl mb-4">💖</div>

                        <h3 class="text-xl font-bold">Support for Needy</h3>

                        <p class="mt-2 text-gray-600">We provide essential resources, ensuring that no one is left behind.</p>

                    </div>

                </div>

                <div class="p-6 bg-white shadow-lg rounded-lg">

                    <div class="text-center">

                        <div class="text-indigo-600 text-5xl mb-4">📚</div>

                        <h3 class="text-xl font-bold">Education</h3>

                        <p class="mt-2 text-gray-600">Enabling access to education for children and adults alike.</p>

                    </div>

                </div>

                <div class="p-6 bg-white shadow-lg rounded-lg">

                    <div class="text-center">

                        <div class="text-indigo-600 text-5xl mb-4">🌱</div>

                        <h3 class="text-xl font-bold">Community Growth</h3>

                        <p class="mt-2 text-gray-600">Helping communities grow sustainably with our resources.</p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- Team Section -->

    <section id="team" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
            <h2 class="text-3xl font-bold text-center text-indigo-600">Meet Our Team</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <img src="./img/rishav12.png" alt="Rishav Kumar" class="mx-auto rounded-full shadow-lg">
                    <h3 class="mt-4 text-xl font-bold">Rishav Kumar</h3>
                    <p class="text-gray-600">Founder/CEO</p>
                </div>
                <div class="text-center">
                    <img src="../img/hari.jpg" alt="Mohan Kumar" class="mx-auto rounded-full shadow-lg">
                    <h3 class="mt-4 text-xl font-bold">Mohan Kumar</h3>
                    <p class="text-gray-600">Volunteer Manager</p>
                </div>
                <div class="text-center">
                    <img src="../img/rishav12.png" alt="Madhurendra Raj" class="mx-auto rounded-full shadow-lg">
                    <h3 class="mt-4 text-xl font-bold">Madhurendra Raj</h3>
                    <p class="text-gray-600">Fundraiser</p>
                </div>
                <div class="text-center">
                    <img src="../img/hari.jpg" alt="Hari" class="mx-auto rounded-full shadow-lg">
                    <h3 class="mt-4 text-xl font-bold">Hari</h3>
                    <p class="text-gray-600">CEO</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Query Section -->
    <section id="query" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
            <h2 class="text-3xl font-bold text-center text-indigo-600">Have a Query?</h2>
            <p class="mt-4 text-center text-gray-700 text-lg">
                Let us know your questions or concerns, and we will get back to you within 24 hours.
            </p>
            <div class="text-center mt-8">
                <a href="query.php" class="bg-indigo-600 text-white py-3 px-6 rounded-full text-lg hover:bg-indigo-700">
                    Submit Your Query
                </a>
            </div>
        </div>
    </section>





    <!-- Footer -->

    <footer class="bg-gray-800 text-white py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between">

                <div>

                    <h3 class="text-lg font-bold">Helping Hands</h3>

                    <p class="mt-2 text-gray-400">Together, we create impact.</p>

                </div>

                <div>

                    <a href="#about" class="hover:text-indigo-400">About Us</a><br>

                    <a href="#contact" class="hover:text-indigo-400">Contact</a><br>

                    <a href="#donate" class="hover:text-indigo-400">Donate</a>

                </div>

            </div>

            <p class="mt-8 text-center text-gray-500">© 2024 Helping Hands. All Rights Reserved.</p>

        </div>

    </footer>
    <style>
        /* Sidebar styles */
        #mobileMenu {
            background-color: #ffffff;
            overflow-y: auto;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        /* Transition effect */
        #mobileMenu.open {
            transform: translateX(0);
        }
    </style>
    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            if (menu.classList.contains('open')) {
                menu.classList.remove('open');
                menu.classList.add('hidden');
            } else {
                menu.classList.add('open');
                menu.classList.remove('hidden');
            }
        });
    </script>


</body>

</html>