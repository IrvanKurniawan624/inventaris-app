<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Transaksi;
use App\Helpers\ApiFormatter;
use App\Models\Pinjam;
use App\Models\PinjamDetail;

class DashboardController extends Controller
{
    public function index(){
        $currentMonth = date('m');
        $data['total_masih_dipinjam'] = $this->getTotalJumlahByStatus(0, $currentMonth);
        $data['total_sudah_dikembalikan'] = $this->getTotalJumlahByStatus(1, $currentMonth);
        $data['total_pinjaman'] = Pinjam::with('pinjam_detail')->whereMonth('created_at', $currentMonth)->get()->sum(function ($pinjam) {
            return $pinjam->pinjam_detail->sum('jumlah');
        });
        $data['total_pembelian_barang'] = Transaksi::where('type', 1)->sum('harga');
        return view('dashboard.index', $data);
    }

    private function getTotalJumlahByStatus($status, $currentMonth)
    {
        return Pinjam::where('status', $status)
            ->with('pinjam_detail')
            ->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum(function ($pinjam) {
                return $pinjam->pinjam_detail->sum('jumlah');
            });
    }


    public function get_data(){
        $endDate = Carbon::now(); // Current date and time
        $startDate = $endDate->copy()->subDays(4); // Five days ago
        $raw['raw_transaksi_5_hari'] = Transaksi::selectRaw('DATE(created_at) as transaction_date, 
            COALESCE(SUM(CASE WHEN type=1 THEN jumlah ELSE 0 END), 0) as barang_masuk, 
            COALESCE(SUM(CASE WHEN type=2 THEN jumlah ELSE 0 END), 0) as barang_keluar')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('transaction_date')
            ->orderBy('transaction_date', 'asc')
            ->get();

        $start_date = Carbon::parse($startDate);
        $end_date = Carbon::parse($endDate);
        $period = CarbonPeriod::create($start_date, $end_date);
        $dates = $period->toArray();
        $array = [];
        foreach ($dates as $date) {
            $date = $date->toDateString();

            if(!empty($raw['raw_transaksi_5_hari']->where('transaction_date', $date)->first())){
                $array[] = $raw['raw_transaksi_5_hari']->where('transaction_date', $date)->first();
            }else{
                $array[] = [
                    'transaction_date' => $date,
                    'barang_masuk' => 0,
                    'barang_keluar' => 0,
                ];
            }
        }

        $array_date = [];
        $array_owner = [];
        $array_karyawan = [];
        $array_operasional = [];
        foreach ($array as $item) {
            array_push($array_date, $item['transaction_date']);
            array_push($array_owner, $item['barang_masuk']);
            array_push($array_karyawan, $item['barang_keluar']);
        }

        $data['date_list'] = $array_date;
        $data['barang_masuk_list'] = $array_owner;
        $data['barang_keluar_list'] = $array_karyawan;

        return ApiFormatter::success(200, 'success', $data);
    }
}
