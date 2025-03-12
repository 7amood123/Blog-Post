<x-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            align-items: center;
            margin: 20px 0 10px;
        }
        .profile-header h1 {
            margin: 20px 0 10px;
            font-size: 24px;
        }
        .profile-header p {
            color: #666;
            font-size: 16px;
        }
        .profile-details {
            margin-top: 20px;
        }
        .profile-details h2 {
            font-size: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .profile-details label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .profile-details input[type="text"], .profile-details input[type="email"], .profile-details input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .profile-details button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .profile-details button:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="container">
        <a href="/"
            class="mx-auto max-w-6xl lg:mt-8 transition-colors duration-300 relative inline-flex items-left text-lg hover:text-blue-500">
            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                    </path>
                    <path class="fill-current"
                            d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                    </path>
                </g>
            </svg>
            Home
        </a>
        <div class="profile-header">
            @auth
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}"
                     alt=""
                     width="40"
                     height="40"
                     class="rounded-full">
                <h1>{{ auth()->user()->name }}</h1>
                <p>{{ auth()->user()->email }}</p>
            @endauth
        </div>
        <div class="profile-details">
            @auth
                <h2>Welcome {{ auth()->user()->name }} to your Profile</h2>
                    <form  method="POST" action="profiles" enctype="multipart/form-data">
                        @csrf
                        <h2><x-form.input name='name' type='text' value='{{ auth()->user()->name }}' required/></h2>
                        <h2><x-form.input name='email' type='text' value='{{ auth()->user()->email }}' required/></h2>
                        <h2><x-form.input name="age" type="integer" value='{{ auth()->user()->age }}' /></h2>
                        <h2><x-form.input name="about" type="text" value='{{ auth()->user()->about }}' /></h2>
                        <x-form.button >Update profile </x-form.button>
                    </form>
                    @if(! auth()->user()->hasVerifiedEmail())
                        <a href='/verify'><x-form.button >Verify Your Account </x-form.button></a>
                    @endif
            @else
                <h2>
                    Please <a href="/login" class="hover:underline">Log in</a> or
                    <a href="/register" class="hover:underline">Register</a> to view your profile!
                </h2>
            @endauth
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-layout>
