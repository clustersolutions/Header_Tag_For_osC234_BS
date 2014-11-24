<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce
  Copyright (c) 2014 Club osCommerce clubosc.com

  Released under the GNU General Public License
*/

  class ht_information_pages_seo {
    var $code = 'ht_information_pages_seo';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function ht_information_pages_seo() {
      $this->title = MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_TITLE;
      $this->description = MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_STATUS == 'True');
      }
    }

    function execute() {
      global $PHP_SELF, $HTTP_GET_VARS, $oscTemplate, $languages_id;

      if (basename($PHP_SELF) == FILENAME_INFORMATION) {
        if (isset($HTTP_GET_VARS['info_id']) && is_numeric($HTTP_GET_VARS['info_id'])) {
          $seo_data_query = tep_db_query("select COALESCE(NULLIF(information_seo_title, ''), information_title) as title, information_seo_meta_description, information_seo_meta_keywords from " . TABLE_INFORMATION . " where information_id = '" . (int)$HTTP_GET_VARS['info_id'] . "' and language_id = '" . (int)$languages_id . "'");
          if (tep_db_num_rows($seo_data_query)) {
            $seo_data = tep_db_fetch_array($seo_data_query);

            if (tep_not_null($seo_data['title'])) {
              $oscTemplate->setTitle($seo_data['title'] . ', ' . $oscTemplate->getTitle());
            }
            if (tep_not_null($seo_data['information_seo_meta_description'])) {
              $oscTemplate->addBlock('<meta name="description" content="' . tep_output_string($seo_data['information_seo_meta_description']) . '" />', $this->group);
            }
            if (tep_not_null($seo_data['information_seo_meta_keywords'])) {
              $oscTemplate->addBlock('<meta name="keywords" content="' . tep_output_string($seo_data['information_seo_meta_keywords']) . '" />', $this->group);
            }
          }
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Information Page SEO Module', 'MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_STATUS', 'True', 'Do you want to allow SEO data to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_STATUS', 'MODULE_HEADER_TAGS_INFORMATION_PAGES_SEO_SORT_ORDER');
    }
  }

