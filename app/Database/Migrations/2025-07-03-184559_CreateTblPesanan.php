<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblPesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id' => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'nama_pembeli' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'no_hp' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'alamat' => ['type' => 'TEXT'],
            'total_harga' => ['type' => 'INT', 'constraint' => 11],
            'status_pembayaran' => ['type' => 'ENUM', 'constraint' => ['pending', 'success', 'failed'], 'default' => 'pending'],
            'tipe_pembayaran' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'waktu_pesan' => ['type' => 'TIMESTAMP', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_pesanan');
    }
}