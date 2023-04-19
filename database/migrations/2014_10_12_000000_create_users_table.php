<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->timestamps();

            $table->increments('id');
            $table->string('uid')->nullable()->comment('申请人工号');
            $table->string('name')->unique()->comment('申请人姓名');
            $table->string('department')->comment('申请人部门');
            // $table->jsonb('applicant_group')->nullable()->comment('批量申请人员组信息');
            // $table->jsonb('auditing')->nullable()->comment('申请审核人信息');
            // $table->jsonb('auditing_confirm')->nullable()->comment('确认审核人信息');
            $table->jsonb('configs')->nullable()->comment('用户配置');
            $table->string('ldapname')->nullable()->comment('ldap用户名');
            $table->string('email')->nullable();
            $table->string('displayname')->nullable();
            $table->string('password');
			$table->timestamp('login_time')->comment('登录时间');
			$table->integer('login_ttl')->default(0)->comment('登录有效时间');
			$table->string('login_ip',15)->default(null)->comment('登录ip');
			$table->integer('login_counts')->default(0)->comment('登录次数');
            $table->rememberToken();
            $table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
