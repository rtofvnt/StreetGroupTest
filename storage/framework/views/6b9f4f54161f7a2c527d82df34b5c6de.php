<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <!-- component -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />
</head>

<body>

    <div class="h-screen flex items-center justify-center">
        <!-- This is an example component -->
        <div class="max-w-2xl mx-auto">
            <form action="<?php echo e(route('upload_csv')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload file</label>
                <div class="flex items-center">
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" name="csv_file" type="file">
                    <button type="submit" class="ml-4 px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                </div>
                <p class="mt-5">
                    Upload a CSV file with homeowners
                </p>
            </form>
        </div>

    </div>
</body>

</html><?php /**PATH C:\Users\mlego\dev\StreetGroup\resources\views/welcome.blade.php ENDPATH**/ ?>