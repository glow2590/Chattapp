	$(document).ready(function(){
			$('.text').emoticonize({
				//delay: 800,
				//animate: false,
				//exclude: 'pre, code, .no-emoticons'
			});
			$('#toggle-headline').toggle(
				function(){
					$('#large').unemoticonize({
						//delay: 800,
						//animate: false
					})
				}, 
				function(){
					$('#large').emoticonize({
						//delay: 800,
						//animate: false
					})
				}
			);
		});
    
            window.onload = function() {

  // Set the size of the rendered Emojis
  // This can be set to 16x16, 36x36, or 72x72
  twemoji.size = '16x16';

  // Parse the document body and
  // insert <img> tags in place of Unicode Emojis
  twemoji.parse(document.body);

}