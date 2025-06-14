<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerAutoBadgeAwardOnHistories extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS auto_badge_award;

            CREATE TRIGGER auto_badge_award
            AFTER UPDATE ON histories
            FOR EACH ROW
            BEGIN
                DECLARE total_buku INT;
                DECLARE total_buku_mingguan INT;
                DECLARE total_halaman INT;

                -- Cek apakah status berubah menjadi "completed"
                IF NEW.status = "completed" AND (OLD.status IS NULL OR OLD.status != "completed") THEN

                    -- Hitung total buku selesai
                    SELECT COUNT(*) INTO total_buku
                    FROM histories
                    WHERE user_id = NEW.user_id AND status = "completed";

                    -- Hitung buku selesai dalam 7 hari terakhir
                    SELECT COUNT(*) INTO total_buku_mingguan
                    FROM histories
                    WHERE user_id = NEW.user_id AND status = "completed"
                          AND updated_at >= NOW() - INTERVAL 7 DAY;

                    -- Hitung total halaman dari hal_terakhir
                    SELECT SUM(hal_terakhir) INTO total_halaman
                    FROM histories
                    WHERE user_id = NEW.user_id AND status = "completed";

                    -- Badge: Pecinta Buku Mingguan (ID: 4)
                    IF total_buku_mingguan >= 3 THEN
                        INSERT IGNORE INTO user_badges (user_id, badge_id, created_at, updated_at)
                        VALUES (NEW.user_id, 4, NOW(), NOW());
                    END IF;

                    -- Badge: Kutu Buku (ID: 5)
                    IF total_buku >= 10 THEN
                        INSERT IGNORE INTO user_badges (user_id, badge_id, created_at, updated_at)
                        VALUES (NEW.user_id, 5, NOW(), NOW());
                    END IF;

                    -- Badge: Penjelajah Halaman (ID: 6)
                    IF total_halaman >= 500 THEN
                        INSERT IGNORE INTO user_badges (user_id, badge_id, created_at, updated_at)
                        VALUES (NEW.user_id, 6, NOW(), NOW());
                    END IF;

                    -- Badge: Petualang Buku (ID: 7)
                    IF total_halaman >= 1000 THEN
                        INSERT IGNORE INTO user_badges (user_id, badge_id, created_at, updated_at)
                        VALUES (NEW.user_id, 7, NOW(), NOW());
                    END IF;

                END IF;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS auto_badge_award;');
    }
};
