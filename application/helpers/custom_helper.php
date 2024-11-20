<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('ago'))
{
  function timeago($time)
  {
    $ptime  = strtotime($time);
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
  }
}

if ( ! function_exists('get_option'))
{
	function get_option($name)
	{
		$CI =& get_instance();

		$CI->db->where('key',$name);
        $query	= $CI->db->get('options');
        $result = $query->row();

		return $result->value;
	}
}

if ( ! function_exists('update_option'))
{
	function update_option($name,$value)
	{
		$CI =& get_instance();
    $CI->cms_model->update('options',array('value' => $value), array('key' => $name));

		return true;
	}
}

function hari($date)
{
	$day = date('N', strtotime($date));

	$hari = array(
						'1' => 'Senin',
						'2' => 'Selasa',
						'3' => 'Rabu',
						'4' => 'Kamis',
						'5' => "Jum'at",
						'6' => 'Sabtu',
						'7' => 'Minggu',
 					);
	return $hari[$day];
}

function bulan($date)
{
	$month = date('n', strtotime($date));

	$bulan = array(
						'1' => 'Januari','2' => 'Februari','3' => 'Maret','4' => 'April',
						'5' => 'Mei','6' => 'Juni','7' => 'Juli','8' => 'Agustus',
						'9' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'
 					);
	return $bulan[$month];
}

function local_date($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = bulan($tgl);
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;
}

function product_type($type,$pid)
{
  $CI =& get_instance();
  $check = $CI->cms_model->get_row('type_products', array('product_id' => $pid, 'type_id' => $type));

  return $check;
}

function sale_status($status)
{
	$hari = array(
						'0' => 'Waiting',
						'1' => 'Process',
						'2' => 'Send',
						'3' => 'Receive',
						'4' => "Complete"
 					);
	return $hari[$status];
}

function timeDiff($firstTime,$lastTime)
{
  $firstTime=strtotime($firstTime);
  $lastTime=strtotime($lastTime);

  $timeDiff=$lastTime-$firstTime;

  return gmdate("H:i:s", $timeDiff);

}

function to_date($date='')
{
  $time = strtotime($date);
  return date('Y-m-d', $time);
}

function to_time($date='')
{
  $time = strtotime($date);
  return date('H:i:s', $time);
}

function std_to_time($std='')
{
  $time1 = substr($std, 0, 2);
  $time2 = substr($std, -2);

  return $time1.':'.$time2.':00';

}

function format_number($dates='')
{
  $date = date('d', strtotime($dates));
  $month = date('M', strtotime($dates));
  $year = date('Y', strtotime($dates));

  return $date.'/'.$month.' '.$year;
}

// function rupiah($uang){
//
// 	$rupiah  = "";
// 	$panjang = strlen($uang);
//
// 	while ($panjang > 3){
// 		$rupiah		= ".".substr($uang, -3).$rupiah;
// 		$lebar		= strlen($uang) - 3;
// 		$uang		= substr($uang,0,$lebar);
// 		$panjang	= strlen($uang);
// 	}
//
// 	$rupiah = 'Rp. '.$uang.$rupiah.',-';
// 	return $rupiah;
// }

function rupiah($angka){

	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;

}

function tingkat($jumlah)
{
  $tingkat = '';
  for($x=1;$x<=$jumlah;$x++) {
    $tingkat .= 'X';
  }

  return $tingkat;
}

function reverseage($umur)
{
  $reverse = array('101','100','099','098','097','096','095','094','093','092','091','090','089','088','087','086','085','084','083','082','081','080','079','078','077','076','075','074','073','072','071','070','069','068','067','066','065','064','063','062','061','060','059','058','057','056','055','054','053','052','051','050','049','048','047','046','045','044','043','042','041','040','039','038','037','036','035','034','033','032','031','030','029','028','027','026','025','024','023','022','021','020','019','018','017','016','015','014','013','012','011','010','009','008','007','006','005','004','003','002','001');

  return $reverse[$umur];
}

function kodesatker($id)
{
  if(strlen($id) == 1){
    return '00'.$id;
  }else if(strlen($id) == 2){
    return '0'.$id;
  }else{
    return $id;
  }
}

function pangkat($id)
{
  if(strlen($id) == 1){
    return '0'.$id;
  }else{
    return $id;
  }
}

function shortdec($number='')
{
  return number_format((float)$number, 2, '.', '');
}

function is_loggedin()
{
  $CI =& get_instance();
  if($CI->session->userdata('nip'))
  {
    return true;
  }

  return false;
}

function terbilang($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = terbilang($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = terbilang($nilai/10)." puluh". terbilang($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . terbilang($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = terbilang($nilai/100) . " ratus" . terbilang($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . terbilang($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = terbilang($nilai/1000) . " ribu" . terbilang($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = terbilang($nilai/1000000) . " juta" . terbilang($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = terbilang($nilai/1000000000) . " milyar" . terbilang(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = terbilang($nilai/1000000000000) . " trilyun" . terbilang(fmod($nilai,1000000000000));
		}
		return $temp;
	}
