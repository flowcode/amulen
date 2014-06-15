/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
        
    config.filebrowserBrowseUrl = '/src/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/src/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/src/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/src/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/src/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/src/kcfinder/upload.php?type=flash';
    config.skin = 'moono-light';
    
    config.extraPlugins = 'syntaxhighlight';
    
};
