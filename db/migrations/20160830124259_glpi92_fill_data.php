<?php

use Phinx\Migration\AbstractMigration;

class Glpi92FillData extends AbstractMigration {
    public function up() {

      $exists_data = $this->fetchAll('SELECT * FROM glpi_entity');
      if (count($exists_data)) {
         return;
      }

      // Insert into table glpi_entity
      $rows = array(
          array(
              'name'                                => 'Root entity',
              'entity_id'                           => null,
              'completename'                        => 'Root entity',
              'level'                               => 1,
              'cartridges_alert_repeat'             => 0,
              'consumables_alert_repeat'            => 0,
              'use_licenses_alert'                  => 0,
              'send_licenses_alert_before_delay'    => 0,
              'use_contracts_alert'                 => 0,
              'send_contracts_alert_before_delay'   => 0,
              'use_infocoms_alert'                  => 0,
              'send_infocoms_alert_before_delay'    => 0,
              'use_reservations_alert'              => 0,
              'autoclose_delay'                     => 0,
              'notclosed_delay'                     => 0,
              'calendar_id'                         => 0,
              'auto_assign_mode'                    => -10,
              'tickettype'                          => 1,
              'inquest_config'                      => 1,
              'inquest_rate'                        => 0,
              'inquest_delay'                       => 0,
              'autofill_warranty_date'              => 0,
              'autofill_use_date'                   => 0,
              'autofill_buy_date'                   => 0,
              'autofill_delivery_date'              => 0,
              'autofill_order_date'                 => 0,
              'tickettemplate_id'                   => 1,
              'entity_id_software'                  => -10,
              'default_contract_alert'              => 0,
              'default_infocom_alert'               => 0,
              'default_cartridges_alarm_threshold'  => 10,
              'default_consumables_alarm_threshold' => 10,
              'delay_send_emails'                   => 0,
              'is_notif_enable_default'             => 1,
              'inquest_duration'                    => 0,
              'autofill_decommission_date'          => 0,
          )
      );
      $this->insert('glpi_entity', $rows);
      $completeentity = $this->fetchRow('SELECT * FROM glpi_entity');
      $entity_id = $completeentity['id'];

      // Insert into table glpi_apiclient
      $rows = array(
          array(
              'name' => 'full access',
              'entity_id' => $entity_id,
              'is_active' => 1,
          )
      );
      $this->insert('glpi_apiclient', $rows);

      // Insert into table glpi_blacklist
      $rows = array(
          array(
              'type'  => 1,
              'name'  => 'empty IP'
          ),
          array(
              'type'  => 1,
              'name'  => 'localhost',
              'value' => '127.0.0.1',
          ),
          array(
              'type'  => 1,
              'name'  => 'zero IP',
              'value' => '0.0.0.0',
          ),
          array(
              'type'  => 2,
              'name'  => 'empty MAC'
          )
      );
      $this->insert('glpi_blacklist', $rows);

      // Insert into table glpi_calendar
      $rows = array(
          array(
              'name'           => 'Default',
              'entity_id'      => $entity_id,
              'is_recursive'   => true,
              'comment'        => 'Default calendar',
              'cache_duration' => '[0,43200,43200,43200,43200,43200,0]'
          )
      );
      $this->insert('glpi_calendar', $rows);

      // Insert into table glpi_calendarsegment
      $rows = array(
          array(
              'calendar_id' => 1,
              'entity_id'   => $entity_id,
              'day'         => 1,
              'begin_hour'  => '08:00:00',
              'end_hour'    => '20:00:00'
          ),
          array(
              'calendar_id' => 1,
              'entity_id'   => $entity_id,
              'day'         => 2,
              'begin_hour'  => '08:00:00',
              'end_hour'    => '20:00:00'
          ),
          array(
              'calendar_id' => 1,
              'entity_id'   => $entity_id,
              'day'         => 3,
              'begin_hour'  => '08:00:00',
              'end_hour'    => '20:00:00'
          ),
          array(
              'calendar_id' => 1,
              'entity_id'   => $entity_id,
              'day'         => 4,
              'begin_hour'  => '08:00:00',
              'end_hour'    => '20:00:00'
          ),
          array(
              'calendar_id' => 1,
              'entity_id'   => $entity_id,
              'day'         => 5,
              'begin_hour'  => '08:00:00',
              'end_hour'    => '20:00:00'
          ),
      );
      $this->insert('glpi_calendarsegment', $rows);

      // Insert into table glpi_config
      $rows = array(
          array(
              'context' => 'core',
              'name'    => 'version',
              'value'   => '9.2',
          ),
          array(
              'context' => 'core',
              'name'    => 'show_jobs_at_login',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'cut',
              'value'   => '250',
          ),
          array(
              'context' => 'core',
              'name'    => 'list_limit',
              'value'   => '15',
          ),
          array(
              'context' => 'core',
              'name'    => 'list_limit_max',
              'value'   => '50',
          ),
          array(
              'context' => 'core',
              'name'    => 'url_maxlength',
              'value'   => '30',
          ),
          array(
              'context' => 'core',
              'name'    => 'event_loglevel',
              'value'   => '5',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_mailing',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'admin_email',
              'value'   => 'admsys@localhost',
          ),
          array(
              'context' => 'core',
              'name'    => 'admin_email_name',
          ),
          array(
              'context' => 'core',
              'name'    => 'admin_reply',
          ),
          array(
              'context' => 'core',
              'name'    => 'admin_reply_name',
          ),
          array(
              'context' => 'core',
              'name'    => 'mailing_signature',
              'value'   => 'SIGNATURE',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_anonymous_helpdesk',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_anonymous_followups',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'language',
              'value'   => 'en_GB',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_1',
              'value'   => '#fff2f2',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_2',
              'value'   => '#ffe0e0',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_3',
              'value'   => '#ffcece',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_4',
              'value'   => '#ffbfbf',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_5',
              'value'   => '#ffadad',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_6',
              'value'   => '#ff5555',
          ),
          array(
              'context' => 'core',
              'name'    => 'date_tax',
              'value'   => '2005-12-31',
          ),
          array(
              'context' => 'core',
              'name'    => 'cas_host',
          ),
          array(
              'context' => 'core',
              'name'    => 'cas_port',
              'value'   => '443',
          ),
          array(
              'context' => 'core',
              'name'    => 'cas_uri',
          ),
          array(
              'context' => 'core',
              'name'    => 'cas_logout',
          ),
          array(
              'context' => 'core',
              'name'    => 'existing_auth_server_field_clean_domain',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'planning_begin',
              'value'   => '08:00:00',
          ),
          array(
              'context' => 'core',
              'name'    => 'planning_end',
              'value'   => '20:00:00',
          ),
          array(
              'context' => 'core',
              'name'    => 'utf8_conv',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_public_faq',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'url_base',
              'value'   => 'http://localhost/glpi/',
          ),
          array(
              'context' => 'core',
              'name'    => 'show_link_in_mail',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'text_login',
          ),
          array(
              'context' => 'core',
              'name'    => 'founded_new_version',
          ),
          array(
              'context' => 'core',
              'name'    => 'dropdown_max',
              'value'   => '100',
          ),
          array(
              'context' => 'core',
              'name'    => 'ajax_wildcard',
              'value'   => '*',
          ),
          array(
              'context' => 'core',
              'name'    => 'ajax_limit_count',
              'value'   => '50',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_ajax_autocompletion',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_users_auto_add',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'date_format',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'number_format',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'csv_delimiter',
              'value'   => ';',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_ids_visible',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'smtp_mode',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'smtp_host',
          ),
          array(
              'context' => 'core',
              'name'    => 'smtp_port',
              'value'   => '25',
          ),
          array(
              'context' => 'core',
              'name'    => 'smtp_username',
          ),
          array(
              'context' => 'core',
              'name'    => 'proxy_name',
          ),
          array(
              'context' => 'core',
              'name'    => 'proxy_port',
              'value'   => '8080',
          ),
          array(
              'context' => 'core',
              'name'    => 'proxy_user',
          ),
          array(
              'context' => 'core',
              'name'    => 'add_followup_on_update_ticket',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'keep_tickets_on_delete',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'time_step',
              'value'   => '5',
          ),
          array(
              'context' => 'core',
              'name'    => 'decimal_number',
              'value'   => '2',
          ),
          array(
              'context' => 'core',
              'name'    => 'helpdesk_doc_url',
          ),
          array(
              'context' => 'core',
              'name'    => 'central_doc_url',
          ),
          array(
              'context' => 'core',
              'name'    => 'documentcategories_id_forticket',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'monitors_management_restrict',
              'value'   => '2',
          ),
          array(
              'context' => 'core',
              'name'    => 'phones_management_restrict',
              'value'   => '2',
          ),
          array(
              'context' => 'core',
              'name'    => 'peripherals_management_restrict',
              'value'   => '2',
          ),
          array(
              'context' => 'core',
              'name'    => 'printers_management_restrict',
              'value'   => '2',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_log_in_files',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'time_offset',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_contact_autoupdate',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_user_autoupdate',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_group_autoupdate',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_location_autoupdate',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'state_autoupdate_mode',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_contact_autoclean',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_user_autoclean',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_group_autoclean',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'is_location_autoclean',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'state_autoclean_mode',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_flat_dropdowntree',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_autoname_by_entity',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'softwarecategories_id_ondelete',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'x509_email_field',
          ),
          array(
              'context' => 'core',
              'name'    => 'x509_cn_restrict',
          ),
          array(
              'context' => 'core',
              'name'    => 'x509_o_restrict',
          ),
          array(
              'context' => 'core',
              'name'    => 'x509_ou_restrict',
          ),
          array(
              'context' => 'core',
              'name'    => 'default_mailcollector_filesize_max',
              'value'   => '2097152',
          ),
          array(
              'context' => 'core',
              'name'    => 'followup_private',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'task_private',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'default_software_helpdesk_visible',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'names_format',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'default_graphtype',
              'value'   => 'svg',
          ),
          array(
              'context' => 'core',
              'name'    => 'default_requesttypes_id',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_noright_users_add',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'cron_limit',
              'value'   => '5',
          ),
          array(
              'context' => 'core',
              'name'    => 'priority_matrix',
              'value'   => '{\"1\":{\"1\":1,\"2\":1,\"3\":2,\"4\":2,\"5\":2},\"2\":{\"1\":1,\"2\":2,\"3\":2,\"4\":3,\"5\":3},\"3\":{\"1\":2,\"2\":2,\"3\":3,\"4\":4,\"5\":4},\"4\":{\"1\":2,\"2\":3,\"3\":4,\"4\":4,\"5\":5},\"5\":{\"1\":2,\"2\":3,\"3\":4,\"4\":5,\"5\":5}}',
          ),
          array(
              'context' => 'core',
              'name'    => 'urgency_mask',
              'value'   => '62',
          ),
          array(
              'context' => 'core',
              'name'    => 'impact_mask',
              'value'   => '62',
          ),
          array(
              'context' => 'core',
              'name'    => 'user_deleted_ldap',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'auto_create_infocoms',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_slave_for_search',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'proxy_passwd',
          ),
          array(
              'context' => 'core',
              'name'    => 'smtp_passwd',
          ),
          array(
              'context' => 'core',
              'name'    => 'transfers_id_auto',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'show_count_on_tabs',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'refresh_ticket_list',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'set_default_tech',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'allow_search_view',
              'value'   => '2',
          ),
          array(
              'context' => 'core',
              'name'    => 'allow_search_all',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'allow_search_global',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'display_count_on_home',
              'value'   => '5',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_password_security',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'password_min_length',
              'value'   => '8',
          ),
          array(
              'context' => 'core',
              'name'    => 'password_need_number',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'password_need_letter',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'password_need_caps',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'password_need_symbol',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_check_pref',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'notification_to_myself',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedateok_color',
              'value'   => '#06ff00',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedatewarning_color',
              'value'   => '#ffb800',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedatecritical_color',
              'value'   => '#ff0000',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedatewarning_less',
              'value'   => '20',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedatecritical_less',
              'value'   => '5',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedatewarning_unit',
              'value'   => '%',
          ),
          array(
              'context' => 'core',
              'name'    => 'duedatecritical_unit',
              'value'   => '%',
          ),
          array(
              'context' => 'core',
              'name'    => 'realname_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'firstname_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'email1_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'email2_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'email3_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'email4_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'phone_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'phone2_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'mobile_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'comment_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'title_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'category_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'language_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'entity_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'registration_number_ssofield',
          ),
          array(
              'context' => 'core',
              'name'    => 'ssovariables_id',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'translate_kb',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'translate_dropdowns',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'pdffont',
              'value'   => 'helvetica',
          ),
          array(
              'context' => 'core',
              'name'    => 'keep_devices_when_purging_item',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'maintenance_mode',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'maintenance_text',
          ),
          array(
              'context' => 'core',
              'name'    => 'use_rich_text',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'attach_ticket_documents_to_mail',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'backcreated',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'task_state',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'layout',
              'value'   => 'lefttab',
          ),
          array(
              'context' => 'core',
              'name'    => 'ticket_timeline',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'ticket_timeline_keep_replaced_tabs',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'palette',
              'value'   => 'auror',
          ),
          array(
              'context' => 'core',
              'name'    => 'lock_use_lock_item',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'lock_autolock_mode',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'lock_directunlock_notification',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'lock_item_list',
              'value'   => '[]',
          ),
          array(
              'context' => 'core',
              'name'    => 'lock_lockprofile_id',
              'value'   => '8',
          ),
          array(
              'context' => 'core',
              'name'    => 'set_default_requester',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'highcontrast_css',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'smtp_check_certificate',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'enable_api',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'enable_api_login_credentials',
              'value'   => '0',
          ),
          array(
              'context' => 'core',
              'name'    => 'enable_api_login_external_token',
              'value'   => '1',
          ),
          array(
              'context' => 'core',
              'name'    => 'url_base_api',
              'value'   => 'http://localhost/glpi/api',
          )
      );
      $this->insert('glpi_config', $rows);

      // Insert into table glpi_crontask
      $rows = array(
          array(
              'name'     => 'cartridge',
              'itemtype' => 'CartridgeItem',
              'param'    => 10,
              'state'    => 0,
          ),
          array(
              'name'     => 'consumable',
              'itemtype' => 'ConsumableItem',
              'param'    => 10,
              'state'    => 0,
          ),
          array(
              'name'     => 'software',
              'itemtype' => 'SoftwareLicense',
              'state'    => 0,
          ),
          array(
              'name'     => 'contract',
              'itemtype' => 'Contract',
          ),
          array(
              'name'     => 'infocom',
              'itemtype' => 'InfoCom',
          ),
          array(
              'name'     => 'logs',
              'itemtype' => 'CronTask',
              'param'    => 30,
              'state'    => 0,
          ),
          array(
              'name'      => 'optimize',
              'itemtype'  => 'CronTask',
              'frequency' => 604800
          ),
          array(
              'name'      => 'mailgate',
              'itemtype'  => 'MailCollector',
              'frequency' => 600,
              'param'     => 10
          ),
          array(
              'name'      => 'checkdbreplicate',
              'itemtype'  => 'DBconnection',
              'frequency' => 300,
              'state'     => 0
          ),
          array(
              'name'      => 'checkupdate',
              'itemtype'  => 'CronTask',
              'frequency' => 604800,
              'state'     => 0
          ),
          array(
              'name'      => 'session',
              'itemtype'  => 'CronTask',
          ),
          array(
              'name'      => 'graph',
              'itemtype'  => 'CronTask',
              'frequency' => 3600
          ),
          array(
              'name'      => 'reservation',
              'itemtype'  => 'ReservationItem',
              'frequency' => 3600
          ),
          array(
              'name'      => 'closeticket',
              'itemtype'  => 'Ticket',
              'frequency' => 43200
          ),
          array(
              'name'      => 'alertnotclosed',
              'itemtype'  => 'Ticket',
              'frequency' => 43200
          ),
          array(
              'name'      => 'slaticket',
              'itemtype'  => 'SlaLevel_Ticket',
              'frequency' => 300
          ),
          array(
              'name'      => 'createinquest',
              'itemtype'  => 'Ticket',
          ),
          array(
              'name'      => 'watcher',
              'itemtype'  => 'Crontask',
          ),
          array(
              'name'      => 'ticketrecurrent',
              'itemtype'  => 'TicketRecurrent',
              'frequency' => 3600
          ),
          array(
              'name'      => 'planningrecall',
              'itemtype'  => 'PlanningRecall',
              'frequency' => 300
          ),
          array(
              'name'      => 'queuedmail',
              'itemtype'  => 'QueuedMail',
              'frequency' => 600,
              'param'     => 50
          ),
          array(
              'name'      => 'queuedmailclean',
              'itemtype'  => 'QueuedMail',
              'param'     => 30
          ),
          array(
              'name'      => 'temp',
              'itemtype'  => 'Crontask',
              'frequency' => 3600
          ),
          array(
              'name'      => 'mailgateerror',
              'itemtype'  => 'MailCollector',
          ),
          array(
              'name'      => 'circularlogs',
              'itemtype'  => 'Crontask',
              'param'     => 4,
              'state'     => 0
          ),
          array(
              'name'      => 'unlockobject',
              'itemtype'  => 'ObjectLock',
              'param'     => 4,
              'state'     => 0
          ),
      );
      $this->insert('glpi_crontask', $rows);

      // Insert into table glpi_devicememorytype
      $rows = array(
          array(
              'name' => 'EDO',
          ),
          array(
              'name' => 'DDR',
          ),
          array(
              'name' => 'SDRAM',
          ),
          array(
              'name' => 'SDRAM-2',
          ),
      );
      $this->insert('glpi_devicememorytype', $rows);


      // Insert into table glpi_displaypreference
      $rows = array(
          array(
              'itemtype' => 'Computer',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 2,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 3,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 5,
              'num'      => 40,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 6,
              'num'      => 45,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 7,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 8,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Computer',
              'rank'     => 9,
              'num'      => 17,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 2,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 3,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 5,
              'num'      => 40,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 6,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Monitor',
              'rank'     => 7,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Printer',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'Printer',
              'rank'     => 2,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'Printer',
              'rank'     => 3,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Printer',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Printer',
              'rank'     => 5,
              'num'      => 40,
          ),
          array(
              'itemtype' => 'Printer',
              'rank'     => 6,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'NetworkEquipment',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'NetworkEquipment',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'NetworkEquipment',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'NetworkEquipment',
              'rank'     => 4,
              'num'      => 40,
          ),
          array(
              'itemtype' => 'NetworkEquipment',
              'rank'     => 5,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'NetworkEquipment',
              'rank'     => 6,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Software',
              'rank'     => 1,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'Software',
              'rank'     => 2,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Software',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Software',
              'rank'     => 4,
              'num'      => 72,
          ),
          array(
              'itemtype' => 'Software',
              'rank'     => 5,
              'num'      => 163,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 2,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 3,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 5,
              'num'      => 40,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 6,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Peripheral',
              'rank'     => 7,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'DocumentType',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'DocumentType',
              'rank'     => 2,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'DocumentType',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'DocumentType',
              'rank'     => 4,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'CartridgeItem',
              'rank'     => 1,
              'num'      => 34,
          ),
          array(
              'itemtype' => 'CartridgeItem',
              'rank'     => 2,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'CartridgeItem',
              'rank'     => 3,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'CartridgeItem',
              'rank'     => 4,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'CartridgeItem',
              'rank'     => 5,
              'num'      => 9,
          ),
          array(
              'itemtype' => 'Contact',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Contact',
              'rank'     => 2,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Contact',
              'rank'     => 3,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Contact',
              'rank'     => 4,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'Contact',
              'rank'     => 5,
              'num'      => 9,
          ),
          array(
              'itemtype' => 'Supplier',
              'rank'     => 1,
              'num'      => 9,
          ),
          array(
              'itemtype' => 'Supplier',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Supplier',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Supplier',
              'rank'     => 4,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Supplier',
              'rank'     => 5,
              'num'      => 10,
          ),
          array(
              'itemtype' => 'Supplier',
              'rank'     => 6,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'Contract',
              'rank'     => 1,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Contract',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Contract',
              'rank'     => 3,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Contract',
              'rank'     => 4,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'Contract',
              'rank'     => 5,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Contract',
              'rank'     => 6,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'Document',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Document',
              'rank'     => 2,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Document',
              'rank'     => 3,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Document',
              'rank'     => 4,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Document',
              'rank'     => 5,
              'num'      => 16,
          ),
          array(
              'itemtype' => 'User',
              'rank'     => 1,
              'num'      => 34,
          ),
          array(
              'itemtype' => 'User',
              'rank'     => 2,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'User',
              'rank'     => 3,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'User',
              'rank'     => 4,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'User',
              'rank'     => 5,
              'num'      => 8,
          ),
          array(
              'itemtype' => 'ConsumableItem',
              'rank'     => 1,
              'num'      => 34,
          ),
          array(
              'itemtype' => 'ConsumableItem',
              'rank'     => 2,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'ConsumableItem',
              'rank'     => 3,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'ConsumableItem',
              'rank'     => 4,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'ConsumableItem',
              'rank'     => 5,
              'num'      => 9,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 2,
              'num'      => 23,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 3,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 5,
              'num'      => 40,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 6,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Phone',
              'rank'     => 7,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Group',
              'rank'     => 1,
              'num'      => 16,
          ),
          array(
              'itemtype' => 'AllAssets',
              'rank'     => 1,
              'num'      => 31,
          ),
          array(
              'itemtype' => 'ReservationItem',
              'rank'     => 1,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'ReservationItem',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'ReservationItem',
              'rank'     => 3,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'ReservationItem',
              'rank'     => 4,
              'num'      => 9,
          ),
          array(
              'itemtype' => 'Budget',
              'rank'     => 1,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Budget',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Budget',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Budget',
              'rank'     => 4,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Crontask',
              'rank'     => 1,
              'num'      => 8,
          ),
          array(
              'itemtype' => 'Crontask',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Crontask',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Crontask',
              'rank'     => 4,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'RequestType',
              'rank'     => 1,
              'num'      => 14,
          ),
          array(
              'itemtype' => 'RequestType',
              'rank'     => 2,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'NotificationTemplate',
              'rank'     => 1,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'NotificationTemplate',
              'rank'     => 2,
              'num'      => 16,
          ),
          array(
              'itemtype' => 'Notification',
              'rank'     => 1,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Notification',
              'rank'     => 2,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'Notification',
              'rank'     => 3,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'Notification',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Notification',
              'rank'     => 5,
              'num'      => 80,
          ),
          array(
              'itemtype' => 'Notification',
              'rank'     => 6,
              'num'      => 86,
          ),
          array(
              'itemtype' => 'MailCollector',
              'rank'     => 1,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'MailCollector',
              'rank'     => 2,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'AuthLDAP',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'AuthLDAP',
              'rank'     => 2,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'AuthLdap',
              'rank'     => 3,
              'num'      => 30,
          ),
          array(
              'itemtype' => 'AuthMail',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'AuthMail',
              'rank'     => 2,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'AuthMail',
              'rank'     => 3,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'IPNetwork',
              'rank'     => 1,
              'num'      => 14,
          ),
          array(
              'itemtype' => 'IPNetwork',
              'rank'     => 2,
              'num'      => 10,
          ),
          array(
              'itemtype' => 'IPNetwork',
              'rank'     => 3,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'IPNetwork',
              'rank'     => 4,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'IPNetwork',
              'rank'     => 5,
              'num'      => 13,
          ),
          array(
              'itemtype' => 'WifiNetwork',
              'rank'     => 1,
              'num'      => 10,
          ),
          array(
              'itemtype' => 'Profile',
              'rank'     => 1,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'Profile',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Profile',
              'rank'     => 3,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Transfer',
              'rank'     => 1,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'TicketValidation',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'TicketValidation',
              'rank'     => 2,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'TicketValidation',
              'rank'     => 3,
              'num'      => 8,
          ),
          array(
              'itemtype' => 'TicketValidation',
              'rank'     => 4,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'TicketValidation',
              'rank'     => 5,
              'num'      => 9,
          ),
          array(
              'itemtype' => 'TicketValidation',
              'rank'     => 6,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'NotImportedEmail',
              'rank'     => 1,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'NotImportedEmail',
              'rank'     => 2,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'NotImportedEmail',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'NotImportedEmail',
              'rank'     => 4,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'NotImportedEmail',
              'rank'     => 5,
              'num'      => 16,
          ),
          array(
              'itemtype' => 'NotImportedEmail',
              'rank'     => 6,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'RuleRightParameter',
              'rank'     => 1,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 1,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 2,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 3,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 4,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 5,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 6,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 7,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Ticket',
              'rank'     => 8,
              'num'      => 18,
          ),
          array(
              'itemtype' => 'Calendar',
              'rank'     => 1,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Holiday',
              'rank'     => 1,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'Holiday',
              'rank'     => 2,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'Holiday',
              'rank'     => 3,
              'num'      => 13,
          ),
          array(
              'itemtype' => 'SLA',
              'rank'     => 1,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'FQDN',
              'rank'     => 1,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'FieldUnicity',
              'rank'     => 1,
              'num'      => 1,
          ),
          array(
              'itemtype' => 'FieldUnicity',
              'rank'     => 2,
              'num'      => 80,
          ),
          array(
              'itemtype' => 'FieldUnicity',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'FieldUnicity',
              'rank'     => 4,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'FieldUnicity',
              'rank'     => 5,
              'num'      => 86,
          ),
          array(
              'itemtype' => 'FieldUnicity',
              'rank'     => 6,
              'num'      => 30,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 1,
              'num'      => 21,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 2,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 3,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 4,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 5,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 6,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Problem',
              'rank'     => 7,
              'num'      => 18,
          ),
          array(
              'itemtype' => 'Vlan',
              'rank'     => 1,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'TicketRecurrent',
              'rank'     => 1,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'TicketRecurrent',
              'rank'     => 2,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'TicketRecurrent',
              'rank'     => 3,
              'num'      => 13,
          ),
          array(
              'itemtype' => 'TicketRecurrent',
              'rank'     => 4,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'TicketRecurrent',
              'rank'     => 5,
              'num'      => 14,
          ),
          array(
              'itemtype' => 'Reminder',
              'rank'     => 1,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'Reminder',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Reminder',
              'rank'     => 3,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Reminder',
              'rank'     => 4,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Reminder',
              'rank'     => 5,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'Reminder',
              'rank'     => 6,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'NetworkName',
              'rank'     => 1,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'NetworkName',
              'rank'     => 2,
              'num'      => 13,
          ),
          array(
              'itemtype' => 'RSSFeed',
              'rank'     => 1,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'RSSFeed',
              'rank'     => 2,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'RSSFeed',
              'rank'     => 3,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'RSSFeed',
              'rank'     => 4,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'RSSFeed',
              'rank'     => 5,
              'num'      => 6,
          ),
          array(
              'itemtype' => 'RSSFeed',
              'rank'     => 6,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Blacklist',
              'rank'     => 1,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'Blacklist',
              'rank'     => 2,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'QueueMail',
              'rank'     => 1,
              'num'      => 16,
          ),
          array(
              'itemtype' => 'QueueMail',
              'rank'     => 2,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'QueueMail',
              'rank'     => 3,
              'num'      => 20,
          ),
          array(
              'itemtype' => 'QueueMail',
              'rank'     => 4,
              'num'      => 21,
          ),
          array(
              'itemtype' => 'QueueMail',
              'rank'     => 5,
              'num'      => 22,
          ),
          array(
              'itemtype' => 'QueueMail',
              'rank'     => 6,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'Change',
              'rank'     => 1,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'Change',
              'rank'     => 2,
              'num'      => 19,
          ),
          array(
              'itemtype' => 'Change',
              'rank'     => 3,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'Change',
              'rank'     => 4,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'Change',
              'rank'     => 5,
              'num'      => 18,
          ),
          array(
              'itemtype' => 'Project',
              'rank'     => 1,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'Project',
              'rank'     => 2,
              'num'      => 4,
          ),
          array(
              'itemtype' => 'Project',
              'rank'     => 3,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'Project',
              'rank'     => 4,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'Project',
              'rank'     => 5,
              'num'      => 15,
          ),
          array(
              'itemtype' => 'Project',
              'rank'     => 6,
              'num'      => 21,
          ),
          array(
              'itemtype' => 'ProjectState',
              'rank'     => 1,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'ProjectState',
              'rank'     => 2,
              'num'      => 11,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 1,
              'num'      => 2,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 2,
              'num'      => 12,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 3,
              'num'      => 14,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 4,
              'num'      => 5,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 5,
              'num'      => 7,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 6,
              'num'      => 8,
          ),
          array(
              'itemtype' => 'ProjectTask',
              'rank'     => 7,
              'num'      => 13,
          ),
          array(
              'itemtype' => 'SoftwareLicense',
              'rank'     => 1,
              'num'      => 1,
          ),
          array(
              'itemtype' => 'SoftwareLicense',
              'rank'     => 2,
              'num'      => 3,
          ),
          array(
              'itemtype' => 'SoftwareLicense',
              'rank'     => 3,
              'num'      => 10,
          ),
          array(
              'itemtype' => 'SoftwareLicense',
              'rank'     => 4,
              'num'      => 162,
          ),
          array(
              'itemtype' => 'SoftwareLicense',
              'rank'     => 5,
              'num'      => 5,
          ),
      );
      $this->insert('glpi_displaypreference', $rows);

      // Insert into table glpi_documenttype
      $rows = array(
          array(
              'name'          => 'JPEG',
              'ext'           => 'jpg',
              'icon'          => 'jpg-dist.png',
          ),
          array(
              'name'          => 'PNG',
              'ext'           => 'png',
              'icon'          => 'png-dist.png',
          ),
          array(
              'name'          => 'GIF',
              'ext'           => 'gif',
              'icon'          => 'gif-dist.png',
          ),
          array(
              'name'          => 'BMP',
              'ext'           => 'bmp',
              'icon'          => 'bmp-dist.png',
          ),
          array(
              'name'          => 'Photoshop',
              'ext'           => 'psd',
              'icon'          => 'psd-dist.png',
          ),
          array(
              'name'          => 'TIFF',
              'ext'           => 'tif',
              'icon'          => 'tif-dist.png',
          ),
          array(
              'name'          => 'AIFF',
              'ext'           => 'aiff',
              'icon'          => 'aiff-dist.png',
          ),
          array(
              'name'          => 'Windows Media',
              'ext'           => 'asf',
              'icon'          => 'asf-dist.png',
          ),
          array(
              'name'          => 'Windows Media',
              'ext'           => 'avi',
              'icon'          => 'avi-dist.png',
          ),
          array(
              'name'          => 'C source',
              'ext'           => 'c',
              'icon'          => 'c-dist.png',
          ),
          array(
              'name'          => 'RealAudio',
              'ext'           => 'rm',
              'icon'          => 'rm-dist.png',
          ),
          array(
              'name'          => 'Midi',
              'ext'           => 'mid',
              'icon'          => 'mid-dist.png',
          ),
          array(
              'name'          => 'QuickTime',
              'ext'           => 'mov',
              'icon'          => 'mov-dist.png',
          ),
          array(
              'name'          => 'MP3',
              'ext'           => 'mp3',
              'icon'          => 'mp3-dist.png',
          ),
          array(
              'name'          => 'MPEG',
              'ext'           => 'mpg',
              'icon'          => 'mpg-dist.png',
          ),
          array(
              'name'          => 'Ogg Vorbis',
              'ext'           => 'ogg',
              'icon'          => 'ogg-dist.png',
          ),
          array(
              'name'          => 'QuickTime',
              'ext'           => 'qt',
              'icon'          => 'qt-dist.png',
          ),
          array(
              'name'          => 'BZip',
              'ext'           => 'bz2',
              'icon'          => 'bz2-dist.png',
          ),
          array(
              'name'          => 'RealAudio',
              'ext'           => 'ra',
              'icon'          => 'ra-dist.png',
          ),
          array(
              'name'          => 'RealAudio',
              'ext'           => 'ram',
              'icon'          => 'ram-dist.png',
          ),
          array(
              'name'          => 'Word',
              'ext'           => 'doc',
              'icon'          => 'doc-dist.png',
          ),
          array(
              'name'          => 'DjVu',
              'ext'           => 'djv',
          ),
          array(
              'name'          => 'MNG',
              'ext'           => 'mng',
          ),
          array(
              'name'          => 'PostScript',
              'ext'           => 'eps',
              'icon'          => 'ps-dist.png',
          ),
          array(
              'name'          => 'GZ',
              'ext'           => 'gz',
              'icon'          => 'gz-dist.png',
          ),
          array(
              'name'          => 'WAV',
              'ext'           => 'wav',
              'icon'          => 'wav-dist.png',
          ),
          array(
              'name'          => 'HTML',
              'ext'           => 'html',
              'icon'          => 'html-dist.png',
          ),
          array(
              'name'          => 'Flash',
              'ext'           => 'swf',
              'icon'          => 'swf-dist.png',
          ),
          array(
              'name'          => 'PDF',
              'ext'           => 'pdf',
              'icon'          => 'pdf-dist.png',
          ),
          array(
              'name'          => 'PowerPoint',
              'ext'           => 'ppt',
              'icon'          => 'ppt-dist.png',
          ),
          array(
              'name'          => 'PostScript',
              'ext'           => 'ps',
              'icon'          => 'ps-dist.png',
          ),
          array(
              'name'          => 'Windows Media',
              'ext'           => 'wmv',
              'icon'          => 'wmv-dist.png',
          ),
          array(
              'name'          => 'RTF',
              'ext'           => 'rtf',
              'icon'          => 'rtf-dist.png',
          ),
          array(
              'name'          => 'StarOffice',
              'ext'           => 'sdd',
              'icon'          => 'sdd-dist.png',
          ),
          array(
              'name'          => 'StarOffice',
              'ext'           => 'sdw',
              'icon'          => 'sdw-dist.png',
          ),
          array(
              'name'          => 'Stuffit',
              'ext'           => 'sit',
              'icon'          => 'sit-dist.png',
          ),
          array(
              'name'          => 'Adobe Illustrator',
              'ext'           => 'ai',
              'icon'          => 'ai-dist.png',
          ),
          array(
              'name'          => 'OpenOffice Impress',
              'ext'           => 'sxi',
              'icon'          => 'sxi-dist.png',
          ),
          array(
              'name'          => 'OpenOffice',
              'ext'           => 'sxw',
              'icon'          => 'sxw-dist.png',
          ),
          array(
              'name'          => 'DVI',
              'ext'           => 'dvi',
              'icon'          => 'dvi-dist.png',
          ),
          array(
              'name'          => 'TGZ',
              'ext'           => 'tgz',
              'icon'          => 'tgz-dist.png',
          ),
          array(
              'name'          => 'texte',
              'ext'           => 'txt',
              'icon'          => 'txt-dist.png',
          ),
          array(
              'name'          => 'RedHat/Mandrake/SuSE',
              'ext'           => 'rpm',
              'icon'          => 'rpm-dist.png',
          ),
          array(
              'name'          => 'Excel',
              'ext'           => 'xls',
              'icon'          => 'xls-dist.png',
          ),
          array(
              'name'          => 'XML',
              'ext'           => 'xml',
              'icon'          => 'xml-dist.png',
          ),
          array(
              'name'          => 'Zip',
              'ext'           => 'zip',
              'icon'          => 'zip-dist.png',
          ),
          array(
              'name'          => 'Debian',
              'ext'           => 'deb',
              'icon'          => 'deb-dist.png',
          ),
          array(
              'name'          => 'C header',
              'ext'           => 'h',
              'icon'          => 'h-dist.png',
          ),
          array(
              'name'          => 'Pascal',
              'ext'           => 'pas',
              'icon'          => 'pas-dist.png',
          ),
          array(
              'name'          => 'OpenOffice Calc',
              'ext'           => 'sxc',
              'icon'          => 'sxc-dist.png',
          ),
          array(
              'name'          => 'LaTeX',
              'ext'           => 'tex',
              'icon'          => 'tex-dist.png',
          ),
          array(
              'name'          => 'GIMP multi-layer',
              'ext'           => 'xcf',
              'icon'          => 'xcf-dist.png',
          ),
          array(
              'name'          => 'JPEG',
              'ext'           => 'jpeg',
              'icon'          => 'jpg-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Writer',
              'ext'           => 'odt',
              'icon'          => 'odt-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Calc',
              'ext'           => 'ods',
              'icon'          => 'ods-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Impress',
              'ext'           => 'odp',
              'icon'          => 'odp-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Impress Template',
              'ext'           => 'otp',
              'icon'          => 'otp-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Writer Template',
              'ext'           => 'ott',
              'icon'          => 'odt-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Calc Template',
              'ext'           => 'ots',
              'icon'          => 'ods-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Math',
              'ext'           => 'odf',
              'icon'          => 'odf-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Draw',
              'ext'           => 'odg',
              'icon'          => 'odg-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Draw Template',
              'ext'           => 'otg',
              'icon'          => 'odg-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Base',
              'ext'           => 'odb',
              'icon'          => 'odb-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office HTML',
              'ext'           => 'oth',
              'icon'          => 'oth-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Writer Master',
              'ext'           => 'odm',
              'icon'          => 'odm-dist.png',
          ),
          array(
              'name'          => 'Oasis Open Office Chart',
              'ext'           => 'odc',
          ),
          array(
              'name'          => 'Oasis Open Office Image',
              'ext'           => 'odi',
          ),
          array(
              'name'          => 'Word XML',
              'ext'           => 'docx',
              'icon'          => 'doc-dist.png',
          ),
          array(
              'name'          => 'Excel XML',
              'ext'           => 'xlsx',
              'icon'          => 'xls-dist.png',
          ),
          array(
              'name'          => 'PowerPoint XML',
              'ext'           => 'pptx',
              'icon'          => 'ppt-dist.png',
          ),
          array(
              'name'          => 'Comma-Separated Values',
              'ext'           => 'csv',
              'icon'          => 'csv-dist.png',
          ),
          array(
              'name'          => 'Scalable Vector Graphics',
              'ext'           => 'svg',
              'icon'          => 'svg-dist.png',
          ),
      );
      $this->insert('glpi_documenttype', $rows);


      // Insert into table glpi_filesystem
      $rows = array(
          array(
              'name' => 'ext',
          ),
          array(
              'name' => 'ext2',
          ),
          array(
              'name' => 'ext3',
          ),
          array(
              'name' => 'ext4',
          ),
          array(
              'name' => 'FAT',
          ),
          array(
              'name' => 'FAT32',
          ),
          array(
              'name' => 'VFAT',
          ),
          array(
              'name' => 'HFS',
          ),
          array(
              'name' => 'HPFS',
          ),
          array(
              'name' => 'HTFS',
          ),
          array(
              'name' => 'JFS',
          ),
          array(
              'name' => 'JFS2',
          ),
          array(
              'name' => 'NFS',
          ),
          array(
              'name' => 'NTFS',
          ),
          array(
              'name' => 'ReiserFS',
          ),
          array(
              'name' => 'SMBFS',
          ),
          array(
              'name' => 'UDF',
          ),
          array(
              'name' => 'UFS',
          ),
          array(
              'name' => 'XFS',
          ),
          array(
              'name' => 'ZFS',
          ),
      );
      $this->insert('glpi_filesystem', $rows);


      // Insert into table glpi_interfacetype
      $rows = array(
          array(
              'name' => 'IDE',
          ),
          array(
              'name' => 'SATA',
          ),
          array(
              'name' => 'SCSI',
          ),
          array(
              'name' => 'USB',
          ),
          array(
              'name' => 'AGP',
          ),
          array(
              'name' => 'PCI',
          ),
          array(
              'name' => 'PCIe',
          ),
          array(
              'name' => 'PCI-X',
          ),
      );
      $this->insert('glpi_interfacetype', $rows);


      // Insert into table glpi_notificationtemplate
      $rows = array(
          array(
              'name'     => 'MySQL Synchronization',
              'itemtype' => 'DBConnection',
          ),
          array(
              'name'     => 'Reservations',
              'itemtype' => 'Reservation',
          ),
          array(
              'name'     => 'Alert Reservation',
              'itemtype' => 'Reservation',
          ),
          array(
              'name'     => 'Tickets',
              'itemtype' => 'Ticket',
          ),
          array(
              'name'     => 'Tickets (Simple)',
              'itemtype' => 'Ticket',
          ),
          array(
              'name'     => 'Alert Tickets not closed',
              'itemtype' => 'Ticket',
          ),
          array(
              'name'     => 'Tickets Validation',
              'itemtype' => 'Ticket',
          ),
          array(
              'name'     => 'Cartridges',
              'itemtype' => 'CartridgeItem',
          ),
          array(
              'name'     => 'Consumables',
              'itemtype' => 'ConsumableItem',
          ),
          array(
              'name'     => 'Infocoms',
              'itemtype' => 'Infocom',
          ),
          array(
              'name'     => 'Licenses',
              'itemtype' => 'SoftwareLicense',
          ),
          array(
              'name'     => 'Contracts',
              'itemtype' => 'Contract',
          ),
          array(
              'name'     => 'Password Forget',
              'itemtype' => 'User',
          ),
          array(
              'name'     => 'Ticket Satisfaction',
              'itemtype' => 'Ticket',
          ),
          array(
              'name'     => 'Item not unique',
              'itemtype' => 'FieldUnicity',
          ),
          array(
              'name'     => 'Crontask',
              'itemtype' => 'Crontask',
          ),
          array(
              'name'     => 'Problems',
              'itemtype' => 'Problem',
          ),
          array(
              'name'     => 'Planning recall',
              'itemtype' => 'PlanningRecall',
          ),
          array(
              'name'     => 'Changes',
              'itemtype' => 'Change',
          ),
          array(
              'name'     => 'Receiver errors',
              'itemtype' => 'MailCollector',
          ),
          array(
              'name'     => 'Projects',
              'itemtype' => 'Project',
          ),
          array(
              'name'     => 'Project Tasks',
              'itemtype' => 'ProjectTask',
          ),
          array(
              'name'     => 'Unlock Item request',
              'itemtype' => 'ObjectLock',
          ),
      );
      $this->insert('glpi_notificationtemplate', $rows);
      $notificationtemplates = $this->fetchAll('SELECT * FROM glpi_notificationtemplate');
      $notiftemplates = array();
      foreach ($notificationtemplates as $data) {
         $notiftemplates[$data['name']] = $data['id'];
      }


      // Insert into table glpi_notification
      $rows = array(
          array(
              'name'                    => 'Alert Tickets not closed',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'alertnotclosed',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Alert Tickets not closed'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'New Ticket',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'new',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Ticket',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'update',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Close Ticket',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'closed',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Add Followup',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'add_followup',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Add Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'add_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Followup',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'update_followup',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'update_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Followup',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'delete_followup',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'delete_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Resolve ticket',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'solved',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Ticket Validation',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'validation',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets Validation'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'New Reservation',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Reservation',
              'event'                   => 'new',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Reservations'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Reservation',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Reservation',
              'event'                   => 'update',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Reservations'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Reservation',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Reservation',
              'event'                   => 'delete',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Reservations'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Alert Reservation',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Reservation',
              'event'                   => 'alert',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Alert Reservation'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Contract Notice',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Contract',
              'event'                   => 'notice',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Contracts'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Contract End',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Contract',
              'event'                   => 'end',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Contracts'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'MySQL Synchronization',
              'entity_id'               => $entity_id,
              'itemtype'                => 'DBConnection',
              'event'                   => 'desynchronization',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['MySQL Synchronization'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Cartridges',
              'entity_id'               => $entity_id,
              'itemtype'                => 'CartridgeItem',
              'event'                   => 'alert',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Cartridges'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Consumables',
              'entity_id'               => $entity_id,
              'itemtype'                => 'ConsumableItem',
              'event'                   => 'alert',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Consumables'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Infocoms',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Infocom',
              'event'                   => 'alert',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Infocoms'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Software Licenses',
              'entity_id'               => $entity_id,
              'itemtype'                => 'SoftwareLicense',
              'event'                   => 'alert',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Licenses'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Ticket Recall',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'recall',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Password Forget',
              'entity_id'               => $entity_id,
              'itemtype'                => 'User',
              'event'                   => 'passwordforget',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Password Forget'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Ticket Satisfaction',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'satisfaction',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Ticket Satisfaction'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Item not unique',
              'entity_id'               => $entity_id,
              'itemtype'                => 'FieldUnicity',
              'event'                   => 'refuse',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Item not unique'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Crontask Watcher',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Crontask',
              'event'                   => 'alert',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Crontask'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'New Problem',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'new',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Problem',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'update',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Resolve Problem',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'solved',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Add Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'add_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'update_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'delete_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Close Problem',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'closed',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Problem',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Problem',
              'event'                   => 'delete',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Ticket Validation Answer',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'validation_answer',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets Validation'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Contract End Periodicity',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Contract',
              'event'                   => 'periodicity',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Contracts'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Contract Notice Periodicity',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Contract',
              'event'                   => 'periodicitynotice',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Contracts'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Planning recall',
              'entity_id'               => $entity_id,
              'itemtype'                => 'PlanningRecall',
              'event'                   => 'planningrecall',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Planning recall'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Ticket',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'delete',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'New Change',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'new',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Change',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'update',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Resolve Change',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'solved',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Add Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'add_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'update_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'delete_task',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Close Change',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'closed',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Change',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Change',
              'event'                   => 'delete',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Ticket Satisfaction Answer',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Ticket',
              'event'                   => 'replysatisfaction',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Ticket Satisfaction'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Receiver errors',
              'entity_id'               => $entity_id,
              'itemtype'                => 'MailCollector',
              'event'                   => 'error',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Receiver errors'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'New Project',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Project',
              'event'                   => 'new',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Projects'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Project',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Project',
              'event'                   => 'update',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Projects'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Project',
              'entity_id'               => $entity_id,
              'itemtype'                => 'Project',
              'event'                   => 'delete',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Projects'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'New Project Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'ProjectTask',
              'event'                   => 'new',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Project Tasks'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Update Project Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'ProjectTask',
              'event'                   => 'update',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Project Tasks'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Delete Project Task',
              'entity_id'               => $entity_id,
              'itemtype'                => 'ProjectTask',
              'event'                   => 'delete',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Project Tasks'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
          array(
              'name'                    => 'Request Unlock Items',
              'entity_id'               => $entity_id,
              'itemtype'                => 'ObjectLock',
              'event'                   => 'unlock',
              'mode'                    => 'mail',
              'notificationtemplate_id' => $notiftemplates['Unlock Item request'],
              'is_recursive'            => true,
              'is_active'               => true
          ),
      );
      $this->insert('glpi_notification', $rows);
      $notifications = $this->fetchAll('SELECT * FROM glpi_notification');
      $notifs = array();
      foreach ($notifications as $data) {
         $notifs[$data['itemtype'].'-'.$data['event']] = $data['id'];
      }


      // Insert into table glpi_notificationtarget
      $rows = array(
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Reservation-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Reservation-new'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 2,
              'notification_id'  => $notifs['Ticket-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-add_followup'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-closed'],
          ),
          array(
              'items_id'         => 2,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update'],
          ),
          array(
              'items_id'         => 4,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-new'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-add_followup'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-closed'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['DBConnection-desynchronization'],
          ),
          array(
              'items_id'         => 14,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-validation'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Reservation-update'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Reservation-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Reservation-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Reservation-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-add_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-add_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update_followup'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update_followup'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete_followup'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete_followup'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-solved'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-solved'],
          ),
          array(
              'items_id'         => 19,
              'type'             => 1,
              'notification_id'  => $notifs['User-passwordforget'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-satisfaction'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-new'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-add_followup'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-closed'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-add_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update_followup'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-update_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete_followup'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-solved'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Crontask-alert'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-new'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-new'],
          ),
          array(
              'items_id'         => 2,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update'],
          ),
          array(
              'items_id'         => 4,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-solved'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-solved'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-solved'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-add_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-add_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-add_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-update_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-delete_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-delete_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-delete_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-closed'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-closed'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-closed'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-delete'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Problem-delete'],
          ),
          array(
              'items_id'         => 14,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-validation_answer'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['PlanningRecall-planningrecall'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-new'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-new'],
          ),
          array(
              'items_id'         => 2,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update'],
          ),
          array(
              'items_id'         => 4,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-solved'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-solved'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-solved'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-add_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-add_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-add_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-update_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-delete_task'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-delete_task'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-delete_task'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-closed'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-closed'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-closed'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Change-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Change-delete'],
          ),
          array(
              'items_id'         => 21,
              'type'             => 1,
              'notification_id'  => $notifs['Change-delete'],
          ),
          array(
              'items_id'         => 3,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-replysatisfaction'],
          ),
          array(
              'items_id'         => 2,
              'type'             => 1,
              'notification_id'  => $notifs['Ticket-replysatisfaction'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['MailCollector-error'],
          ),
          array(
              'items_id'         => 27,
              'type'             => 1,
              'notification_id'  => $notifs['Project-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Project-new'],
          ),
          array(
              'items_id'         => 28,
              'type'             => 1,
              'notification_id'  => $notifs['Project-new'],
          ),
          array(
              'items_id'         => 27,
              'type'             => 1,
              'notification_id'  => $notifs['Project-update'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Project-update'],
          ),
          array(
              'items_id'         => 28,
              'type'             => 1,
              'notification_id'  => $notifs['Project-update'],
          ),
          array(
              'items_id'         => 27,
              'type'             => 1,
              'notification_id'  => $notifs['Project-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['Project-delete'],
          ),
          array(
              'items_id'         => 28,
              'type'             => 1,
              'notification_id'  => $notifs['Project-delete'],
          ),
          array(
              'items_id'         => 31,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-new'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-new'],
          ),
          array(
              'items_id'         => 32,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-new'],
          ),
          array(
              'items_id'         => 31,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-update'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-update'],
          ),
          array(
              'items_id'         => 32,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-update'],
          ),
          array(
              'items_id'         => 31,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-delete'],
          ),
          array(
              'items_id'         => 1,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-delete'],
          ),
          array(
              'items_id'         => 32,
              'type'             => 1,
              'notification_id'  => $notifs['ProjectTask-delete'],
          ),
          array(
              'items_id'         => 19,
              'type'             => 1,
              'notification_id'  => $notifs['ObjectLock-unlock'],
          ),
      );
      $this->insert('glpi_notificationtarget', $rows);


      // Insert into table glpi_notificationtemplatetranslation
      $rows = array(
          array(
              'notificationtemplate_id' => $notiftemplates['MySQL Synchronization'],
              'subject'                 => '##lang.dbconnection.title##',
              'content_text'            => "##lang.dbconnection.delay## : ##dbconnection.delay##\n",
              'content_html'            => "&lt;p&gt;##lang.dbconnection.delay## : ##dbconnection.delay##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Reservations'],
              'subject'                 => '##reservation.action##',
              'content_text'            => "======================================================================\n"
                                         . "##lang.reservation.user##: ##reservation.user##\n"
                                         . "##lang.reservation.item.name##: ##reservation.itemtype## - ##reservation.item.name##\n"
                                         . "##IFreservation.tech## ##lang.reservation.tech## ##reservation.tech## ##ENDIFreservation.tech##\n"
                                         . "##lang.reservation.begin##: ##reservation.begin##\n"
                                         . "##lang.reservation.end##: ##reservation.end##\n"
                                         . "##lang.reservation.comment##: ##reservation.comment##\n"
                                         . "======================================================================\n",
              'content_html'            => "&lt;!-- description{ color: inherit; background: #ebebeb;border-style: solid;border-color: #8d8d8d; border-width: 0px 1px 1px 0px; } --&gt;\n"
                                         . "&lt;p&gt;&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.reservation.user##:&lt;/span&gt;##reservation.user##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.reservation.item.name##:&lt;/span&gt;##reservation.itemtype## - ##reservation.item.name##&lt;br /&gt;##IFreservation.tech## ##lang.reservation.tech## ##reservation.tech####ENDIFreservation.tech##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.reservation.begin##:&lt;/span&gt; ##reservation.begin##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.reservation.end##:&lt;/span&gt;##reservation.end##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.reservation.comment##:&lt;/span&gt; ##reservation.comment##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Alert Reservation'],
              'subject'                 => '##reservation.action##  ##reservation.entity##',
              'content_text'            => "##lang.reservation.entity## : ##reservation.entity##\n"
                                         . "\n"
                                         . "\n"
                                         . "##FOREACHreservations##\n"
                                         . "##lang.reservation.itemtype## : ##reservation.itemtype##\n"
                                         . "\n"
                                         . " ##lang.reservation.item## : ##reservation.item##\n"
                                         . "\n"
                                         . " ##reservation.url##\n"
                                         . "\n"
                                         . " ##ENDFOREACHreservations##",
              'content_html'            => "&lt;p&gt;##lang.reservation.entity## : ##reservation.entity## &lt;br /&gt; &lt;br /&gt;\n"
                                         . "##FOREACHreservations## &lt;br /&gt;##lang.reservation.itemtype## :  ##reservation.itemtype##&lt;br /&gt;\n"
                                         . " ##lang.reservation.item## :  ##reservation.item##&lt;br /&gt; &lt;br /&gt;\n"
                                         . " &lt;a href=\"##reservation.url##\"&gt; ##reservation.url##&lt;/a&gt;&lt;br /&gt;\n"
                                         . " ##ENDFOREACHreservations##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Tickets'],
              'subject'                 => '##ticket.action## ##ticket.title##',
              'content_text'            => " ##IFticket.storestatus=5##\n"
                                         . " ##lang.ticket.url## : ##ticket.urlapprove##\n"
                                         . " ##lang.ticket.autoclosewarning##\n"
                                         . " ##lang.ticket.solvedate## : ##ticket.solvedate##\n"
                                         . " ##lang.ticket.solution.type## : ##ticket.solution.type##\n"
                                         . " ##lang.ticket.solution.description## : ##ticket.solution.description## ##ENDIFticket.storestatus##\n"
                                         . " ##ELSEticket.storestatus## ##lang.ticket.url## : ##ticket.url## ##ENDELSEticket.storestatus##\n"
                                         . "\n"
                                         . " ##lang.ticket.description##\n"
                                         . "\n"
                                         . " ##lang.ticket.title## : ##ticket.title##\n"
                                         . " ##lang.ticket.authors## : ##IFticket.authors## ##ticket.authors## ##ENDIFticket.authors## ##ELSEticket.authors##--##ENDELSEticket.authors##\n"
                                         . " ##lang.ticket.creationdate## : ##ticket.creationdate##\n"
                                         . " ##lang.ticket.closedate## : ##ticket.closedate##\n"
                                         . " ##lang.ticket.requesttype## : ##ticket.requesttype##\n"
                                         . "##lang.ticket.item.name## :\n"
                                         . "\n"
                                         . "##FOREACHitems##\n"
                                         . "\n"
                                         . " ##IFticket.itemtype##\n"
                                         . "  ##ticket.itemtype## - ##ticket.item.name##\n"
                                         . "  ##IFticket.item.model## ##lang.ticket.item.model## : ##ticket.item.model## ##ENDIFticket.item.model##\n"
                                         . "  ##IFticket.item.serial## ##lang.ticket.item.serial## : ##ticket.item.serial## ##ENDIFticket.item.serial##\n"
                                         . "  ##IFticket.item.otherserial## ##lang.ticket.item.otherserial## : ##ticket.item.otherserial## ##ENDIFticket.item.otherserial##\n"
                                         . " ##ENDIFticket.itemtype##\n"
                                         . "\n"
                                         . "##ENDFOREACHitems##\n"
                                         . "##IFticket.assigntousers## ##lang.ticket.assigntousers## : ##ticket.assigntousers## ##ENDIFticket.assigntousers##\n"
                                         . " ##lang.ticket.status## : ##ticket.status##\n"
                                         . "##IFticket.assigntogroups## ##lang.ticket.assigntogroups## : ##ticket.assigntogroups## ##ENDIFticket.assigntogroups##\n"
                                         . " ##lang.ticket.urgency## : ##ticket.urgency##\n"
                                         . " ##lang.ticket.impact## : ##ticket.impact##\n"
                                         . " ##lang.ticket.priority## : ##ticket.priority##\n"
                                         . "##IFticket.user.email## ##lang.ticket.user.email## : ##ticket.user.email ##ENDIFticket.user.email##\n"
                                         . "##IFticket.category## ##lang.ticket.category## : ##ticket.category## ##ENDIFticket.category## ##ELSEticket.category## ##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##\n"
                                         . " ##lang.ticket.content## : ##ticket.content##\n"
                                         . " ##IFticket.storestatus=6##\n"
                                         . "\n"
                                         . " ##lang.ticket.solvedate## : ##ticket.solvedate##\n"
                                         . " ##lang.ticket.solution.type## : ##ticket.solution.type##\n"
                                         . " ##lang.ticket.solution.description## : ##ticket.solution.description##\n"
                                         . " ##ENDIFticket.storestatus##\n"
                                         . " ##lang.ticket.numberoffollowups## : ##ticket.numberoffollowups##\n"
                                         . "\n"
                                         . "##FOREACHfollowups##\n"
                                         . "\n"
                                         . " [##followup.date##] ##lang.followup.isprivate## : ##followup.isprivate##\n"
                                         . " ##lang.followup.author## ##followup.author##\n"
                                         . " ##lang.followup.description## ##followup.description##\n"
                                         . " ##lang.followup.date## ##followup.date##\n"
                                         . " ##lang.followup.requesttype## ##followup.requesttype##\n"
                                         . "\n"
                                         . "##ENDFOREACHfollowups##\n"
                                         . " ##lang.ticket.numberoftasks## : ##ticket.numberoftasks##\n"
                                         . "\n"
                                         . "##FOREACHtasks##\n"
                                         . "\n"
                                         . " [##task.date##] ##lang.task.isprivate## : ##task.isprivate##\n"
                                         . " ##lang.task.author## ##task.author##\n"
                                         . " ##lang.task.description## ##task.description##\n"
                                         . " ##lang.task.time## ##task.time##\n"
                                         . " ##lang.task.category## ##task.category##\n"
                                         . "\n"
                                         . "##ENDFOREACHtasks##",
              'content_html'            => "<!-- description{ color: inherit; background: #ebebeb; border-style: solid;border-color: #8d8d8d; border-width: 0px 1px 1px 0px; }    -->\n"
                                         . "<div>##IFticket.storestatus=5##</div>\n"
                                         . "<div>##lang.ticket.url## : <a href=\"##ticket.urlapprove##\">##ticket.urlapprove##</a> <strong>&#160;</strong></div>\n"
                                         . "<div><strong>##lang.ticket.autoclosewarning##</strong></div>\n"
                                         . "<div><span style=\"color: #888888;\"><strong><span style=\"text-decoration: underline;\">##lang.ticket.solvedate##</span></strong></span> : ##ticket.solvedate##<br /><span style=\"text-decoration: underline; color: #888888;\"><strong>##lang.ticket.solution.type##</strong></span> : ##ticket.solution.type##<br /><span style=\"text-decoration: underline; color: #888888;\"><strong>##lang.ticket.solution.description##</strong></span> : ##ticket.solution.description## ##ENDIFticket.storestatus##</div>\n"
                                         . "<div>##ELSEticket.storestatus## ##lang.ticket.url## : <a href=\"##ticket.url##\">##ticket.url##</a> ##ENDELSEticket.storestatus##</div>\n"
                                         . "<p class=\"description b\"><strong>##lang.ticket.description##</strong></p>\n"
                                         . "<p><span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.title##</span>&#160;:##ticket.title## <br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.authors##</span>&#160;:##IFticket.authors## ##ticket.authors## ##ENDIFticket.authors##    ##ELSEticket.authors##--##ENDELSEticket.authors## <br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.creationdate##</span>&#160;:##ticket.creationdate## <br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.closedate##</span>&#160;:##ticket.closedate## <br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.requesttype##</span>&#160;:##ticket.requesttype##<br />\n"
                                         . "<br /><span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.item.name##</span>&#160;:\n"
                                         . "<p>##FOREACHitems##</p>\n"
                                         . "<div class=\"description b\">##IFticket.itemtype## ##ticket.itemtype##&#160;- ##ticket.item.name## ##IFticket.item.model## ##lang.ticket.item.model## : ##ticket.item.model## ##ENDIFticket.item.model## ##IFticket.item.serial## ##lang.ticket.item.serial## : ##ticket.item.serial## ##ENDIFticket.item.serial## ##IFticket.item.otherserial## ##lang.ticket.item.otherserial## : ##ticket.item.otherserial## ##ENDIFticket.item.otherserial## ##ENDIFticket.itemtype## </div><br />\n"
                                         . "<p>##ENDFOREACHitems##</p>\n"
                                         . "##IFticket.assigntousers## <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.assigntousers##</span>&#160;: ##ticket.assigntousers## ##ENDIFticket.assigntousers##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\">##lang.ticket.status## </span>&#160;: ##ticket.status##<br /> ##IFticket.assigntogroups## <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.assigntogroups##</span>&#160;: ##ticket.assigntogroups## ##ENDIFticket.assigntogroups##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.urgency##</span>&#160;: ##ticket.urgency##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.impact##</span>&#160;: ##ticket.impact##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.priority##</span>&#160;: ##ticket.priority## <br /> ##IFticket.user.email##<span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.user.email##</span>&#160;: ##ticket.user.email ##ENDIFticket.user.email##    <br /> ##IFticket.category##<span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\">##lang.ticket.category## </span>&#160;:##ticket.category## ##ENDIFticket.category## ##ELSEticket.category## ##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##    <br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.ticket.content##</span>&#160;: ##ticket.content##</p>\n"
                                         . "<br />##IFticket.storestatus=6##<br /><span style=\"text-decoration: underline;\"><strong><span style=\"color: #888888;\">##lang.ticket.solvedate##</span></strong></span> : ##ticket.solvedate##<br /><span style=\"color: #888888;\"><strong><span style=\"text-decoration: underline;\">##lang.ticket.solution.type##</span></strong></span> : ##ticket.solution.type##<br /><span style=\"text-decoration: underline; color: #888888;\"><strong>##lang.ticket.solution.description##</strong></span> : ##ticket.solution.description##<br />##ENDIFticket.storestatus##</p>\n"
                                         . "<div class=\"description b\">##lang.ticket.numberoffollowups##&#160;: ##ticket.numberoffollowups##</div>\n"
                                         . "<p>##FOREACHfollowups##</p>\n"
                                         . "<div class=\"description b\"><br /> <strong> [##followup.date##] <em>##lang.followup.isprivate## : ##followup.isprivate## </em></strong><br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.followup.author## </span> ##followup.author##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.followup.description## </span> ##followup.description##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.followup.date## </span> ##followup.date##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.followup.requesttype## </span> ##followup.requesttype##</div>\n"
                                         . "<p>##ENDFOREACHfollowups##</p>\n"
                                         . "<div class=\"description b\">##lang.ticket.numberoftasks##&#160;: ##ticket.numberoftasks##</div>\n"
                                         . "<p>##FOREACHtasks##</p>\n"
                                         . "<div class=\"description b\"><br /> <strong> [##task.date##] <em>##lang.task.isprivate## : ##task.isprivate## </em></strong><br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.task.author##</span> ##task.author##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.task.description##</span> ##task.description##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.task.time##</span> ##task.time##<br /> <span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"> ##lang.task.category##</span> ##task.category##</div>\n"
                                         . "<p>##ENDFOREACHtasks##</p>",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Contracts'],
              'subject'                 => '##contract.action##  ##contract.entity##',
              'content_text'            => "##lang.contract.entity## : ##contract.entity##\n"
                                         . "\n"
                                         . "##FOREACHcontracts##\n"
                                         . "##lang.contract.name## : ##contract.name##\n"
                                         . "##lang.contract.number## : ##contract.number##\n"
                                         . "##lang.contract.time## : ##contract.time##\n"
                                         . "##IFcontract.type####lang.contract.type## : ##contract.type####ENDIFcontract.type##\n"
                                         . "##contract.url##\n"
                                         . "##ENDFOREACHcontracts##",
              'content_html'            => "&lt;p&gt;##lang.contract.entity## : ##contract.entity##&lt;br /&gt;\n"
                                         . "&lt;br /&gt;##FOREACHcontracts##&lt;br /&gt;##lang.contract.name## :\n"
                                         . "##contract.name##&lt;br /&gt;\n"
                                         . "##lang.contract.number## : ##contract.number##&lt;br /&gt;\n"
                                         . "##lang.contract.time## : ##contract.time##&lt;br /&gt;\n"
                                         . "##IFcontract.type####lang.contract.type## : ##contract.type##\n"
                                         . "##ENDIFcontract.type##&lt;br /&gt;\n"
                                         . "&lt;a href=\"##contract.url##\"&gt;\n"
                                         . "##contract.url##&lt;/a&gt;&lt;br /&gt;\n"
                                         . "##ENDFOREACHcontracts##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Tickets (Simple)'],
              'subject'                 => '##ticket.action## ##ticket.title##',
              'content_text'            => "##lang.ticket.url## : ##ticket.url##\n"
                                         . "\n"
                                         . "##lang.ticket.description##\n"
                                         . "\n"
                                         . "\n"
                                         . "##lang.ticket.title##  :##ticket.title##\n"
                                         . "\n"
                                         . "##lang.ticket.authors##  :##IFticket.authors##\n"
                                         . "##ticket.authors## ##ENDIFticket.authors##\n"
                                         . "##ELSEticket.authors##--##ENDELSEticket.authors##\n"
                                         . "\n"
                                         . "##IFticket.category## ##lang.ticket.category##  :##ticket.category##\n"
                                         . "##ENDIFticket.category## ##ELSEticket.category##\n"
                                         . "##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##\n"
                                         . "\n"
                                         . "##lang.ticket.content##  : ##ticket.content##\n"
                                         . "##IFticket.itemtype##\n"
                                         . "##lang.ticket.item.name##  : ##ticket.itemtype## - ##ticket.item.name##\n"
                                         . "##ENDIFticket.itemtype##",
              'content_html'            => "&lt;div&gt;##lang.ticket.url## : &lt;a href=\"##ticket.url##\"&gt;\n"
                                         . "##ticket.url##&lt;/a&gt;&lt;/div&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;\n"
                                         . "##lang.ticket.description##&lt;/div&gt;\n"
                                         . "&lt;p&gt;&lt;span\n"
                                         . "style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;\n"
                                         . "##lang.ticket.title##&lt;/span&gt;&#160;:##ticket.title##\n"
                                         . "&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;\n"
                                         . "##lang.ticket.authors##&lt;/span&gt;\n"
                                         . "##IFticket.authors## ##ticket.authors##\n"
                                         . "##ENDIFticket.authors##\n"
                                         . "##ELSEticket.authors##--##ENDELSEticket.authors##\n"
                                         . "&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;&#160\n"
                                         . ";&lt;/span&gt;&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; &lt;/span&gt;\n"
                                         . "##IFticket.category##&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;\n"
                                         . "##lang.ticket.category## &lt;/span&gt;&#160;:##ticket.category##\n"
                                         . "##ENDIFticket.category## ##ELSEticket.category##\n"
                                         . "##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##\n"
                                         . "&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;\n"
                                         . "##lang.ticket.content##&lt;/span&gt;&#160;:\n"
                                         . "##ticket.content##&lt;br /&gt;##IFticket.itemtype##\n"
                                         . "&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;\n"
                                         . "##lang.ticket.item.name##&lt;/span&gt;&#160;:\n"
                                         . "##ticket.itemtype## - ##ticket.item.name##\n"
                                         . "##ENDIFticket.itemtype##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Item not unique'],
              'subject'                 => '##lang.unicity.action##',
              'content_text'            => "##lang.unicity.entity## : ##unicity.entity##\n"
                                         . "\n"
                                         . "##lang.unicity.itemtype## : ##unicity.itemtype##\n"
                                         . "\n"
                                         . "##lang.unicity.message## : ##unicity.message##\n"
                                         . "\n"
                                         . "##lang.unicity.action_user## : ##unicity.action_user##\n"
                                         . "\n"
                                         . "##lang.unicity.action_type## : ##unicity.action_type##\n"
                                         . "\n"
                                         . "##lang.unicity.date## : ##unicity.date##",
              'content_html'            => "&lt;p&gt;##lang.unicity.entity## : ##unicity.entity##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.unicity.itemtype## : ##unicity.itemtype##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.unicity.message## : ##unicity.message##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.unicity.action_user## : ##unicity.action_user##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.unicity.action_type## : ##unicity.action_type##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.unicity.date## : ##unicity.date##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Tickets Validation'],
              'subject'                 => '##ticket.action## ##ticket.title##',
              'content_text'            => "##FOREACHvalidations##\n"
                                         . "\n"
                                         . "##IFvalidation.storestatus=2##\n"
                                         . "##validation.submission.title##\n"
                                         . "##lang.validation.commentsubmission## : ##validation.commentsubmission##\n"
                                         . "##ENDIFvalidation.storestatus##\n"
                                         . "##ELSEvalidation.storestatus## ##validation.answer.title## ##ENDELSEvalidation.storestatus##\n"
                                         . "\n"
                                         . "##lang.ticket.url## : ##ticket.urlvalidation##\n"
                                         . "\n"
                                         . "##IFvalidation.status## ##lang.validation.status## : ##validation.status## ##ENDIFvalidation.status##\n"
                                         . "##IFvalidation.commentvalidation##\n"
                                         . "##lang.validation.commentvalidation## : ##validation.commentvalidation##\n"
                                         . "##ENDIFvalidation.commentvalidation##\n"
                                         . "##ENDFOREACHvalidations##",
              'content_html'            => "&lt;div&gt;##FOREACHvalidations##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##IFvalidation.storestatus=2##&lt;/p&gt;\n"
                                         . "&lt;div&gt;##validation.submission.title##&lt;/div&gt;\n"
                                         . "&lt;div&gt;##lang.validation.commentsubmission## : ##validation.commentsubmission##&lt;/div&gt;\n"
                                         . "&lt;div&gt;##ENDIFvalidation.storestatus##&lt;/div&gt;\n"
                                         . "&lt;div&gt;##ELSEvalidation.storestatus## ##validation.answer.title## ##ENDELSEvalidation.storestatus##&lt;/div&gt;\n"
                                         . "&lt;div&gt;&lt;/div&gt;\n"
                                         . "&lt;div&gt;\n"
                                         . "&lt;div&gt;##lang.ticket.url## : &lt;a href=\"##ticket.urlvalidation##\"&gt; ##ticket.urlvalidation## &lt;/a&gt;&lt;/div&gt;\n"
                                         . "&lt;/div&gt;\n"
                                         . "&lt;p&gt;##IFvalidation.status## ##lang.validation.status## : ##validation.status## ##ENDIFvalidation.status##\n"
                                         . "&lt;br /&gt; ##IFvalidation.commentvalidation##&lt;br /&gt; ##lang.validation.commentvalidation## :\n"
                                         . "&#160; ##validation.commentvalidation##&lt;br /&gt; ##ENDIFvalidation.commentvalidation##\n"
                                         . "&lt;br /&gt;##ENDFOREACHvalidations##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Alert Tickets not closed'],
              'subject'                 => '##ticket.action## ##ticket.entity##',
              'content_text'            => "##lang.ticket.entity## : ##ticket.entity##\n"
                                         . "\n"
                                         . "##FOREACHtickets##\n"
                                         . "\n"
                                         . "##lang.ticket.title## : ##ticket.title##\n"
                                         . " ##lang.ticket.status## : ##ticket.status##\n"
                                         . "\n"
                                         . " ##ticket.url##\n"
                                         . " ##ENDFOREACHtickets##",
              'content_html'            => "&lt;table class=\"tab_cadre\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\"&gt;\n"
                                         . "&lt;tbody&gt;\n"
                                         . "&lt;tr&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.authors##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.title##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.priority##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.status##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.attribution##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.creationdate##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td style=\"text-align: left;\" width=\"auto\" bgcolor=\"#cccccc\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##lang.ticket.content##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;/tr&gt;\n"
                                         . "##FOREACHtickets##\n"
                                         . "&lt;tr&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##ticket.authors##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;&lt;a href=\"##ticket.url##\"&gt;##ticket.title##&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##ticket.priority##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##ticket.status##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##IFticket.assigntousers####ticket.assigntousers##&lt;br /&gt;##ENDIFticket.assigntousers####IFticket.assigntogroups##&lt;br /&gt;##ticket.assigntogroups## ##ENDIFticket.assigntogroups####IFticket.assigntosupplier##&lt;br /&gt;##ticket.assigntosupplier## ##ENDIFticket.assigntosupplier##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##ticket.creationdate##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;td width=\"auto\"&gt;&lt;span style=\"font-size: 11px; text-align: left;\"&gt;##ticket.content##&lt;/span&gt;&lt;/td&gt;\n"
                                         . "&lt;/tr&gt;\n"
                                         . "##ENDFOREACHtickets##\n"
                                         . "&lt;/tbody&gt;\n"
                                         . "&lt;/table&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Consumables'],
              'subject'                 => '##consumable.action##  ##consumable.entity##',
              'content_text'            => "##lang.consumable.entity## : ##consumable.entity##\n"
                                         . "\n"
                                         . "\n"
                                         . "##FOREACHconsumables##\n"
                                         . "##lang.consumable.item## : ##consumable.item##\n"
                                         . "\n"
                                         . "\n"
                                         . "##lang.consumable.reference## : ##consumable.reference##\n"
                                         . "\n"
                                         . "##lang.consumable.remaining## : ##consumable.remaining##\n"
                                         . "\n"
                                         . "##consumable.url##\n"
                                         . "\n"
                                         . "##ENDFOREACHconsumables##",
              'content_html'            => "&lt;p&gt;\n"
                                         . "##lang.consumable.entity## : ##consumable.entity##\n"
                                         . "&lt;br /&gt; &lt;br /&gt;##FOREACHconsumables##\n"
                                         . "&lt;br /&gt;##lang.consumable.item## : ##consumable.item##&lt;br /&gt;\n"
                                         . "&lt;br /&gt;##lang.consumable.reference## : ##consumable.reference##&lt;br /&gt;\n"
                                         . "##lang.consumable.remaining## : ##consumable.remaining##&lt;br /&gt;\n"
                                         . "&lt;a href=\"##consumable.url##\"&gt; ##consumable.url##&lt;/a&gt;&lt;br /&gt;\n"
                                         . "   ##ENDFOREACHconsumables##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Cartridges'],
              'subject'                 => '##cartridge.action##  ##cartridge.entity##',
              'content_text'            => "##lang.cartridge.entity## : ##cartridge.entity##\n"
                                         . "\n"
                                         . "\n"
                                         . "##FOREACHcartridges##\n"
                                         . "##lang.cartridge.item## : ##cartridge.item##\n"
                                         . "\n"
                                         . "\n"
                                         . "##lang.cartridge.reference## : ##cartridge.reference##\n"
                                         . "\n"
                                         . "##lang.cartridge.remaining## : ##cartridge.remaining##\n"
                                         . "\n"
                                         . "##cartridge.url##\n"
                                         . " ##ENDFOREACHcartridges##",
              'content_html'            => "&lt;p&gt;##lang.cartridge.entity## : ##cartridge.entity##\n"
                                         . "&lt;br /&gt; &lt;br /&gt;##FOREACHcartridges##\n"
                                         . "&lt;br /&gt;##lang.cartridge.item## :\n"
                                         . "##cartridge.item##&lt;br /&gt; &lt;br /&gt;\n"
                                         . "##lang.cartridge.reference## :\n"
                                         . "##cartridge.reference##&lt;br /&gt;\n"
                                         . "##lang.cartridge.remaining## :\n"
                                         . "##cartridge.remaining##&lt;br /&gt;\n"
                                         . "&lt;a href=\"##cartridge.url##\"&gt;\n"
                                         . "##cartridge.url##&lt;/a&gt;&lt;br /&gt;\n"
                                         . "##ENDFOREACHcartridges##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Infocoms'],
              'subject'                 => '##infocom.action##  ##infocom.entity##',
              'content_text'            => "##lang.infocom.entity## : ##infocom.entity##\n"
                                         . "\n"
                                         . "\n"
                                         . "##FOREACHinfocoms##\n"
                                         . "\n"
                                         . "##lang.infocom.itemtype## : ##infocom.itemtype##\n"
                                         . "\n"
                                         . "##lang.infocom.item## : ##infocom.item##\n"
                                         . "\n"
                                         . "\n"
                                         . "##lang.infocom.expirationdate## : ##infocom.expirationdate##\n"
                                         . "\n"
                                         . "##infocom.url##\n"
                                         . " ##ENDFOREACHinfocoms##",
              'content_html'            => "&lt;p&gt;##lang.infocom.entity## : ##infocom.entity##\n"
                                         . "&lt;br /&gt; &lt;br /&gt;##FOREACHinfocoms##\n"
                                         . "&lt;br /&gt;##lang.infocom.itemtype## : ##infocom.itemtype##&lt;br /&gt;\n"
                                         . "##lang.infocom.item## : ##infocom.item##&lt;br /&gt; &lt;br /&gt;\n"
                                         . "##lang.infocom.expirationdate## : ##infocom.expirationdate##\n"
                                         . "&lt;br /&gt; &lt;a href=\"##infocom.url##\"&gt;\n"
                                         . "##infocom.url##&lt;/a&gt;&lt;br /&gt;\n"
                                         . "##ENDFOREACHinfocoms##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Licenses'],
              'subject'                 => '##license.action##  ##license.entity##',
              'content_text'            => "##lang.license.entity## : ##license.entity##\n"
                                         . "\n"
                                         . "##FOREACHlicenses##\n"
                                         . "\n"
                                         . "##lang.license.item## : ##license.item##\n"
                                         . "\n"
                                         . "##lang.license.serial## : ##license.serial##\n"
                                         . "\n"
                                         . "##lang.license.expirationdate## : ##license.expirationdate##\n"
                                         . "\n"
                                         . "##license.url##\n"
                                         . " ##ENDFOREACHlicenses##",
              'content_html'            => "&lt;p&gt;\n"
                                         . "##lang.license.entity## : ##license.entity##&lt;br /&gt;\n"
                                         . "##FOREACHlicenses##\n"
                                         . "&lt;br /&gt;##lang.license.item## : ##license.item##&lt;br /&gt;\n"
                                         . "##lang.license.serial## : ##license.serial##&lt;br /&gt;\n"
                                         . "##lang.license.expirationdate## : ##license.expirationdate##\n"
                                         . "&lt;br /&gt; &lt;a href=\"##license.url##\"&gt; ##license.url##\n"
                                         . "&lt;/a&gt;&lt;br /&gt; ##ENDFOREACHlicenses##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Password Forget'],
              'subject'                 => '##user.action##',
              'content_text'            => "##user.realname## ##user.firstname##\n"
                                         . "\n"
                                         . "##lang.passwordforget.information##\n"
                                         . "\n"
                                         . "##lang.passwordforget.link## ##user.passwordforgeturl##",
              'content_html'            => "&lt;p&gt;&lt;strong&gt;##user.realname## ##user.firstname##&lt;/strong&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.passwordforget.information##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.passwordforget.link## &lt;a title=\"##user.passwordforgeturl##\" href=\"##user.passwordforgeturl##\"&gt;##user.passwordforgeturl##&lt;/a&gt;&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Ticket Satisfaction'],
              'subject'                 => '##ticket.action## ##ticket.title##',
              'content_text'            => "##lang.ticket.title## : ##ticket.title##\n"
                                         . "\n"
                                         . "##lang.ticket.closedate## : ##ticket.closedate##\n"
                                         . "\n"
                                         . "##lang.satisfaction.text## ##ticket.urlsatisfaction##",
              'content_html'            => "&lt;p&gt;##lang.ticket.title## : ##ticket.title##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.ticket.closedate## : ##ticket.closedate##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.satisfaction.text## &lt;a href=\"##ticket.urlsatisfaction##\"&gt;##ticket.urlsatisfaction##&lt;/a&gt;&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Crontask'],
              'subject'                 => '##crontask.action##',
              'content_text'            => "##lang.crontask.warning##\n"
                                         . "\n"
                                         . "##FOREACHcrontasks##\n"
                                         . " ##crontask.name## : ##crontask.description##\n"
                                         . "\n"
                                         . "##ENDFOREACHcrontasks##",
              'content_html'            => "&lt;p&gt;##lang.crontask.warning##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##FOREACHcrontasks## &lt;br /&gt;&lt;a href=\"##crontask.url##\"&gt;##crontask.name##&lt;/a&gt; : ##crontask.description##&lt;br /&gt; &lt;br /&gt;##ENDFOREACHcrontasks##&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Problems'],
              'subject'                 => '##problem.action## ##problem.title##',
              'content_text'            => "##IFproblem.storestatus=5##\n"
                                         . " ##lang.problem.url## : ##problem.urlapprove##\n"
                                         . " ##lang.problem.solvedate## : ##problem.solvedate##\n"
                                         . " ##lang.problem.solution.type## : ##problem.solution.type##\n"
                                         . " ##lang.problem.solution.description## : ##problem.solution.description## ##ENDIFproblem.storestatus##\n"
                                         . " ##ELSEproblem.storestatus## ##lang.problem.url## : ##problem.url## ##ENDELSEproblem.storestatus##\n"
                                         . "\n"
                                         . " ##lang.problem.description##\n"
                                         . "\n"
                                         . " ##lang.problem.title##  :##problem.title##\n"
                                         . " ##lang.problem.authors##  :##IFproblem.authors## ##problem.authors## ##ENDIFproblem.authors## ##ELSEproblem.authors##--##ENDELSEproblem.authors##\n"
                                         . " ##lang.problem.creationdate##  :##problem.creationdate##\n"
                                         . " ##IFproblem.assigntousers## ##lang.problem.assigntousers##  : ##problem.assigntousers## ##ENDIFproblem.assigntousers##\n"
                                         . " ##lang.problem.status##  : ##problem.status##\n"
                                         . " ##IFproblem.assigntogroups## ##lang.problem.assigntogroups##  : ##problem.assigntogroups## ##ENDIFproblem.assigntogroups##\n"
                                         . " ##lang.problem.urgency##  : ##problem.urgency##\n"
                                         . " ##lang.problem.impact##  : ##problem.impact##\n"
                                         . " ##lang.problem.priority## : ##problem.priority##\n"
                                         . "##IFproblem.category## ##lang.problem.category##  :##problem.category## ##ENDIFproblem.category## ##ELSEproblem.category## ##lang.problem.nocategoryassigned## ##ENDELSEproblem.category##\n"
                                         . " ##lang.problem.content##  : ##problem.content##\n"
                                         . "\n"
                                         . "##IFproblem.storestatus=6##\n"
                                         . " ##lang.problem.solvedate## : ##problem.solvedate##\n"
                                         . " ##lang.problem.solution.type## : ##problem.solution.type##\n"
                                         . " ##lang.problem.solution.description## : ##problem.solution.description##\n"
                                         . "##ENDIFproblem.storestatus##\n"
                                         . " ##lang.problem.numberoftickets## : ##problem.numberoftickets##\n"
                                         . "\n"
                                         . "##FOREACHtickets##\n"
                                         . " [##ticket.date##] ##lang.problem.title## : ##ticket.title##\n"
                                         . " ##lang.problem.content## ##ticket.content##\n"
                                         . "\n"
                                         . "##ENDFOREACHtickets##\n"
                                         . " ##lang.problem.numberoftasks## : ##problem.numberoftasks##\n"
                                         . "\n"
                                         . "##FOREACHtasks##\n"
                                         . " [##task.date##]\n"
                                         . " ##lang.task.author## ##task.author##\n"
                                         . " ##lang.task.description## ##task.description##\n"
                                         . " ##lang.task.time## ##task.time##\n"
                                         . " ##lang.task.category## ##task.category##\n"
                                         . "\n"
                                         . "##ENDFOREACHtasks##",
              'content_html'            => "&lt;p&gt;##IFproblem.storestatus=5##&lt;/p&gt;\n"
                                         . "&lt;div&gt;##lang.problem.url## : &lt;a href=\"##problem.urlapprove##\"&gt;##problem.urlapprove##&lt;/a&gt;&lt;/div&gt;\n"
                                         . "&lt;div&gt;&lt;span style=\"color: #888888;\"&gt;&lt;strong&gt;&lt;span style=\"text-decoration: underline;\"&gt;##lang.problem.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##problem.solvedate##&lt;br /&gt;&lt;span style=\"text-decoration: underline; color: #888888;\"&gt;&lt;strong&gt;##lang.problem.solution.type##&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.type##&lt;br /&gt;&lt;span style=\"text-decoration: underline; color: #888888;\"&gt;&lt;strong&gt;##lang.problem.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.description## ##ENDIFproblem.storestatus##&lt;/div&gt;\n"
                                         . "&lt;div&gt;##ELSEproblem.storestatus## ##lang.problem.url## : &lt;a href=\"##problem.url##\"&gt;##problem.url##&lt;/a&gt; ##ENDELSEproblem.storestatus##&lt;/div&gt;\n"
                                         . "&lt;p class=\"description b\"&gt;&lt;strong&gt;##lang.problem.description##&lt;/strong&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.title##&lt;/span&gt;&#160;:##problem.title## &lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.authors##&lt;/span&gt;&#160;:##IFproblem.authors## ##problem.authors## ##ENDIFproblem.authors##    ##ELSEproblem.authors##--##ENDELSEproblem.authors## &lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.creationdate##&lt;/span&gt;&#160;:##problem.creationdate## &lt;br /&gt; ##IFproblem.assigntousers## &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.assigntousers##&lt;/span&gt;&#160;: ##problem.assigntousers## ##ENDIFproblem.assigntousers##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.problem.status## &lt;/span&gt;&#160;: ##problem.status##&lt;br /&gt; ##IFproblem.assigntogroups## &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.assigntogroups##&lt;/span&gt;&#160;: ##problem.assigntogroups## ##ENDIFproblem.assigntogroups##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.urgency##&lt;/span&gt;&#160;: ##problem.urgency##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.impact##&lt;/span&gt;&#160;: ##problem.impact##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.priority##&lt;/span&gt; : ##problem.priority## &lt;br /&gt;##IFproblem.category##&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.problem.category## &lt;/span&gt;&#160;:##problem.category##  ##ENDIFproblem.category## ##ELSEproblem.category##  ##lang.problem.nocategoryassigned## ##ENDELSEproblem.category##    &lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.problem.content##&lt;/span&gt;&#160;: ##problem.content##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##IFproblem.storestatus=6##&lt;br /&gt;&lt;span style=\"text-decoration: underline;\"&gt;&lt;strong&gt;&lt;span style=\"color: #888888;\"&gt;##lang.problem.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##problem.solvedate##&lt;br /&gt;&lt;span style=\"color: #888888;\"&gt;&lt;strong&gt;&lt;span style=\"text-decoration: underline;\"&gt;##lang.problem.solution.type##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.type##&lt;br /&gt;&lt;span style=\"text-decoration: underline; color: #888888;\"&gt;&lt;strong&gt;##lang.problem.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.description##&lt;br /&gt;##ENDIFproblem.storestatus##&lt;/p&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;##lang.problem.numberoftickets##&#160;: ##problem.numberoftickets##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##FOREACHtickets##&lt;/p&gt;\n"
                                         . "&lt;div&gt;&lt;strong&gt; [##ticket.date##] &lt;em&gt;##lang.problem.title## : &lt;a href=\"##ticket.url##\"&gt;##ticket.title## &lt;/a&gt;&lt;/em&gt;&lt;/strong&gt;&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; &lt;/span&gt;&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.problem.content## &lt;/span&gt; ##ticket.content##\n"
                                         . "&lt;p&gt;##ENDFOREACHtickets##&lt;/p&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;##lang.problem.numberoftasks##&#160;: ##problem.numberoftasks##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##FOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;&lt;strong&gt;[##task.date##] &lt;/strong&gt;&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.author##&lt;/span&gt; ##task.author##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.description##&lt;/span&gt; ##task.description##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.time##&lt;/span&gt; ##task.time##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.category##&lt;/span&gt; ##task.category##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;/div&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Planning recall'],
              'subject'                 => '##recall.action##: ##recall.item.name##',
              'content_text'            => "##recall.action##: ##recall.item.name##\n"
                                         . "\n"
                                         . "##recall.item.content##\n"
                                         . "\n"
                                         . "##lang.recall.planning.begin##: ##recall.planning.begin##\n"
                                         . "##lang.recall.planning.end##: ##recall.planning.end##\n"
                                         . "##lang.recall.planning.state##: ##recall.planning.state##\n"
                                         . "##lang.recall.item.private##: ##recall.item.private##",
              'content_html'            => "&lt;p&gt;##recall.action##: &lt;a href=\"##recall.item.url##\"&gt;##recall.item.name##&lt;/a&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;##recall.item.content##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.recall.planning.begin##: ##recall.planning.begin##&lt;br /&gt;##lang.recall.planning.end##: ##recall.planning.end##&lt;br /&gt;##lang.recall.planning.state##: ##recall.planning.state##&lt;br /&gt;##lang.recall.item.private##: ##recall.item.private##&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Changes'],
              'subject'                 => '##change.action## ##change.title##',
              'content_text'            => "##IFchange.storestatus=5##\n"
                                         . " ##lang.change.url## : ##change.urlapprove##\n"
                                         . " ##lang.change.solvedate## : ##change.solvedate##\n"
                                         . " ##lang.change.solution.type## : ##change.solution.type##\n"
                                         . " ##lang.change.solution.description## : ##change.solution.description## ##ENDIFchange.storestatus##\n"
                                         . " ##ELSEchange.storestatus## ##lang.change.url## : ##change.url## ##ENDELSEchange.storestatus##\n"
                                         . "\n"
                                         . " ##lang.change.description##\n"
                                         . "\n"
                                         . " ##lang.change.title##  :##change.title##\n"
                                         . " ##lang.change.authors##  :##IFchange.authors## ##change.authors## ##ENDIFchange.authors## ##ELSEchange.authors##--##ENDELSEchange.authors##\n"
                                         . " ##lang.change.creationdate##  :##change.creationdate##\n"
                                         . " ##IFchange.assigntousers## ##lang.change.assigntousers##  : ##change.assigntousers## ##ENDIFchange.assigntousers##\n"
                                         . " ##lang.change.status##  : ##change.status##\n"
                                         . " ##IFchange.assigntogroups## ##lang.change.assigntogroups##  : ##change.assigntogroups## ##ENDIFchange.assigntogroups##\n"
                                         . " ##lang.change.urgency##  : ##change.urgency##\n"
                                         . " ##lang.change.impact##  : ##change.impact##\n"
                                         . " ##lang.change.priority## : ##change.priority##\n"
                                         . "##IFchange.category## ##lang.change.category##  :##change.category## ##ENDIFchange.category## ##ELSEchange.category## ##lang.change.nocategoryassigned## ##ENDELSEchange.category##\n"
                                         . " ##lang.change.content##  : ##change.content##\n"
                                         . "\n"
                                         . "##IFchange.storestatus=6##\n"
                                         . " ##lang.change.solvedate## : ##change.solvedate##\n"
                                         . " ##lang.change.solution.type## : ##change.solution.type##\n"
                                         . " ##lang.change.solution.description## : ##change.solution.description##\n"
                                         . "##ENDIFchange.storestatus##\n"
                                         . " ##lang.change.numberofproblems## : ##change.numberofproblems##\n"
                                         . "\n"
                                         . "##FOREACHproblems##\n"
                                         . " [##problem.date##] ##lang.change.title## : ##problem.title##\n"
                                         . " ##lang.change.content## ##problem.content##\n"
                                         . "\n"
                                         . "##ENDFOREACHproblems##\n"
                                         . " ##lang.change.numberoftasks## : ##change.numberoftasks##\n"
                                         . "\n"
                                         . "##FOREACHtasks##\n"
                                         . " [##task.date##]\n"
                                         . " ##lang.task.author## ##task.author##\n"
                                         . " ##lang.task.description## ##task.description##\n"
                                         . " ##lang.task.time## ##task.time##\n"
                                         . " ##lang.task.category## ##task.category##\n"
                                         . "\n"
                                         . "##ENDFOREACHtasks##",
              'content_html'            => "&lt;p&gt;##IFchange.storestatus=5##&lt;/p&gt;\n"
                                         . "&lt;div&gt;##lang.change.url## : &lt;a href=\"##change.urlapprove##\"&gt;##change.urlapprove##&lt;/a&gt;&lt;/div&gt;\n"
                                         . "&lt;div&gt;&lt;span style=\"color: #888888;\"&gt;&lt;strong&gt;&lt;span style=\"text-decoration: underline;\"&gt;##lang.change.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##change.solvedate##&lt;br /&gt;&lt;span style=\"text-decoration: underline; color: #888888;\"&gt;&lt;strong&gt;##lang.change.solution.type##&lt;/strong&gt;&lt;/span&gt; : ##change.solution.type##&lt;br /&gt;&lt;span style=\"text-decoration: underline; color: #888888;\"&gt;&lt;strong&gt;##lang.change.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##change.solution.description## ##ENDIFchange.storestatus##&lt;/div&gt;\n"
                                         . "&lt;div&gt;##ELSEchange.storestatus## ##lang.change.url## : &lt;a href=\"##change.url##\"&gt;##change.url##&lt;/a&gt; ##ENDELSEchange.storestatus##&lt;/div&gt;\n"
                                         . "&lt;p class=\"description b\"&gt;&lt;strong&gt;##lang.change.description##&lt;/strong&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.title##&lt;/span&gt;&#160;:##change.title## &lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.authors##&lt;/span&gt;&#160;:##IFchange.authors## ##change.authors## ##ENDIFchange.authors##    ##ELSEchange.authors##--##ENDELSEchange.authors## &lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.creationdate##&lt;/span&gt;&#160;:##change.creationdate## &lt;br /&gt; ##IFchange.assigntousers## &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.assigntousers##&lt;/span&gt;&#160;: ##change.assigntousers## ##ENDIFchange.assigntousers##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.change.status## &lt;/span&gt;&#160;: ##change.status##&lt;br /&gt; ##IFchange.assigntogroups## &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.assigntogroups##&lt;/span&gt;&#160;: ##change.assigntogroups## ##ENDIFchange.assigntogroups##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.urgency##&lt;/span&gt;&#160;: ##change.urgency##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.impact##&lt;/span&gt;&#160;: ##change.impact##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.priority##&lt;/span&gt; : ##change.priority## &lt;br /&gt;##IFchange.category##&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.change.category## &lt;/span&gt;&#160;:##change.category##  ##ENDIFchange.category## ##ELSEchange.category##  ##lang.change.nocategoryassigned## ##ENDELSEchange.category##    &lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.change.content##&lt;/span&gt;&#160;: ##change.content##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##IFchange.storestatus=6##&lt;br /&gt;&lt;span style=\"text-decoration: underline;\"&gt;&lt;strong&gt;&lt;span style=\"color: #888888;\"&gt;##lang.change.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##change.solvedate##&lt;br /&gt;&lt;span style=\"color: #888888;\"&gt;&lt;strong&gt;&lt;span style=\"text-decoration: underline;\"&gt;##lang.change.solution.type##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##change.solution.type##&lt;br /&gt;&lt;span style=\"text-decoration: underline; color: #888888;\"&gt;&lt;strong&gt;##lang.change.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##change.solution.description##&lt;br /&gt;##ENDIFchange.storestatus##&lt;/p&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;##lang.change.numberofproblems##&#160;: ##change.numberofproblems##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##FOREACHproblems##&lt;/p&gt;\n"
                                         . "&lt;div&gt;&lt;strong&gt; [##problem.date##] &lt;em&gt;##lang.change.title## : &lt;a href=\"##problem.url##\"&gt;##problem.title## &lt;/a&gt;&lt;/em&gt;&lt;/strong&gt;&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; &lt;/span&gt;&lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt;##lang.change.content## &lt;/span&gt; ##problem.content##\n"
                                         . "&lt;p&gt;##ENDFOREACHproblems##&lt;/p&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;##lang.change.numberoftasks##&#160;: ##change.numberoftasks##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##FOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;div class=\"description b\"&gt;&lt;strong&gt;[##task.date##] &lt;/strong&gt;&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.author##&lt;/span&gt; ##task.author##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.description##&lt;/span&gt; ##task.description##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.time##&lt;/span&gt; ##task.time##&lt;br /&gt; &lt;span style=\"color: #8b8c8f; font-weight: bold; text-decoration: underline;\"&gt; ##lang.task.category##&lt;/span&gt; ##task.category##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;/div&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Receiver errors'],
              'subject'                 => '##mailcollector.action##',
              'content_text'            => "##FOREACHmailcollectors##\n"
                                         . "##lang.mailcollector.name## : ##mailcollector.name##\n"
                                         . "##lang.mailcollector.errors## : ##mailcollector.errors##\n"
                                         . "##mailcollector.url##\n"
                                         . "##ENDFOREACHmailcollectors##",
              'content_html'            => "&lt;p&gt;##FOREACHmailcollectors##&lt;br /&gt;##lang.mailcollector.name## : ##mailcollector.name##&lt;br /&gt; ##lang.mailcollector.errors## : ##mailcollector.errors##&lt;br /&gt;&lt;a href=\"##mailcollector.url##\"&gt;##mailcollector.url##&lt;/a&gt;&lt;br /&gt; ##ENDFOREACHmailcollectors##&lt;/p&gt;\n"
                                         . "&lt;p&gt;&lt;/p&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Projects'],
              'subject'                 => '##project.action## ##project.name## ##project.code##',
              'content_text'            => "##lang.project.url## : ##project.url##\n"
                                         . "\n"
                                         . "##lang.project.description##\n"
                                         . "\n"
                                         . "##lang.project.name## : ##project.name##\n"
                                         . "##lang.project.code## : ##project.code##\n"
                                         . "##lang.project.manager## : ##project.manager##\n"
                                         . "##lang.project.managergroup## : ##project.managergroup##\n"
                                         . "##lang.project.creationdate## : ##project.creationdate##\n"
                                         . "##lang.project.priority## : ##project.priority##\n"
                                         . "##lang.project.state## : ##project.state##\n"
                                         . "##lang.project.type## : ##project.type##\n"
                                         . "##lang.project.description## : ##project.description##\n"
                                         . "\n"
                                         . "##lang.project.numberoftasks## : ##project.numberoftasks##\n"
                                         . "\n"
                                         . "\n"
                                         . "\n"
                                         . "##FOREACHtasks##\n"
                                         . "\n"
                                         . "[##task.creationdate##]\n"
                                         . "##lang.task.name## : ##task.name##\n"
                                         . "##lang.task.state## : ##task.state##\n"
                                         . "##lang.task.type## : ##task.type##\n"
                                         . "##lang.task.percent## : ##task.percent##\n"
                                         . "##lang.task.description## : ##task.description##\n"
                                         . "\n"
                                         . "##ENDFOREACHtasks##",
              'content_html'            => "&lt;p&gt;##lang.project.url## : &lt;a href=\"##project.url##\"&gt;##project.url##&lt;/a&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;&lt;strong&gt;##lang.project.description##&lt;/strong&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.project.name## : ##project.name##&lt;br /&gt;##lang.project.code## : ##project.code##&lt;br /&gt; ##lang.project.manager## : ##project.manager##&lt;br /&gt;##lang.project.managergroup## : ##project.managergroup##&lt;br /&gt; ##lang.project.creationdate## : ##project.creationdate##&lt;br /&gt;##lang.project.priority## : ##project.priority## &lt;br /&gt;##lang.project.state## : ##project.state##&lt;br /&gt;##lang.project.type## : ##project.type##&lt;br /&gt;##lang.project.description## : ##project.description##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.project.numberoftasks## : ##project.numberoftasks##&lt;/p&gt;\n"
                                         . "&lt;div&gt;\n"
                                         . "&lt;p&gt;##FOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;div&gt;&lt;strong&gt;[##task.creationdate##] &lt;/strong&gt;&lt;br /&gt; ##lang.task.name## : ##task.name##&lt;br /&gt;##lang.task.state## : ##task.state##&lt;br /&gt;##lang.task.type## : ##task.type##&lt;br /&gt;##lang.task.percent## : ##task.percent##&lt;br /&gt;##lang.task.description## : ##task.description##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;/div&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Project Tasks'],
              'subject'                 => '##projecttask.action## ##projecttask.name##',
              'content_text'            => "##lang.projecttask.url## : ##projecttask.url##\n"
                                         . "\n"
                                         . "##lang.projecttask.description##\n"
                                         . "\n"
                                         . "##lang.projecttask.name## : ##projecttask.name##\n"
                                         . "##lang.projecttask.project## : ##projecttask.project##\n"
                                         . "##lang.projecttask.creationdate## : ##projecttask.creationdate##\n"
                                         . "##lang.projecttask.state## : ##projecttask.state##\n"
                                         . "##lang.projecttask.type## : ##projecttask.type##\n"
                                         . "##lang.projecttask.description## : ##projecttask.description##\n"
                                         . "\n"
                                         . "##lang.projecttask.numberoftasks## : ##projecttask.numberoftasks##\n"
                                         . "\n"
                                         . "\n"
                                         . "\n"
                                         . "##FOREACHtasks##\n"
                                         . "\n"
                                         . "[##task.creationdate##]\n"
                                         . "##lang.task.name## : ##task.name##\n"
                                         . "##lang.task.state## : ##task.state##\n"
                                         . "##lang.task.type## : ##task.type##\n"
                                         . "##lang.task.percent## : ##task.percent##\n"
                                         . "##lang.task.description## : ##task.description##\n"
                                         . "\n"
                                         . "##ENDFOREACHtasks##",
              'content_html'            => "&lt;p&gt;##lang.projecttask.url## : &lt;a href=\"##projecttask.url##\"&gt;##projecttask.url##&lt;/a&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;&lt;strong&gt;##lang.projecttask.description##&lt;/strong&gt;&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.projecttask.name## : ##projecttask.name##&lt;br /&gt;##lang.projecttask.project## : &lt;a href=\"##projecttask.projecturl##\"&gt;##projecttask.project##&lt;/a&gt;&lt;br /&gt;##lang.projecttask.creationdate## : ##projecttask.creationdate##&lt;br /&gt;##lang.projecttask.state## : ##projecttask.state##&lt;br /&gt;##lang.projecttask.type## : ##projecttask.type##&lt;br /&gt;##lang.projecttask.description## : ##projecttask.description##&lt;/p&gt;\n"
                                         . "&lt;p&gt;##lang.projecttask.numberoftasks## : ##projecttask.numberoftasks##&lt;/p&gt;\n"
                                         . "&lt;div&gt;\n"
                                         . "&lt;p&gt;##FOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;div&gt;&lt;strong&gt;[##task.creationdate##] &lt;/strong&gt;&lt;br /&gt;##lang.task.name## : ##task.name##&lt;br /&gt;##lang.task.state## : ##task.state##&lt;br /&gt;##lang.task.type## : ##task.type##&lt;br /&gt;##lang.task.percent## : ##task.percent##&lt;br /&gt;##lang.task.description## : ##task.description##&lt;/div&gt;\n"
                                         . "&lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;\n"
                                         . "&lt;/div&gt;",
          ),
          array(
              'notificationtemplate_id' => $notiftemplates['Unlock Item request'],
              'subject'                 => '##objectlock.action##',
              'content_text'            => "##objectlock.type## ###objectlock.id## - ##objectlock.name##\n"
                                         . "\n"
                                         . "      ##lang.objectlock.url##\n"
                                         . "      ##objectlock.url##\n"
                                         . "\n"
                                         . "      ##lang.objectlock.date_mod##\n"
                                         . "      ##objectlock.date_mod##\n"
                                         . "\n"
                                         . "      Hello ##objectlock.lockedby.firstname##,\n"
                                         . "      Could go to this item and unlock it for me?\n"
                                         . "      Thank you,\n"
                                         . "      Regards,\n"
                                         . "      ##objectlock.requester.firstname##",
              'content_html'            => "&lt;table&gt;\n"
                                         . "      &lt;tbody&gt;\n"
                                         . "      &lt;tr&gt;&lt;th colspan=\"2\"&gt;&lt;a href=\"##objectlock.url##\"&gt;##objectlock.type## ###objectlock.id## - ##objectlock.name##&lt;/a&gt;&lt;/th&gt;&lt;/tr&gt;\n"
                                         . "      &lt;tr&gt;\n"
                                         . "      &lt;td&gt;##lang.objectlock.url##&lt;/td&gt;\n"
                                         . "      &lt;td&gt;##objectlock.url##&lt;/td&gt;\n"
                                         . "      &lt;/tr&gt;\n"
                                         . "      &lt;tr&gt;\n"
                                         . "      &lt;td&gt;##lang.objectlock.date_mod##&lt;/td&gt;\n"
                                         . "      &lt;td&gt;##objectlock.date_mod##&lt;/td&gt;\n"
                                         . "      &lt;/tr&gt;\n"
                                         . "      &lt;/tbody&gt;\n"
                                         . "      &lt;/table&gt;\n"
                                         . "      &lt;p&gt;&lt;span style=\"font-size: small;\"&gt;Hello ##objectlock.lockedby.firstname##,&lt;br /&gt;Could go to this item and unlock it for me?&lt;br /&gt;Thank you,&lt;br /&gt;Regards,&lt;br /&gt;##objectlock.requester.firstname## ##objectlock.requester.lastname##&lt;/span&gt;&lt;/p&gt;",
          ),
      );
      $this->insert('glpi_notificationtemplatetranslation', $rows);


      // Insert into table glpi_profile
      $rows = array(
          array(
              'name'                   => 'Self-Service',
              'is_default'             => true,
              'helpdesk_hardware'      => 1,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '{\"1\":{\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0},\"2\":{\"1\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0},\"3\":{\"1\":0,\"2\":0,\"4\":0,\"5\":0,\"6\":0},\"4\":{\"1\":0,\"2\":0,\"3\":0,\"5\":0,\"6\":0},\"5\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"6\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0}}',
              'problem_status'         => '[]',
          ),
          array(
              'name'                   => 'Observer',
              'interface'              => 'central',
              'helpdesk_hardware'      => 1,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '[]',
              'problem_status'         => '[]',
          ),
          array(
              'name'                   => 'Admin',
              'interface'              => 'central',
              'helpdesk_hardware'      => 3,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '[]',
              'problem_status'         => '[]',
          ),
          array(
              'name'                   => 'Super-Admin',
              'interface'              => 'central',
              'helpdesk_hardware'      => 3,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '[]',
              'problem_status'         => '[]',
          ),
          array(
              'name'                   => 'Hotliner',
              'interface'              => 'central',
              'helpdesk_hardware'      => 3,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '[]',
              'problem_status'         => '[]',
              'create_ticket_on_login' => true,
          ),
          array(
              'name'                   => 'Technician',
              'interface'              => 'central',
              'helpdesk_hardware'      => 3,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '[]',
              'problem_status'         => '[]',
          ),
          array(
              'name'                   => 'Supervisor',
              'interface'              => 'central',
              'helpdesk_hardware'      => 3,
              'helpdesk_item_type'     => '[\"Computer\",\"Monitor\",\"NetworkEquipment\",\"Peripheral\",\"Phone\",\"Printer\",\"Software\"]',
              'ticket_status'          => '[]',
              'problem_status'         => '[]',
          ),
          array(
              'name'                   => 'Read-Only',
              'interface'              => 'central',
              'helpdesk_item_type'     => '[]',
              'ticket_status'          => '{\"1\":{\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0},'
                                        . '\"2\":{\"1\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0},'
                                        . '\"3\":{\"1\":0,\"2\":0,\"4\":0,\"5\":0,\"6\":0},'
                                        . '\"4\":{\"1\":0,\"2\":0,\"3\":0,\"5\":0,\"6\":0},'
                                        . '\"5\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"6\":0},'
                                        . '\"6\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0}}',
              'comment'                => 'This profile defines read-only access. It is used when objects are locked. It can also be used to give to users rights to unlock objects.',
              'problem_status'         => '{\"1\":{\"7\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"7\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"2\":{\"1\":0,\"7\":0,\"3\":0,\"4\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"3\":{\"1\":0,\"7\":0,\"2\":0,\"4\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"4\":{\"1\":0,\"7\":0,\"2\":0,\"3\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"5\":{\"1\":0,\"7\":0,\"2\":0,\"3\":0,\"4\":0,\"8\":0,\"6\":0},'
                                        . '\"8\":{\"1\":0,\"7\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0},'
                                        . '\"6\":{\"1\":0,\"7\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"8\":0}}',
              'change_status'          => '{\"1\":{\"9\":0,\"10\":0,\"7\":0,\"4\":0,\"11\":0,\"12\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"9\":{\"1\":0,\"10\":0,\"7\":0,\"4\":0,\"11\":0,\"12\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"10\":{\"1\":0,\"9\":0,\"7\":0,\"4\":0,\"11\":0,\"12\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"7\":{\"1\":0,\"9\":0,\"10\":0,\"4\":0,\"11\":0,\"12\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"4\":{\"1\":0,\"9\":0,\"10\":0,\"7\":0,\"11\":0,\"12\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"11\":{\"1\":0,\"9\":0,\"10\":0,\"7\":0,\"4\":0,\"12\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"12\":{\"1\":0,\"9\":0,\"10\":0,\"7\":0,\"4\":0,\"11\":0,\"5\":0,\"8\":0,\"6\":0},'
                                        . '\"5\":{\"1\":0,\"9\":0,\"10\":0,\"7\":0,\"4\":0,\"11\":0,\"12\":0,\"8\":0,\"6\":0},'
                                        . '\"8\":{\"1\":0,\"9\":0,\"10\":0,\"7\":0,\"4\":0,\"11\":0,\"12\":0,\"5\":0,\"6\":0},'
                                        . '\"6\":{\"1\":0,\"9\":0,\"10\":0,\"7\":0,\"4\":0,\"11\":0,\"12\":0,\"5\":0,\"8\":0}}',
          ),
      );
      $this->insert('glpi_profile', $rows);
      $profs = $this->fetchAll('SELECT * FROM glpi_profile');
      $profiles = array();
      foreach ($profs as $data) {
         $profiles[$data['name']] = $data['id'];
      }


      // Insert into table glpi_profileright
      $rows = array(
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'computer',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'monitor',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'software',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'networking',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'internet',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'printer',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'peripheral',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'cartridge',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'consumable',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'phone',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'contact_enterprise',
         ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'document',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'contract',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'infocom',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'knowbase',
              'rights'     => 2048,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'reservation',
              'rights'     => 1024,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'reports',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'dropdown',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'device',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'typedoc',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'link',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'config',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_ticket',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_import',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_ldap',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_softwarecategories',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'search_config',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'profile',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'user',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'group',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'entity',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'transfer',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'logs',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'reminder_public',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rssfeed_public',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'bookmark_public',
              'rights'     => 0,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'backup',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'ticket',
              'rights'     => 131077,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'followup',
              'rights'     => 5,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'task',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'planning',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'statistic',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'show_group_hardware',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_dictionnary_software',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_dictionnary_dropdown',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'budget',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'notification',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_mailcollector',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'calendar',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'sla',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'rule_dictionnary_printer',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'problem',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'tickettemplate',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'ticketrecurrent',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'ticketcost',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'ticketvalidation',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'state',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'taskcategory',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'netpoint',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'projecttask',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'knowbasecategory',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'changevalidation',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'location',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'itilcategory',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'project',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'queuedmail',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'domain',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'change',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'license',
          ),
          array(
              'profile_id' => $profiles['Self-Service'],
              'name'       => 'solutiontemplate',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'state',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'taskcategory',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'netpoint',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'computer',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'monitor',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'software',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'networking',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'internet',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'printer',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'peripheral',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'cartridge',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'consumable',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'phone',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'contact_enterprise',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'document',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'contract',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'infocom',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'knowbase',
              'rights'     => 2049,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'reservation',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'reports',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'dropdown',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'device',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'typedoc',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'link',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'config',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_ticket',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_import',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_ldap',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_softwarecategories',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'search_config',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'profile',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'user',
              'rights'     => 2049,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'group',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'entity',
              'rights'     => 32,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'transfer',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'logs',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'reminder_public',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rssfeed_public',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'bookmark_public',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'backup',
              'rights'     => 1024,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'ticket',
              'rights'     => 168989,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'followup',
              'rights'     => 5,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'task',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'planning',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'show_group_hardware',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_dictionnary_software',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_dictionnary_dropdown',
              'rights'     => 0,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'budget',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'notification',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_mailcollector',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'calendar',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'sla',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'rule_dictionnary_printer',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'problem',
              'rights'     => 1057,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'tickettemplate',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'ticketrecurrent',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'ticketcost',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'ticketvalidation',
              'rights'     => 15384,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'knowbasecategory',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'changevalidation',
              'rights'     => 1044,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'location',
              'rights'     => 0,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'projecttask',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'solutiontemplate',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'itilcategory',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'queuedmail',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'domain',
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'project',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'change',
              'rights'     => 1057,
          ),
          array(
              'profile_id' => $profiles['Observer'],
              'name'       => 'license',
              'rights'     => 33,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'knowbasecategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'computer',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'monitor',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'software',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'networking',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'internet',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'printer',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'peripheral',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'cartridge',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'consumable',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'phone',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'contact_enterprise',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'document',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'contract',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'infocom',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'knowbase',
              'rights'     => 6175,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'reservation',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'reports',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'dropdown',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'device',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'typedoc',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'link',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'config',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_ticket',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_import',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_ldap',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_softwarecategories',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'search_config',
              'rights'     => 3103,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'location',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'profile',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'user',
              'rights'     => 7199,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'group',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'entity',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'transfer',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'logs',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'reminder_public',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rssfeed_public',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'bookmark_public',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'backup',
              'rights'     => 1024,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'ticket',
              'rights'     => 259103,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'followup',
              'rights'     => 15383,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'task',
              'rights'     => 13329,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'projecttask',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'planning',
              'rights'     => 3073,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'show_group_hardware',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_dictionnary_software',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_dictionnary_dropdown',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'budget',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'notification',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_mailcollector',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'solutiontemplate',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'calendar',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'sla',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'rule_dictionnary_printer',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'problem',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'itilcategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'tickettemplate',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'ticketrecurrent',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'ticketcost',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'changevalidation',
              'rights'     => 1044,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'ticketvalidation',
              'rights'     => 15384,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'queuedmail',
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'domain',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'project',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'change',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'taskcategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'netpoint',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'state',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Admin'],
              'name'       => 'license',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'solutiontemplate',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'knowbasecategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'projecttask',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'location',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'itilcategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'changevalidation',
              'rights'     => 1044,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'queuedmail',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'computer',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'monitor',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'software',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'networking',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'internet',
              'rights'     => 159,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'printer',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'peripheral',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'cartridge',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'consumable',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'phone',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'contact_enterprise',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'document',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'contract',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'infocom',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'knowbase',
              'rights'     => 7327,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'reservation',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'reports',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'dropdown',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'device',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'typedoc',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'link',
              'rights'     => 159,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'config',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_ticket',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_import',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_ldap',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_softwarecategories',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'search_config',
              'rights'     => 3103,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'domain',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'profile',
              'rights'     => 159,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'user',
              'rights'     => 7327,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'group',
              'rights'     => 159,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'entity',
              'rights'     => 3327,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'transfer',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'logs',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'reminder_public',
              'rights'     => 159,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rssfeed_public',
              'rights'     => 159,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'bookmark_public',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'backup',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'ticket',
              'rights'     => 259231,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'followup',
              'rights'     => 15383,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'task',
              'rights'     => 13329,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'planning',
              'rights'     => 3073,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'show_group_hardware',
              'rights'     => 0,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_dictionnary_software',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_dictionnary_dropdown',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'budget',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'notification',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_mailcollector',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'calendar',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'sla',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'rule_dictionnary_printer',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'problem',
              'rights'     => 1279,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'tickettemplate',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'ticketrecurrent',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'ticketcost',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'ticketvalidation',
              'rights'     => 15384,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'project',
              'rights'     => 1279,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'taskcategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'netpoint',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'state',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'change',
              'rights'     => 1279,
          ),
          array(
              'profile_id' => $profiles['Super-Admin'],
              'name'       => 'license',
              'rights'     => 255,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'projecttask',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'itilcategory',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'location',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'queuedmail',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'solutiontemplate',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'changevalidation',
              'rights'     => 20,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'domain',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'computer',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'monitor',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'software',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'networking',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'internet',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'printer',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'peripheral',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'cartridge',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'consumable',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'phone',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'contact_enterprise',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'document',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'contract',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'infocom',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'knowbase',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'reservation',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'reports',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'dropdown',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'device',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'typedoc',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'link',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'config',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_ticket',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_import',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_ldap',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_softwarecategories',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'search_config',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'profile',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'user',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'group',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'entity',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'transfer',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'logs',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'reminder_public',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rssfeed_public',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'bookmark_public',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'backup',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'ticket',
              'rights'     => 140295,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'followup',
              'rights'     => 12295,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'task',
              'rights'     => 8193,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'project',
              'rights'     => 1150,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'planning',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'taskcategory',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'netpoint',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'show_group_hardware',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_dictionnary_software',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_dictionnary_dropdown',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'budget',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'notification',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_mailcollector',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'calendar',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'sla',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'rule_dictionnary_printer',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'problem',
              'rights'     => 1024,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'tickettemplate',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'ticketrecurrent',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'ticketcost',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'change',
              'rights'     => 1054,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'ticketvalidation',
              'rights'     => 3088,
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'state',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'knowbasecategory',
          ),
          array(
              'profile_id' => $profiles['Hotliner'],
              'name'       => 'license',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'changevalidation',
              'rights'     => 20,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'domain',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'projecttask',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'solutiontemplate',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'taskcategory',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'netpoint',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'project',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'state',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'change',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'computer',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'monitor',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'software',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'networking',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'internet',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'printer',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'peripheral',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'cartridge',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'consumable',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'phone',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'contact_enterprise',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'document',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'contract',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'infocom',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'knowbase',
              'rights'     => 6175,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'reservation',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'reports',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'dropdown',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'device',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'typedoc',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'link',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'config',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_ticket',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_import',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_ldap',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_softwarecategories',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'search_config',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'profile',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'user',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'group',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'entity',
              'rights'     => 97,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'transfer',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'logs',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'reminder_public',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rssfeed_public',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'bookmark_public',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'backup',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'ticket',
              'rights'     => 168967,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'followup',
              'rights'     => 13319,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'task',
              'rights'     => 13329,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'planning',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'show_group_hardware',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_dictionnary_software',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_dictionnary_dropdown',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'budget',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'notification',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_mailcollector',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'calendar',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'sla',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'rule_dictionnary_printer',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'problem',
              'rights'     => 1121,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'knowbasecategory',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'tickettemplate',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'ticketrecurrent',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'ticketcost',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'ticketvalidation',
              'rights'     => 3088,
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'queuedmail',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'itilcategory',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'location',
          ),
          array(
              'profile_id' => $profiles['Technician'],
              'name'       => 'license',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'domain',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'solutiontemplate',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'projecttask',
              'rights'     => 1025,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'taskcategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'netpoint',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'project',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'change',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'state',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'knowbasecategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'itilcategory',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'location',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'computer',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'monitor',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'software',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'networking',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'internet',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'printer',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'peripheral',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'cartridge',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'consumable',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'phone',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'contact_enterprise',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'document',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'contract',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'infocom',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'knowbase',
              'rights'     => 6175,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'reservation',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'reports',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'dropdown',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'device',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'typedoc',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'link',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'config',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_ticket',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_import',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_ldap',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_softwarecategories',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'search_config',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'profile',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'user',
              'rights'     => 1055,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'group',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'entity',
              'rights'     => 97,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'transfer',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'logs',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'reminder_public',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rssfeed_public',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'bookmark_public',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'backup',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'ticket',
              'rights'     => 259103,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'followup',
              'rights'     => 13335,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'task',
              'rights'     => 13329,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'queuedmail',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'planning',
              'rights'     => 2049,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'password_update',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'show_group_hardware',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_dictionnary_software',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_dictionnary_dropdown',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'budget',
              'rights'     => 96,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'notification',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_mailcollector',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'changevalidation',
              'rights'     => 1044,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'calendar',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'sla',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'rule_dictionnary_printer',
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'problem',
              'rights'     => 1151,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'tickettemplate',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'ticketrecurrent',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'ticketcost',
              'rights'     => 31,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'ticketvalidation',
              'rights'     => 15384,
          ),
          array(
              'profile_id' => $profiles['Supervisor'],
              'name'       => 'license',
              'rights'     => 127,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'backup',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'bookmark_public',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'budget',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'calendar',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'cartridge',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'change',
              'rights'     => 1185,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'changevalidation',
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'computer',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'config',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'consumable',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'contact_enterprise',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'contract',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'device',
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'document',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'domain',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'dropdown',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'entity',
              'rights'     => 1185,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'followup',
              'rights'     => 8193,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'global_validation',
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'group',
              'rights'     => 129,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'infocom',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'internet',
              'rights'     => 129,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'itilcategory',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'knowbase',
              'rights'     => 2177,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'knowbasecategory',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'link',
              'rights'     => 129,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'location',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'logs',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'monitor',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'netpoint',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'networking',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'notification',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'password_update',
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'peripheral',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'phone',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'planning',
              'rights'     => 3073,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'printer',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'problem',
              'rights'     => 1185,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'profile',
              'rights'     => 129,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'project',
              'rights'     => 1185,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'projecttask',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'queuedmail',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'reminder_public',
              'rights'     => 129,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'reports',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'reservation',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rssfeed_public',
              'rights'     => 129,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_dictionnary_dropdown',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_dictionnary_printer',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_dictionnary_software',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_import',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_ldap',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_mailcollector',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_softwarecategories',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'rule_ticket',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'search_config',
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'show_group_hardware',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'sla',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'software',
              'rights'     => 161,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'solutiontemplate',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'state',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'statistic',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'task',
              'rights'     => 8193,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'taskcategory',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'ticket',
              'rights'     => 138369,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'ticketcost',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'ticketrecurrent',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'tickettemplate',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'ticketvalidation',
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'transfer',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'typedoc',
              'rights'     => 1,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'user',
              'rights'     => 2177,
          ),
          array(
              'profile_id' => $profiles['Read-Only'],
              'name'       => 'license',
              'rights'     => 161,
          ),
      );
      $this->insert('glpi_profileright', $rows);


      // Insert into table glpi_user
      $rows = array(
          array(
              'name'       => 'glpi',
              'password'   => '0915bd0a5c6e56d8f38ca2b390857d4949073f41',
              'list_limit' => 20,
              'is_active'  => true,
              'authtype'   => 1,
              'entity_id'  => $entity_id,
          ),
          array(
              'name'       => 'post-only',
              'password'   => '3177926a7314de24680a9938aaa97703',
              'language'   => 'en_GB',
              'list_limit' => 20,
              'entity_id'  => $entity_id,
          ),
          array(
              'name'       => 'tech',
              'password'   => 'd9f9133fb120cd6096870bc2b496805b',
              'language'   => 'en_GB',
              'list_limit' => 20,
              'entity_id'  => $entity_id,
          ),
          array(
              'name'       => 'normal',
              'password'   => 'fea087517c26fadd409bd4b9dc642555',
              'language'   => 'en_GB',
              'list_limit' => 20,
              'entity_id'  => $entity_id,
          ),
      );
      $this->insert('glpi_user', $rows);
      $dbusers = $this->fetchAll('SELECT * FROM glpi_user');
      $users = array();
      foreach ($dbusers as $data) {
         $users[$data['name']] = $data['id'];
      }



      // Insert into table glpi_profile_user
      $rows = array(
          array(
              'user_id'    => $users['glpi'],
              'profile_id' => $profiles['Super-Admin'],
              'entity_id'  => $entity_id,
          ),
          array(
              'user_id'    => $users['post-only'],
              'profile_id' => $profiles['Self-Service'],
              'entity_id'  => $entity_id,
          ),
          array(
              'user_id'    => $users['tech'],
              'profile_id' => $profiles['Technician'],
              'entity_id'  => $entity_id,
          ),
          array(
              'user_id'    => $users['normal'],
              'profile_id' => $profiles['Observer'],
              'entity_id'  => $entity_id,
          ),
      );
      $this->insert('glpi_profile_user', $rows);



      // Insert into table glpi_projectstate
      $rows = array(
          array(
              'name'  => 'New',
              'color' => '#06ff00',
          ),
          array(
              'name'  => 'Processing',
              'color' => '#ffb800',
          ),
          array(
              'name'        => 'Closed',
              'color'       => '#ff0000',
              'is_finished' => true
          ),
      );
      $this->insert('glpi_projectstate', $rows);



      // Insert into table glpi_requesttype
      $rows = array(
          array(
              'name' => 'Helpdesk',
              'is_helpdesk_default' => true,
              'is_followup_default' => true,
          ),
          array(
              'name' => 'E-Mail',
              'is_mail_default' => true,
              'is_mailfollowup_default' => true,
          ),
          array(
              'name' => 'Phone',
          ),
          array(
              'name' => 'Direct',
          ),
          array(
              'name' => 'Written',
          ),
          array(
              'name' => 'Other',
          ),
      );
      $this->insert('glpi_requesttype', $rows);



      // Insert into table glpi_rule
      $rows = array(
          array(
              'entity_id'   => $entity_id,
              'sub_type'    => 'RuleRight',
              'ranking'     => 1,
              'name'        => 'Root',
              'description' => '',
              'match'       => 'OR',
              'is_active'   => true,
              'uuid'        => '500717c8-2bd6e957-53a12b5fd35745.02608131',
          ),
          array(
              'entity_id'   => $entity_id,
              'sub_type'    => 'RuleMailCollector',
              'ranking'     => 3,
              'name'        => 'Root',
              'description' => '',
              'match'       => 'OR',
              'is_active'   => true,
              'uuid'        => '500717c8-2bd6e957-53a12b5fd36404.54713349',
          ),
          array(
              'entity_id'    => $entity_id,
              'sub_type'     => 'RuleMailCollector',
              'ranking'      => 1,
              'name'         => 'Auto-Reply X-Auto-Response-Suppress',
              'description'  => 'Exclude Auto-Reply emails using X-Auto-Response-Suppress header',
              'match'        => 'AND',
              'is_active'    => true,
              'is_recursive' => true,
              'uuid'         => '500717c8-2bd6e957-53a12b5fd36d97.94503423',
          ),
          array(
              'entity_id'    => $entity_id,
              'sub_type'     => 'RuleMailCollector',
              'ranking'      => 2,
              'name'         => 'Auto-Reply Auto-Submitted',
              'description'  => 'Exclude Auto-Reply emails using Auto-Submitted header',
              'match'        => 'AND',
              'is_active'    => true,
              'is_recursive' => true,
              'uuid'         => '500717c8-2bd6e957-53a12b5fd376c2.87642651',
          ),
          array(
              'entity_id'    => $entity_id,
              'sub_type'     => 'RuleTicket',
              'ranking'      => 1,
              'name'         => 'Ticket location from item',
              'description'  => '',
              'match'        => 'AND',
              'comment'      => 'Automatically generated by GLPI 0.84',
              'is_recursive' => true,
              'uuid'         => '500717c8-2bd6e957-53a12b5fd37f94.10365341',
              'condition'    => 1,
          ),
          array(
              'entity_id'    => $entity_id,
              'sub_type'     => 'RuleTicket',
              'ranking'      => 2,
              'name'         => 'Ticket location from user',
              'description'  => '',
              'match'        => 'AND',
              'comment'      => 'Automatically generated by GLPI 0.84',
              'is_recursive' => true,
              'uuid'         => '500717c8-2bd6e957-53a12b5fd38869.86002585',
              'condition'    => 1,
          ),
      );
      $this->insert('glpi_rule', $rows);
      $dbrules = $this->fetchAll('SELECT * FROM glpi_rule');
      $rules = array();
      foreach ($dbrules as $data) {
         $rules[$data['name'].'-'.$data['sub_type']] = $data['id'];
      }


      // Insert into table glpi_ruleaction
      $rows = array(
          array(
              'rule_id'     => $rules['Ticket location from item-RuleTicket'],
              'action_type' => 'fromitem',
              'field'       => 'location_id',
              'value'       => '1'
          ),
          array(
              'rule_id'     => $rules['Root-RuleRight'],
              'action_type' => 'assign',
              'field'       => 'entity_id',
              'value'       => '0'
          ),
          array(
              'rule_id'     => $rules['Root-RuleMailCollector'],
              'action_type' => 'assign',
              'field'       => 'entity_id',
              'value'       => '0'
          ),
          array(
              'rule_id'     => $rules['Auto-Reply X-Auto-Response-Suppress-RuleMailCollector'],
              'action_type' => 'assign',
              'field'       => '_refuse_email_no_response',
              'value'       => '1'
          ),
          array(
              'rule_id'     => $rules['Auto-Reply Auto-Submitted-RuleMailCollector'],
              'action_type' => 'assign',
              'field'       => '_refuse_email_no_response',
              'value'       => '1'
          ),
          array(
              'rule_id'     => $rules['Ticket location from user-RuleTicket'],
              'action_type' => 'fromuser',
              'field'       => 'location_id',
              'value'       => '1'
          ),
      );
      $this->insert('glpi_ruleaction', $rows);



      // Insert into table glpi_rulecriteria
      $rows = array(
          array(
              'rule_id'   => $rules['Ticket location from item-RuleTicket'],
              'criteria'  => 'location_id',
              'condition' => 9,
              'pattern'   => '1',
          ),
          array(
              'rule_id'   => $rules['Root-RuleRight'],
              'criteria'  => 'uid',
              'pattern'   => '*',
          ),
          array(
              'rule_id'   => $rules['Root-RuleRight'],
              'criteria'  => 'samaccountname',
              'pattern'   => '*',
          ),
          array(
              'rule_id'   => $rules['Root-RuleRight'],
              'criteria'  => 'MAIL_EMAIL',
              'pattern'   => '*',
          ),
          array(
              'rule_id'   => $rules['Root-RuleMailCollector'],
              'criteria'  => 'subject',
              'condition' => 6,
              'pattern'   => '/.*/',
          ),
          array(
              'rule_id'   => $rules['Auto-Reply X-Auto-Response-Suppress-RuleMailCollector'],
              'criteria'  => 'x-auto-response-suppress',
              'condition' => 6,
              'pattern'   => '/\\S+/',
          ),
          array(
              'rule_id'   => $rules['Auto-Reply Auto-Submitted-RuleMailCollector'],
              'criteria'  => 'auto-submitted',
              'condition' => 6,
              'pattern'   => '/\\S+/',
          ),
          array(
              'rule_id'   => $rules['Auto-Reply Auto-Submitted-RuleMailCollector'],
              'criteria'  => 'auto-submitted',
              'condition' => 1,
              'pattern'   => 'no',
          ),
          array(
              'rule_id'   => $rules['Ticket location from item-RuleTicket'],
              'criteria'  => 'items_locations',
              'condition' => 8,
              'pattern'   => '1',
          ),
          array(
              'rule_id'   => $rules['Ticket location from user-RuleTicket'],
              'criteria'  => 'location_id',
              'condition' => 9,
              'pattern'   => '1',
          ),
          array(
              'rule_id'   => $rules['Ticket location from user-RuleTicket'],
              'criteria'  => 'users_locations',
              'condition' => 8,
              'pattern'   => '1',
          ),
      );
      $this->insert('glpi_rulecriteria', $rows);



      // Insert into table glpi_rulerightparameter
      $rows = array(
          array(
              'name'  => '(LDAP)Organization',
              'value' => 'o',
          ),
          array(
              'name'  => '(LDAP)Common Name',
              'value' => 'cn',
          ),
          array(
              'name'  => '(LDAP)Department Number',
              'value' => 'departmentnumber',
          ),
          array(
              'name'  => '(LDAP)Email',
              'value' => 'mail',
          ),
          array(
              'name'  => 'Object Class',
              'value' => 'objectclass',
          ),
          array(
              'name'  => '(LDAP)User ID',
              'value' => 'uid',
          ),
          array(
              'name'  => '(LDAP)Telephone Number',
              'value' => 'phone',
          ),
          array(
              'name'  => '(LDAP)Employee Number',
              'value' => 'employeenumber',
          ),
          array(
              'name'  => '(LDAP)Manager',
              'value' => 'manager',
          ),
          array(
              'name'  => '(LDAP)DistinguishedName',
              'value' => 'dn',
          ),
          array(
              'name'  => '(AD)User ID',
              'value' => 'samaccountname',
          ),
          array(
              'name'  => '(LDAP) Title',
              'value' => 'title',
          ),
          array(
              'name'  => '(LDAP) MemberOf',
              'value' => 'memberof',
          ),
      );
      $this->insert('glpi_rulerightparameter', $rows);


      // Insert into table glpi_softwarecategory
      $rows = array(
          array(
              'name'         => 'FUSION',
              'completename' => 'FUSION',
              'level'        => 1
          ),
      );
      $this->insert('glpi_softwarecategory', $rows);


      // Insert into table glpi_softwarelicensetype
      $rows = array(
          array(
              'name' => 'OEM',
          ),
      );
      $this->insert('glpi_softwarelicensetype', $rows);


      // Insert into table glpi_ssovariable
      $rows = array(
          array(
              'name' => 'HTTP_AUTH_USER',
          ),
          array(
              'name' => 'REMOTE_USER',
          ),
          array(
              'name' => 'PHP_AUTH_USER',
          ),
          array(
              'name' => 'USERNAME',
          ),
          array(
              'name' => 'REDIRECT_REMOTE_USER',
          ),
          array(
              'name' => 'HTTP_REMOTE_USER',
          ),
      );
      $this->insert('glpi_ssovariable', $rows);


      // Insert into table glpi_tickettemplate
      $rows = array(
          array(
              'name'         => 'Default',
              'entity_id'    => $entity_id,
              'is_recursive' => true
          )
      );
      $this->insert('glpi_tickettemplate', $rows);
      $tickettemplate = $this->fetchRow('SELECT * FROM glpi_tickettemplate');
      $tickettemplate_id = $tickettemplate['id'];



      // Insert into table glpi_tickettemplatemandatoryfield
      $rows = array(
          array(
              'tickettemplate_id' => $tickettemplate_id,
              'num'               => 21
          )
      );
      $this->insert('glpi_tickettemplatemandatoryfield', $rows);

      // TODO x x x x x x x x x x x x x x x x x x x x

      // Insert into table glpi_transfer
      $rows = array(
          array(
              'name' => 'complete',
              'keep_ticket'         => 2,
              'keep_networklink'    => 2,
              'keep_reservation'    => 1,
              'keep_history'        => 1,
              'keep_device'         => 1,
              'keep_infocom'        => 1,
              'keep_dc_monitor'     => 1,
              'clean_dc_monitor'    => 1,
              'keep_dc_phone'       => 1,
              'clean_dc_phone'      => 1,
              'keep_dc_peripheral'  => 1,
              'clean_dc_peripheral' => 1,
              'keep_dc_printer'     => 1,
              'clean_dc_printer'    => 1,
              'keep_supplier'       => 1,
              'clean_supplier'      => 1,
              'keep_contact'        => 1,
              'clean_contact'       => 1,
              'keep_contract'       => 1,
              'clean_contract'      => 1,
              'keep_software'       => 1,
              'clean_software'      => 1,
              'keep_document'       => 1,
              'clean_document'      => 1,
              'keep_cartridgeitem'  => 1,
              'clean_cartridgeitem' => 1,
              'keep_cartridge'      => 1,
              'keep_consumable'     => 1,
              'keep_disk'           => 1,
          )
      );
      $this->insert('glpi_transfer', $rows);

    }


    public function down() {

    }

}
