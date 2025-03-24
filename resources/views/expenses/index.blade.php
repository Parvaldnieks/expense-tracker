<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses</title>
</head>
<body>
    <h1>Expenses</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Date</th>
                <th>Category</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->category->name }}</td>
                    <td>{{ $expense->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
