<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Perdin Submission</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f9fc; padding: 20px; color: #333;">
    <div
        style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">📝 New Perdin Submission</h2>

        <p style="margin-top: 10px; font-size: 1rem;">
            Telah dibuat submission perjalanan dinas baru dengan detail sebagai berikut:
        </p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Nama</td>
                <td style="padding: 8px 0;">{{ $perdin->nama }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Jabatan</td>
                <td style="padding: 8px 0;">{{ $perdin->jabatan }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Tujuan</td>
                <td style="padding: 8px 0;">{{ $perdin->tujuan }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Total</td>
                <td style="padding: 8px 0;">Rp {{ number_format($perdin->total ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Advance</td>
                <td style="padding: 8px 0;">Rp {{ number_format($perdin->advance ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Expense</td>
                <td style="padding: 8px 0;">Rp {{ number_format($perdin->expense ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Status</td>
                <td style="padding: 8px 0;">
                    @php
                        $statusLabels = [
                            1 => 'pending',
                            2 => 'approved',
                            3 => 'rejected',
                        ];
                        $statusLabel = $statusLabels[$perdin->status] ?? $perdin->status;
                    @endphp
                    <strong style="color: #27ae60;">{{ $statusLabel }}</strong>
                </td>
            </tr>
        </table>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #ccc;">

        <p style="font-size: 0.9em; color: #777;">📩 Ini adalah notifikasi otomatis. Mohon untuk tidak membalas email
            ini.</p>
    </div>
</body>


</html>
