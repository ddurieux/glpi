<?php

use Phinx\Migration\AbstractMigration;

class Glpi92 extends AbstractMigration {
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
   public function change() {

      if ($this->hasTable('glpi_config')) {
         return;
      }

      // create the table glpi_alerts
      $alert = $this->table('glpi_alert');
      $alert->addColumn('itemtype', 'string', array('limit' => 100))
            ->addColumn('items_id', 'integer', array('default' => 0))
            ->addColumn('type', 'integer', array('default' => 0, 'comment' => 'see define.php ALERT_* constant'))
            ->addColumn('date', 'datetime')
            ->addIndex(array('itemtype', 'items_id', 'type'), array('unique' => true))
            ->addIndex(array('type'))
            ->addIndex(array('date'))
            ->create();

      // create the table glpi_authldap
      $authldap = $this->table('glpi_authldap');
      $authldap->addColumn('name', 'string')
               ->addColumn('host', 'string')
               ->addColumn('basedn', 'string', array('default' => ''))
               ->addColumn('rootdn', 'string', array('default' => ''))
               ->addColumn('port', 'integer', array('default' => 389))
               ->addColumn('condition', 'text')
               ->addColumn('login_field', 'string', array('default' => 'uid'))
               ->addColumn('use_tls', 'boolean', array('default' => false))
               ->addColumn('group_field', 'string', array('default' => ''))
               ->addColumn('group_condition', 'text')
               ->addColumn('group_search_type', 'integer', array('default' => 0))
               ->addColumn('group_member_field', 'string', array('default' => ''))
               ->addColumn('email1_field', 'string', array('default' => ''))
               ->addColumn('realname_field', 'string', array('default' => ''))
               ->addColumn('firstname_field', 'string', array('default' => ''))
               ->addColumn('phone_field', 'string', array('default' => ''))
               ->addColumn('phone2_field', 'string', array('default' => ''))
               ->addColumn('mobile_field', 'string', array('default' => ''))
               ->addColumn('comment_field', 'string', array('default' => ''))
               ->addColumn('use_dn', 'boolean', array('default' => true))
               ->addColumn('time_offset', 'integer', array('default' => 0, 'comment' => 'in seconds'))
               ->addColumn('deref_option', 'integer', array('default' => 0))
               ->addColumn('title_field', 'string', array('default' => ''))
               ->addColumn('category_field', 'string', array('default' => ''))
               ->addColumn('language_field', 'string', array('default' => ''))
               ->addColumn('entity_field', 'string', array('default' => ''))
               ->addColumn('entity_condition', 'text')
               ->addColumn('is_default', 'boolean', array('default' => false))
               ->addColumn('is_active', 'boolean', array('default' => false))
               ->addColumn('rootdn_passwd', 'string', array('default' => ''))
               ->addColumn('registration_number_field', 'string', array('default' => ''))
               ->addColumn('email2_field', 'string', array('default' => ''))
               ->addColumn('email3_field', 'string', array('default' => ''))
               ->addColumn('email4_field', 'string', array('default' => ''))
               ->addColumn('location_field', 'string', array('default' => ''))
               ->addColumn('pagesize', 'integer', array('default' => 0))
               ->addColumn('ldap_maxlimit', 'integer', array('default' => 0))
               ->addColumn('can_support_pagesize', 'boolean', array('default' => false))
               ->addColumn('picture_field', 'string', array('default' => ''))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('is_default'))
               ->addIndex(array('is_active'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_authldapreplicate
      $authldapreplicate = $this->table('glpi_authldapreplicate');
      $authldapreplicate->addColumn('authldap_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('host', 'string')
                        ->addColumn('port', 'integer', array('default' => 389))
                        ->addColumn('name', 'string')
                        ->addForeignKey('authldap_id', 'glpi_authldap', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('authldap_id'))
                        ->create();

      // create the table glpi_authmail
      $authmail = $this->table('glpi_authmail');
      $authmail->addColumn('name', 'string')
               ->addColumn('connect_string', 'string', array('default' => ''))
               ->addColumn('host', 'string')
               ->addColumn('is_active', 'boolean', array('default' => false))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('is_active'))
               ->create();

      // create the table glpi_autoupdatesystem
      $autoupdatesystem = $this->table('glpi_autoupdatesystem');
      $autoupdatesystem->addColumn('name', 'string')
                       ->addColumn('comment', 'text')
                       ->addIndex(array('name'))
                       ->create();

      // create the table glpi_blacklistedmailcontent
      $blacklistedmailcontent = $this->table('glpi_blacklistedmailcontent');
      $blacklistedmailcontent->addColumn('name', 'string')
                             ->addColumn('content', 'text')
                             ->addColumn('comment', 'text')
                             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                             ->addIndex(array('date_mod'))
                             ->addIndex(array('date_creation'))
                             ->create();

      // create the table glpi_blacklist
      $blacklist = $this->table('glpi_blacklist');
      $blacklist->addColumn('type', 'integer', array('default' => 0))
                ->addColumn('name', 'string', array('default' => ''))
                ->addColumn('value', 'string', array('default' => ''))
                ->addColumn('comment', 'text')
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addIndex(array('type'))
                ->addIndex(array('name'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_budgettype
      $budgettype = $this->table('glpi_budgettype');
      $budgettype->addColumn('name', 'string')
                 ->addColumn('comment', 'text')
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addIndex(array('name'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_cartridgeitem
      $cartridgeitem = $this->table('glpi_cartridgeitem');
      $cartridgeitem->addColumn('name', 'string')
                    ->addColumn('comment', 'text')
                    ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                    ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                    ->addIndex(array('name'))
                    ->addIndex(array('date_mod'))
                    ->addIndex(array('date_creation'))
                    ->create();

      // create the table glpi_computermodel
      $computermodel = $this->table('glpi_computermodel');
      $computermodel->addColumn('name', 'string')
                    ->addColumn('comment', 'text')
                    ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                    ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                    ->addIndex(array('name'))
                    ->addIndex(array('date_mod'))
                    ->addIndex(array('date_creation'))
                    ->create();

      // create the table glpi_computertype
      $computertype = $this->table('glpi_computertype');
      $computertype->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('name'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_config
      $config = $this->table('glpi_config');
      $config->addColumn('context', 'string', array('limit' => 150))
             ->addColumn('name', 'string', array('limit' => 150))
             ->addColumn('value', 'text')
             ->addIndex(array('context', 'name'), array('unique' => true))
             ->create();

      // create the table glpi_consumableitemtype
      $consumableitemtype = $this->table('glpi_consumableitemtype');
      $consumableitemtype->addColumn('name', 'string')
                         ->addColumn('comment', 'text')
                         ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                         ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                         ->addIndex(array('name'))
                         ->addIndex(array('date_mod'))
                         ->addIndex(array('date_creation'))
                         ->create();

      // create the table glpi_contacttype
      $contacttype = $this->table('glpi_contacttype');
      $contacttype->addColumn('name', 'string')
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addIndex(array('name'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_contracttype
      $contracttype = $this->table('glpi_contracttype');
      $contracttype->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('name'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_crontask
      $crontask = $this->table('glpi_crontask');
      $crontask->addColumn('itemtype', 'string', array('limit' => 100))
               ->addColumn('name', 'string', array('limit' => 150, 'comment' => 'task name'))
               ->addColumn('frequency', 'integer', array('default' => 86400, 'comment' => 'second between launch'))
               ->addColumn('param', 'integer', array('null' => true, 'default' => null, 'comment' => 'task specify parameter'))
               ->addColumn('state', 'integer', array('default' => 1, 'comment' => '0:disabled, 1:waiting, 2:running'))
               ->addColumn('mode', 'integer', array('default' => 1, 'comment' => '1:internal, 2:external'))
               ->addColumn('allowmode', 'integer', array('default' => 3, 'comment' => '1:internal, 2:external, 3:both'))
               ->addColumn('hourmin', 'integer', array('default' => 0))
               ->addColumn('hourmax', 'integer', array('default' => 24))
               ->addColumn('logs_lifetime', 'integer', array('default' => 30, 'comment' => 'number of days'))
               ->addColumn('lastrun', 'datetime', array('null' => true, 'default' => null, 'comment' => 'last run date'))
               ->addColumn('lastcode', 'integer', array('null' => true, 'default' => null, 'comment' => 'last run return code'))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addIndex(array('itemtype', 'name'), array('unique' => true))
               ->addIndex(array('mode'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_devicecasetype
      $devicecasetype = $this->table('glpi_devicecasetype');
      $devicecasetype->addColumn('name', 'string')
                     ->addColumn('comment', 'text')
                     ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                     ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                     ->addIndex(array('name'))
                     ->addIndex(array('date_mod'))
                     ->addIndex(array('date_creation'))
                     ->create();

      // create the table glpi_devicememorytype
      $devicememorytype = $this->table('glpi_devicememorytype');
      $devicememorytype->addColumn('name', 'string')
                       ->addColumn('comment', 'text')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addIndex(array('name'))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_documentcategory
      $documentcategory = $this->table('glpi_documentcategory');
      $documentcategory->addColumn('name', 'string')
                       ->addColumn('comment', 'text')
                       ->addColumn('documentcategory_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('completename', 'text')
                       ->addColumn('level', 'integer', array('default' => 0))
                       ->addColumn('ancestors_cache', 'text')
                       ->addColumn('sons_cache', 'text')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addForeignKey('documentcategory_id', 'glpi_documentcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('name'))
                       ->addIndex(array('documentcategory_id', 'name'), array('unique' => true))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_documenttype
      $documenttype = $this->table('glpi_documenttype');
      $documenttype->addColumn('name', 'string')
                   ->addColumn('ext', 'string')
                   ->addColumn('icon', 'string', array('default' => ''))
                   ->addColumn('mime', 'string', array('default' => ''))
                   ->addColumn('is_uploadable', 'boolean', array('default' => true))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('ext'), array('unique' => true))
                   ->addIndex(array('name'))
                   ->addIndex(array('is_uploadable'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_dropdowntranslation
      $dropdowntranslation = $this->table('glpi_dropdowntranslation');
      $dropdowntranslation->addColumn('items_id', 'integer')
                          ->addColumn('itemtype', 'string', array('limit' => 100, 'null' => true))
                          ->addColumn('language', 'string', array('limit' => 5, 'null' => true))
                          ->addColumn('field', 'string', array('limit' => 100, 'null' => true))
                          ->addColumn('value', 'text')
                          ->addColumn('comment', 'text')
                          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                          ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                          ->addIndex(array('itemtype', 'items_id', 'language', 'field'), array('unique' => true))
                          ->addIndex(array('itemtype', 'items_id'))
                          ->addIndex(array('language'))
                          ->addIndex(array('field'))
                          ->create();

      // create the table glpi_event
      $event = $this->table('glpi_event');
      $event->addColumn('items_id', 'integer')
            ->addColumn('type', 'string')
            ->addColumn('date', 'datetime')
            ->addColumn('service', 'string')
            ->addColumn('level', 'integer', array('default' => 0))
            ->addColumn('message', 'text')
            ->addIndex(array('date'))
            ->addIndex(array('level'))
            ->addIndex(array('type', 'items_id'))
            ->create();

      // create the table glpi_filesystem
      $filesystem = $this->table('glpi_filesystem');
      $filesystem->addColumn('name', 'string')
                 ->addColumn('comment', 'text')
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addIndex(array('name'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_interfacetype
      $interfacetype = $this->table('glpi_interfacetype');
      $interfacetype->addColumn('name', 'string')
                    ->addColumn('comment', 'text')
                    ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                    ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                    ->addIndex(array('name'))
                    ->addIndex(array('date_mod'))
                    ->addIndex(array('date_creation'))
                    ->create();

      // create the table glpi_log
      $log = $this->table('glpi_log');
      $log->addColumn('itemtype', 'string', array('limit' => 100))
          ->addColumn('items_id', 'integer')
          ->addColumn('itemtype_link', 'string', array('limit' => 100, 'default' => ''))
          ->addColumn('linked_action', 'integer', array('default' => 0, 'comment' => 'see define.php HISTORY_* constant'))
          ->addColumn('user_name', 'string')
          ->addColumn('id_search_option', 'integer', array('default' => 0, 'comment' => 'see search.constant.php for value'))
          ->addColumn('old_value', 'string', array('null' => true))
          ->addColumn('new_value', 'string', array('null' => true))
          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
          ->addIndex(array('date_mod'))
          ->addIndex(array('itemtype_link'))
          ->addIndex(array('itemtype', 'items_id'))
          ->create();

      // create the table glpi_mailcollector
      $mailcollector = $this->table('glpi_mailcollector');
      $mailcollector->addColumn('name', 'string')
                    ->addColumn('host', 'string')
                    ->addColumn('login', 'string', array('null' => true))
                    ->addColumn('filesize_max', 'integer', array('default' => 2097152))
                    ->addColumn('is_active', 'boolean', array('default' => true))
                    ->addColumn('passwd', 'string', array('null' => true))
                    ->addColumn('accepted', 'string', array('null' => true))
                    ->addColumn('refused', 'string', array('null' => true))
                    ->addColumn('use_kerberos', 'boolean', array('default' => false))
                    ->addColumn('errors', 'integer', array('default' => 0))
                    ->addColumn('use_mail_date', 'boolean', array('default' => false))
                    ->addColumn('comment', 'text')
                    ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                    ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                    ->addIndex(array('is_active'))
                    ->addIndex(array('date_mod'))
                    ->addIndex(array('date_creation'))
                    ->create();

      // create the table glpi_manufacturer
      $manufacturer = $this->table('glpi_manufacturer');
      $manufacturer->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('name'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_monitormodel
      $monitormodel = $this->table('glpi_monitormodel');
      $monitormodel->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('name'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_monitortype
      $monitortype = $this->table('glpi_monitortype');
      $monitortype->addColumn('name', 'string')
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addIndex(array('name'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_networkequipmentfirmware
      $networkequipmentfirmware = $this->table('glpi_networkequipmentfirmware');
      $networkequipmentfirmware->addColumn('name', 'string')
                               ->addColumn('comment', 'text')
                               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                               ->addIndex(array('name'))
                               ->addIndex(array('date_mod'))
                               ->addIndex(array('date_creation'))
                               ->create();

      // create the table glpi_networkequipmentmodel
      $networkequipmentmodel = $this->table('glpi_networkequipmentmodel');
      $networkequipmentmodel->addColumn('name', 'string')
                            ->addColumn('comment', 'text')
                            ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                            ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                            ->addIndex(array('name'))
                            ->addIndex(array('date_mod'))
                            ->addIndex(array('date_creation'))
                            ->create();

      // create the table glpi_networkequipmenttype
      $networkequipmenttype = $this->table('glpi_networkequipmenttype');
      $networkequipmenttype->addColumn('name', 'string')
                           ->addColumn('comment', 'text')
                           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                           ->addIndex(array('name'))
                           ->addIndex(array('date_mod'))
                           ->addIndex(array('date_creation'))
                           ->create();

      // create the table glpi_networkinterface
      $networkinterface = $this->table('glpi_networkinterface');
      $networkinterface->addColumn('name', 'string')
                       ->addColumn('comment', 'text')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addIndex(array('name'))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_network
      $network = $this->table('glpi_network');
      $network->addColumn('name', 'string')
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addIndex(array('name'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_notificationtemplate
      $notificationtemplate = $this->table('glpi_notificationtemplate');
      $notificationtemplate->addColumn('name', 'string')
                           ->addColumn('itemtype', 'string', array('limit' => 100))
                           ->addColumn('css', 'text')
                           ->addColumn('comment', 'text')
                           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                           ->addIndex(array('name'))
                           ->addIndex(array('itemtype'))
                           ->addIndex(array('date_mod'))
                           ->addIndex(array('date_creation'))
                           ->create();

      // create the table glpi_notificationtemplatetranslation
      $notificationtemplatetranslation = $this->table('glpi_notificationtemplatetranslation');
      $notificationtemplatetranslation->addColumn('notificationtemplate_id', 'integer')
                                      ->addColumn('language', 'string', array('limit' => 5, 'default' => ''))
                                      ->addColumn('subject', 'string')
                                      ->addColumn('content_text', 'text')
                                      ->addColumn('content_html', 'text')
                                      ->addForeignKey('notificationtemplate_id', 'glpi_notificationtemplate', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                                      ->addIndex(array('notificationtemplate_id'))
                                      ->create();

      // create the table glpi_operatingsystemarchitecture
      $operatingsystemarchitecture = $this->table('glpi_operatingsystemarchitecture');
      $operatingsystemarchitecture->addColumn('name', 'string')
                                  ->addColumn('comment', 'text')
                                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                                  ->addIndex(array('name'))
                                  ->addIndex(array('date_mod'))
                                  ->addIndex(array('date_creation'))
                                  ->create();

      // create the table glpi_operatingsystem
      $operatingsystem = $this->table('glpi_operatingsystem');
      $operatingsystem->addColumn('name', 'string')
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addIndex(array('name'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_operatingsystemservicepack
      $operatingsystemservicepack = $this->table('glpi_operatingsystemservicepack');
      $operatingsystemservicepack->addColumn('name', 'string')
                                 ->addColumn('comment', 'text')
                                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                                 ->addIndex(array('name'))
                                 ->addIndex(array('date_mod'))
                                 ->addIndex(array('date_creation'))
                                 ->create();

      // create the table glpi_operatingsystemversion
      $operatingsystemversion = $this->table('glpi_operatingsystemversion');
      $operatingsystemversion->addColumn('name', 'string')
                             ->addColumn('comment', 'text')
                             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                             ->addIndex(array('name'))
                             ->addIndex(array('date_mod'))
                             ->addIndex(array('date_creation'))
                             ->create();

      // create the table glpi_peripheralmodel
      $peripheralmodel = $this->table('glpi_peripheralmodel');
      $peripheralmodel->addColumn('name', 'string')
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addIndex(array('name'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_peripheraltype
      $peripheraltype = $this->table('glpi_peripheraltype');
      $peripheraltype->addColumn('name', 'string')
                     ->addColumn('comment', 'text')
                     ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                     ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                     ->addIndex(array('name'))
                     ->addIndex(array('date_mod'))
                     ->addIndex(array('date_creation'))
                     ->create();

      // create the table glpi_phonemodel
      $phonemodel = $this->table('glpi_phonemodel');
      $phonemodel->addColumn('name', 'string')
                 ->addColumn('comment', 'text')
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addIndex(array('name'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_phonepowersupply
      $phonepowersupply = $this->table('glpi_phonepowersupply');
      $phonepowersupply->addColumn('name', 'string')
                       ->addColumn('comment', 'text')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addIndex(array('name'))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_phonetype
      $phonetype = $this->table('glpi_phonetype');
      $phonetype->addColumn('name', 'string')
                ->addColumn('comment', 'text')
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addIndex(array('name'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_plugin
      $plugin = $this->table('glpi_plugin');
      $plugin->addColumn('directory', 'string')
             ->addColumn('name', 'string')
             ->addColumn('version', 'string')
             ->addColumn('state', 'integer', array('default' => 0, 'comment' => 'see define.php PLUGIN_* constant'))
             ->addColumn('author', 'string', array('default' => ''))
             ->addColumn('homepage', 'string', array('default' => ''))
             ->addColumn('license', 'string', array('default' => ''))
             ->addIndex(array('directory'), array('unique' => true))
             ->addIndex(array('state'))
             ->create();

      // create the table glpi_printermodel
      $printermodel = $this->table('glpi_printermodel');
      $printermodel->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('name'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_printertype
      $printertype = $this->table('glpi_printertype');
      $printertype->addColumn('name', 'string')
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addIndex(array('name'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_cartridgeitemtype
      $cartridgeitemtype = $this->table('glpi_cartridgeitemtype');
      $cartridgeitemtype->addColumn('name', 'string')
                        ->addColumn('comment', 'text')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addIndex(array('name'))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();


      // create the table glpi_projectstate
      $projectstate = $this->table('glpi_projectstate');
      $projectstate->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('color', 'string', array('default' => ''))
                   ->addColumn('is_finished', 'boolean', array('default' => false))
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('name'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_projecttasktype
      $projecttasktype = $this->table('glpi_projecttasktype');
      $projecttasktype->addColumn('name', 'string')
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addIndex(array('name'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_projecttype
      $projecttype = $this->table('glpi_projecttype');
      $projecttype->addColumn('name', 'string')
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addIndex(array('name'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_registeredid
      $registeredid = $this->table('glpi_registeredid');
      $registeredid->addColumn('name', 'string')
                   ->addColumn('items_id', 'integer', array('default' => 0))
                   ->addColumn('itemtype', 'string', array('limit' => 100))
                   ->addColumn('device_type', 'string', array('limit' => 100, 'comment' => 'USB, PCI ...'))
                   ->addIndex(array('name'))
                   ->addIndex(array('items_id', 'itemtype'))
                   ->addIndex(array('device_type'))
                   ->create();

      // create the table glpi_requesttype
      $requesttype = $this->table('glpi_requesttype');
      $requesttype->addColumn('name', 'string')
                  ->addColumn('is_helpdesk_default', 'boolean', array('default' => false))
                  ->addColumn('is_followup_default', 'boolean', array('default' => false))
                  ->addColumn('is_mail_default', 'boolean', array('default' => false))
                  ->addColumn('is_mailfollowup_default', 'boolean', array('default' => false))
                  ->addColumn('is_active', 'boolean', array('default' => true))
                  ->addColumn('is_ticketheader', 'boolean', array('default' => true))
                  ->addColumn('is_ticketfollowup', 'boolean', array('default' => true))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addIndex(array('name'))
                  ->addIndex(array('is_helpdesk_default'))
                  ->addIndex(array('is_followup_default'))
                  ->addIndex(array('is_mail_default'))
                  ->addIndex(array('is_mailfollowup_default'))
                  ->addIndex(array('is_active'))
                  ->addIndex(array('is_ticketheader'))
                  ->addIndex(array('is_ticketfollowup'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_rulerightparameter
      $rulerightparameter = $this->table('glpi_rulerightparameter');
      $rulerightparameter->addColumn('name', 'string')
                         ->addColumn('value', 'string')
                         ->addColumn('comment', 'text')
                         ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                         ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                         ->addIndex(array('date_mod'))
                         ->addIndex(array('date_creation'))
                         ->create();

      // create the table glpi_softwarecategory
      $softwarecategorie = $this->table('glpi_softwarecategory');
      $softwarecategorie->addColumn('name', 'string')
                        ->addColumn('softwarecategory_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('completename', 'text')
                        ->addColumn('level', 'integer', array('default' => 0))
                        ->addColumn('ancestors_cache', 'text')
                        ->addColumn('sons_cache', 'text')
                        ->addColumn('comment', 'text')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('softwarecategory_id', 'glpi_softwarecategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('softwarecategory_id'))
                        ->create();

      // create the table glpi_softwarelicensetype
      $softwarelicensetype = $this->table('glpi_softwarelicensetype');
      $softwarelicensetype->addColumn('name', 'string')
                          ->addColumn('comment', 'text')
                          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                          ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                          ->addIndex(array('name'))
                          ->addIndex(array('date_mod'))
                          ->addIndex(array('date_creation'))
                          ->create();

      // create the table glpi_ssovariable
      $ssovariable = $this->table('glpi_ssovariable');
      $ssovariable->addColumn('name', 'string')
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_suppliertype
      $suppliertype = $this->table('glpi_suppliertype');
      $suppliertype->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_usercategory
      $usercategory = $this->table('glpi_usercategory');
      $usercategory->addColumn('name', 'string')
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_usertitle
      $usertitle = $this->table('glpi_usertitle');
      $usertitle->addColumn('name', 'string')
                ->addColumn('comment', 'text')
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_virtualmachinestate
      $virtualmachinestate = $this->table('glpi_virtualmachinestate');
      $virtualmachinestate->addColumn('name', 'string')
                          ->addColumn('comment', 'text')
                          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                          ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                          ->addIndex(array('date_mod'))
                          ->addIndex(array('date_creation'))
                          ->create();

      // create the table glpi_virtualmachinesystem
      $virtualmachinesystem = $this->table('glpi_virtualmachinesystem');
      $virtualmachinesystem->addColumn('name', 'string')
                           ->addColumn('comment', 'text')
                           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                           ->addIndex(array('date_mod'))
                           ->addIndex(array('date_creation'))
                           ->create();

      // create the table glpi_virtualmachinetype
      $virtualmachinetype = $this->table('glpi_virtualmachinetype');
      $virtualmachinetype->addColumn('name', 'string')
                         ->addColumn('comment', 'text')
                         ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                         ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                         ->addIndex(array('date_mod'))
                         ->addIndex(array('date_creation'))
                         ->create();

      // create the table glpi_entity
      $entity = $this->table('glpi_entity');
      $entity->addColumn('name', 'string')
             ->addColumn('entity_id', 'integer', array('null' => true, 'default' => null))
             ->addColumn('completename', 'text')
             ->addColumn('level', 'integer', array('default' => 0))
             ->addColumn('ancestors_cache', 'text')
             ->addColumn('sons_cache', 'text')
             ->addColumn('address', 'text')
             ->addColumn('postcode', 'string', array('default' => ''))
             ->addColumn('town', 'string', array('default' => ''))
             ->addColumn('state', 'string', array('default' => ''))
             ->addColumn('country', 'string', array('default' => ''))
             ->addColumn('website', 'string', array('default' => ''))
             ->addColumn('phonenumber', 'string', array('default' => ''))
             ->addColumn('fax', 'string', array('default' => ''))
             ->addColumn('email', 'string', array('default' => ''))
             ->addColumn('admin_email', 'string', array('default' => ''))
             ->addColumn('admin_email_name', 'string', array('default' => ''))
             ->addColumn('admin_reply', 'string', array('default' => ''))
             ->addColumn('admin_reply_name', 'string', array('default' => ''))
             ->addColumn('notification_subject_tag', 'string', array('default' => ''))
             ->addColumn('ldap_dn', 'string', array('default' => ''))
             ->addColumn('tag', 'string', array('default' => ''))
             ->addColumn('authldap_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('mail_domain', 'string', array('default' => ''))
             ->addColumn('entity_ldapfilter', 'text')
             ->addColumn('mailing_signature', 'text')
             ->addColumn('cartridges_alert_repeat', 'integer', array('default' => -2))
             ->addColumn('consumables_alert_repeat', 'integer', array('default' => -2))
             ->addColumn('use_licenses_alert', 'integer', array('default' => -2))
             ->addColumn('send_licenses_alert_before_delay', 'integer', array('default' => -2))
             ->addColumn('use_contracts_alert', 'integer', array('default' => -2))
             ->addColumn('send_contracts_alert_before_delay', 'integer', array('default' => -2))
             ->addColumn('use_infocoms_alert', 'integer', array('default' => -2))
             ->addColumn('send_infocoms_alert_before_delay', 'integer', array('default' => -2))
             ->addColumn('use_reservations_alert', 'integer', array('default' => -2))
             ->addColumn('autoclose_delay', 'integer', array('default' => -2))
             ->addColumn('notclosed_delay', 'integer', array('default' => -2))
             ->addColumn('calendar_id', 'integer', array('default' => -2))
             ->addColumn('auto_assign_mode', 'integer', array('default' => -2))
             ->addColumn('tickettype', 'integer', array('default' => -2))
             ->addColumn('max_closedate', 'datetime', array('null' => true, 'default' => null))
             ->addColumn('inquest_config', 'integer', array('default' => -2))
             ->addColumn('inquest_rate', 'integer', array('default' => 0))
             ->addColumn('inquest_delay', 'integer', array('default' => -10))
             ->addColumn('inquest_URL', 'string', array('null' => true))
             ->addColumn('autofill_warranty_date', 'string', array('default' => '-2'))
             ->addColumn('autofill_use_date', 'string', array('default' => '-2'))
             ->addColumn('autofill_buy_date', 'string', array('default' => '-2'))
             ->addColumn('autofill_delivery_date', 'string', array('default' => '-2'))
             ->addColumn('autofill_order_date', 'string', array('default' => '-2'))
             ->addColumn('tickettemplate_id', 'integer', array('default' => -2))
             ->addColumn('entity_id_software', 'integer', array('default' => -2))
             ->addColumn('default_contract_alert', 'integer', array('default' => -2))
             ->addColumn('default_infocom_alert', 'integer', array('default' => -2))
             ->addColumn('default_cartridges_alarm_threshold', 'integer', array('default' => -2))
             ->addColumn('default_consumables_alarm_threshold', 'integer', array('default' => -2))
             ->addColumn('delay_send_emails', 'integer', array('default' => -2))
             ->addColumn('is_notif_enable_default', 'integer', array('default' => -2))
             ->addColumn('inquest_duration', 'integer', array('default' => 0))
             ->addColumn('autofill_decommission_date', 'string', array('default' => '-2'))
             ->addColumn('comment', 'text')
             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
             ->addForeignKey('authldap_id', 'glpi_authldap', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addIndex(array('entity_id', 'name'), array('unique' => true))
             ->addIndex(array('entity_id'))
             ->addIndex(array('date_mod'))
             ->addIndex(array('date_creation'))
             ->create();

      // create the table glpi_apiclient
      $apiclient = $this->table('glpi_apiclient');
      $apiclient->addColumn('name', 'string')
                ->addColumn('entity_id', 'integer')
                ->addColumn('is_recursive', 'boolean', array('default' => false))
                ->addColumn('is_active', 'boolean', array('default' => false))
                ->addColumn('ipv4_range_start', 'biginteger', array('null' => true, 'default' => null))
                ->addColumn('ipv4_range_end', 'biginteger', array('null' => true, 'default' => null))
                ->addColumn('ipv6', 'string', array('null' => true, 'default' => null))
                ->addColumn('app_token', 'string', array('null' => true, 'default' => null))
                ->addColumn('app_token_date', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('dolog_method', 'boolean', array('default' => false))
                ->addColumn('comment', 'text')
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                ->addIndex(array('is_active'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_calendar
      $calendar = $this->table('glpi_calendar');
      $calendar->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('cache_duration', 'text')
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('is_recursive'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_calendarsegment
      $calendarsegment = $this->table('glpi_calendarsegment');
      $calendarsegment->addColumn('calendar_id', 'integer')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('day', 'integer', array('limit' => 1, 'default' => 1, 'comment' => 'numer of the day based on date(w)'))
                      ->addColumn('begin_hour', 'time')
                      ->addColumn('end_hour', 'time')
                      ->addForeignKey('calendar_id', 'glpi_calendar', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('calendar_id'))
                      ->addIndex(array('day'))
                      ->create();

      // create the table glpi_cartridgeitem_printermodel
      $cartridgeitem_printermodel = $this->table('glpi_cartridgeitem_printermodel');
      $cartridgeitem_printermodel->addColumn('cartridgeitem_id', 'integer')
                                 ->addColumn('printermodel_id', 'integer')
                                 ->addForeignKey('cartridgeitem_id', 'glpi_cartridgeitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                                 ->addForeignKey('printermodel_id', 'glpi_printermodel', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                                 ->addIndex(array('printermodel_id', 'cartridgeitem_id'), array('unique' => true))
                                 ->addIndex(array('cartridgeitem_id'))
                                 ->create();

      // create the table glpi_contact
      $contact = $this->table('glpi_contact');
      $contact->addColumn('name', 'string')
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('firstname', 'string', array('default' => ''))
              ->addColumn('phone', 'string', array('default' => ''))
              ->addColumn('phone2', 'string', array('default' => ''))
              ->addColumn('mobile', 'string', array('default' => ''))
              ->addColumn('fax', 'string', array('default' => ''))
              ->addColumn('email', 'string', array('default' => ''))
              ->addColumn('contacttype_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('is_deleted', 'boolean', array('default' => false))
              ->addColumn('usertitle_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('address', 'text')
              ->addColumn('postcode', 'string', array('default' => ''))
              ->addColumn('town', 'string', array('default' => ''))
              ->addColumn('state', 'string', array('default' => ''))
              ->addColumn('country', 'string', array('default' => ''))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addForeignKey('contacttype_id', 'glpi_contacttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('usertitle_id', 'glpi_usertitle', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('entity_id'))
              ->addIndex(array('contacttype_id'))
              ->addIndex(array('is_deleted'))
              ->addIndex(array('usertitle_id'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_contract
      $contract = $this->table('glpi_contract');
      $contract->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('num', 'string', array('default' => ''))
               ->addColumn('contracttype_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('begin_date', 'date', array('null' => true))
               ->addColumn('duration', 'integer', array('default' => 0))
               ->addColumn('notice', 'integer', array('default' => 0))
               ->addColumn('periodicity', 'integer', array('default' => 0))
               ->addColumn('billing', 'integer', array('default' => 0))
               ->addColumn('accounting_number', 'string', array('default' => ''))
               ->addColumn('is_deleted', 'boolean', array('default' => false))
               ->addColumn('week_begin_hour', 'time', array('default' => '00:00:00'))
               ->addColumn('week_end_hour', 'time', array('default' => '00:00:00'))
               ->addColumn('saturday_begin_hour', 'time', array('default' => '00:00:00'))
               ->addColumn('saturday_end_hour', 'time', array('default' => '00:00:00'))
               ->addColumn('use_saturday', 'boolean', array('default' => false))
               ->addColumn('monday_begin_hour', 'time', array('default' => '00:00:00'))
               ->addColumn('monday_end_hour', 'time', array('default' => '00:00:00'))
               ->addColumn('use_monday', 'boolean', array('default' => false))
               ->addColumn('max_links_allowed', 'integer', array('default' => 0))
               ->addColumn('alert', 'integer', array('default' => 0))
               ->addColumn('renewal', 'integer', array('default' => 0))
               ->addColumn('template_name', 'string', array('default' => ''))
               ->addColumn('is_template', 'boolean', array('default' => false))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('contracttype_id', 'glpi_contracttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('begin_date'))
               ->addIndex(array('name'))
               ->addIndex(array('contracttype_id'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('is_deleted'))
               ->addIndex(array('use_monday'))
               ->addIndex(array('use_saturday'))
               ->addIndex(array('alert'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_contract_item
      $contract_item = $this->table('glpi_contract_item');
      $contract_item->addColumn('contract_id', 'integer')
                    ->addColumn('items_id', 'integer', array('default' => 0))
                    ->addColumn('itemtype', 'string', array('limit' => 100))
                    ->addForeignKey('contract_id', 'glpi_contract', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('contract_id', 'itemtype', 'items_id'), array('unique' => true))
                    ->addIndex(array('items_id', 'itemtype'))
                    ->addIndex(array('itemtype', 'items_id'))
                    ->create();

      // create the table glpi_crontasklog
      $crontasklog = $this->table('glpi_crontasklog');
      $crontasklog->addColumn('crontask_id', 'integer')
                  ->addColumn('crontasklog_id', 'integer', array('default' => null, 'null' => true, 'comment' => "id of 'start' event"))
                  ->addColumn('date', 'datetime')
                  ->addColumn('state', 'integer', array('comment' => '0:start, 1:run, 2:stop'))
                  ->addColumn('elapsed', 'float', array('comment' => 'time elapsed since start'))
                  ->addColumn('volume', 'integer', array('comment' => 'for statistics'))
                  ->addColumn('content', 'string', array('comment' => 'message'))
                  ->addForeignKey('crontask_id', 'glpi_crontask', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('crontasklog_id', 'glpi_crontasklog', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('date'))
                  ->addIndex(array('crontask_id'))
                  ->addIndex(array('crontasklog_id', 'state'))
                  ->create();

      // create the table glpi_domain
      $domain = $this->table('glpi_domain');
      $domain->addColumn('name', 'string')
             ->addColumn('entity_id', 'integer')
             ->addColumn('is_recursive', 'boolean', array('default' => false))
             ->addColumn('comment', 'text')
             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
             ->addIndex(array('name'))
             ->addIndex(array('date_mod'))
             ->addIndex(array('date_creation'))
             ->create();

      // create the table glpi_fieldblacklist
      $fieldblacklist = $this->table('glpi_fieldblacklist');
      $fieldblacklist->addColumn('name', 'string')
                     ->addColumn('field', 'string')
                     ->addColumn('value', 'string')
                     ->addColumn('itemtype', 'string', array('limit' => 100, 'null' => true, 'default' => ''))
                     ->addColumn('entity_id', 'integer')
                     ->addColumn('is_recursive', 'boolean', array('default' => false))
                     ->addColumn('comment', 'text')
                     ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                     ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                     ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('name'))
                     ->addIndex(array('date_mod'))
                     ->addIndex(array('date_creation'))
                     ->create();

      // create the table glpi_fieldunicity
      $fieldunicity = $this->table('glpi_fieldunicity');
      $fieldunicity->addColumn('name', 'string')
                   ->addColumn('itemtype', 'string', array('limit' => 100, 'default' => ''))
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('fields', 'text')
                   ->addColumn('is_active', 'boolean', array('default' => false))
                   ->addColumn('action_refuse', 'boolean', array('default' => false))
                   ->addColumn('action_notify', 'boolean', array('default' => false))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_fqdn
      $fqdn = $this->table('glpi_fqdn');
      $fqdn->addColumn('name', 'string')
           ->addColumn('entity_id', 'integer')
           ->addColumn('is_recursive', 'boolean', array('default' => false))
           ->addColumn('fqdn', 'string', array('default' => ''))
           ->addColumn('comment', 'text')
           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
           ->addIndex(array('entity_id'))
           ->addIndex(array('name'))
           ->addIndex(array('fqdn'))
           ->addIndex(array('is_recursive'))
           ->addIndex(array('date_mod'))
           ->addIndex(array('date_creation'))
           ->create();

      // create the table glpi_group
      $group = $this->table('glpi_group');
      $group->addColumn('name', 'string')
            ->addColumn('entity_id', 'integer')
            ->addColumn('is_recursive', 'boolean', array('default' => false))
            ->addColumn('ldap_field', 'string', array('default' => ''))
            ->addColumn('ldap_value', 'text')
            ->addColumn('ldap_group_dn', 'text')
            ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('completename', 'text')
            ->addColumn('level', 'integer', array('default' => 0))
            ->addColumn('ancestors_cache', 'text')
            ->addColumn('sons_cache', 'text')
            ->addColumn('is_requester', 'boolean', array('default' => true))
            ->addColumn('is_assign', 'boolean', array('default' => true))
            ->addColumn('is_notify', 'boolean', array('default' => true))
            ->addColumn('is_itemgroup', 'boolean', array('default' => true))
            ->addColumn('is_usergroup', 'boolean', array('default' => true))
            ->addColumn('is_manager', 'boolean', array('default' => true))
            ->addColumn('comment', 'text')
            ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
            ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addIndex(array('name'))
            ->addIndex(array('ldap_field'))
            ->addIndex(array('entity_id'))
            ->addIndex(array('group_id'))
            ->addIndex(array('is_requester'))
            ->addIndex(array('is_assign'))
            ->addIndex(array('is_notify'))
            ->addIndex(array('is_itemgroup'))
            ->addIndex(array('is_usergroup'))
            ->addIndex(array('is_manager'))
            ->addIndex(array('date_mod'))
            ->addIndex(array('date_creation'))
            ->create();

      // create the table glpi_holiday
      $holiday = $this->table('glpi_holiday');
      $holiday->addColumn('name', 'string')
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('begin_date', 'date')
              ->addColumn('end_date', 'date')
              ->addColumn('is_perpetual', 'boolean', array('default' => false))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('begin_date'))
              ->addIndex(array('end_date'))
              ->addIndex(array('is_perpetual'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_ipaddress
      $ipaddress = $this->table('glpi_ipaddress');
      $ipaddress->addColumn('name', 'string')
                ->addColumn('entity_id', 'integer')
                ->addColumn('items_id', 'integer', array('default' => 0))
                ->addColumn('itemtype', 'string', array('limit' => 100))
                ->addColumn('version', 'integer', array('limit' => 3, 'default' => 0))
                ->addColumn('binary_0', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('binary_1', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('binary_2', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('binary_3', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('is_deleted', 'boolean', array('default' => false))
                ->addColumn('is_dynamic', 'boolean', array('default' => false))
                ->addColumn('mainitems_id', 'integer', array('default' => 0))
                ->addColumn('mainitemtype', 'string', array('limit' => 100))
                ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                ->addIndex(array('name'))
                ->addIndex(array('entity_id'))
                ->addIndex(array('binary_0', 'binary_1', 'binary_2', 'binary_3'))
                ->addIndex(array('is_deleted'))
                ->addIndex(array('is_dynamic'))
                ->addIndex(array('itemtype', 'items_id', 'is_deleted'))
                ->addIndex(array('mainitemtype', 'mainitems_id', 'is_deleted'))
                ->create();

      // create the table glpi_ipnetwork
      $ipnetwork = $this->table('glpi_ipnetwork');
      $ipnetwork->addColumn('name', 'string')
                ->addColumn('entity_id', 'integer')
                ->addColumn('is_recursive', 'boolean', array('default' => false))
                ->addColumn('completename', 'text')
                ->addColumn('ipnetwork_id', 'integer', array('default' => null, 'null' => true))
                ->addColumn('level', 'integer', array('default' => 0))
                ->addColumn('ancestors_cache', 'text')
                ->addColumn('sons_cache', 'text')
                ->addColumn('addressable', 'boolean', array('default' => false))
                ->addColumn('version', 'integer', array('limit' => 3, 'default' => 0))
                ->addColumn('address', 'string', array('limit' => 40, 'default' => ''))
                ->addColumn('address_0', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('address_1', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('address_2', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('address_3', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('netmask', 'string', array('limit' => 40, 'default' => ''))
                ->addColumn('netmask_0', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('netmask_1', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('netmask_2', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('netmask_3', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('gateway', 'string', array('limit' => 40, 'default' => ''))
                ->addColumn('gateway_0', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('gateway_1', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('gateway_2', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('gateway_3', 'integer', array('limit' => 10, 'default' => 0))
                ->addColumn('comment', 'text')
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                ->addForeignKey('ipnetwork_id', 'glpi_ipnetwork', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                ->addIndex(array('entity_id', 'address', 'netmask'))
                ->addIndex(array('address_0', 'address_1', 'address_2', 'address_3'))
                ->addIndex(array('netmask_0', 'netmask_1', 'netmask_2', 'netmask_3'))
                ->addIndex(array('gateway_0', 'gateway_1', 'gateway_2', 'gateway_3'))
                ->addIndex(array('name'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_knowbaseitemcategory
      $knowbaseitemcategory = $this->table('glpi_knowbaseitemcategory');
      $knowbaseitemcategory->addColumn('name', 'string')
                           ->addColumn('entity_id', 'integer')
                           ->addColumn('is_recursive', 'boolean', array('default' => false))
                           ->addColumn('completename', 'text')
                           ->addColumn('knowbaseitemcategory_id', 'integer', array('default' => null, 'null' => true))
                           ->addColumn('level', 'integer', array('default' => 0))
                           ->addColumn('ancestors_cache', 'text')
                           ->addColumn('sons_cache', 'text')
                           ->addColumn('comment', 'text')
                           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addForeignKey('knowbaseitemcategory_id', 'glpi_knowbaseitemcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                           ->addIndex(array('entity_id', 'knowbaseitemcategory_id', 'name'), array('unique' => true))
                           ->addIndex(array('name'))
                           ->addIndex(array('entity_id'))
                           ->addIndex(array('is_recursive'))
                           ->addIndex(array('date_mod'))
                           ->addIndex(array('date_creation'))
                           ->create();

      // create the table glpi_link
      $link = $this->table('glpi_link');
      $link->addColumn('name', 'string')
           ->addColumn('entity_id', 'integer')
           ->addColumn('is_recursive', 'boolean', array('default' => false))
           ->addColumn('link', 'string', array('default' => ''))
           ->addColumn('data', 'text')
           ->addColumn('open_window', 'boolean', array('default' => true))
           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
           ->addIndex(array('entity_id'))
           ->addIndex(array('date_mod'))
           ->addIndex(array('date_creation'))
           ->create();

      // create the table glpi_link_itemtype
      $link_itemtype = $this->table('glpi_link_itemtype');
      $link_itemtype->addColumn('link_id', 'integer')
                    ->addColumn('itemtype', 'string', array('limit' => 100))
                    ->addForeignKey('link_id', 'glpi_link', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('itemtype', 'link_id'), array('unique' => true))
                    ->addIndex(array('link_id'))
                    ->create();

      // create the table glpi_location
      $location = $this->table('glpi_location');
      $location->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('completename', 'text')
               ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('level', 'integer', array('default' => 0))
               ->addColumn('ancestors_cache', 'text')
               ->addColumn('sons_cache', 'text')
               ->addColumn('building', 'string', array('default' => ''))
               ->addColumn('room', 'string', array('default' => ''))
               ->addColumn('latitude', 'string', array('default' => ''))
               ->addColumn('longitude', 'string', array('default' => ''))
               ->addColumn('altitude', 'string', array('default' => ''))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('entity_id', 'location_id', 'name'), array('unique' => true))
               ->addIndex(array('location_id'))
               ->addIndex(array('name'))
               ->addIndex(array('is_recursive'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_netpoint
      $netpoint = $this->table('glpi_netpoint');
      $netpoint->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('entity_id', 'location_id', 'name'))
               ->addIndex(array('location_id', 'name'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_networkname
      $networkname = $this->table('glpi_networkname');
      $networkname->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('items_id', 'integer', array('default' => 0))
                  ->addColumn('itemtype', 'string', array('limit' => 100))
                  ->addColumn('fqdn_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('is_deleted', 'boolean', array('default' => false))
                  ->addColumn('is_dynamic', 'boolean', array('default' => false))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('fqdn_id', 'glpi_fqdn', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('name'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('name', 'fqdn_id'))
                  ->addIndex(array('fqdn_id'))
                  ->addIndex(array('is_deleted'))
                  ->addIndex(array('is_dynamic'))
                  ->addIndex(array('itemtype', 'items_id', 'is_deleted'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_networkport
      $networkport = $this->table('glpi_networkport');
      $networkport->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('is_recursive', 'boolean', array('default' => false))
                  ->addColumn('items_id', 'integer', array('default' => 0))
                  ->addColumn('itemtype', 'string', array('limit' => 100))
                  ->addColumn('logical_number', 'integer', array('default' => 0))
                  ->addColumn('instantiation_type', 'string')
                  ->addColumn('mac', 'string', array('default' => ''))
                  ->addColumn('is_deleted', 'boolean', array('default' => false))
                  ->addColumn('is_dynamic', 'boolean', array('default' => false))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('items_id', 'itemtype'))
                  ->addIndex(array('itemtype', 'items_id'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('is_recursive'))
                  ->addIndex(array('mac'))
                  ->addIndex(array('is_deleted'))
                  ->addIndex(array('is_dynamic'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_networkportaggregate
      $networkportaggregate = $this->table('glpi_networkportaggregate');
      $networkportaggregate->addColumn('networkport_id', 'integer')
                           ->addColumn('networkports_id_list', 'text', array('comment' => 'array of associated networkports_id'))
                           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                           ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addIndex(array('networkport_id'), array('unique' => true))
                           ->addIndex(array('date_mod'))
                           ->addIndex(array('date_creation'))
                           ->create();

      // create the table glpi_networkportalias
      $networkportalias = $this->table('glpi_networkportalias');
      $networkportalias->addColumn('networkport_id', 'integer')
                       ->addColumn('networkport_id_alias', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('networkport_id_alias', 'glpi_networkport', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('networkport_id'), array('unique' => true))
                       ->addIndex(array('networkport_id_alias'))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_networkportdialup
      $networkportdialup = $this->table('glpi_networkportdialup');
      $networkportdialup->addColumn('networkport_id', 'integer')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('networkport_id'), array('unique' => true))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();

      // create the table glpi_networkportlocal
      $networkportlocal = $this->table('glpi_networkportlocal');
      $networkportlocal->addColumn('networkport_id', 'integer')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('networkport_id'), array('unique' => true))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_networkport_networkport
      $networkport_networkport = $this->table('glpi_networkport_networkport');
      $networkport_networkport->addColumn('networkport_id_1', 'integer')
                              ->addColumn('networkport_id_2', 'integer')
                              ->addForeignKey('networkport_id_1', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                              ->addForeignKey('networkport_id_2', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                              ->addIndex(array('networkport_id_1', 'networkport_id_2'), array('unique' => true))
                              ->addIndex(array('networkport_id_2'))
                              ->create();

      // create the table glpi_notification
      $notification = $this->table('glpi_notification');
      $notification->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('itemtype', 'string', array('limit' => 100))
                   ->addColumn('event', 'string')
                   ->addColumn('mode', 'string')
                   ->addColumn('notificationtemplate_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('is_active', 'boolean', array('default' => false))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('notificationtemplate_id', 'glpi_notificationtemplate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('itemtype'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_active'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('notificationtemplate_id'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_notificationtarget
      $notificationtarget = $this->table('glpi_notificationtarget');
      $notificationtarget->addColumn('items_id', 'integer')
                         ->addColumn('type', 'integer')
                         ->addColumn('notification_id', 'integer')
                         ->addForeignKey('notification_id', 'glpi_notification', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addIndex(array('type', 'items_id'))
                         ->addIndex(array('notification_id'))
                         ->create();

      // create the table glpi_rule
      $rule = $this->table('glpi_rule');
      $rule->addColumn('name', 'string')
           ->addColumn('entity_id', 'integer')
           ->addColumn('is_recursive', 'boolean', array('default' => false))
           ->addColumn('is_active', 'boolean', array('default' => false))
           ->addColumn('sub_type', 'string', array('default' => ''))
           ->addColumn('ranking', 'integer', array('default' => 0))
           ->addColumn('description', 'text')
           ->addColumn('match', 'char', array('limit' => 10, 'comment' => 'see define.php *_MATCHING constant'))
           ->addColumn('uuid', 'string')
           ->addColumn('condition', 'integer', array('default' => 0))
           ->addColumn('comment', 'text')
           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
           ->addIndex(array('entity_id'))
           ->addIndex(array('is_active'))
           ->addIndex(array('sub_type'))
           ->addIndex(array('is_recursive'))
           ->addIndex(array('condition'))
           ->addIndex(array('date_mod'))
           ->addIndex(array('date_creation'))
           ->create();

      // create the table glpi_ruleaction
      $ruleaction = $this->table('glpi_ruleaction');
      $ruleaction->addColumn('rule_id', 'integer')
                 ->addColumn('action_type', 'string', array('comment' => 'VALUE IN (assign, regex_result, append_regex_result, affectbyip, affectbyfqdn, affectbymac)'))
                 ->addColumn('field', 'string')
                 ->addColumn('value', 'string')
                 ->addForeignKey('rule_id', 'glpi_rule', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('rule_id'))
                 ->addIndex(array('field', 'value'))
                 ->create();

      // create the table glpi_rulecriteria
      $rulecriteria = $this->table('glpi_rulecriteria');
      $rulecriteria->addColumn('rule_id', 'integer')
                   ->addColumn('criteria', 'string')
                   ->addColumn('condition', 'integer', array('default' => 0, 'comment' => 'see define.php PATTERN_* and REGEX_* constant'))
                   ->addColumn('pattern', 'string')
                   ->addForeignKey('rule_id', 'glpi_rule', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('rule_id'))
                   ->addIndex(array('condition'))
                   ->create();

      // create the table glpi_sla
      $sla = $this->table('glpi_sla');
      $sla->addColumn('name', 'string')
          ->addColumn('entity_id', 'integer')
          ->addColumn('is_recursive', 'boolean', array('default' => false))
          ->addColumn('calendar_id', 'integer', array('default' => null, 'null' => true))
          ->addColumn('comment', 'text')
          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
          ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
          ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
          ->addForeignKey('calendar_id', 'glpi_calendar', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
          ->addIndex(array('name'))
          ->addIndex(array('entity_id'))
          ->addIndex(array('is_recursive'))
          ->addIndex(array('calendar_id'))
          ->addIndex(array('date_mod'))
          ->addIndex(array('date_creation'))
          ->create();

      // create the table glpi_slt
      $slt = $this->table('glpi_slt');
      $slt->addColumn('name', 'string')
          ->addColumn('entity_id', 'integer')
          ->addColumn('is_recursive', 'boolean', array('default' => false))
          ->addColumn('type', 'integer', array('default' => 0))
          ->addColumn('number_time', 'integer')
          ->addColumn('definition_time', 'string', array('default' => ''))
          ->addColumn('end_of_working_day', 'boolean', array('default' => false))
          ->addColumn('sla_id', 'integer', array('default' => null, 'null' => true))
          ->addColumn('comment', 'text')
          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
          ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
          ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
          ->addForeignKey('sla_id', 'glpi_sla', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
          ->addIndex(array('name'))
          ->addIndex(array('sla_id'))
          ->addIndex(array('date_mod'))
          ->addIndex(array('date_creation'))
          ->create();

      // create the table glpi_solutiontype
      $solutiontype = $this->table('glpi_solutiontype');
      $solutiontype->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_solutiontemplate
      $solutiontemplate = $this->table('glpi_solutiontemplate');
      $solutiontemplate->addColumn('name', 'string')
                       ->addColumn('entity_id', 'integer')
                       ->addColumn('is_recursive', 'boolean', array('default' => false))
                       ->addColumn('content', 'text')
                       ->addColumn('solutiontype_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('comment', 'text')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('solutiontype_id', 'glpi_solutiontype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('name'))
                       ->addIndex(array('entity_id'))
                       ->addIndex(array('is_recursive'))
                       ->addIndex(array('solutiontype_id'))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_state
      $state = $this->table('glpi_state');
      $state->addColumn('name', 'string')
            ->addColumn('entity_id', 'integer')
            ->addColumn('is_recursive', 'boolean', array('default' => false))
            ->addColumn('completename', 'text')
            ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('level', 'integer', array('default' => 0))
            ->addColumn('ancestors_cache', 'text')
            ->addColumn('sons_cache', 'text')
            ->addColumn('is_visible_computer', 'boolean', array('default' => true))
            ->addColumn('is_visible_monitor', 'boolean', array('default' => true))
            ->addColumn('is_visible_networkequipment', 'boolean', array('default' => true))
            ->addColumn('is_visible_peripheral', 'boolean', array('default' => true))
            ->addColumn('is_visible_phone', 'boolean', array('default' => true))
            ->addColumn('is_visible_printer', 'boolean', array('default' => true))
            ->addColumn('is_visible_softwareversion', 'boolean', array('default' => true))
            ->addColumn('is_visible_softwarelicense', 'boolean', array('default' => true))
            ->addColumn('comment', 'text')
            ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
            ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addIndex(array('name'))
            ->addIndex(array('state_id', 'name'))
            ->addIndex(array('is_visible_computer'))
            ->addIndex(array('is_visible_monitor'))
            ->addIndex(array('is_visible_networkequipment'))
            ->addIndex(array('is_visible_peripheral'))
            ->addIndex(array('is_visible_phone'))
            ->addIndex(array('is_visible_printer'))
            ->addIndex(array('is_visible_softwareversion'))
            ->addIndex(array('is_visible_softwarelicense'))
            ->addIndex(array('date_mod'))
            ->addIndex(array('date_creation'))
            ->create();

      // create the table glpi_supplier
      $supplier = $this->table('glpi_supplier');
      $supplier->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('suppliertype_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('address', 'text')
               ->addColumn('postcode', 'string', array('default' => ''))
               ->addColumn('town', 'string', array('default' => ''))
               ->addColumn('state', 'string', array('default' => ''))
               ->addColumn('country', 'string', array('default' => ''))
               ->addColumn('website', 'string', array('default' => ''))
               ->addColumn('phonenumber', 'string', array('default' => ''))
               ->addColumn('fax', 'string', array('default' => ''))
               ->addColumn('email', 'string', array('default' => ''))
               ->addColumn('is_deleted', 'boolean', array('default' => false))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('suppliertype_id', 'glpi_suppliertype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('suppliertype_id'))
               ->addIndex(array('is_deleted'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_taskcategory
      $taskcategory = $this->table('glpi_taskcategory');
      $taskcategory->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('completename', 'text')
                   ->addColumn('taskcategory_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('level', 'integer', array('default' => 0))
                   ->addColumn('ancestors_cache', 'text')
                   ->addColumn('sons_cache', 'text')
                   ->addColumn('is_active', 'boolean', array('default' => true))
                   ->addColumn('is_helpdeskvisible', 'boolean', array('default' => true))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('taskcategory_id', 'glpi_taskcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('taskcategory_id'))
                   ->addIndex(array('is_active'))
                   ->addIndex(array('is_helpdeskvisible'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_tasktemplate
      $tasktemplate = $this->table('glpi_tasktemplate');
      $tasktemplate->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('content', 'text')
                   ->addColumn('taskcategory_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('actiontime', 'integer', array('default' => 0))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('taskcategory_id', 'glpi_taskcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('taskcategory_id'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_tickettemplate
      $tickettemplate = $this->table('glpi_tickettemplate');
      $tickettemplate->addColumn('name', 'string')
                     ->addColumn('entity_id', 'integer')
                     ->addColumn('is_recursive', 'boolean', array('default' => false))
                     ->addColumn('comment', 'text')
                     ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                     ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                     ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('name'))
                     ->addIndex(array('entity_id'))
                     ->addIndex(array('is_recursive'))
                     ->addIndex(array('date_mod'))
                     ->addIndex(array('date_creation'))
                     ->create();

      // create the table glpi_tickettemplatehiddenfield
      $tickettemplatehiddenfield = $this->table('glpi_tickettemplatehiddenfield');
      $tickettemplatehiddenfield->addColumn('tickettemplate_id', 'integer')
                                ->addColumn('num', 'integer', array('default' => 0))
                                ->addForeignKey('tickettemplate_id', 'glpi_tickettemplate', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                                ->addIndex(array('tickettemplate_id', 'num'), array('unique' => true))
                                ->create();

      // create the table glpi_tickettemplatemandatoryfield
      $tickettemplatemandatoryfield = $this->table('glpi_tickettemplatemandatoryfield');
      $tickettemplatemandatoryfield->addColumn('tickettemplate_id', 'integer')
                                   ->addColumn('num', 'integer', array('default' => 0))
                                   ->addForeignKey('tickettemplate_id', 'glpi_tickettemplate', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                                   ->addIndex(array('tickettemplate_id', 'num'), array('unique' => true))
                                   ->create();

      // create the table glpi_tickettemplatepredefinedfield
      $tickettemplatepredefinedfield = $this->table('glpi_tickettemplatepredefinedfield');
      $tickettemplatepredefinedfield->addColumn('tickettemplate_id', 'integer')
                                    ->addColumn('num', 'integer', array('default' => 0))
                                    ->addColumn('value', 'text')
                                    ->addForeignKey('tickettemplate_id', 'glpi_tickettemplate', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                                    ->addIndex(array('tickettemplate_id', 'num'), array('unique' => true))
                                    ->create();

      // create the table glpi_transfer
      $transfer = $this->table('glpi_transfer');
      $transfer->addColumn('name', 'string')
               ->addColumn('keep_ticket', 'integer', array('default' => 0))
               ->addColumn('keep_networklink', 'integer', array('default' => 0))
               ->addColumn('keep_reservation', 'integer', array('default' => 0))
               ->addColumn('keep_history', 'integer', array('default' => 0))
               ->addColumn('keep_device', 'integer', array('default' => 0))
               ->addColumn('keep_infocom', 'integer', array('default' => 0))
               ->addColumn('keep_dc_monitor', 'integer', array('default' => 0))
               ->addColumn('clean_dc_monitor', 'integer', array('default' => 0))
               ->addColumn('keep_dc_phone', 'integer', array('default' => 0))
               ->addColumn('clean_dc_phone', 'integer', array('default' => 0))
               ->addColumn('keep_dc_peripheral', 'integer', array('default' => 0))
               ->addColumn('clean_dc_peripheral', 'integer', array('default' => 0))
               ->addColumn('keep_dc_printer', 'integer', array('default' => 0))
               ->addColumn('clean_dc_printer', 'integer', array('default' => 0))
               ->addColumn('keep_supplier', 'integer', array('default' => 0))
               ->addColumn('clean_supplier', 'integer', array('default' => 0))
               ->addColumn('keep_contact', 'integer', array('default' => 0))
               ->addColumn('clean_contact', 'integer', array('default' => 0))
               ->addColumn('keep_contract', 'integer', array('default' => 0))
               ->addColumn('clean_contract', 'integer', array('default' => 0))
               ->addColumn('keep_software', 'integer', array('default' => 0))
               ->addColumn('clean_software', 'integer', array('default' => 0))
               ->addColumn('keep_document', 'integer', array('default' => 0))
               ->addColumn('clean_document', 'integer', array('default' => 0))
               ->addColumn('keep_cartridgeitem', 'integer', array('default' => 0))
               ->addColumn('clean_cartridgeitem', 'integer', array('default' => 0))
               ->addColumn('keep_cartridge', 'integer', array('default' => 0))
               ->addColumn('keep_consumable', 'integer', array('default' => 0))
               ->addColumn('keep_disk', 'integer', array('default' => 0))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_user
      $user = $this->table('glpi_user');
      $user->addColumn('name', 'string')
           ->addColumn('password', 'string', array('default' => ''))
           ->addColumn('phone', 'string', array('default' => ''))
           ->addColumn('phone2', 'string', array('default' => ''))
           ->addColumn('mobile', 'string', array('default' => ''))
           ->addColumn('realname', 'string', array('default' => ''))
           ->addColumn('firstname', 'string', array('default' => ''))
           ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
           ->addColumn('language', 'char', array('limit' => 10, 'null' => true, 'comment' => 'see define.php CFG_GLPI[language] array'))
           ->addColumn('use_mode', 'integer', array('default' => 0))
           ->addColumn('list_limit', 'integer', array('default' => 20))
           ->addColumn('is_active', 'boolean', array('default' => true))
           ->addColumn('auths_id', 'integer', array('default' => null, 'null' => true))
           ->addColumn('authtype', 'integer', array('default' => 0))
           ->addColumn('last_login', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('date_sync', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('is_deleted', 'boolean', array('default' => false))
           ->addColumn('profile_id', 'integer', array('default' => null, 'null' => true))
           ->addColumn('entity_id', 'integer')
           ->addColumn('usertitle_id', 'integer', array('default' => null, 'null' => true))
           ->addColumn('usercategory_id', 'integer', array('default' => null, 'null' => true))
           ->addColumn('date_format', 'integer', array('null' => true))
           ->addColumn('number_format', 'integer', array('null' => true))
           ->addColumn('names_format', 'integer', array('null' => true))
           ->addColumn('csv_delimiter', 'char', array('limit' => 1, 'null' => true, 'default' => null))
           ->addColumn('is_ids_visible', 'boolean', array('default' => false))
           ->addColumn('use_flat_dropdowntree', 'boolean', array('default' => false))
           ->addColumn('show_jobs_at_login', 'boolean', array('default' => false))
           ->addColumn('priority_1', 'char', array('limit' => 20, 'null' => true))
           ->addColumn('priority_2', 'char', array('limit' => 20, 'null' => true))
           ->addColumn('priority_3', 'char', array('limit' => 20, 'null' => true))
           ->addColumn('priority_4', 'char', array('limit' => 20, 'null' => true))
           ->addColumn('priority_5', 'char', array('limit' => 20, 'null' => true))
           ->addColumn('priority_6', 'char', array('limit' => 20, 'null' => true))
           ->addColumn('followup_private', 'boolean', array('default' => false))
           ->addColumn('task_private', 'boolean', array('default' => false))
           ->addColumn('default_requesttype_id', 'integer', array('default' => null, 'null' => true))
           ->addColumn('password_forget_token', 'char', array('limit' => 40, 'null' => true))
           ->addColumn('password_forget_token_date', 'datetime', array('null' => true))
           ->addColumn('user_dn', 'text')
           ->addColumn('registration_number', 'string', array('default' => ''))
           ->addColumn('show_count_on_tabs', 'boolean', array('default' => true, 'null' => true))
           ->addColumn('refresh_ticket_list', 'integer', array('null' => true))
           ->addColumn('set_default_tech', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('personal_token', 'string', array('null' => true))
           ->addColumn('personal_token_date', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('display_count_on_home', 'integer', array('null' => true, 'default' => null))
           ->addColumn('notification_to_myself', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('duedateok_color', 'string', array('null' => true, 'default' => null))
           ->addColumn('duedatewarning_color', 'string', array('null' => true, 'default' => null))
           ->addColumn('duedatecritical_color', 'string', array('null' => true, 'default' => null))
           ->addColumn('duedatewarning_less', 'integer', array('null' => true, 'default' => null))
           ->addColumn('duedatecritical_less', 'integer', array('null' => true, 'default' => null))
           ->addColumn('duedatewarning_unit', 'string', array('null' => true, 'default' => null))
           ->addColumn('duedatecritical_unit', 'string', array('null' => true, 'default' => null))
           ->addColumn('display_options', 'text')
           ->addColumn('is_deleted_ldap', 'boolean', array('default' => false))
           ->addColumn('pdffont', 'string', array('null' => true, 'default' => null))
           ->addColumn('picture', 'string', array('null' => true, 'default' => null))
           ->addColumn('begin_date', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('end_date', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('keep_devices_when_purging_item', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('privatebookmarkorder', 'text')
           ->addColumn('backcreated', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('task_state', 'integer', array('null' => true, 'default' => null))
           ->addColumn('layout', 'char', array('limit' => 20, 'null' => true, 'default' => null))
           ->addColumn('palette', 'char', array('limit' => 20, 'null' => true, 'default' => null))
           ->addColumn('ticket_timeline', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('ticket_timeline_keep_replaced_tabs', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('set_default_requester', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('lock_autolock_mode', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('lock_directunlock_notification', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('highcontrast_css', 'boolean', array('default' => null, 'null' => true))
           ->addColumn('plannings', 'text')
           ->addColumn('comment', 'text')
           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
           ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
           ->addForeignKey('usertitle_id', 'glpi_usertitle', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
           ->addForeignKey('usercategory_id', 'glpi_usercategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
           ->addForeignKey('default_requesttype_id', 'glpi_requesttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
           ->addIndex(array('name'), array('unique' => true))
           ->addIndex(array('firstname'))
           ->addIndex(array('realname'))
           ->addIndex(array('entity_id'))
           ->addIndex(array('profile_id'))
           ->addIndex(array('location_id'))
           ->addIndex(array('usertitle_id'))
           ->addIndex(array('usercategory_id'))
           ->addIndex(array('is_deleted'))
           ->addIndex(array('is_active'))
           ->addIndex(array('authtype', 'auths_id'))
           ->addIndex(array('is_deleted_ldap'))
           ->addIndex(array('date_mod'))
           ->addIndex(array('date_creation'))
           ->create();

      // create the table glpi_profile
      $profile = $this->table('glpi_profile');
      $profile->addColumn('name', 'string')
              ->addColumn('interface', 'string', array('default' => 'helpdesk'))
              ->addColumn('is_default', 'boolean', array('default' => false))
              ->addColumn('helpdesk_hardware', 'integer', array('default' => 0))
              ->addColumn('helpdesk_item_type', 'text')
              ->addColumn('ticket_status', 'text', array('comment' => 'json encoded array of from/dest allowed status change'))
              ->addColumn('problem_status', 'text', array('comment' => 'json encoded array of from/dest allowed status change'))
              ->addColumn('create_ticket_on_login', 'boolean', array('default' => false))
              ->addColumn('tickettemplate_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('change_status', 'text', array('comment' => 'json encoded array of from/dest allowed status change'))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('tickettemplate_id', 'glpi_tickettemplate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('interface'))
              ->addIndex(array('is_default'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // Add foreignkey for glpi_user table created previously
      $user = $this->table('glpi_user');
      $user ->addForeignKey('profile_id', 'glpi_profile', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->save();

      // create the table glpi_useremail
      $useremail = $this->table('glpi_useremail');
      $useremail->addColumn('user_id', 'integer')
                ->addColumn('is_default', 'boolean', array('default' => false))
                ->addColumn('is_dynamic', 'boolean', array('default' => false))
                ->addColumn('email', 'string', array('null' => true, 'default' => null))
                ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                ->addIndex(array('user_id', 'email'), array('unique' => true))
                ->addIndex(array('email'))
                ->addIndex(array('is_default'))
                ->addIndex(array('is_dynamic'))
                ->create();

      // create the table glpi_vlan
      $vlan = $this->table('glpi_vlan');
      $vlan->addColumn('name', 'string')
           ->addColumn('entity_id', 'integer')
           ->addColumn('is_recursive', 'boolean', array('default' => false))
           ->addColumn('tag', 'integer', array('default' => 0))
           ->addColumn('comment', 'text')
           ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
           ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
           ->addIndex(array('name'))
           ->addIndex(array('entity_id'))
           ->addIndex(array('tag'))
           ->addIndex(array('date_mod'))
           ->addIndex(array('date_creation'))
           ->create();

      // create the table glpi_wifinetwork
      $wifinetwork = $this->table('glpi_wifinetwork');
      $wifinetwork->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('is_recursive', 'boolean', array('default' => false))
                  ->addColumn('essid', 'string', array('default' => ''))
                  ->addColumn('mode', 'string', array('default' => '', 'comment' => 'ad-hoc, access_point'))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('name'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('essid'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_bookmark
      $bookmark = $this->table('glpi_bookmark');
      $bookmark->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('type', 'integer', array('default' => 0, 'comment' => 'see define.php BOOKMARK_* constant'))
               ->addColumn('itemtype', 'string', array('limit' => 100))
               ->addColumn('user_id', 'integer', array('null' => true, 'default' => null))
               ->addColumn('is_private', 'boolean', array('default' => true))
               ->addColumn('path', 'string', array('default' => ''))
               ->addColumn('query', 'text')
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('type'))
               ->addIndex(array('itemtype'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('user_id'))
               ->addIndex(array('is_private'))
               ->addIndex(array('is_recursive'))
               ->create();

      // create the table glpi_bookmark_user
      $bookmark_user = $this->table('glpi_bookmark_user');
      $bookmark_user->addColumn('user_id', 'integer')
                    ->addColumn('itemtype', 'string', array('limit' => 100))
                    ->addColumn('bookmark_id', 'integer')
                    ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('bookmark_id', 'glpi_bookmark', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('user_id', 'itemtype'), array('unique' => true))
                    ->addIndex(array('bookmark_id'))
                    ->create();

      // create the table glpi_budget
      $budget = $this->table('glpi_budget');
      $budget->addColumn('name', 'string')
             ->addColumn('entity_id', 'integer')
             ->addColumn('is_recursive', 'boolean', array('default' => false))
             ->addColumn('is_deleted', 'boolean', array('default' => false))
             ->addColumn('begin_date', 'date', array('null' => true, 'default' => null))
             ->addColumn('end_date', 'date', array('null' => true, 'default' => null))
             ->addColumn('value', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
             ->addColumn('is_template', 'boolean', array('default' => false))
             ->addColumn('template_name', 'string', array('default' => ''))
             ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('budgettype_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('comment', 'text')
             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
             ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('budgettype_id', 'glpi_budgettype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addIndex(array('name'))
             ->addIndex(array('entity_id'))
             ->addIndex(array('is_recursive'))
             ->addIndex(array('is_deleted'))
             ->addIndex(array('begin_date'))
             ->addIndex(array('is_template'))
             ->addIndex(array('location_id'))
             ->addIndex(array('budgettype_id'))
             ->addIndex(array('date_mod'))
             ->addIndex(array('date_creation'))
             ->create();

      // create the table glpi_calendar_holiday
      $calendar_holiday = $this->table('glpi_calendar_holiday');
      $calendar_holiday->addColumn('calendar_id', 'integer')
                       ->addColumn('holiday_id', 'integer')
                       ->addForeignKey('calendar_id', 'glpi_calendar', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('holiday_id', 'glpi_holiday', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('calendar_id', 'holiday_id'), array('unique' => true))
                       ->addIndex(array('holiday_id'))
                       ->create();

      // create the table glpi_computer
      $computer = $this->table('glpi_computer');
      $computer->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('serial', 'string', array('default' => ''))
               ->addColumn('otherserial', 'string', array('default' => ''))
               ->addColumn('contact', 'string', array('default' => ''))
               ->addColumn('contact_num', 'string', array('default' => ''))
               ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
               ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
               ->addColumn('operatingsystem_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('operatingsystemversion_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('operatingsystemservicepack_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('operatingsystemarchitecture_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('os_license_number', 'string', array('default' => ''))
               ->addColumn('os_licenseid', 'string', array('default' => ''))
               ->addColumn('os_kernel_version', 'string', array('default' => ''))
               ->addColumn('autoupdatesystem_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('domain_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('network_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('computermodel_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('computertype_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('is_template', 'boolean', array('default' => false))
               ->addColumn('template_name', 'string', array('default' => ''))
               ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('is_deleted', 'boolean', array('default' => false))
               ->addColumn('is_dynamic', 'boolean', array('default' => false))
               ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
               ->addColumn('uuid', 'string', array('default' => ''))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('operatingsystem_id', 'glpi_operatingsystem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('operatingsystemversion_id', 'glpi_operatingsystemversion', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('operatingsystemservicepack_id', 'glpi_operatingsystemservicepack', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('operatingsystemarchitecture_id', 'glpi_operatingsystemarchitecture', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('autoupdatesystem_id', 'glpi_autoupdatesystem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('domain_id', 'glpi_domain', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('network_id', 'glpi_network', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('computermodel_id', 'glpi_computermodel', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('computertype_id', 'glpi_computertype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('is_template'))
               ->addIndex(array('autoupdatesystem_id'))
               ->addIndex(array('domain_id'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('manufacturer_id'))
               ->addIndex(array('group_id'))
               ->addIndex(array('user_id'))
               ->addIndex(array('location_id'))
               ->addIndex(array('computermodel_id'))
               ->addIndex(array('network_id'))
               ->addIndex(array('operatingsystem_id'))
               ->addIndex(array('operatingsystemservicepack_id'))
               ->addIndex(array('operatingsystemversion_id'))
               ->addIndex(array('operatingsystemarchitecture_id'))
               ->addIndex(array('state_id'))
               ->addIndex(array('user_id_tech'))
               ->addIndex(array('computertype_id'))
               ->addIndex(array('is_deleted'))
               ->addIndex(array('group_id_tech'))
               ->addIndex(array('is_dynamic'))
               ->addIndex(array('serial'))
               ->addIndex(array('otherserial'))
               ->addIndex(array('uuid'))
               ->addIndex(array('is_recursive'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_computerantivirus
      $computerantivirus = $this->table('glpi_computerantivirus');
      $computerantivirus->addColumn('name', 'string')
                        ->addColumn('computer_id', 'integer')
                        ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('antivirus_version', 'string', array('default' => ''))
                        ->addColumn('signature_version', 'string', array('default' => ''))
                        ->addColumn('is_active', 'boolean', array('default' => false))
                        ->addColumn('is_deleted', 'boolean', array('default' => false))
                        ->addColumn('is_uptodate', 'boolean', array('default' => false))
                        ->addColumn('is_dynamic', 'boolean', array('default' => false))
                        ->addColumn('date_expiration', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('computer_id', 'glpi_computer', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('name'))
                        ->addIndex(array('antivirus_version'))
                        ->addIndex(array('signature_version'))
                        ->addIndex(array('is_active'))
                        ->addIndex(array('is_uptodate'))
                        ->addIndex(array('is_dynamic'))
                        ->addIndex(array('is_deleted'))
                        ->addIndex(array('computer_id'))
                        ->addIndex(array('date_expiration'))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();

      // create the table glpi_computerdisk
      $computerdisk = $this->table('glpi_computerdisk');
      $computerdisk->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('computer_id', 'integer')
                   ->addColumn('device', 'string', array('default' => ''))
                   ->addColumn('mountpoint', 'string', array('default' => ''))
                   ->addColumn('filesystem_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('totalsize', 'integer', array('default' => 0))
                   ->addColumn('freesize', 'integer', array('default' => 0))
                   ->addColumn('is_deleted', 'boolean', array('default' => false))
                   ->addColumn('is_dynamic', 'boolean', array('default' => false))
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('computer_id', 'glpi_computer', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('filesystem_id', 'glpi_filesystem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('device'))
                   ->addIndex(array('mountpoint'))
                   ->addIndex(array('totalsize'))
                   ->addIndex(array('freesize'))
                   ->addIndex(array('computer_id'))
                   ->addIndex(array('filesystem_id'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_deleted'))
                   ->addIndex(array('is_dynamic'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_computer_item
      $computer_item = $this->table('glpi_computer_item');
      $computer_item->addColumn('computer_id', 'integer')
                    ->addColumn('items_id', 'integer', array('default' => 0))
                    ->addColumn('itemtype', 'string', array('limit' => 100))
                    ->addColumn('is_deleted', 'boolean', array('default' => false))
                    ->addColumn('is_dynamic', 'boolean', array('default' => false))
                    ->addForeignKey('computer_id', 'glpi_computer', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('computer_id'))
                    ->addIndex(array('itemtype', 'items_id'))
                    ->addIndex(array('is_deleted'))
                    ->addIndex(array('is_dynamic'))
                    ->create();

      // create the table glpi_computervirtualmachine
      $computervirtualmachine = $this->table('glpi_computervirtualmachine');
      $computervirtualmachine->addColumn('name', 'string')
                             ->addColumn('entity_id', 'integer')
                             ->addColumn('computer_id', 'integer')
                             ->addColumn('virtualmachinestate_id', 'integer', array('default' => null, 'null' => true))
                             ->addColumn('virtualmachinesystem_id', 'integer', array('default' => null, 'null' => true))
                             ->addColumn('virtualmachinetype_id', 'integer', array('default' => null, 'null' => true))
                             ->addColumn('uuid', 'string', array('default' => ''))
                             ->addColumn('vcpu', 'integer', array('default' => 0))
                             ->addColumn('ram', 'string', array('default' => ''))
                             ->addColumn('is_deleted', 'boolean', array('default' => false))
                             ->addColumn('is_dynamic', 'boolean', array('default' => false))
                             ->addColumn('comment', 'text')
                             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('computer_id', 'glpi_computer', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('virtualmachinestate_id', 'glpi_virtualmachinestate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('virtualmachinesystem_id', 'glpi_virtualmachinesystem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('virtualmachinetype_id', 'glpi_virtualmachinetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                             ->addIndex(array('name'))
                             ->addIndex(array('computer_id'))
                             ->addIndex(array('entity_id'))
                             ->addIndex(array('virtualmachinestate_id'))
                             ->addIndex(array('virtualmachinesystem_id'))
                             ->addIndex(array('vcpu'))
                             ->addIndex(array('ram'))
                             ->addIndex(array('is_deleted'))
                             ->addIndex(array('is_dynamic'))
                             ->addIndex(array('uuid'))
                             ->addIndex(array('date_mod'))
                             ->addIndex(array('date_creation'))
                             ->create();

      // create the table glpi_consumableitem
      $consumableitem = $this->table('glpi_consumableitem');
      $consumableitem->addColumn('name', 'string')
                     ->addColumn('entity_id', 'integer')
                     ->addColumn('is_recursive', 'boolean', array('default' => false))
                     ->addColumn('ref', 'string', array('default' => ''))
                     ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('consumableitemtype_id', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('is_deleted', 'boolean', array('default' => false))
                     ->addColumn('alarm_threshold', 'integer', array('default' => 10))
                     ->addColumn('comment', 'text')
                     ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                     ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                     ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('consumableitemtype_id', 'glpi_consumableitemtype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('name'))
                     ->addIndex(array('entity_id'))
                     ->addIndex(array('manufacturer_id'))
                     ->addIndex(array('location_id'))
                     ->addIndex(array('user_id_tech'))
                     ->addIndex(array('consumableitemtype_id'))
                     ->addIndex(array('is_deleted'))
                     ->addIndex(array('alarm_threshold'))
                     ->addIndex(array('group_id_tech'))
                     ->addIndex(array('date_mod'))
                     ->addIndex(array('date_creation'))
                     ->create();

      // create the table glpi_consumable
      $consumable = $this->table('glpi_consumable');
      $consumable->addColumn('entity_id', 'integer')
                 ->addColumn('consumableitem_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('date_in', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_out', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('items_id', 'integer', array('default' => 0))
                 ->addColumn('itemtype', 'string', array('limit' => 100))
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('consumableitem_id', 'glpi_consumableitem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('date_in'))
                 ->addIndex(array('date_out'))
                 ->addIndex(array('consumableitem_id'))
                 ->addIndex(array('entity_id'))
                 ->addIndex(array('itemtype', 'items_id'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_contact_supplier
      $contact_supplier = $this->table('glpi_contact_supplier');
      $contact_supplier->addColumn('supplier_id', 'integer')
                       ->addColumn('contact_id', 'integer')
                       ->addForeignKey('supplier_id', 'glpi_supplier', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('contact_id', 'glpi_contact', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('supplier_id', 'contact_id'), array('unique' => true))
                       ->addIndex(array('contact_id'))
                       ->create();

      // create the table glpi_contractcost
      $contractcost = $this->table('glpi_contractcost');
      $contractcost->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('contract_id', 'integer')
                   ->addColumn('begin_date', 'date', array('null' => true, 'default' => null))
                   ->addColumn('end_date', 'date', array('null' => true, 'default' => null))
                   ->addColumn('cost', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                   ->addColumn('budget_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('contract_id', 'glpi_contract', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('budget_id', 'glpi_budget', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('contract_id'))
                   ->addIndex(array('begin_date'))
                   ->addIndex(array('end_date'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('budget_id'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_contract_supplier
      $contract_supplier = $this->table('glpi_contract_supplier');
      $contract_supplier->addColumn('supplier_id', 'integer')
                        ->addColumn('contract_id', 'integer')
                        ->addForeignKey('supplier_id', 'glpi_supplier', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('contract_id', 'glpi_contract', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('supplier_id', 'contract_id'), array('unique' => true))
                        ->addIndex(array('contract_id'))
                        ->create();

      // create the table glpi_devicecase
      $devicecase = $this->table('glpi_devicecase');
      $devicecase->addColumn('designation', 'string')
                 ->addColumn('entity_id', 'integer')
                 ->addColumn('is_recursive', 'boolean', array('default' => false))
                 ->addColumn('devicecasetype_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('comment', 'text')
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('devicecasetype_id', 'glpi_devicecasetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('designation'))
                 ->addIndex(array('manufacturer_id'))
                 ->addIndex(array('devicecasetype_id'))
                 ->addIndex(array('entity_id'))
                 ->addIndex(array('is_recursive'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_devicecontrol
      $devicecontrol = $this->table('glpi_devicecontrol');
      $devicecontrol->addColumn('designation', 'string')
                    ->addColumn('entity_id', 'integer')
                    ->addColumn('is_recursive', 'boolean', array('default' => false))
                    ->addColumn('is_raid', 'boolean', array('default' => false))
                    ->addColumn('interfacetype_id', 'integer', array('default' => null, 'null' => true))
                    ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                    ->addColumn('comment', 'text')
                    ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                    ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                    ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('interfacetype_id', 'glpi_interfacetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('designation'))
                    ->addIndex(array('manufacturer_id'))
                    ->addIndex(array('interfacetype_id'))
                    ->addIndex(array('entity_id'))
                    ->addIndex(array('is_recursive'))
                    ->addIndex(array('date_mod'))
                    ->addIndex(array('date_creation'))
                    ->create();

      // create the table glpi_devicedrive
      $devicedrive = $this->table('glpi_devicedrive');
      $devicedrive->addColumn('designation', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('is_recursive', 'boolean', array('default' => false))
                  ->addColumn('is_writer', 'boolean', array('default' => false))
                  ->addColumn('speed', 'string', array('default' => ''))
                  ->addColumn('interfacetype_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('interfacetype_id', 'glpi_interfacetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('designation'))
                  ->addIndex(array('manufacturer_id'))
                  ->addIndex(array('interfacetype_id'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('is_recursive'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_devicegraphiccard
      $devicegraphiccard = $this->table('glpi_devicegraphiccard');
      $devicegraphiccard->addColumn('designation', 'string')
                        ->addColumn('entity_id', 'integer')
                        ->addColumn('is_recursive', 'boolean', array('default' => false))
                        ->addColumn('memory_default', 'integer', array('default' => 0))
                        ->addColumn('chipset', 'string', array('default' => ''))
                        ->addColumn('interfacetype_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('comment', 'text')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('interfacetype_id', 'glpi_interfacetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('designation'))
                        ->addIndex(array('chipset'))
                        ->addIndex(array('manufacturer_id'))
                        ->addIndex(array('interfacetype_id'))
                        ->addIndex(array('entity_id'))
                        ->addIndex(array('is_recursive'))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();

      // create the table glpi_deviceharddrive
      $deviceharddrive = $this->table('glpi_deviceharddrive');
      $deviceharddrive->addColumn('designation', 'string')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('rpm', 'string', array('default' => ''))
                      ->addColumn('cache', 'string', array('default' => ''))
                      ->addColumn('capacity_default', 'integer', array('default' => 0))
                      ->addColumn('interfacetype_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('interfacetype_id', 'glpi_interfacetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('designation'))
                      ->addIndex(array('manufacturer_id'))
                      ->addIndex(array('interfacetype_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_devicememory
      $devicememory = $this->table('glpi_devicememory');
      $devicememory->addColumn('designation', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('frequence', 'string', array('default' => ''))
                   ->addColumn('size_default', 'integer', array('default' => 0))
                   ->addColumn('capacity_default', 'integer', array('default' => 0))
                   ->addColumn('devicememorytype_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('devicememorytype_id', 'glpi_devicememorytype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('designation'))
                   ->addIndex(array('manufacturer_id'))
                   ->addIndex(array('devicememorytype_id'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_devicemotherboard
      $devicemotherboard = $this->table('glpi_devicemotherboard');
      $devicemotherboard->addColumn('designation', 'string')
                        ->addColumn('entity_id', 'integer')
                        ->addColumn('is_recursive', 'boolean', array('default' => false))
                        ->addColumn('chipset', 'string', array('default' => ''))
                        ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('comment', 'text')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('designation'))
                        ->addIndex(array('manufacturer_id'))
                        ->addIndex(array('entity_id'))
                        ->addIndex(array('is_recursive'))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();

      // create the table glpi_devicenetworkcard
      $devicenetworkcard = $this->table('glpi_devicenetworkcard');
      $devicenetworkcard->addColumn('designation', 'string')
                        ->addColumn('entity_id', 'integer')
                        ->addColumn('is_recursive', 'boolean', array('default' => false))
                        ->addColumn('bandwidth', 'string', array('default' => ''))
                        ->addColumn('mac_default', 'string', array('default' => ''))
                        ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('comment', 'text')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('designation'))
                        ->addIndex(array('manufacturer_id'))
                        ->addIndex(array('entity_id'))
                        ->addIndex(array('is_recursive'))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();

      // create the table glpi_devicepci
      $devicepci = $this->table('glpi_devicepci');
      $devicepci->addColumn('designation', 'string')
                ->addColumn('entity_id', 'integer')
                ->addColumn('is_recursive', 'boolean', array('default' => false))
                ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                ->addColumn('comment', 'text')
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                ->addIndex(array('designation'))
                ->addIndex(array('manufacturer_id'))
                ->addIndex(array('entity_id'))
                ->addIndex(array('is_recursive'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_devicepowersupply
      $devicepowersupply = $this->table('glpi_devicepowersupply');
      $devicepowersupply->addColumn('designation', 'string')
                        ->addColumn('entity_id', 'integer')
                        ->addColumn('is_recursive', 'boolean', array('default' => false))
                        ->addColumn('power', 'string', array('default' => ''))
                        ->addColumn('is_atx', 'boolean', array('default' => true))
                        ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                        ->addColumn('comment', 'text')
                        ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                        ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                        ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('designation'))
                        ->addIndex(array('manufacturer_id'))
                        ->addIndex(array('entity_id'))
                        ->addIndex(array('is_recursive'))
                        ->addIndex(array('date_mod'))
                        ->addIndex(array('date_creation'))
                        ->create();

      // create the table glpi_deviceprocessor
      $deviceprocessor = $this->table('glpi_deviceprocessor');
      $deviceprocessor->addColumn('designation', 'string')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('frequence', 'integer', array('default' => 0))
                      ->addColumn('frequency_default', 'integer', array('default' => 0))
                      ->addColumn('nbcores_default', 'integer', array('default' => 0))
                      ->addColumn('nbthreads_default', 'integer', array('default' => 0))
                      ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('designation'))
                      ->addIndex(array('manufacturer_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_devicesoundcard
      $devicesoundcard = $this->table('glpi_devicesoundcard');
      $devicesoundcard->addColumn('designation', 'string')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('type', 'string', array('default' => ''))
                      ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('designation'))
                      ->addIndex(array('manufacturer_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_displaypreference
      $displaypreference = $this->table('glpi_displaypreference');
      $displaypreference->addColumn('itemtype', 'string', array('limit' => 100))
                        ->addColumn('num', 'integer')
                        ->addColumn('rank', 'integer')
                        ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                        ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('user_id', 'itemtype', 'num'), array('unique' => true))
                        ->addIndex(array('rank'))
                        ->addIndex(array('num'))
                        ->addIndex(array('itemtype'))
                        ->create();

      // create the table glpi_reminder
      $reminder = $this->table('glpi_reminder');
      $reminder->addColumn('name', 'string')
               ->addColumn('date', 'datetime')
               ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('text', 'text')
               ->addColumn('begin_date', 'datetime')
               ->addColumn('end_date', 'datetime')
               ->addColumn('is_planned', 'boolean', array('default' => false))
               ->addColumn('state', 'integer', array('default' => 0))
               ->addColumn('begin_view_date', 'datetime')
               ->addColumn('end_view_date', 'datetime')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('date'))
               ->addIndex(array('begin_date'))
               ->addIndex(array('end_date'))
               ->addIndex(array('user_id'))
               ->addIndex(array('is_planned'))
               ->addIndex(array('state'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_entity_reminder
      $entity_reminder = $this->table('glpi_entity_reminder');
      $entity_reminder->addColumn('reminder_id', 'integer')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addForeignKey('reminder_id', 'glpi_reminder', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('reminder_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->create();

      // create the table glpi_group_reminder
      $group_reminder = $this->table('glpi_group_reminder');
      $group_reminder->addColumn('reminder_id', 'integer')
                     ->addColumn('group_id', 'integer')
                     ->addColumn('entity_id', 'integer')
                     ->addColumn('is_recursive', 'boolean', array('default' => false))
                     ->addForeignKey('reminder_id', 'glpi_reminder', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('reminder_id'))
                     ->addIndex(array('group_id'))
                     ->addIndex(array('entity_id'))
                     ->addIndex(array('is_recursive'))
                     ->create();

      // create the table glpi_reminder_user
      $reminder_user = $this->table('glpi_reminder_user');
      $reminder_user->addColumn('reminder_id', 'integer')
                    ->addColumn('user_id', 'integer')
                    ->addForeignKey('reminder_id', 'glpi_reminder', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('reminder_id'))
                    ->addIndex(array('user_id'))
                    ->create();

      // create the table glpi_reservationitem
      $reservationitem = $this->table('glpi_reservationitem');
      $reservationitem->addColumn('itemtype', 'string', array('limit' => 100))
                      ->addColumn('items_id', 'integer', array('default' => 0))
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('is_active', 'boolean', array('default' => true))
                      ->addColumn('is_deleted', 'boolean', array('default' => false))
                      ->addColumn('comment', 'text')
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('is_active'))
                      ->addIndex(array('items_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('is_deleted'))
                      ->create();

      // create the table glpi_reservation
      $reservation = $this->table('glpi_reservation');
      $reservation->addColumn('reservationitem_id', 'integer')
                  ->addColumn('begin_date', 'datetime')
                  ->addColumn('end_date', 'datetime')
                  ->addColumn('user_id', 'integer')
                  ->addColumn('comment', 'text')
                  ->addColumn('group', 'integer', array('default' => 0))
                  ->addForeignKey('reservationitem_id', 'glpi_reservationitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('begin_date'))
                  ->addIndex(array('end_date'))
                  ->addIndex(array('reservationitem_id'))
                  ->addIndex(array('user_id'))
                  ->create();

      // create the table glpi_rssfeed
      $rssfeed = $this->table('glpi_rssfeed');
      $rssfeed->addColumn('name', 'string')
              ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('url', 'text')
              ->addColumn('refresh_rate', 'integer', array('default' => 86400))
              ->addColumn('max_items', 'integer', array('default' => 20))
              ->addColumn('have_error', 'boolean', array('default' => false))
              ->addColumn('is_active', 'boolean', array('default' => false))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('user_id'))
              ->addIndex(array('have_error'))
              ->addIndex(array('is_active'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_rssfeed_user
      $rssfeed_user = $this->table('glpi_rssfeed_user');
      $rssfeed_user->addColumn('rssfeed_id', 'integer')
                   ->addColumn('user_id', 'integer')
                   ->addForeignKey('rssfeed_id', 'glpi_rssfeed', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('rssfeed_id'))
                   ->addIndex(array('user_id'))
                   ->create();

      // create the table glpi_slalevel
      $slalevel = $this->table('glpi_slalevel');
      $slalevel->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('calendar_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('calendar_id', 'glpi_calendar', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('is_recursive'))
               ->addIndex(array('calendar_id'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_slalevelaction
      $slalevelaction = $this->table('glpi_slalevelaction');
      $slalevelaction->addColumn('slalevel_id', 'integer')
                     ->addColumn('action_type', 'string')
                     ->addColumn('field', 'string')
                     ->addColumn('value', 'string', array('default' => ''))
                     ->addForeignKey('slalevel_id', 'glpi_slalevel', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('slalevel_id'))
                     ->create();

      // create the table glpi_slalevelcriteria
      $slalevelcriteria = $this->table('glpi_slalevelcriteria');
      $slalevelcriteria->addColumn('slalevel_id', 'integer')
                       ->addColumn('criteria', 'string')
                       ->addColumn('condition', 'integer', array('default' => 0, 'comment' => 'see define.php PATTERN_* and REGEX_* constant'))
                       ->addColumn('pattern', 'string', array('default' => ''))
                       ->addForeignKey('slalevel_id', 'glpi_slalevel', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('slalevel_id'))
                       ->addIndex(array('condition'))
                       ->create();

      // create the table glpi_software
      $software = $this->table('glpi_software');
      $software->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
               ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
               ->addColumn('is_update', 'boolean', array('default' => false))
               ->addColumn('software_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('is_deleted', 'boolean', array('default' => false))
               ->addColumn('is_template', 'boolean', array('default' => false))
               ->addColumn('template_name', 'string', array('default' => ''))
               ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
               ->addColumn('is_helpdesk_visible', 'boolean', array('default' => true))
               ->addColumn('softwarecategory_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('is_valid', 'boolean', array('default' => true))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('software_id', 'glpi_software', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('softwarecategory_id', 'glpi_softwarecategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('is_template'))
               ->addIndex(array('is_update'))
               ->addIndex(array('softwarecategory_id'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('manufacturer_id'))
               ->addIndex(array('group_id'))
               ->addIndex(array('user_id'))
               ->addIndex(array('location_id'))
               ->addIndex(array('user_id_tech'))
               ->addIndex(array('software_id'))
               ->addIndex(array('is_deleted'))
               ->addIndex(array('is_helpdesk_visible'))
               ->addIndex(array('group_id_tech'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_softwareversion
      $softwareversion = $this->table('glpi_softwareversion');
      $softwareversion->addColumn('name', 'string')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('software_id', 'integer')
                      ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('operatingsystem_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('software_id', 'glpi_software', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('operatingsystem_id', 'glpi_operatingsystem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('name'))
                      ->addIndex(array('software_id'))
                      ->addIndex(array('state_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('operatingsystem_id'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_softwarelicense
      $softwarelicense = $this->table('glpi_softwarelicense');
      $softwarelicense->addColumn('name', 'string')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('software_id', 'integer')
                      ->addColumn('number', 'integer', array('default' => 0))
                      ->addColumn('softwarelicensetype_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('serial', 'string', array('default' => ''))
                      ->addColumn('otherserial', 'string', array('default' => ''))
                      ->addColumn('softwareversion_id_buy', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('softwareversion_id_use', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('expire', 'date', array('null' => true, 'default' => null))
                      ->addColumn('is_valid', 'boolean', array('default' => true))
                      ->addColumn('is_template', 'boolean', array('default' => false))
                      ->addColumn('template_name', 'string', array('default' => ''))
                      ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('is_helpdesk_visible', 'boolean', array('default' => false))
                      ->addColumn('is_deleted', 'boolean', array('default' => false))
                      ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('software_id', 'glpi_software', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('softwarelicensetype_id', 'glpi_softwarelicensetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('softwareversion_id_buy', 'glpi_softwareversion', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('softwareversion_id_use', 'glpi_softwareversion', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('name'))
                      ->addIndex(array('is_template'))
                      ->addIndex(array('serial'))
                      ->addIndex(array('otherserial'))
                      ->addIndex(array('expire'))
                      ->addIndex(array('softwareversion_id_buy'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('softwarelicensetype_id'))
                      ->addIndex(array('softwareversion_id_use'))
                      ->addIndex(array('software_id', 'expire'))
                      ->addIndex(array('location_id'))
                      ->addIndex(array('user_id_tech'))
                      ->addIndex(array('user_id'))
                      ->addIndex(array('group_id_tech'))
                      ->addIndex(array('group_id'))
                      ->addIndex(array('is_helpdesk_visible'))
                      ->addIndex(array('manufacturer_id'))
                      ->addIndex(array('state_id'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_queuedmail
      $queuedmail = $this->table('glpi_queuedmail');
      $queuedmail->addColumn('name', 'text')
                 ->addColumn('entity_id', 'integer')
                 ->addColumn('itemtype', 'string', array('limit' => 100))
                 ->addColumn('items_id', 'integer', array('default' => 0))
                 ->addColumn('notificationtemplate_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('is_deleted', 'boolean', array('default' => false))
                 ->addColumn('sent_try', 'integer', array('default' => 0))
                 ->addColumn('create_time', 'datetime', array('default' => null, 'null' => true))
                 ->addColumn('send_time', 'datetime', array('default' => null, 'null' => true))
                 ->addColumn('sent_time', 'datetime', array('default' => null, 'null' => true))
                 ->addColumn('sender', 'text')
                 ->addColumn('sendername', 'text')
                 ->addColumn('recipient', 'text')
                 ->addColumn('recipientname', 'text')
                 ->addColumn('replyto', 'text')
                 ->addColumn('replytoname', 'text')
                 ->addColumn('headers', 'text')
                 ->addColumn('body_html', 'text')
                 ->addColumn('body_text', 'text')
                 ->addColumn('messageid', 'text')
                 ->addColumn('documents', 'text')
                 ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('notificationtemplate_id', 'glpi_notificationtemplate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('itemtype', 'items_id', 'notificationtemplate_id'))
                 ->addIndex(array('is_deleted'))
                 ->addIndex(array('entity_id'))
                 ->addIndex(array('sent_try'))
                 ->addIndex(array('create_time'))
                 ->addIndex(array('send_time'))
                 ->addIndex(array('sent_time'))
                 ->create();

      // create the table glpi_notepad
      $notepad = $this->table('glpi_notepad');
      $notepad->addColumn('itemtype', 'string', array('limit' => 100))
              ->addColumn('items_id', 'integer', array('default' => 0))
              ->addColumn('date', 'datetime')
              ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('user_id_lastupdater', 'integer', array('default' => null, 'null' => true))
              ->addColumn('content', 'text')
              ->addColumn('entity_id', 'integer')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id_lastupdater', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('itemtype', 'items_id'))
              ->addIndex(array('date'))
              ->addIndex(array('user_id_lastupdater'))
              ->addIndex(array('user_id'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_itilcategory
      $itilcategory = $this->table('glpi_itilcategory');
      $itilcategory->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => false))
                   ->addColumn('completename', 'text')
                   ->addColumn('itilcategory_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('level', 'integer', array('default' => 0))
                   ->addColumn('ancestors_cache', 'text')
                   ->addColumn('sons_cache', 'text')
                   ->addColumn('knowbaseitemcategory_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('is_helpdeskvisible', 'boolean', array('default' => true))
                   ->addColumn('tickettemplate_id_incident', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('tickettemplate_id_demand', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('is_incident', 'boolean', array('default' => true))
                   ->addColumn('is_request', 'boolean', array('default' => true))
                   ->addColumn('is_problem', 'boolean', array('default' => true))
                   ->addColumn('is_change', 'boolean', array('default' => true))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('itilcategory_id', 'glpi_itilcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('knowbaseitemcategory_id', 'glpi_knowbaseitemcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('tickettemplate_id_incident', 'glpi_tickettemplate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('tickettemplate_id_demand', 'glpi_tickettemplate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('knowbaseitemcategory_id'))
                   ->addIndex(array('user_id'))
                   ->addIndex(array('group_id'))
                   ->addIndex(array('is_helpdeskvisible'))
                   ->addIndex(array('itilcategory_id'))
                   ->addIndex(array('tickettemplate_id_incident'))
                   ->addIndex(array('tickettemplate_id_demand'))
                   ->addIndex(array('is_incident'))
                   ->addIndex(array('is_request'))
                   ->addIndex(array('is_problem'))
                   ->addIndex(array('is_change'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_ticket
      $ticket = $this->table('glpi_ticket');
      $ticket->addColumn('name', 'string')
             ->addColumn('entity_id', 'integer')
             ->addColumn('date', 'datetime')
             ->addColumn('closedate', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('solvedate', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('user_id_lastupdater', 'integer', array('default' => null, 'null' => true))
             ->addColumn('status', 'integer', array('default' => 1))
             ->addColumn('user_id_recipient', 'integer', array('default' => null, 'null' => true))
             ->addColumn('requesttype_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('content', 'text')
             ->addColumn('urgency', 'integer', array('default' => 1))
             ->addColumn('impact', 'integer', array('default' => 1))
             ->addColumn('priority', 'integer', array('default' => 1))
             ->addColumn('itilcategory_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('type', 'integer', array('default' => 1))
             ->addColumn('solutiontype_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('solution', 'text')
             ->addColumn('global_validation', 'integer', array('default' => 1))
             ->addColumn('slts_tto_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('slts_ttr_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('due_date', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('time_to_own', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('begin_waiting_date', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('sla_waiting_duration', 'integer', array('default' => 0))
             ->addColumn('waiting_duration', 'integer', array('default' => 0))
             ->addColumn('close_delay_stat', 'integer', array('default' => 0))
             ->addColumn('solve_delay_stat', 'integer', array('default' => 0))
             ->addColumn('takeintoaccount_delay_stat', 'integer', array('default' => 0))
             ->addColumn('actiontime', 'integer', array('default' => 0))
             ->addColumn('is_deleted', 'boolean', array('default' => false))
             ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('validation_percent', 'integer', array('default' => 0))
             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
             ->addForeignKey('user_id_lastupdater', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('user_id_recipient', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('requesttype_id', 'glpi_requesttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('itilcategory_id', 'glpi_itilcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('solutiontype_id', 'glpi_solutiontype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('slts_tto_id', 'glpi_slt', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('slts_ttr_id', 'glpi_slt', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addIndex(array('name'))
             ->addIndex(array('date'))
             ->addIndex(array('closedate'))
             ->addIndex(array('status'))
             ->addIndex(array('priority'))
             ->addIndex(array('requesttype_id'))
             ->addIndex(array('entity_id'))
             ->addIndex(array('user_id_recipient'))
             ->addIndex(array('solvedate'))
             ->addIndex(array('urgency'))
             ->addIndex(array('impact'))
             ->addIndex(array('global_validation'))
             ->addIndex(array('slts_tto_id'))
             ->addIndex(array('slts_ttr_id'))
             ->addIndex(array('due_date'))
             ->addIndex(array('time_to_own'))
             ->addIndex(array('user_id_lastupdater'))
             ->addIndex(array('type'))
             ->addIndex(array('solutiontype_id'))
             ->addIndex(array('itilcategory_id'))
             ->addIndex(array('is_deleted'))
             ->addIndex(array('location_id'))
             ->addIndex(array('date_mod'))
             ->addIndex(array('date_creation'))
             ->create();

      // create the table glpi_ticket_ticket
      $ticket_ticket = $this->table('glpi_ticket_ticket');
      $ticket_ticket->addColumn('ticket_id_1', 'integer')
                    ->addColumn('ticket_id_2', 'integer')
                    ->addColumn('link', 'integer', array('default' => 1))
                    ->addForeignKey('ticket_id_1', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('ticket_id_2', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('ticket_id_1', 'ticket_id_2'), array('unique' => true))
                    ->create();

      // create the table glpi_ticket_user
      $ticket_user = $this->table('glpi_ticket_user');
      $ticket_user->addColumn('ticket_id', 'integer')
                  ->addColumn('user_id', 'integer')
                  ->addColumn('type', 'integer', array('default' => 1))
                  ->addColumn('use_notification', 'boolean', array('default' => true))
                  ->addColumn('alternative_email', 'string', array('default' => ''))
                  ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('ticket_id', 'type', 'user_id', 'alternative_email'), array('unique' => true))
                  ->addIndex(array('user_id', 'type'))
                  ->create();

      // create the table glpi_ticketsatisfaction
      $ticketsatisfaction = $this->table('glpi_ticketsatisfaction');
      $ticketsatisfaction->addColumn('ticket_id', 'integer')
                         ->addColumn('type', 'integer', array('default' => 1))
                         ->addColumn('date_begin', 'datetime', array('default' => null, 'null' => true))
                         ->addColumn('date_answered', 'datetime', array('default' => null, 'null' => true))
                         ->addColumn('satisfaction', 'integer', array('null' => true, 'default' => null))
                         ->addColumn('comment', 'text')
                         ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addIndex(array('ticket_id'), array('unique' => true))
                         ->create();

      // create the table glpi_ticketrecurrent
      $ticketrecurrent = $this->table('glpi_ticketrecurrent');
      $ticketrecurrent->addColumn('name', 'string')
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('is_active', 'boolean', array('default' => false))
                      ->addColumn('tickettemplate_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('begin_date', 'datetime', array('default' => null, 'null' => true))
                      ->addColumn('end_date', 'datetime', array('default' => null, 'null' => true))
                      ->addColumn('periodicity', 'string')
                      ->addColumn('create_before', 'integer', array('default' => 0))
                      ->addColumn('next_creation_date', 'datetime', array('default' => null, 'null' => true))
                      ->addColumn('calendar_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('comment', 'text')
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('tickettemplate_id', 'glpi_tickettemplate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('calendar_id', 'glpi_calendar', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('name'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('is_active'))
                      ->addIndex(array('tickettemplate_id'))
                      ->addIndex(array('next_creation_date'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_ticketfollowup
      $ticketfollowup = $this->table('glpi_ticketfollowup');
      $ticketfollowup->addColumn('ticket_id', 'integer')
                     ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
                     ->addColumn('user_id', 'integer', array('null' => true))
                     ->addColumn('content', 'text')
                     ->addColumn('is_private', 'boolean', array('default' => false))
                     ->addColumn('requesttype_id', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                     ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                     ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('user_id', 'glpi_ticket', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('requesttype_id', 'glpi_requesttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('date'))
                     ->addIndex(array('user_id'))
                     ->addIndex(array('ticket_id'))
                     ->addIndex(array('is_private'))
                     ->addIndex(array('requesttype_id'))
                     ->addIndex(array('date_mod'))
                     ->addIndex(array('date_creation'))
                     ->create();

      // create the table glpi_tickettask
      $tickettask = $this->table('glpi_tickettask');
      $tickettask->addColumn('ticket_id', 'integer')
                 ->addColumn('taskcategory_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
                 ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('content', 'text')
                 ->addColumn('is_private', 'boolean', array('default' => false))
                 ->addColumn('actiontime', 'integer', array('default' => 0))
                 ->addColumn('begin_date', 'datetime', array('default' => null, 'null' => true))
                 ->addColumn('end_date', 'datetime', array('default' => null, 'null' => true))
                 ->addColumn('state', 'integer', array('default' => 1))
                 ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('taskcategory_id', 'glpi_taskcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('user_id', 'glpi_ticket', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('user_id_tech', 'glpi_ticket', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('date'))
                 ->addIndex(array('user_id'))
                 ->addIndex(array('ticket_id'))
                 ->addIndex(array('is_private'))
                 ->addIndex(array('taskcategory_id'))
                 ->addIndex(array('state'))
                 ->addIndex(array('user_id_tech'))
                 ->addIndex(array('group_id_tech'))
                 ->addIndex(array('begin_date'))
                 ->addIndex(array('end_date'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_ticketcost
      $ticketcost = $this->table('glpi_ticketcost');
      $ticketcost->addColumn('name', 'string')
                 ->addColumn('ticket_id', 'integer')
                 ->addColumn('begin_date', 'date', array('default' => null, 'null' => true))
                 ->addColumn('end_date', 'date', array('default' => null, 'null' => true))
                 ->addColumn('actiontime', 'integer', array('default' => 0))
                 ->addColumn('cost_time', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                 ->addColumn('cost_fixed', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                 ->addColumn('cost_material', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                 ->addColumn('budget_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('entity_id', 'integer')
                 ->addColumn('comment', 'text')
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('budget_id', 'glpi_budget', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('name'))
                 ->addIndex(array('ticket_id'))
                 ->addIndex(array('begin_date'))
                 ->addIndex(array('end_date'))
                 ->addIndex(array('entity_id'))
                 ->addIndex(array('budget_id'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_ticketvalidation
      $ticketvalidation = $this->table('glpi_ticketvalidation');
      $ticketvalidation->addColumn('entity_id', 'integer')
                       ->addColumn('ticket_id', 'integer')
                       ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('user_id_validate', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('comment_submission', 'text')
                       ->addColumn('comment_validation', 'text')
                       ->addColumn('status', 'integer', array('default' => 2))
                       ->addColumn('submission_date', 'datetime', array('default' => null, 'null' => true))
                       ->addColumn('validation_date', 'datetime', array('default' => null, 'null' => true))
                       ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id_validate', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('entity_id'))
                       ->addIndex(array('user_id'))
                       ->addIndex(array('user_id_validate'))
                       ->addIndex(array('ticket_id'))
                       ->addIndex(array('submission_date'))
                       ->addIndex(array('validation_date'))
                       ->addIndex(array('status'))
                       ->create();

      // create the table glpi_supplier_ticket
      $supplier_ticket = $this->table('glpi_supplier_ticket');
      $supplier_ticket->addColumn('ticket_id', 'integer')
                      ->addColumn('supplier_id', 'integer')
                      ->addColumn('type', 'integer', array('default' => 1))
                      ->addColumn('use_notification', 'boolean', array('default' => false))
                      ->addColumn('alternative_email', 'string', array('default' => ''))
                      ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('supplier_id', 'glpi_supplier', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('ticket_id', 'type', 'supplier_id'), array('unique' => true))
                      ->addIndex(array('supplier_id', 'type'))
                      ->create();

      // create the table glpi_slalevel_ticket
      $slalevel_ticket = $this->table('glpi_slalevel_ticket');
      $slalevel_ticket->addColumn('ticket_id', 'integer')
                      ->addColumn('slalevel_id', 'integer')
                      ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
                      ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('slalevel_id', 'glpi_slalevel', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('ticket_id'))
                      ->addIndex(array('slalevel_id'))
                      ->addIndex(array('ticket_id', 'slalevel_id'))
                      ->create();

      // create the table glpi_project
      $project = $this->table('glpi_project');
      $project->addColumn('name', 'string')
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('code', 'string', array('default' => ''))
              ->addColumn('priority', 'integer', array('default' => 1))
              ->addColumn('project_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('projectstate_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('projecttype_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('plan_start_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('plan_end_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('real_start_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('real_end_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('percent_done', 'integer', array('limit' => 3, 'default' => 0))
              ->addColumn('show_on_global_gantt', 'boolean', array('default' => false))
              ->addColumn('content', 'text')
              ->addColumn('is_deleted', 'boolean', array('default' => false))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addForeignKey('project_id', 'glpi_project', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('projectstate_id', 'glpi_projectstate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('projecttype_id', 'glpi_projecttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('code'))
              ->addIndex(array('entity_id'))
              ->addIndex(array('is_recursive'))
              ->addIndex(array('project_id'))
              ->addIndex(array('projectstate_id'))
              ->addIndex(array('projecttype_id'))
              ->addIndex(array('priority'))
              ->addIndex(array('date'))
              ->addIndex(array('user_id'))
              ->addIndex(array('group_id'))
              ->addIndex(array('plan_start_date'))
              ->addIndex(array('plan_end_date'))
              ->addIndex(array('real_start_date'))
              ->addIndex(array('real_end_date'))
              ->addIndex(array('percent_done'))
              ->addIndex(array('show_on_global_gantt'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_projectcost
      $projectcost = $this->table('glpi_projectcost');
      $projectcost->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('is_recursive', 'boolean', array('default' => false))
                  ->addColumn('project_id', 'integer')
                  ->addColumn('begin_date', 'date', array('default' => null, 'null' => true))
                  ->addColumn('end_date', 'date', array('default' => null, 'null' => true))
                  ->addColumn('cost', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                  ->addColumn('budget_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('comment', 'text')
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('project_id', 'glpi_project', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('budget_id', 'glpi_budget', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('name'))
                  ->addIndex(array('project_id'))
                  ->addIndex(array('begin_date'))
                  ->addIndex(array('end_date'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('is_recursive'))
                  ->addIndex(array('budget_id'))
                  ->create();

      // create the table glpi_projecttask
      $projecttask = $this->table('glpi_projecttask');
      $projecttask->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('is_recursive', 'boolean', array('default' => false))
                  ->addColumn('content', 'text')
                  ->addColumn('project_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('projecttask_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
                  ->addColumn('plan_start_date', 'datetime', array('default' => null, 'null' => true))
                  ->addColumn('plan_end_date', 'datetime', array('default' => null, 'null' => true))
                  ->addColumn('real_start_date', 'datetime', array('default' => null, 'null' => true))
                  ->addColumn('real_end_date', 'datetime', array('default' => null, 'null' => true))
                  ->addColumn('planned_duration', 'integer', array('default' => 0))
                  ->addColumn('effective_duration', 'integer', array('default' => 0))
                  ->addColumn('projectstate_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('projecttasktype_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('percent_done', 'integer', array('default' => 0))
                  ->addColumn('is_milestone', 'boolean', array('default' => false))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('project_id', 'glpi_project', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('projecttask_id', 'glpi_projecttask', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('projectstate_id', 'glpi_projectstate', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('projecttasktype_id', 'glpi_projecttasktype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('name'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('is_recursive'))
                  ->addIndex(array('project_id'))
                  ->addIndex(array('projecttask_id'))
                  ->addIndex(array('date'))
                  ->addIndex(array('user_id'))
                  ->addIndex(array('plan_start_date'))
                  ->addIndex(array('plan_end_date'))
                  ->addIndex(array('real_start_date'))
                  ->addIndex(array('real_end_date'))
                  ->addIndex(array('percent_done'))
                  ->addIndex(array('projectstate_id'))
                  ->addIndex(array('projecttasktype_id'))
                  ->addIndex(array('is_milestone'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_profile_user
      $profile_user = $this->table('glpi_profile_user');
      $profile_user->addColumn('user_id', 'integer')
                   ->addColumn('profile_id', 'integer')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('is_recursive', 'boolean', array('default' => true))
                   ->addColumn('is_dynamic', 'boolean', array('default' => false))
                   ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('profile_id', 'glpi_profile', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('profile_id'))
                   ->addIndex(array('user_id'))
                   ->addIndex(array('is_recursive'))
                   ->addIndex(array('is_dynamic'))
                   ->create();

      // create the table glpi_printer
      $printer = $this->table('glpi_printer');
      $printer->addColumn('name', 'string')
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('contact', 'string', array('default' => ''))
              ->addColumn('contact_num', 'string', array('default' => ''))
              ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
              ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
              ->addColumn('serial', 'string', array('default' => ''))
              ->addColumn('otherserial', 'string', array('default' => ''))
              ->addColumn('have_serial', 'boolean', array('default' => false))
              ->addColumn('have_parallel', 'boolean', array('default' => false))
              ->addColumn('have_usb', 'boolean', array('default' => false))
              ->addColumn('have_wifi', 'boolean', array('default' => false))
              ->addColumn('have_ethernet', 'boolean', array('default' => false))
              ->addColumn('memory_size', 'string', array('default' => ''))
              ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('domain_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('network_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('printertype_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('printermodel_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('is_global', 'boolean', array('default' => false))
              ->addColumn('is_deleted', 'boolean', array('default' => false))
              ->addColumn('is_template', 'boolean', array('default' => false))
              ->addColumn('template_name', 'string', array('default' => ''))
              ->addColumn('init_pages_counter', 'integer', array('default' => 0))
              ->addColumn('last_pages_counter', 'integer', array('default' => 0))
              ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
              ->addColumn('is_dynamic', 'boolean', array('default' => false))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('domain_id', 'glpi_domain', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('network_id', 'glpi_network', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('printertype_id', 'glpi_printertype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('printermodel_id', 'glpi_printermodel', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('is_template'))
              ->addIndex(array('is_global'))
              ->addIndex(array('domain_id'))
              ->addIndex(array('entity_id'))
              ->addIndex(array('manufacturer_id'))
              ->addIndex(array('group_id'))
              ->addIndex(array('user_id'))
              ->addIndex(array('location_id'))
              ->addIndex(array('printermodel_id'))
              ->addIndex(array('network_id'))
              ->addIndex(array('state_id'))
              ->addIndex(array('user_id_tech'))
              ->addIndex(array('printertype_id'))
              ->addIndex(array('is_deleted'))
              ->addIndex(array('group_id_tech'))
              ->addIndex(array('last_pages_counter'))
              ->addIndex(array('is_dynamic'))
              ->addIndex(array('serial'))
              ->addIndex(array('otherserial'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_phone
      $phone = $this->table('glpi_phone');
      $phone->addColumn('name', 'string')
            ->addColumn('entity_id', 'integer')
            ->addColumn('is_recursive', 'boolean', array('default' => false))
            ->addColumn('contact', 'string', array('default' => ''))
            ->addColumn('contact_num', 'string', array('default' => ''))
            ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
            ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
            ->addColumn('serial', 'string', array('default' => ''))
            ->addColumn('otherserial', 'string', array('default' => ''))
            ->addColumn('firmware', 'string', array('default' => ''))
            ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('phonetype_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('phonemodel_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('brand', 'string', array('default' => ''))
            ->addColumn('phonepowersupply_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('number_line', 'string', array('default' => ''))
            ->addColumn('have_headset', 'boolean', array('default' => false))
            ->addColumn('have_hp', 'boolean', array('default' => false))
            ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('is_global', 'boolean', array('default' => false))
            ->addColumn('is_deleted', 'boolean', array('default' => false))
            ->addColumn('is_template', 'boolean', array('default' => false))
            ->addColumn('template_name', 'string', array('default' => ''))
            ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
            ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
            ->addColumn('is_dynamic', 'boolean', array('default' => false))
            ->addColumn('comment', 'text')
            ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
            ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('phonetype_id', 'glpi_phonetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('phonemodel_id', 'glpi_phonemodel', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('phonepowersupply_id', 'glpi_phonepowersupply', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
            ->addIndex(array('name'))
            ->addIndex(array('is_template'))
            ->addIndex(array('is_global'))
            ->addIndex(array('entity_id'))
            ->addIndex(array('manufacturer_id'))
            ->addIndex(array('group_id'))
            ->addIndex(array('user_id'))
            ->addIndex(array('location_id'))
            ->addIndex(array('phonemodel_id'))
            ->addIndex(array('phonepowersupply_id'))
            ->addIndex(array('state_id'))
            ->addIndex(array('user_id_tech'))
            ->addIndex(array('phonetype_id'))
            ->addIndex(array('is_deleted'))
            ->addIndex(array('group_id_tech'))
            ->addIndex(array('is_dynamic'))
            ->addIndex(array('serial'))
            ->addIndex(array('otherserial'))
            ->addIndex(array('is_recursive'))
            ->addIndex(array('date_mod'))
            ->addIndex(array('date_creation'))
            ->create();

      // create the table glpi_monitor
      $monitor = $this->table('glpi_monitor');
      $monitor->addColumn('name', 'string')
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('contact', 'string', array('default' => ''))
              ->addColumn('contact_num', 'string', array('default' => ''))
              ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
              ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
              ->addColumn('serial', 'string', array('default' => ''))
              ->addColumn('otherserial', 'string', array('default' => ''))
              ->addColumn('size', 'integer', array('default' => 0))
              ->addColumn('have_micro', 'boolean', array('default' => false))
              ->addColumn('have_speaker', 'boolean', array('default' => false))
              ->addColumn('have_subd', 'boolean', array('default' => false))
              ->addColumn('have_bnc', 'boolean', array('default' => false))
              ->addColumn('have_dvi', 'boolean', array('default' => false))
              ->addColumn('have_pivot', 'boolean', array('default' => false))
              ->addColumn('have_hdmi', 'boolean', array('default' => false))
              ->addColumn('have_displayport', 'boolean', array('default' => false))
              ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('monitortype_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('monitormodel_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('is_global', 'boolean', array('default' => false))
              ->addColumn('is_deleted', 'boolean', array('default' => false))
              ->addColumn('is_template', 'boolean', array('default' => false))
              ->addColumn('template_name', 'string', array('default' => ''))
              ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
              ->addColumn('is_dynamic', 'boolean', array('default' => false))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('monitortype_id', 'glpi_phonetype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('monitormodel_id', 'glpi_phonemodel', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('is_template'))
              ->addIndex(array('is_global'))
              ->addIndex(array('entity_id'))
              ->addIndex(array('manufacturer_id'))
              ->addIndex(array('group_id'))
              ->addIndex(array('user_id'))
              ->addIndex(array('location_id'))
              ->addIndex(array('monitormodel_id'))
              ->addIndex(array('state_id'))
              ->addIndex(array('user_id_tech'))
              ->addIndex(array('monitortype_id'))
              ->addIndex(array('is_deleted'))
              ->addIndex(array('group_id_tech'))
              ->addIndex(array('is_dynamic'))
              ->addIndex(array('serial'))
              ->addIndex(array('otherserial'))
              ->addIndex(array('is_recursive'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_problem
      $problem = $this->table('glpi_problem');
      $problem->addColumn('name', 'string')
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('is_deleted', 'boolean', array('default' => false))
              ->addColumn('status', 'integer', array('default' => 1))
              ->addColumn('content', 'text')
              ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('solvedate', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('closedate', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('due_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('user_id_recipient', 'integer', array('default' => null, 'null' => true))
              ->addColumn('user_id_lastupdater', 'integer', array('default' => null, 'null' => true))
              ->addColumn('urgency', 'integer', array('default' => 1))
              ->addColumn('impact', 'integer', array('default' => 1))
              ->addColumn('priority', 'integer', array('default' => 1))
              ->addColumn('itilcategory_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('impactcontent', 'text')
              ->addColumn('causecontent', 'text')
              ->addColumn('symptomcontent', 'text')
              ->addColumn('solutiontype_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('solution', 'text')
              ->addColumn('actiontime', 'integer', array('default' => 0))
              ->addColumn('begin_waiting_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('waiting_duration', 'integer', array('default' => 0))
              ->addColumn('close_delay_stat', 'integer', array('default' => 0))
              ->addColumn('solve_delay_stat', 'integer', array('default' => 0))
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id_recipient', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('user_id_lastupdater', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('itilcategory_id', 'glpi_itilcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('solutiontype_id', 'glpi_solutiontype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('name'))
              ->addIndex(array('entity_id'))
              ->addIndex(array('is_recursive'))
              ->addIndex(array('is_deleted'))
              ->addIndex(array('date'))
              ->addIndex(array('closedate'))
              ->addIndex(array('status'))
              ->addIndex(array('priority'))
              ->addIndex(array('itilcategory_id'))
              ->addIndex(array('user_id_recipient'))
              ->addIndex(array('solvedate'))
              ->addIndex(array('solutiontype_id'))
              ->addIndex(array('urgency'))
              ->addIndex(array('impact'))
              ->addIndex(array('due_date'))
              ->addIndex(array('user_id_lastupdater'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_problem_supplier
      $problem_supplier = $this->table('glpi_problem_supplier');
      $problem_supplier->addColumn('problem_id', 'integer')
                       ->addColumn('supplier_id', 'integer')
                       ->addColumn('type', 'integer', array('default' => 1))
                       ->addColumn('use_notification', 'boolean', array('default' => false))
                       ->addColumn('alternative_email', 'string', array('default' => ''))
                       ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('supplier_id', 'glpi_supplier', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('problem_id', 'type', 'supplier_id'), array('unique' => true))
                       ->addIndex(array('supplier_id', 'type'))
                       ->create();

      // create the table glpi_problem_ticket
      $problem_ticket = $this->table('glpi_problem_ticket');
      $problem_ticket->addColumn('problem_id', 'integer')
                     ->addColumn('ticket_id', 'integer')
                     ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('problem_id', 'ticket_id'), array('unique' => true))
                     ->addIndex(array('ticket_id'))
                     ->create();

      // create the table glpi_problem_user
      $problem_user = $this->table('glpi_problem_user');
      $problem_user->addColumn('problem_id', 'integer')
                   ->addColumn('user_id', 'integer')
                   ->addColumn('type', 'integer', array('default' => 1))
                   ->addColumn('use_notification', 'boolean', array('default' => false))
                   ->addColumn('alternative_email', 'string', array('default' => ''))
                   ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('problem_id', 'type', 'user_id', 'alternative_email'), array('unique' => true))
                   ->addIndex(array('user_id', 'type'))
                   ->create();

      // create the table glpi_problemcost
      $problemcost = $this->table('glpi_problemcost');
      $problemcost->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('problem_id', 'integer')
                  ->addColumn('begin_date', 'date', array('null' => true, 'default' => null))
                  ->addColumn('end_date', 'date', array('null' => true, 'default' => null))
                  ->addColumn('actiontime', 'integer', array('default' => 0))
                  ->addColumn('cost_time', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                  ->addColumn('cost_fixed', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                  ->addColumn('cost_material', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                  ->addColumn('budget_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('budget_id', 'glpi_budget', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('name'))
                  ->addIndex(array('problem_id'))
                  ->addIndex(array('begin_date'))
                  ->addIndex(array('end_date'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('budget_id'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_problemtask
      $problemtask = $this->table('glpi_problemtask');
      $problemtask->addColumn('problem_id', 'integer')
                  ->addColumn('taskcategory_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('date', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('begin_date', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('end_date', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('content', 'text')
                  ->addColumn('actiontime', 'integer', array('default' => 0))
                  ->addColumn('state', 'integer', array('default' => 0))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('taskcategory_id', 'glpi_taskcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('problem_id'))
                  ->addIndex(array('user_id'))
                  ->addIndex(array('user_id_tech'))
                  ->addIndex(array('group_id_tech'))
                  ->addIndex(array('date'))
                  ->addIndex(array('begin_date'))
                  ->addIndex(array('end_date'))
                  ->addIndex(array('state'))
                  ->addIndex(array('taskcategory_id'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_cartridge
      $cartridge = $this->table('glpi_cartridge');
      $cartridge->addColumn('entity_id', 'integer')
                ->addColumn('cartridgeitem_id', 'integer', array('default' => null, 'null' => true))
                ->addColumn('printer_id', 'integer', array('default' => null, 'null' => true))
                ->addColumn('date_in', 'date', array('null' => true, 'default' => null))
                ->addColumn('date_use', 'date', array('null' => true, 'default' => null))
                ->addColumn('date_out', 'date', array('null' => true, 'default' => null))
                ->addColumn('pages', 'integer', array('default' => 0))
                ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                ->addForeignKey('cartridgeitem_id', 'glpi_cartridgeitem', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                ->addForeignKey('printer_id', 'glpi_printer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                ->addIndex(array('cartridgeitem_id'))
                ->addIndex(array('printer_id'))
                ->addIndex(array('entity_id'))
                ->addIndex(array('date_mod'))
                ->addIndex(array('date_creation'))
                ->create();

      // create the table glpi_group_user
      $group_user = $this->table('glpi_group_user');
      $group_user->addColumn('user_id', 'integer')
                 ->addColumn('group_id', 'integer')
                 ->addColumn('is_dynamic', 'boolean', array('default' => false))
                 ->addColumn('is_manager', 'boolean', array('default' => false))
                 ->addColumn('is_userdelegate', 'boolean', array('default' => false))
                 ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('user_id', 'group_id'), array('unique' => true))
                 ->addIndex(array('group_id'))
                 ->addIndex(array('is_manager'))
                 ->addIndex(array('is_userdelegate'))
                 ->create();

      // create the table glpi_group_ticket
      $group_ticket = $this->table('glpi_group_ticket');
      $group_ticket->addColumn('ticket_id', 'integer')
                   ->addColumn('group_id', 'integer')
                   ->addColumn('type', 'integer', array('default' => 1))
                   ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('ticket_id', 'type', 'group_id'), array('unique' => true))
                   ->addIndex(array('group_id', 'type'))
                   ->create();

      // create the table glpi_group_rssfeed
      $group_rssfeed = $this->table('glpi_group_rssfeed');
      $group_rssfeed->addColumn('rssfeed_id', 'integer')
                    ->addColumn('group_id', 'integer')
                    ->addColumn('entity_id', 'integer')
                    ->addColumn('is_recursive', 'boolean', array('default' => false))
                    ->addForeignKey('rssfeed_id', 'glpi_rssfeed', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('rssfeed_id'))
                    ->addIndex(array('group_id'))
                    ->addIndex(array('entity_id'))
                    ->addIndex(array('is_recursive'))
                    ->create();

      // create the table glpi_group_problem
      $group_problem = $this->table('glpi_group_problem');
      $group_problem->addColumn('problem_id', 'integer')
                    ->addColumn('group_id', 'integer')
                    ->addColumn('type', 'integer', array('default' => 1))
                    ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('problem_id', 'type', 'group_id'), array('unique' => true))
                    ->addIndex(array('group_id', 'type'))
                    ->create();

      // create the table glpi_entity_rssfeed
      $entity_rssfeed = $this->table('glpi_entity_rssfeed');
      $entity_rssfeed->addColumn('rssfeed_id', 'integer')
                     ->addColumn('entity_id', 'integer')
                     ->addColumn('is_recursive', 'boolean', array('default' => false))
                     ->addForeignKey('rssfeed_id', 'glpi_rssfeed', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('rssfeed_id'))
                     ->addIndex(array('entity_id'))
                     ->addIndex(array('is_recursive'))
                     ->create();

      // create the table glpi_computer_softwarelicense
      $computer_softwarelicense = $this->table('glpi_computer_softwarelicense');
      $computer_softwarelicense->addColumn('computer_id', 'integer')
                               ->addColumn('softwarelicense_id', 'integer')
                               ->addColumn('is_deleted', 'boolean', array('default' => false))
                               ->addColumn('is_dynamic', 'boolean', array('default' => false))
                               ->addForeignKey('computer_id', 'glpi_computer', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                               ->addForeignKey('softwarelicense_id', 'glpi_softwarelicense', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                               ->addIndex(array('computer_id', 'softwarelicense_id'), array('unique' => true))
                               ->addIndex(array('computer_id'))
                               ->addIndex(array('softwarelicense_id'))
                               ->addIndex(array('is_deleted'))
                               ->addIndex(array('is_dynamic'))
                               ->create();

      // create the table glpi_computer_softwareversion
      $computer_softwareversion = $this->table('glpi_computer_softwareversion');
      $computer_softwareversion->addColumn('computer_id', 'integer')
                               ->addColumn('softwareversion_id', 'integer')
                               ->addColumn('is_deleted_computer', 'boolean', array('default' => false))
                               ->addColumn('is_template_computer', 'boolean', array('default' => false))
                               ->addColumn('entity_id', 'integer')
                               ->addColumn('is_deleted', 'boolean', array('default' => false))
                               ->addColumn('is_dynamic', 'boolean', array('default' => false))
                               ->addColumn('date_install', 'date', array('null' => true, 'default' => null))
                               ->addForeignKey('computer_id', 'glpi_computer', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                               ->addForeignKey('softwareversion_id', 'glpi_softwareversion', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                               ->addIndex(array('computer_id', 'softwareversion_id'), array('unique' => true))
                               ->addIndex(array('softwareversion_id'))
                               ->addIndex(array('entity_id', 'is_template_computer', 'is_deleted_computer'))
                               ->addIndex(array('is_template_computer'))
                               ->addIndex(array('is_deleted_computer'))
                               ->addIndex(array('is_dynamic'))
                               ->addIndex(array('date_install'))
                               ->create();

      // create the table glpi_knowbaseitem
      $knowbaseitem = $this->table('glpi_knowbaseitem');
      $knowbaseitem->addColumn('name', 'string')
                   ->addColumn('knowbaseitemcategory_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('answer', 'text')
                   ->addColumn('is_faq', 'boolean', array('default' => false))
                   ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('view', 'integer', array('default' => 0))
                   ->addColumn('date', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('begin_date', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('end_date', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('knowbaseitemcategory_id', 'glpi_knowbaseitemcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('user_id'))
                   ->addIndex(array('knowbaseitemcategory_id'))
                   ->addIndex(array('is_faq'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_entity_knowbaseitem
      $entity_knowbaseitem = $this->table('glpi_entity_knowbaseitem');
      $entity_knowbaseitem->addColumn('knowbaseitem_id', 'integer')
                          ->addColumn('entity_id', 'integer')
                          ->addColumn('is_recursive', 'boolean', array('default' => false))
                          ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                          ->addForeignKey('knowbaseitem_id', 'glpi_knowbaseitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                          ->addIndex(array('knowbaseitem_id'))
                          ->addIndex(array('entity_id'))
                          ->addIndex(array('is_recursive'))
                          ->create();

      // create the table glpi_group_knowbaseitem
      $group_knowbaseitem = $this->table('glpi_group_knowbaseitem');
      $group_knowbaseitem->addColumn('knowbaseitem_id', 'integer')
                         ->addColumn('group_id', 'integer')
                         ->addColumn('entity_id', 'integer')
                         ->addColumn('is_recursive', 'boolean', array('default' => false))
                         ->addForeignKey('knowbaseitem_id', 'glpi_knowbaseitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addIndex(array('knowbaseitem_id'))
                         ->addIndex(array('group_id'))
                         ->addIndex(array('entity_id'))
                         ->addIndex(array('is_recursive'))
                         ->create();

      // create the table glpi_knowbaseitem_profile
      $knowbaseitem_profile = $this->table('glpi_knowbaseitem_profile');
      $knowbaseitem_profile->addColumn('knowbaseitem_id', 'integer')
                           ->addColumn('profile_id', 'integer')
                           ->addColumn('entity_id', 'integer')
                           ->addColumn('is_recursive', 'boolean', array('default' => false))
                           ->addForeignKey('knowbaseitem_id', 'glpi_knowbaseitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addForeignKey('profile_id', 'glpi_profile', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addIndex(array('knowbaseitem_id'))
                           ->addIndex(array('profile_id'))
                           ->addIndex(array('entity_id'))
                           ->addIndex(array('is_recursive'))
                           ->create();

      // create the table glpi_knowbaseitem_user
      $knowbaseitem_user = $this->table('glpi_knowbaseitem_user');
      $knowbaseitem_user->addColumn('knowbaseitem_id', 'integer')
                        ->addColumn('user_id', 'integer')
                        ->addForeignKey('knowbaseitem_id', 'glpi_knowbaseitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('knowbaseitem_id'))
                        ->addIndex(array('user_id'))
                        ->create();

      // create the table glpi_profile_reminder
      $profile_reminder = $this->table('glpi_profile_reminder');
      $profile_reminder->addColumn('reminder_id', 'integer')
                       ->addColumn('profile_id', 'integer')
                       ->addColumn('entity_id', 'integer', array('default' => -1))
                       ->addColumn('is_recursive', 'boolean', array('default' => false))
                       ->addForeignKey('reminder_id', 'glpi_reminder', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('profile_id', 'glpi_profile', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
//                       ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('reminder_id'))
                       ->addIndex(array('profile_id'))
                       ->addIndex(array('entity_id'))
                       ->addIndex(array('is_recursive'))
                       ->create();

      // create the table glpi_profile_rssfeed
      $profile_rssfeed = $this->table('glpi_profile_rssfeed');
      $profile_rssfeed->addColumn('rssfeed_id', 'integer')
                      ->addColumn('profile_id', 'integer')
                      ->addColumn('entity_id', 'integer', array('default' => -1))
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addForeignKey('rssfeed_id', 'glpi_rssfeed', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('profile_id', 'glpi_profile', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
//                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('rssfeed_id'))
                      ->addIndex(array('profile_id'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->create();

      // create the table glpi_infocom
      $infocom = $this->table('glpi_infocom');
      $infocom->addColumn('itemtype', 'string', array('limit' => 100))
              ->addColumn('items_id', 'integer', array('default' => 0))
              ->addColumn('entity_id', 'integer')
              ->addColumn('is_recursive', 'boolean', array('default' => false))
              ->addColumn('buy_date', 'date', array('default' => null, 'null' => true))
              ->addColumn('use_date', 'date', array('default' => null, 'null' => true))
              ->addColumn('warranty_duration', 'integer', array('default' => 0))
              ->addColumn('warranty_info', 'string', array('default' => ''))
              ->addColumn('supplier_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('order_number', 'string', array('default' => ''))
              ->addColumn('delivery_number', 'string', array('default' => ''))
              ->addColumn('immo_number', 'string', array('default' => ''))
              ->addColumn('value', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
              ->addColumn('warranty_value', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
              ->addColumn('sink_time', 'integer', array('default' => 0))
              ->addColumn('sink_type', 'integer', array('default' => 0))
              ->addColumn('sink_coeff', 'float', array('default' => 0))
              ->addColumn('bill', 'string', array('default' => ''))
              ->addColumn('budget_id', 'integer', array('default' => null, 'null' => true))
              ->addColumn('alert', 'integer', array('default' => 0))
              ->addColumn('order_date', 'date', array('default' => null, 'null' => true))
              ->addColumn('delivery_date', 'date', array('default' => null, 'null' => true))
              ->addColumn('inventory_date', 'date', array('default' => null, 'null' => true))
              ->addColumn('warranty_date', 'date', array('default' => null, 'null' => true))
              ->addColumn('decommission_date', 'datetime', array('default' => null, 'null' => true))
              ->addColumn('comment', 'text')
              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
              ->addForeignKey('supplier_id', 'glpi_supplier', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addForeignKey('budget_id', 'glpi_budget', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
              ->addIndex(array('itemtype', 'items_id'), array('unique' => true))
              ->addIndex(array('buy_date'))
              ->addIndex(array('alert'))
              ->addIndex(array('budget_id'))
              ->addIndex(array('supplier_id'))
              ->addIndex(array('entity_id'))
              ->addIndex(array('is_recursive'))
              ->addIndex(array('date_mod'))
              ->addIndex(array('date_creation'))
              ->create();

      // create the table glpi_change
      $change = $this->table('glpi_change');
      $change->addColumn('name', 'string')
             ->addColumn('entity_id', 'integer')
             ->addColumn('is_recursive', 'boolean', array('default' => false))
             ->addColumn('is_deleted', 'boolean', array('default' => false))
             ->addColumn('status', 'integer', array('default' => 1))
             ->addColumn('content', 'text')
             ->addColumn('date', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('solvedate', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('closedate', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('due_date', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('user_id_recipient', 'integer', array('default' => null, 'null' => true))
             ->addColumn('user_id_lastupdater', 'integer', array('default' => null, 'null' => true))
             ->addColumn('urgency', 'integer', array('default' => 1))
             ->addColumn('impact', 'integer', array('default' => 1))
             ->addColumn('priority', 'integer', array('default' => 1))
             ->addColumn('itilcategory_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('impactcontent', 'text')
             ->addColumn('controlistcontent', 'text')
             ->addColumn('rolloutplancontent', 'text')
             ->addColumn('backoutplancontent', 'text')
             ->addColumn('checklistcontent', 'text')
             ->addColumn('global_validation', 'integer', array('default' => 1))
             ->addColumn('validation_percent', 'integer', array('limit' => 3, 'default' => 0))
             ->addColumn('solutiontype_id', 'integer', array('default' => null, 'null' => true))
             ->addColumn('solution', 'text')
             ->addColumn('actiontime', 'integer', array('default' => 0))
             ->addColumn('begin_waiting_date', 'datetime', array('default' => null, 'null' => true))
             ->addColumn('waiting_duration', 'integer', array('default' => 0))
             ->addColumn('close_delay_stat', 'integer', array('default' => 0))
             ->addColumn('solve_delay_stat', 'integer', array('default' => 0))
             ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
             ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
             ->addForeignKey('user_id_recipient', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('user_id_lastupdater', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('itilcategory_id', 'glpi_itilcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addForeignKey('solutiontype_id', 'glpi_solutiontype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
             ->addIndex(array('name'))
             ->addIndex(array('entity_id'))
             ->addIndex(array('is_recursive'))
             ->addIndex(array('is_deleted'))
             ->addIndex(array('date'))
             ->addIndex(array('closedate'))
             ->addIndex(array('status'))
             ->addIndex(array('priority'))
             ->addIndex(array('itilcategory_id'))
             ->addIndex(array('user_id_recipient'))
             ->addIndex(array('solvedate'))
             ->addIndex(array('solutiontype_id'))
             ->addIndex(array('urgency'))
             ->addIndex(array('impact'))
             ->addIndex(array('due_date'))
             ->addIndex(array('global_validation'))
             ->addIndex(array('user_id_lastupdater'))
             ->addIndex(array('date_mod'))
             ->addIndex(array('date_creation'))
             ->create();

      // create the table glpi_change_group
      $change_group = $this->table('glpi_change_group');
      $change_group->addColumn('change_id', 'integer')
                   ->addColumn('group_id', 'integer')
                   ->addColumn('type', 'integer', array('default' => 1))
                   ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('change_id', 'type', 'group_id'), array('unique' => true))
                   ->addIndex(array('group_id', 'type'))
                   ->create();

      // create the table glpi_changecost
      $changecost = $this->table('glpi_changecost');
      $changecost->addColumn('name', 'string')
                 ->addColumn('entity_id', 'integer')
                 ->addColumn('is_recursive', 'boolean', array('default' => false))
                 ->addColumn('change_id', 'integer')
                 ->addColumn('begin_date', 'date', array('null' => true, 'default' => null))
                 ->addColumn('end_date', 'date', array('null' => true, 'default' => null))
                 ->addColumn('actiontime', 'integer', array('default' => 0))
                 ->addColumn('cost_time', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                 ->addColumn('cost_fixed', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                 ->addColumn('cost_material', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                 ->addColumn('budget_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('comment', 'text')
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('budget_id', 'glpi_budget', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('name'))
                 ->addIndex(array('change_id'))
                 ->addIndex(array('begin_date'))
                 ->addIndex(array('end_date'))
                 ->addIndex(array('entity_id'))
                 ->addIndex(array('is_recursive'))
                 ->addIndex(array('budget_id'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_change_problem
      $change_problem = $this->table('glpi_change_problem');
      $change_problem->addColumn('change_id', 'integer')
                     ->addColumn('problem_id', 'integer')
                     ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('change_id', 'problem_id'), array('unique' => true))
                     ->addIndex(array('problem_id'))
                     ->create();

      // create the table glpi_change_project
      $change_project = $this->table('glpi_change_project');
      $change_project->addColumn('change_id', 'integer')
                     ->addColumn('project_id', 'integer')
                     ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('project_id', 'glpi_project', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('change_id', 'project_id'), array('unique' => true))
                     ->addIndex(array('project_id'))
                     ->create();

      // create the table glpi_change_supplier
      $change_supplier = $this->table('glpi_change_supplier');
      $change_supplier->addColumn('change_id', 'integer')
                      ->addColumn('supplier_id', 'integer')
                      ->addColumn('type', 'integer', array('default' => 1))
                      ->addColumn('use_notification', 'boolean', array('default' => false))
                      ->addColumn('alternative_email', 'string', array('default' => ''))
                      ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('supplier_id', 'glpi_supplier', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('change_id', 'type', 'supplier_id'), array('unique' => true))
                      ->addIndex(array('supplier_id', 'type'))
                      ->create();

      // create the table glpi_change_ticket
      $change_ticket = $this->table('glpi_change_ticket');
      $change_ticket->addColumn('change_id', 'integer')
                    ->addColumn('ticket_id', 'integer')
                    ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('change_id', 'ticket_id'), array('unique' => true))
                    ->addIndex(array('ticket_id'))
                    ->create();

      // create the table glpi_change_user
      $change_user = $this->table('glpi_change_user');
      $change_user->addColumn('change_id', 'integer')
                  ->addColumn('user_id', 'integer')
                  ->addColumn('type', 'integer', array('default' => 1))
                  ->addColumn('use_notification', 'boolean', array('default' => false))
                  ->addColumn('alternative_email', 'string', array('default' => ''))
                  ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('change_id', 'type', 'user_id', 'alternative_email'), array('unique' => true))
                  ->addIndex(array('user_id', 'type'))
                  ->create();

      // create the table glpi_change_item
      $change_item = $this->table('glpi_change_item');
      $change_item->addColumn('change_id', 'integer')
                  ->addColumn('itemtype', 'string', array('limit' => 100))
                  ->addColumn('items_id', 'integer', array('default' => 0))
                  ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('change_id', 'itemtype', 'items_id'), array('unique' => true))
                  ->addIndex(array('itemtype', 'items_id'))
                  ->create();

      // create the table glpi_changetask
      $changetask = $this->table('glpi_changetask');
      $changetask->addColumn('change_id', 'integer')
                 ->addColumn('taskcategory_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('state', 'integer', array('default' => 0))
                 ->addColumn('date', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('begin_date', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('end_date', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                 ->addColumn('content', 'text')
                 ->addColumn('actiontime', 'integer', array('default' => 0))
                 ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                 ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                 ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('taskcategory_id', 'glpi_taskcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('change_id'))
                 ->addIndex(array('state'))
                 ->addIndex(array('user_id'))
                 ->addIndex(array('user_id_tech'))
                 ->addIndex(array('group_id_tech'))
                 ->addIndex(array('date'))
                 ->addIndex(array('begin_date'))
                 ->addIndex(array('end_date'))
                 ->addIndex(array('taskcategory_id'))
                 ->addIndex(array('date_mod'))
                 ->addIndex(array('date_creation'))
                 ->create();

      // create the table glpi_changevalidation
      $changevalidation = $this->table('glpi_changevalidation');
      $changevalidation->addColumn('entity_id', 'integer')
                       ->addColumn('is_recursive', 'boolean', array('default' => false))
                       ->addColumn('change_id', 'integer')
                       ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('user_id_validate', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('comment_submission', 'text')
                       ->addColumn('comment_validation', 'text')
                       ->addColumn('status', 'integer', array('default' => 2))
                       ->addColumn('submission_date', 'datetime', array('default' => null, 'null' => true))
                       ->addColumn('validation_date', 'datetime', array('default' => null, 'null' => true))
                       ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('change_id', 'glpi_change', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id_validate', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('entity_id'))
                       ->addIndex(array('is_recursive'))
                       ->addIndex(array('user_id'))
                       ->addIndex(array('user_id_validate'))
                       ->addIndex(array('change_id'))
                       ->addIndex(array('submission_date'))
                       ->addIndex(array('validation_date'))
                       ->addIndex(array('status'))
                       ->create();

      // create the table glpi_document
      $document = $this->table('glpi_document');
      $document->addColumn('name', 'string')
               ->addColumn('entity_id', 'integer')
               ->addColumn('is_recursive', 'boolean', array('default' => false))
               ->addColumn('filename', 'string', array('default' => '', 'comment' => 'for display and transfert'))
               ->addColumn('filepath', 'string', array('default' => '', 'comment' => 'file storage path'))
               ->addColumn('documentcategory_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('mime', 'string', array('default' => ''))
               ->addColumn('is_deleted', 'boolean', array('default' => false))
               ->addColumn('link', 'string', array('default' => ''))
               ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('ticket_id', 'integer', array('default' => null, 'null' => true))
               ->addColumn('sha1sum', 'char', array('limit' => 40, 'default' => ''))
               ->addColumn('is_blacklisted', 'boolean', array('default' => false))
               ->addColumn('tag', 'string', array('default' => ''))
               ->addColumn('comment', 'text')
               ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
               ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
               ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
               ->addForeignKey('documentcategory_id', 'glpi_documentcategory', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
               ->addIndex(array('name'))
               ->addIndex(array('entity_id'))
               ->addIndex(array('ticket_id'))
               ->addIndex(array('user_id'))
               ->addIndex(array('documentcategory_id'))
               ->addIndex(array('is_deleted'))
               ->addIndex(array('sha1sum'))
               ->addIndex(array('tag'))
               ->addIndex(array('date_mod'))
               ->addIndex(array('date_creation'))
               ->create();

      // create the table glpi_document_item
      $document_item = $this->table('glpi_document_item');
      $document_item->addColumn('document_id', 'integer')
                    ->addColumn('itemtype', 'string', array('limit' => 100))
                    ->addColumn('items_id', 'integer', array('default' => 0))
                    ->addColumn('entity_id', 'integer')
                    ->addColumn('is_recursive', 'boolean', array('default' => false))
                    ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                    ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                    ->addForeignKey('document_id', 'glpi_document', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                    ->addIndex(array('document_id', 'itemtype', 'items_id'), array('unique' => true))
                    ->addIndex(array('itemtype', 'items_id', 'entity_id', 'is_recursive'))
                    ->create();

      // create the table glpi_ipaddress_ipnetwork
      $ipaddress_ipnetwork = $this->table('glpi_ipaddress_ipnetwork');
      $ipaddress_ipnetwork->addColumn('ipaddress_id', 'integer')
                          ->addColumn('ipnetwork_id', 'integer')
                          ->addForeignKey('ipaddress_id', 'glpi_ipaddress', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                          ->addForeignKey('ipnetwork_id', 'glpi_ipnetwork', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                          ->addIndex(array('ipaddress_id', 'ipnetwork_id'), array('unique' => true))
                          ->addIndex(array('ipnetwork_id'))
                          ->addIndex(array('ipaddress_id'))
                          ->create();

      // create the table glpi_ipnetwork_vlan
      $ipnetwork_vlan = $this->table('glpi_ipnetwork_vlan');
      $ipnetwork_vlan->addColumn('ipnetwork_id', 'integer')
                     ->addColumn('vlan_id', 'integer')
                     ->addForeignKey('ipnetwork_id', 'glpi_ipnetwork', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('vlan_id', 'glpi_vlan', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('ipnetwork_id', 'vlan_id'), array('unique' => true))
                     ->create();

      // create the table glpi_item_devicecase
      $item_devicecase = $this->table('glpi_item_devicecase');
      $item_devicecase->addColumn('devicecase_id', 'integer')
                      ->addColumn('itemtype', 'string', array('limit' => 100))
                      ->addColumn('items_id', 'integer', array('default' => 0))
                      ->addColumn('entity_id', 'integer')
                      ->addColumn('is_recursive', 'boolean', array('default' => false))
                      ->addColumn('is_deleted', 'boolean', array('default' => false))
                      ->addColumn('is_dynamic', 'boolean', array('default' => false))
                      ->addColumn('serial', 'string', array('default' => ''))
                      ->addForeignKey('devicecase_id', 'glpi_devicecase', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('items_id'))
                      ->addIndex(array('devicecase_id'))
                      ->addIndex(array('is_deleted'))
                      ->addIndex(array('is_dynamic'))
                      ->addIndex(array('entity_id'))
                      ->addIndex(array('is_recursive'))
                      ->addIndex(array('serial'))
                      ->addIndex(array('itemtype', 'items_id'))
                      ->create();

      // create the table glpi_item_devicecontrol
      $item_devicecontrol = $this->table('glpi_item_devicecontrol');
      $item_devicecontrol->addColumn('devicecontrol_id', 'integer')
                         ->addColumn('itemtype', 'string', array('limit' => 100))
                         ->addColumn('items_id', 'integer', array('default' => 0))
                         ->addColumn('entity_id', 'integer')
                         ->addColumn('is_recursive', 'boolean', array('default' => false))
                         ->addColumn('is_deleted', 'boolean', array('default' => false))
                         ->addColumn('is_dynamic', 'boolean', array('default' => false))
                         ->addColumn('serial', 'string', array('default' => ''))
                         ->addColumn('busid', 'string', array('default' => ''))
                         ->addForeignKey('devicecontrol_id', 'glpi_devicecontrol', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addIndex(array('items_id'))
                         ->addIndex(array('devicecontrol_id'))
                         ->addIndex(array('is_deleted'))
                         ->addIndex(array('is_dynamic'))
                         ->addIndex(array('entity_id'))
                         ->addIndex(array('is_recursive'))
                         ->addIndex(array('serial'))
                         ->addIndex(array('busid'))
                         ->addIndex(array('itemtype', 'items_id'))
                         ->create();

      // create the table glpi_item_devicedrive
      $item_devicedrive = $this->table('glpi_item_devicedrive');
      $item_devicedrive->addColumn('devicedrive_id', 'integer')
                       ->addColumn('itemtype', 'string', array('limit' => 100))
                       ->addColumn('items_id', 'integer', array('default' => 0))
                       ->addColumn('entity_id', 'integer')
                       ->addColumn('is_recursive', 'boolean', array('default' => false))
                       ->addColumn('is_deleted', 'boolean', array('default' => false))
                       ->addColumn('is_dynamic', 'boolean', array('default' => false))
                       ->addColumn('serial', 'string', array('default' => ''))
                       ->addColumn('busid', 'string', array('default' => ''))
                       ->addForeignKey('devicedrive_id', 'glpi_devicedrive', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('items_id'))
                       ->addIndex(array('devicedrive_id'))
                       ->addIndex(array('is_deleted'))
                       ->addIndex(array('is_dynamic'))
                       ->addIndex(array('entity_id'))
                       ->addIndex(array('is_recursive'))
                       ->addIndex(array('serial'))
                       ->addIndex(array('busid'))
                       ->addIndex(array('itemtype', 'items_id'))
                       ->create();

      // create the table glpi_item_devicegraphiccard
      $item_devicegraphiccard = $this->table('glpi_item_devicegraphiccard');
      $item_devicegraphiccard->addColumn('devicegraphiccard_id', 'integer')
                             ->addColumn('itemtype', 'string', array('limit' => 100))
                             ->addColumn('items_id', 'integer', array('default' => 0))
                             ->addColumn('entity_id', 'integer')
                             ->addColumn('is_recursive', 'boolean', array('default' => false))
                             ->addColumn('is_deleted', 'boolean', array('default' => false))
                             ->addColumn('is_dynamic', 'boolean', array('default' => false))
                             ->addColumn('serial', 'string', array('default' => ''))
                             ->addColumn('busid', 'string', array('default' => ''))
                             ->addColumn('memory', 'integer', array('default' => 0))
                             ->addForeignKey('devicegraphiccard_id', 'glpi_devicegraphiccard', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addIndex(array('items_id'))
                             ->addIndex(array('devicegraphiccard_id'))
                             ->addIndex(array('is_deleted'))
                             ->addIndex(array('is_dynamic'))
                             ->addIndex(array('entity_id'))
                             ->addIndex(array('is_recursive'))
                             ->addIndex(array('serial'))
                             ->addIndex(array('busid'))
                             ->addIndex(array('memory'))
                             ->addIndex(array('itemtype', 'items_id'))
                             ->create();

      // create the table glpi_item_deviceharddrive
      $item_deviceharddrive = $this->table('glpi_item_deviceharddrive');
      $item_deviceharddrive->addColumn('deviceharddrive_id', 'integer')
                           ->addColumn('itemtype', 'string', array('limit' => 100))
                           ->addColumn('items_id', 'integer', array('default' => 0))
                           ->addColumn('entity_id', 'integer')
                           ->addColumn('is_recursive', 'boolean', array('default' => false))
                           ->addColumn('is_deleted', 'boolean', array('default' => false))
                           ->addColumn('is_dynamic', 'boolean', array('default' => false))
                           ->addColumn('serial', 'string', array('default' => ''))
                           ->addColumn('busid', 'string', array('default' => ''))
                           ->addColumn('capacity', 'integer', array('default' => 0))
                           ->addForeignKey('deviceharddrive_id', 'glpi_deviceharddrive', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addIndex(array('items_id'))
                           ->addIndex(array('deviceharddrive_id'))
                           ->addIndex(array('is_deleted'))
                           ->addIndex(array('is_dynamic'))
                           ->addIndex(array('entity_id'))
                           ->addIndex(array('is_recursive'))
                           ->addIndex(array('serial'))
                           ->addIndex(array('busid'))
                           ->addIndex(array('capacity'))
                           ->addIndex(array('itemtype', 'items_id'))
                           ->create();

      // create the table glpi_item_devicememory
      $item_devicememory = $this->table('glpi_item_devicememory');
      $item_devicememory->addColumn('devicememory_id', 'integer')
                        ->addColumn('itemtype', 'string', array('limit' => 100))
                        ->addColumn('items_id', 'integer', array('default' => 0))
                        ->addColumn('entity_id', 'integer')
                        ->addColumn('is_recursive', 'boolean', array('default' => false))
                        ->addColumn('is_deleted', 'boolean', array('default' => false))
                        ->addColumn('is_dynamic', 'boolean', array('default' => false))
                        ->addColumn('serial', 'string', array('default' => ''))
                        ->addColumn('busid', 'string', array('default' => ''))
                        ->addColumn('size', 'integer', array('default' => 0))
                        ->addForeignKey('devicememory_id', 'glpi_devicememory', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                        ->addIndex(array('items_id'))
                        ->addIndex(array('devicememory_id'))
                        ->addIndex(array('is_deleted'))
                        ->addIndex(array('is_dynamic'))
                        ->addIndex(array('entity_id'))
                        ->addIndex(array('is_recursive'))
                        ->addIndex(array('serial'))
                        ->addIndex(array('busid'))
                        ->addIndex(array('size'))
                        ->addIndex(array('itemtype', 'items_id'))
                        ->create();

      // create the table glpi_item_devicemotherboard
      $item_devicemotherboard = $this->table('glpi_item_devicemotherboard');
      $item_devicemotherboard->addColumn('devicemotherboard_id', 'integer')
                             ->addColumn('itemtype', 'string', array('limit' => 100))
                             ->addColumn('items_id', 'integer', array('default' => 0))
                             ->addColumn('entity_id', 'integer')
                             ->addColumn('is_recursive', 'boolean', array('default' => false))
                             ->addColumn('is_deleted', 'boolean', array('default' => false))
                             ->addColumn('is_dynamic', 'boolean', array('default' => false))
                             ->addColumn('serial', 'string', array('default' => ''))
                             ->addForeignKey('devicemotherboard_id', 'glpi_devicemotherboard', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addIndex(array('items_id'))
                             ->addIndex(array('devicemotherboard_id'))
                             ->addIndex(array('is_deleted'))
                             ->addIndex(array('is_dynamic'))
                             ->addIndex(array('entity_id'))
                             ->addIndex(array('is_recursive'))
                             ->addIndex(array('serial'))
                             ->addIndex(array('itemtype', 'items_id'))
                             ->create();

      // create the table glpi_item_devicenetworkcard
      $item_devicenetworkcard = $this->table('glpi_item_devicenetworkcard');
      $item_devicenetworkcard->addColumn('devicenetworkcard_id', 'integer')
                             ->addColumn('itemtype', 'string', array('limit' => 100))
                             ->addColumn('items_id', 'integer', array('default' => 0))
                             ->addColumn('entity_id', 'integer')
                             ->addColumn('is_recursive', 'boolean', array('default' => false))
                             ->addColumn('is_deleted', 'boolean', array('default' => false))
                             ->addColumn('is_dynamic', 'boolean', array('default' => false))
                             ->addColumn('serial', 'string', array('default' => ''))
                             ->addColumn('busid', 'string', array('default' => ''))
                             ->addColumn('mac', 'string', array('default' => ''))
                             ->addForeignKey('devicenetworkcard_id', 'glpi_devicenetworkcard', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addIndex(array('items_id'))
                             ->addIndex(array('devicenetworkcard_id'))
                             ->addIndex(array('is_deleted'))
                             ->addIndex(array('is_dynamic'))
                             ->addIndex(array('entity_id'))
                             ->addIndex(array('is_recursive'))
                             ->addIndex(array('serial'))
                             ->addIndex(array('busid'))
                             ->addIndex(array('mac'))
                             ->addIndex(array('itemtype', 'items_id'))
                             ->create();

      // create the table glpi_item_devicepci
      $item_devicepci = $this->table('glpi_item_devicepci');
      $item_devicepci->addColumn('devicepci_id', 'integer')
                     ->addColumn('itemtype', 'string', array('limit' => 100))
                     ->addColumn('items_id', 'integer', array('default' => 0))
                     ->addColumn('entity_id', 'integer')
                     ->addColumn('is_recursive', 'boolean', array('default' => false))
                     ->addColumn('is_deleted', 'boolean', array('default' => false))
                     ->addColumn('is_dynamic', 'boolean', array('default' => false))
                     ->addColumn('serial', 'string', array('default' => ''))
                     ->addColumn('busid', 'string', array('default' => ''))
                     ->addForeignKey('devicepci_id', 'glpi_devicepci', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('items_id'))
                     ->addIndex(array('devicepci_id'))
                     ->addIndex(array('is_deleted'))
                     ->addIndex(array('is_dynamic'))
                     ->addIndex(array('entity_id'))
                     ->addIndex(array('is_recursive'))
                     ->addIndex(array('serial'))
                     ->addIndex(array('busid'))
                     ->addIndex(array('itemtype', 'items_id'))
                     ->create();

      // create the table glpi_item_devicepowersupply
      $item_devicepowersupply = $this->table('glpi_item_devicepowersupply');
      $item_devicepowersupply->addColumn('devicepowersupply_id', 'integer')
                             ->addColumn('itemtype', 'string', array('limit' => 100))
                             ->addColumn('items_id', 'integer', array('default' => 0))
                             ->addColumn('entity_id', 'integer')
                             ->addColumn('is_recursive', 'boolean', array('default' => false))
                             ->addColumn('is_deleted', 'boolean', array('default' => false))
                             ->addColumn('is_dynamic', 'boolean', array('default' => false))
                             ->addColumn('serial', 'string', array('default' => ''))
                             ->addForeignKey('devicepowersupply_id', 'glpi_devicepowersupply', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                             ->addIndex(array('items_id'))
                             ->addIndex(array('devicepowersupply_id'))
                             ->addIndex(array('is_deleted'))
                             ->addIndex(array('is_dynamic'))
                             ->addIndex(array('entity_id'))
                             ->addIndex(array('is_recursive'))
                             ->addIndex(array('serial'))
                             ->addIndex(array('itemtype', 'items_id'))
                             ->create();

      // create the table glpi_item_deviceprocessor
      $item_deviceprocessor = $this->table('glpi_item_deviceprocessor');
      $item_deviceprocessor->addColumn('deviceprocessor_id', 'integer')
                           ->addColumn('itemtype', 'string', array('limit' => 100))
                           ->addColumn('items_id', 'integer', array('default' => 0))
                           ->addColumn('entity_id', 'integer')
                           ->addColumn('is_recursive', 'boolean', array('default' => false))
                           ->addColumn('is_deleted', 'boolean', array('default' => false))
                           ->addColumn('is_dynamic', 'boolean', array('default' => false))
                           ->addColumn('serial', 'string', array('default' => ''))
                           ->addColumn('busid', 'string', array('default' => ''))
                           ->addColumn('frequency', 'integer', array('default' => 0))
                           ->addColumn('nbcores', 'integer', array('default' => 0))
                           ->addColumn('nbthreads', 'integer', array('default' => 0))
                           ->addForeignKey('deviceprocessor_id', 'glpi_deviceprocessor', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addIndex(array('items_id'))
                           ->addIndex(array('deviceprocessor_id'))
                           ->addIndex(array('is_deleted'))
                           ->addIndex(array('is_dynamic'))
                           ->addIndex(array('entity_id'))
                           ->addIndex(array('is_recursive'))
                           ->addIndex(array('serial'))
                           ->addIndex(array('busid'))
                           ->addIndex(array('frequency'))
                           ->addIndex(array('nbcores'))
                           ->addIndex(array('nbthreads'))
                           ->addIndex(array('itemtype', 'items_id'))
                           ->create();

      // create the table glpi_item_devicesoundcard
      $item_devicesoundcard = $this->table('glpi_item_devicesoundcard');
      $item_devicesoundcard->addColumn('devicesoundcard_id', 'integer')
                           ->addColumn('itemtype', 'string', array('limit' => 100))
                           ->addColumn('items_id', 'integer', array('default' => 0))
                           ->addColumn('entity_id', 'integer')
                           ->addColumn('is_recursive', 'boolean', array('default' => false))
                           ->addColumn('is_deleted', 'boolean', array('default' => false))
                           ->addColumn('is_dynamic', 'boolean', array('default' => false))
                           ->addColumn('serial', 'string', array('default' => ''))
                           ->addColumn('busid', 'string', array('default' => ''))
                           ->addForeignKey('devicesoundcard_id', 'glpi_devicesoundcard', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                           ->addIndex(array('items_id'))
                           ->addIndex(array('devicesoundcard_id'))
                           ->addIndex(array('is_deleted'))
                           ->addIndex(array('is_dynamic'))
                           ->addIndex(array('entity_id'))
                           ->addIndex(array('is_recursive'))
                           ->addIndex(array('serial'))
                           ->addIndex(array('busid'))
                           ->addIndex(array('itemtype', 'items_id'))
                           ->create();

      // create the table glpi_item_problem
      $item_problem = $this->table('glpi_item_problem');
      $item_problem->addColumn('problem_id', 'integer')
                   ->addColumn('itemtype', 'string', array('limit' => 100))
                   ->addColumn('items_id', 'integer', array('default' => 0))
                   ->addForeignKey('problem_id', 'glpi_problem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('problem_id', 'itemtype', 'items_id'), array('unique' => true))
                   ->addIndex(array('itemtype', 'items_id'))
                   ->create();

      // create the table glpi_item_project
      $item_project = $this->table('glpi_item_project');
      $item_project->addColumn('project_id', 'integer')
                   ->addColumn('itemtype', 'string', array('limit' => 100))
                   ->addColumn('items_id', 'integer', array('default' => 0))
                   ->addForeignKey('project_id', 'glpi_project', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('project_id', 'itemtype', 'items_id'), array('unique' => true))
                   ->addIndex(array('itemtype', 'items_id'))
                   ->create();

      // create the table glpi_item_ticket
      $item_ticket = $this->table('glpi_item_ticket');
      $item_ticket->addColumn('ticket_id', 'integer')
                  ->addColumn('itemtype', 'string', array('limit' => 100))
                  ->addColumn('items_id', 'integer', array('default' => 0))
                  ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('ticket_id', 'items_id', 'itemtype'), array('unique' => true))
                  ->addIndex(array('ticket_id'))
                  ->create();

      // create the table glpi_knowbaseitemtranslation
      $knowbaseitemtranslation = $this->table('glpi_knowbaseitemtranslation');
      $knowbaseitemtranslation->addColumn('knowbaseitem_id', 'integer')
                              ->addColumn('language', 'string', array('limit' => 5, 'null' => true))
                              ->addColumn('name', 'text')
                              ->addColumn('answer', 'text')
                              ->addForeignKey('knowbaseitem_id', 'glpi_knowbaseitem', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                              ->addIndex(array('knowbaseitem_id', 'language'))
                              ->create();

      // create the table glpi_networkalias
      $networkalias = $this->table('glpi_networkalias');
      $networkalias->addColumn('name', 'string')
                   ->addColumn('entity_id', 'integer')
                   ->addColumn('networkname_id', 'integer')
                   ->addColumn('fqdn_id', 'integer', array('default' => null, 'null' => true))
                   ->addColumn('comment', 'text')
                   ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                   ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                   ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('networkname_id', 'glpi_networkname', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addForeignKey('fqdn_id', 'glpi_fqdn', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('name'))
                   ->addIndex(array('entity_id'))
                   ->addIndex(array('networkname_id'))
                   ->addIndex(array('date_mod'))
                   ->addIndex(array('date_creation'))
                   ->create();

      // create the table glpi_networkequipment
      $networkequipment = $this->table('glpi_networkequipment');
      $networkequipment->addColumn('name', 'string')
                       ->addColumn('entity_id', 'integer')
                       ->addColumn('is_recursive', 'boolean', array('default' => false))
                       ->addColumn('serial', 'string', array('default' => ''))
                       ->addColumn('otherserial', 'string', array('default' => ''))
                       ->addColumn('contact', 'string', array('default' => ''))
                       ->addColumn('contact_num', 'string', array('default' => ''))
                       ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('domain_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('network_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('networkequipmentmodel_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('networkequipmenttype_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('networkequipmentfirmware_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('is_template', 'boolean', array('default' => false))
                       ->addColumn('template_name', 'string', array('default' => ''))
                       ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('is_deleted', 'boolean', array('default' => false))
                       ->addColumn('is_dynamic', 'boolean', array('default' => false))
                       ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                       ->addColumn('ram', 'string', array('default' => ''))
                       ->addColumn('comment', 'text')
                       ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                       ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                       ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('domain_id', 'glpi_domain', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('network_id', 'glpi_network', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('networkequipmentmodel_id', 'glpi_networkequipmentmodel', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('networkequipmenttype_id', 'glpi_networkequipmenttype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('networkequipmentfirmware_id', 'glpi_networkequipmentfirmware', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('name'))
                       ->addIndex(array('is_template'))
                       ->addIndex(array('domain_id'))
                       ->addIndex(array('entity_id'))
                       ->addIndex(array('manufacturer_id'))
                       ->addIndex(array('group_id'))
                       ->addIndex(array('user_id'))
                       ->addIndex(array('location_id'))
                       ->addIndex(array('networkequipmentmodel_id'))
                       ->addIndex(array('network_id'))
                       ->addIndex(array('state_id'))
                       ->addIndex(array('user_id_tech'))
                       ->addIndex(array('networkequipmenttype_id'))
                       ->addIndex(array('is_deleted'))
                       ->addIndex(array('group_id_tech'))
                       ->addIndex(array('is_dynamic'))
                       ->addIndex(array('serial'))
                       ->addIndex(array('otherserial'))
                       ->addIndex(array('networkequipmentfirmware_id'))
                       ->addIndex(array('is_recursive'))
                       ->addIndex(array('date_mod'))
                       ->addIndex(array('date_creation'))
                       ->create();

      // create the table glpi_networkportethernet
      $networkportethernet = $this->table('glpi_networkportethernet');
      $networkportethernet->addColumn('networkport_id', 'integer')
                          ->addColumn('item_devicenetworkcard_id', 'integer', array('default' => null, 'null' => true))
                          ->addColumn('netpoint_id', 'integer', array('default' => null, 'null' => true))
                          ->addColumn('type', 'string', array('limit' => 10, 'default' => '', 'comment' => 'T, LX, SX'))
                          ->addColumn('speed', 'integer', array('default' => 10, 'comment' => 'Mbit/s: 10, 100, 1000, 10000'))
                          ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                          ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                          ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                          ->addForeignKey('item_devicenetworkcard_id', 'glpi_item_devicenetworkcard', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                          ->addForeignKey('netpoint_id', 'glpi_netpoint', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                          ->addIndex(array('networkport_id'), array('unique' => true))
                          ->addIndex(array('item_devicenetworkcard_id'))
                          ->addIndex(array('netpoint_id'))
                          ->addIndex(array('type'))
                          ->addIndex(array('speed'))
                          ->addIndex(array('date_mod'))
                          ->addIndex(array('date_creation'))
                          ->create();

      // create the table glpi_networkportfiberchannel
      $networkportfiberchannel = $this->table('glpi_networkportfiberchannel');
      $networkportfiberchannel->addColumn('networkport_id', 'integer')
                              ->addColumn('item_devicenetworkcard_id', 'integer', array('default' => null, 'null' => true))
                              ->addColumn('netpoint_id', 'integer', array('default' => null, 'null' => true))
                              ->addColumn('wwn', 'string', array('limit' => 16, 'default' => ''))
                              ->addColumn('speed', 'integer', array('default' => 10, 'comment' => 'Mbit/s: 10, 100, 1000, 10000'))
                              ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                              ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                              ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                              ->addForeignKey('item_devicenetworkcard_id', 'glpi_item_devicenetworkcard', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                              ->addForeignKey('netpoint_id', 'glpi_netpoint', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                              ->addIndex(array('networkport_id'), array('unique' => true))
                              ->addIndex(array('item_devicenetworkcard_id'))
                              ->addIndex(array('netpoint_id'))
                              ->addIndex(array('wwn'))
                              ->addIndex(array('speed'))
                              ->addIndex(array('date_mod'))
                              ->addIndex(array('date_creation'))
                              ->create();

      // create the table glpi_networkport_vlan
      $networkport_vlan = $this->table('glpi_networkport_vlan');
      $networkport_vlan->addColumn('networkport_id', 'integer')
                       ->addColumn('vlan_id', 'integer')
                       ->addColumn('tagged', 'boolean', array('default' => false))
                       ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('vlan_id', 'glpi_vlan', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('networkport_id', 'vlan_id'), array('unique' => true))
                       ->addIndex(array('vlan_id'))
                       ->create();

      // create the table glpi_networkportwifi
      $networkportwifi = $this->table('glpi_networkportwifi');
      $networkportwifi->addColumn('networkport_id', 'integer')
                      ->addColumn('item_devicenetworkcard_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('wifinetwork_id', 'integer', array('default' => null, 'null' => true))
                      ->addColumn('networkportwifi_id', 'integer', array('default' => null, 'null' => true, 'comment' => 'only useful in case of Managed node'))
                      ->addColumn('version', 'string', array('limit' => 20, 'default' => '', 'comment' => 'a, a/b, a/b/g, a/b/g/n, a/b/g/n/y'))
                      ->addColumn('mode', 'string', array('limit' => 20, 'default' => '', 'comment' => 'ad-hoc, managed, master, repeater, secondary, monitor, auto'))
                      ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                      ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                      ->addForeignKey('networkport_id', 'glpi_networkport', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('item_devicenetworkcard_id', 'glpi_item_devicenetworkcard', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('wifinetwork_id', 'glpi_wifinetwork', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addForeignKey('networkportwifi_id', 'glpi_networkportwifi', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('networkport_id'), array('unique' => true))
                      ->addIndex(array('item_devicenetworkcard_id'))
                      ->addIndex(array('wifinetwork_id'))
                      ->addIndex(array('version'))
                      ->addIndex(array('mode'))
                      ->addIndex(array('date_mod'))
                      ->addIndex(array('date_creation'))
                      ->create();

      // create the table glpi_notimportedemail
      $notimportedemail = $this->table('glpi_notimportedemail');
      $notimportedemail->addColumn('from', 'string')
                       ->addColumn('to', 'string')
                       ->addColumn('mailcollector_id', 'integer', array('default' => null, 'null' => true))
                       ->addColumn('date', 'datetime')
                       ->addColumn('subject', 'text')
                       ->addColumn('messageid', 'string')
                       ->addColumn('reason', 'integer', array('default' => 0))
                       ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                       ->addForeignKey('mailcollector_id', 'glpi_mailcollector', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                       ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                       ->addIndex(array('user_id'))
                       ->addIndex(array('mailcollector_id'))
                       ->create();

      // create the table glpi_objectlock
      $objectlock = $this->table('glpi_objectlock');
      $objectlock->addColumn('user_id', 'integer', array('default' => null, 'null' => true, 'comment' => 'id of the locker'))
                 ->addColumn('itemtype', 'string', array('limit' => 100, 'comment' => 'Type of locked object'))
                 ->addColumn('items_id', 'integer', array('default' => 0, 'comment' => 'RELATION to various tables, according to itemtype (ID)'))
                 ->addColumn('date_mod', 'datetime', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => 'Timestamp of the lock'))
                 ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                 ->addIndex(array('itemtype', 'items_id'), array('unique' => true))
                 ->create();

      // create the table glpi_peripheral
      $peripheral = $this->table('glpi_peripheral');
      $peripheral->addColumn('name', 'string')
                  ->addColumn('entity_id', 'integer')
                  ->addColumn('is_recursive', 'boolean', array('default' => false))
                  ->addColumn('serial', 'string', array('default' => ''))
                  ->addColumn('otherserial', 'string', array('default' => ''))
                  ->addColumn('contact', 'string', array('default' => ''))
                  ->addColumn('contact_num', 'string', array('default' => ''))
                  ->addColumn('user_id_tech', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('group_id_tech', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('location_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('peripheralmodel_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('peripheraltype_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('is_template', 'boolean', array('default' => false))
                  ->addColumn('template_name', 'string', array('default' => ''))
                  ->addColumn('manufacturer_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('is_deleted', 'boolean', array('default' => false))
                  ->addColumn('is_dynamic', 'boolean', array('default' => false))
                  ->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('group_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('state_id', 'integer', array('default' => null, 'null' => true))
                  ->addColumn('ticket_tco', 'decimal', array('precision' => 20, 'scale' => 4, 'null' => true, 'default' => '0.0000'))
                  ->addColumn('is_global', 'boolean', array('default' => false))
                  ->addColumn('brand', 'string', array('default' => ''))
                  ->addColumn('comment', 'text')
                  ->addColumn('date_mod', 'datetime', array('null' => true, 'default' => null))
                  ->addColumn('date_creation', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
                  ->addForeignKey('entity_id', 'glpi_entity', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id_tech', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('group_id_tech', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('location_id', 'glpi_location', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('peripheralmodel_id', 'glpi_peripheralmodel', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('peripheraltype_id', 'glpi_peripheraltype', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('manufacturer_id', 'glpi_manufacturer', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('group_id', 'glpi_group', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addForeignKey('state_id', 'glpi_state', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('name'))
                  ->addIndex(array('is_template'))
                  ->addIndex(array('entity_id'))
                  ->addIndex(array('manufacturer_id'))
                  ->addIndex(array('group_id'))
                  ->addIndex(array('user_id'))
                  ->addIndex(array('location_id'))
                  ->addIndex(array('peripheralmodel_id'))
                  ->addIndex(array('state_id'))
                  ->addIndex(array('user_id_tech'))
                  ->addIndex(array('peripheraltype_id'))
                  ->addIndex(array('is_deleted'))
                  ->addIndex(array('group_id_tech'))
                  ->addIndex(array('is_dynamic'))
                  ->addIndex(array('serial'))
                  ->addIndex(array('otherserial'))
                  ->addIndex(array('is_global'))
                  ->addIndex(array('is_recursive'))
                  ->addIndex(array('date_mod'))
                  ->addIndex(array('date_creation'))
                  ->create();

      // create the table glpi_planningrecall
      $planningrecall = $this->table('glpi_planningrecall');
      $planningrecall->addColumn('user_id', 'integer', array('default' => null, 'null' => true))
                     ->addColumn('itemtype', 'string', array('limit' => 100))
                     ->addColumn('items_id', 'integer', array('default' => 0))
                     ->addColumn('before_time', 'integer', array('default' => -10))
                     ->addColumn('when_date', 'datetime', array('null' => true, 'default' => null))
                     ->addForeignKey('user_id', 'glpi_user', 'id', array('delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'))
                     ->addIndex(array('itemtype', 'items_id', 'user_id'), array('unique' => true))
                     ->addIndex(array('user_id'))
                     ->addIndex(array('before_time'))
                     ->addIndex(array('when_date'))
                     ->create();

      // create the table glpi_profileright
      $profileright = $this->table('glpi_profileright');
      $profileright->addColumn('profile_id', 'integer')
                   ->addColumn('name', 'string')
                   ->addColumn('rights', 'integer', array('default' => 0))
                   ->addForeignKey('profile_id', 'glpi_profile', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                   ->addIndex(array('profile_id', 'name'), array('unique' => true))
                   ->create();

      // create the table glpi_projecttask_ticket
      $projecttask_ticket = $this->table('glpi_projecttask_ticket');
      $projecttask_ticket->addColumn('ticket_id', 'integer')
                         ->addColumn('projecttask_id', 'integer')
                         ->addForeignKey('ticket_id', 'glpi_ticket', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addForeignKey('projecttask_id', 'glpi_projecttask', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                         ->addIndex(array('ticket_id', 'projecttask_id'), array('unique' => true))
                         ->addIndex(array('projecttask_id'))
                         ->create();

      // create the table glpi_projectteam
      $projectteam = $this->table('glpi_projectteam');
      $projectteam->addColumn('project_id', 'integer')
                  ->addColumn('itemtype', 'string', array('limit' => 100))
                  ->addColumn('items_id', 'integer', array('default' => 0))
                  ->addForeignKey('project_id', 'glpi_project', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                  ->addIndex(array('project_id', 'itemtype', 'items_id'), array('unique' => true))
                  ->addIndex(array('itemtype', 'items_id'))
                  ->create();

      // create the table glpi_projecttaskteam
      $projecttaskteam = $this->table('glpi_projecttaskteam');
      $projecttaskteam->addColumn('projecttask_id', 'integer')
                      ->addColumn('itemtype', 'string', array('limit' => 100))
                      ->addColumn('items_id', 'integer', array('default' => 0))
                      ->addForeignKey('projecttask_id', 'glpi_projecttask', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
                      ->addIndex(array('projecttask_id', 'itemtype', 'items_id'), array('unique' => true))
                      ->addIndex(array('itemtype', 'items_id'))
                      ->create();

   }

}
