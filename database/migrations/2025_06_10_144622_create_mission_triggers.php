<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateMissionTriggers extends Migration
{
    public function up()
    {
        // Trigger 1: before_mission_insert
        DB::unprepared('
            DROP TRIGGER IF EXISTS before_mission_insert;
            
            CREATE TRIGGER before_mission_insert
            BEFORE INSERT ON mission_assignments
            FOR EACH ROW
            BEGIN
                IF NEW.is_done = 1 THEN
                    SET NEW.is_done = 0;
                END IF;
            END;
        ');

        // Trigger 2: after_mission_completed
        DB::unprepared('
            DROP TRIGGER IF EXISTS after_mission_completed;
            
            CREATE TRIGGER after_mission_completed
            AFTER UPDATE ON mission_assignments
            FOR EACH ROW
            BEGIN
                DECLARE v_template_id BIGINT;
                DECLARE v_xp_reward INT;
                
                IF OLD.id IS NOT NULL AND NEW.is_done = 1 AND OLD.is_done != 1 THEN
                    SELECT template_id INTO v_template_id
                    FROM daily_missions
                    WHERE id = NEW.daily_id;
                    
                    SELECT xp_reward INTO v_xp_reward
                    FROM mission_templates
                    WHERE id = v_template_id;
                    
                    UPDATE users
                    SET xp = xp + v_xp_reward
                    WHERE id = NEW.user_id;
                END IF;
            END;
        ');
    }

    

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_mission_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_mission_completed');
    }
}