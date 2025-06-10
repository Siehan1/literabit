<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerAfterHistoryUpdate extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER after_history_update
            AFTER UPDATE ON histories
            FOR EACH ROW
            BEGIN
                DECLARE completed_count INT;
                DECLARE badge_exists INT;

                IF NEW.status = "completed" AND (OLD.status IS NULL OR OLD.status != "completed") THEN
                    SELECT COUNT(*) INTO completed_count 
                    FROM histories 
                    WHERE user_id = NEW.user_id AND status = "completed";

                    SELECT COUNT(*) INTO badge_exists
                    FROM user_badges
                    WHERE user_id = NEW.user_id AND badge_id = 1;

                    IF completed_count > 2 AND badge_exists = 0 THEN
                        INSERT INTO user_badges (user_id, badge_id, created_at, updated_at)
                        VALUES (NEW.user_id, 1, NOW(), NOW());
                    END IF;
                END IF;
            END
        ');
    }

    public function down()
    {

    }
}

