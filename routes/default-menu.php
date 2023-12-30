<?php

use App\Http\Controllers\AppController\DatatablesController;
use App\Http\Controllers\AppController\FormController;
use App\Http\Controllers\AppController\FormpluginsController;
use App\Http\Controllers\AppController\IconsController;
use App\Http\Controllers\AppController\InfoappController;
use App\Http\Controllers\AppController\IntelController;
use App\Http\Controllers\AppController\MiscellaneousController;
use App\Http\Controllers\AppController\NotificationsController;
use App\Http\Controllers\AppController\PageController;
use App\Http\Controllers\AppController\PluginController;
use App\Http\Controllers\AppController\SettingController;
use App\Http\Controllers\AppController\StatisticsController;
use App\Http\Controllers\AppController\TablesController;
use App\Http\Controllers\AppController\UiController;
use App\Http\Controllers\AppController\UtilitiesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        // INTEL
        Route::get('/intel_analytics_dashboard', [IntelController::class, 'intel_analytics_dashboard'])->name('intel_analytics_dashboard');
        Route::get('/intel_marketing_dashboard', [IntelController::class, 'intel_marketing_dashboard'])->name('intel_marketing_dashboard');
        Route::get('/intel_introduction', [IntelController::class, 'intel_introduction'])->name('intel_introduction');
        Route::get('/intel_privacy', [IntelController::class, 'intel_privacy'])->name('intel_privacy');
        Route::get('/intel_build_notes', [IntelController::class, 'intel_build_notes'])->name('intel_build_notes');


        // SETTING

        Route::get('/settings_how_it_works', [SettingController::class, 'settings_how_it_works'])->name('settings_how_it_works');
        Route::get('/settings_layout_options', [SettingController::class, 'settings_layout_options'])->name('settings_layout_options');
        Route::get('/settings_theme_modes', [SettingController::class, 'settings_theme_modes'])->name('settings_theme_modes');
        Route::get('/settings_skin_options', [SettingController::class, 'settings_skin_options'])->name('settings_skin_options');
        Route::get('/settings_saving_db', [SettingController::class, 'settings_saving_db'])->name('settings_saving_db');

        // INFO
        Route::get('/info_app_docs', [InfoappController::class, 'info_app_docs'])->name('info_app_docs');
        Route::get('/info_app_licensing', [InfoappController::class, 'info_app_licensing'])->name('info_app_licensing');
        Route::get('/info_app_flavors', [InfoappController::class, 'info_app_flavors'])->name('info_app_flavors');

        // UI
        Route::get('/ui_alerts', [UiController::class, 'ui_alerts'])->name('ui_alerts');
        Route::get('/ui_accordion', [UiController::class, 'ui_accordion'])->name('ui_accordion');
        Route::get('/ui_badges', [UiController::class, 'ui_badges'])->name('ui_badges');
        Route::get('/ui_breadcrumbs', [UiController::class, 'ui_breadcrumbs'])->name('ui_breadcrumbs');
        Route::get('/ui_buttons', [UiController::class, 'ui_buttons'])->name('ui_buttons');
        Route::get('/ui_button_group', [UiController::class, 'ui_button_group'])->name('ui_button_group');
        Route::get('/ui_cards', [UiController::class, 'ui_cards'])->name('ui_cards');
        Route::get('/ui_carousel', [UiController::class, 'ui_carousel'])->name('ui_carousel');
        Route::get('/ui_collapse', [UiController::class, 'ui_collapse'])->name('ui_collapse');
        Route::get('/ui_dropdowns', [UiController::class, 'ui_dropdowns'])->name('ui_dropdowns');
        Route::get('/ui_list_filter', [UiController::class, 'ui_list_filter'])->name('ui_list_filter');
        Route::get('/ui_modal', [UiController::class, 'ui_modal'])->name('ui_modal');
        Route::get('/ui_navbars', [UiController::class, 'ui_navbars'])->name('ui_navbars');
        Route::get('/ui_panels', [UiController::class, 'ui_panels'])->name('ui_panels');
        Route::get('/ui_pagination', [UiController::class, 'ui_pagination'])->name('ui_pagination');
        Route::get('/ui_popovers', [UiController::class, 'ui_popovers'])->name('ui_popovers');
        Route::get('/ui_progress_bars', [UiController::class, 'ui_progress_bars'])->name('ui_progress_bars');
        Route::get('/ui_scrollspy', [UiController::class, 'ui_scrollspy'])->name('ui_scrollspy');
        Route::get('/ui_side_panel', [UiController::class, 'ui_side_panel'])->name('ui_side_panel');
        Route::get('/ui_spinners', [UiController::class, 'ui_spinners'])->name('ui_spinners');
        Route::get('/ui_tabs_pills', [UiController::class, 'ui_tabs_pills'])->name('ui_tabs_pills');
        Route::get('/ui_toasts', [UiController::class, 'ui_toasts'])->name('ui_toasts');
        Route::get('/ui_tooltips', [UiController::class, 'ui_tooltips'])->name('ui_tooltips');

        // utilities
        Route::get('/utilities_borders', [UtilitiesController::class, 'utilities_borders'])->name('utilities_borders');
        Route::get('/utilities_clearfix', [UtilitiesController::class, 'utilities_clearfix'])->name('utilities_clearfix');
        Route::get('/utilities_color_pallet', [UtilitiesController::class, 'utilities_color_pallet'])->name('utilities_color_pallet');
        Route::get('/utilities_display_property', [UtilitiesController::class, 'utilities_display_property'])->name('utilities_display_property');
        Route::get('/utilities_fonts', [UtilitiesController::class, 'utilities_fonts'])->name('utilities_fonts');
        Route::get('/utilities_flexbox', [UtilitiesController::class, 'utilities_flexbox'])->name('utilities_flexbox');
        Route::get('/utilities_helpers', [UtilitiesController::class, 'utilities_helpers'])->name('utilities_helpers');
        Route::get('/utilities_position', [UtilitiesController::class, 'utilities_position'])->name('utilities_position');
        Route::get('/utilities_responsive_grid', [UtilitiesController::class, 'utilities_responsive_grid'])->name('utilities_responsive_grid');
        Route::get('/utilities_sizing', [UtilitiesController::class, 'utilities_sizing'])->name('utilities_sizing');
        Route::get('/utilities_spacing', [UtilitiesController::class, 'utilities_spacing'])->name('utilities_spacing');
        Route::get('/utilities_typography', [UtilitiesController::class, 'utilities_typography'])->name('utilities_typography');


        //font
        Route::get('/icons_fontawesome_light', [IconsController::class, 'icons_fontawesome_light'])->name('icons_fontawesome_light');
        Route::get('/icons_fontawesome_regular', [IconsController::class, 'icons_fontawesome_regular'])->name('icons_fontawesome_regular');
        Route::get('/icons_fontawesome_solid', [IconsController::class, 'icons_fontawesome_solid'])->name('icons_fontawesome_solid');
        Route::get('/icons_fontawesome_brand', [IconsController::class, 'icons_fontawesome_brand'])->name('icons_fontawesome_brand');
        Route::get('/icons_nextgen_general', [IconsController::class, 'icons_nextgen_general'])->name('icons_nextgen_general');
        Route::get('/icons_nextgen_base', [IconsController::class, 'icons_nextgen_base'])->name('icons_nextgen_base');
        Route::get('/icons_stack_showcase', [IconsController::class, 'icons_stack_showcase'])->name('icons_stack_showcase');
        Route::get('/icons_stack_generate', [IconsController::class, 'icons_stack_generate'])->name('icons_stack_generate');


        //tabel
        Route::get('/tables_basic', [TablesController::class, 'tables_basic'])->name('tables_basic');
        Route::get('/tables_generate_style', [TablesController::class, 'tables_generate_style'])->name('tables_generate_style');


        //Form Stuff
        Route::get('/form_basic_inputs', [FormController::class, 'form_basic_inputs'])->name('form_basic_inputs');
        Route::get('/form_checkbox_radio', [FormController::class, 'form_checkbox_radio'])->name('form_checkbox_radio');
        Route::get('/form_input_groups', [FormController::class, 'form_input_groups'])->name('form_input_groups');
        Route::get('/form_validation', [FormController::class, 'form_validation'])->name('form_validation');
        Route::get('/form_elements', [FormController::class, 'form_elements'])->name('form_elements');
        Route::get('/form_samples', [FormController::class, 'form_samples'])->name('form_samples');

        //Plugins
        Route::get('/plugin_faq', [PluginController::class, 'plugin_faq'])->name('plugin_faq');
        Route::get('/plugin_waves', [PluginController::class, 'plugin_waves'])->name('plugin_waves');
        Route::get('/plugin_pacejs', [PluginController::class, 'plugin_pacejs'])->name('plugin_pacejs');
        Route::get('/plugin_smartpanels', [PluginController::class, 'plugin_smartpanels'])->name('plugin_smartpanels');
        Route::get('/plugin_bootbox', [PluginController::class, 'plugin_bootbox'])->name('plugin_bootbox');
        Route::get('/plugin_slimscroll', [PluginController::class, 'plugin_slimscroll'])->name('plugin_slimscroll');
        Route::get('/plugin_throttle', [PluginController::class, 'plugin_throttle'])->name('plugin_throttle');
        Route::get('/plugin_navigation', [PluginController::class, 'plugin_navigation'])->name('plugin_navigation');
        Route::get('/plugin_i18next', [PluginController::class, 'plugin_i18next'])->name('plugin_i18next');
        Route::get('/plugin_appcore', [PluginController::class, 'plugin_appcore'])->name('plugin_appcore');

        //datatables
        Route::get('/datatables_basic', [DatatablesController::class, 'datatables_basic'])->name('datatables_basic');
        Route::get('/datatables_autofill', [DatatablesController::class, 'datatables_autofill'])->name('datatables_autofill');
        Route::get('/datatables_buttons', [DatatablesController::class, 'datatables_buttons'])->name('datatables_buttons');
        Route::get('/datatables_export', [DatatablesController::class, 'datatables_export'])->name('datatables_export');
        Route::get('/datatables_colreorder', [DatatablesController::class, 'datatables_colreorder'])->name('datatables_colreorder');
        Route::get('/datatables_columnfilter', [DatatablesController::class, 'datatables_columnfilter'])->name('datatables_columnfilter');
        Route::get('/datatables_fixedcolumns', [DatatablesController::class, 'datatables_fixedcolumns'])->name('datatables_fixedcolumns');
        Route::get('/datatables_fixedheader', [DatatablesController::class, 'datatables_fixedheader'])->name('datatables_fixedheader');
        Route::get('/datatables_keytable', [DatatablesController::class, 'datatables_keytable'])->name('datatables_keytable');
        Route::get('/datatables_responsive', [DatatablesController::class, 'datatables_responsive'])->name('datatables_responsive');
        Route::get('/datatables_responsive_alt', [DatatablesController::class, 'datatables_responsive_alt'])->name('datatables_responsive_alt');
        Route::get('/datatables_rowgroup', [DatatablesController::class, 'datatables_rowgroup'])->name('datatables_rowgroup');
        Route::get('/datatables_rowreorder', [DatatablesController::class, 'datatables_rowreorder'])->name('datatables_rowreorder');
        Route::get('/datatables_scroller', [DatatablesController::class, 'datatables_scroller'])->name('datatables_scroller');
        Route::get('/datatables_select', [DatatablesController::class, 'datatables_select'])->name('datatables_select');
        Route::get('/datatables_alteditor', [DatatablesController::class, 'datatables_alteditor'])->name('datatables_alteditor');

        // statistics
        Route::get('/statistics_flot', [StatisticsController::class, 'statistics_flot'])->name('statistics_flot');
        Route::get('/statistics_chartjs', [StatisticsController::class, 'statistics_chartjs'])->name('statistics_chartjs');
        Route::get('/statistics_chartist', [StatisticsController::class, 'statistics_chartist'])->name('statistics_chartist');
        Route::get('/statistics_c3', [StatisticsController::class, 'statistics_c3'])->name('statistics_c3');
        Route::get('/statistics_peity', [StatisticsController::class, 'statistics_peity'])->name('statistics_peity');
        Route::get('/statistics_sparkline', [StatisticsController::class, 'statistics_sparkline'])->name('statistics_sparkline');
        Route::get('/statistics_easypiechart', [StatisticsController::class, 'statistics_easypiechart'])->name('statistics_easypiechart');
        Route::get('/statistics_dygraph', [StatisticsController::class, 'statistics_dygraph'])->name('statistics_dygraph');


        //notifikasi
        Route::get('/notifications_sweetalert2', [NotificationsController::class, 'notifications_sweetalert2'])->name('notifications_sweetalert2');
        Route::get('/notifications_toastr', [NotificationsController::class, 'notifications_toastr'])->name('notifications_toastr');

        //form plugins
        Route::get('/form_plugins_colorpicker', [FormpluginsController::class, 'form_plugins_colorpicker'])->name('form_plugins_colorpicker');
        Route::get('/form_plugins_datepicker', [FormpluginsController::class, 'form_plugins_datepicker'])->name('form_plugins_datepicker');
        Route::get('/form_plugins_daterange_picker', [FormpluginsController::class, 'form_plugins_daterange_picker'])->name('form_plugins_daterange_picker');
        Route::get('/form_plugins_dropzone', [FormpluginsController::class, 'form_plugins_dropzone'])->name('form_plugins_dropzone');
        Route::get('/form_plugins_ionrangeslider', [FormpluginsController::class, 'form_plugins_ionrangeslider'])->name('form_plugins_ionrangeslider');
        Route::get('/form_plugins_inputmask', [FormpluginsController::class, 'form_plugins_inputmask'])->name('form_plugins_inputmask');
        Route::get('/form_plugin_imagecropper', [FormpluginsController::class, 'form_plugin_imagecropper'])->name('form_plugin_imagecropper');
        Route::get('/form_plugin_select2', [FormpluginsController::class, 'form_plugin_select2'])->name('form_plugin_select2');
        Route::get('/form_plugin_summernote', [FormpluginsController::class, 'form_plugin_summernote'])->name('form_plugin_summernote');

        //Miscellaneous
        Route::get('/miscellaneous_fullcalendar', [MiscellaneousController::class, 'miscellaneous_fullcalendar'])->name('miscellaneous_fullcalendar');
        Route::get('/miscellaneous_lightgallery', [MiscellaneousController::class, 'miscellaneous_lightgallery'])->name('miscellaneous_lightgallery');

        //Page Views
        Route::get('/page_chat', [PageController::class, 'page_chat'])->name('page_chat');
        Route::get('/page_contacts', [PageController::class, 'page_contacts'])->name('page_contacts');

        // Forum
        Route::get('/page_forum_list', [PageController::class, 'page_forum_list'])->name('page_forum_list');
        Route::get('/page_forum_threads', [PageController::class, 'page_forum_threads'])->name('page_forum_threads');
        Route::get('/page_forum_discussion', [PageController::class, 'page_forum_discussion'])->name('page_forum_discussion');

        //pages inbox
        Route::get('/page_inbox_general', [PageController::class, 'page_inbox_general'])->name('page_inbox_general');
        Route::get('/page_inbox_read', [PageController::class, 'page_inbox_read'])->name('page_inbox_read');
        Route::get('/page_inbox_write', [PageController::class, 'page_inbox_write'])->name('page_inbox_write');

        //Invoice (printable)
        Route::get('/page_invoice', [PageController::class, 'page_invoice'])->name('page_invoice');

        //Authentication
        Route::get('/page_forget', [PageController::class, 'page_forget'])->name('page_forget');
        Route::get('/page_locked', [PageController::class, 'page_locked'])->name('page_locked');
        Route::get('/page_login', [PageController::class, 'page_login'])->name('page_login');
        Route::get('/page_login_alt', [PageController::class, 'page_login_alt'])->name('page_login_alt');
        Route::get('/page_register', [PageController::class, 'page_register'])->name('page_register');
        Route::get('/page_confirmation', [PageController::class, 'page_confirmation'])->name('page_confirmation');

        //Error Pages
        Route::get('/page_error', [PageController::class, 'page_error'])->name('page_error');
        Route::get('/page_error_404', [PageController::class, 'page_error_404'])->name('page_error_404');
        Route::get('/page_error_announced', [PageController::class, 'page_error_announced'])->name('page_error_announced');

        //Profile
        Route::get('/page_profile', [PageController::class, 'page_profile'])->name('page_profile');

        //search
        Route::get('/page_search', [PageController::class, 'page_search'])->name('page_search');

        //blank
        Route::get('/blank', [PageController::class, 'blank'])->name('blank');
    });
});
