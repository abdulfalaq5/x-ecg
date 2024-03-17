<?php

use Illuminate\Support\Facades\DB;

/**
 * @param mixed $value
 * @return string
 * @throws \Exception
 */
function format_rupiah($value)
{
    return 'Rp ' . number_format((float) $value);
}

function time_elapsed_string($datetime, $full = false)
{
    $now  = new DateTime();
    $ago  = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    return $string ? implode(', ', $string) . ' lalu' : 'baru saja';
}

function get_user($id)
{
    return \App\Models\User::find($id)->name ?? '-';
}

function batasString($text, $jumlah)
{
    return strlen($text) > $jumlah ? substr(strip_tags(html_entity_decode($text)), 0, $jumlah) . ' .....' : substr(strip_tags(html_entity_decode($text)), 0, $jumlah);
}

function hitungPromo($price, $typePromo, $nominalPromo)
{
    if (isset($nominalPromo)) {
        if ($typePromo == 0) {
            $returnPrice = $price - $nominalPromo;
        } else {
            $returnPrice = $price - (($price * $nominalPromo) / 100);
        }
    } else {
        $returnPrice = $price;
    }

    return $returnPrice;
}

function hitungNominalPromo($price, $typePromo, $nominalPromo)
{
    if (isset($nominalPromo)) {
        if ($typePromo == 0) {
            $returnPrice = $nominalPromo;
        } else {
            $returnPrice = ($price * $nominalPromo) / 100;
        }
    } else {
        $returnPrice = 0;
    }

    return $returnPrice;
}

function hitungPresentasePromo($price, $typePromo, $nominalPromo)
{
    if (isset($nominalPromo)) {
        if ($typePromo == 0) {
            $returnPrice = ($nominalPromo / $price) * 100;
        } else {
            $returnPrice = $nominalPromo;
        }
    } else {
        $returnPrice = 0;
    }

    return $returnPrice != 0 ? round($returnPrice, 2) : 0;
}

function perbandinganPromoWithPrice($price, $promo_id)
{
    $dataPromo = DB::table('promo')->select('promo_type', 'discount_amount')->where('id', $promo_id)->where('promo_type', '0')->first();
    if (isset($dataPromo)) {
        if ($price < $dataPromo->discount_amount) {
            $return = false;
        } else {
            $return = true;
        }
    } else {
        $return = true;
    }

    return $return;
}

function convert_format_tanggal($value)
{
    return (!$value) ? '' : date('d/m/Y', strtotime($value));
}

if (!function_exists('put_permanent_env')) {
    function put_permanent_env($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path),
        ));
    }
}
if (!function_exists('getUserById')) {
    function getUserById($id)
    {
        return \App\Models\User::find($id) ?? '-';
    }
}

if (!function_exists('format_number')) {
    function format_number($value)
    {
        return number_format($value, 0, ",", ".");
    }
}

if (!function_exists('can')) {
    function can($permisssion)
    {
        return  auth()->user()->can($permisssion);
    }
}

if (! function_exists('convert_tanggal')) {
    function convert_tanggal($tgl, $type)
    {
        $tgl = date('Y-m-d', strtotime($tgl));
        $pecahkan = explode('-', $tgl);
        $hari = [1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        ];
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $bulan_romawi = [
            1 => 'I',
            'II',
            'III',
            'IV',
            'V',
            'VI',
            'VII',
            'VIII',
            'IX',
            'X',
            'XI',
            'XII',
        ];
        if ($type == 'd') {
            $tgl = date('Y-m-N', strtotime($tgl));
            $pecahkan = explode('-', $tgl);
            $return = $hari[$pecahkan[2]];
        } elseif ($type == 'm') {
            $return = $bulan[(int) $pecahkan[1]];
        } elseif ($type == 'bulan_romawi') {
            $return = $bulan_romawi[(int) $pecahkan[1]];
        } elseif ($type == 'Y') {
            $return = $pecahkan[0];
        } elseif ($type == 'Y-m') {
            $return = $bulan[(int) $pecahkan[1]].' '.$pecahkan[0];
        } else {
            $return = $pecahkan[2].' '.$bulan[(int) $pecahkan[1]].' '.$pecahkan[0];
        }

        return $return;
    }

    if (! function_exists('convert_garing_tanggal')) {
        //conver garis miring pada tanggal jika format tanggal dari api dd/mm/yyyy ss:ss:ss
        function convert_garing_tanggal($tanggal)
        {
            $dataTanggalWaktu = explode(' ', $tanggal);
            $dataTanggalArray = explode('/', $dataTanggalWaktu[0]);
            $tanggal = $dataTanggalArray[0].'-'.$dataTanggalArray[1].'-'.$dataTanggalArray[2];

            return $tanggal;
        }
    }

    if (! function_exists('format_angka')) {
        function format_angka($value)
        {
            return number_format($value, 0, ',', '.');
        }
    }

    if (! function_exists('convert_status_deposit')) {
        function convert_status_deposit($value)
        {
            $statusDeposit = '';
            if ($value == 0) {
                $statusDeposit = 'Batal';
            } elseif ($value == 1) {
                $statusDeposit = 'Belum diverifikasi';
            } elseif ($value == 2) {
                $statusDeposit = 'Terverifikasi';
            } elseif ($value == 3) {
                $statusDeposit = 'Dikembalikan';
            } elseif ($value == 4) {
                $statusDeposit = 'Belum Upload Bukti Bayar';
            } elseif ($value == 5) {
                $statusDeposit = 'Menunggu Pembayaran';
            }

            return $statusDeposit;
        }
    }

    if (! function_exists('format_npwp')) {
        function format_npwp($value)
        {
            $npwpArray = str_split($value);
            if (count($npwpArray) == 15) {
                $npwp = $npwpArray[0].$npwpArray[1].'.'.$npwpArray[2].$npwpArray[3].$npwpArray[4].'.'.$npwpArray[5].$npwpArray[6].$npwpArray[7].'.'.$npwpArray[8].'-'.$npwpArray[9].$npwpArray[10].$npwpArray[11].'.'.$npwpArray[12].$npwpArray[13].$npwpArray[14];
            } else {
                $npwp = $value;
            }

            return $npwp;
        }
    }

    if (! function_exists('jumlah_hari_kerja')) {
        function jumlah_hari_kerja($start_date, $end_date)
        {
            $start_date = date('Y-m-d', strtotime($start_date));
            $start_date = strtotime($start_date);
            $end_date = date('Y-m-d', strtotime($end_date));
            $end_date = strtotime($end_date);

            $hariKerja = [];
            for ($i = $start_date; $i <= $end_date; $i += (60 * 60 * 24)) {
                if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                    $hariKerja[] = $i;
                }
            }
            $jumlahHariKerja = count($hariKerja);

            return ($jumlahHariKerja > 1) ? ($jumlahHariKerja - 1) : $jumlahHariKerja;
        }
    }

    if (! function_exists('convert_status_bpkb')) {
        function convert_status_bpkb($status, $value)
        {
            if ($status == 'Menyusul') {
                $status_bpkb = $value.' HK';
            } else {
                $status_bpkb = $status;
            }

            return $status_bpkb;
        }
    }

    if (! function_exists('status_hasil_lelang')) {
        function status_hasil_lelang($status, $dudate_payment, $payment_status, $is_cancel_wanprestasi)
        {
            if ($is_cancel_wanprestasi == true) {
                $return_status = 'WANPRESTASI';
            } else {
                if ($status == 'Terjual') {
                    if ($payment_status == false) {
                        $dudate_payment = date('Y-m-d H:i', strtotime($dudate_payment));
                        if ($dudate_payment <= date('Y-m-d').'16:00') {
                            $return_status = 'WANPRESTASI';
                        } else {

                            $return_status = 'SOLD';
                        }
                    } else {
                        $return_status = 'SOLD';
                    }
                } else {
                    $return_status = 'UNSOLD';
                }
            }

            return $return_status;
        }
    }

    if (!function_exists('batasString')) {
        function batasString($text, $jumlah)
        {
            return strlen($text) > $jumlah ? mb_substr(strip_tags(html_entity_decode($text)), 0, $jumlah) . '' : mb_substr(strip_tags(html_entity_decode($text)), 0, $jumlah);
        }
    }
}
