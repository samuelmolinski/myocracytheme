(function() {
	tinymce.create('tinymce.plugins.mb2_shortcodes', {
		init : function(ed, url) {
			ed.addCommand('tiny_mb2_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/layout.php',
					width : 450 + parseInt(ed.getLang('mb2_shortcodes.delta_width', 0)),
					height : 180 + parseInt(ed.getLang('mb2_shortcodes.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('mb2_shortcodes', {title : 'mb2_shortcodes', cmd : 'tiny_mb2_shortcodes', image: url + '/plus-circle.png' });
			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('mb2_shortcodes', n.nodeName == 'IMG');
			});			
		},		
		createControl : function(n, cm) {
			return null;
		},		
		getInfo : function() {
			return {
				longname : 'mb2_shortcodes',
				author : 'marbol2',
				authorurl : 'http://marbol2.com',
				infourl : 'http://marbol2.com',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('mb2_shortcodes', tinymce.plugins.mb2_shortcodes);
})();



