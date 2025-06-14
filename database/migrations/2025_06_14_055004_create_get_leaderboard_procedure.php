<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateGetLeaderboardProcedure extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS GetLeaderboard;
            CREATE PROCEDURE GetLeaderboard()
            BEGIN
                SELECT id, name, xp,
                       RANK() OVER (ORDER BY xp DESC) AS ranking
                FROM users
                ORDER BY xp DESC
                LIMIT 10;
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetLeaderboard;");
    }
}

