<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  class ht_category_meta {
    var $code = 'ht_category_meta';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function ht_category_meta() {
      $this->title = MODULE_HEADER_TAGS_CATEGORY_META_TITLE;
      $this->description = MODULE_HEADER_TAGS_CATEGORY_META_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_CATEGORY_META_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_CATEGORY_META_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_CATEGORY_META_STATUS == 'True');
      }
    }

    function execute() {
       global $PHP_SELF, $oscTemplate, $categories, $current_category_id, $languages_id;

      if (basename($PHP_SELF) == FILENAME_DEFAULT) {
        if ($current_category_id > 0) {
          $meta_info_query = tep_db_query("select cd.categories_seo_description, cd.categories_seo_keywords from " . TABLE_CATEGORIES_DESCRIPTION . " cd where cd.categories_id = '" . (int)$current_category_id  . "' and cd.language_id = '" . (int)$languages_id . "'");
          $meta_info = tep_db_fetch_array($meta_info_query);

          if (tep_not_null($meta_info['categories_seo_description'])) {
            $oscTemplate->addBlock('<meta name="description" content="' . tep_output_string($meta_info['categories_seo_description']) . '" />' . "\n", $this->group);
          }
          if ( (tep_not_null($meta_info['categories_seo_keywords'])) && (MODULE_HEADER_TAGS_CATEGORY_META_KEYWORDS_STATUS == 'True') ) {
            $oscTemplate->addBlock('<meta name="keywords" content="' . tep_output_string($meta_info['categories_seo_keywords']) . '" />' . "\n", $this->group);
          }
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_CATEGORY_META_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Category Meta Module', 'MODULE_HEADER_TAGS_CATEGORY_META_STATUS', 'True', 'Do you want to allow Category meta tags to be added to the page header?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Category Meta Description', 'MODULE_HEADER_TAGS_CATEGORY_META_DESCRIPTION_STATUS', 'True', 'Category Descriptions help your site and your sites visitors.', '6', '1', 'tep_cfg_select_option(array(\'True\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Category Meta Keywords', 'MODULE_HEADER_TAGS_CATEGORY_META_KEYWORDS_STATUS', 'False', 'Category Keywords are pointless.  If you are into the Chinese Market select True (for Baidu Search Engine) otherwise select False.', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_CATEGORY_META_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_CATEGORY_META_STATUS', 'MODULE_HEADER_TAGS_CATEGORY_META_DESCRIPTION_STATUS', 'MODULE_HEADER_TAGS_CATEGORY_META_KEYWORDS_STATUS', 'MODULE_HEADER_TAGS_CATEGORY_META_SORT_ORDER');
    }
  }
?>
