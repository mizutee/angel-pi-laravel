<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Performance Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 12px; }
        th, td { border: 1px solid black; padding: 6px; text-align: center; }
        th { background-color: #007bff; color: white; }
        h2 { text-align: center; font-size: 18px; margin-bottom: 10px; }
        .signature { margin-top: 30px; text-align: center; font-size: 12px; }
        .sig-line { margin: 30px 0 10px; display: inline-block; width: 150px; border-top: 1px solid black; }
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
    </style>
</head>
<body>
    <h2>Overall Teacher Performance</h2>

    <table>
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Subject</th>
                <th>Experience Avg</th>
                <th>Expectation Avg</th>
                <th>Final Score</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->subject }}</td>
                <td>{{ $teacher->exp_avg }}</td>
                <td>{{ $teacher->expc_avg }}</td>
                <td>{{ $teacher->final_score }}</td>
                <td style="font-weight: bold;">{{ $teacher->grade }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature Section -->
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
