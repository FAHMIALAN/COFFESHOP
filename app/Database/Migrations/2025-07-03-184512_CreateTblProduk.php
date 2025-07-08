<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_produk' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'harga' => ['type' => 'INT', 'constraint' => 11],
            'gambar' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'kategori' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'stok' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at' => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_produk');
    }
}