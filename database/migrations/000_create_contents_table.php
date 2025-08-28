<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Contentable\Config\Config;
use Yuges\Contentable\Models\Content;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getContentClass(Content::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getContentKeyType(KeyType::BigInteger));

            $table->keyMorphs(
                Config::getContentableKeyType(KeyType::BigInteger),
                Config::getContentableRelationName('contentable')
            );

            $table->unsignedInteger('version')->index();
            $table->json('editor')->nullable();

            $table->timestamp('selected_at')->nullable();
            $table->timestamps();
        });
    }
};
