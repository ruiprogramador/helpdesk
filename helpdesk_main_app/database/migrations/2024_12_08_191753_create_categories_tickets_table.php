<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CategoriesTickets;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('category')->unique();
            $table->timestamps();
        });

        CategoriesTickets::create(['category' => 'Software']);
        CategoriesTickets::create(['category' => 'Hardware']);
        CategoriesTickets::create(['category' => 'Network']);
        CategoriesTickets::create(['category' => 'Security']);
        CategoriesTickets::create(['category' => 'Other']);

        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && !Schema::hasColumn('tickets', 'category_id')
            )
            {
                // $table->foreignId('category_id')->nullable();
                // $table->foreignId('category_id')->constrained('categories_tickets')->onDelete('cascade');

                $table->unsignedBigInteger('category_id')->nullable();
            }
        });

        if(
            1 == 1
            && Schema::hasColumn('tickets', 'category')
        )
        {
            DB::statement(
                '   UPDATE
                        tickets
                    SET
                        category =
                    (
                        SELECT
                            category
                        FROM
                            categories_tickets
                        ORDER BY RANDOM()
                        LIMIT 1
                    )
                '
            );
        }

        // DB::table('tickets')->where('category', strtolower('Software'))->update(['category_id' => 1]);
        // DB::table('tickets')->where('category', strtolower('Hardware'))->update(['category_id' => 2]);
        // DB::table('tickets')->where('category', strtolower('Network'))->update(['category_id' => 3]);
        // DB::table('tickets')->where('category', strtolower('Security'))->update(['category_id' => 4]);
        // DB::table('tickets')->where('category', strtolower('Other'))->update(['category_id' => 5]);

        DB::statement(
            '   UPDATE
                    tickets
                SET
                    category_id = ct.id
                FROM
                    categories_tickets ct
                WHERE
                    LOWER(tickets.category) = LOWER(ct.category)
            '
        );

        Schema::table('tickets', function (Blueprint $table) {


            if(
                1 == 1
                && Schema::hasColumn('tickets', 'category_id')
            )
            {
                // $table->foreignId('category_id')->constrained('categories_tickets')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('priorities_tickets')->onDelete('cascade');

                /**
                 * Convert to not nullable
                 */
                $table->unsignedBigInteger('category_id')->nullable(false)->change();
            }

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'category')
            )
            {
                $table->dropColumn('category');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && !Schema::hasColumn('tickets', 'category')
            )
            {
                $table->string('category')->nullable();
            }
        });

        // DB::table('tickets')->where('category_id', 1)->update(['category' => 'Software']);
        // DB::table('tickets')->where('category_id', 2)->update(['category' => 'Hardware']);
        // DB::table('tickets')->where('category_id', 3)->update(['category' => 'Network']);
        // DB::table('tickets')->where('category_id', 4)->update(['category' => 'Security']);
        // DB::table('tickets')->where('category_id', 5)->update(['category' => 'Other']);

        DB::statement(
            '   UPDATE
                    tickets
                SET
                    category = ct.category
                FROM
                    categories_tickets ct
                WHERE
                    tickets.category_id = ct.id
            '
        );

        Schema::table('tickets', function (Blueprint $table) {


            $table->dropForeign(['category_id']);

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'category_id')
            )
            {
                $table->dropColumn('category_id');
            }
        });

        Schema::dropIfExists('categories_tickets');
    }
};
