<!DOCTYPE html>
<html>
<head>
    <style>
        .button {
            background-color: #f97316;
            border: none;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body style="font-family: sans-serif; color: #334155; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px;">
        <h2 style="color: #1e293b;">Halo Admin TUPEL,</h2>
        
        <p>Terdapat aktivitas pendaftaran baru pada sistem:</p>
        
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 120px; font-weight: bold;">Nama:</td>
                <td>{{ $pendaftar->nama }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Program:</td>
                <td style="text-transform: capitalize;">Beasiswa {{ $pendaftar->program_beasiswa }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tipe:</td>
                <td>
                    <span style="color: {{ $tipe == 'baru' ? '#16a34a' : '#ca8a04' }}; font-weight: bold;">
                        {{ $tipe == 'baru' ? 'Pendaftaran Pertama' : 'Pengajuan Ulang' }}
                    </span>
                </td>
            </tr>
        </table>

        <p>Silakan klik tombol di bawah ini untuk memeriksa berkas pendaftar secara langsung:</p>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/admin/pendaftar?filter=' . $tipe) }}" class="button" style="color: white;">
                Lihat Berkas Pendaftar
            </a>
        </div>

        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 30px 0;">
        <p style="font-size: 12px; color: #94a3b8; text-align: center;">
            Email ini dikirim otomatis oleh Sistem Pendaftaran TUPEL App.
        </p>
    </div>
</body>
</html>