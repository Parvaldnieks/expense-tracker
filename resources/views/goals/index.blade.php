<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals</title>
</head>
<body>

    <h1>Create New Goal</h1>

    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="notes">Notes:</label>
            <textarea name="notes" id="notes" rows="3"></textarea>
        </div>

        <button type="submit">Create Goal</button>
    </form>

    <hr>

    <h2>Existing Goals</h2>

    @if($goals->count())
    <ul>
        @foreach($goals as $goal)
            <li>
                <strong>{{ $goal->title }}</strong><br>
                <em>{{ $goal->notes }}</em><br>

                <!-- Form to assign existing expense -->
                <form action="{{ route('goals.assignExpense', $goal) }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <label for="expense_id">Add existing expense:</label>
                    <select name="expense_id" required>
                        <option value="">-- Select expense --</option>
                        @foreach($unassignedExpenses as $expense)
                            <option value="{{ $expense->id }}">
                                {{ $expense->spent_at }} — €{{ $expense->amount }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Add</button>
                </form>

                <form action="{{ route('goals.destroy', $goal) }}" method="POST" style="margin-top: 5px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

                <!-- Show related expenses -->
                @if($goal->expenses->count())
                    <div style="margin-top: 10px;">
                        <strong>Expenses:</strong>
                        <ul>
                            @foreach($goal->expenses as $expense)
                                <li>
                                    {{ $expense->spent_at }} — €{{ $expense->amount }}<br>
                                    <small>{{ $expense->notes }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </li>
            <hr>
        @endforeach
    </ul>
@else
    <p>No goals yet.</p>
@endif

</body>
</html>
