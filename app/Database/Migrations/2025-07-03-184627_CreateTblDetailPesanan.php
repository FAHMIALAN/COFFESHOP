<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblDetailPesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pesanan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_produk' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jumlah' => ['type' => 'INT', 'constraint' => 11],
            'harga_satuan' => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->forge->addKey('id', true);
        // Jika ingin menambahkan foreign key (opsional tapi bagus)
        // $this->forge->addForeignKey('id_pesanan', 'tbl_pesanan', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_produk', 'tbl_produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_detail_pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_detail_pesanan');
    }
}