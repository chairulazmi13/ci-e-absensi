<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_lokasi extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id_lokasi' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nama_lokasi' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'alamat' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id_lokasi', TRUE);
                $this->dbforge->create_table('lokasi');
        }

        public function down()
        {
                $this->dbforge->drop_table('lokasi');
        }
}