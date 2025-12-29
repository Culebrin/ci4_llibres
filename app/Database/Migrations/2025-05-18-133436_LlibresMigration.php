<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LlibresMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'titol'  => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'sinopsis' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'imagen' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'autor'  => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'spicy' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
            ],
            'ISBN' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
                'null'           => true,
            ],
            'estat' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
            ],
            // 'estat' => [
            //     'type'       => 'ENUM',
            //     'constraint' => ['pendent', 'llegit', 'llegint'],
            //     'default'    => 'pendent',
            //     'null'       => false,
            // ],
            'prioritat' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
            ],
            // 'prioritat' => [
            //     'type'       => 'ENUM',
            //     'constraint' => ['normal', 'alta', 'baixa'],
            //     'default'    => 'normal',
            //     'null'       => false,
            // ],
            'data_inici' => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'data_fi' => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'comprat' => [
                'type'           => 'TINYINT',
                'constraint'     => 0,
                'default'        => false,
            ],
            // 'comprat' => [
            //     'type'       => 'ENUM',
            //     'constraint' => ['no', 'si'],
            //     'default'    => 'no',
            //     'null'       => false,
            // ],
            // 'id_genere' => [
            //     'type'          => 'INT',
            //     'null'          => true,
            // ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => false,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        // $this->forge->addForeignKey('id_genere', 'generes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('llibres');
    }

    public function down()
    {
        $this->forge->dropTable('llibres');
    }
}
