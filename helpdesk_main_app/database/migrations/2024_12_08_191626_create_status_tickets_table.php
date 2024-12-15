<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StatusTickets;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('status')->unique();
            $table->timestamps();
        });

        // DB::table('tickets')->update(['status' => 'Open']);

        StatusTickets::create(['status' => 'Open']);
        StatusTickets::create(['status' => 'In Progress']);
        StatusTickets::create(['status' => 'Resolved']);
        StatusTickets::create(['status' => 'Closed']);

        Schema::table('tickets', function (Blueprint $table) {
            if(
                1 == 1
                && !Schema::hasColumn('tickets', 'status_id')
            )
            {
                // $table->foreignId('status_id')->constrained('status_tickets')->onDelete('cascade');
                // $table->foreignId('status_id')->nullable();

                $table->unsignedBigInteger('status_id')->nullable();
            }
        });

        // DB::table('tickets')->where('status', strtolower('Open'))->update(['status_id' => 1]);
        // DB::table('tickets')->where('status', strtolower('In Progress'))->update(['status_id' => 2]);
        // DB::table('tickets')->where('status', strtolower('Resolved'))->update(['status_id' => 3]);
        // DB::table('tickets')->where('status', strtolower('Closed'))->update(['status_id' => 4]);

        // DB::table('tickets')->where('status', 'Open')->update(['status_id' => 1]);

        // DB::table('tickets')->whereRaw('LOWER(status) = ?', ['open'])->update(['status_id' => 1]);
        // DB::table('tickets')->whereRaw('LOWER(status) = ?', ['in progress'])->update(['status_id' => 2]);
        // DB::table('tickets')->whereRaw('LOWER(status) = ?', ['resolved'])->update(['status_id' => 3]);
        // DB::table('tickets')->whereRaw('LOWER(status) = ?', ['closed'])->update(['status_id' => 4]);

        // DB::table('tickets')->where('status')
        //     ->update([
        //         'status_id' => DB::raw('(SELECT id FROM status_tickets WHERE status_tickets.status = tickets.status)')
        //     ]);

        // DB::table('tickets as t')
        // ->join('status_tickets as st', 'st.status', '=', 't.status')
        // ->update(['t.status_id' => DB::raw('st.id')]);

        DB::statement('
            UPDATE tickets
            SET status_id = st.id
            FROM status_tickets st
            WHERE tickets.status = st.status;
        ');

        Schema::table('tickets', function (Blueprint $table) {

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'status_id')
            )
            {
                // $table->foreignId('status_id')->constrained('status_tickets')->onDelete('cascade');

                $table->foreign('status_id')->references('id')->on('status_tickets')->onDelete('cascade');
                /**
                 * Convert to not nullable
                 */
                $table->unsignedBigInteger('status_id')->nullable(false)->change();
            }

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'status')
            )
            {
                $table->dropColumn('status');
                // dd('here 2');
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
                && !Schema::hasColumn('tickets', 'status')
            )
            {
                $table->string('status')->nullable();
            }
        });

        // DB::table('tickets')->where('status_id', 1)->update(['status' => 'Open']);
        // DB::table('tickets')->where('status_id', 2)->update(['status' => 'In Progress']);
        // DB::table('tickets')->where('status_id', 3)->update(['status' => 'Resolved']);
        // DB::table('tickets')->where('status_id', 4)->update(['status' => 'Closed']);

        // DB::table('tickets')->where('status_id')
        //     ->update([
        //         'status' => DB::raw('(SELECT status FROM status_tickets WHERE status_tickets.id = tickets.status_id)')
        //     ]);

        // DB::table('tickets')
        // ->join('status_tickets', 'status_tickets.id', '=', 'tickets.status_id')
        // ->update(['tickets.status' => DB::raw('status_tickets.status')]);

        DB::statement('
            UPDATE tickets
            SET status = st.status
            FROM status_tickets st
            WHERE tickets.status_id = st.id;
        ');

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['status_id']);

            if(
                1 == 1
                && Schema::hasColumn('tickets', 'status_id')
            )
            {
                $table->dropColumn('status_id');
            }
        });

        Schema::dropIfExists('status_tickets');

        /*Schema::table('tickets', function (Blueprint $table) {
            if(
                1 == 1
                && Schema::hasColumn('tickets', 'status_id')
            )
            {
                $table->dropColumn('status_id');
            }

            if(
                1 == 1
                && !Schema::hasColumn('tickets', 'status')
            )
            {
                $table->string('status')->nullable();
            }
        });


        // Update all tickets to open
        DB::table('tickets')->update(['status' => 'Open']);

        Schema::dropIfExists('status_tickets');*/
    }
};
