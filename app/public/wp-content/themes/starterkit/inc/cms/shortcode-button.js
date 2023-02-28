(function() {
	// eslint-disable-next-line no-undef
	tinymce.PluginManager.add('button', function(editor, url) {
		// Add button to the editor
		editor.addButton('button', {
			icon: 'link',
			text: 'Button',
			tooltip: 'Insert button',
			onclick() {
				// Dialogue box to build our button
				editor.windowManager.open({
					title: 'Add button',
					body: [
						{
							type: 'textbox',
							name: 'url',
							label: 'URL',
							value: '',
							tooltip: 'Enter the URL to link to',
						},
						{
							type: 'textbox',
							name: 'label',
							label: 'Button label',
							value: '',
							tooltip: 'Enter the text to place in the button',
						},
						{
							type: 'listbox',
							name: 'color',
							label: 'Color',
							values: [
								{ text: 'Primary', value: 'primary' },
								{ text: 'Secondary', value: 'secondary' },
								{ text: 'Accent', value: 'accent' },
								{ text: 'Dark', value: 'dark' },
								{ text: 'White', value: 'white' },
							],
							tooltip: 'Theme colour to use for your button',
						},
						{
							type: 'listbox',
							name: 'size',
							label: 'Size',
							values: [
								{ text: 'Default', value: '' },
							],
							tooltip: '',
						},
					],
					onsubmit(e) {
						// Get URL

						// Get classes
						const color = e.data.color;
						const size = e.data.size;

						// Open shortcode and add attributes
						let shortcodeStr = '';
						shortcodeStr += '[button url=' + '"' + e.data.url + '"';
						shortcodeStr += ' color=' + '"' + color + '"';
						if (size !== '') { // default size outputs nothing, so we don't want to add a size class unless a specific size such as md or lg is set
							shortcodeStr += ' size=' + '"' + size + '"';
						}
						shortcodeStr += ']';

						// Add button label
						shortcodeStr += e.data.label;

						// Close shortcode
						shortcodeStr += '[/button]';

						// Insert shortcode into the content
						editor.insertContent(shortcodeStr);
					},
				});
			},

		});
	});
}());
