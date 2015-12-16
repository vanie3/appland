<?php
/**
 * Themes shortcode options go here
 *
 * @package AppLand
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

$options =  array(
    /* Columns */
    array(
        'title' => __('Columns', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode' => 'row',
                'insert'    => '[row][/row]',
                'title'     => __('Blank Row', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span1',
                'insert'    => '[span1][/span1]',
                'title'     => __('Span1 (1/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span2',
                'insert'    => '[span2][/span2]',
                'title'     => __('Span2 (1/6th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span3',
                'insert'    => '[span3][/span3]',
                'title'     => __('Span3 (1/4)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span4',
                'insert'    => '[span4][/span4]',
                'title'     => __('Span4 (1/3rd)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span5',
                'insert'    => '[span5][/span5]',
                'title'     => __('Span5 (5/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span6',
                'insert'    => '[span6][/span6]',
                'title'     => __('Span6 (1/2)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span7',
                'insert'    => '[span7][/span7]',
                'title'     => __('Span7 (7/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span8',
                'insert'    => '[span8][/span8]',
                'title'     => __('Span8 (2/3rd)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span9',
                'insert'    => '[span9][/span9]',
                'title'     => __('Span9 (3/4)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span10',
                'insert'    => '[span10][/span10]',
                'title'     => __('Span10 (10/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span11',
                'insert'    => '[span11][/span11]',
                'title'     => __('Span11 (11/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span12',
                'insert'    => '[span12][/span12]',
                'title'     => __('Span12 (one whole row)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            )
        )
    ),

    /* Layouts */
    array(
        'title' => __('Layouts', THEME_ADMIN_TD),
        'members' => array(
            array(
                'title' => __('2 Columns', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span6]Column1[/span6][span6]Column 2[/span6][/row]',
                        'title'     => __('1/2 - 1/2', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span4]Column1[/span4][span8]Column 2[/span8][/row]',
                        'title'     => __('1/3 - 2/3', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span8]Column1[/span8][span4]Column 2[/span4][/row]',
                        'title'     => __('2/3 - 1/3', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span3]Column1[/span3][span9]Column 2[/span9][/row]',
                        'title'     => __('1/4 - 3/4', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span9]Column1[/span9][span3]Column 2[/span3][/row]',
                        'title'     => __('3/4 - 1/4', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                )
            ),
            array(
                'title' => __('3 Columns', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span4]Column1[/span4][span4]Column 2[/span4][span4]Column 3[/span4][/row]',
                        'title'     => __('1/3 - 1/3 - 1/3', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                )
            ),
            array(
                'title' => __('4 Columns', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span3]Column1[/span3][span3]Column 2[/span3][span3]Column 3[/span3][span3]Column 4[/span3][/row]',
                        'title'     => __('1/4 - 1/4 - 1/4 - 1/4', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                )
            )
        )
    ),

    /* Typography */
    array(
        'title' => __('Typography', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode'   => 'lead',
                'title'       => __('Lead Paragraph', THEME_ADMIN_TD),
                'insert_with' => 'insert',
                'insert'      => '[lead centered="yes"][/lead]'
            ),
            array(
                'shortcode'   => 'blockquote',
                'title'       => __('Blockquote', THEME_ADMIN_TD),
                'insert_with' => 'insert',
                'insert'      => '[blockquote who="" cite=""][/blockquote]'
            ),
            array(
                'shortcode'   => 'iconlist',
                'title'       => __('Iconlist', THEME_ADMIN_TD),
                'insert_with' => 'insert',
                'insert'      => '[iconlist][iconitem icon="icon-heart"] icon title [/iconitem][iconitem icon="icon-star"] another icon title [/iconitem][/iconlist]'
            ),
            array(
                'shortcode'   => 'icon',
                'title'       => __('Icon', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'    => array(
                    array(
                        'title'   => 'General',
                        'fields'  => array(
                            array(
                                'name'    => __('Font Size', THEME_ADMIN_TD),
                                'desc'    => __('Size of font to use for icon ( set to 0 to inhertit font size from container )', THEME_ADMIN_TD),
                                'id'      => 'size',
                                'type'    => 'slider',
                                'default' => 0,
                                'attr'    => array(
                                    'max'  => 48,
                                    'min'  => 0,
                                    'step' => 1
                                )
                            ),
                        )
                    ),
                    array(
                        'title'   => 'Icon',
                        'fields'  => array(
                            array(
                                'name'    => __('Icon', THEME_ADMIN_TD),
                                'desc'    => __('Type of button to display', THEME_ADMIN_TD),
                                'id'      => 'content',
                                'type'    => 'icons',
                                'default' => 'icon-glass'
                            )
                        ),
                    ),
                ),
            ),
        )
    ),

    /* Apps */
    array(
        'title' => __('App Stores', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode' => 'google_play',
                'title'     => __('Google Play', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Google Play Options', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Package name', THEME_ADMIN_TD),
                                'desc'    => __('Set the link to your app', THEME_ADMIN_TD),
                                'id'      => 'package',
                                'type'    => 'text',
                                'default' => '',
                                'attr'    => array(
                                    'placeholder' => __('com.example.android', THEME_ADMIN_TD)
                                )
                            ),
                            array(
                                'name'    => '',
                                'id'      => 'or',
                                'type'    => 'htmltext',
                                'default' => 'or',
                            ),
                            array(
                                'name'    => __('Publisher name', THEME_ADMIN_TD),
                                'desc'    => __('Set the link to your app', THEME_ADMIN_TD),
                                'id'      => 'publisher',
                                'type'    => 'text',
                                'default' => '',
                                'attr'    => array(
                                    'placeholder' => __('Example, Inc', THEME_ADMIN_TD)
                                )
                            ),
                            array(
                                'name'    => __('Badge Height', THEME_ADMIN_TD),
                                'desc'    => __('Height of the google play badge', THEME_ADMIN_TD),
                                'id'      => 'height',
                                'type'    => 'radio',
                                'options' => array(
                                    45 => __('45px', THEME_ADMIN_TD),
                                    60 => __('60px', THEME_ADMIN_TD),
                                ),
                                'default' => 60,
                            ),
                            array(
                                'name'    => __('Badge Style', THEME_ADMIN_TD),
                                'desc'    => __('Choose a style of button', THEME_ADMIN_TD),
                                'id'      => 'style',
                                'type'    => 'select',
                                'options' => array(
                                    'get-it-on'   => __('Get It On', THEME_ADMIN_TD),
                                    'android-app' => __('Android App On', THEME_ADMIN_TD)
                                ),
                                'default'   => 'get-it-on',
                            ),
                            array(
                                'name'    => __('Language', THEME_ADMIN_TD),
                                'desc'    => __('Text language in the button', THEME_ADMIN_TD),
                                'id'      => 'lang',
                                'type'    => 'select',
                                'options' => array(
                                    'af'     => __('Afrikaans',THEME_ADMIN_TD),
                                    'be'     => __('Беларуская',THEME_ADMIN_TD),
                                    'bg'     => __('Български',THEME_ADMIN_TD),
                                    'ca'     => __('Català',THEME_ADMIN_TD),
                                    'zh-cn'  => __('中文 (中国)',THEME_ADMIN_TD),
                                    'zh-hk'  => __('中文（香港）',THEME_ADMIN_TD),
                                    'zh-tw'  => __('中文 (台灣)',THEME_ADMIN_TD),
                                    'hr'     => __('Hrvatski',THEME_ADMIN_TD),
                                    'cs'     => __('Česky',THEME_ADMIN_TD),
                                    'da'     => __('Dansk',THEME_ADMIN_TD),
                                    'nl'     => __('Nederlands',THEME_ADMIN_TD),
                                    'et'     => __('Eesti',THEME_ADMIN_TD),
                                    'fa'     => __('فارسی',THEME_ADMIN_TD),
                                    'fil'    => __('Tagalog',THEME_ADMIN_TD),
                                    'fi'     => __('Suomi',THEME_ADMIN_TD),
                                    'fr'     => __('Français',THEME_ADMIN_TD),
                                    'de'     => __('Deutsch',THEME_ADMIN_TD),
                                    'el'     => __('Ελληνικά',THEME_ADMIN_TD),
                                    'en'     => __('English',THEME_ADMIN_TD),
                                    'hu'     => __('Magyar',THEME_ADMIN_TD),
                                    'id-in'  => __('Bahasa Indonesia',THEME_ADMIN_TD),
                                    'it'     => __('Italiano',THEME_ADMIN_TD),
                                    'ja'     => __('日本語',THEME_ADMIN_TD),
                                    'ko'     => __('한국어',THEME_ADMIN_TD),
                                    'lv'     => __('Latviešu',THEME_ADMIN_TD),
                                    'lt'     => __('Lietuviškai',THEME_ADMIN_TD),
                                    'ms'     => __('Bahasa Melayu',THEME_ADMIN_TD),
                                    'no'     => __('Norsk (bokmål)‎',THEME_ADMIN_TD),
                                    'pl'     => __('Polski',THEME_ADMIN_TD),
                                    'pt-br'  => __('Português (Brasil)',THEME_ADMIN_TD),
                                    'pt-pt'  => __('Português (Portugal)',THEME_ADMIN_TD),
                                    'ro'     => __('Română',THEME_ADMIN_TD),
                                    'ru'     => __('Русский',THEME_ADMIN_TD),
                                    'sr'     => __('Српски / srpski',THEME_ADMIN_TD),
                                    'sk'     => __('Slovenčina',THEME_ADMIN_TD),
                                    'sl'     => __('Slovenščina',THEME_ADMIN_TD),
                                    'es'     => __('Español (España)',THEME_ADMIN_TD),
                                    'es-419' => __('Español (Latinoamérica)',THEME_ADMIN_TD),
                                    'sv'     => __('Svenska',THEME_ADMIN_TD),
                                    'sw'     => __('Kiswahili',THEME_ADMIN_TD),
                                    'th'     => __('ไทย',THEME_ADMIN_TD),
                                    'tr'     => __('Türkçe',THEME_ADMIN_TD),
                                    'uk'     => __('Українська',THEME_ADMIN_TD),
                                    'vi'     => __('Tiếng Việt',THEME_ADMIN_TD),
                                    'zu'     => __('isiZulu</',THEME_ADMIN_TD),
                                ),
                                'default'   => 'en',
                            ),
                            array(
                                'name'    => __('Open Link In', THEME_ADMIN_TD),
                                'id'      => 'open_in',
                                'type'    => 'select',
                                'default' => '_blank',
                                'options' => array(
                                    '_self'   => __('Same page as it was clicked ', THEME_ADMIN_TD),
                                    '_blank'  => __('Open in new window/tab', THEME_ADMIN_TD),
                                    '_parent' => __('Open the linked document in the parent frameset', THEME_ADMIN_TD),
                                    '_top'    => __('Open the linked document in the full body of the window', THEME_ADMIN_TD)
                                ),
                                'desc'    => __('Where the badge link opens to', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Float Button', THEME_ADMIN_TD),
                                'id'      => 'float',
                                'type'    => 'select',
                                'default' => 'none',
                                'options' => array(
                                    'none'   => __('None', THEME_ADMIN_TD),
                                    'left'  => __('Left', THEME_ADMIN_TD),
                                    'right' => __('Right', THEME_ADMIN_TD),
                                ),
                                'desc'    => __('Position button (left/right/none)', THEME_ADMIN_TD),
                            ),
                        )
                    )
                )
            ),
            array(
                'shortcode' => 'app_store',
                'title'     => __('App Store', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('App Store', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'      => __('App Link', THEME_ADMIN_TD),
                                'desc'      => __('Set the link to your app', THEME_ADMIN_TD),
                                'id'        => 'link',
                                'type'      => 'text',
                                'default'   => '',
                                'attr' => array(
                                    'placeholder' => __('Add link to app store here', THEME_ADMIN_TD)
                                )
                            ),
                            array(
                                'name' => __('Badge Height', THEME_ADMIN_TD),
                                'desc'      => __('Set the height of your badge', THEME_ADMIN_TD),
                                'id'        => 'height',
                                'type'      => 'select',
                                'options' => array(
                                    45 => __('45px', THEME_ADMIN_TD),
                                    60 => __('60px', THEME_ADMIN_TD)
                                ),
                                'default'   => 60,
                            ),
                            array(
                                'name'    => __('Open Link In', THEME_ADMIN_TD),
                                'id'      => 'open_in',
                                'type'    => 'select',
                                'default' => '_blank',
                                'options' => array(
                                    '_self'   => __('Same page as it was clicked ', THEME_ADMIN_TD),
                                    '_blank'  => __('Open in new window/tab', THEME_ADMIN_TD),
                                    '_parent' => __('Open the linked document in the parent frameset', THEME_ADMIN_TD),
                                    '_top'    => __('Open the linked document in the full body of the window', THEME_ADMIN_TD)
                                ),
                                'desc'    => __('Where the badge link opens to', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Float Button', THEME_ADMIN_TD),
                                'id'      => 'float',
                                'type'    => 'select',
                                'default' => 'none',
                                'options' => array(
                                    'none'   => __('None', THEME_ADMIN_TD),
                                    'left'  => __('Left', THEME_ADMIN_TD),
                                    'right' => __('Right', THEME_ADMIN_TD),
                                ),
                                'desc'    => __('Position button (left/right/none)', THEME_ADMIN_TD),
                            ),
                        )
                    )
                )
            ),
        )
    ),

    /* Social */
    array(
        'title' => __('Social', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode' => 'facebook',
                'title'     => __('Facebook Like', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Like on facebook', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Layout', THEME_ADMIN_TD),
                                'desc'    => __('Include a Send button with the Like button.', THEME_ADMIN_TD),
                                'id'      => 'fb_layout',
                                'type'    => 'select',
                                'options' => array(
                                    'standard'     => __('Standard', THEME_ADMIN_TD),
                                    'button_count' => __('Button Count', THEME_ADMIN_TD),
                                    'box_count'    => __('Box Count', THEME_ADMIN_TD)
                                ),
                                'default' => 'button_count',
                            ),
                            array(
                                'name'    => __('Show Faces', THEME_ADMIN_TD),
                                'desc'    => __('Display profile photos below the button (standard layout only)', THEME_ADMIN_TD),
                                'id'      => 'fb_show_faces',
                                'type'    => 'radio',
                                'options' => array(
                                    'true'  => __('Show', THEME_ADMIN_TD),
                                    'false' => __('Hide', THEME_ADMIN_TD),
                                ),
                                'default' => 'false',
                            ),
                            array(
                                'name'      => __('Width', THEME_ADMIN_TD),
                                'desc'      => __('Width of the Like button.', THEME_ADMIN_TD),
                                'id'        => 'fb_width',
                                'type'      => 'slider',
                                'default'   => 50,
                                'attr'      => array(
                                    'max'       => 450,
                                    'min'       => 50,
                                    'step'      => 1
                                )
                            ),
                            array(
                                'name'    => __('Button Text', THEME_ADMIN_TD),
                                'desc'    => __('Verb to display on the button', THEME_ADMIN_TD),
                                'id'      => 'fb_action',
                                'type'    => 'radio',
                                'options' => array(
                                    'like'  => __('Like', THEME_ADMIN_TD),
                                    'recommend' => __('Recommend', THEME_ADMIN_TD),
                                ),
                                'default' => 'like',
                            ),
                            array(
                                'name'    => __('Button Font', THEME_ADMIN_TD),
                                'desc'    => __('Font to display in the button', THEME_ADMIN_TD),
                                'id'      => 'fb_font',
                                'type'    => 'select',
                                'options' => array(
                                    'arial'         => __('Arial', THEME_ADMIN_TD),
                                    'lucida grande' => __('Lucida Grande', THEME_ADMIN_TD),
                                    'segoe ui'      => __('Segoe ui', THEME_ADMIN_TD),
                                    'tahoma'        => __('Tahoma', THEME_ADMIN_TD),
                                    'trebuchet ms'  => __('Trebuchet ms', THEME_ADMIN_TD),
                                    'verdana'       => __('Verdana', THEME_ADMIN_TD),
                                ),
                                'default' => 'verdana',
                            ),
                            array(
                                'name'    => __('Button Colour', THEME_ADMIN_TD),
                                'desc'    => __('Color scheme for the like button.', THEME_ADMIN_TD),
                                'id'      => 'fb_colour',
                                'type'    => 'radio',
                                'options' => array(
                                    'light'  => __('Light', THEME_ADMIN_TD),
                                    'dark' => __('Dark', THEME_ADMIN_TD),
                                ),
                                'default' => 'light',
                            ),
                        ),
                    ),
                )
            ),
            array(
                'shortcode' => 'twitter',
                'title'     => __('Tweet Button', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Set the style of twitter tweet button', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Tweet Text', THEME_ADMIN_TD),
                                'desc'    => __('Default Tweet text. Leave blank to use page title.', THEME_ADMIN_TD),
                                'id'      => 'twitter_text',
                                'type'    => 'text',
                                'default' => __('Check out this great post', THEME_ADMIN_TD)
                            ),
                            array(
                                'name'    => __('Tweet Hashtags', THEME_ADMIN_TD),
                                'desc'    => __('Hashtags to include in tweet. (comma separated without the # symbol)', THEME_ADMIN_TD),
                                'id'      => 'twitter_hashtags',
                                'type'    => 'text',
                                'default' => ''
                            ),
                            array(
                                'name'    => __('Count Box Position', THEME_ADMIN_TD),
                                'desc'    => __('Choose where to show the tweet count box', THEME_ADMIN_TD),
                                'id'      => 'twitter_count_box',
                                'type'    => 'radio',
                                'options' => array(
                                    'none'       => __('No Count Box', THEME_ADMIN_TD),
                                    'horizontal' => __('Horizontal', THEME_ADMIN_TD),
                                    'vertical'   => __('Vertical', THEME_ADMIN_TD)
                                ),
                                'default' => 'horizontal'
                            ),
                            array(
                                'name'    => __('Button Size', THEME_ADMIN_TD),
                                'desc'    => __('Choose a size for your tweet button', THEME_ADMIN_TD),
                                'id'      => 'twitter_size',
                                'type'    => 'radio',
                                'options' => array(
                                    'medium'       => __('Medium', THEME_ADMIN_TD),
                                    'large' => __('Large', THEME_ADMIN_TD)
                                ),
                                'default' => 'medium'
                            ),
                        ),
                    ),
                )
            ),
            array(
                'shortcode' => 'google_plus',
                'title'     => __('Google +', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Show Google+ Button', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Button Size', THEME_ADMIN_TD),
                                'desc'    => __('Size of google plus button', THEME_ADMIN_TD),
                                'id'      => 'google_size',
                                'type'    => 'select',
                                'options' => array(
                                    'small'    => __('Small', THEME_ADMIN_TD),
                                    'medium'   => __('Medium', THEME_ADMIN_TD),
                                    'standard' => __('Standard', THEME_ADMIN_TD),
                                    'tall'     => __('Tall', THEME_ADMIN_TD),
                                ),
                                'default' => 'medium',
                            ),
                            array(
                                'name'    => __('Button Bubble', THEME_ADMIN_TD),
                                'desc'    => __('Sets the annotation to display next to the button.', THEME_ADMIN_TD),
                                'id'      => 'google_annotation',
                                'type'    => 'radio',
                                'options' => array(
                                    'none' => __('None', THEME_ADMIN_TD),
                                    'bubble' => __('Bubble', THEME_ADMIN_TD),
                                    'inline' => __('Inline', THEME_ADMIN_TD),
                                ),
                                'default' => 'bubble',
                            ),
                            array(
                                'name'    => __('Expand To', THEME_ADMIN_TD),
                                'desc'    => __('Sets the preferred positions to display hover and confirmation bubbles', THEME_ADMIN_TD),
                                'id'      => 'google_expand_to',
                                'type'    => 'select',
                                'options' => array(
                                    'top'    => __('Top', THEME_ADMIN_TD),
                                    'right'  => __('Right', THEME_ADMIN_TD),
                                    'bottom' => __('Bottom', THEME_ADMIN_TD),
                                    'left'   => __('Left', THEME_ADMIN_TD)
                                ),
                                'default' => 'bottom',
                            ),
                        ),
                    ),
                )
            ),
            array(
                'shortcode' => 'mailchimp',
                'insert'    => '[mailchimp][/mailchimp]',
                'title'     => __('Mailchimp', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'social',
                'title'     => __('Social Icons', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Icons', THEME_ADMIN_TD),
                        'fields' => array(),
                    ),
                )
            ),
        )
    ),

    /* Components */
    array(
        'title' => __('Components', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode'     => 'device',
                'title'         => __('Device', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Slideshow', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Device', THEME_ADMIN_TD),
                                'desc'    => __('Choose a device to use for your slider', THEME_ADMIN_TD),
                                'id'      => 'content',
                                'type'    => 'select',
                                'options' => array(
                                    array(
                                        'optgroup' => __('iPhone 5', THEME_ADMIN_TD),
                                        'options'  => array(
                                            array(
                                                'optgroup' => __('&nbsp;&nbsp;&nbsp;&nbsp;Landscape', THEME_ADMIN_TD),
                                                'options'  => array(
                                                    'iphone5w' => __('&nbsp;&nbsp;&nbsp;&nbsp;White', THEME_ADMIN_TD),
                                                    'iphone5b' => __('&nbsp;&nbsp;&nbsp;&nbsp;Black', THEME_ADMIN_TD)
                                                )
                                            ),
                                            array(
                                                'optgroup' => __('&nbsp;&nbsp;&nbsp;&nbsp;Portrait', THEME_ADMIN_TD),
                                                'options'  => array(
                                                    'iphone5-portraitw' => __('&nbsp;&nbsp;&nbsp;&nbsp;White', THEME_ADMIN_TD),
                                                    'iphone5-portraitb' => __('&nbsp;&nbsp;&nbsp;&nbsp;Black', THEME_ADMIN_TD)
                                                )
                                            )
                                        ),
                                    ),
                                    array(
                                        'optgroup' => __('iPhone 4', THEME_ADMIN_TD),
                                        'options'  => array(
                                            array(
                                                'optgroup' => __('&nbsp;&nbsp;&nbsp;&nbsp;Landscape', THEME_ADMIN_TD),
                                                'options'  => array(
                                                    'iphonew' => __('&nbsp;&nbsp;&nbsp;&nbsp;White', THEME_ADMIN_TD)
                                                )
                                            ),
                                            array(
                                                'optgroup' => __('&nbsp;&nbsp;&nbsp;&nbsp;Portrait', THEME_ADMIN_TD),
                                                'options'  => array(
                                                    'iphone-portraitw' => __('&nbsp;&nbsp;&nbsp;&nbsp;White', THEME_ADMIN_TD)
                                                )
                                            )
                                        ),
                                    ),
                                    array(
                                        'optgroup' => __('iPad', THEME_ADMIN_TD),
                                        'options'  => array(
                                            array(
                                                'optgroup' => __('&nbsp;&nbsp;&nbsp;&nbsp;Landscape', THEME_ADMIN_TD),
                                                'options'  => array(
                                                    'ipadb' => __('&nbsp;&nbsp;&nbsp;&nbsp;Black', THEME_ADMIN_TD),
                                                    'ipadw' => __('&nbsp;&nbsp;&nbsp;&nbsp;White', THEME_ADMIN_TD)
                                                )
                                            ),
                                        ),
                                    ),
                                    array(
                                        'macbook' => __('MacBook', THEME_ADMIN_TD)
                                    ),
                                ),
                                'default' => 'iphone5w',
                            ),
                            array(
                                'name'    => __('Choose a slideshow', THEME_ADMIN_TD),
                                'desc'    => __('Populate your slider with one of the slideshows you created', THEME_ADMIN_TD),
                                'id'      => 'slideshow',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'slideshow',
                            ),
                        )
                    ),
                    array(
                        'title' => __('Slideshow Options', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'      =>  __('Animation style', THEME_ADMIN_TD),
                                'desc'      =>  __('Select how your slider animates', THEME_ADMIN_TD),
                                'id'        => 'animation',
                                'type'      => 'select',
                                'options'   =>  array(
                                    'slide' => __('Slide', THEME_ADMIN_TD),
                                    'fade'  => __('Fade', THEME_ADMIN_TD),
                                ),
                                'attr'      =>  array(
                                    'class'    => 'widefat',
                                ),
                                'default'   => 'slide',
                            ),
                            array(
                                'name'      => __('Speed', THEME_ADMIN_TD),
                                'desc'      => __('Set the speed of the slideshow cycling, in milliseconds', THEME_ADMIN_TD),
                                'id'        => 'speed',
                                'type'      => 'slider',
                                'default'   => 7000,
                                'attr'      => array(
                                    'max'       => 15000,
                                    'min'       => 2000,
                                    'step'      => 1000
                                )
                            ),
                            array(
                                'name'      => __('Auto start', THEME_ADMIN_TD),
                                'id'        => 'autostart',
                                'type'      => 'radio',
                                'default'   =>  'true',
                                'desc'    => __('Start slideshow automatically', THEME_ADMIN_TD),
                                'options' => array(
                                    'true'  => __('On', THEME_ADMIN_TD),
                                    'false' => __('Off', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Show navigation arrows', THEME_ADMIN_TD),
                                'id'        => 'directionnav',
                                'type'      => 'radio',
                                'default'   =>  'show',
                                'options' => array(
                                    'show' => __('Show', THEME_ADMIN_TD),
                                    'hide' => __('Hide', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                )
            ),
             // FEATURES SHORTCODE SECTION
            array(
                'shortcode' => 'features',
                'title'     => __('Features', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Features', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Number Of Features', THEME_ADMIN_TD),
                                'desc'    => __('Number of Features to display', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'   => 10,
                                    'min'   => 1,
                                    'step'  => 1
                                )
                            ),
                            array(
                                'name'    => __('Feature span', THEME_ADMIN_TD),
                                'desc'    => __('Span of a Feature in the layout', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'radio',
                                'default' => 3,
                                'options' => array(
                                        3 => __('3 Columns', THEME_ADMIN_TD),
                                        4 => __('4 Columns', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                )
            ),
            // TESTIMONIALS SHORTCODE SECTION
            array(
                'shortcode' => 'testimonials',
                'title'     => __('Testimonials', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Testimonials', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Number Of Testimonials', THEME_ADMIN_TD),
                                'desc'    => __('Number of Testimonials to display', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'   => 10,
                                    'min'   => 1,
                                    'step'  => 1
                                )
                            ),
                            array(
                                'name'    => __('Small testimonial span', THEME_ADMIN_TD),
                                'desc'    => __('Span of a testimonial in the small layout', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'radio',
                                'default' => 3,
                                'options' => array(
                                        3 => __('3 Columns', THEME_ADMIN_TD),
                                        4 => __('4 Columns', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                )
            ),
            array(
                'shortcode'     => 'appland_gallery',
                'title'         => __('Gallery', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Gallery', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Galleries', THEME_ADMIN_TD),
                                'desc'    => __('Galleries to show (leave blank to show all)', THEME_ADMIN_TD),
                                'id'      => 'gallery',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'taxonomy',
                                'taxonomy' => 'oxy_gallery_categories',
                                'attr' => array(
                                    'multiple' => '',
                                    'style' => 'height:100px'
                                )
                            ),
                            array(
                                'name'    => __('Number of gallery items', THEME_ADMIN_TD),
                                'desc'    => __('Number of gallery items to display', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'   => 10,
                                    'min'   => 1,
                                    'step'  => 1
                                )
                            ),
                            array(
                                'name'    => __('Gallery item span', THEME_ADMIN_TD),
                                'desc'    => __('Span of a gallery item in the layout', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'radio',
                                'default' =>  3,
                                'options' => array(
                                    4  => __('4 Columns', THEME_ADMIN_TD),
                                    3  => __('3 Columns', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Gallery rows', THEME_ADMIN_TD),
                                'desc'    => __('Number of gallery rows in the layout', THEME_ADMIN_TD),
                                'id'      => 'rows',
                                'type'    => 'select',
                                'default' =>  2,
                                'options' => array(
                                    3  => __('3 Rows', THEME_ADMIN_TD),
                                    2  => __('2 Rows', THEME_ADMIN_TD),
                                    1  => __('1 Row', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                )
            ),
        )
    ),
    /* Typography */
    // array(
    //     'title' => __('Typography', THEME_ADMIN_TD),
    //     'members' => array(
    //         array(
    //             'shortcode'   => 'lead',
    //             'title'       => __('Lead Paragraph', THEME_ADMIN_TD),
    //             'insert_with' => 'insert',
    //             'insert'      => '[lead centered="yes"][/lead]'
    //         ),
    //         array(
    //             'shortcode'   => 'blockquote',
    //             'title'       => __('Blockquote', THEME_ADMIN_TD),
    //             'insert_with' => 'insert',
    //             'insert'      => '[blockquote who="" cite=""][/blockquote]'
    //         ),
    //         array(
    //             'shortcode'   => 'iconlist',
    //             'title'       => __('Iconlist', THEME_ADMIN_TD),
    //             'insert_with' => 'insert',
    //             'insert'      => '[iconlist][iconitem title="icon title" icon="icon-heart"][/iconitem][iconitem title="another icon title" icon="icon-star"][/iconitem][/iconlist]'
    //         ),
    //     )
    // ),
);
// generate the option fields for the Social Icons shortcode
foreach ( $options as &$section ) {
    foreach ( $section['members'] as &$option ){
                if( isset($option['shortcode']) && $option['shortcode'] == 'social'){
                    for( $i = 0 ; $i < 5 ; $i++ ){
                        $option['sections'][0]['fields'][] =  array(
                            'name'    => sprintf( __('Social %s Icon', THEME_ADMIN_TD), $i+1 ),
                            'id'      => sprintf( __('icon_%s', THEME_ADMIN_TD), $i+1 ),
                            'type'    => 'select',
                            'options' => 'social_icons',
                            'default' => '',
                            'blank'   => __('Choose a social network icon', THEME_ADMIN_TD),
                            'attr'    =>  array(
                                'class'    => 'widefat',
                            ),
                        );

                        $option['sections'][0]['fields'][] = array(
                            'name'    => sprintf( __('Social %s URL ', THEME_ADMIN_TD), $i+1 ),
                            'desc'      => __('Set the url of the Icon', THEME_ADMIN_TD),
                            'id'      =>  sprintf( __('url_%s', THEME_ADMIN_TD), $i+1 ),
                            'type'    => 'text',
                            'default' => '',
                            'attr'    =>  array(
                                'class'    => 'widefat',
                            ),
                        );
                    }
                }
    }
}


return $options;