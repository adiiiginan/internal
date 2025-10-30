<!DOCTYPE html>
<html>

<head>
    <title>Daftar Permintaan Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background: #f2f2f2;
        }

        img {
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Daftar Permintaan Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jenis Permintaan</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Annual Ussage</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Customer</th>
                <th>Deadline</th>
                <th>Gambar</th> <!-- ✅ Tambahkan kolom gambar -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $permintaan->nama }}</td>
                <td>{{ $permintaan->divisi }}</td>
                <td>{{ $permintaan->jenis_permintaan }}</td>
                <td>{{ $permintaan->deskripsi }}</td>
                <td>{{ $permintaan->qty }}</td>
                <td>{{ $permintaan->use }}</td>
                <td>{{ \Carbon\Carbon::parse($permintaan->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $permintaan->supplier }}</td>
                <td>{{ $permintaan->customer }}</td>
                <td>{{ $permintaan->etd }}</td>
                <td>
                    @if ($permintaan->gambar)
                        <img src="{{ public_path('backend/assets/media/gambar/' . $permintaan->gambar) }}"
                            width="80">
                    @else
                        -
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
