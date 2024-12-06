<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title> {{ $report->report_type }}</title>
</head>

<body>
    <style>
        .container {
            width: fit-content;
        }

        h1,
        h2,
        p,
        th,
        td {
            font-family: sans-serif;
        }

        p {
            font-size: 18px;
        }

        table,
        th,
        td {
            border: 1px solid #d5d1d1;
            border-collapse: collapse;
            padding: 20px;
            text-align: left;
            width: -webkit-fill-available;
        }

        table {
            margin: 40px 0px 40px 0px !important;
            overflow-y: scroll;
        }

        .main {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #d5d1d1;
            margin-bottom: 40px !important;
        }

        .main-section {
            padding: 20px;
        }

        .credit-score-section {
            background: #f1f1ff;
            padding: 20px;
        }

        .credit-score-section td {
            color: #0bb2b2;
            font-weight: bold;
        }

        .credit-account-section {
            margin-top: 40px;
            padding: 20px;
        }

        .credit-items-section {
            background: #f1f1ff;
            padding: 20px;
        }

        table span {
            color: #0bb2b2;
            margin-right: 5px;
            font-weight: bold;
        }

        button.btn.btn-primary {
            height: 40px;
            width: 100px;
            background: none;
            border: 1px solid #d39393;
            color: #d39393;
            font-size: 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        button.btn.btn-primary:hover {
            color: #fff;
            background: #d39393;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

    <div class="container">
        <div class="main-section">
            <div class="main">
                <div class="heading">
                    <div class="main-head">
                        <h1>Stitch Credit: Report Summary - {{ $report->report_type }}</h1>
                    </div>
                </div>
                {{-- <div class="download-btn">
                    <button class="btn btn-primary">Download</button>
                </div> --}}
            </div>
            <p>
                Review this summary for a quick view of key information maintained in
                your Equifax credit report, as well as your resulting Equifax Credit
                Score and rating.
            </p>
            <table>
                <tr>
                    <th>Report Date</th>
                    <th>Record Since</th>
                    <th>Last Activity</th>
                </tr>
                <tr>
                    <td>{{ Carbon\Carbon::parse($report->created_at)->isoFormat('ll') }}</td>
                    <td>{{ isset($report_data['fileSinceDate']) ? $report_data['fileSinceDate'] : '-' }}</td>
                    <td>{{ isset($report_data['lastActivityDate']) ? $report_data['lastActivityDate'] : '-' }}</td>
                </tr>
            </table>
        </div>
        <div class="credit-score-section">
            <h2>Credit Score and Rating</h2>
            <p>
                Your credit score and raing are not part of your credit report, but
                are derived from the information in your file.
            </p>
            <table>
                <tr>
                    <th>Credit score</th>
                    <th>Score rating</th>
                </tr>
                <tr>
                    <td>{{ $score }}</td>
                    <td>{{ $remarks }}</td>
                </tr>
            </table>
        </div>

        <div class="credit-account-section">
            <h2>Credit Accounts</h2>
            <p>
                Your credit report includes information about activity on your credit
                accounts that affects your credit score and rating. The table below is
                an overview of your current account and status.
            </p>
            <table>
                <tr>
                    <th>Account Type</th>
                    <th>Open</th>
                    <th>With Balance</th>
                    {{-- <th>Intel Balance</th> --}}
                    <th>Available</th>
                    <th>Check Limit</th>
                </tr>
                @if (isset($report_data['trades']))
                    @foreach ($report_data['trades'] as $trade)
                        <tr>
                            <td>{{ $trade['portfolioTypeCode']['description'] }}</td>
                            <td>{{ $trade['monthsReviewed'] }}</td>
                            <td>1</td>
                            {{-- <td>$14,187</td> --}}
                            <td>${{ number_format($trade['balance'], 2) ?? '0' }}</td>
                            <td>${{ isset($trade['highCredit']) ? number_format($trade['highCredit'], 2) : '0' }}</td>
                        </tr>
                    @endforeach
                @endif

            </table>
        </div>

        <div class="credit-items-section">
            <h2>Other Credit Items</h2>
            <p>
                Your credit report includes information about instances of non-account
                items that may affect your credit score and rating. The table below is
                a summary of non-account related items on your report.
            </p>
            <table>
                <tr>
                    <th>Consumer Statements</th>
                    <th>Personal Information</th>
                    <th>Inquiries</th>
                    <th>Public Records</th>
                    <th>Collections</th>
                </tr>
                <tr>
                    <td><span>0</span>Statements found</td>
                    <td><span>0</span>items found</td>
                    <td><span>{{ isset($report_data['inquiries']) ? count($report_data['inquiries']) : '0' }}</span>inquiries
                        found</td>
                    <td><span>0</span>Records found</td>
                    <td><span>0</span>Collections found</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>

{{-- {{ $report }} --}}
