<?php

use yii\db\Migration;

/**
 * Class m230201_040539_fill_products_table
 */
class m230201_040539_fill_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            INSERT INTO public.products (\"name\", price)
	        VALUES ('Яблоки', '230')
        ");

        $this->execute("
            INSERT INTO public.products (\"name\", price)
	        VALUES ('Мандарины', '340')
        ");

        $this->execute("
            INSERT INTO public.products (\"name\", price)
	        VALUES ('Апельсины', '99')
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("
            truncate table public.products
        ");

        return false;
    }
}
