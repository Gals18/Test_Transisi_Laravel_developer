<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; line-height: 1.2; }
        .header { text-align: center; margin-bottom: 30px; }

        /* Layout Tabel Utama */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Mengunci lebar kolom */
        }

        th {
            background-color: #4a5568;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        td {
            padding: 8px;
            border: 1px solid #e2e8f0;
            font-size: 11px;
            word-wrap: break-word; /* Mencegah teks meluap */
        }

        tr:nth-child(even) { background-color: #f8fafc; }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ $data['title'] }}</h2>
        <p>Laporan per tanggal: {{ $data['date'] }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Lengkap</th>
                <th width="25%">Nama Perusahan</th>
                <th width="20%">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['employees'] as $index => $emp)
            <tr>

                {{-- 'name',
                'company_id',
                'email' --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $emp->name }}</td>

                <td>{{ $emp->company->name }}</td>
                <td>{{ $emp->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
