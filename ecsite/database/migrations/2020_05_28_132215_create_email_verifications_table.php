<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\EmailVerification;

class CreateEmailVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->comment('メールアドレス');
            $table->string('token', 250)->nullable()->comment('確認トークン');
            $table->tinyInteger('status')->default(EmailVerification::SEND_MAIL)->comment('ステータス');
            $table->dateTime('expiration_datetime')->comment('有効期限');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_verifications');
    }
}
