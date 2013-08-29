if(!window.log) {window.log = function() {log.history = log.history || [];log.history.push(arguments);if(this.console) {console.log(Array.prototype.slice.call(arguments));}};}

(function($, window, undefined){
	$(document).ready(function(){
		log("Metabox");

		$(".slideType input[type=radio]").change(function() {
			var value = $(this).val();
			log(value);

			if(value == "statement"){
				toggleStatement(true);
			} else if() {
				toggleStatement(false);
			} else if() {
				toggleStatement(false);
			} else if() {
				toggleStatement(false);
			} 		
		});

		function toggleStatement(force){
			log(force);
		}
		function toggleChoice(force){
			log(force);
		}
		function toggleProcess(force){
			log(force);
		}
		function toggleResult(force){
			log(force);
		}
	});
})(jQuery,window);