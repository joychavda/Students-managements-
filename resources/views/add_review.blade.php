<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quick Review Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .form-main{
    background: #f2f4f7;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-box {
    background: #fff;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 550px;
}

.form-box h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #2c3e50;
    font-size: 24px;
}

label {
    display: block;
    margin-top: 18px;
    font-weight: 600;
    font-size: 16px;
}

input, select, textarea {
    width: 100%;
    padding: 14px;
    margin-top: 8px;
    border-radius: 3px;
    border: 1px solid #ccc;
    font-size: 15px;
    color: #000;
    box-sizing: border-box;
    line-height: 1.4;
    min-height: 48px; /* ensures all input/select same height */
}

textarea {
    resize: vertical;
    min-height: 100px; /* still allows longer typing */
}

.submit-btn {
    margin-top: 25px;
    width: 100%;
    padding: 14px;
    background-color:rgb(22, 113, 169);
    color: white;
    border: none;
    font-size: 16px;
    border-radius:3px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
@include('navbar')
<div class="form-main">

<div class="form-box">
    <h2>Quick Review</h2>

    <form action="{{url('save_review')}}" method="POST">
        @csrf

        <label>User ID</label>
        <input type="email" name="user_id" placeholder="Your Email" required>

        <label>User Name</label>
        <input type="text" name="username" placeholder="Your Name" required>

        <label>Phone No.</label>
        <input type="text" name="phone" placeholder="Your Phone no." required>

        <label>User Type</label>
        <select name="usertype" required>
            <option value="">-- Select --</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>

        <label>Rating</label>
        <select name="rating" required>
            <option value="">-- Rate Us --</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Good</option>
            <option value="3">3 - Average</option>
            <option value="2">2 - Poor</option>
            <option value="1">1 - Bad</option>
        </select>

        <label>Your Review</label>
        <textarea name="review" rows="1" placeholder="Write feedback..." required></textarea>
        <!-- Hidden Date Input -->
        <input type="hidden" name="date_display" value="{{ date('Y-m-d') }}">

        <button type="submit" class="submit-btn">Submit</button>
    </form>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
</div>

</div>
@include('footer')
</body>
</html>
