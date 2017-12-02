/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.toolbar = [
	// 	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	// 	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
	// 	{ name: 'links', items: [ 'Link', 'Unlink' ] },
	// 	{ name: 'insert', items: [ 'Image', 'Youtube', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' ] },
	// 	//{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	// 	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks','Source' ] },
	//
	//
	// 	'/',
	// 	{ name: 'styles', items: [ 'Format', 'FontSize' ] },
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	// 	{ name: 'basicstyles2', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
	//
	//
	// 	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	// 	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] }
	// ];
        config.skin = 'office2013';
        config.filebrowserBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=files';
        config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=imagess';
        config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=flash';
        config.filebrowserUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=files';
        config.filebrowserImageUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=images';
        config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=flash';
				config.extraAllowedContent = '*(*);*{*}';

				config.extraPlugins = 'wenzgmap';

};
