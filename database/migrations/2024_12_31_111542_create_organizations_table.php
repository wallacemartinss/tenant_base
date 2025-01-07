<?php

use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('document_number')->unique();
            $table->string('phone')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->string('stripe_customer_id')->nullable()->index();
            $table->timestamps();
        });
        Schema::create('organization_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class)->index();
            $table->foreignIdFor(User::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('organization_user');
    }
};
