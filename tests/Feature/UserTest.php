<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{

    // test if the sign in page is working correctly
    public function test_user_can_sign_in(){
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->get('/', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        Auth::login($user);
        $response->assertStatus(200);
        $response->assertSee('Laravel From Scratch');
        $this->assertAuthenticatedAs($user);
    }

    // test when wrong credintials are passed if the server returns the correct page
    public function test_user_can_sign_in_with_wrong_credintials(){
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->get('/', [
            'email' => $user->email,
            'password' => 'wrongPassword'
        ]);

        $response->assertStatus(200);
        $response->assertSee('Laravel From Scratch');
        $this->assertGuest();
    }

    // test if the sign up with the valid inputs is working
    public function test_sign_up_with_valid_credintials(){
        $userdata = [
            'name' => 'muneeb',
            'username' => 'mun',
            'email' => 'mune@example.com',
            'password' => 'password123',
        ];
        

        $response = $this->post(route('register'), $userdata);
        $userExists = DB::table('users')->where('email', 'mune@example.com')->exists();
        // dd($userExists);
        $this->assertFalse($userExists);
        $response->assertRedirect('/');
    }

    // test if the correct response is displayed when invalid input is passed
    // public function test_sign_up_with_invalid_credintials(){

    // }

    public function test_interacting_with_headers(): void
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->get('/', ['name' => 'Sally']);
        $response->assertStatus(self::Success);
    }

    public function test_console_command(): void
    {

        $this->artisan('inspire')
        ->doesntExpectOutput(1)
        ->assertExitCode(0);
    }


    public function test_update(){
        $user = User::factory()->create([
            'name' => 'not',
            'email' => 'not@gmail.com',
            'age' => 12,
            'about' => 'what ever bro'
        ]);
        $data = [
            'name' => 'not',
            'email' => 'not@gmail.com',
            'age' => 12,
            'about' => 'what ever bro'
        ];
        $response = $this->post('profiles' . $user->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $data);
        $response->assertJson($data);
    }
}
