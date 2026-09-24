<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Fake the local storage disk
        Storage::fake('local');
    }

    /**
     * Test Eloquent encryption and hash generation.
     */
    public function test_nik_and_alamat_are_encrypted_in_db_but_decrypted_in_model(): void
    {
        $user = User::factory()->create();
        
        $profile = UserProfile::create([
            'user_id' => $user->id,
            'kategori' => 'Usulan Unit',
            'nik' => '3173002810004555',
            'nama' => 'Budi Santoso',
            'no_telp' => '081234567890',
            'tempat_tglLahir' => 'Jakarta, 1990-01-01',
            'alamat' => 'Jalan Merdeka No. 10',
            'rt' => 1,
            'rw' => 2,
            'kelurahan' => 'Gambir',
            'kecamatan' => 'Gambir',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'PNS',
            'kewarganegaraan' => 'WNI',
            'program_beasiswa' => 'magister',
            'status' => 'draft',
        ]);

        // 1. Check database raw values directly (bypassing Eloquent casts)
        $rawProfile = DB::table('user_profiles')->where('id', $profile->id)->first();
        
        $this->assertNotEquals('3173002810004555', $rawProfile->nik);
        $this->assertNotEquals('Jalan Merdeka No. 10', $rawProfile->alamat);
        
        // Ensure NIK Hash exists and matches SHA-256 of the plaintext NIK
        $this->assertEquals(hash('sha256', '3173002810004555'), $rawProfile->nik_hash);

        // 2. Check model access (should decrypt automatically)
        $retrievedProfile = UserProfile::find($profile->id);
        $this->assertEquals('3173002810004555', $retrievedProfile->nik);
        $this->assertEquals('Jalan Merdeka No. 10', $retrievedProfile->alamat);
    }

    /**
     * Test FileController access controls for regular users and admins.
     */
    public function test_file_access_control_policies(): void
    {
        // Create two users
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        // Create an Admin
        $admin = Admin::create([
            'name' => 'Admin Kece',
            'email' => 'admin_kece@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Upload fake file for user A
        $filePath = 'ktp/fake_ktp.jpg';
        Storage::disk('local')->put($filePath, 'fake image content');

        // Create profile for user A referencing this file
        $profileA = UserProfile::create([
            'user_id' => $userA->id,
            'kategori' => 'Usulan Unit',
            'nik' => '3173002810004555',
            'nama' => 'User A',
            'no_telp' => '081234567890',
            'tempat_tglLahir' => 'Jakarta, 1990-01-01',
            'alamat' => 'Jalan Merdeka No. 10',
            'rt' => 1,
            'rw' => 2,
            'kelurahan' => 'Gambir',
            'kecamatan' => 'Gambir',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'PNS',
            'kewarganegaraan' => 'WNI',
            'program_beasiswa' => 'magister',
            'status' => 'draft',
            'foto_ktp' => $filePath,
        ]);

        // 1. Guest access should be forbidden (403)
        $response = $this->get(route('pendaftaran.file', ['type' => 'foto_ktp', 'userId' => $userA->id]));
        $response->assertStatus(403);

        // 2. User A accessing their own file should succeed (200)
        $response = $this->actingAs($userA)->get(route('pendaftaran.file', ['type' => 'foto_ktp']));
        $response->assertStatus(200);

        // 3. User B accessing User A's file should be forbidden (403)
        $response = $this->actingAs($userB)->get(route('pendaftaran.file', ['type' => 'foto_ktp', 'userId' => $userA->id]));
        $response->assertStatus(403);

        // 4. Admin accessing User A's file should succeed (200)
        $response = $this->actingAs($admin, 'admin')->get(route('pendaftaran.file', ['type' => 'foto_ktp', 'userId' => $userA->id]));
        $response->assertStatus(200);
    }
}
