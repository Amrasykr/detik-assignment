<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Books Report</h2>
        <p>{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Author</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formattedBooks as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->user->name }}</td>
                    <td>{{$book->created_at_formatted }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
