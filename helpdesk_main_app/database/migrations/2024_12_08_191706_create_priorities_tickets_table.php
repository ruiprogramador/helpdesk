<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PrioritiesTickets;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('priorities_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('priority')->unique();
            $table->timestamps();
        });

        PrioritiesTickets::create(['priority' => 'Low']);
        PrioritiesTickets::create(['priority' => 'Medium']);
        PrioritiesTickets::create(['priority' => 'High']);

        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && !Schema::hasColumn('tickets', 'priority_id')
            )
            {
                // $table->foreignId('priority_id')->nullable();
                $table->unsignedBigInteger('priority_id')->nullable();
            }
        });

        // DB::table('tickets')->where('priority', strtolower('Low'))->update(['priority_id' => 1]);
        // DB::table('tickets')->where('priority', strtolower('Medium'))->update(['priority_id' => 2]);
        // DB::table('tickets')->where('priority', strtolower('High'))->update(['priority_id' => 3]);

        DB::statement(
            '   UPDATE
                    tickets
                SET
                    priority_id = pt.id
                FROM
                    priorities_tickets pt
                WHERE
                    LOWER(tickets.priority) = LOWER(pt.priority)
            '
        );

        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'priority_id')
            )
            {
                // $table->foreignId('priority_id')->constrained('priorities_tickets')->onDelete('cascade');

                $table->foreign('priority_id')->references('id')->on('priorities_tickets')->onDelete('cascade');

                /**
                 * Convert to not nullable
                 */
                $table->unsignedBigInteger('priority_id')->nullable(false)->change();
            }

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'priority')
            )
            {
                $table->dropColumn('priority');
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
                && !Schema::hasColumn('tickets', 'priority')
            )
            {
                $table->string('priority')->nullable();
            }
        });

        // DB::table('tickets')->where('priority_id', 1)->update(['priority' => 'Low']);
        // DB::table('tickets')->where('priority_id', 2)->update(['priority' => 'Medium']);
        // DB::table('tickets')->where('priority_id', 3)->update(['priority' => 'High']);


        DB::statement(
            '   UPDATE
                    tickets
                SET
                    priority = pt.priority
                FROM
                    priorities_tickets pt
                WHERE
                    tickets.priority_id = pt.id
            '
        );

        Schema::table('tickets', function (Blueprint $table) {

            $table->dropForeign(['priority_id']);

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'priority_id')
            )
            {
                $table->dropColumn('priority_id');
            }
        });

        Schema::dropIfExists('priorities_tickets');
    }
};
