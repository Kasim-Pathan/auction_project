@extends('user.layouts.master')
@section('title','Product')
@section('main')

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Bid Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .bid-card { max-width: 500px; margin: auto; }
    </style>    
</head>
<body>

    <!--============= Hero Section Starts Here =============-->
    <div class="hero-section style-2">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="3">Home</a>
                </li>
                <li>
                    <a href="#0">Pages</a>
                </li>
                <li>
                    <span>BID</span>
                </li>
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="{{asset('designing/assets/images/banner/hero-bg.png')}}"></div>
    <!--============= Hero Section Ends Here =============-->
    <!-- product Detail -->
     
    <!-- product Detail -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 text-center">
                <!-- Product image and details -->
                <img src="{{asset($product->image)}}" alt="Product" class="img-fluid rounded">
                <h2 class="mt-3">Product Name</h2>
                <p class="lead">Current Highest Bid: <strong id="highestBid">$100</strong></p>
                <p>Time Remaining: <span id="countdown">00:05:00</span></p>
            </div>
            <div class="col-md-6">
                <!-- Bid submission form -->
                <div class="card bid-card p-3">
                    <h4>Place Your Bid</h4>
                    <form id="bidForm">
                        <div class="mb-3">
                            <label for="bidAmount" class="form-label">Your Bid ($)</label>
                            <input type="number" class="form-control" id="bidAmount" min="101" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Bid</button>
                    </form>
                </div>
                <!-- Bid history table -->
                <table class="table mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>User</th>
                            <th>Bid Amount</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody id="bidHistory">
                        <tr>
                            <td>John</td>
                            <td>$100</td>
                            <td>Just Now</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Countdown Timer
        let timeLeft = 300; // 5 minutes in seconds
        function updateTimer() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            // Update countdown display
            document.getElementById("countdown").innerText = ${minutes}:${seconds < 10 ? '0' : ''}${seconds};
            if (timeLeft > 0) timeLeft--; // Decrease time by 1 second
        }
        // Run updateTimer function every second
        setInterval(updateTimer, 1000);

        // Handle Bid Submission
        $("#bidForm").submit(function(e) {
            e.preventDefault(); // Prevent page reload on form submission
            let newBid = parseInt($("#bidAmount").val()); // Get bid amount
            let currentBid = parseInt($("#highestBid").text().replace('$', '')); // Get current highest bid
            
            // Validate bid amount
            if (newBid > currentBid) {
                $("#highestBid").text($${newBid}); // Update highest bid display
                
                // Create a new row for the bid history table
                let newRow = <tr><td>You</td><td>$${newBid}</td><td>Just Now</td></tr>;
                $("#bidHistory").prepend(newRow); // Add new bid to the top of the table
                
                $("#bidAmount").val(''); // Clear input field after submission
            } else {
                alert("Bid must be higher than the current highest bid!"); // Alert user if bid is too low
            }
        });
    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            
            var pusher = new Pusher("{{ env('Pusher_key') }}", {
            cluster: "{{ env('Pusher_cluster') }}",
            encrypted: true
            });
            // let cname = 'var';
            var channel = pusher.subscribe('channel-kasim');
            channel.bind('auctoinEvent', function(data) {
                console.log(data);
            });
    </script>
</body>
</html>
@endsection