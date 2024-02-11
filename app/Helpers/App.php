<?php
namespace App\Helpers;
use Illuminate\Support\Carbon;

class App {
    private static $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    public static function tgl_indo($tanggal){
        $carbonDate = Carbon::parse($tanggal);

        // Format the date to 'Y-m-d' (year-month-day)
        $formattedDate = $carbonDate->format('Y-m-d');

        $bulan = self::$bulan;
        $pecahkan = explode('-', $formattedDate);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
    
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    public static function bulan_tahun(){
        $carbonDate = Carbon::now();

        // Format the date to 'Y-m-d' (year-month-day)
        $formattedDate = $carbonDate->format('Y-m-d');

        $bulan = self::$bulan;
        $pecahkan = explode('-', $formattedDate);
        
    
        return $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    public static function time($time){
        $carbonDate = Carbon::parse($time);

        // Format the date to 'Y-m-d' (year-month-day)
        $formattedDate = $carbonDate->format('H:i');
        return "Pukul " . $formattedDate;
    }
}