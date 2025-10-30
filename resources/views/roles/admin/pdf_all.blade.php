<!DOCTYPE html>
<html>

<head>
    <title>Semua Permintaan Barang</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Semua Permintaan Barang</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jenis Permintaan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Supplier</th>
                <th>Customer</th>
                <th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permintaan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->divisi }}</td>
                    <td>{{ $item->jenis_permintaan }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>{{ $item->customer }}</td>
                    <td>{{ $item->etd }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
