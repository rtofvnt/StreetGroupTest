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

    <div class="flex items-center justify-center">
        <!-- This is an example component -->
        <div class="max-w-2xl mx-auto">
            <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>


            <form action="<?php echo e(route('uploadAndProcess')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload a CSV file with homeowners</label>
                <div class="flex items-center">
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" name="csv_file" type="file">
                    <button type="submit" class="ml-4 px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                </div>
                
            </form>


            <?php if(!empty($processedData)): ?>
            <div class="max-w-4xl mx-auto mt-6">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    First Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Initial
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last Name
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__currentLoopData = $processedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo e($loop->iteration); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo $person['title'] ?? '<span class="text-gray-200">N/A</span>'; ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo $person['first_name'] ?? '<span class="text-gray-200">N/A</span>'; ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo $person['initial'] ?? '<span class="text-gray-200">N/A</span>'; ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo $person['last_name'] ?? '<span class="text-gray-200">N/A</span>'; ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>


        </div>

    </div>
</body>

</html><?php /**PATH C:\Users\mlego\dev\StreetGroup\resources\views/uploadAndProcessCSV.blade.php ENDPATH**/ ?>