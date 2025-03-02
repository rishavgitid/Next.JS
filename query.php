<?php

require_once 'QueryHandler.php';

$handler = new QueryHandler();

$totalQueryCount = $handler->getTotalQueryCount();

$statusMessage = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars($_POST['name']);

    $email = htmlspecialchars($_POST['email']);

    $phone = htmlspecialchars($_POST['phone']);

    $message = htmlspecialchars($_POST['message']);



    if ($handler->saveQuery($name, $email, $phone, $message)) {

        $statusMessage = "<p class='text-green-700 text-center'>Thank you, $name! Your query has been saved we will back in 24 Hour.</p>";

        $totalQueryCount = $handler->getTotalQueryCount(); // Update count

    } else {

        $statusMessage = "<p class='text-red-700 text-center'>Sorry, something went wrong. Please try again.</p>";

    }

}

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Query Page</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>



<body class="bg-gray-100 font-sans">



    <div class="min-h-screen flex flex-col items-center justify-center relative">



        <!-- Back Arrow at Top Left -->

        <button onclick="window.history.back()" class="absolute top-4 left-4 bg-white">

            &#8592; <!-- Left Arrow Symbol -->

        </button>



        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">

            <div class="mb-6 text-center">

                <h1 class="text-2xl font-bold text-indigo-600">Welcome to the Query Page</h1>

            </div>



            <?php if ($statusMessage): ?>

                <div class="mb-6 text-center"><?= $statusMessage ?></div>

            <?php endif; ?>



            <form id="queryForm" action="" method="POST" class="space-y-4">

                <div>

                    <label for="name" class="block text-gray-700 font-semibold">Your Name</label>

                    <input type="text" id="name" name="name" required

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">

                </div>

                <div>

                    <label for="email" class="block text-gray-700 font-semibold">Your Email</label>

                    <input type="email" id="email" name="email" required

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">

                </div>

                <div>

                    <label for="phone" class="block text-gray-700 font-semibold">Phone Number</label>

                    <input type="tel" id="phone" name="phone" required

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">

                </div>

                <div>

                    <label for="message" class="block text-gray-700 font-semibold">Your Message</label>

                    <textarea id="message" name="message" rows="4" required

                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>

                </div>

                <div class="text-center">

                    <button type="submit"

                        class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700">

                        Submit Query

                    </button>

                </div>

            </form>

        </div>



        <!-- Total Queries Raised -->

        <p class="fixed bottom-4 right-4 bg-indigo-600 text-white px-6 py-3 rounded-full shadow-lg text-sm sm:text-base">

            Total Queries Raised: 

            <span class="font-bold"><?= $totalQueryCount ?></span>

        </p>

    </div>



    <script>

        <?php if (isset($resetForm) && $resetForm === "true"): ?>

            // Clear the form fields

            document.getElementById("queryForm").reset();

        <?php endif; ?>

    </script>

</body>



</html>

