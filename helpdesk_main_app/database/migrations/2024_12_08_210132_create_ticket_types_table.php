<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TicketTypes;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type')->unique();
        });

        TicketTypes::create(['type' => 'Incident']);
        TicketTypes::create(['type' => 'Service Request']);

        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && !Schema::hasColumn('tickets', 'type_id')
            )
            {
                // $table->foreignId('type_id')->nullable();
                // $table->foreignId('type_id')->constrained('ticket_types')->onDelete('cascade');

                /**
                 * Convert to not nullable
                 */
                $table->unsignedBigInteger('type_id')->nullable();
            }
        });

        // DB::table('tickets')->where('type', strtolower('Incident'))->update(['type_id' => 1]);
        // DB::table('tickets')->where('type', strtolower('Service Request'))->update(['type_id' => 2]);

        /**
         * Column type not exists on tickets table so I'm gonna update all of them with 1
         */
        if(
            1 == 1
            && Schema::hasColumn('tickets', 'type')
        )
        {
            DB::statement(
                '   UPDATE
                        tickets
                    SET
                        type_id = tt.id
                    FROM
                        ticket_types tt
                    WHERE
                        1 = 1
                        AND LOWER(tickets.type) = LOWER(tt.type)
                '
            );
        }else{
            DB::statement(
                '   UPDATE
                        tickets
                    SET
                        type_id = 1
                '
            );
        }

        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'type_id')
            ){
                // $table->foreignId('type_id')->constrained('ticket_types')->onDelete('cascade');
                $table->foreign('type_id')->references('id')->on('priorities_tickets')->onDelete('cascade');

                /**
                 * Convert to not nullable
                 */
                $table->unsignedBigInteger('type_id')->nullable(false)->change();
            }

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'type')
            ){
                $table->dropColumn('type');
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
                && !Schema::hasColumn('tickets', 'type')
            )
            {
                $table->string('type')->nullable();
            }
        });

        // DB::table('tickets')->where('type_id', 1)->update(['type' => 'Incident']);
        // DB::table('tickets')->where('type_id', 2)->update(['type' => 'Service Request']);

        DB::statement(
            '   UPDATE
                    tickets
                SET
                    type = tt.type
                FROM
                    ticket_types tt
                WHERE
                    tickets.type_id = tt.id
            '
        );

        Schema::table('tickets', function (Blueprint $table) {

            $table->dropForeign(['type_id']);

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'type_id')
            )
            {
                $table->dropColumn('type_id');
            }
        });

        Schema::dropIfExists('ticket_types');
    }
};
