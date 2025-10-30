<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan Perdin</title>

    <!-- Bootstrap (for grid only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        .form-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 80px;
            text-align: center;
            background-color: #f0f0f0;
        }

        .logo {
            width: 60px;
            height: 60px;
            background-color: #e74c3c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
            margin: 0 auto;
        }

        .company-name {
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            width: 200px;
        }

        .form-title {
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            width: 200px;
        }

        .form-number {
            width: 160px;
            text-align: center;
        }

        .date-cell {
            text-align: center;
            font-size: 12px;
        }

        .form-body {
            padding: 20px;
            border-left: 2px solid #000;
            border-right: 2px solid #000;
        }

        .form-row {
            display: flex;
            margin-bottom: 8px;
            align-items: center;
        }

        .form-row label {
            width: 180px;
            font-size: 12px;
            display: inline-block;
        }

        .form-row .colon {
            width: 20px;
            text-align: center;
        }

        .value {
            font-size: 12px;
        }

        .expense-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding: 0 20px;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            height: 80px;
            margin: 20px 0 10px 0;
            position: relative;
        }

        .form-footer {
            border: 2px solid #000;
            border-top: none;
            height: 20px;
        }

        .currency {
            font-size: 12px;
            margin-right: 5px;
        }

        @media print {
            body {
                margin: 0;
                background: white;
            }

            .form-container {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <!-- Header -->
        <table class="header-table mb-0">
            <tr>
                <td class="logo-cell">
                    <div class="logo">JNS</div>
                </td>
                <td class="company-name">PT JAYA NIAGA SEMESTA</td>
                <td class="form-title">FORMULIR PENGAJUAN PERDIN</td>
                <td class="form-number">
                    <div style="border-bottom: 1px solid #000; padding: 5px; margin-bottom: 5px;">
                        No. Formulir
                    </div>
                    <div class="date-cell">
                        Tanggal Pengajuan: {{ date('d-M-y') }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Form Body (Bootstrap 2 columns) -->
        <div class="form-body">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left column: trip & applicant info -->
                    <div class="col-md-6">
                        <div class="form-row">
                            <label>Nama</label>
                            <span class="colon">:</span>
                            <div class="value">{{ $perdin->nama }}</div>
                        </div>

                        <div class="form-row">
                            <label>Jabatan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ $perdin->jabatan }}</div>
                        </div>

                        <div class="form-row">
                            <label>Tempat Tujuan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ $perdin->tujuan }}</div>
                        </div>

                        <div class="form-row">
                            <label>Tanggal Keberangkatan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ optional($perdin->tgl_keberangkatan)->format('d-M-Y') ?? '-' }}</div>
                        </div>

                        <div class="form-row">
                            <label>Tanggal Kepulangan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ optional($perdin->tgl_kepulangan)->format('d-M-Y') ?? '-' }}</div>
                        </div>

                        <div class="form-row">
                            <label>Keperluan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ $perdin->keperluan }}</div>
                        </div>

                        <div class="form-row">
                            <label>Jenis Pengajuan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ $perdin->jenis_pengajuan ?? '-' }}</div>
                        </div>

                        <div class="form-row">
                            <label>Rincian Pengajuan</label>
                            <span class="colon">:</span>
                            <div class="value">{{ $perdin->rincian ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Right column: expense details -->
                    <div class="col-md-6">
                        <div class="expense-section">
                            <div class="expense-item">
                                <div>Biaya Transportasi</div>
                                <div class="value">{{ number_format($perdin->transportasi, 2) }}</div>
                            </div>

                            <div class="expense-item">
                                <div>Biaya Bahan Bakar</div>
                                <div class="value">{{ number_format($perdin->bbm, 2) }}</div>
                            </div>

                            <div class="expense-item">
                                <div>Tunjangan Makan</div>
                                <div class="value">{{ number_format($perdin->makan, 2) }}</div>
                            </div>

                            <div class="expense-item">
                                <div>Biaya Lain-lain</div>
                                <div class="value">{{ number_format($perdin->dll, 2) }}</div>
                            </div>

                            <hr>

                            <div class="expense-item">
                                <div>Total</div>
                                <div class="value">{{ number_format($perdin->total, 2) }}</div>
                            </div>

                            <div class="expense-item">
                                <div>Jumlah Advance</div>
                                <div class="value">{{ number_format($perdin->advance, 2) }}</div>
                            </div>

                            <div class="expense-item">
                                <div>Jumlah Expense</div>
                                <div class="value">{{ number_format($perdin->expense, 2) }}</div>
                            </div>

                            <div class="expense-item">
                                <div>Pengembalian / Kekurangan</div>
                                <div class="value">{{ number_format($perdin->advance - $perdin->expense, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.container-fluid -->
        </div> <!-- /.form-body -->

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <div>Dibuat Oleh,</div>
                <div class="signature-line"></div>
                <div>{{ Auth::user()->nama ?? '________________' }}</div>
            </div>

            <div class="signature-box">
                <div>Disetujui Oleh,</div>
                <div class="signature-line"></div>
                <div>________________</div>
            </div>
        </div>

        <div class="form-footer"></div>
    </div>

</body>

</html>
