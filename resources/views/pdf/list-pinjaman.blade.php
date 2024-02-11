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
                <p style="text-align: center"><b>LAPORAN LIST PINJAMAN</b></p>
                <table border="1" style="border-collapse: collapse; margin-top:20px" cellpadding="2">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 4%">No</th>
                            <th rowspan="2">Kode Pinjaman</th>
                            <th rowspan="2">Durasi Pinjaman</th>
                            <th rowspan="2">Peminjam</th>
                            <th rowspan="2">Status</th>
                            <th colspan="2" style="width:30%;">Barang Pinjaman</th>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <th>Kode Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->kode_pinjam }}</td>
                                <td class="text-center"><div>{{$item->tanggal_pinjam}} - {{$item->tanggal_kembali}}</div></td>
                                <td class="text-center">{{ $item->peminjam->nama_peminjam }}</td>
                                <td class="text-center">{!! $item->status == 0 ? '<div>Sudah Dikembalikan</div>' : '<div>Belum Dikembalikan</div>'; !!}</td>
                                <td class="text-center" style="padding: 0; margin: 0">
                                    @foreach ($item->pinjam_detail as $index => $barang_pinjam)
                                        <span style="{{ $index < count($item->pinjam_detail) - 1 ? 'border-bottom: 1px solid rgb(108, 108, 108);' : '' }} display: flex;">
                                            {{ $barang_pinjam->jumlah }} <br>
                                        </span>
                                    @endforeach
                                </td>
                                <td class="text-center" style="padding: 0; margin: 0">
                                    @foreach ($item->pinjam_detail as $index => $barang_pinjam)
                                        <span style="{{ $index < count($item->pinjam_detail) - 1 ? 'border-bottom: 1px solid rgb(108, 108, 108);' : '' }} display: flex;">
                                            {{ $barang_pinjam->master_barang->nama_barang }} <br>
                                        </span>
                                    @endforeach
                                </td>
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
