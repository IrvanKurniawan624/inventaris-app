<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <title>Export List Barang</title>
    <style>
        body{
            font-family: sans-serif;
        }
        table{
            width: 100%;
        }
        table th{
            font-size: 11px;
            background: #e9e7e7;
        }
        table td{
            font-size: 9px;
        }
        p{
            font-size: .7rem;
            font-weight: 400;
            margin: 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        .italic {
            font-style: italic;
        }

        .inline-block-content > *{
            display: inline-block;
        }

        .title > *{
            text-align: center;
        }

        .body{
            margin-top: 20px;
        }

        .text-center{
            text-align: center;
        }

        .page-number:before {
            content: counter(page);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div style="width: 100%">
            <div class="header">
                <div style="float: left;">
                    <img src="{{ asset('assets/img/logo.png') }}" width="200px" alt="">
                </div>
                <div style="float: right">
                    <p>Tanggal : {{ \Carbon\Carbon::now()->format('d-m-Y') . ' | Pukul :  ' . \Carbon\Carbon::now()->format('H.i') }}</p>
                    <p style="text-align: right;"> Hal : <span class="page-number"></span></p>
                    <p style="text-align: right;"> Petugas : {{ auth()->user()->nama }}</p>
                </div>
                <hr style="margin-top: 48px">
            </div>

            <div class="body">
                <p style="text-align: center"><b>LIST BARANG INVENTARIS</b></p>
                <table border="1" style="border-collapse: collapse; margin-top:20px" cellpadding="2">
                    <thead>
                        <tr>
                            <th style="width: 4%">No</th>
                            <th style="width: 32px">Gambar</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Kategori</th>
                            <th>Spesifikasi</th>
                            <th>Ruang</th>
                            <th style="width: 7%;">Jumlah</th>
                            <th style="width:20%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <img style="object-fit: cover; width: 30px; padding: 3px; margin: 0; vertical-align: middle;" src="{{ $item->image ? asset('berkas/master-barang/' . $item->image) : asset('assets/img/no-photo.png') }}">
                                </td>
                                <td>{{ $item->nama_barang }}</td>
                                <td class="text-center">{{ $item->kode_barang }}</td>
                                <td class="text-center">{{ $item->kategori->nama_kategori }}</td>
                                <td class="text-center">{{ $item->spesifikasi }}</td>
                                <td class="text-center">{{ $item->ruang->nama_ruang }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td style="padding: 3px">{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <p style="margin-top: 5px">Showing # {{ count($barang) }} item.</p>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "page {PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>
