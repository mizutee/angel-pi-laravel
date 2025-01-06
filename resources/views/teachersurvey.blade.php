@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Student Evaluation Results</h1>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600">Total Responses:</span>
                    <span class="text-lg font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">32</span>
                </div>
            </div>

            <!-- Results Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-1/3">Question</th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-red-500">Very Bad</span>
                                    <span class="text-xs text-gray-400">(1)</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-orange-500">Bad</span>
                                    <span class="text-xs text-gray-400">(2)</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-yellow-500">Normal</span>
                                    <span class="text-xs text-gray-400">(3)</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-green-500">Good</span>
                                    <span class="text-xs text-gray-400">(4)</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-green-600">Very Good</span>
                                    <span class="text-xs text-gray-400">(5)</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Average</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Teaching Methods Section -->
                        <tr class="bg-gray-50">
                            <td colspan="7" class="px-6 py-3">
                                <h3 class="font-semibold text-gray-900">Teaching Methods</h3>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <p class="text-gray-900">How well does the teacher explain complex concepts?</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">2</span>
                                    <span class="text-sm text-gray-500">6.25%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">3</span>
                                    <span class="text-sm text-gray-500">9.38%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">5</span>
                                    <span class="text-sm text-gray-500">15.63%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">12</span>
                                    <span class="text-sm text-gray-500">37.5%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">10</span>
                                    <span class="text-sm text-gray-500">31.25%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <span class="text-lg font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">4.2</span>
                                </div>
                            </td>
                        </tr>

                        <!-- Communication Section -->
                        <tr class="bg-gray-50">
                            <td colspan="7" class="px-6 py-3">
                                <h3 class="font-semibold text-gray-900">Communication & Interaction</h3>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <p class="text-gray-900">How well does the teacher respond to students' questions?</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">1</span>
                                    <span class="text-sm text-gray-500">3.13%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">2</span>
                                    <span class="text-sm text-gray-500">6.25%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">6</span>
                                    <span class="text-sm text-gray-500">18.75%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">13</span>
                                    <span class="text-sm text-gray-500">40.63%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-semibold text-gray-700">10</span>
                                    <span class="text-sm text-gray-500">31.25%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <span class="text-lg font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">4.3</span>
                                </div>
                            </td>
                        </tr>

                        <!-- Overall Statistics -->
                        <tr class="bg-gray-100 font-semibold">
                            <td class="px-6 py-4">Overall Average</td>
                            <td colspan="5" class="px-6 py-4 text-center">
                                Total Responses: 32 students
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <span class="text-lg font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full">4.25</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Visual Representation -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Summary Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Quick Summary</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Highest Rated Question</span>
                            <span class="font-semibold">4.3/5.0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Lowest Rated Question</span>
                            <span class="font-semibold">4.2/5.0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Most Common Rating</span>
                            <span class="font-semibold">Good (4)</span>
                        </div>
                        <div class="h-px bg-gray-200 my-2"></div>
                        <div class="flex justify-between items-center text-lg">
                            <span class="text-gray-600">Overall Performance</span>
                            <span class="font-bold text-green-600">Very Good</span>
                        </div>
                    </div>
                </div>

                <!-- Distribution Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Rating Distribution</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Very Good</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: 31.25%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">31.25%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Good</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-400" style="width: 39.06%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">39.06%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Normal</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-400" style="width: 17.19%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">17.19%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Bad</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-orange-400" style="width: 7.81%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">7.81%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Very Bad</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-red-400" style="width: 4.69%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">4.69%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection