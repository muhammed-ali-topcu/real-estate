<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->longText('description');
            $table->enum('property_type', ['house', 'apartment', 'shop', 'office', 'land',]);
            $table->enum('listing_type', ['sale', 'rent']);
            $table->decimal('price', 15, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('rooms')->nullable()->comment('1+0, 2+0, 3+0,1+1, 2+1, 3+1, 4+1 etc');
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable()->comment('In square meters');
            $table->text('address');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'sold', 'rented'])->default('pending');

            $table->boolean('featured')->default(false);
            $table->year('year_built')->nullable();
            $table->json('amenities')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['property_type']);
            $table->index(['listing_type']);
            $table->index(['status']);
            $table->index(['city']);
            $table->index(['price']);
            $table->index(['latitude', 'longitude']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
