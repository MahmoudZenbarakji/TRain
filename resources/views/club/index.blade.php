<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Web App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        section {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            margin: 0;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #eee;
            margin: 5px 0;
            padding: 10px;
            border-radius: 3px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        input, select, button {
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Our Club</h1>
    </header>

    <div class="container">
        <!-- Club Information Section -->
        <section>
            <h2>Club Information</h2>
            <p>Welcome to our club! We offer various services and special deals for our members.</p>

            <h3>Special Offers</h3>
            <ul>
                @forelse ($offers as $offer)
                    <li>{{ $offer->name }} - {{ $offer->discount_percentage }}% off</li>
                @empty
                    <li>No offers available at the moment.</li>
                @endforelse
            </ul>
        </section>

        <!-- Subscription Form Section -->
        <section>
            <h2>Subscribe to Our Club</h2>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <form action="{{ route('club.subscribe') }}" method="POST">
                @csrf
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" required>
                <label for="sport_id">Sport:</label>
               

                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>

                <label for="offer_id">Offer (optional):</label>
                <select id="offer_id" name="offer_id">
                    <option value="">Select an offer</option>
                    @foreach($offers as $offer)
                        <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                    @endforeach
                </select>

                <button type="submit">Apply Subscription</button>
            </form>
        </section>
    </div>
</body>
</html>
