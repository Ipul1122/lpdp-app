<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #334155; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px;">
        <h2 style="color: #1e293b;">Permintaan Reset Password</h2>
        <p>Kami menerima permintaan untuk mereset password akun Anda. Klik tombol di bawah ini untuk membuat password baru:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" 
               style="background-color: #f97316; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold;">
                Reset Password Saya
            </a>
        </div>

        <p>Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.</p>
    </div>
</body>
</html>