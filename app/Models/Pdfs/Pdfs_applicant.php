<?php

namespace App\Models\Pdfs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pdfs_applicant extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $fillable = [
        'uuid', 'id_of_agent', 'uid_of_agent', 'agent', 'department_of_agent', 'index_of_auditor', 'id_of_auditor', 'uid_of_auditor', 'auditor', 'department_of_auditor', 'application', 'progress', 'status', 'reason', 'remark', 'auditing', 'archived', 'camera_imgurl',
    ];

        /**
     * 这个属性应该被转换为原生类型.
     * 用于json与array互相转换
     * @var array
     */
    protected $casts = [
        'application' => 'array',
        // 'actuality' => 'array',
        'auditing' => 'array',
    ];


}
