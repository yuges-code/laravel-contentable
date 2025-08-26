<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Contentable\Models\Block;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Models\Content;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getBlockClass(Block::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getBlockKeyType(KeyType::BigInteger));

            $table->foreignIdFor(Config::getContentClass(Content::class))
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('type')->index();
            $table->json('data');

            $table->order();

            $table->timestamps();
        });
    }
};
