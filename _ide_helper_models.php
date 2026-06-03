<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $essay_kontribusi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran whereEssayKontribusi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EssayPendaftaran whereUserId($value)
 */
	class EssayPendaftaran extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $unit_kerja
 * @property string|null $jabatan
 * @property string|null $golongan
 * @property string|null $nama_instansi
 * @property string|null $tanggal_mulai_kerja
 * @property string|null $tanggal_pensiun
 * @property string|null $surat_izin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereGolongan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereNamaInstansi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereSuratIzin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereTanggalMulaiKerja($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereTanggalPensiun($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereUnitKerja($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustriPendukung whereUserId($value)
 */
	class IndustriPendukung extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $otp
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OtpCode whereUpdatedAt($value)
 */
	class OtpCode extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $kategori
 * @property string|null $nama_perekomendasi
 * @property string|null $instansi_perekomendasi
 * @property string|null $jabatan_perekomendasi
 * @property string|null $file_rekomendasi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereFileRekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereInstansiPerekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereJabatanPerekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereNamaPerekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekomendasiPendaftaran whereUserId($value)
 */
	class RekomendasiPendaftaran extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $kota
 * @property string|null $nama_universitas
 * @property string|null $program_studi
 * @property string|null $tanggal_mulai_studi
 * @property int|null $durasi_studi
 * @property string|null $loa
 * @property string|null $khs_ipk
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereDurasiStudi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereKhsIpk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereLoa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereNamaUniversitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereProgramStudi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereTanggalMulaiStudi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UniversitasPendaftaran whereUserId($value)
 */
	class UniversitasPendaftaran extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserProfile|null $userProfile
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $kategori
 * @property string|null $foto_ktp
 * @property string|null $nik
 * @property string|null $nama
 * @property string|null $no_telp
 * @property string|null $tempat_tglLahir
 * @property string|null $alamat
 * @property string|null $rt
 * @property string|null $rw
 * @property string|null $kelurahan
 * @property string|null $kecamatan
 * @property string|null $agama
 * @property string|null $status_perkawinan
 * @property string|null $pekerjaan
 * @property string|null $kewarganegaraan
 * @property string|null $program_beasiswa
 * @property string $status
 * @property int|null $last_step
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property \Illuminate\Support\Carbon|null $responded_at
 * @property int $is_pengajuan_ulang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EssayPendaftaran|null $essay
 * @property-read \App\Models\IndustriPendukung|null $industri
 * @property-read \App\Models\RekomendasiPendaftaran|null $rekomendasi
 * @property-read \App\Models\UniversitasPendaftaran|null $universitas
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereAgama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereFotoKtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereIsPengajuanUlang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereKelurahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereKewarganegaraan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereLastStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile wherePekerjaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereProgramBeasiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereRespondedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereRt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereRw($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereStatusPerkawinan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereTempatTglLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUserId($value)
 */
	class UserProfile extends \Eloquent {}
}

