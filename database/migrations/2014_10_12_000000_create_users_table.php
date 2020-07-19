<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('company_name');
            $table->text('contact_name')->nullable();
            $table->text('contact_number')->nullable();
            $table->text('email')->nullable();
            $table->text('company_city')->nullable();
            $table->text('company_address')->nullable();
            $table->json('feeQuantityRange')->nullable();
            $table->timestamps();
        });

        Schema::create('organization', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('company_info');
            $table->text('company_contact')->nullable();
            $table->text('company_phone')->nullable();
            $table->text('company_email')->nullable();
            $table->text('company_address')->nullable();
            $table->timestamps();
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->string('name');
            $table->string('lastName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('companyName')->nullable();
            $table->string('phone')->nullable();
            $table->string('taxId')->nullable();
            $table->string('paymentAddress')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('coverage')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('user_permissions', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->unique();   
            $table->integer('permission_id')->unsigned()->unique();   
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->primary(['user_id','permission_id']);
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->primary(['user_id','role_id']);
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->unique();
            $table->integer('permission_id')->unsigned()->unique();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->primary(['role_id','permission_id']);
        });

        Schema::create('hardware', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('hardware_1')->default(0);
            $table->boolean('hardware_2')->default(0);
            $table->boolean('hardware_3')->default(0);
            $table->boolean('hardware_4')->default(0);
            $table->boolean('hardware_5')->default(0);
            $table->boolean('hardware_6')->default(0);
            $table->boolean('hardware_7')->default(0);
            $table->boolean('hardware_8')->default(0);
            $table->timestamps();
        });

        Schema::create('document', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document');
            $table->date('date_exp')->nullable();	
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('geodata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('state_id');
            $table->string('state');
            $table->string('state_abbr');
            $table->string('zipcode');
            $table->string('country');
            $table->string('city');
        });

        Schema::create('pricing', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('deeds')->nullable();
            $table->float('trust')->nullable();
            $table->float('refinance')->nullable();
            $table->float('purchase')->nullable();
            $table->float('reverse')->nullable();
            $table->float('sba')->nullable();
            $table->float('commercial')->nullable();
            $table->float('split_closing')->nullable();
            $table->float('applications')->nullable();
            $table->float('walk_in_recordings')->nullable();
            $table->timestamp('monday_from')->nullable();
            $table->timestamp('monday_to')->nullable();
            $table->timestamp('tuesday_from')->nullable();
            $table->timestamp('tuesday_to')->nullable();
            $table->timestamp('wednesday_from')->nullable();
            $table->timestamp('wednesday_to')->nullable();
            $table->timestamp('thursday_from')->nullable();
            $table->timestamp('thursday_to')->nullable();
            $table->timestamp('friday_from')->nullable();
            $table->timestamp('friday_to')->nullable();
            $table->timestamp('saturday_from')->nullable();
            $table->timestamp('saturday_to')->nullable();
            $table->timestamp('sunday_from')->nullable();
            $table->timestamp('sunday_to')->nullable();
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->unique();
            $table->integer('loan_id');
            $table->string('file_id');
            $table->string('property_location_street_name');
            $table->string('property_location_additional_street_name');
            $table->string('property_location_city');
            $table->string('property_location_state');
            $table->string('property_location_zip');
            $table->string('close_location_street_name');
            $table->string('close_location_additional_street_name');
            $table->string('close_location_city');
            $table->string('close_location_state');
            $table->string('close_location_zip');
            $table->string('borrower_name');
            $table->string('borrower_middle_name');
            $table->string('borrower_last_name');
            $table->string('borrower_email');
            $table->json('coborrower_name')->nullable();
            $table->json('coborrower_middle_name')->nullable();
            $table->json('coborrower_last_name')->nullable();
            $table->string('contact_number_home');
            $table->string('contact_number_mobile')->nullable();
            $table->string('contact_number_alt')->nullable();
            $table->date('closing_time_and_date');
            $table->integer('closing_type');
            $table->string('closing_information_type_value')->nullable();
            $table->string('closing_information_email')->nullable();
            $table->string('closing_information_fax')->nullable();
            $table->string('lo_name');
            $table->string('lo_number');
            $table->string('lo_email');
            $table->text('fax_select')->nullable();
            $table->text('internal_notes')->nullable();
            $table->text('special_instructions')->nullable();
            $table->enum('status',['0', '1', '2', '3'])->default('0');
            $table->enum('document_status',['0', '1', '2'])->default('0');
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('order_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('from_email')->nullable();
            $table->text('from_name')->nullable();
            $table->text('mailer')->nullable();
            $table->text('host')->nullable();
            $table->text('port')->nullable();
            $table->text('security_email')->nullable();
            $table->text('username')->nullable();
            $table->text('password')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_permissions');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('hardware');
        Schema::dropIfExists('document');
        Schema::dropIfExists('order_documents');
    }
}
