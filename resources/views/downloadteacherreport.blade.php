@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4">Survey Results</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">Type</th>
                            <th class="border px-4 py-2">Question</th>
                            <th class="border px-4 py-2">Total Students</th>
                            <th class="border px-4 py-2 bg-blue-100">EXP 1</th>
                            <th class="border px-4 py-2 bg-blue-100">EXP 2</th>
                            <th class="border px-4 py-2 bg-blue-100">EXP 3</th>
                            <th class="border px-4 py-2 bg-blue-100">EXP 4</th>
                            <th class="border px-4 py-2 bg-blue-100">EXP 5</th>
                            <th class="border px-4 py-2 bg-green-100">EXPC 1</th>
                            <th class="border px-4 py-2 bg-green-100">EXPC 2</th>
                            <th class="border px-4 py-2 bg-green-100">EXPC 3</th>
                            <th class="border px-4 py-2 bg-green-100">EXPC 4</th>
                            <th class="border px-4 py-2 bg-green-100">EXPC 5</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $previousType = null;
                            $totals = ["exp_1" => 0, "exp_2" => 0, "exp_3" => 0, "exp_4" => 0, "exp_5" => 0, "expc_1" => 0, "expc_2" => 0, "expc_3" => 0, "expc_4" => 0, "expc_5" => 0];
                        @endphp
                        @foreach(json_decode($surveyResults, true) as $row)
                        @if($row['type'] !== $previousType)
                        <tr class="bg-gray-300 font-bold">
                            <td class="border px-4 py-2" colspan="13">{{ $row['type'] }}</td>
                        </tr>
                        @php $previousType = $row['type']; @endphp
                        @endif
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2">{{ $row['question'] }}</td>
                            <td class="border px-4 py-2">{{ $row['total_students'] }}</td>
                            @foreach($totals as $key => $value)
                                @php $totals[$key] += $row[$key]; @endphp
                                <td class="border px-4 py-2 {{ strpos($key, 'exp') !== false ? 'bg-blue-100' : 'bg-green-100' }}">{{ $row[$key] }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        <tr class="bg-gray-300 font-bold">
                            <td class="border px-4 py-2" colspan="3">Total</td>
                            @foreach($totals as $key => $value)
                                <td class="border px-4 py-2 {{ strpos($key, 'exp') !== false ? 'bg-blue-100' : 'bg-green-100' }}">{{ $value }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8 flex justify-between">
                <div class="text-center">
                    <p class="font-bold">Inspector</p>
                    <div class="h-16"></div> <!-- Space for signature -->
                    <p class="border-t border-black inline-block px-8">Signature</p>
                </div>
                <div class="text-center">
                    <p class="font-bold">School's Boss</p>
                    <div class="h-16"></div> <!-- Space for signature -->
                    <p class="border-t border-black inline-block px-8">Signature</p>
                </div>
            </div>
        </div>
    </main>
@endsection