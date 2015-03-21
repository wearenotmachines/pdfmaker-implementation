<?php

use Phinx\Migration\AbstractMigration;

class SetupBaseTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $projects = $this->table("projects");
        $projects->addColumn("title", "string")
                 ->addColumn("slug", "string")
                 ->addColumn("description", "text")
                 ->addColumn("created", "datetime")
                 ->addColumn("updated", "datetime")
                 ->save();
        $this->execute("CREATE FULLTEXT INDEX ft_projects ON projects (title, description)");


        $sections = $this->table("sections")
                      ->addColumn("project_id", "integer")
                      ->addColumn("display_order", "integer", array("signed"=>false, "default"=>9999))
                      ->addColumn("title", "string")
                      ->addColumn("slug", "string")
                      ->addColumn("description", "text")
                      ->addColumn("created", "datetime")
                      ->addColumn("updated", "datetime")
                      ->addForeignKey("project_id", "projects", "id", array("update"=>"cascade", "delete"=>"cascade"))
                      ->save();

        $documents = $this->table("documents")
                        ->addColumn("section_id", "integer")
                        ->addColumn("project_id", "integer")
                        ->addColumn("title", "string", array("null"=>true))
                        ->addColumn("slug", "string")
                        ->addColumn("description", "text", array("null"=>true))
                        ->addColumn("filename", "string")
                        ->addColumn("full_path", "string")
                        ->addColumn("checksum", "string")
                        ->addColumn("created", "datetime")
                        ->addColumn("updated", "datetime")
                        ->addColumn("display_order", "integer", array("signed"=>false))
                        ->addForeignKey("section_id", "sections", "id", array("update"=>"cascade", "delete"=>"cascade"))
                        ->addForeignKey("project_id", "projects", "id", array("update"=>"cascade", "delete"=>"cascade"))
                        ->addIndex("section_id")
                        ->addIndex("project_id")
                        ->addIndex("checksum")
                        ->addIndex("filename")
                        ->save();
        $this->execute("CREATE FULLTEXT INDEX ft_documents ON documents (title, description)");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable("documents");
        $this->dropTable("sections");
        $this->dropTable("projects");
    }
}