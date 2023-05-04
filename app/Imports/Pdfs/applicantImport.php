<?php

namespace App\Imports\Pdfs;

use App\Models\Pdfs\Pdfs_applicant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class mpointImport implements ToModel, WithHeadingRow
{
	//
    public function model(array $row)
    {

		// dump($row);
		// if (!isset($row[0])) {
			// return null;
		// }
	
		// Smt_qcreport::create([
		return new Pdfs_applicant([
			// 'jizhongming' => is_null($row['机种名']) ? '' : strtoupper(substr($row['机种名'], 0, 8)),
			'jizhongming' => is_null($row['机种名']) ? '' : strtoupper($row['机种名']),
			// 'pinming' => is_null($row['品名']) ? '' : strtoupper($row['品名']),
			'pinming' => 'ABCD',
			'gongxu' => is_null($row['工序']) ? '' : strtoupper($row['工序']),
			'diantai' => is_null($row['点/台']) ? '' : $row['点/台'],
			'pinban' => is_null($row['拼板']) ? '' : $row['拼板'],

		]);
		
    }
}
