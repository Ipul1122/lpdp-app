<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Pendaftaran TUBEL</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 540px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(99, 102, 241, 0.05); border: 1px solid #e2e8f0;">
                    <!-- HEADER -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); padding: 35px 30px;">
                            <h2 style="margin: 0; font-size: 24px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">Verifikasi Akun</h2>
                        </td>
                    </tr>
                    <!-- CONTENT -->
                    <tr>
                        <td style="padding: 40px 30px; color: #334155; line-height: 1.6;">
                            <div style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 16px;">
                                Halo, {{ $name }} Calon Penerima Beasiswa TUBEL!
                            </div>
                            
                            <p style="font-size: 15px; color: #475569; margin: 0 0 24px 0;">
                                Terima Kasih telah mendaftar. Untuk melanjutkan proses registrasi, silahkan masukkan kode otp berikut ini.
                            </p>
                            
                            <!-- OTP CODE BOX -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; border: 2px dashed #cbd5e1; border-radius: 12px; margin: 24px 0;">
                                <tr>
                                    <td align="center" style="padding: 20px;">
                                        <div style="font-size: 36px; font-weight: 800; color: #4f46e5; letter-spacing: 8px; margin: 0; line-height: 1;">
                                            {{ $otpCode }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- EXPIRY ALERT -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px; margin-bottom: 8px;">
                                <tr>
                                    <td style="padding: 12px 16px; font-size: 13px; color: #ef4444; font-weight: 500; text-align: center;">
                                        Kode ini hanya berlaku selama 10 menit. Jangan berikan kode ini kepada siapa pun.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- FOOTER -->
                    <tr>
                        <td align="center" style="border-top: 1px solid #f1f5f9; padding: 24px 30px; background-color: #fafafa;">
                            <div style="font-weight: 700; color: #e11d48; font-size: 15px; margin: 0;">
                                Tetap Semangat Dan Jangan Menyerah ❤️.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>