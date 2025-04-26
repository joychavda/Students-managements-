<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout(); // Logout the user

        return redirect('/login')->with('success', 'Logged out successfully.');
    }

    public function loginProcess(Request $request)
    {
    $email = $request->input('email');
    $password = $request->input('password');

    // ✅ Admin login check
    $admin = DB::table('admin')
        ->where('email', $email)
        ->where('password', $password)
        ->first();

    if ($admin) {
        return redirect()->route('admin_dash')->with('success', 'Welcome To Admin!');
    }

     $credentials = $request->only('email', 'password');

     // Retrieve the user from the database using the email
     $user = DB::table('login')->where('email', $credentials['email'])->first();
 
     // Check if the user exists and compare the plain text password
     if ($user && $user->password === $credentials['password']) {
         // User is authenticated, log them in
         Auth::loginUsingId($user->id);
 
         // Redirect based on user type
         if ($user->user_type === 'student') {
             $student = DB::table('student_details')->where('email', $user->email)->first();
             if ($student) {
                 return redirect()->route('xyz', ['id' => $student->id])->with('success', 'Login successful!');
             } else {
                 return redirect()->route('add.student')->with('success', 'Login successful! Please fill in the Student information.');
             }
         }
 
         if ($user->user_type === 'teacher') {
             $teacher = DB::table('teacher_details')->where('email', $user->email)->first();
             if ($teacher) {
                 return redirect()->route('listteacher', ['id' => $teacher->id])->with('success', 'Login successful!');
             } else {
                 return redirect()->route('add_teacher')->with('success', 'Login successful! Please fill in the Teacher information.');
             }
         }
     } else {
         return back()->withErrors(['error' => 'Invalid email or password']);
     }
 }
}
