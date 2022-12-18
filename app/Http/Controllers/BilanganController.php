<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BilanganController extends Controller
{
	/*public function __construct()
    {
        parent::__construct();
    }*/

	public function index()
    {
        return view('bilangan', get_defined_vars());
    }

    public function ubah(Request $request)
    {
    	$angka = $request->post('angka');
    	$hasil = $this->ubah_ke_bilangan($angka);
        return view('bilangan', get_defined_vars());
    }


	protected function ubah_ke_bilangan($num){

		$len = strlen($num);
		$arnum = str_split($num);//explode($num,'');
		if ($len == 0){
			return "Input tidak boleh kosong";
		}
		if (!is_numeric(abs($num))){
			return "Input harus angka";
		}
		if ($len > 10){
			return "Panjang input tidak boleh lebih dari 10";
		}
		if($len < 10){
			for($i = 0 ; $i < 10 - $len; $i++){
			   array_unshift($arnum , 0);
			}
		}
		//dd($arnum);

		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($len > 8) {
			if($arnum[0] != 0)
				$temp .= $huruf[$arnum[0]] . " milyar ";
		}
		if ($len > 5) {
			$jt = "";
			if(isset($arnum[1]) && $arnum[1] != 0){
				if($arnum[1] == 1) $jt = " seratus ";
			 		else
			 			$jt = $huruf[$arnum[1]] . " ratus ";
			} 
			if(isset($arnum[2]) && $arnum[2] != 0){
			 	if($arnum[2] == 1) $jt .= " sepuluh ";
			 		else
			 			$jt .= $huruf[$arnum[2]] . " puluh ";
			} 
			   if(isset($arnum[3]) && $arnum[3] != 0)
				$temp .= $jt . $huruf[$arnum[3]] .  " juta ";
		}
		if ($len > 3) {
			$rb = "";
			if(isset($arnum[4]) && $arnum[4] != 0) $rb = $huruf[$arnum[4]] . " ratus ";
			 if(isset($arnum[5]) && $arnum[5] != 0){
			 	if($arnum[5] == 1) $rb .= " sepuluh ";
			 		else
			 			$rb .= $huruf[$arnum[5]] . " puluh ";
			 } 
			 if(isset($arnum[6]) && $arnum[6] != 0){
			 	if($arnum[6] == 1) $rb .= " seribu ";
			 		else
			 			$rb .= $huruf[$arnum[6]] . " ribu ";
			 } 
				$temp .= $rb;
		}
		if ($len >= 1) {
			$st = "";
			if(isset($arnum[7]) && $arnum[7] != 0){
				if($arnum[7] == 1) $st = " seratus ";
			 		else
			 			$st = $huruf[$arnum[7]] . " ratus ";
			}
			 if(isset($arnum[8]) && $arnum[8] != 0) 
			 {
			 	if($arnum[8] == 1 && $arnum[9] == 0) $st .= "sepuluh";
			 	 elseif($arnum[8] != 1 && $arnum[9] == 0) $st .= $huruf[$arnum[8]] . " puluh ";
			 	  elseif($arnum[8] != 1 && $arnum[9] != 0) $st .= $huruf[$arnum[8]] . " puluh " . $huruf[$arnum[9]];
			 		else $st .= $huruf[$arnum[9]] . " belas ";
			 }
			  if($arnum[8] == 0 && isset($arnum[9]) && $arnum[9] != 0) $st .= $huruf[$arnum[9]];
				$temp = $temp . $st;
		}
		//echo $temp;
		return $temp;                         

	}
}