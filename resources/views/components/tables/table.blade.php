@props([
    'name' => 'Table',
    'count' => ''
])
<section class="container px-4 mx-auto">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">{{ $name }}</h2>

                <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ $count }}</span>
            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in the last 12 months.</p>
        </div>

        <div class="flex items-center mt-4 gap-x-3">
            {{ $secondBtn ?? '' }}

           {{ $addBtn }}
        </div>
    </div>

    <div class="mt-6 md:flex md:items-center md:justify-between">
        {{ $sort ?? '' }}
       {{ $search ?? '' }}
    </div>

    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                {{ $thead }}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            {{ $tbody }}
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
</section>