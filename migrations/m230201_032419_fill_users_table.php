<?php

use yii\db\Migration;

/**
 * Class m230201_032419_fill_users_table
 */
class m230201_032419_fill_users_table extends Migration
{

    public function safeUp()
    {
        $this->execute("
            INSERT INTO public.users (\"accessToken\",email,username,first_name,last_name,status,\"role\",\"password\")
            VALUES ('manager','manager@manager.ru','manager','Иван','Генадич',1,2,'manager')
        ");

        $this->execute("
            INSERT INTO public.users (\"accessToken\",email,username,first_name,last_name,status,\"role\",\"password\")
	        VALUES ('admin','admin@admin.ru','admin','Алексей','Соколов',1,1,'admin')
        ");
    }

    public function safeDown()
    {
        $this->execute("
            truncate table public.user
        ");

        return false;
    }
}
