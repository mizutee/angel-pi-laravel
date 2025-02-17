@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Student Evaluation Results</h1>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600">Total Responses:</span>
                    <span class="text-lg font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">{{ $total_students }}</span>
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
                                    <span class="text-xs text-gray-400">({{ $total_experience_summary['total_counts']['1'] }})</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-orange-500">Bad</span>
                                    <span class="text-xs text-gray-400">({{ $total_experience_summary['total_counts']['2'] }})</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-yellow-500">Normal</span>
                                    <span class="text-xs text-gray-400">({{ $total_experience_summary['total_counts']['3'] }})</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-green-500">Good</span>
                                    <span class="text-xs text-gray-400">({{ $total_experience_summary['total_counts']['4'] }})</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex flex-col items-center">
                                    <span class="text-green-600">Very Good</span>
                                    <span class="text-xs text-gray-400">({{ $total_experience_summary['total_counts']['5'] }})</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Average</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Teaching Methods Section -->
                        @foreach($result as $el)
                            <tr class="bg-gray-50">
                                <td colspan="7" class="px-6 py-3">
                                    <h3 class="font-semibold text-gray-900">{{ $el['type'] }}</h3>
                                </td>
                            </tr>
                            @foreach($el['questions'] as $question)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <p class="text-gray-900">{{ $question['question'] }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['experience']['1']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['experience']['1']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['experience']['2']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['experience']['2']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['experience']['3']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['experience']['3']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['experience']['4']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['experience']['4']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['experience']['5']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['experience']['5']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center">
                                            <span class="text-lg font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">{{ $question['average'] }}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-green-300 hover:bg-green-500">
                                    <td class="px-6 py-4">
                                        <p class="text-gray-900">Expectation</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['expectation']['1']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['expectation']['1']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['expectation']['2']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['expectation']['2']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['expectation']['3']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['expectation']['3']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['expectation']['4']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['expectation']['4']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-semibold text-gray-700">{{ $question['expectation']['5']['count'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $question['expectation']['5']['percentage'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center">
                                            <span class="text-lg font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">{{ $question['average'] }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach

                        <!-- Overall Statistics -->
                        <tr class="bg-gray-100 font-semibold">
                            <td class="px-6 py-4">Overall Average</td>
                            <td colspan="5" class="px-6 py-4 text-center">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <span class="text-lg font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full">{{ number_format((($total_experience_summary['total_counts']['1']) + ($total_experience_summary['total_counts']['2'] * 2) + ($total_experience_summary['total_counts']['3'] * 3) + ($total_experience_summary['total_counts']['4'] * 4) + ($total_experience_summary['total_counts']['5'] * 5)) / ($total_experience_summary['total_counts']['1'] + $total_experience_summary['total_counts']['2'] + $total_experience_summary['total_counts']['3'] + $total_experience_summary['total_counts']['4'] + $total_experience_summary['total_counts']['5']), 2) }}</span>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-gray-100 font-semibold">
                            <td class="px-6 py-4">Overall Expectation</td>
                            <td colspan="5" class="px-6 py-4 text-center">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <span class="text-lg font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full">{{ number_format((($total_expectation_summary['total_counts']['1']) + ($total_expectation_summary['total_counts']['2'] * 2) + ($total_expectation_summary['total_counts']['3'] * 3) + ($total_expectation_summary['total_counts']['4'] * 4) + ($total_expectation_summary['total_counts']['5'] * 5)) / ($total_expectation_summary['total_counts']['1'] + $total_expectation_summary['total_counts']['2'] + $total_expectation_summary['total_counts']['3'] + $total_expectation_summary['total_counts']['4'] + $total_expectation_summary['total_counts']['5']), 2) }}</span>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-gray-100 font-semibold">
                            <td class="px-6 py-4">Difference</td>
                            <td colspan="5" class="px-6 py-4 text-center">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    @php
                                        $experience_total = 
                                            ($question['experience']['1']['count'] * 1) + 
                                            ($question['experience']['2']['count'] * 2) + 
                                            ($question['experience']['3']['count'] * 3) + 
                                            ($question['experience']['4']['count'] * 4) + 
                                            ($question['experience']['5']['count'] * 5);

                                        $expectation_total = 
                                            ($question['expectation']['1']['count'] * 1) + 
                                            ($question['expectation']['2']['count'] * 2) + 
                                            ($question['expectation']['3']['count'] * 3) + 
                                            ($question['expectation']['4']['count'] * 4) + 
                                            ($question['expectation']['5']['count'] * 5);

                                        $total_difference = $experience_total - $expectation_total;
                                        $color = $total_difference > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    @endphp
                                    <span class="text-lg font-bold {{ $color }} px-3 py-1 rounded-full">{{ $total_difference }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Visual Representation -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Summary Card -->
                {{-- <div class="bg-white rounded-lg shadow-md p-6">
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
                </div> --}}

                <!-- Distribution Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Rating Distribution</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Very Good</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: {{ $total_experience_summary['percentages']['5'] }}%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">{{ $total_experience_summary['percentages']['5'] }}%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Good</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-400" style="width: {{ $total_experience_summary['percentages']['4'] }}%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">{{ $total_experience_summary['percentages']['4'] }}%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Normal</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-400" style="width: {{ $total_experience_summary['percentages']['3'] }}%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">{{ $total_experience_summary['percentages']['3'] }}%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Bad</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-orange-400" style="width: {{ $total_experience_summary['percentages']['2'] }}%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">{{ $total_experience_summary['percentages']['2'] }}%</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm w-20">Very Bad</span>
                            <div class="flex-1 h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-red-400" style="width: {{ $total_experience_summary['percentages']['1'] }}%"></div>
                            </div>
                            <span class="text-sm w-16 text-right">{{ $total_experience_summary['percentages']['1'] }}%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Overall Category</h3>
                    <div class="space-y-4 flex flex-col">
                        <div class="flex items-center justify-between">
                            <span class="text-sm w-20">Memuaskan</span>
                            <span class="text-sm w-20">>= 10</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm w-20">Cukup Memuaskan</span>
                            <span class="text-sm w-20">>= -10 && <= 10</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm w-20">Diperlukan Training / Guru Di Review Kembali</span>
                            <span class="text-sm w-20">< -10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const surveyResults = @json($result);

        console.log(surveyResults, '<<< ini'); // Check the output in the browser console
        const a = @json($total_experience_summary);
        console.log(a);
    </script>
@endsection