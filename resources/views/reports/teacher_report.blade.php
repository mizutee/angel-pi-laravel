<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Format Hasil Penilaian Kinerja Guru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            font-size: 10px;
            border-collapse: collapse;
        }
        th, td {
            padding: 4px;
            text-align: center;
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .teacher-info {
            margin-bottom: 15px;
            font-size: 14px;
        }
        .table-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table-header th, .table-header td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
        .signature-container {
            position: relative;
            width: 100%;
            margin-top: 30px;
            font-size: 14px;
        }
        .signature-box {
            position: absolute;
            text-align: center;
            width: 200px;
        }
        .signature-box.left { left: 0; }
        .signature-box.right { right: 0; }
        .signature-box p { margin-bottom: 80px; }
        .signature-line {
            border-top: 2px solid black;
            width: 150px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .type-row {
            background-color: #ddd;
            font-weight: bold;
            text-align: left;
            padding-left: 10px;
        }
        .total-row { font-weight: bold; background-color: #e0e0e0; }
        .grading-row { font-weight: bold; background-color: #c0e0c0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Format Hasil Penilaian Kinerja Guru</h2>
    </div>
    
    <table class="table-header">
        <tr>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
        </tr>
        <tr>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->subject->name }}</td>
        </tr>
    </table>
    
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Question</th>
                <th>Total Students</th>
                <th>EXP 1</th>
                <th>EXP 2</th>
                <th>EXP 3</th>
                <th>EXP 4</th>
                <th>EXP 5</th>
                <th>EXPC 1</th>
                <th>EXPC 2</th>
                <th>EXPC 3</th>
                <th>EXPC 4</th>
                <th>EXPC 5</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $previousType = null;
                $totalExp = [0, 0, 0, 0, 0];
                $totalExpc = [0, 0, 0, 0, 0];
            @endphp
            @foreach ($surveyResults as $row)
                @if ($row->type !== $previousType)
                    <tr>
                        <td colspan="13" class="type-row">{{ $row->type }}</td>
                    </tr>
                    @php $previousType = $row->type; @endphp
                @endif
                <tr>
                    <td></td>
                    <td>{{ $row->question }}</td>
                    <td>{{ $row->total_students }}</td>
                    <td>{{ $row->exp_1 }}</td>
                    <td>{{ $row->exp_2 }}</td>
                    <td>{{ $row->exp_3 }}</td>
                    <td>{{ $row->exp_4 }}</td>
                    <td>{{ $row->exp_5 }}</td>
                    <td>{{ $row->expc_1 }}</td>
                    <td>{{ $row->expc_2 }}</td>
                    <td>{{ $row->expc_3 }}</td>
                    <td>{{ $row->expc_4 }}</td>
                    <td>{{ $row->expc_5 }}</td>
                </tr>
                @php
                    // Sum up all experience and expectation values
                    $totalExp[0] += $row->exp_1;
                    $totalExp[1] += $row->exp_2;
                    $totalExp[2] += $row->exp_3;
                    $totalExp[3] += $row->exp_4;
                    $totalExp[4] += $row->exp_5;

                    $totalExpc[0] += $row->expc_1;
                    $totalExpc[1] += $row->expc_2;
                    $totalExpc[2] += $row->expc_3;
                    $totalExpc[3] += $row->expc_4;
                    $totalExpc[4] += $row->expc_5;
                @endphp
            @endforeach

            <!-- Total Sum Row -->
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td>{{ $totalExp[0] }}</td>
                <td>{{ $totalExp[1] }}</td>
                <td>{{ $totalExp[2] }}</td>
                <td>{{ $totalExp[3] }}</td>
                <td>{{ $totalExp[4] }}</td>
                <td>{{ $totalExpc[0] }}</td>
                <td>{{ $totalExpc[1] }}</td>
                <td>{{ $totalExpc[2] }}</td>
                <td>{{ $totalExpc[3] }}</td>
                <td>{{ $totalExpc[4] }}</td>
            </tr>

            <!-- Grading Row -->
            @php
                $totalQuestions = count($surveyResults);
                
                $expSum = 1*$totalExp[0] + 2*$totalExp[1] + 3*$totalExp[2] + 4*$totalExp[3] + 5*$totalExp[4];
                $expcSum = 1*$totalExpc[0] + 2*$totalExpc[1] + 3*$totalExpc[2] + 4*$totalExpc[3] + 5*$totalExpc[4];
                
                $totalStudents = array_sum(array_column($surveyResults->toArray(), 'total_students'));
                
                $expAvg = ($totalStudents > 0) ? $expSum / $totalStudents : 0;
                $expcAvg = ($totalStudents > 0) ? $expcSum / $totalStudents : 0;
                
                $overallScore = ($expAvg - $expcAvg) * 100;
                
                if ($overallScore >= 10) {
                    $grade = "Memuaskan";
                } elseif ($overallScore >= -10 && $overallScore <= 10) {
                    $grade = "Cukup Memuaskan";
                } else {
                    $grade = "Diperlukan Training / Guru Di Review Kembali";
                }
            @endphp

            <!-- Display the Overall Results -->
            <tr class="total-row">
                <td colspan="3">Experience Average</td>
                <td colspan="10">{{ number_format($expAvg, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Expectation Average</td>
                <td colspan="10">{{ number_format($expcAvg, 2) }}</td>
            </tr>
            <tr class="grading-row">
                <td colspan="3">Overall Score</td>
                <td colspan="10">{{ number_format($overallScore, 2) }}</td>
            </tr>
            <tr class="grading-row">
                <td colspan="3">Grade</td>
                <td colspan="10">{{ $grade }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature-box left">
            <p><strong>Inspector</strong></p>
            <div class="signature-line"></div>
        </div>
        <div class="signature-box right">
            <p><strong>School's Boss</strong></p>
            <div class="signature-line"></div>
        </div>
    </div>
</body>
</html>
