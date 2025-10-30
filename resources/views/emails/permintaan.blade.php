<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Notifikasi Permintaan Barang Baru</title>
</head>

<body
    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; padding: 20px; color: #333;">
    <div
        style="max-width: 650px; margin: auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">📦 Notifikasi Permintaan
            Barang Baru</h2>

        <p style="font-size: 1rem; margin-top: 20px;">
            Telah diajukan permintaan barang baru dengan detail sebagai berikut:
        </p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tbody>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold; width: 35%;">Nama Pengaju</td>
                    <td style="padding: 8px 0;">{{ $permintaan->nama }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Divisi</td>
                    <td style="padding: 8px 0;">{{ $permintaan->divisi }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Jenis Barang</td>
                    <td style="padding: 8px 0;">{{ $permintaan->jenis_permintaan }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Jumlah</td>
                    <td style="padding: 8px 0;">{{ $permintaan->qty }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Annual Ussage</td>
                    <td style="padding: 8px 0;">{{ $permintaan->use }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Supplier</td>
                    <td style="padding: 8px 0;">{{ $permintaan->supplier }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Customer</td>
                    <td style="padding: 8px 0;">{{ $permintaan->customer }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Deadline</td>
                    <td style="padding: 8px 0;">{{ $permintaan->etd }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Deskripsi</td>
                    <td style="padding: 8px 0;">{{ $permintaan->deskripsi }}</td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top: 30px; font-style: italic; color: #555;">
            📎 PDF terlampir untuk informasi lebih lanjut.
        </p>

        <hr style="margin-top: 30px; border: none; border-top: 1px solid #ddd;">

        <p style="font-size: 0.9em; color: #888;">
            Ini adalah notifikasi otomatis. Jangan membalas email ini.
        </p>
    </div>
</body>

</html>
